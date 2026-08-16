<?php /** @var array $project */ ?>
<?php $stack = json_decode($project['tech_stack'] ?: '[]', true) ?: []; ?>
<section class="page-hero">
  <div class="container">
    <p class="hero-eyebrow mono"><a class="dim-link" href="<?= url('/proyek') ?>">← kembali ke proyek</a></p>
    <h1 class="section-title"><?= e($project['title']) ?></h1>
    <?php if ($stack): ?>
      <ul class="tag-list" style="margin-bottom:1rem;">
        <?php foreach ($stack as $lang): ?>
          <li><?= e($lang) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <div class="project-links">
      <?php if ($project['github_url']): ?>
        <a class="btn btn-ghost" href="<?= e($project['github_url']) ?>" target="_blank" rel="noopener">↗ GitHub</a>
      <?php endif; ?>
      <?php if ($project['live_url']): ?>
        <a class="btn btn-primary" href="<?= e($project['live_url']) ?>" target="_blank" rel="noopener">↗ Live</a>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php if ($project['image']): ?>
      <img class="project-detail-image" src="<?= e($project['image']) ?>" alt="<?= e($project['title']) ?>" />
    <?php endif; ?>
    <div class="about-story project-detail-text">
      <?php foreach (array_filter(array_map('trim', explode("\n", $project['description']))) as $paragraph): ?>
        <p><?= e($paragraph) ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</section>
