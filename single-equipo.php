<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<header class="inner-hero" style="background: var(--blue)">
  <div class="container">
    <nav class="breadcrumb-einas" aria-label="Ruta de navegación">
      <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
      <span style="opacity:.5">/</span>
      <a href="<?php echo esc_url(get_post_type_archive_link('equipo')); ?>">Nosotros</a>
      <span style="opacity:.5">/</span>
      <?php the_title(); ?>
    </nav>
    <h1><?php the_title(); ?></h1>
    <p class="lead"><?php echo esc_html(get_post_meta(get_the_ID(), '_cargo', true)); ?></p>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="row g-5 align-items-start">
      <div class="col-lg-4">
        <div class="team-initials" style="width:260px;height:260px;padding:0;overflow:hidden;">
          <?php the_post_thumbnail('medium', ['style' => 'width:100%;height:100%;object-fit:cover;object-position:top;']); ?>
        </div>
      </div>
      <div class="col-lg-8">
        <p class="team-dept"><?php echo esc_html(get_post_meta(get_the_ID(), '_puesto', true)); ?></p>
        <?php if (get_the_content()) : ?>
          <div class="prose mt-3"><?php the_content(); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
