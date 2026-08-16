<?php /** @var string|null $error */ ?>
<div class="admin-login-wrap">
  <div class="terminal admin-login-card">
    <div class="terminal-bar">
      <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
      <span class="terminal-title mono">ihsan@homelab: ~/admin/login</span>
    </div>
    <form class="terminal-body" method="post" action="<?= url('/admin/login') ?>">
      <?= csrf_field() ?>
      <h1 class="admin-login-title mono">admin login</h1>
      <?php if ($error): ?>
        <p class="alert alert-error"><?= e($error) ?></p>
      <?php endif; ?>
      <div class="form-group">
        <label class="form-label mono" for="username">$ username</label>
        <input class="form-input mono" type="text" id="username" name="username" autocomplete="username" required autofocus />
      </div>
      <div class="form-group">
        <label class="form-label mono" for="password">$ password</label>
        <input class="form-input mono" type="password" id="password" name="password" autocomplete="current-password" required />
      </div>
      <button class="btn btn-primary" type="submit">[ login ]</button>
    </form>
  </div>
</div>
