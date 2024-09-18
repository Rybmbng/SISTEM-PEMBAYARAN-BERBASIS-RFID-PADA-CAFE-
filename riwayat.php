<?php 
session_start();
error_reporting(0);

if(!isset($_SESSION['username'])){
  header(location:'login.php');
}

include 'controller/config.php';  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include_once 'template/style.php' ?>
  </head>
  <body>
    <div class="container-scroller"> 
      <?php include_once 'template/navbar.php'; ?>
      <div class="container-fluid page-body-wrapper">
        <?php include_once 'template/sidebar.php'; ?>
        <div class="main-panel">
          <div class="content-wrapper">
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
<form method="get" action="riwayat.php">
			<label>PILIH TANGGAL</label>
			<input type="date" name="tanggal">
			<input type="submit">
		</form>
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
                          	<?php
							if(isset($_GET['tanggal'])){
								$tgl = $_GET['tanggal'];
								$sql = mysqli_query($conn,"SELECT * FROM selesai where tanggal='$tgl'");
                if($tgl==''){
                  $sql = mysqli_query($conn,"SELECT * FROM selesai ");
                }
							}else{
								$sql = mysqli_query($conn,"SELECT * FROM selesai");
							}
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
                        <?php } ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

    </section>
	</div>     
	 <a class="btn btn-primary"target="_blank" href="export.php">Cetak Laporan </a>

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
	</div>
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © 2023</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> <b>Rumah</b> Singgah</span>
            </div>
          </footer>
        </div>
       </div>
    </div>


    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
 </body>
</html>