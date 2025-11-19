<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<style>
		body { font-family: 'Inter', Arial, sans-serif; color: #0d1b2a; }
		h1 { margin-bottom: 0; }
		table { width: 100%; border-collapse: collapse; margin-top: 24px; }
		th, td { border: 1px solid #c5d1eb; padding: 8px 12px; font-size: 14px; }
		th { background: #021b79; color: #fff; }
		td { text-align: center; }
	</style>
</head>
<body>
	<center>
		<h1>PT Mahakarya Kelompok 1</h1>
		<h3>Rekap Data Pegawai</h3>
		<hr style="width: 60%; border: 1px solid #021b79">
	</center>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama Pegawai</th>
				<th>Jenis Kelamin</th>
				<th>Jabatan</th>
				<th>Tanggal Masuk</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; foreach ($pegawai as $row): ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->nik; ?></td>
					<td><?php echo $row->nama_pegawai; ?></td>
					<td><?php echo $row->jenis_kelamin; ?></td>
					<td><?php echo $row->jabatan; ?></td>
					<td><?php echo date('d-m-Y', strtotime($row->tanggal_masuk)); ?></td>
					<td><?php echo $row->status; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<script>
		window.print();
	</script>
</body>
</html>

