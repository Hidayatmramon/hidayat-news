<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$siteKey = $siteKey ?? $this->config->item('recaptcha_site_key'); // fallback
$csrf_name = $this->security->get_csrf_token_name();
$csrf_hash = $this->security->get_csrf_hash();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Auth | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?= base_url('public/logo/icon.png') ?>">
	<script src="<?= base_url('public/login/assets/js/config.js') ?>"></script>
	<link href="<?= base_url('public/login/assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="app-style" />
	<link href="<?= base_url('public/plogin/assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
	<script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script>
	<style>
		.authentication-bg {
			background: #0b1020;
		}

		.card {
			border-radius: 12px;
			overflow: hidden;
		}

		.form-control {
			height: 44px;
		}

		.g-recaptcha>div {
			width: 100% !important;
		}

		.alert {
			border-radius: 8px;
		}

		.btn-soft-primary {
			font-weight: 600;
		}

	</style>
</head>

<body class="authentication-bg position-relative">
	<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xxl-8 col-lg-10">
					<div class="card overflow-hidden shadow">
						<div class="row g-0">
							<div class="col-lg-6 d-none d-lg-block p-2">
								<img src="<?= base_url('public/login/assets/images/blockwave-auth.jpg') ?>" alt=""
									class="img-fluid rounded h-100" style="object-fit: cover;">
							</div>
							<div class="col-lg-6">
								<div class="d-flex flex-column h-100">
									<div class="auth-brand p-4">
										<a class="logo-light">
											<img src="<?= base_url('public/logo/logo2.png') ?>" alt="logo" height="64">
										</a>
										<a class="logo-dark">
											<img src<?= '="'.base_url('public/logo/logo2.png').'"' ?> alt="dark logo"
												height="64">
										</a>
									</div>

									<div class="p-4 my-auto">
										<h4 class="fs-20 mb-1">Sign in</h4>
										<p class="text-muted mb-3">Masuk dengan username/email dan password.</p>

										<?php if ($this->session->flashdata('error')): ?>
										<div class="alert alert-danger">
											<?= htmlspecialchars($this->session->flashdata('error')) ?>
										</div>
										<?php endif; ?>

										<form method="post" action="<?= site_url('auth/login') ?>" novalidate>
											<input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>">
											<input type="hidden" name="client_ip" id="client_ip">

											<div class="mb-3">
												<label for="identity" class="form-label">Username / Email <span
														class="text-danger">*</span></label>
												<input class="form-control" type="text" id="identity" name="identity" required
													placeholder="Masukkan username atau email">
											</div>

											<div class="mb-2">
												<label for="password" class="form-label d-flex justify-content-between">
													<span>Password <span class="text-danger">*</span></span>
												</label>
												<input class="form-control" type="password" id="password" name="password" required
													placeholder="Masukkan password">
											</div>

											<?php if (!empty($siteKey)): ?>
											<div class="mb-3">
												<div class="g-recaptcha" data-sitekey="<?= htmlspecialchars($siteKey) ?>"></div>
											</div>
											<?php endif; ?>

											<div class="mb-0 text-start">
												<button class="btn btn-soft-primary w-100" type="submit">
													<i class="ri-login-circle-fill me-1"></i>
													<span class="fw-bold">Sign in</span>
												</button>
											</div>
										</form>
									</div>

								</div>
							</div> <!-- end col -->
						</div>
					</div>
				</div>
				<!-- end row -->
			</div>
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->

	<script src="<?= base_url('public/login/assets/js/vendor.min.js') ?>"></script>
	<script src="<?= base_url('public/login/assets/js/app.min.js') ?>"></script>
	<script>
		document.getElementById('client_ip').value = '<?= $this->input->ip_address(); ?>';

		(function () {
			var serverIp = '<?= $this->input->ip_address(); ?>';
			var isPrivate =
				serverIp === '::1' || serverIp === '127.0.0.1' ||
				/^10\./.test(serverIp) || /^192\.168\./.test(serverIp) || /^172\.(1[6-9]|2\d|3[0-1])\./.test(serverIp);

			if (isPrivate) {
				fetch('https://api.ipify.org?format=json')
					.then(function (r) {
						return r.json();
					})
					.then(function (d) {
						if (d && d.ip) document.getElementById('client_ip').value = d.ip;
					})
					.catch(function () {
					});
			}
		})();

	</script>
</body>

</html>
