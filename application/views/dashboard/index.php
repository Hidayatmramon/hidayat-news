<?php 
$title='Dashboard'; $this->load->view('_partials/dashboard_header', compact('title')); ?>

<div class="row gy-4 mb-4">
  <div class="col-lg-3 col-sm-6">
    <div class="s7__widget-three">
      <div class="content">
        <p class="mb-2">Total News</p>
        <h3 class="mb-0"><?= (int)$post_count ?></h3>
      </div>
      <div class="icon s7__bg-warning rounded-circle">
        <i class="las la-newspaper"></i>
      </div>
    </div>
  </div>

  <?php if (function_exists('is_admin') && is_admin()): ?>
  <div class="col-lg-3 col-sm-6">
    <div class="s7__widget-three">
      <div class="content">
        <p class="mb-2">Total Users</p>
        <h3 class="mb-0"><?= (int)$user_count ?></h3>
      </div>
      <div class="icon s7__bg-success rounded-circle">
        <i class="las la-users"></i>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<div class="row gy-4 mb-4">
  <div class="col-lg-3 col-sm-6">
    <a href="<?= site_url('posts/create') ?>" class="text-decoration-none">
      <div class="s7__widget-three s7__bg-primary text-white">
        <div class="content">
          <p class="mb-1">Add News</p>
          <h4 class="mb-0"><i class="las la-plus-square"></i></h4>
        </div>
      </div>
    </a>
  </div>

  <div class="col-lg-3 col-sm-6">
    <a href="<?= site_url('posts') ?>" class="text-decoration-none">
      <div class="s7__widget-three s7__bg-warning text-white">
        <div class="content">
          <p class="mb-1">Manage News</p>
          <h4 class="mb-0"><i class="las la-edit"></i></h4>
        </div>
      </div>
    </a>
  </div>

  <?php if (function_exists('is_admin') && is_admin()): ?>
  <div class="col-lg-3 col-sm-6">
    <a href="<?= site_url('users') ?>" class="text-decoration-none">
      <div class="s7__widget-three s7__bg-success text-white">
        <div class="content">
          <p class="mb-1">Manage Users</p>
          <h4 class="mb-0"><i class="las la-user-cog"></i></h4>
        </div>
      </div>
    </a>
  </div>
  <?php endif; ?>
</div>

<div class="card mb-4">
  <div class="card-header">
    <h5 class="mb-0">Posts by Month</h5>
  </div>
  <div class="card-body">
    <canvas id="productByCategory" height="100"></canvas>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5 class="mb-0">Latest News</h5>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Published</th>
            <th style="width:160px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($latest_posts as $p): ?>
            <tr>
              <td><?= htmlspecialchars($p->title) ?></td>
              <td><span class="badge badge-<?= $p->status==='published'?'success':'secondary' ?>"><?= $p->status ?></span></td>
              <td><?= $p->published_at ? htmlspecialchars($p->published_at) : '-' ?></td>
              <td>
                <a href="<?= site_url('posts/edit/'.$p->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="<?= site_url('posts/delete/'.$p->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus konten ini?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($latest_posts)): ?>
            <tr><td colspan="4" class="text-center text-muted p-3">No data.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php $this->load->view('_partials/dashboard_footer'); ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const labels = <?= json_encode(array_values($chart_labels ?? [])) ?>;
  const data   = <?= json_encode(array_values($chart_counts ?? [])) ?>;

  const ctx = document.getElementById('productByCategory').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'number of posts',
        data: data,
        backgroundColor: '#007bff'
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true, ticks: { precision:0 } } }
    }
  });
});
</script>
