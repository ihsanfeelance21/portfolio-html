<?php /** @var array|null $item @var array|null $errors */
$action = $item ? '/admin/sertifikat/update' : '/admin/sertifikat/store';
$title  = $item ? 'Edit Sertifikat' : 'Tambah Sertifikat';
?>
<div class="admin-head">
  <h1 class="admin-title"><?= $title ?></h1>
  <a class="btn btn-ghost" href="<?= url('/admin/sertifikat') ?>">← Kembali</a>
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
    <label class="form-label" for="title">Judul Sertifikat *</label>
    <input class="form-input" type="text" id="title" name="title" value="<?= $item ? e($item['title']) : old('title') ?>" required />
  </div>

  <div class="form-row">
    <div class="form-group">
      <label class="form-label" for="issuer">Penerbit / Institusi *</label>
      <input class="form-input" type="text" id="issuer" name="issuer" value="<?= $item ? e($item['issuer']) : old('issuer') ?>" required />
    </div>
    <div class="form-group">
      <label class="form-label" for="year">Tahun *</label>
      <input class="form-input" type="text" id="year" name="year" value="<?= $item ? e($item['year']) : old('year') ?>" placeholder="2025" required />
    </div>
  </div>

  <div class="form-group">
    <label class="form-label" for="credential_url">Link Kredensial / Verifikasi</label>
    <input class="form-input" type="url" id="credential_url" name="credential_url" value="<?= $item ? e($item['credential_url'] ?? '') : old('credential_url') ?>" />
  </div>

  <div class="form-group">
    <label class="form-label" for="image">Gambar Sertifikat</label>
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
      <label class="form-label"><input type="checkbox" name="is_active" value="1" <?= !$item || (int) $item['is_active'] === 1 ? 'checked' : '' ?> /> Aktif</label>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Simpan</button>
</form>
