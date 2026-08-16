<?php /** @var array|null $item @var array|null $errors */
$action = $item ? '/admin/skill/update' : '/admin/skill/store';
$title  = $item ? 'Edit Skill' : 'Tambah Skill';
$groups = ['💻 Backend', '🐧 Infrastructure', '🌐 Networking', '☁️ DevOps & Cloud'];
?>
<div class="admin-head">
  <h1 class="admin-title"><?= $title ?></h1>
  <a class="btn btn-ghost" href="<?= url('/admin/skill') ?>">← Kembali</a>
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

<form class="admin-form" method="post" action="<?= url($action) ?>">
  <?= csrf_field() ?>
  <?php if ($item): ?><input type="hidden" name="id" value="<?= (int) $item['id'] ?>" /><?php endif; ?>

  <div class="form-group">
    <label class="form-label" for="group_name">Kelompok *</label>
    <select class="form-input" id="group_name" name="group_name" required>
      <?php foreach ($groups as $group): ?>
        <option value="<?= e($group) ?>" <?= $item && $item['group_name'] === $group ? 'selected' : '' ?>><?= e($group) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="name">Nama Skill *</label>
    <input class="form-input" type="text" id="name" name="name" value="<?= $item ? e($item['name']) : old('name') ?>" placeholder="Docker" required />
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
