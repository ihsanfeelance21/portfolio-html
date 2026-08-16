<?php /** @var string $content @var string $title @var string $activeNav */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Portofolio Muhamad Ihsan Kurniawan — Career Switcher menuju Backend & Infrastructure Engineer. Linux, Networking, Docker, PHP, CodeIgniter." />
  <title><?= e($title ?? 'Portofolio') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= url('/css/style.css') ?>" />
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⚡</text></svg>" />
</head>
<body data-page="<?= e($activeNav ?? '') ?>">
  <!-- ===== NAVBAR ===== -->
  <header class="navbar" id="navbar">
    <nav class="container nav-inner">
      <a href="<?= url('/') ?>" class="brand">ihsan<span class="brand-caret">_</span></a>
      <button class="nav-toggle" id="navToggle" aria-label="Buka menu navigasi" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <ul class="nav-links" id="navLinks">
        <li><a href="<?= url('/') ?>#beranda" class="nav-link" data-target="beranda">Beranda</a></li>
        <li><a href="<?= url('/') ?>#tentang" class="nav-link" data-target="tentang">Tentang</a></li>
        <li><a href="<?= url('/') ?>#skills" class="nav-link" data-target="skills">Skills</a></li>
        <li><a href="<?= url('/proyek') ?>" class="nav-link" data-target="proyek">Proyek</a></li>
        <li><a href="<?= url('/sertifikat') ?>" class="nav-link" data-target="sertifikat">Sertifikat</a></li>
        <li><a href="<?= url('/') ?>#roadmap" class="nav-link" data-target="roadmap">Roadmap</a></li>
        <li><a href="<?= url('/') ?>#kontak" class="nav-link" data-target="kontak">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <?= $content ?>
  </main>

  <footer class="footer">
    <div class="container footer-inner">
      <p class="mono">$ echo "Muhamad Ihsan Kurniawan" © <?= date('Y') ?></p>
      <p class="mono">built with &lt;/&gt; on Ubuntu Server &amp; Nginx — deployed via CI/CD</p>
    </div>
  </footer>

  <script src="<?= url('/js/main.js') ?>"></script>
</body>
</html>
