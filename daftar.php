<?php
error_reporting(0);

include 'controller/config.php'; 
if($_POST['submit'])  {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $hp = "+62".$nohp;
    $alamat = $_POST['alamat'];
		$level = $_POST['level'];  
    $tentang = $_POST['tentang'];
    $ekstensi_diperbolehkan	= array('png','jpg');
    $nama = $_FILES['file']['name'  ];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];	   
    $id_user;
    if($level=="admin"){
      $id_user = "A_";
    } else
    if($level=="kasir"){
      $id_user = "K_";
    } else
    if($level=="pelanggan"){
      $id_user = "P_";
    }
    $id = $id_user.$username;

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 1044070){			
        move_uploaded_file($file_tmp, 'assets/profile/' .$username.$nama);
        $gambar = $username.$nama;
         $query = mysqli_query($conn, "INSERT INTO tb_user SET id_user='$id',username='$username',password='$password',nama_lengkap='$nama_lengkap',alamat='$alamat',email='$email',nomor_hp='$hp',
         gambar='$gambar',level='$level',about='$tentang'");
        if($query){
          $username = "";
          $id = "";
          $tentang = "";
          $nohp = "";
          $email = "";
          $nama = "";
          $_POST['password'] = "";
          $nama_lengkap = "";
          $level = "";
          $alamat = "";
          $_SESSION["success"] = 'BERHASIL DIBUAT';
        }else{
          $_SESSION["gagal"] = 'GAGAL UPLOAD GAMBAR';
        }
      }else{
        $_SESSION["gagal"] = 'GAMBAR TERLALU BESAR';
      }
    }else{
      $_SESSION["gagal"] = 'EKSTENSI DILARANG';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Daftar | Rumah Singgah Rey</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <?php include_once 'template/style.php' ?>
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php if(@$_SESSION['success']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['success']; ?>'
        }).then(function() {
         window.location = "login.php";
        });
        </script>
    <?php unset($_SESSION['success']); } ?>
   
<?php if(@$_SESSION['gagal']){ ?>
        <script>
          Swal.fire({
          icon: 'ALERT',
          title: 'Failed',
          text: '<?php echo $_SESSION['gagal']; ?>'
        }).then(function() {
         window.location = "login.php";
        });
        </script>
    <?php unset($_SESSION['gagal']); } ?>
   
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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form method="post" enctype="multipart/form-data" class="row g-4">
                <div class="col-md-12">
                  <label for="validationDefault01" class="form-label">ID USER</label>
                  <input type="text" class="form-control" placeholder="Sudah Terisi Otomatis" id="validationDefault01"  Readonly>
                </div>
                <div class="col-md-12">
                  <label for="validationDefault04" name="kategori" class="form-label">Level</label>
                  
                  <select id="inputState" class="form-select" name="level" required>
                        <option value="pelanggan">Pelanggan</option>   
                    </select> 
                </div>  
                <div class="col-md-12">
                  <label for="menu" class="form-label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="username" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="validationDefault03" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" id="validationDefault03" required>
                </div>
                <div class="col-md-12">
                  <label for="menu" class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div> 
                <div class="col-md-12">
                  <label for="menu" class="form-label">Email</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="menu" class="form-label">Nomor HP</label>
                  <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend">+62</span>
                    <input type="number" class="form-control" name="nohp" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="validationDefault05" class="form-label">Alamat</label>
                  <input name="alamat" placeholder="Masukkan Alamat" id="validationDefault05" class="form-control" ></input>
                </div>
                
                <div class="col-md-12">
                  <label for="validationDefault05" class="form-label">Deskripsi</label>
                  <textarea name="tentang" placeholder="Silahkan Isi Keterangan Menu" id="validationDefault05" class="form-control" style="height: 100px"></textarea>
                </div>
                
                <div class="col-md-12">
                  <label for="validationDefault05" class="form-label">Gambar Menu</label>
                  <input type="file" name="file" class="form-control" id="validationDefault05" required>
                </div>
                
                <div class="col-12">
                  <button type="submit" name="submit" value="submit" class="btn btn-primary" >Tambah</button>
                </div>

              </form>

                </div>
              </div>

             
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>