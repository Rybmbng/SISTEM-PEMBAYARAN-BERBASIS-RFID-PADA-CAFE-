<?php
            error_reporting(0);
            session_start();
            
            include_once 'controller/config.php';
             if(!isset($_SESSION['username'])){
              echo "<script>window.location.href = 'pendatang.php'</script>";
            }
            
            $conn = mysqli_connect("localhost","root","","skripsi");
            $sql = "SELECT * FROM tb_kategori";
            $result = mysqli_query($conn, $sql);

            
            $sqld = mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$_SESSION[username]'");
            $data = mysqli_fetch_array($sqld);
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
    <link rel="icon" type="image/png" c href="assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/icon/site.webmanifest">
  </style>
    <meta name="theme-color" content="#ffffff">
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="assets_pelanggan/css/theme.css" rel="stylesheet" />
  </head>
  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light bg-primary p-1" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand d-inline-flex" href="?pelanggan="><img class="d-inline-block" src="assets/icon/logo.png"  height='45px' width='40px' alt="logo" /><span class="text-1000 fs-3 fw-bold ms-2 text-gradient">Rumah Singgah Rey</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 my-2 mt-lg-0" id="navbarSupportedContent">

            <div class="mx-auto pt-5 pt-lg-0 d-block d-lg-none d-xl-block">

            </div>
            <form class="d-flex mt-4 mt-lg-0 ms-lg-auto ms-xl-0">
            <span class="nav-item mx-2">
              <a class="nav-link text-dark h5" href="?pelanggan=keranjang" ><i class="fas fa-store-alt-slash	"></i></a>
            </span>
            <span class="nav-item mx-2">
              <a class="nav-link text-dark h5" href="?pelanggan=belanja"><i class="fab fa-opencart"></i></a>
            </span>
            <span class="nav-item mx-2">
              <a class="nav-link text-dark h5" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </span>
            <span class="d-md-block ps-2">
            <a href="#"><img src="assets/profile/<?php echo $data['gambar'] ?>"  height='50px' width='50px'  style="border-radius:70px" ></i></a>
            </span>
            
            </form>
            
          </div>
        </div>
      </nav>
    </main>

    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

<?php include_once'controller/pagepelanggan.php'?>


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="assets_pelanggan/vendors/@popperjs/popper.min.js"></script>
    <script src="assets_pelanggan/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="assets_pelanggan/vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="assets_pelanggan/vendors/fontawesome/all.min.js"></script>
    <script src="assets_pelanggan/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&amp;display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </body>

</html>
