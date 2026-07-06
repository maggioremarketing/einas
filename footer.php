<footer>
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-4">
        <div class="footer-logo">
          <img src="<?php echo esc_url(get_theme_mod('einas_logo_url', 'https://einas.cl/wp-content/uploads/2024/04/Einas-1-2.webp')); ?>" alt="EINAS" width="140" height="45"/>
        </div>
        <p class="footer-desc">Consultoría y colaboración ambiental. Somos el puente entre el desarrollo productivo y el territorio.</p>
      </div>
      <div class="col-lg-4">
        <p class="footer-col-title">Contacto</p>
        <p class="footer-contact-item"><i class="bi bi-geo-alt me-2"></i> Av. Costanera del Estrecho 01860, Punta Arenas</p>
        <p class="footer-contact-item"><a href="tel:+56977090432">+56 9 7709 0432</a></p>
        <p class="footer-contact-item"><a href="mailto:contacto@einas.cl">contacto@einas.cl</a></p>
        <p class="footer-contact-item mt-2">
          <a href="https://cl.linkedin.com/in/consultoría-ambiental-einas-b2a235186" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;text-decoration:none;color:inherit;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="vertical-align:middle;margin-right:6px;"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>LinkedIn ↗
          </a>
        </p>
      </div>
      <div class="col-lg-4">
        <p class="footer-col-title">Sitio</p>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'footer-links',
            'fallback_cb'    => 'einas_default_footer_menu_fallback',
        ]);
        ?>
      </div>
    </div>
    <hr class="footer-divider">
    <p class="footer-copy">&copy; <?php echo esc_html(date('Y')); ?> EINAS — Consultoría y Colaboración Ambiental. Todos los derechos reservados.</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
