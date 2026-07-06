<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $color   = get_post_meta(get_the_ID(), '_color_acento', true) ?: 'blue';
    $eyebrow = get_post_meta(get_the_ID(), '_eyebrow', true);
    $bajada  = get_post_meta(get_the_ID(), '_bajada_hero', true);
    $intro   = get_post_meta(get_the_ID(), '_intro', true);
    $alcance = get_post_meta(get_the_ID(), '_alcance', true);
    $proceso = get_post_meta(get_the_ID(), '_proceso', true);
?>

<header class="inner-hero" style="background: var(--<?php echo esc_attr($color); ?>)">
  <div class="container">
    <nav class="breadcrumb-einas" aria-label="Ruta de navegación">
      <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
      <span style="opacity:.5">/</span>
      <a href="<?php echo esc_url(get_post_type_archive_link('servicio')); ?>">Servicios</a>
      <span style="opacity:.5">/</span>
      <?php echo esc_html($eyebrow); ?>
    </nav>
    <p class="inner-eyebrow"><?php echo esc_html($eyebrow); ?></p>
    <h1><?php the_title(); ?></h1>
    <p class="lead"><?php echo esc_html($bajada); ?></p>
  </div>
</header>

<section class="section">
  <div class="container">
    <p class="lead-block"><?php echo esc_html($intro); ?></p>
  </div>
</section>

<?php if (!empty($alcance)) : ?>
<section class="section section--light fade-in">
  <div class="container">
    <p class="section-tag">Qué incluye</p>
    <h2 class="section-h2" style="margin-bottom:2rem;">Alcance del <strong>servicio</strong></h2>
    <div class="feature-grid">
      <?php foreach ((array) $alcance as $item) : ?>
        <div class="feature-card">
          <div class="fc-line" style="background:var(--<?php echo esc_attr($color); ?>)"></div>
          <h3><?php echo esc_html($item['titulo']); ?></h3>
          <p><?php echo esc_html($item['descripcion']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($proceso)) : ?>
<section class="section fade-in">
  <div class="container">
    <p class="section-tag">Cómo trabajamos</p>
    <h2 class="section-h2" style="margin-bottom:1.5rem;">Nuestro <strong>proceso</strong></h2>
    <div style="max-width:820px;">
      <?php foreach ((array) $proceso as $i => $paso) : ?>
        <div class="step">
          <div class="step-num"><?php echo esc_html(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></div>
          <div>
            <h3><?php echo esc_html($paso['titulo']); ?></h3>
            <p><?php echo esc_html($paso['descripcion']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="cta-section fade-in" id="contacto">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <p class="cta-tag">Hablemos</p>
        <h2 class="cta-h2">¿Tienes un proyecto con <strong>exigencias<br>ambientales</strong>?</h2>
      </div>
      <div class="col-lg-5">
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn-white">Conversemos</a>
      </div>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
