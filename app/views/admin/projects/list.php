<?php /** @var array $projects @var string|null $flash */ ?>
<div class="admin-head">
  <h1 class="admin-title">Proyek</h1>
  <a class="btn btn-primary" href="<?= url('/admin/proyek/create') ?>">+ Tambah Proyek</a>
</div>

<?php if ($flash): ?>
  <div class="alert alert-success"><?= e($flash) ?></div>
<?php endif; ?>

<div class="table-wrap">
  <table class="data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Featured</th>
        <th>Aktif</th>
        <th>Urutan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($projects as $project): ?>
      <tr>
        <td class="mono">#<?= (int) $project['id'] ?></td>
        <td>
          <strong><?= e($project['title']) ?></strong>
          <br /><span class="dim mono">/proyek/<?= e($project['slug']) ?></span>
        </td>
        <td><?= (int) $project['is_featured'] === 1 ? '⭐' : '—' ?></td>
        <td><?= (int) $project['is_active'] === 1 ? '✔' : '✖' ?></td>
        <td class="mono"><?= (int) $project['sort_order'] ?></td>
        <td>
          <div class="row-actions">
            <a class="btn btn-ghost btn-sm" href="<?= url('/admin/proyek/edit/' . $project['id']) ?>">Edit</a>
            <form method="post" action="<?= url('/admin/proyek/delete') ?>" onsubmit="return confirm('Hapus proyek ini?')">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $project['id'] ?>" />
              <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (!$projects): ?>
      <tr><td colspan="6" class="dim">Belum ada proyek.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
