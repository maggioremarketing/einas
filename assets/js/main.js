document.addEventListener('DOMContentLoaded', function () {
  // Marca <html> para animaciones progresivas (mismo patrón que la maqueta original)
  document.documentElement.className += ' js';

  // ── Fade-in on scroll ──────────────────────────────────
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) e.target.classList.add('visible');
    });
  }, { threshold: 0.07 });
  document.querySelectorAll('.fade-in').forEach(function (el) { observer.observe(el); });

  // ── Hero carousel (home) ───────────────────────────────
  var heroImgs = document.querySelectorAll('.hero-carousel-img');
  if (heroImgs.length > 1) {
    var current = 0;
    setInterval(function () {
      heroImgs[current].classList.remove('active');
      current = (current + 1) % heroImgs.length;
      heroImgs[current].classList.add('active');
    }, 4000);
  }

  // ── Botón "Ver más equipo" (home) ──────────────────────
  var btnTeamMore = document.getElementById('btn-team-more');
  if (btnTeamMore) {
    var teamExpanded = false;
    btnTeamMore.addEventListener('click', function () {
      if (!teamExpanded) {
        document.getElementById('team-extra').style.display = 'block';
        teamExpanded = true;
      } else {
        window.location.href = btnTeamMore.dataset.equipoUrl || '/equipo/';
      }
    });
  }
});
