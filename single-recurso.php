<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $tipo = get_the_terms(get_the_ID(), 'tipo_recurso');
    $tipo_label = ($tipo && !is_wp_error($tipo)) ? $tipo[0]->name : 'Recurso';
    $nota = get_post_meta(get_the_ID(), '_nota_legal', true);
?>

<header class="inner-hero" style="background: var(--blue)">
  <div class="container">
    <nav class="breadcrumb-einas" aria-label="Ruta de navegación">
      <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
      <span style="opacity:.5">/</span>
      <a href="<?php echo esc_url(get_post_type_archive_link('recurso')); ?>">Recursos</a>
      <span style="opacity:.5">/</span>
      <?php echo esc_html($tipo_label); ?>
    </nav>
    <p class="inner-eyebrow"><?php echo esc_html($tipo_label); ?></p>
    <h1><?php the_title(); ?></h1>
    <?php if (has_excerpt()) : ?>
      <p class="lead"><?php echo esc_html(get_the_excerpt()); ?></p>
    <?php endif; ?>
  </div>
</header>

<section class="section">
  <div class="container">
    <article class="prose">
      <?php the_content(); ?>
      <?php if ($nota) : ?>
        <div class="note"><?php echo esc_html($nota); ?> ¿Necesitas apoyo con tu caso? <a href="<?php echo esc_url(home_url('/#contacto')); ?>">Conversemos</a>.</div>
      <?php endif; ?>
    </article>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
