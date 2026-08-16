<?php /** @var string $content @var string $title @var string $active */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow" />
  <title>Admin — <?= e($title ?? '') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= url('/css/style.css') ?>" />
</head>
<body class="admin-body">
  <div class="admin-shell">
    <aside class="admin-sidebar">
      <a class="admin-brand mono" href="<?= url('/admin') ?>">ihsan_admin_</a>
      <nav class="admin-nav">
        <a class="admin-link <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>" href="<?= url('/admin') ?>">📊 Dashboard</a>
        <a class="admin-link <?= ($active ?? '') === 'projects' ? 'active' : '' ?>" href="<?= url('/admin/proyek') ?>">📁 Proyek</a>
        <a class="admin-link <?= ($active ?? '') === 'certificates' ? 'active' : '' ?>" href="<?= url('/admin/sertifikat') ?>">🎓 Sertifikat</a>
        <a class="admin-link <?= ($active ?? '') === 'skills' ? 'active' : '' ?>" href="<?= url('/admin/skill') ?>">🛠 Skills</a>
        <a class="admin-link <?= ($active ?? '') === 'messages' ? 'active' : '' ?>" href="<?= url('/admin/pesan') ?>">✉️ Pesan</a>
        <a class="admin-link <?= ($active ?? '') === 'settings' ? 'active' : '' ?>" href="<?= url('/admin/settings') ?>">⚙️ Pengaturan</a>
      </nav>
      <div class="admin-sidebar-foot">
        <a class="admin-link" href="<?= url('/') ?>" target="_blank" rel="noopener">🌐 Lihat Situs</a>
        <a class="admin-link" href="<?= url('/admin/logout') ?>">↪ Logout</a>
      </div>
    </aside>

    <main class="admin-main">
      <?= $content ?>
    </main>
  </div>

  <script src="<?= url('/js/main.js') ?>"></script>
</body>
</html>
