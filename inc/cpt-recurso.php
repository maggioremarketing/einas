<?php
/**
 * CPT: Recurso (blog de guías)
 * Usa editor nativo de WP para el body + excerpt nativo para la tarjeta.
 * Taxonomía: tipo_recurso (Guía, Caso, Artículo)
 * Campo propio: nota_legal (opcional)
 */

function einas_register_cpt_recurso() {
    register_post_type('recurso', [
        'labels' => [
            'name'          => 'Recursos',
            'singular_name' => 'Recurso',
            'add_new_item'  => 'Agregar Recurso',
            'edit_item'     => 'Editar Recurso',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'recursos'],
        'menu_icon'    => 'dashicons-book-alt',
        'supports'     => ['title', 'editor', 'excerpt', 'thumbnail'],
        'show_in_rest' => true, // acá SÍ conviene Gutenberg: el body es texto largo con h2/h3/ul
    ]);
}
add_action('init', 'einas_register_cpt_recurso');

function einas_register_tax_tipo_recurso() {
    register_taxonomy('tipo_recurso', 'recurso', [
        'labels' => [
            'name'          => 'Tipos de recurso',
            'singular_name' => 'Tipo de recurso',
        ],
        'public'            => true,
        'hierarchical'      => true, // se comporta como categoría, no como tag
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'tipo-recurso'],
    ]);
}
add_action('init', 'einas_register_tax_tipo_recurso');

// Términos por defecto al activar el theme (Guía, Caso, Artículo)
function einas_seed_tipo_recurso_terms() {
    foreach (['Guía', 'Caso', 'Artículo'] as $term) {
        if (!term_exists($term, 'tipo_recurso')) {
            wp_insert_term($term, 'tipo_recurso');
        }
    }
}
add_action('after_switch_theme', 'einas_seed_tipo_recurso_terms');

// ── Metabox: nota legal (opcional) ────────────────────────
function einas_recurso_metabox() {
    add_meta_box('einas_recurso_nota', 'Nota legal (opcional)', 'einas_recurso_metabox_html', 'recurso', 'normal', 'default');
}
add_action('add_meta_boxes', 'einas_recurso_metabox');

function einas_recurso_metabox_html($post) {
    wp_nonce_field('einas_recurso_save', 'einas_recurso_nonce');
    $nota = get_post_meta($post->ID, '_nota_legal', true);
    ?>
    <p class="description">Se muestra al final del artículo, dentro de un recuadro. Déjalo vacío si esta guía no lo necesita.</p>
    <textarea name="nota_legal" class="widefat" rows="2"><?php echo esc_textarea($nota); ?></textarea>
    <?php
}

function einas_recurso_save($post_id) {
    if (!isset($_POST['einas_recurso_nonce']) || !wp_verify_nonce($_POST['einas_recurso_nonce'], 'einas_recurso_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_nota_legal', sanitize_textarea_field($_POST['nota_legal'] ?? ''));
}
add_action('save_post_recurso', 'einas_recurso_save');
