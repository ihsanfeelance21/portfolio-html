<?php /** @var array|null $item @var array|null $errors */
$action = $item ? '/admin/proyek/update' : '/admin/proyek/store';
$title  = $item ? 'Edit Proyek' : 'Tambah Proyek';
$tech   = $item ? implode(', ', $item['tech_stack']) : old('tech_stack');
?>
<div class="admin-head">
  <h1 class="admin-title"><?= $title ?></h1>
  <a class="btn btn-ghost" href="<?= url('/admin/proyek') ?>">← Kembali</a>
</div>

<?php if ($errors): ?>
  <div class="alert alert-error">
    <strong>Periksa kembali:</strong>
    <ul>
      <?php foreach ($errors as $field => $msgs): foreach ($msgs as $msg): ?>
        <li><?= e($field) ?> <?= e($msg) ?></li>
      <?php endforeach; endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form class="admin-form" method="post" action="<?= url($action) ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <?php if ($item): ?><input type="hidden" name="id" value="<?= (int) $item['id'] ?>" /><?php endif; ?>

  <div class="form-group">
    <label class="form-label" for="title">Judul *</label>
    <input class="form-input" type="text" id="title" name="title" value="<?= $item ? e($item['title']) : old('title') ?>" required />
  </div>

  <div class="form-group">
    <label class="form-label" for="description">Deskripsi *</label>
    <textarea class="form-input" id="description" name="description" rows="6" required><?= $item ? e($item['description']) : old('description') ?></textarea>
    <p class="form-hint">Baris baru akan dirender sebagai paragraf terpisah.</p>
  </div>

  <div class="form-group">
    <label class="form-label" for="tech_stack">Tech Stack</label>
    <input class="form-input" type="text" id="tech_stack" name="tech_stack" value="<?= e($tech) ?>" placeholder="PHP, MySQL, Docker" />
    <p class="form-hint">Pisahkan dengan koma.</p>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label class="form-label" for="github_url">Link GitHub</label>
      <input class="form-input" type="url" id="github_url" name="github_url" value="<?= $item ? e($item['github_url'] ?? '') : old('github_url') ?>" />
    </div>
    <div class="form-group">
      <label class="form-label" for="live_url">Link Live</label>
      <input class="form-input" type="url" id="live_url" name="live_url" value="<?= $item ? e($item['live_url'] ?? '') : old('live_url') ?>" />
    </div>
  </div>

  <div class="form-group">
    <label class="form-label" for="image">Gambar</label>
    <?php if ($item && $item['image']): ?>
      <p><img class="thumb" src="<?= e($item['image']) ?>" alt="preview" /></p>
      <p class="form-hint">Kosongkan untuk membiarkan gambar lama.</p>
    <?php endif; ?>
    <input class="form-input" type="file" id="image" name="image" accept="image/*" />
  </div>

  <div class="form-row">
    <div class="form-group">
      <label class="form-label" for="sort_order">Urutan</label>
      <input class="form-input" type="number" id="sort_order" name="sort_order" value="<?= $item ? (int) $item['sort_order'] : old('sort_order', '0') ?>" />
    </div>
    <div class="form-group form-check">
      <label class="form-label"><input type="checkbox" name="is_featured" value="1" <?= $item && (int) $item['is_featured'] === 1 ? 'checked' : '' ?> /> Featured (tampil di beranda)</label>
    </div>
    <div class="form-group form-check">
      <label class="form-label"><input type="checkbox" name="is_active" value="1" <?= !$item || (int) $item['is_active'] === 1 ? 'checked' : '' ?> /> Aktif</label>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Simpan</button>
</form>
