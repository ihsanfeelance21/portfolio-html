<?php /** @var array $skills @var string|null $flash */ ?>
<div class="admin-head">
  <h1 class="admin-title">Skills</h1>
  <a class="btn btn-primary" href="<?= url('/admin/skill/create') ?>">+ Tambah Skill</a>
</div>

<?php if ($flash): ?>
  <div class="alert alert-success"><?= e($flash) ?></div>
<?php endif; ?>

<div class="table-wrap">
  <table class="data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Kelompok</th>
        <th>Nama Skill</th>
        <th>Aktif</th>
        <th>Urutan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($skills as $skill): ?>
      <tr>
        <td class="mono">#<?= (int) $skill['id'] ?></td>
        <td><span class="tag"><?= e($skill['group_name']) ?></span></td>
        <td><?= e($skill['name']) ?></td>
        <td><?= (int) $skill['is_active'] === 1 ? '✔' : '✖' ?></td>
        <td class="mono"><?= (int) $skill['sort_order'] ?></td>
        <td>
          <div class="row-actions">
            <a class="btn btn-ghost btn-sm" href="<?= url('/admin/skill/edit/' . $skill['id']) ?>">Edit</a>
            <form method="post" action="<?= url('/admin/skill/delete') ?>" onsubmit="return confirm('Hapus skill ini?')">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $skill['id'] ?>" />
              <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (!$skills): ?>
      <tr><td colspan="6" class="dim">Belum ada skill.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
