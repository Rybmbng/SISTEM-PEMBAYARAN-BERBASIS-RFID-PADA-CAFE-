<!DOCTYPE html>
<html>
<head>
	<title>Rumah Singgah</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Riwayat Transaksi Harian.xls");
	?>
 
	<center>
		<h1>Laporan Harian <br/> Rumah Singgah</h1>
	</center>
 
	<table border="2">
		<tr>
		<th>#</th>
		<th>Customer</th>
		<th>Kode Transaksi</th>
		<th>Tanggal</th>
		<th>Total</th>
		</tr>
		<?php 
		// koneksi database
		$conn = mysqli_connect("localhost","root","","skripsi");
 
		$date = date("y-m-d");
                        	 $sql = mysqli_query($conn,"SELECT * FROM selesai WHERE tanggal = CURDATE()");
                            while ($data = mysqli_fetch_array($sql)){
								$fetch = mysqli_fetch_array(mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$data[username]'"));
							?>
		<tr>
		<th scope="row"><?php echo $data['no'] ?></th>
		<td><a href="?admin=detail_old&kd_transaksi=<?php echo $data['kd_transaksi'] ?>"><?php echo ucwords($fetch['nama_lengkap']) ?></a></td>
		<td><?php echo $data['kd_transaksi'] ?></td>
		<td><?php echo $data['tanggal'] ?></td>
		<td>Rp.<?php echo $data['total'] ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
</body>
</html>