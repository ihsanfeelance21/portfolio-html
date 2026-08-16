<?php /** @var array $project */ ?>
<article class="project-card">
  <div class="project-head">
    <span class="project-icon">📁</span>
    <span class="project-name"><?= e($project['title']) ?></span>
  </div>
  <p class="project-desc"><?= e($project['description']) ?></p>
  <?php $stack = json_decode($project['tech_stack'] ?: '[]', true) ?: []; ?>
  <?php if ($stack): ?>
  <ul class="project-langs">
    <?php foreach ($stack as $lang): ?>
      <span><?= e($lang) ?></span>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  <div class="project-links">
    <a href="<?= url('/proyek/' . $project['slug']) ?>">→ detail</a>
    <?php if ($project['github_url']): ?>
      <a href="<?= e($project['github_url']) ?>" target="_blank" rel="noopener">↗ github</a>
    <?php endif; ?>
    <?php if ($project['live_url']): ?>
      <a href="<?= e($project['live_url']) ?>" target="_blank" rel="noopener">↗ live</a>
    <?php endif; ?>
  </div>
</article>
