<?php
/* Se aplica automáticamente a la Página con slug "casos" (WP Template Hierarchy) */
get_header();
?>

<header class="inner-hero">
  <div class="container">
    <nav class="breadcrumb-einas" aria-label="Ruta de navegación"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> <span style="opacity:.5">/</span> Casos</nav>
    <p class="inner-eyebrow">Confianza</p>
    <h1>Casos y proyectos</h1>
    <p class="lead">Experiencia comprobada en gestión ambiental a lo largo de Chile, con foco en la Patagonia.</p>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="prose">
      <p class="lead-block">Más de 200 proyectos ejecutados en gestión ambiental, 300 mil hectáreas prospectadas en línea de base y 200 mil kilómetros recorridos en la Patagonia chilena al 2024. Han confiado en nosotros empresas de energía, acuicultura, minería e infraestructura.</p>
      <p>Trabajamos con titulares y consultoras como HIF, Enel, EDF, Geopark, Australis, Tabsa, Enex, Cerveza Austral, Arcadis y Geobiota, entre otros.</p>
      <div class="note">Estamos preparando una selección de casos de éxito con resultados concretos. ¿Quieres que tu proyecto sea el próximo? <a href="<?php echo esc_url(home_url('/#contacto')); ?>">Conversemos</a>.</div>
    </div>
  </div>
</section>

<section class="cta-section fade-in" id="contacto">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <p class="cta-tag">Hablemos</p>
        <h2 class="cta-h2">¿Tienes un proyecto con <strong>exigencias<br>ambientales</strong>?</h2>
        <p class="cta-sub">Cuéntanos qué tienes en carpeta y vemos juntos cómo avanzar, estés en la región que estés.</p>
        <div class="mt-4">
          <p class="cta-contact-item"><i class="bi bi-geo-alt me-2"></i> Av. Costanera del Estrecho 01860, Punta Arenas</p>
          <p class="cta-contact-item"><i class="bi bi-telephone me-2"></i> +56 9 77090432 · +56 9 66693184</p>
          <p class="cta-contact-item"><i class="bi bi-envelope me-2"></i> contacto@einas.cl</p>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-1">
        <a href="mailto:contacto@einas.cl" class="btn-white">contacto@einas.cl</a>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn-outline-white">Formulario de contacto</a>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
