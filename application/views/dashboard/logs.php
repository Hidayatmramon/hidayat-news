<?php 
$title='Login Logs'; $this->load->view('_partials/dashboard_header', compact('title')); ?>

<style>
  .s7__card { border-radius:12px; overflow:hidden; }
  .s7__card .card-header { background: transparent; border-bottom:1px solid rgba(255,255,255,.06); }
  .theme-dark .s7__table thead th{
    background:#0f1538; color:#9fb3c8; border:0; text-transform:uppercase; font-size:.75rem; letter-spacing:.02em;
  }
  .s7__table td,.s7__table th{ vertical-align:middle; }
  .theme-dark .s7__table tbody tr{ border-color:rgba(255,255,255,.06); }
  .badge-soft { border:1px solid transparent; padding:.35rem .5rem; font-weight:600; }
  .badge-soft-success{ color:#21d375; background:rgba(33,211,117,.12); border-color:rgba(33,211,117,.2); }
  .badge-soft-danger{ color:#ff6b6b; background:rgba(255,107,107,.12); border-color:rgba(255,107,107,.2); }
  .badge-soft-secondary{ color:#adb5bd; background:rgba(173,181,189,.12); border-color:rgba(173,181,189,.2); }

  /* header filters */
  .s7__filters .s7__nav-search-form{ position:relative; max-width:320px; }
  .s7__filters .s7__nav-search-form input{
    height:38px; border-radius:10px; outline:0;
    background:transparent; border:1px solid rgba(255,255,255,.15); color:#e9ecf1; padding:0 40px 0 12px;
  }
  .s7__filters .s7__nav-search-form button{
    position:absolute; right:6px; top:50%; transform:translateY(-50%);
    background:transparent; border:0; color:#98a6ad;
  }
  .s7__filters .form-control, .s7__filters .custom-select{
    height:38px; border-radius:10px; background:transparent; color:#e9ecf1;
    border:1px solid rgba(255,255,255,.15);
  }
  .s7__filters .btn-outline-light{
    border-color:rgba(255,255,255,.2); color:#e9ecf1;
  }
  .s7__filters .btn-outline-light:hover{ background:#1b254b; }

  .mono{ font-family: ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace; }
</style>

<div class="card s7__card">
  <div class="card-header">
    <div class="row g-2 align-items-center s7__filters">
      <div class="col-md-6">
        <h5 class="mb-0"></h5>
      </div>
      <div class="col-md-6">
        <form class="d-flex justify-content-md-end flex-wrap gap-2" method="get">
          <div class="s7__nav-search-form me-2">
            <input type="text" name="q" value="<?= htmlspecialchars($filters['q'] ?? '') ?>" placeholder="Search identity/IP/ASN/ISP...">
            <button type="submit" title="Search"><i class="fas fa-search"></i></button>
          </div>
          <?php $fp = isset($filters['is_proxy']) ? (string)$filters['is_proxy'] : ''; ?>
          <?php $fs = isset($filters['status']) ? (string)$filters['status'] : ''; ?>
          <select name="is_proxy" class="custom-select me-2" style="max-width:160px">
            <option value=""  <?= $fp===''?'selected':'' ?>>Proxy: All</option>
            <option value="0" <?= $fp==='0'?'selected':'' ?>>Normal</option>
            <option value="1" <?= $fp==='1'?'selected':'' ?>>VPN/Proxy</option>
          </select>
          <select name="status" class="custom-select me-2" style="max-width:160px">
            <option value="" <?= $fs===''?'selected':'' ?>>Status: All</option>
            <option value="success" <?= $fs==='success'?'selected':'' ?>>Success</option>
            <option value="failed"  <?= $fs==='failed'?'selected':''  ?>>Failed</option>
          </select>
          <button class="btn btn-outline-light">Filter</button>
          <?php if (!empty($filters['q']) || $fp!=='' || $fs!==''): ?>
            <a class="btn btn-link text-muted ms-2" href="<?= site_url('logs') ?>">Reset</a>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>

  <div class="card-body p-0">
    <table class="table s7__table align-middle mb-0">
      <thead>
        <tr>
          <th>Time</th>
          <th>Identity</th>
          <th>User ID</th>
          <th>IP</th>
          <th>Proxy</th>
          <th>ASN</th>
          <th>ISP</th>
          <th>Location</th>
          <th>Status</th>
          <th width="90">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($logs)): foreach($logs as $r):
          $isPublic = function_exists('is_public_ip') ? is_public_ip($r->ip) : true;
          $flag = (function_exists('flag_emoji') && !empty($r->country_code)) ? flag_emoji($r->country_code).' ' : '';
        ?>
        <tr>
          <td><a class="text-decoration-none" href="<?= site_url('logs/'.$r->id) ?>"><?= htmlspecialchars($r->created_at) ?></a></td>
          <td class="mono"><?= htmlspecialchars($r->identity) ?></td>
          <td><?= $r->user_id ? (int)$r->user_id : '-' ?></td>
          <td class="mono">
            <?= htmlspecialchars($r->ip) ?>
            <?php if (!$isPublic): ?><span class="badge badge-soft-secondary ml-1">local</span><?php endif; ?>
          </td>
          <td>
            <?php if ((int)$r->is_proxy === 1): ?>
              <span class="badge badge-soft-danger">VPN/Proxy</span>
            <?php else: ?>
              <span class="badge badge-soft-success">Normal</span>
            <?php endif; ?>
          </td>
          <td class="mono"><?= htmlspecialchars($r->asn ?: ($r->as_name ?: '-')) ?></td>
          <td><?= htmlspecialchars($r->isp ?: ($r->as_name ?: '-')) ?></td>
          <td><?= $flag ?><?= htmlspecialchars(trim(($r->city? $r->city : '') . ($r->region ? ', '.$r->region : '')) ?: ($r->country ?: '-')) ?></td>
          <td>
            <span class="badge <?= $r->status==='success' ? 'badge-soft-success' : 'badge-soft-secondary' ?>">
              <?= htmlspecialchars($r->status) ?>
            </span>
          </td>
          <td>
            <a class="btn btn-sm btn-outline-light" href="<?= site_url('logs/'.$r->id) ?>">
              <i class="fas fa-eye"></i> Details
            </a>
          </td>
        </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="10" class="text-center text-muted p-4">No data yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if (!empty($pagination)): ?>
    <div class="px-4 py-3 border-top" style="border-color:rgba(255,255,255,.06)!important">
      <?= $pagination  ?>
    </div>
  <?php endif; ?>
</div>

<?php $this->load->view('_partials/dashboard_footer'); ?>
