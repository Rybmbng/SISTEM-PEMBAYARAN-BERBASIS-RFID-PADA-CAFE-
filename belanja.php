<?php
error_reporting(0);
include_once 'controller/config.php';
if(isset($_POST['checkout'])) {
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Panggil file CSS Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="assets_pelanggan/css/theme.css" rel="stylesheet" />
     <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

</head>
<body>
     
<section class="py-5 overflow-hidden bg-primary" id="home">
        <div class="container">
          <div class="row flex-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 mt-8 mt-md-0"><a class="img-landing-banner" href="#!"><img class="img-fluid" src="assets_pelanggan/img/cart.png" alt="hero-header" /></a></div>
            <div class="col-md-7 col-lg-6 py-8 text-md-start text-center">
              <h1 class="text-800 mb-5 fs-4">Terima Kasih Telah Singgah,<br class="d-none d-xxl-block" />Cek Pesanananmu Dibawah.</h1>
              
            </div>
          </div>
        </div>
      </section>
     
<div class="px-4 px-lg-0">
  <!-- For demo purpose -->
  <div class="container text-white py-5 text-center">
    <h1 class="display-4">STATUS BELANJA</h1>
   
   </div>
  <!-- End -->
  <form method="post">
  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Produk</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Harga</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Kuantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Total</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php
            $sql = mysqli_query($conn,"SELECT *FROM detail WHERE username='$_SESSION[username]'");
            while ($rs = mysqli_fetch_array($sql)){  
            $data = $rs['nama_menu'];
            $sqld = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$data'");
            $datas = mysqli_fetch_array($sqld);
            ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="assets/menu/<?php echo $datas['img']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?php echo $rs['nama_menu']; ?></a></h5>
                         </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>Rp. <?php echo $rs['harga']; ?></strong></td>              
                  <td class="border-0 align-middle"><strong><?php echo $rs['jumlah']; ?></strong></td>
                  <td class="border-0 align-middle"><strong>Rp. <?php echo $rs['jumlah_harga']; ?></strong></td>
                </tr>
                <?php
                $total += $rs['jumlah_harga']; 
                $pajak = $total * 0.1;
            }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-5">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Detail Order </div>
          <div class="p-4">
            <ul class="list-unstyled mb-4">
            <div class="text-center">               
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sub Total</strong><strong>Rp. <?php echo $total ?></strong>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Pajak</strong><strong>Rp. <?php echo $pajak ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong><strong>Rp. <?php echo $total-$pajak ?></strong>
              </li>
          </div>
        </div>
      </div>

    </div>
  </div>
  </form>
</div>
	<!-- Panggil file JavaScript Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>