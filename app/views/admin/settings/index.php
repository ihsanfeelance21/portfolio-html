<?php /** @var array $settings @var array $roadmap @var string|null $flash @var array|null $errors
 *  @var string|null $pwd_error @var string|null $pwd_ok */ ?>
<div class="admin-head">
  <h1 class="admin-title">Pengaturan</h1>
</div>

<?php if ($flash): ?>
  <div class="alert alert-success"><?= e($flash) ?></div>
<?php endif; ?>

<!-- ===== PROFIL / SITE SETTINGS ===== -->
<div class="admin-card">
  <h2 class="admin-card-title">Profil &amp; Situs</h2>
  <form class="admin-form" method="post" action="<?= url('/admin/settings/update') ?>">
    <?= csrf_field() ?>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="site_name">Nama Situs</label>
        <input class="form-input" type="text" id="site_name" name="site_name" value="<?= e($settings['site_name']) ?>" />
      </div>
      <div class="form-group">
        <label class="form-label" for="tagline">Tagline (hero)</label>
        <input class="form-input" type="text" id="tagline" name="tagline" value="<?= e($settings['tagline']) ?>" />
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="site_title">Judul Halaman</label>
      <input class="form-input" type="text" id="site_title" name="site_title" value="<?= e($settings['site_title']) ?>" />
    </div>

    <div class="form-group">
      <label class="form-label" for="hero_sub">Deskripsi Hero</label>
      <textarea class="form-input" id="hero_sub" name="hero_sub" rows="3"><?= e($settings['hero_sub']) ?></textarea>
    </div>

    <div class="form-group">
      <label class="form-label" for="about_text">Tentang Saya</label>
      <textarea class="form-input" id="about_text" name="about_text" rows="8"><?= e($settings['about_text']) ?></textarea>
      <p class="form-hint">Pisahkan paragraf dengan baris kosong.</p>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="location">Lokasi</label>
        <input class="form-input" type="text" id="location" name="location" value="<?= e($settings['location']) ?>" />
      </div>
      <div class="form-group">
        <label class="form-label" for="education">Pendidikan</label>
        <input class="form-input" type="text" id="education" name="education" value="<?= e($settings['education']) ?>" />
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input class="form-input" type="email" id="email" name="email" value="<?= e($settings['email']) ?>" />
      </div>
      <div class="form-group">
        <label class="form-label" for="github">GitHub Username</label>
        <input class="form-input" type="text" id="github" name="github" value="<?= e($settings['github']) ?>" />
      </div>
      <div class="form-group">
        <label class="form-label" for="instagram">Instagram Username</label>
        <input class="form-input" type="text" id="instagram" name="instagram" value="<?= e($settings['instagram']) ?>" />
      </div>
    </div>

    <button class="btn btn-primary" type="submit">Simpan Pengaturan</button>
  </form>
</div>

<!-- ===== ROADMAP ===== -->
<div class="admin-card">
  <h2 class="admin-card-title">Roadmap Project Ascend</h2>
  <p class="form-hint" style="margin-bottom:1rem;">Progress otomatis dihitung dari item yang ditandai selesai.</p>
  <ul class="roadmap-admin-list">
    <?php foreach ($roadmap as $item): ?>
    <li class="<?= (int) $item['is_done'] === 1 ? 'done' : '' ?>">
      <span class="mono"><?= (int) $item['is_done'] === 1 ? '✔' : '○' ?></span>
      <?= e($item['title']) ?>
      <span class="row-actions">
        <form method="post" action="<?= url('/admin/settings/roadmap') ?>">
          <?= csrf_field() ?>
          <input type="hidden" name="toggle_id" value="<?= (int) $item['id'] ?>" />
          <button class="btn btn-ghost btn-sm" type="submit"><?= (int) $item['is_done'] === 1 ? 'Batal' : 'Tandai selesai' ?></button>
        </form>
        <form method="post" action="<?= url('/admin/settings/roadmap') ?>" onsubmit="return confirm('Hapus item roadmap?')">
          <?= csrf_field() ?>
          <input type="hidden" name="delete_id" value="<?= (int) $item['id'] ?>" />
          <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
        </form>
      </span>
    </li>
    <?php endforeach; ?>
  </ul>
  <form class="admin-form form-row" method="post" action="<?= url('/admin/settings/roadmap') ?>">
    <?= csrf_field() ?>
    <div class="form-group" style="flex:1;">
      <label class="form-label" for="new_title">Tambah Item Baru</label>
      <input class="form-input" type="text" id="new_title" name="new_title" placeholder="Judul tahapan berikutnya" />
    </div>
    <div class="form-group" style="align-self:flex-end;">
      <button class="btn btn-primary" type="submit">Tambah</button>
    </div>
  </form>
</div>

<!-- ===== UBAH PASSWORD ===== -->
<div class="admin-card">
  <h2 class="admin-card-title">Ubah Password Admin</h2>
  <?php if ($pwd_error): ?>
    <div class="alert alert-error"><?= e($pwd_error) ?></div>
  <?php endif; ?>
  <?php if ($pwd_ok): ?>
    <div class="alert alert-success"><?= e($pwd_ok) ?></div>
  <?php endif; ?>
  <form class="admin-form" method="post" action="<?= url('/admin/settings/password') ?>">
    <?= csrf_field() ?>
    <div class="form-group">
      <label class="form-label" for="current_password">Password Saat Ini</label>
      <input class="form-input" type="password" id="current_password" name="current_password" required />
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="new_password">Password Baru</label>
        <input class="form-input" type="password" id="new_password" name="new_password" required />
        <p class="form-hint">Minimal 8 karakter.</p>
      </div>
      <div class="form-group">
        <label class="form-label" for="confirm_password">Konfirmasi Password</label>
        <input class="form-input" type="password" id="confirm_password" name="confirm_password" required />
      </div>
    </div>
    <button class="btn btn-ghost" type="submit">Ubah Password</button>
  </form>
</div>
