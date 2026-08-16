<?php
/** @var array $settings @var array $skills @var array $projects @var array $certificates
 *  @var array $roadmap @var int $roadmapProgress @var array|null $errors @var string|null $success */
$aboutParagraphs = array_values(array_filter(array_map('trim', explode("\n\n", $settings['about_text']))));
?>
<!-- ===== HERO ===== -->
<section id="beranda" class="hero">
  <div class="container hero-grid">
    <div class="hero-text reveal">
      <p class="hero-eyebrow">// sistem.up --status</p>
      <h1 class="hero-title"><?= e($settings['site_name']) ?></h1>
      <p class="hero-role" id="typewriter"><?= e($settings['tagline']) ?></p>
      <p class="hero-sub"><?= e($settings['hero_sub']) ?></p>
      <div class="hero-actions">
        <a href="<?= url('/proyek') ?>" class="btn btn-primary">Lihat Proyek</a>
        <a href="<?= url('/sertifikat') ?>" class="btn btn-ghost">Sertifikat</a>
      </div>
      <div class="hero-meta mono">
        <span>📍 <?= e($settings['location']) ?></span>
        <span>🎓 <?= e($settings['education']) ?></span>
      </div>
    </div>

    <div class="terminal reveal" aria-label="Terminal simulasi">
      <div class="terminal-bar">
        <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
        <span class="terminal-title mono">ihsan@homelab: ~/portfolio</span>
      </div>
      <div class="terminal-body mono" id="terminalBody">
        <p><span class="prompt">$</span> whoami</p>
        <p class="ok">muhamad-ihsan-kurniawan</p>
        <p><span class="prompt">$</span> cat role.txt</p>
        <p class="ok">it-ops → backend &amp; infrastructure engineer</p>
        <p><span class="prompt">$</span> ls ./skills</p>
        <p class="ok">linux/  networking/  docker/  php/  ci4/  laravel/</p>
        <p><span class="prompt">$</span> ./switch-career --status</p>
        <p class="ok">ACTIVE <span class="blink">▊</span></p>
      </div>
    </div>
  </div>
  <a href="<?= url('/') ?>#tentang" class="scroll-hint mono" aria-label="Scroll ke bawah">▼ scroll</a>
</section>

<!-- ===== TENTANG ===== -->
<section id="tentang" class="section">
  <div class="container">
    <h2 class="section-title reveal"><span class="hash mono">01.</span> Tentang Saya</h2>
    <div class="about-grid">
      <div class="about-story reveal">
        <?php foreach ($aboutParagraphs as $paragraph): ?>
          <p><?= nl2br(e($paragraph)) ?></p>
        <?php endforeach; ?>
      </div>

      <div class="timeline reveal">
        <div class="tl-item">
          <span class="tl-marker"></span>
          <div class="tl-card">
            <span class="tl-tag mono">Sebelum</span>
            <h3>IT Operations &amp; Network Support</h3>
            <p>Menopang kebutuhan teknologi &amp; jaringan institusi pendidikan.</p>
          </div>
        </div>
        <div class="tl-item">
          <span class="tl-marker"></span>
          <div class="tl-card">
            <span class="tl-tag mono">Transisi</span>
            <h3>Membangun Fondasi Ulang</h3>
            <p>Belajar mandiri Linux, Networking (TCP/IP, DNS, Routing), dan Backend.</p>
          </div>
        </div>
        <div class="tl-item">
          <span class="tl-marker"></span>
          <div class="tl-card">
            <span class="tl-tag mono accent-tag">Sekarang</span>
            <h3>Project Ascend — Building in Public</h3>
            <p>Homelab Ubuntu Server, dokumentasi open-source, portofolio bertahap HTML → CI4 → Laravel.</p>
          </div>
        </div>
        <div class="tl-item">
          <span class="tl-marker"></span>
          <div class="tl-card">
            <span class="tl-tag mono">Tujuan</span>
            <h3>Backend &amp; Infrastructure Engineer</h3>
            <p>Berkontribusi di tim yang membangun sistem &amp; infrastruktur berskala nyata.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== SKILLS ===== -->
<section id="skills" class="section section-alt">
  <div class="container">
    <h2 class="section-title reveal"><span class="hash mono">02.</span> Skills</h2>
    <?php if ($skills): ?>
    <div class="skills-grid">
      <?php foreach ($skills as $group => $items): ?>
        <div class="skill-card reveal">
          <h3><?= e($group) ?></h3>
          <ul class="tag-list">
            <?php foreach ($items as $skill): ?>
              <li><?= e($skill) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
      <p class="section-desc reveal">Belum ada data skill.</p>
    <?php endif; ?>
  </div>
</section>

<!-- ===== PROYEK ===== -->
<section id="proyek" class="section">
  <div class="container">
    <h2 class="section-title reveal"><span class="hash mono">03.</span> Proyek &amp; Dokumentasi</h2>
    <p class="section-desc reveal">
      Setiap proyek dikerjakan, di-deploy, dan didokumentasikan di homelab —
      membangun secara terbuka dari hari ke hari.
    </p>
    <?php if ($projects): ?>
    <div class="project-grid">
      <?php foreach ($projects as $project): ?>
        <?php include VIEWS_DIR . '/partials/project_card.php'; ?>
      <?php endforeach; ?>
    </div>
    <p class="section-more reveal"><a class="btn btn-ghost" href="<?= url('/proyek') ?>">Lihat Semua Proyek →</a></p>
    <?php else: ?>
      <p class="section-desc reveal">Belum ada proyek.</p>
    <?php endif; ?>
  </div>
</section>

<!-- ===== SERTIFIKAT ===== -->
<?php if ($certificates): ?>
<section id="sertifikat" class="section section-alt">
  <div class="container">
    <h2 class="section-title reveal"><span class="hash mono">04.</span> Sertifikat Pelatihan</h2>
    <p class="section-desc reveal">
      Sertifikat yang diperoleh dari pelatihan &amp; pembelajaran — verifikasi bisa dilihat di link kredensial.
    </p>
    <div class="cert-grid">
      <?php foreach ($certificates as $cert): ?>
        <?php include VIEWS_DIR . '/partials/certificate_card.php'; ?>
      <?php endforeach; ?>
    </div>
    <p class="section-more reveal"><a class="btn btn-ghost" href="<?= url('/sertifikat') ?>">Semua Sertifikat →</a></p>
  </div>
</section>
<?php endif; ?>

<!-- ===== ROADMAP ===== -->
<section id="roadmap" class="section">
  <div class="container">
    <h2 class="section-title reveal"><span class="hash mono">05.</span> Project Ascend</h2>
    <p class="section-desc reveal">Roadmap transisi karier saya — <strong>building in public</strong>.</p>

    <div class="ascend reveal">
      <div class="ascend-overall">
        <div class="ascend-label mono"><span>Overall Progress</span><span id="ascendPct"><?= $roadmapProgress ?>%</span></div>
        <div class="progress-track"><div class="progress-fill" id="ascendBar" style="width:<?= $roadmapProgress ?>%"></div></div>
      </div>
      <?php if ($roadmap): ?>
      <ol class="ascend-list">
        <?php foreach ($roadmap as $item): ?>
          <li class="<?= (int) $item['is_done'] === 1 ? 'done' : '' ?>">
            <span class="mono"><?= (int) $item['is_done'] === 1 ? '✔' : '○' ?></span>
            <?= e($item['title']) ?>
          </li>
        <?php endforeach; ?>
      </ol>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ===== KONTAK ===== -->
<section id="kontak" class="section section-alt">
  <div class="container">
    <h2 class="section-title reveal"><span class="hash mono">06.</span> Kontak</h2>
    <p class="section-desc reveal">
      Terbuka untuk diskusi, kolaborasi, dan peluang <strong>Backend &amp; Infrastructure</strong>.
    </p>

    <?php if ($success): ?>
      <div class="alert alert-success reveal"><?= e($success) ?></div>
    <?php endif; ?>
    <?php if ($errors): ?>
      <div class="alert alert-error reveal">
        <strong>Periksa kembali:</strong>
        <ul>
          <?php foreach ($errors as $field => $msgs): foreach ($msgs as $msg): ?>
            <li><?= e($field) ?> <?= e($msg) ?></li>
          <?php endforeach; endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="contact-grid reveal">
      <a class="contact-card" href="mailto:<?= e($settings['email']) ?>">
        <span class="contact-icon">✉️</span>
        <span class="contact-label mono">EMAIL</span>
        <span class="contact-value"><?= e($settings['email']) ?></span>
      </a>
      <a class="contact-card" href="https://github.com/<?= e($settings['github']) ?>" target="_blank" rel="noopener">
        <span class="contact-icon">🐙</span>
        <span class="contact-label mono">GITHUB</span>
        <span class="contact-value">@<?= e($settings['github']) ?></span>
      </a>
      <a class="contact-card" href="https://www.instagram.com/<?= e($settings['instagram']) ?>/" target="_blank" rel="noopener">
        <span class="contact-icon">📸</span>
        <span class="contact-label mono">INSTAGRAM</span>
        <span class="contact-value">@<?= e($settings['instagram']) ?></span>
      </a>
    </div>

    <div class="contact-form-wrap reveal">
      <form class="contact-form" method="post" action="<?= url('/kontak') ?>">
        <?= csrf_field() ?>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="c-name">Nama</label>
            <input class="form-input" type="text" id="c-name" name="name" value="<?= old('name') ?>" required />
          </div>
          <div class="form-group">
            <label class="form-label" for="c-email">Email</label>
            <input class="form-input" type="email" id="c-email" name="email" value="<?= old('email') ?>" required />
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="c-subject">Subjek</label>
          <input class="form-input" type="text" id="c-subject" name="subject" value="<?= old('subject') ?>" required />
        </div>
        <div class="form-group">
          <label class="form-label" for="c-message">Pesan</label>
          <textarea class="form-input" id="c-message" name="message" rows="5" required><?= old('message') ?></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Kirim Pesan</button>
      </form>
    </div>
  </div>
</section>
