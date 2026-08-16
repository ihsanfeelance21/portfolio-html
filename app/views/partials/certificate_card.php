<?php /** @var array $cert */ ?>
<article class="cert-card">
  <?php if ($cert['image']): ?>
    <img class="cert-image" src="<?= e($cert['image']) ?>" alt="<?= e($cert['title']) ?>" loading="lazy" />
  <?php else: ?>
    <div class="cert-image cert-image--placeholder">🎓</div>
  <?php endif; ?>
  <div class="cert-body">
    <h3 class="cert-title"><?= e($cert['title']) ?></h3>
    <p class="cert-issuer"><?= e($cert['issuer']) ?><?= $cert['year'] ? ' • ' . e($cert['year']) : '' ?></p>
    <?php if ($cert['credential_url']): ?>
      <a class="cert-link mono" href="<?= e($cert['credential_url']) ?>" target="_blank" rel="noopener">↗ lihat kredensial</a>
    <?php endif; ?>
  </div>
</article>
