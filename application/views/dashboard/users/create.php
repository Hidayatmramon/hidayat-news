<?php
$title='Add User'; $this->load->view('_partials/dashboard_header', compact('title')); ?>

<style>
  .s7__card{border-radius:12px;overflow:hidden;background:transparent}
  .s7__card .card-header{background:transparent;border-bottom:1px solid rgba(255,255,255,.06)}
  .theme-dark .form-control,
  .theme-dark .form-select{
    background-color:transparent;
    color:#e9ecf1;
    border:1px solid rgba(255,255,255,.15);
  }
  .theme-dark .form-control:focus,
  .theme-dark .form-select:focus{
    box-shadow:none;border-color:#3e5eff;
  }
  .form-select{
    background-image: var(--bs-form-select-bg-img);
    background-repeat: no-repeat;
    background-position: right .75rem center;
    background-size: 16px 12px;
    padding-right: 2.25rem;
    -webkit-appearance: none; -moz-appearance: none; appearance: none;
  }
  .theme-dark .form-select option{ background:#0f1538; color:#e9ecf1; }
</style>

<div class="card s7__card">
  <div class="card-header"><h5 class="mb-0"></h5></div>
  <div class="card-body">
    <?php if (!empty($errors)): ?><div class="alert alert-danger"><?= $errors ?></div><?php endif; ?>

    <form method="post" action="">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Username</label>
          <input name="username" class="form-control" required minlength="3">
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required minlength="6">
          <small class="form-text text-muted">Min. 6 characters</small>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-select" required>
            <option value="editor">editor</option>
            <option value="admin">admin</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="active">active</option>
            <option value="inactive">inactive</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">UUID (optional)</label>
        <input type="text" name="uuid" class="form-control" placeholder="Auto-generated if left blank">
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-primary"><i class="fas fa-save me-1"></i> Save</button>
        <a href="<?= site_url('users') ?>" class="btn btn-outline-light">Cancel</a>
      </div>
    </form>
  </div>
</div>

<?php $this->load->view('_partials/dashboard_footer'); ?>
