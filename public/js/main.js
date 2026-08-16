(function () {
  'use strict';

  /* ===== NAVBAR ===== */
  var navbar = document.getElementById('navbar');
  var navToggle = document.getElementById('navToggle');
  var navLinks = document.getElementById('navLinks');

  function closeMenu() {
    navLinks.classList.remove('open');
    navToggle.classList.remove('open');
    navToggle.setAttribute('aria-expanded', 'false');
  }

  navToggle.addEventListener('click', function () {
    var open = navLinks.classList.toggle('open');
    navToggle.classList.toggle('open', open);
    navToggle.setAttribute('aria-expanded', String(open));
  });

  window.addEventListener('scroll', function () {
    navbar.classList.toggle('scrolled', window.scrollY > 10);
  });

  /* ===== ACTIVE NAV ON SCROLL ===== */
  var sections = document.querySelectorAll('main section[id]');
  var menuAnchors = document.querySelectorAll('.nav-link');

  function setActive() {
    var pos = window.scrollY + 120;
    var current = 'beranda';
    sections.forEach(function (sec) {
      if (pos >= sec.offsetTop) current = sec.id;
    });
    menuAnchors.forEach(function (a) {
      a.classList.toggle('active', a.getAttribute('href') === '#' + current);
    });
  }
  window.addEventListener('scroll', setActive);
  setActive();

  /* ===== SMOOTH CLOSE MENU ON CLICK ===== */
  menuAnchors.forEach(function (a) {
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
        setTimeout(type, 28);
      }
    })();
  })();

  /* ===== PROJECTS ===== */
  var projects = [
    {
      name: 'career-evolution',
      desc: 'Perjalanan belajar profesional — roadmap & catatan transisi karier menuju Backend & Infrastructure.',
      lang: ['Markdown', 'Roadmap'],
      github: 'https://github.com/ihsanfeelance21/career-evolution'
    },
    {
      name: 'homelab',
      desc: 'Ubuntu Server & infrastruktur pribadi — dokumentasi pembangunan homelab dari nol.',
      lang: ['Linux', 'Docker', 'Nginx'],
      github: 'https://github.com/ihsanfeelance21/homelab'
    },
    {
      name: 'linux-notes',
      desc: 'Catatan belajar administrasi Linux — command, konfigurasi, troubleshooting.',
      lang: ['Linux', 'Notes'],
      github: 'https://github.com/ihsanfeelance21/linux-notes'
    },
    {
      name: 'networking-notes',
      desc: 'Dokumentasi jaringan — TCP/IP, DNS, routing, dan network design.',
      lang: ['Networking', 'TCP/IP'],
      github: 'https://github.com/ihsanfeelance21/networking-notes'
    },
    {
      name: 'portfolio-html',
      desc: 'Portofolio statis (proyek ini) — HTML/CSS/JS murni, di-deploy via CI/CD ke Nginx.',
      lang: ['HTML', 'CSS', 'JS'],
      github: 'https://github.com/ihsanfeelance21/portfolio-html'
    },
    {
      name: 'docker-lab',
      desc: 'Eksperimen Docker & containerization — compose, image, networking antar-container.',
      lang: ['Docker', 'DevOps'],
      github: 'https://github.com/ihsanfeelance21/docker-lab'
    },
    {
      name: 'bash-scripts',
      desc: 'Skrip otomasi administrasi Linux untuk mempercepat operasional sehari-hari.',
      lang: ['Bash', 'Automation'],
      github: 'https://github.com/ihsanfeelance21/bash-scripts'
    },
    {
      name: 'dotfiles',
      desc: 'Konfigurasi Linux pribadi — shell, editor, dan environment yang ter-versioning.',
      lang: ['Config', 'Linux'],
      github: 'https://github.com/ihsanfeelance21/dotfiles'
    }
  ];

  (function () {
    var grid = document.getElementById('projectGrid');
    if (!grid) return;
    var html = projects.map(function (p) {
      return (
        '<article class="project-card">' +
          '<div class="project-head">' +
            '<span class="project-icon">📁</span>' +
            '<span class="project-name">' + p.name + '</span>' +
          '</div>' +
          '<p class="project-desc">' + p.desc + '</p>' +
          '<ul class="project-langs">' +
            p.lang.map(function (l) { return '<span>' + l + '</span>'; }).join('') +
          '</ul>' +
          '<div class="project-links">' +
            '<a href="' + p.github + '" target="_blank" rel="noopener">↗ github</a>' +
          '</div>' +
        '</article>'
      );
    }).join('');
    grid.innerHTML = html;
  })();

  /* ===== ROADMAP PROGRESS ===== */
  (function () {
    var items = document.querySelectorAll('.ascend-list li[data-w]');
    if (!items.length) return;
    var sum = 0;
    items.forEach(function (li) { sum += Number(li.dataset.w) || 0; });
    var pct = Math.round(sum / items.length);
    var bar = document.getElementById('ascendBar');
    var label = document.getElementById('ascendPct');
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          bar.style.width = pct + '%';
          label.textContent = pct + '%';
          io.disconnect();
        }
      });
    }, { threshold: 0.3 });
    io.observe(bar);
  })();
})();
