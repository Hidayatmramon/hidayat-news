<?php 
$title='Edit Post'; $this->load->view('_partials/dashboard_header', compact('title')); ?>
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
    box-shadow:none;
    border-color:#3e5eff;
  }
  .form-select{
    background-image: var(--bs-form-select-bg-img);
    background-repeat: no-repeat;
    background-position: right .75rem center;
    background-size: 16px 12px;
    padding-right: 2.25rem;
    -webkit-appearance: none; -moz-appearance: none; appearance: none;
  }
  .theme-dark .form-select option{
    background:#0f1538;
    color:#e9ecf1;
  }
</style>
<div class="card s7__card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0"></h5>
    <a href="<?= site_url('posts') ?>" class="btn btn-outline-light btn-sm">
      <i class="las la-arrow-left me-1"></i> All Posts
    </a>
  </div>

  <div class="card-body">
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger"><?= $errors ?></div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data" class="row g-3">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

      <div class="col-lg-8">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input name="title" class="form-control" required value="<?= htmlspecialchars($post->title) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Slug (a-z0-9-)</label>
          <input name="slug" id="slug" class="form-control mono" required pattern="[a-z0-9\-]+" value="<?= htmlspecialchars($post->slug) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Body</label>
          <textarea id="mytextarea" name="body" rows="10" class="form-control" required><?= htmlspecialchars($post->body) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="draft" <?= $post->status==='draft'?'selected':'' ?>>draft</option>
            <option value="published" <?= $post->status==='published'?'selected':'' ?>>published</option>
          </select>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="mb-2">
          <label class="form-label">Current Image</label><br>
          <?php if (!empty($post->image)): ?>
            <img id="preview" src="<?= base_url(thumb_path($post->image)) ?>" alt="" class="rounded border mb-2" style="max-height:160px;max-width:100%;">
          <?php else: ?>
            <img id="preview" src="<?= base_url('public/backend/images/no-image.png') ?>" alt="" class="rounded border mb-2" style="max-height:160px;max-width:100%;">
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label class="form-label">Change Image (optional)</label>
          <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
          <small class="text-muted d-block mt-1">New upload will overwrite the old image.</small>
        </div>
      </div>

      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary"><i class="fas fa-save me-1"></i> Update</button>
        <a class="btn btn-secondary" href="<?= site_url('posts') ?>">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
// preview
document.getElementById('image')?.addEventListener('change', function(){
  const [f] = this.files || [];
  if (!f) return;
  const url = URL.createObjectURL(f);
  const img = document.getElementById('preview');
  img.src = url;
  img.onload = () => URL.revokeObjectURL(url);
});
</script>

<?php $this->load->view('_partials/dashboard_footer'); ?>
