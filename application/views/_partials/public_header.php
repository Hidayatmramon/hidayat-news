<?php
  $CI =& get_instance();
  $isLoggedIn = (bool) $CI->session->userdata('user_id');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= isset($title)?htmlspecialchars($title):'Hidayatnews' ?></title>
  <meta name="description" content="<?= !empty($meta['description']) ? htmlspecialchars($meta['description']) : '' ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="<?= base_url('public/logo/icon.png') ?>">
  <meta name="theme-color" content="#030303">
  <link rel="icon" type="image/png" href="<?= base_url('public/logo/icon.png') ?>" sizes="16x16" />

  <meta property="og:site_name" content="Hidayatnews">
  <meta property="og:title" content="<?= isset($title)?htmlspecialchars($title):'Hidayatnews' ?>">
  <meta property="og:description" content="<?= !empty($meta['description']) ? htmlspecialchars($meta['description']) : '' ?>">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="<?= !empty($meta['image']) ? $meta['image'] : base_url('public/front/images/og-default.jpg') ?>">
  <meta name="twitter:card" content="summary_large_image">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300,1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300,1,400&display=swap" rel="stylesheet">

  <link href="<?= front_asset('css/styles.css') ?>" rel="stylesheet">
</head>
<body>
<?php $asset = base_url('public/front/'); ?>

<div class="loading-container">
  <div class="h-100 d-flex align-items-center justify-content-center">
    <ul class="list-unstyled">
      <li><img src="<?= $asset ?>images/loading.png" alt="Loading" height="100"></li>
      <li>
        <div class="spinner">
          <div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div>
        </div>
      </li>
      <li><p>Loading</p></li>
    </ul>
  </div>
</div>

<header class="bg-light">
  <!-- Top bar -->
  <div class="topbar d-none d-sm-block">
    <div class="container ">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <div class="topbar-left">
            <div class="topbar-text">
              <?= date('l, F d, Y') ?>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-7">
          <div class="list-unstyled topbar-right">
            <ul class="topbar-link">
							<?php if ($isLoggedIn): ?>
								<li><a href="<?= site_url('dashboard') ?>" title="">Dashboard</a></li>
							<?php else: ?>
								<li><a href="<?= site_url('login') ?>" title="">Log in / Register</a></li>
							<?php endif; ?>
            </ul>
            <ul class="topbar-sosmed">
              <li><a href="https://github.com/Hidayatmramon" aria-label="GitHub"><i class="fa fa-github"></i></a></li>
              <li><a href="https://www.linkedin.com/in/ramon-hidayat/" aria-label="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="https://www.hidayatmramon.com" aria-label="Website"><i class="fa fa-globe"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End top bar -->

  <!-- Navbar -->
  <div class="navigation-wrap navigation-shadow bg-white">
    <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
      <div class="container">
        <div class="offcanvas-header">
          <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
            <span class="navbar-toggler-icon"></span>
          </div>
        </div>
        <figure class="mb-0 mx-auto">
          <a href="<?= site_url('home') ?>" aria-label="Hidayatnews Home">
            <img src="<?= base_url('public/logo/logo.png') ?>" alt="Hidayatnews" class="img-fluid logo">
          </a>
        </figure>
        <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
          <div class="top-search navigation-shadow">
            <div class="container">
              <div class="input-group">
                <form action="<?= site_url('search') ?>" method="get" role="search" aria-label="Site search">
                  <div class="row no-gutters mt-3">
                    <div class="col">
                      <input class="form-control border-secondary border-right-0 rounded-0"
                             type="search" name="q" placeholder="Search">
                    </div>
                    <div class="col-auto">
                      <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit" aria-label="Search">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->

</header>
