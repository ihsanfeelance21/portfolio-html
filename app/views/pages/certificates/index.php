<?php /** @var array $certificates */ ?>
<section class="page-hero">
  <div class="container">
    <h1 class="section-title"><span class="hash mono">//</span> Sertifikat Pelatihan</h1>
    <p class="section-desc">Sertifikat yang diperoleh dari pelatihan &amp; pembelajaran. Klik link kredensial untuk verifikasi.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php if ($certificates): ?>
      <div class="cert-grid">
        <?php foreach ($certificates as $cert): ?>
          <?php include VIEWS_DIR . '/partials/certificate_card.php'; ?>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="section-desc">Belum ada sertifikat. Segera hadir.</p>
    <?php endif; ?>
  </div>
</section>
