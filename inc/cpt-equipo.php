<?php
/**
 * CPT: Equipo
 * Campos: cargo, puesto, orden (usa el nativo menu_order via page-attributes),
 * destacar_en_home
 */

function einas_register_cpt_equipo() {
    register_post_type('equipo', [
        'labels' => [
            'name'          => 'Equipo',
            'singular_name' => 'Miembro',
            'add_new_item'  => 'Agregar Miembro',
            'edit_item'     => 'Editar Miembro',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'equipo'],
        'menu_icon'    => 'dashicons-groups',
        'supports'     => ['title', 'thumbnail', 'page-attributes'], // page-attributes = orden manual (menu_order)
        'show_in_rest' => false,
    ]);
}
add_action('init', 'einas_register_cpt_equipo');

function einas_equipo_metabox() {
    add_meta_box('einas_equipo_datos', 'Datos profesionales', 'einas_equipo_metabox_html', 'equipo', 'normal', 'high');
}
add_action('add_meta_boxes', 'einas_equipo_metabox');

function einas_equipo_metabox_html($post) {
    wp_nonce_field('einas_equipo_save', 'einas_equipo_nonce');

    $cargo    = get_post_meta($post->ID, '_cargo', true);
    $puesto   = get_post_meta($post->ID, '_puesto', true);
    $destacar = get_post_meta($post->ID, '_destacar_en_home', true);
    ?>
    <p>
        <label for="cargo"><strong>Cargo / profesión</strong></label><br>
        <input type="text" name="cargo" id="cargo" class="widefat" value="<?php echo esc_attr($cargo); ?>" placeholder="Ingeniero Civil Ambiental">
    </p>
    <p>
        <label for="puesto"><strong>Puesto / departamento</strong></label><br>
        <input type="text" name="puesto" id="puesto" class="widefat" value="<?php echo esc_attr($puesto); ?>" placeholder="Gerente General">
    </p>
    <p>
        <label>
            <input type="checkbox" name="destacar_en_home" value="1" <?php checked($destacar, '1'); ?>>
            <strong>Mostrar en el home</strong>
        </label>
        <br><span class="description">El home solo muestra a un grupo destacado; el resto aparece en la página de Equipo completa.</span>
    </p>
    <p class="description">El orden de despliegue se controla con el campo "Orden" del panel <strong>Atributos de página</strong>, a la derecha.</p>
    <?php
}

function einas_equipo_save($post_id) {
    if (!isset($_POST['einas_equipo_nonce']) || !wp_verify_nonce($_POST['einas_equipo_nonce'], 'einas_equipo_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_cargo', sanitize_text_field($_POST['cargo'] ?? ''));
    update_post_meta($post_id, '_puesto', sanitize_text_field($_POST['puesto'] ?? ''));
    update_post_meta($post_id, '_destacar_en_home', isset($_POST['destacar_en_home']) ? '1' : '0');
}
add_action('save_post_equipo', 'einas_equipo_save');

// Ordenar el archivo de equipo por "orden" manual (menu_order), no por fecha
function einas_equipo_archive_order($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('equipo')) {
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'einas_equipo_archive_order');
