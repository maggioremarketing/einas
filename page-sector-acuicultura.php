<?php
/* Se aplica automáticamente a la Página con slug "sector-acuicultura" */
get_header();
?>

<header class="inner-hero">
  <div class="container">
    <nav class="breadcrumb-einas" aria-label="Ruta de navegación"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> <span style="opacity:.5">/</span> Sector · Acuicultura</nav>
    <p class="inner-eyebrow">Sector · Acuicultura</p>
    <h1>Consultoría ambiental para acuicultura</h1>
    <p class="lead">Gestión ambiental especializada para la industria del salmón y los recursos acuícolas del sur de Chile.</p>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="prose">
      <p>La acuicultura trabaja en ecosistemas frágiles y bajo una regulación que cambia seguido. Por eso el seguimiento de compromisos y el monitoreo constante no son un detalle. Son lo que mantiene la operación en pie.</p>
      <p>Acompañamos a empresas acuícolas del sur austral en la evaluación de sus proyectos, en el cumplimiento de sus RCA y en la gestión ambiental de sus centros, con gente en terreno en la macrozona sur.</p>
      <p>Conocemos cómo se trabaja en Los Lagos, Aysén y Magallanes, y convertimos las exigencias ambientales en planes que tu operación puede llevar a cabo de verdad.</p>
    </div>
  </div>
</section>

<section class="cta-section fade-in" id="contacto">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <p class="cta-tag">Hablemos</p>
        <h2 class="cta-h2">¿Tienes un proyecto con <strong>exigencias<br>ambientales</strong>?</h2>
        <div class="mt-4">
          <p class="cta-contact-item"><i class="bi bi-geo-alt me-2"></i> Av. Costanera del Estrecho 01860, Punta Arenas</p>
          <p class="cta-contact-item"><i class="bi bi-telephone me-2"></i> +56 9 77090432 · +56 9 66693184</p>
          <p class="cta-contact-item"><i class="bi bi-envelope me-2"></i> contacto@einas.cl</p>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1">
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn-white">Conversemos</a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
