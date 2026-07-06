<?php
/**
 * EINAS Theme — functions.php
 */

// ── Setup básico del theme ────────────────────────────────
function einas_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);

    register_nav_menus([
        'primary' => 'Menú Principal',
        'footer'  => 'Menú Footer',
    ]);
}
add_action('after_setup_theme', 'einas_theme_setup');

// ── Assets (CSS/JS) ────────────────────────────────────────
function einas_enqueue_assets() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', [], '1.11.3');
    wp_enqueue_style('google-fonts-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap', [], null);
    wp_enqueue_style('einas-site', get_template_directory_uri() . '/assets/css/site.css', [], filemtime(get_template_directory() . '/assets/css/site.css'));

    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true);
    wp_enqueue_script('einas-main', get_template_directory_uri() . '/assets/js/main.js', [], filemtime(get_template_directory() . '/assets/js/main.js'), true);
}
add_action('wp_enqueue_scripts', 'einas_enqueue_assets');

// ── Custom Post Types ──────────────────────────────────────
require_once get_template_directory() . '/inc/cpt-servicio.php';
require_once get_template_directory() . '/inc/cpt-equipo.php';
require_once get_template_directory() . '/inc/cpt-recurso.php';
require_once get_template_directory() . '/inc/nav-fallbacks.php';

// ── Seeder de contenido inicial (solo corre una vez) ───────
require_once get_template_directory() . '/inc/seed-content.php';
