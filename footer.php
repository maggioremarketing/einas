<footer>
  <div class="container">
    <div class="row g-5">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="footer-logo">
          <img src="<?php echo esc_url(get_theme_mod('einas_logo_url', 'https://einas.cl/wp-content/uploads/2024/04/Einas-1-2.webp')); ?>" alt="EINAS — Consultora Ambiental" width="108" height="34" loading="lazy"/>
        </div>
        <p class="footer-desc">Consultoría y colaboración ambiental desde Punta Arenas, con presencia en todo Chile.</p>
        <p class="footer-contact-item"><a href="mailto:contacto@einas.cl">contacto@einas.cl</a></p>
        <p class="footer-contact-item">+56 9 77090432 · +56 9 66693184</p>
        <p class="footer-contact-item">Av. Costanera del Estrecho 01860</p>
        <p class="footer-contact-item mt-2">
          <a href="https://cl.linkedin.com/in/consultoría-ambiental-einas-b2a235186" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;text-decoration:none;color:inherit;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align:middle;margin-right:6px;"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>LinkedIn ↗
          </a>
        </p>
      </div>

      <div class="col-6 col-md-3 col-lg-2 offset-lg-2">
        <p class="footer-col-title">Servicios</p>
        <ul class="footer-links">
          <?php
          $footer_servicios = new WP_Query(['post_type' => 'servicio', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']);
          while ($footer_servicios->have_posts()) : $footer_servicios->the_post();
          ?>
            <li><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), '_eyebrow', true) ?: get_the_title()); ?></a></li>
          <?php endwhile; wp_reset_postdata(); ?>
          <li><a href="<?php echo esc_url(home_url('/consultora-ambiental-punta-arenas/')); ?>">Punta Arenas</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <p class="footer-col-title">Empresa</p>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url(home_url('/#nosotros')); ?>">Nosotros</a></li>
          <li><a href="<?php echo esc_url(get_post_type_archive_link('equipo')); ?>">Equipo</a></li>
          <li><a href="<?php echo esc_url(home_url('/casos/')); ?>">Casos</a></li>
          <li><a href="<?php echo esc_url(get_post_type_archive_link('recurso')); ?>">Recursos</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 col-lg-2">
        <p class="footer-col-title">Contacto</p>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url(home_url('/contacto/')); ?>">Formulario</a></li>
          <li><a href="tel:+56977090432">+56 9 77090432</a></li>
          <li><a href="mailto:contacto@einas.cl">contacto@einas.cl</a></li>
        </ul>
      </div>
    </div>

    <hr class="footer-divider">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
      <p class="footer-copy">&copy; <?php echo esc_html(date('Y')); ?> EINAS · Consultoría y Colaboración Ambiental · Punta Arenas, Chile</p>
      <p class="footer-copy">www.einas.cl</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
