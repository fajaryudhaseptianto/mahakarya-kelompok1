<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($title) ? $title : 'Penggajian'; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/landing/css/bootstrap/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/landing/css/fontawesome/css/all.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/gradient-theme.css'); ?>">
</head>
<body class="gradient-surface">
	<nav class="navbar navbar-expand-lg gradient-header shadow-sm">
		<div class="container">
			<a class="navbar-brand text-white font-weight-bold" href="<?php echo base_url(); ?>">Penggajian+</a>
			<div class="collapse navbar-collapse show">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('team'); ?>">Team</a></li>
					<li class="nav-item"><a class="nav-link text-white" href="<?php echo base_url('feedback'); ?>">Feedback</a></li>
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
		<div class="row">
			<div class="col-lg-4">
				<div class="gradient-card mb-4">
					<h4 class="font-weight-bold mb-3">Tambah Karyawan</h4>
					<form action="<?php echo base_url('penggajian/store_karyawan'); ?>" method="POST">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="posisi">Posisi</label>
							<input type="text" name="posisi" id="posisi" class="form-control" required>
						</div>
						<button type="submit" class="btn btn-gradient btn-block">Simpan Karyawan</button>
					</form>
				</div>
				<div class="gradient-card">
					<h4 class="font-weight-bold mb-3">Tambah Data Gaji & Perhitungan</h4>
					<form action="<?php echo base_url('penggajian/store_gaji'); ?>" method="POST">
						<div class="form-group">
							<label for="karyawan_id">Karyawan</label>
							<select name="karyawan_id" id="karyawan_id" class="form-control" required>
								<option value="">-- Pilih Karyawan --</option>
								<?php foreach ($karyawan as $person): ?>
									<option value="<?php echo $person->id; ?>"><?php echo $person->nama; ?> - <?php echo $person->posisi; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="jumlah_gaji">Gaji Pokok</label>
							<input type="number" name="jumlah_gaji" id="jumlah_gaji" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="tunjangan_makan">Tunjangan Makan</label>
							<input type="number" name="tunjangan_makan" id="tunjangan_makan" class="form-control" value="0" required>
						</div>
						<div class="form-group">
							<label for="tunjangan_transport">Tunjangan Transport</label>
							<input type="number" name="tunjangan_transport" id="tunjangan_transport" class="form-control" value="0" required>
						</div>
						<div class="form-group">
							<label for="potongan">Potongan</label>
							<input type="number" name="potongan" id="potongan" class="form-control" value="0" required>
						</div>
						<div class="form-group">
							<label for="tanggal">Tanggal</label>
							<input type="date" name="tanggal" id="tanggal" class="form-control" required>
						</div>
						<button type="submit" class="btn btn-gradient btn-block">Simpan Gaji</button>
					</form>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="gradient-card mb-4">
					<h4 class="font-weight-bold mb-3">Data Karyawan</h4>
					<div class="table-responsive table-modern">
						<table class="table mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Posisi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($karyawan as $index => $person): ?>
									<tr>
										<td><?php echo $index + 1; ?></td>
										<td><?php echo $person->nama; ?></td>
										<td><?php echo $person->posisi; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="gradient-card">
					<h4 class="font-weight-bold mb-3 d-flex justify-content-between align-items-center">
						<span>Data Gaji & Rincian Perhitungan</span>
						<span class="badge badge-pill badge-light text-primary">
							<i class="fa fa-calculator mr-1"></i>
							<?php
								$totalNominal = array_sum(array_map(function($item) {
									$base = isset($item->jumlah_gaji) ? (int)$item->jumlah_gaji : 0;
									$makan = isset($item->tunjangan_makan) ? (int)$item->tunjangan_makan : 0;
									$transport = isset($item->tunjangan_transport) ? (int)$item->tunjangan_transport : 0;
									$pot = isset($item->potongan) ? (int)$item->potongan : 0;
									$total = isset($item->total_gaji) ? (int)$item->total_gaji : ($base + $makan + $transport - $pot);
									return max(0, $total);
								}, $gaji));
								echo 'Total Bulan Ini : Rp '.number_format($totalNominal,0,',','.');
							?>
						</span>
					</h4>
					<div class="table-responsive table-modern">
						<table class="table mb-0">
							<thead>
								<tr>
									<th>#</th>
									<th>Karyawan</th>
									<th>Gaji Pokok</th>
									<th>T. Makan</th>
									<th>T. Transport</th>
									<th>Potongan</th>
									<th>Total Dibayarkan</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($gaji as $index => $row): ?>
									<tr>
										<?php
											$base = isset($row->jumlah_gaji) ? $row->jumlah_gaji : 0;
											$makan = isset($row->tunjangan_makan) ? $row->tunjangan_makan : 0;
											$transport = isset($row->tunjangan_transport) ? $row->tunjangan_transport : 0;
											$potongan = isset($row->potongan) ? $row->potongan : 0;
											$total = isset($row->total_gaji) ? $row->total_gaji : ($base + $makan + $transport - $potongan);
										?>
										<td><?php echo $index + 1; ?></td>
										<td>
											<strong><?php echo $row->nama; ?></strong><br>
											<small class="text-muted"><?php echo $row->posisi; ?></small>
										</td>
										<td>Rp <?php echo number_format($base, 0, ',', '.'); ?></td>
										<td>Rp <?php echo number_format($makan, 0, ',', '.'); ?></td>
										<td>Rp <?php echo number_format($transport, 0, ',', '.'); ?></td>
										<td>Rp <?php echo number_format($potongan, 0, ',', '.'); ?></td>
										<td class="font-weight-bold text-primary">Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
										<td><?php echo date('d M Y', strtotime($row->tanggal)); ?></td>
										<td>
											<button class="btn btn-sm btn-gradient edit-gaji"
											        data-id="<?php echo $row->id; ?>"
											        data-karyawan="<?php echo $row->karyawan_id; ?>"
											        data-jumlah="<?php echo $base; ?>"
											        data-makan="<?php echo $makan; ?>"
											        data-transport="<?php echo $transport; ?>"
											        data-potongan="<?php echo $potongan; ?>"
											        data-tanggal="<?php echo $row->tanggal; ?>">
												Edit
											</button>
											<a href="<?php echo base_url('penggajian/delete_gaji/'.$row->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="modalEditGaji" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method="POST" id="formEditGaji">
					<div class="modal-header">
						<h5 class="modal-title">Perbarui Gaji</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="edit_karyawan_id">Karyawan</label>
							<select name="karyawan_id" id="edit_karyawan_id" class="form-control" required>
								<?php foreach ($karyawan as $person): ?>
									<option value="<?php echo $person->id; ?>"><?php echo $person->nama; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="edit_jumlah_gaji">Gaji Pokok</label>
							<input type="number" name="jumlah_gaji" id="edit_jumlah_gaji" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="edit_tunjangan_makan">Tunjangan Makan</label>
							<input type="number" name="tunjangan_makan" id="edit_tunjangan_makan" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="edit_tunjangan_transport">Tunjangan Transport</label>
							<input type="number" name="tunjangan_transport" id="edit_tunjangan_transport" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="edit_potongan">Potongan</label>
							<input type="number" name="potongan" id="edit_potongan" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="edit_tanggal">Tanggal</label>
							<input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-gradient">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<footer class="py-4 gradient-footer text-center">
		<p class="mb-0">© <?php echo date('Y'); ?> PT Mahakarya Kelompok 1. All rights reserved.</p>
	</footer>

	<script src="<?php echo base_url('assets/landing/js/jquery.js'); ?>"></script>
	<script src="<?php echo base_url('assets/landing/js/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/theme.js'); ?>"></script>
	<script>
		$('.edit-gaji').on('click', function () {
			const id = this.dataset.id;
			$('#formEditGaji').attr('action', '<?php echo base_url('penggajian/update_gaji/'); ?>' + id);
			$('#edit_karyawan_id').val(this.dataset.karyawan);
			$('#edit_jumlah_gaji').val(this.dataset.jumlah);
			$('#edit_tunjangan_makan').val(this.dataset.makan);
			$('#edit_tunjangan_transport').val(this.dataset.transport);
			$('#edit_potongan').val(this.dataset.potongan);
			$('#edit_tanggal').val(this.dataset.tanggal);
			$('#modalEditGaji').modal('show');
		});
	</script>
	<?php if ($toast = $this->session->flashdata('toast')): ?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			showToast('<?php echo addslashes($toast['message']); ?>', '<?php echo $toast['type']; ?>');
		});
	</script>
	<?php endif; ?>
</body>
</html>

