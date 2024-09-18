<?php

    if(isset($_GET['id'])){
      $id = @$_GET['id'];
      $result = mysqli_query($conn,"delete from tb_user where id_user='$id'");
      if($result){
      $id=0;          
      $_SESSION["success"] = 'Berhasil Dihapus';
      }else{
      $_SESSION["gagal"] = 'Gagal Dihapus';
      }
      }


      $sql = "SELECT * FROM tb_user WHERE NOT level='pelanggan'";
      $result = mysqli_query($conn,$sql);
      
      
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
    if($level != "Level..."){
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 4044070){			
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
          $_SESSION["success"] = 'Berhasil Ditambahkan';
        }else{
          $_SESSION["gagal"] = 'SUDAH TERDAFTAR';
        }

        }else{
        $_SESSION["gagal"] = 'UKURAN GAMBAR TERLALU BESAR(MAKSIMAL 4MB)';
      }

    }else{
      $_SESSION["gagal"] = 'EXTENSI TIDAK DIPERBOLEHKAN';
    }
  }else{
    $_SESSION["gagal"] = 'HARAP PILIH LEVEL AKUN';
  }
}

?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Karyawan Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Karyawan</li>
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">
          <div class="card">
            <div class="card-body">
            <button class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah User <i class="bi bi-plus"></i></button>
             <h5 class="card-title"><h5>
               <table class="table table">
                <thead>
                  <tr>
                  <table class="table table-striped" >
                      <thead center>
                        <tr>
                          <th>
                            Status
                          </th>
                          <th>
                            Foto
                          </th>
                          <th>
                            Level
                          </th>
                          <th>
                            Nama Lengkap
                          </th>
                          <th>
                            Nomor HP
                          </th>
                          <th>
                            Detail
                          </th>
                          <th>
                            Hapus
                          </th>
                        </tr>
                      </thead>
                  </tr>
                </thead>
                <?php
                 $no = 1;
                    error_reporting(0);
                    while ($data = mysqli_fetch_array($result)){
                      $username = $data['username'];
                      $sqld = mysqli_query($conn,"SELECT *FROM status WHERE username ='$username'");
                      $ceksesi = mysqli_fetch_array($sqld);
                      if($ceksesi['session']=="aktif"){
                        $session="<span class='logged-in'>●</span>";
                      }else{
                        $session="<span class='logged-out'>●</span>";
                      }
                      ?>  
                <tbody>    
                  <tr>
                          <th class="text-center">
                          <?php echo $session ?>
                          </th>
                          <td class="py-1">
                            <img src="assets/profile/<?php echo $data['gambar'] ?>" height='50px' width='50px' style="border-radius:70px"/>
                          </td>
                          <td>
                          <?php echo $data['level'] ?>
                          </td>
                          <td>
                            <?php echo $data['nama_lengkap'] ?>
                          </td>
                          <td>
                            <?php echo $data['nomor_hp'] ?>
                          </td>
                          <td>
                          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-primary"><a style="color:white" href="?admin=profiled&id=<?php echo $data['id_user'] ?>" > Detail </a></button>
                          </div>
                          </td>
                          <td>
                          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-danger"><a style="color:white" href="?admin=karyawan&id=<?php echo $data['id_user'] ?>" > Hapus </a></button>
                          </div>
                          </td>
                </tr>
                </tbody>
                <?php } ?>
              </table>
             <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        </div>
        </div>
        </div>
      </div>
    </section>

    <?php if(@$_SESSION['success']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '<?php echo $_SESSION['success']; ?>'
        }).then(function() {
         window.location = "home.php?admin=karyawan";
        });
        </script>
    <?php unset($_SESSION['success']); } ?>
   
    <?php if(@$_SESSION['gagal']){ ?>
        <script>
          Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: '<?php echo $_SESSION['gagal']; ?>'
        }).then(function() {
         window.location = "home.php?admin=karyawan";
        });
        </script>
    <?php unset($_SESSION['gagal']); } ?>
   
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Users</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="card">
            <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="row g-4">
                <div class="col-md-6">
                  <label for="validationDefault01" class="form-label">ID USER</label>
                  <input type="text" class="form-control" placeholder="Sudah Terisi Otomatis" id="validationDefault01"  Readonly>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault04" name="kategori" class="form-label">Level</label>
                  
                  <select id="inputState" class="form-select" name="level" required>
                        <option selected>Level...</option>
                        <option value="admin">admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="waiter">waiter</option>
                        <option value="koki">koki</option>
                        <option value="pelanggan">Pelanggan</option>   
                    </select> 
                </div>  
                <div class="col-md-6">
                  <label for="menu" class="form-label">Username</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="username" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault03" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" id="validationDefault03" required>
                </div>
                <div class="col-md-6">
                  <label for="menu" class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div> 
                <div class="col-md-6">
                  <label for="menu" class="form-label">Email</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="menu" class="form-label">Nomor HP</label>
                  <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend">+62</span>
                    <input type="number" class="form-control" name="nohp" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Alamat</label>
                  <input name="alamat" placeholder="Masukkan Alamat" id="validationDefault05" class="form-control" ></input>
                </div>
                
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Deskripsi</label>
                  <textarea name="tentang" placeholder="Silahkan Isi Keterangan Menu" id="validationDefault05" class="form-control" style="height: 100px"></textarea>
                </div>
                
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Gambar Menu</label>
                  <input type="file" name="file" class="form-control" id="validationDefault05" required>
                </div>
                
                <div class="col-12">
                  <button type="submit" name="submit" value="submit" class="btn btn-primary" >Tambah</button>
                </div>

              </form>
              <!-- End Browser Default Validation -->

            </div>
          </div>

      </div>
    </div>
  </div>
</div>

  </main><!-- End #main -->


  