<?php /** @var array $messages @var string|null $flash */ ?>
<div class="admin-head">
  <h1 class="admin-title">Pesan Masuk</h1>
  <span class="mono admin-sub"><?= (int) count($messages) ?> pesan</span>
</div>

<?php if ($flash): ?>
  <div class="alert alert-success"><?= e($flash) ?></div>
<?php endif; ?>

<?php if ($messages): ?>
  <?php foreach ($messages as $msg): ?>
    <div class="message-card <?= (int) $msg['is_read'] === 0 ? 'unread' : '' ?>">
      <div class="message-head">
        <div>
          <strong><?= e($msg['name']) ?></strong>
          <span class="dim mono"> &lt;<?= e($msg['email']) ?>&gt;</span>
          <?php if ((int) $msg['is_read'] === 0): ?>
            <span class="tag tag-accent">baru</span>
          <?php endif; ?>
        </div>
        <span class="mono dim"><?= e($msg['created_at']) ?></span>
      </div>
      <h3 class="message-subject"><?= e($msg['subject']) ?></h3>
      <p class="message-body"><?= nl2br(e($msg['message'])) ?></p>
      <div class="row-actions">
        <?php if ((int) $msg['is_read'] === 0): ?>
          <form method="post" action="<?= url('/admin/pesan/read') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= (int) $msg['id'] ?>" />
            <button class="btn btn-ghost btn-sm" type="submit">Tandai dibaca</button>
          </form>
        <?php endif; ?>
        <form method="post" action="<?= url('/admin/pesan/delete') ?>" onsubmit="return confirm('Hapus pesan ini?')">
          <?= csrf_field() ?>
          <input type="hidden" name="id" value="<?= (int) $msg['id'] ?>" />
          <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p class="dim">Belum ada pesan masuk.</p>
<?php endif; ?>
