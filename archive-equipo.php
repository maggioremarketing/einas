<?php get_header(); ?>

<header class="inner-hero" style="background: var(--blue)">
  <div class="container">
    <p class="inner-eyebrow">Nosotros</p>
    <h1>Nuestro equipo</h1>
  </div>
</header>

<section class="team-section">
  <div class="container">
    <div class="row g-1">
      <?php while (have_posts()) : the_post(); ?>
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="team-card" style="height:100%">
            <div class="team-initials" style="padding:0;overflow:hidden;">
              <?php the_post_thumbnail('medium', ['style' => 'width:100%;height:100%;object-fit:cover;object-position:top;']); ?>
            </div>
            <p class="team-name"><?php the_title(); ?></p>
            <p class="team-role"><?php echo esc_html(get_post_meta(get_the_ID(), '_cargo', true)); ?></p>
            <p class="team-dept"><?php echo esc_html(get_post_meta(get_the_ID(), '_puesto', true)); ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
