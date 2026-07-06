<?php get_header(); ?>

<!-- HERO -->
<div class="hero-wrap">
  <div class="hero-frame">
    <div class="hero-bg-photo">
      <img class="hero-carousel-img active" src="<?php echo esc_url(get_template_directory_uri() . '/assets/seed-images/hero/paisaje.webp'); ?>" alt="Paisaje">
      <img class="hero-carousel-img" src="<?php echo esc_url(get_template_directory_uri() . '/assets/seed-images/hero/paisaje01.webp'); ?>" alt="Paisaje">
      <img class="hero-carousel-img" src="<?php echo esc_url(get_template_directory_uri() . '/assets/seed-images/hero/hito.webp'); ?>" alt="Terreno">
    </div>
    <div class="hero-frame-content">
      <div class="hero-isologo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.86 146.62"><path fill="#fff" d="M0,95.98h38.78c10.44,0,20.25-3.69,27.63-10.39,7.38-6.7,11.45-15.6,11.45-25.08v-9.89h-39.07c-10.36,0-20.1,3.66-27.43,10.31C4.04,67.59,0,76.43,0,85.83v10.15Z"/><path fill="#fff" d="M39.07,101.26H0v9.89c0,9.47,4.07,18.38,11.45,25.08,7.38,6.7,17.19,10.39,27.63,10.39h38.78v-10.15c0-9.4-4.04-18.24-11.36-24.89-7.33-6.65-17.07-10.31-27.43-10.31"/><path fill="#fff" d="M38.79,0c-10.36,0-20.1,3.66-27.43,10.31C4.04,16.96,0,25.8,0,35.2v30.63c1.97-3.15,4.4-6.03,7.25-8.62,4.1-3.72,8.86-6.64,14.17-8.67,5.46-2.1,11.26-3.16,17.23-3.18h.12c10.44,0,20.25-3.69,27.63-10.39,7.38-6.7,11.45-15.6,11.45-25.08V0h-39.07Z"/></svg>
      </div>
      <div>
        <p class="hero-tag">Consultoría y colaboración ambiental</p>
        <h1 class="hero-h1">Somos el puente entre el desarrollo productivo y el territorio.</h1>
        <div class="gap-actions">
          <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn-primary-einas">Conversemos</a>
          <a href="<?php echo esc_url(get_post_type_archive_link('servicio')); ?>" class="btn-ghost-einas">Ver servicios</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- STATS -->
<section class="stats-band fade-in">
  <div class="container">
    <div class="row">
      <div class="col-md-4 stat-card">
        <div class="stat-big">200+</div>
        <p class="stat-desc">Proyectos ejecutados en<br class="d-none d-md-block">gestión ambiental</p>
      </div>
      <div class="col-md-4 stat-card">
        <div class="stat-big">300.000</div>
        <p class="stat-desc">Hectáreas prospectadas<br class="d-none d-md-block">en línea de base</p>
      </div>
      <div class="col-md-4 stat-card">
        <div class="stat-big">1.500<span class="stat-unit"> MMUSD</span></div>
        <p class="stat-desc">Sumatoria de montos en proyectos de inversión que hemos participado y que han ingresado al SEIA</p>
      </div>
    </div>
  </div>
</section>

<!-- SERVICIOS (dinámico desde el CPT) -->
<section class="services-section fade-in">
  <div class="container">
    <p class="section-tag">Qué hacemos</p>
    <h2 class="section-h2">Servicios <strong>a la medida de tu proyecto</strong></h2>
    <div class="row g-4 mt-3">
      <?php
      $servicios = new WP_Query(['post_type' => 'servicio', 'posts_per_page' => 3, 'orderby' => 'menu_order', 'order' => 'ASC']);
      while ($servicios->have_posts()) : $servicios->the_post();
          $color = get_post_meta(get_the_ID(), '_color_acento', true) ?: 'blue';
      ?>
        <div class="col-md-4">
          <div class="service-card">
            <p class="service-num">0<?php echo esc_html($servicios->current_post + 1); ?></p>
            <div class="service-icon-line" style="background: var(--<?php echo esc_attr($color); ?>);"></div>
            <h3 class="service-title"><?php the_title(); ?></h3>
            <p class="service-desc"><?php echo esc_html(get_post_meta(get_the_ID(), '_bajada_hero', true)); ?></p>
            <a class="service-more" href="<?php the_permalink(); ?>">Ver más →</a>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section class="about-section fade-in">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="about-visual">
          <img class="about-img-main" src="<?php echo esc_url(get_template_directory_uri() . '/assets/seed-images/hero/planta.webp'); ?>" alt="Trabajo de campo">
          <img class="about-img-accent" src="<?php echo esc_url(get_template_directory_uri() . '/assets/seed-images/hero/halcon.webp'); ?>" alt="Fauna en terreno">
          <div class="about-color-block">
            <div class="about-block-num">7+</div>
            <div class="about-block-text">Años de<br>experiencia</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <p class="section-tag">Quiénes somos</p>
        <h2 class="section-h2">Acompañamos <strong>procesos complejos.</strong></h2>
        <p class="section-lead">Somos un aliado estratégico para empresas que requieren conocimiento, confiabilidad y capacidad de respuesta.</p>
        <div class="pillars">
          <div class="pillar">
            <span class="pillar-dot blue"></span>
            <div><p class="pillar-title">Eficiencia en tiempo</p><p class="pillar-text">Llevamos el proyecto de principio a fin, sin pasarlo de mano en mano. Eso se nota en los plazos.</p></div>
          </div>
          <div class="pillar">
            <span class="pillar-dot green"></span>
            <div><p class="pillar-title">Acompañamiento y seguimiento</p><p class="pillar-text">No desaparecemos cuando se aprueba el proyecto. Te acompañamos mientras la operación siga en pie.</p></div>
          </div>
          <div class="pillar">
            <span class="pillar-dot amber"></span>
            <div><p class="pillar-title">Flexibilidad operativa</p><p class="pillar-text">Trabajamos como parte de tu equipo, no como un proveedor más, apoyándote en cada detalle.</p></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EQUIPO (dinámico desde el CPT, solo los destacados) -->
<section class="team-section fade-in">
  <div class="container">
    <div class="row align-items-end g-4 mb-4">
      <div class="col-lg-8">
        <p class="section-tag">Personas</p>
        <h2 class="section-h2">Equipo especializado,<br><strong>orientado a resultados.</strong></h2>
      </div>
    </div>
    <div class="row g-1">
      <?php
      $destacados = new WP_Query([
          'post_type'      => 'equipo',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
          'meta_key'       => '_destacar_en_home',
          'meta_value'     => '1',
      ]);
      while ($destacados->have_posts()) : $destacados->the_post();
      ?>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="team-card">
            <div class="team-initials" style="padding:0;overflow:hidden;">
              <?php the_post_thumbnail('medium', ['style' => 'width:100%;height:100%;object-fit:cover;object-position:top;']); ?>
            </div>
            <p class="team-name"><?php the_title(); ?></p>
            <p class="team-role"><?php echo esc_html(get_post_meta(get_the_ID(), '_cargo', true)); ?></p>
            <p class="team-dept"><?php echo esc_html(get_post_meta(get_the_ID(), '_puesto', true)); ?></p>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>

      <div id="team-extra" style="display:none;">
        <div class="row g-1">
          <?php
          $resto = new WP_Query([
              'post_type'      => 'equipo',
              'posts_per_page' => -1,
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
              'meta_key'       => '_destacar_en_home',
              'meta_value'     => '0',
          ]);
          while ($resto->have_posts()) : $resto->the_post();
          ?>
            <div class="col-6 col-md-4 col-lg-3">
              <div class="team-card">
                <div class="team-initials" style="padding:0;overflow:hidden;">
                  <?php the_post_thumbnail('medium', ['style' => 'width:100%;height:100%;object-fit:cover;object-position:top;']); ?>
                </div>
                <p class="team-name"><?php the_title(); ?></p>
                <p class="team-role"><?php echo esc_html(get_post_meta(get_the_ID(), '_cargo', true)); ?></p>
                <p class="team-dept"><?php echo esc_html(get_post_meta(get_the_ID(), '_puesto', true)); ?></p>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
    <div class="text-center mt-4">
      <button id="btn-team-more" data-equipo-url="<?php echo esc_url(get_post_type_archive_link('equipo')); ?>">Ver más del equipo</button>
    </div>
  </div>
</section>

<!-- BANNER FLAMENCOS -->
<section class="flamencos-banner fade-in">
  <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/seed-images/hero/flamencos.webp'); ?>" alt="Flamencos en vuelo" class="flamencos-banner-img">
  <div class="flamencos-banner-overlay"></div>
  <div class="container flamencos-banner-content">
    <h2>EINAS diseña <strong>soluciones<br>ambientales</strong> a la medida.</h2>
    <p>Conversemos para evaluar cómo acompañar tu proyecto de forma eficiente.</p>
  </div>
</section>

<!-- CTA -->
<section class="cta-section fade-in" id="contacto">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <p class="cta-tag">Hablemos</p>
        <div class="mt-4">
          <p class="cta-contact-item"><i class="bi bi-geo-alt me-2"></i> Av. Costanera del Estrecho 01860, Punta Arenas</p>
          <p class="cta-contact-item"><i class="bi bi-telephone me-2"></i> +56 9 6669 3184</p>
          <p class="cta-contact-item"><i class="bi bi-envelope me-2"></i> contacto@einas.cl</p>
        </div>
      </div>
      <div class="col-lg-5">
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn-white">Enviar mensaje</a>
        <a href="tel:+56966693184" class="btn-outline-white">Llamar ahora</a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
