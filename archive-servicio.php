<?php get_header(); ?>

<header class="inner-hero" style="background: var(--blue)">
  <div class="container">
    <p class="inner-eyebrow">Servicios</p>
    <h1>Qué hacemos</h1>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="feature-grid">
      <?php while (have_posts()) : the_post();
          $color = get_post_meta(get_the_ID(), '_color_acento', true) ?: 'blue';
      ?>
        <a class="feature-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
          <div class="fc-line" style="background:var(--<?php echo esc_attr($color); ?>)"></div>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html(get_post_meta(get_the_ID(), '_bajada_hero', true)); ?></p>
        </a>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
