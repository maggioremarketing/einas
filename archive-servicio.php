<?php get_header(); ?>

<header class="inner-hero">
  <div class="container">
    <nav class="breadcrumb-einas" aria-label="Ruta de navegación"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> <span style="opacity:.5">/</span> Servicios</nav>
    <p class="inner-eyebrow">Lo que hacemos</p>
    <h1>Servicios de gestión ambiental</h1>
    <p class="lead">Acompañamos a empresas en la evaluación de impacto ambiental (SEIA), en el cumplimiento de sus RCA y en la gestión ambiental del día a día. Rápido, con rigor y sin que tengas que coordinar a cinco proveedores distintos.</p>
  </div>
</header>

<section class="services-section fade-in" id="servicios">
  <div class="container">
    <div class="row g-1">
      <?php
      $i = 0;
      while (have_posts()) : the_post();
          $i++;
          $color   = get_post_meta(get_the_ID(), '_color_acento', true) ?: 'blue';
          $alcance = get_post_meta(get_the_ID(), '_alcance', true);
      ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="service-card">
            <p class="service-num">0<?php echo esc_html($i); ?></p>
            <div class="service-icon-line" style="background: var(--<?php echo esc_attr($color); ?>);"></div>
            <h3 class="service-title"><?php the_title(); ?></h3>
            <p class="service-desc"><?php echo esc_html(get_post_meta(get_the_ID(), '_bajada_hero', true)); ?></p>
            <?php if (!empty($alcance)) : ?>
              <ul class="service-list">
                <?php foreach ((array) $alcance as $item) : ?>
                  <li><?php echo esc_html($item['titulo']); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <a class="service-more" href="<?php the_permalink(); ?>">Ver servicio →</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
