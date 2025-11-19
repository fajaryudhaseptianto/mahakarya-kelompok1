<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo isset($title) ? $title : 'Team Owner'; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/landing/css/bootstrap/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/landing/css/fontawesome/css/all.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/gradient-theme.css'); ?>">
</head>
<body class="gradient-surface">
	<nav class="navbar navbar-expand-lg gradient-header shadow-sm">
		<div class="container">
			<a class="navbar-brand text-white font-weight-bold" href="<?php echo base_url(); ?>">Penggajian</a>
			<button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#teamNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="teamNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url(); ?>">Home</a></li>
					<li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('feedback'); ?>">Feedback</a></li>
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
		<div class="text-center mb-5">
			<h2 class="text-white font-weight-bold mb-3">Team Owner</h2>
			<p class="text-white-50 lead">Tim Mahakarya Kelompok 1 menghadirkan standar enterprise untuk solusi penggajian.</p>
		</div>
		<div class="team-grid">
			<?php
			$owners = [
				[
					'nama' => 'Fajar Yudha Septianto',
					'role' => 'Chief Executive Officer',
					'description' => 'Mengawal visi besar Mahakarya dan memastikan seluruh unit bergerak serempak.',
					'photo' => 'avatar.svg'
				],
				[
					'nama' => 'Taradika Putri Ramadhanita',
					'role' => 'Chief Operating Officer',
					'description' => 'Memastikan operasional payroll berjalan efisien dan memenuhi standar audit.',
					'photo' => 'administrator.svg'
				],
				[
					'nama' => 'Alifa Ilmi',
					'role' => 'Head of Finance',
					'description' => 'Menjaga kepatuhan finansial, analisis biaya, serta kontrol tunjangan karyawan.',
					'photo' => 'karyawan.svg'
				],
				[
					'nama' => 'Siti Aulia Alzahra',
					'role' => 'Product Manager',
					'description' => 'Menyelaraskan kebutuhan pengguna dengan roadmap fitur payroll Mahakarya.',
					'photo' => 'login.svg'
				],
				[
					'nama' => 'Desy Rahmawati',
					'role' => 'Lead UI/UX Designer',
					'description' => 'Membawa pengalaman visual premium khas perusahaan finance ke setiap layar.',
					'photo' => 'web.svg'
				],
			];
			foreach ($owners as $member): ?>
				<div class="team-card">
					<img src="<?php echo base_url('assets/img/'.$member['photo']); ?>" alt="<?php echo $member['nama']; ?>">
					<h5 class="font-weight-bold"><?php echo $member['nama']; ?></h5>
					<p class="text-muted mb-2"><?php echo $member['role']; ?></p>
					<p><?php echo $member['description']; ?></p>
					<div class="d-flex justify-content-center gap-3 mt-3">
						<a href="#" class="text-warning mx-2"><i class="fab fa-linkedin fa-lg"></i></a>
						<a href="#" class="text-warning mx-2"><i class="fab fa-instagram fa-lg"></i></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<footer class="py-4 gradient-footer text-center">
		<p class="mb-0">© <?php echo date('Y'); ?> PT Mahakarya Kelompok 1. All rights reserved.</p>
	</footer>

	<script src="<?php echo base_url('assets/landing/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/landing/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/theme.js'); ?>"></script>
</body>
</html>

