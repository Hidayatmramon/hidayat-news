<?php 
$title='Edit Profile'; $this->load->view('_partials/dashboard_header', compact('title')); ?>

<div class="card s7__card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0"></h5>
    <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-light btn-sm">
      <i class="las la-arrow-left me-1"></i> Dashboard
    </a>
  </div>

  <div class="card-body">
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger"><?= $errors ?></div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data" class="row g-3">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

      <div class="col-lg-8">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="fullname" class="form-control" required value="<?= htmlspecialchars($user->fullname) ?>">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required minlength="3" value="<?= htmlspecialchars($user->username) ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user->email) ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">New Password (optional)</label>
            <input type="password" name="new_password" class="form-control" minlength="6" placeholder="Leave blank if not changing">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="new_password_confirm" class="form-control" minlength="6" placeholder="Repeat new password">
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <label class="form-label">Profile Photo</label>
        <div class="border rounded p-2 text-center mb-2">
          <img id="avatarPreview" src="<?= avatar_url($user->avatar ?? null) ?>" alt="avatar preview" style="max-height:160px;max-width:100%;border-radius:10px;">
        </div>
        <div class="mb-2">
          <input type="file" name="avatar" id="avatar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
          <small class="text-muted d-block mt-1">Max 4MB. Types: jpg, jpeg, png, gif, webp</small>
        </div>
        <?php if (!empty($user->avatar)): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="remove_avatar" id="remove_avatar">
          <label class="form-check-label" for="remove_avatar">Remove profile photo</label>
        </div>
        <?php endif; ?>
      </div>

      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary"><i class="fas fa-save me-1"></i> Save</button>
        <a class="btn btn-secondary" href="<?= site_url('dashboard') ?>">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
// preview
document.getElementById('avatar')?.addEventListener('change', function(){
  const [f] = this.files || [];
  if (!f) return;
  const url = URL.createObjectURL(f);
  const img = document.getElementById('avatarPreview');
  img.src = url;
  img.onload = () => URL.revokeObjectURL(url);
});
</script>

<?php $this->load->view('_partials/dashboard_footer'); ?>
