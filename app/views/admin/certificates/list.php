<?php /** @var array $certificates @var string|null $flash */ ?>
<div class="admin-head">
  <h1 class="admin-title">Sertifikat</h1>
  <a class="btn btn-primary" href="<?= url('/admin/sertifikat/create') ?>">+ Tambah Sertifikat</a>
</div>

<?php if ($flash): ?>
  <div class="alert alert-success"><?= e($flash) ?></div>
<?php endif; ?>

<div class="table-wrap">
  <table class="data-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Aktif</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($certificates as $cert): ?>
      <tr>
        <td class="mono">#<?= (int) $cert['id'] ?></td>
        <td>
          <?php if ($cert['image']): ?>
            <img class="thumb" src="<?= e($cert['image']) ?>" alt="" />
          <?php else: ?>
            <span class="dim">—</span>
          <?php endif; ?>
        </td>
        <td><strong><?= e($cert['title']) ?></strong></td>
        <td><?= e($cert['issuer']) ?></td>
        <td class="mono"><?= e($cert['year']) ?></td>
        <td><?= (int) $cert['is_active'] === 1 ? '✔' : '✖' ?></td>
        <td>
          <div class="row-actions">
            <a class="btn btn-ghost btn-sm" href="<?= url('/admin/sertifikat/edit/' . $cert['id']) ?>">Edit</a>
            <form method="post" action="<?= url('/admin/sertifikat/delete') ?>" onsubmit="return confirm('Hapus sertifikat ini?')">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $cert['id'] ?>" />
              <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (!$certificates): ?>
      <tr><td colspan="7" class="dim">Belum ada sertifikat.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
