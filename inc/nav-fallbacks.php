<?php
/**
 * Fallbacks de navegación: se usan mientras no se configure un Menú
 * en Apariencia > Menús, para que el theme funcione "out of the box"
 * igual que la maqueta HTML original.
 */

function einas_default_menu_fallback() {
    $links = [
        home_url('/')                              => 'Inicio',
        get_post_type_archive_link('servicio')     => 'Servicios',
        get_post_type_archive_link('equipo')       => 'Nosotros',
        get_post_type_archive_link('recurso')      => 'Recursos',
        home_url('/#contacto')                     => 'Contacto',
    ];
    echo '<ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">';
    $i = 0;
    foreach ($links as $url => $label) {
        $i++;
        $extra_class = ($i === count($links)) ? ' ms-lg-2 mt-2 mt-lg-0' : '';
        $link_class  = ($i === count($links)) ? ' nav-link btn-nav-cta' : ' nav-link';
        echo '<li class="nav-item' . esc_attr($extra_class) . '"><a class="' . esc_attr(trim($link_class)) . '" href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}

function einas_default_footer_menu_fallback() {
    $links = [
        home_url('/')                          => 'Inicio',
        get_post_type_archive_link('servicio') => 'Servicios',
        get_post_type_archive_link('equipo')   => 'Nosotros',
        get_post_type_archive_link('recurso')  => 'Recursos',
    ];
    echo '<ul class="footer-links">';
    foreach ($links as $url => $label) {
        echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}
