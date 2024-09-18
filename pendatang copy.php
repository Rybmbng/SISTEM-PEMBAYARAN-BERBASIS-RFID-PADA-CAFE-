<?php
 $conn = mysqli_connect("localhost","root","","skripsi");
 $sql = "SELECT * FROM tb_kategori";
 $result = mysqli_query($conn, $sql);
	?>
    <!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Pelanggan | Rumah Singgah Rey</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
   
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/icon/site.webmanifest">

    <meta name="theme-color" content="#ffffff">
    
    <link href="assets_pelanggan/css/theme.css" rel="stylesheet" />
  </head>
  <body>

    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand d-inline-flex" href="?pelanggan="><img class="d-inline-block" src="assets_pelanggan/img/gallery/logo.svg" alt="logo" /><span class="text-1000 fs-3 fw-bold ms-2 text-gradient">Rumah Singgah Rey</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 my-2 mt-lg-0" id="navbarSupportedContent">
            <div class="mx-auto pt-5 pt-lg-0 d-block d-lg-none d-xl-block">
            </div>
            <form class="d-flex mt-4 mt-lg-0 ms-lg-auto ms-xl-0">
              <div class="input-group-icon pe-2"><i class="fas fa-search input-box-icon text-primary"></i>
                <input class="form-control border-0 input-box bg-100" type="search" placeholder="Search Food" aria-label="Search" />
              </div>
              </div>
              <div class="input-group-icon pe-2"><i class="input-box-icon text-primary"></i>
              <a href="login.php"><img src="assets/profile/anonim.jpg" alt="Profile" class="rounded-circle" style="height:60px;width:60px"></a>
              </div>
              <span class="d-md-block ps-2">Pendatang</span>
            </form>
          </div>
        </div>
      </nav>
    </main>
<?php include_once'controller/pagepelanggan.php'?>
    <script src="assets_pelanggan/vendors/@popperjs/popper.min.js"></script>
    <script src="assets_pelanggan/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="assets_pelanggan/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets_pelanggan/vendors/fontawesome/all.min.js"></script>
    <script src="assets_pelanggan/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&amp;display=swap" rel="stylesheet">
  </body>

</html>
