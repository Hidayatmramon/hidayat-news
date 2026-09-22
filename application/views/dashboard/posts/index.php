<?php 
$title='Content Management'; $this->load->view('_partials/dashboard_header', compact('title')); ?>
<style>
  .s7__card{border-radius:12px;overflow:hidden;background:transparent}
  .s7__card .card-header{background:transparent;border-bottom:1px solid rgba(255,255,255,.06)}
  .s7__table thead th{background:#0f1538;color:#9fb3c8;border:0;text-transform:uppercase;font-size:.75rem;letter-spacing:.02em}
  .s7__table td,.s7__table th{vertical-align:middle}
  .s7__table tbody tr{border-color:rgba(255,255,255,.06)}
  .badge-soft{border:1px solid transparent;padding:.35rem .5rem;font-weight:600;border-radius:.5rem}
  .badge-soft-primary{color:#5c7cfa;background:rgba(92,124,250,.12);border-color:rgba(92,124,250,.2)}
  .badge-soft-info{color:#4dabf7;background:rgba(77,171,247,.12);border-color:rgba(77,171,247,.2)}
  .badge-soft-success{color:#21d375;background:rgba(33,211,117,.12);border-color:rgba(33,211,117,.2)}
  .badge-soft-secondary{color:#adb5bd;background:rgba(173,181,189,.12);border-color:rgba(173,181,189,.2)}
  .btn-outline-light{border-color:rgba(255,255,255,.2);color:#e9ecf1}
  .btn-outline-light:hover{background:#1b254b}
  .mono{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}

  /* header tools */
  .s7__tools .s7__nav-search-form{position:relative;max-width:320px}
  .s7__tools .s7__nav-search-form input{
    height:38px;border-radius:10px;outline:0;background-color:transparent;
    border:1px solid rgba(255,255,255,.15);color:#e9ecf1;padding:0 40px 0 12px
  }
  .s7__tools .s7__nav-search-form input::placeholder{color:#9fb3c8}
  .s7__tools .s7__nav-search-form button{
    position:absolute;right:6px;top:50%;transform:translateY(-50%);
    background:transparent;border:0;color:#98a6ad
  }
  .s7__btn-icon{padding:.35rem .6rem;border-radius:.5rem}

  .theme-dark .table-hover tbody tr:hover,
  .theme-dark .table-hover tbody tr:hover td{
    color:#e9ecf1 !important;
    background-color:rgba(255,255,255,.04) !important;
  }
</style>
<div class="card s7__card">
  <div class="card-header">
    <div class="row g-2 align-items-center s7__tools">
      <div class="col-md-6">
      </div>
      <div class="col-md-6">
        <div class="d-flex justify-content-md-end flex-wrap gap-2">
          <form method="get" class="d-inline-block me-2">
            <div class="s7__nav-search-form">
              <input type="text" name="q" value="<?= htmlspecialchars($q ?? '') ?>" placeholder="Search title/slug...">
              <button type="submit" title="Search"><i class="fas fa-search"></i></button>
            </div>
          </form>
          <?php if (!empty($q)): ?>
            <a class="btn btn-link text-muted me-2" href="<?= site_url('posts') ?>">Reset</a>
          <?php endif; ?>
          <a href="<?= site_url('posts/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> New Post
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="card-body">
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
      <table class="table s7__table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th style="width:80px">ID</th>
            <th style="width:70px">Image</th>
            <th>Title</th>
            <th>Slug</th>
            <th style="width:120px">Status</th>
            <th style="width:180px">Published At</th>
            <th style="width:140px">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($posts)): foreach ($posts as $p): ?>
          <tr>
            <td>#<?= (int)$p->id ?></td>
            <td>
              <?php if (!empty($p->image)): ?>
                <img src="<?= base_url(thumb_path($p->image)) ?>" alt="" style="height:38px" class="rounded border">
              <?php else: ?>
                <span class="text-muted">-</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($p->title) ?></td>
            <td class="mono small"><?= htmlspecialchars($p->slug) ?></td>
            <td>
              <?php if (($p->status ?? '') === 'published'): ?>
                <span class="badge-soft badge-soft-success">published</span>
              <?php else: ?>
                <span class="badge-soft badge-soft-secondary"><?= htmlspecialchars($p->status ?? 'draft') ?></span>
              <?php endif; ?>
            </td>
            <td class="mono"><?= $p->published_at ? htmlspecialchars($p->published_at) : '-' ?></td>
            <td>
              <a href="<?= site_url('posts/edit/'.(int)$p->id) ?>" class="btn btn-outline-light btn-sm s7__btn-icon me-1" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <a href="<?= site_url('posts/delete/'.(int)$p->id) ?>"
                 class="btn btn-outline-light btn-sm s7__btn-icon"
                 onclick="return confirm('Delete this post?')"
                 title="Delete">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center text-muted p-4">No data yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if (!empty($pagination)): ?>
      <div class="px-2 py-3 border-top mt-3" style="border-color:rgba(255,255,255,.06)!important">
        <?= $pagination ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php $this->load->view('_partials/dashboard_footer'); ?>
