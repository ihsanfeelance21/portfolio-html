(function () {
  'use strict';

  /* ===== NAVBAR ===== */
  var navbar = document.getElementById('navbar');
  var navToggle = document.getElementById('navToggle');
  var navLinks = document.getElementById('navLinks');

  function closeMenu() {
    if (!navLinks) return;
    navLinks.classList.remove('open');
    if (navToggle) {
      navToggle.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
    }
  }

  if (navToggle) {
    navToggle.addEventListener('click', function () {
      var open = navLinks.classList.toggle('open');
      navToggle.classList.toggle('open', open);
      navToggle.setAttribute('aria-expanded', String(open));
    });
  }

  if (navbar) {
    window.addEventListener('scroll', function () {
      navbar.classList.toggle('scrolled', window.scrollY > 10);
    });
  }

  /* ===== ACTIVE NAV ===== */
  var body = document.body;
  var anchors = document.querySelectorAll('.nav-link');

  function activate(target) {
    anchors.forEach(function (a) {
      a.classList.toggle('active', a.getAttribute('data-target') === target);
    });
  }

  // Halaman sub (proyek/sertifikat/admin): pakai data-page yang dikirim server
  if (body && body.dataset.page) {
    activate(body.dataset.page);
  } else {
    // Beranda: aktif mengikuti posisi scroll
    var sections = document.querySelectorAll('main section[id]');
    function setActive() {
      var pos = window.scrollY + 120;
      var current = 'beranda';
      sections.forEach(function (sec) {
        if (pos >= sec.offsetTop) current = sec.id;
      });
      activate(current);
    }
    window.addEventListener('scroll', setActive);
    setActive();
  }

  anchors.forEach(function (a) {
    a.addEventListener('click', closeMenu);
  });

  /* ===== REVEAL ON SCROLL ===== */
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
  } else {
    document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('visible'); });
  }

  /* ===== TYPEWRITER ===== */
  (function () {
    var el = document.getElementById('typewriter');
    if (!el) return;
    var text = el.textContent;
    var i = 0;
    el.textContent = '';
    (function type() {
      if (i <= text.length) {
        el.textContent = text.slice(0, i) + (i < text.length ? '▍' : '');
        i++;
        setTimeout(type, 26);
      }
    })();
  })();
})();
