<?php
include 'controller/config.php';
// error_reporting(0);
session_start();
if(isset($_SESSION['username']) && ($_SESSION['level'])=='admin'){
  include 'admin.php';
}
if(isset($_SESSION['username']) && ($_SESSION['level'])=='kasir'){
  include 'kasir.php';
}
if(isset($_SESSION['username']) && ($_SESSION['level'])=='waiter'){
  include 'waiter.php';
}
if(isset($_SESSION['username']) && ($_SESSION['level'])=='koki'){
  include 'koki.php';
}
if(isset($_SESSION['username']) && ($_SESSION['level'])=='pelanggan'){
  include 'index.php';
}
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
$isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet")); 
$isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
$isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
$isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
$isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
$isIOS = $isIPhone || $isIPad; 

if($isIOS){ 
    $devices = 'iOS'; 
}elseif($isAndroid){ 
  $devices= 'ANDROID'; 
}elseif($isWin){ 
  $devices = 'WINDOWS'; 
} else{
  $devices = 'unknown';
}
  
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']  );
    $sql = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";
    $cekaktif = mysqli_query($conn, "SELECT *FROM status WHERE username='$username'");
    if($cekaktif->num_rows > 0){
      echo "<script> alert('AKUN SEDANG DIPAKAI') </script>";
    }else{
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $tanggal = date("Y-m-d H:i:s");
        $data = mysqli_fetch_assoc($result);
        if($data['level']=="admin"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "admin";
            mysqli_query($conn,"INSERT INTO status SET username='$_SESSION[username]',session='aktif',tanggal='$tanggal',devices='$devices'");
            $_SESSION["admin"] = 'Selamat Datang '. ucwords($username);

          }else
        if($data['level']=="waiter"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "waiter";
            mysqli_query($conn,"INSERT INTO status SET username='$_SESSION[username]',session='aktif',tanggal='$tanggal',devices='$devices'");
            $_SESSION["waiter"] = 'Selamat Datang '. ucwords($username);
        }else
        if($data['level']=="koki"){
          $_SESSION['username'] = $username;
          $_SESSION['level'] = "koki";
          mysqli_query($conn,"INSERT INTO status SET username='$_SESSION[username]',session='aktif',tanggal='$tanggal',devices='$devices'");
          $_SESSION["koki"] = 'Selamat Datang '. ucwords($username);
        }else
        if($data['level']=="kasir"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "kasir";
            mysqli_query($conn,"INSERT INTO status SET username='$_SESSION[username]',session='aktif',tanggal='$tanggal',devices='$devices'");
            $_SESSION["kasir"] = 'Selamat Datang '. ucwords($username);
        }else
        if($data['level']=="pelanggan"){
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "pelanggan";
            mysqli_query($conn,"INSERT INTO status SET username='$_SESSION[username]',session='aktif',tanggal='$tanggal',devices='$devices'");
            $_SESSION["pelanggan"] = 'Selamat Datang '. ucwords($username);
        }else{
            header("Location: login.php?pesan=error");        
        }
    }else{
      $_SESSION["gagal"] = 'Username Atau Password Salah';
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Rumah Singgah Rey</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/icon/site.webmanifest">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Vendor CSS Files -->
  <link href="assets_admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets_admin/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets_admin/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets_admin/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets_admin/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets_admin/css/style.css" rel="stylesheet">
</head>

<body>

<?php if(@$_SESSION['gagal']){ ?>
        <script>
          Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?php echo $_SESSION['gagal']; ?>'
        })
        </script>
    <?php unset($_SESSION['gagal']); } ?>
   
 
    <?php if(@$_SESSION['admin']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['admin']; ?>'
        }).then(function() {
         window.location = "home.php?admin=";
        });
        </script>
    <?php unset($_SESSION['admin']); } ?>
   
    <?php if(@$_SESSION['waiter']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['waiter']; ?>'
        }).then(function() {
         window.location = "home.php?waiter=";
        });
        </script>
    <?php unset($_SESSION['waiter']); } ?>
   
    <?php if(@$_SESSION['koki']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['koki']; ?>'
        }).then(function() {
         window.location = "home.php?koki=";
        });
        </script>
    <?php unset($_SESSION['koki']); } ?>
   
    <?php if(@$_SESSION['kasir']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['kasir']; ?>'
        }).then(function() {
         window.location = "home.php?admin=";
        });
        </script>
    <?php unset($_SESSION['kasir']); } ?>
   
    <?php if(@$_SESSION['pelanggan']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['pelanggan']; ?>'
        }).then(function() {
         window.location = "index.php?pelanggan=";
        });
        </script>
    <?php unset($_SESSION['pelanggan']); } ?>
   
  
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Rumah Singgah Rey</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form  method="post" class="row g-3 needs-validation" >

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="submit" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="daftar.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                Mau Liat-Liat? Klik <a href="pendatang.php">Rumah Singgah Rey</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets_admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets_admin/vendor/chart.js/chart.umd.js"></script>
  <script src="assets_admin/vendor/echarts/echarts.min.js"></script>
  <script src="assets_admin/vendor/quill/quill.min.js"></script>
  <script src="assets_admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets_admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets_admin/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets_admin/js/main.js"></script>

</body>

</html>