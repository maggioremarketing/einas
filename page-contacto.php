<?php
/* Template Name: Contacto */
get_header();
?>

<header class="inner-hero" style="background: var(--amber)">
  <div class="container">
    <p class="inner-eyebrow">Contacto</p>
    <h1>Conversemos sobre tu proyecto</h1>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-6">
        <?php
        // TODO: reemplazar "1" por el ID real del formulario (Quform → Forms en wp-admin)
        echo do_shortcode('[quform id="1"]');
        ?>
      </div>
      <div class="col-lg-6">
        <?php
        // TODO: confirmar si es iframe simple o requiere API key propia de Google Maps
        ?>
        <iframe
          src="https://www.google.com/maps?q=Av.+Costanera+del+Estrecho+01860,+Punta+Arenas&output=embed"
          width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p class="footer-contact-item mt-3"><i class="bi bi-geo-alt me-2"></i> Av. Costanera del Estrecho 01860, Punta Arenas</p>
        <p class="footer-contact-item"><i class="bi bi-telephone me-2"></i> +56 9 6669 3184 &nbsp; / &nbsp; +56 9 7709 0432</p>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
