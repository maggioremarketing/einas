<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid px-5">
    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
      <?php
      $logo = get_theme_mod('einas_logo_url', 'https://einas.cl/wp-content/uploads/2024/04/Einas-1-2.webp');
      ?>
      <img src="<?php echo esc_url($logo); ?>" alt="EINAS — Consultora Ambiental, Punta Arenas" width="120" height="38"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'navbar-nav ms-auto align-items-lg-center gap-lg-1',
          'fallback_cb'    => 'einas_default_menu_fallback',
      ]);
      ?>
    </div>
  </div>
</nav>
