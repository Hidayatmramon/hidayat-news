<?php
  $username = htmlspecialchars($this->session->userdata('username'));
  $CI =& get_instance();
  $CI->load->model('User_model');
  $me = $CI->User_model->get((int)$CI->session->userdata('user_id'));
  $avatarSmall = function_exists('avatar_url') ? avatar_url($me->avatar ?? null) : base_url('public/backend/images/profile-default.png');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= isset($title)?htmlspecialchars($title):'Dashboard' ?> | Hidayatnews</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('public/logo/icon.png') ?>" sizes="16x16" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/vendor/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/line-awesome.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/all.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/vendor/simplebar.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/vendor/dropzone.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/vendor/bootstrap-toggle.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/vendor/select2.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/main.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/bootoast/toastr.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/custom.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('public/backend/css/vendor/datepicker.min.css') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= base_url('public/backend/css/vendor/datatables.min.css') ?>" />

  <style>
	:root{
  --s7-bg: #121a3e;
  --s7-bg-soft: #0f1538;
  --s7-border: rgba(255,255,255,.06);
  --s7-text: #e9ecf1;
  --s7-muted: #9fb3c8;
  --s7-outline: rgba(255,255,255,.15);
}

/* Card */
.theme-dark .card.s7__card{
  background: var(--s7-bg) !important;
  color: var(--s7-text) !important;
  border: 0 !important;
  border-radius: 14px !important;
  overflow: hidden;
}
.theme-dark .s7__card .card-header{
  background: transparent !important;
  border-bottom: 1px solid var(--s7-border) !important;
}

/* Table */
.theme-dark .s7__table{
  background: transparent;
}
.theme-dark .s7__table thead th{
  background: var(--s7-bg-soft) !important;
  color: var(--s7-muted) !important;
  border: 0 !important;
  text-transform: uppercase;
  font-size: .75rem;
  letter-spacing: .02em;
}
.theme-dark .s7__table td,
.theme-dark .s7__table th{
  vertical-align: middle;
  border-color: var(--s7-border) !important;
}
.theme-dark .table-hover.s7__table tbody tr:hover,
.theme-dark .table-hover.s7__table tbody tr:hover td{
  color: var(--s7-text) !important;
  background-color: rgba(255,255,255,.04) !important;
}

/* Badges */
.badge-soft{ border:1px solid transparent; padding:.35rem .5rem; font-weight:600; border-radius:.5rem }
.badge-soft-primary{ color:#5c7cfa; background:rgba(92,124,250,.12); border-color:rgba(92,124,250,.2) }
.badge-soft-info{ color:#4dabf7; background:rgba(77,171,247,.12); border-color:rgba(77,171,247,.2) }
.badge-soft-success{ color:#21d375; background:rgba(33,211,117,.12); border-color:rgba(33,211,117,.2) }
.badge-soft-secondary{ color:#adb5bd; background:rgba(173,181,189,.12); border-color:rgba(173,181,189,.2) }
.badge-soft-danger{ color:#ff6b6b; background:rgba(255,107,107,.12); border-color:rgba(255,107,107,.2) }

.theme-dark .s7__nav-search-form input,
.theme-dark .s7__filters .form-control,
.theme-dark .s7__filters .custom-select{
  height:38px; border-radius:10px; background:transparent; color:var(--s7-text);
  border:1px solid var(--s7-outline) !important;
}
.theme-dark .s7__nav-search-form input::placeholder{ color: var(--s7-muted) }
.theme-dark .s7__nav-search-form button{ color:#98a6ad }
.theme-dark .btn-outline-light{
  border-color: rgba(255,255,255,.2) !important; color: var(--s7-text) !important;
}
.theme-dark .btn-outline-light:hover{ background:#1b254b !important; }

/* DataTables harmonize */
.theme-dark .dataTables_wrapper .dataTables_length select,
.theme-dark .dataTables_wrapper .dataTables_filter input{
  background: transparent !important;
  border: 1px solid var(--s7-outline) !important;
  color: var(--s7-text) !important;
  border-radius: 10px; height: 38px;
}
.theme-dark .dataTables_wrapper .dataTables_paginate .page-link{
  background: transparent !important;
  border: 1px solid var(--s7-outline) !important;
  color: var(--s7-text) !important;
}
.theme-dark .dataTables_wrapper .dataTables_paginate .page-item.active .page-link{
  background: #1b254b !important; border-color:#1b254b !important;
}

    body { background:#0b1020; }
    .s7__nav.navbar-info { background:#121833; border-bottom:1px solid rgba(255,255,255,.06); }
    .s7__sidebar { background:#0f1530; }
    .s7__main { min-height: calc(100vh - 60px); }
    .s7__widget-three { background:#121a3e; color:#fff; border-radius:14px; padding:20px; display:flex; justify-content:space-between; align-items:center; }
    .s7__bg-primary{ background:#007bff!important;}
    .s7__bg-warning{ background:#ff9f43!important;}
    .s7__bg-success{ background:#00c851!important;}
    .card { background:#121a3e; border:0; border-radius:14px; color:#e9ecf1; }
    .card-header { border-bottom:1px solid rgba(255,255,255,.06); }
    .table thead th { color:#98a6ad; border-color:rgba(255,255,255,.08); }
    .table td, .table th { color:#e9ecf1; border-color:rgba(255,255,255,.08); }
  </style>
</head>

<body class="theme-dark">

	  <div class="preloader">
    <div class="preloader-icon-img">
      <img src="<?= base_url('public/backend/images/spinner.svg') ?>" alt="preloader spinner">
    </div>
  </div>

  <nav class="s7__nav navbar-info">
    <button type="button" class="sidebar-collapse-btn">
      <span class="line"></span>
    </button>
    <button type="button" class="sidebar-open-btn">
      <i data-feather="align-justify"></i>
    </button>

    <form class="s7__nav-search-form d-none d-md-block" onsubmit="return false;">
      <input type="search" name="navbar_search" id="navbar_search" autocomplete="off" aria-label="Search" placeholder="Search...">
      <button type="submit"><i data-feather="search"></i></button>
      <div id="navbar_search_area"><ul class="navbar_search_result"></ul></div>
    </form>

    <ul class="s7__nav-right">
      <li>
        <label id="switch" class="switch">
          <input type="checkbox" id="slider" onchange="toggleTheme()" checked>
          <span class="switch-icons">
            <i data-feather="moon"></i>
            <i data-feather="sun"></i>
          </span>
        </label>
      </li>

<li class="dropdown">
  <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center">
    <img src="<?= $avatarSmall ?>" alt="me" style="width:28px;height:28px;border-radius:50%;object-fit:cover" class="me-2">
    <i data-feather="chevron-down"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
    <li class="px-3 py-2 small">
      <div class="d-flex align-items-center">
        <img src="<?= $avatarSmall ?>" alt="me" style="width:36px;height:36px;border-radius:50%;object-fit:cover" class="me-2">
        <div>
          <div class="fw-semibold"><?= $username ?></div>
          <div class="text-muted">Signed in</div>
        </div>
      </div>
    </li>
    <li><hr class="dropdown-divider"></li>
    <li>
      <a class="dropdown-item d-flex align-items-center" href="<?= site_url('profile') ?>">
        <i data-feather="user" class="me-2"></i> Edit Profile
      </a>
    </li>
    <li>
      <a class="dropdown-item d-flex align-items-center" href="<?= site_url('logout') ?>">
        <i data-feather="log-out" class="me-2"></i> Logout
      </a>
    </li>
  </ul>
</li>
    </ul>
  </nav>

  <div class="body-area">
    <!-- SIDEBAR -->
    <aside class="s7__sidebar">
      <button type="button" class="sidebar-close-btn"><i class="las la-times-circle"></i></button>

      <div class="s7__logo">
        <a href="<?= site_url('dashboard') ?>" class="long-logo">
          <img src="<?= base_url('public/logo/logo3.png') ?>" alt="logo image">
        </a>
        <a href="<?= site_url('dashboard') ?>" class="short-logo-icon">
          <img class="cust-short-logo" src="<?= base_url('public/logo/icon.png') ?>" alt="logo image">
        </a>
      </div>

      <div class="s7__sidebar-nav-wrapper" data-simplebar>
        <ul class="s7__sidebar-nav" id="s7__sidebar-nav">

          <li>
            <a class="sidebar-link" target="_blank" href="<?= site_url() ?>">
              <span data-feather="globe" class="nav-icon"></span>
              <span class="s7__nav-caption">View Website</span>
            </a>
          </li>

          <li>
            <a class="sidebar-link <?= uri_string()==='dashboard'?'active':'' ?>" href="<?= site_url('dashboard') ?>">
              <span data-feather="home" class="nav-icon"></span>
              <span class="s7__nav-caption">Dashboard</span>
            </a>
          </li>

          <li class="s7__menu-title"><span>MANAGE NEWS</span></li>

          <li class="has-child">
            <a href="#" aria-expanded="false">
              <span data-feather="file-text" class="nav-icon"></span>
              <span class="s7__nav-caption">Content</span>
            </a>
            <ul class="s7__sub-nav" aria-expanded="false">
              <li><a class="sidebar-link" href="<?= site_url('posts') ?>"><span class="s7__nav-caption">Manage Content</span></a></li>
            </ul>
          </li>

          <?php if (function_exists('is_admin') && is_admin()): ?>
          <li class="has-child">
            <a href="#" aria-expanded="false">
              <span data-feather="users" class="nav-icon"></span>
              <span class="s7__nav-caption">Users</span>
            </a>
            <ul class="s7__sub-nav" aria-expanded="false">
              <li><a class="sidebar-link" href="<?= site_url('users') ?>"><span class="s7__nav-caption">Manage Users</span></a></li>
            </ul>
          </li>

          <li>
            <a class="sidebar-link <?= strpos(uri_string(),'logs')===0?'active':'' ?>" href="<?= site_url('logs') ?>">
              <span data-feather="shield" class="nav-icon"></span>
              <span class="s7__nav-caption">Login Logs</span>
            </a>
          </li>
          <?php endif; ?>

        </ul>
      </div>
    </aside>

    <main class="s7__main">
      <div class="s7__page-nav">
        <div class="left"><h6 class="title text-uppercase"><?= isset($title)?htmlspecialchars($title):'Dashboard' ?></h6></div>
      </div>

