<?php 
$title='Login Log Detail'; $this->load->view('_partials/dashboard_header', compact('title')); ?>

<style>
  .s7__card { border-radius:12px; overflow:hidden; }
  .s7__card .card-header{ background:transparent; border-bottom:1px solid rgba(255,255,255,.06); }
  .badge-soft { border:1px solid transparent; padding:.35rem .5rem; font-weight:600; }
  .badge-soft-success{ color:#21d375; background:rgba(33,211,117,.12); border-color:rgba(33,211,117,.2); }
  .badge-soft-danger{ color:#ff6b6b; background:rgba(255,107,107,.12); border-color:rgba(255,107,107,.2); }
  .badge-soft-secondary{ color:#adb5bd; background:rgba(173,181,189,.12); border-color:rgba(173,181,189,.2); }
  .mono{ font-family: ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace; }

  .theme-dark .list-group-item{
    background:#121a3e; color:#e9ecf1; border-color:rgba(255,255,255,.06);
  }
</style>

<?php
  $isProxy = (int)$log->is_proxy === 1;
  $flag = function_exists('flag_emoji') ? flag_emoji($log->country_code) : '';
?>

<div class="card s7__card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0"></h5>
    <div>
      <span class="badge <?= $log->status==='success'?'badge-soft-success':'badge-soft-secondary' ?>">
        <?= htmlspecialchars($log->status) ?>
      </span>
      <small class="text-muted ml-2"><?= htmlspecialchars($log->created_at) ?></small>
    </div>
  </div>

  <div class="card-body">
    <div class="alert <?= $isProxy ? 'alert-danger' : 'alert-success' ?> d-flex align-items-center" role="alert" style="border-radius:10px">
      <div class="mr-2" style="font-size:20px"><?= $isProxy ? '🔴' : '🟢' ?></div>
      <div>
        <strong>Status:</strong> <?= $isProxy ? 'Proxy/VPN Detected' : 'Clean (No Proxy/VPN)' ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <ul class="list-group">
          <li class="list-group-item">
            <strong>📌 IP Address</strong><br><span class="mono"><?= htmlspecialchars($log->ip) ?></span>
          </li>
          <li class="list-group-item">
            <strong>🛡️ Proxy / VPN</strong><br><?= $isProxy ? 'Yes (1)' : 'No (0)' ?>
          </li>
          <li class="list-group-item">
            <strong>🌍 Country</strong><br><?= ($flag ? $flag.' ' : '') . htmlspecialchars($log->country ?: '-') ?>
          </li>
          <li class="list-group-item">
            <strong>🏙 City / Region</strong><br><?= htmlspecialchars(trim(($log->city?:'-').($log->region? ', '.$log->region:''))) ?>
          </li>
        </ul>
      </div>
      <div class="col-md-6 mb-3">
        <ul class="list-group">
          <li class="list-group-item">
            <strong>🏢 ISP</strong><br><?= htmlspecialchars($log->isp ?: '-') ?>
          </li>
          <li class="list-group-item">
            <strong>🔢 ASN</strong><br><span class="mono"><?= htmlspecialchars($log->asn ?: ($log->as_name ?: '-')) ?></span>
          </li>
          <li class="list-group-item">
            <strong>👤 Identity / User ID</strong><br>
            <span class="mono"><?= htmlspecialchars($log->identity) ?></span>
            <?= $log->user_id ? ' <span class="badge badge-soft-secondary ml-1">#'.(int)$log->user_id.'</span>' : '' ?>
          </li>
          <li class="list-group-item">
            <strong>🌐 User-Agent</strong><br>
            <small class="mono"><?= htmlspecialchars($log->user_agent ?: '-') ?></small>
          </li>
        </ul>
      </div>
    </div>

    <a class="btn btn-outline-light mt-3" href="<?= site_url('logs') ?>">
      <i class="fas fa-arrow-left"></i> Back
    </a>
  </div>
</div>

<?php $this->load->view('_partials/dashboard_footer'); ?>
