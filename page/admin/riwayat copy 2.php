<?php
require_once 'date.php';
$period = isset($_GET['period']) ? $_GET['period'] : 'semua';
$data = getDataByPeriod($period);

?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Transaksi Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
          <li class="breadcrumb-item active">Selesai</li>
        </ol>
      </nav>
    </div>
<div class="card">
<div class="card-body">
<ul>
	
        <li><a href="?admin=riwayat">Semua</a></li>
        <li><a href="?admin=riwayat&period=hari">Hari Ini</a></li>
        <li><a href="?admin=riwayat&period=mingguan">Mingguan</a></li>
        <li><a href="?admin=riwayat&period=bulanan">Bulanan</a></li>
        <li><a href="?admin=riwayat&period=tahunan">Tahunan</a></li>
    </ul>
    <section class="section">
    <section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Customer</th>
						      <th>Kode Transaksi</th>
						      <th>Tanggal</th>
						      <th>Total</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php $no = 1;
						  foreach ($data as $row) : ?>
						    <tr>
						      <th scope="row"><?= $no++; ?>
						      <td><a href="?admin=detail_old&kd_transaksi=<?= $row['kd_transaksi']; ?>"><?= ucwords($row['username']); ?></a></td>
						      <td><?= $row['kd_transaksi']; ?></td>
							  <td><?= $row['tanggal']; ?></td>
							  <td>Rp.<?= $row['total']; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

    </section>
	</div>    
	 <a class="btn btn-primary"target="_blank" href="/<?php echo $url ?>">Cetak Laporan </a>

        </div>
        </div>
      </div>
	  
  </main><!-- End #main -->

  <?php if(@$_SESSION['sukses']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: '<?php echo $_SESSION['sukses']; ?>'
        })
        </script>
    <?php unset($_SESSION['sukses']); } ?>
   