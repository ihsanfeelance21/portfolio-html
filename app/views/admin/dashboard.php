<?php /** @var array $stats */ ?>
<div class="admin-head">
  <h1 class="admin-title">Dashboard</h1>
  <p class="mono admin-sub">selamat datang, <?= e((string) Auth::user()) ?> 👋</p>
</div>

<div class="stat-grid">
  <div class="stat-card">
    <span class="stat-icon">📁</span>
    <span class="stat-value"><?= (int) $stats['projects'] ?></span>
    <span class="stat-label mono">PROYEK</span>
  </div>
  <div class="stat-card">
    <span class="stat-icon">🎓</span>
    <span class="stat-value"><?= (int) $stats['certificates'] ?></span>
    <span class="stat-label mono">SERTIFIKAT</span>
  </div>
  <div class="stat-card">
    <span class="stat-icon">🛠</span>
    <span class="stat-value"><?= (int) $stats['skills'] ?></span>
    <span class="stat-label mono">SKILLS</span>
  </div>
  <div class="stat-card">
    <span class="stat-icon">✉️</span>
    <span class="stat-value"><?= (int) $stats['unread'] ?><small> / <?= (int) $stats['messages'] ?></small></span>
    <span class="stat-label mono">PESAN (BELUM DIBACA)</span>
  </div>
</div>

<div class="admin-actions">
  <a class="btn btn-primary" href="<?= url('/admin/proyek/create') ?>">+ Tambah Proyek</a>
  <a class="btn btn-ghost" href="<?= url('/admin/sertifikat/create') ?>">+ Tambah Sertifikat</a>
  <a class="btn btn-ghost" href="<?= url('/admin/pesan') ?>">Kelola Pesan</a>
</div>
