<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo isset($title) ? $title : 'Feedback'; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/landing/css/bootstrap/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/landing/css/fontawesome/css/all.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/gradient-theme.css'); ?>">
</head>
<body class="gradient-surface">
	<nav class="navbar navbar-expand-lg gradient-header shadow-sm">
		<div class="container">
			<a class="navbar-brand text-white font-weight-bold" href="<?php echo base_url(); ?>">Penggajian</a>
			<div class="collapse navbar-collapse show">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('team'); ?>">Team</a></li>
					<li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('penggajian'); ?>">Penggajian</a></li>
					<li class="nav-item">
						<button class="theme-toggle border-0" data-theme-toggle type="button">
							<i class="fa fa-adjust text-white"></i>
							<span class="text-white">Dark</span>
						</button>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="container py-5 fade-in">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="gradient-card">
					<h3 class="font-weight-bold mb-4">Kritik & Saran</h3>
					<form action="<?php echo base_url('feedback/submit'); ?>" method="POST">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required value="<?php echo set_value('nama'); ?>">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" class="form-control" required value="<?php echo set_value('email'); ?>">
						</div>
						<div class="form-group">
							<label for="pesan">Pesan</label>
							<textarea name="pesan" id="pesan" rows="4" class="form-control" required><?php echo set_value('pesan'); ?></textarea>
						</div>
						<button type="submit" class="btn btn-gradient btn-block">Kirim Pesan</button>
					</form>
				</div>
			</div>
			<div class="col-lg-5 mt-4 mt-lg-0">
				<div class="gradient-card">
					<h4 class="font-weight-bold mb-3">Masukan Terbaru</h4>
					<?php if (!empty($feedbacks)): ?>
						<?php foreach ($feedbacks as $item): ?>
							<div class="mb-3">
								<h6 class="mb-0"><?php echo $item->nama; ?> <small class="text-muted"><?php echo date('d M Y', strtotime($item->created_at)); ?></small></h6>
								<p class="text-muted small mb-1"><?php echo $item->email; ?></p>
								<p><?php echo $item->pesan; ?></p>
								<hr>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="text-muted">Belum ada masukan terbaru.</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<footer class="py-4 gradient-footer text-center">
		<p class="mb-0">© <?php echo date('Y'); ?> PT Mahakarya Kelompok 1. All rights reserved.</p>
	</footer>

	<script src="<?php echo base_url('assets/landing/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/landing/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/theme.js'); ?>"></script>
	<?php if ($toast = $this->session->flashdata('toast')): ?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			showToast('<?php echo addslashes($toast['message']); ?>', '<?php echo $toast['type']; ?>');
		});
	</script>
	<?php endif; ?>
</body>
</html>

