<?php get_header(); ?>

<main class="container" style="padding: 8rem 0 4rem;">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <div class="prose"><?php the_content(); ?></div>
    </article>
  <?php endwhile; else: ?>
    <p>No se encontró contenido.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
