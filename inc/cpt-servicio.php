<?php
/**
 * CPT: Servicio
 * Campos: color_acento, eyebrow, bajada_hero, intro
 * Repeaters: alcance[] (titulo, descripcion), proceso[] (titulo, descripcion)
 */

// ── Registro del CPT ──────────────────────────────────────
function einas_register_cpt_servicio() {
    register_post_type('servicio', [
        'labels' => [
            'name'          => 'Servicios',
            'singular_name' => 'Servicio',
            'add_new_item'  => 'Agregar Servicio',
            'edit_item'     => 'Editar Servicio',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'servicios'],
        'menu_icon'    => 'dashicons-hammer',
        'supports'     => ['title', 'thumbnail', 'page-attributes'], // page-attributes = orden manual
        'show_in_rest' => false, // no necesitamos editor de bloques, todo va por metaboxes
    ]);
}
add_action('init', 'einas_register_cpt_servicio');

// ── Metabox: Detalle del servicio ─────────────────────────
function einas_servicio_metabox_detalle() {
    add_meta_box(
        'einas_servicio_detalle',
        'Detalle del servicio',
        'einas_servicio_detalle_html',
        'servicio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'einas_servicio_metabox_detalle');

function einas_servicio_detalle_html($post) {
    wp_nonce_field('einas_servicio_save', 'einas_servicio_nonce');

    $color_acento = get_post_meta($post->ID, '_color_acento', true) ?: 'blue';
    $eyebrow      = get_post_meta($post->ID, '_eyebrow', true);
    $bajada_hero  = get_post_meta($post->ID, '_bajada_hero', true);
    $intro        = get_post_meta($post->ID, '_intro', true);
    ?>
    <p>
        <label for="color_acento"><strong>Color de acento</strong></label><br>
        <select name="color_acento" id="color_acento">
            <option value="blue"  <?php selected($color_acento, 'blue'); ?>>Azul</option>
            <option value="green" <?php selected($color_acento, 'green'); ?>>Verde</option>
            <option value="amber" <?php selected($color_acento, 'amber'); ?>>Ámbar</option>
        </select>
    </p>
    <p>
        <label for="eyebrow"><strong>Eyebrow (label sobre el título)</strong></label><br>
        <input type="text" name="eyebrow" id="eyebrow" class="widefat" value="<?php echo esc_attr($eyebrow); ?>" placeholder="Evaluación SEIA">
    </p>
    <p>
        <label for="bajada_hero"><strong>Bajada del hero</strong></label><br>
        <textarea name="bajada_hero" id="bajada_hero" class="widefat" rows="2"><?php echo esc_textarea($bajada_hero); ?></textarea>
    </p>
    <p>
        <label for="intro"><strong>Párrafo introductorio</strong></label><br>
        <textarea name="intro" id="intro" class="widefat" rows="3"><?php echo esc_textarea($intro); ?></textarea>
    </p>
    <?php
}

// ── Metabox: Repeaters (Alcance + Proceso) ────────────────
function einas_servicio_metabox_repeaters() {
    add_meta_box('einas_servicio_alcance', 'Alcance del servicio', 'einas_repeater_html', 'servicio', 'normal', 'high', ['meta_key' => 'alcance', 'fields' => ['titulo' => 'Título', 'descripcion' => 'Descripción']]);
    add_meta_box('einas_servicio_proceso', 'Proceso (pasos)', 'einas_repeater_html', 'servicio', 'normal', 'high', ['meta_key' => 'proceso', 'fields' => ['titulo' => 'Título del paso', 'descripcion' => 'Descripción']]);
}
add_action('add_meta_boxes', 'einas_servicio_metabox_repeaters');

/**
 * Repeater genérico reutilizable (funciona para "alcance" y "proceso").
 * Guarda como array serializado: [ ['titulo'=>..,'descripcion'=>..], ... ]
 */
function einas_repeater_html($post, $box) {
    $meta_key = $box['args']['meta_key'];
    $fields   = $box['args']['fields'];
    $rows     = get_post_meta($post->ID, '_' . $meta_key, true);
    if (!is_array($rows) || empty($rows)) {
        $rows = [array_fill_keys(array_keys($fields), '')];
    }
    ?>
    <div class="einas-repeater" data-key="<?php echo esc_attr($meta_key); ?>">
        <div class="einas-repeater-rows">
            <?php foreach ($rows as $i => $row): ?>
                <div class="einas-repeater-row" style="border:1px solid #ddd;padding:10px;margin-bottom:8px;">
                    <?php foreach ($fields as $field_key => $field_label): ?>
                        <p>
                            <label><strong><?php echo esc_html($field_label); ?></strong></label><br>
                            <input type="text" class="widefat"
                                name="<?php echo esc_attr($meta_key . '[' . $i . '][' . $field_key . ']'); ?>"
                                value="<?php echo esc_attr($row[$field_key] ?? ''); ?>">
                        </p>
                    <?php endforeach; ?>
                    <button type="button" class="button einas-repeater-remove">Eliminar fila</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button button-primary einas-repeater-add">+ Agregar fila</button>
    </div>

    <script>
    (function() {
        var wrap = document.currentScript.previousElementSibling.parentElement || document.querySelector('.einas-repeater[data-key="<?php echo esc_js($meta_key); ?>"]');
    })();
    </script>
    <?php
}

// JS de soporte para todos los repeaters (una sola vez, en el footer del admin)
function einas_repeater_admin_js() {
    global $post_type;
    if ($post_type !== 'servicio') return;
    ?>
    <script>
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('einas-repeater-add')) {
            var wrap = e.target.closest('.einas-repeater');
            var rows = wrap.querySelector('.einas-repeater-rows');
            var firstRow = rows.querySelector('.einas-repeater-row');
            var newRow = firstRow.cloneNode(true);
            var newIndex = rows.children.length;
            newRow.querySelectorAll('input').forEach(function(input) {
                input.value = '';
                input.name = input.name.replace(/\[\d+\]/, '[' + newIndex + ']');
            });
            rows.appendChild(newRow);
        }
        if (e.target.classList.contains('einas-repeater-remove')) {
            var row = e.target.closest('.einas-repeater-row');
            var rows = row.parentElement;
            if (rows.children.length > 1) row.remove();
        }
    });
    </script>
    <?php
}
add_action('admin_footer-post.php', 'einas_repeater_admin_js');
add_action('admin_footer-post-new.php', 'einas_repeater_admin_js');

// ── Guardado ───────────────────────────────────────────────
function einas_servicio_save($post_id) {
    if (!isset($_POST['einas_servicio_nonce']) || !wp_verify_nonce($_POST['einas_servicio_nonce'], 'einas_servicio_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Campos simples
    update_post_meta($post_id, '_color_acento', sanitize_text_field($_POST['color_acento'] ?? 'blue'));
    update_post_meta($post_id, '_eyebrow', sanitize_text_field($_POST['eyebrow'] ?? ''));
    update_post_meta($post_id, '_bajada_hero', sanitize_textarea_field($_POST['bajada_hero'] ?? ''));
    update_post_meta($post_id, '_intro', sanitize_textarea_field($_POST['intro'] ?? ''));

    // Repeaters
    foreach (['alcance', 'proceso'] as $key) {
        if (!isset($_POST[$key]) || !is_array($_POST[$key])) continue;
        $clean = [];
        foreach ($_POST[$key] as $row) {
            if (empty($row['titulo']) && empty($row['descripcion'])) continue; // descarta filas vacías
            $clean[] = [
                'titulo'      => sanitize_text_field($row['titulo'] ?? ''),
                'descripcion' => sanitize_textarea_field($row['descripcion'] ?? ''),
            ];
        }
        update_post_meta($post_id, '_' . $key, $clean);
    }
}
add_action('save_post_servicio', 'einas_servicio_save');

// Ordenar el archivo de servicios por "orden" manual (menu_order), no por fecha
function einas_servicio_archive_order($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('servicio')) {
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'einas_servicio_archive_order');
