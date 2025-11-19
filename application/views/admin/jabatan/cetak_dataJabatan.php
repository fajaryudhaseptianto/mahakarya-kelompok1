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
		<h3>Rekap Data Jabatan & Komponen Gaji</h3>
		<hr style="width: 60%; border: 1px solid #021b79">
	</center>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Jabatan</th>
				<th>Gaji Pokok</th>
				<th>Tunjangan Transport</th>
				<th>Uang Makan</th>
				<th>Total Kompensasi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; foreach ($jabatan as $row): ?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row->nama_jabatan; ?></td>
					<td>Rp <?php echo number_format($row->gaji_pokok,0,',','.'); ?></td>
					<td>Rp <?php echo number_format($row->tj_transport,0,',','.'); ?></td>
					<td>Rp <?php echo number_format($row->uang_makan,0,',','.'); ?></td>
					<td>Rp <?php echo number_format($row->gaji_pokok + $row->tj_transport + $row->uang_makan,0,',','.'); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<script>
		window.print();
	</script>
</body>
</html>

