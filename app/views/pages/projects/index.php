<?php /** @var array $projects */ ?>
<section class="page-hero">
  <div class="container">
    <h1 class="section-title"><span class="hash mono">//</span> Proyek &amp; Dokumentasi</h1>
    <p class="section-desc">Semua proyek dikerjakan, di-deploy, dan didokumentasikan di homelab — building in public.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php if ($projects): ?>
      <div class="project-grid">
        <?php foreach ($projects as $project): ?>
          <?php include VIEWS_DIR . '/partials/project_card.php'; ?>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="section-desc">Belum ada proyek. Segera hadir.</p>
    <?php endif; ?>
  </div>
</section>
