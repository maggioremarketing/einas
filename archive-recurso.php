<?php get_header(); ?>

<header class="inner-hero" style="background: var(--blue)">
  <div class="container">
    <p class="inner-eyebrow">Recursos</p>
    <h1>Guías y recursos</h1>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="res-grid">
      <?php while (have_posts()) : the_post();
          $tipo = get_the_terms(get_the_ID(), 'tipo_recurso');
          $tipo_label = ($tipo && !is_wp_error($tipo)) ? $tipo[0]->name : 'Recurso';
      ?>
        <a class="res-card fade-in" href="<?php the_permalink(); ?>">
          <span class="res-tag"><?php echo esc_html($tipo_label); ?></span>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html(get_the_excerpt()); ?></p>
        </a>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
