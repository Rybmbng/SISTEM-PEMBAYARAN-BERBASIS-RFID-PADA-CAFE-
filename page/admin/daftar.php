<?php
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
          echo "( </alert></script>FILE BERHASIL DI UPLOAD </alert></script>)"; 
          header("Location:?admin=karyawan");
        }else{
          echo "(<script><alert>GAGAL MENGUPLOAD GAMBAR </alert></script>)";
        }
      }else{
        echo "(<script><alert>UKURAN FILE TERLALU BESAR </alert></script>)";
      }
    }else{
      echo "(<script><alert>EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN </alert></script>)";
    }
}else{
  echo "(<script><alert>ADA ERROR</alert></script>)";

}
?>



<main id="main" class="main">

<!-- $result = mysqli_query($conn, "INSERT INTO tb_user VALUES(NULL,'$id_user','$username','$level','$nama_lengkap','$nama','$password','$alamat','$nohp','$email','$tentang')"); -->
        
    <div class="pagetitle">
      <h1>Tambah Karyawan</h1>
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Form User</h5>
              <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">ID</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control" value="ID SUDAH DI BUAT OTOMATIS" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                  <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" placeholder="Masukkan Username" class="form-control" id="yourUsername" required>
                      </div> </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10">
                    <input name="nama_lengkap" type="text" placeholder="Masukkan Nama Lengkap" class="form-control" value="">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" placeholder="Masukkan Password" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">alamat</label>
                  <div class="col-sm-10">
                    <input name="alamat" placeholder="Masukkan Alamat" type="text" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input name="email" placeholder="Masukkan Email" type="email" class="form-control" value="">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">No HP</label>
                  <div class="col-sm-10">
                  <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">+62</span>
                    <input  name="nohp" placeholder="Masukkan Nomor HP" type="number" class="form-control">
                  </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Foto Profile</label>
                  <div class="col-sm-10">
                    <input type="file" name="file" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Level</label>
                  <div class="col-sm-10">
                    <select name="level" class="form-select" aria-label="Default select example">
                      <option selected>Pilih Level</option>
                      <option value="admin">admin</option>
                      <option value="kasir">Kasir</option>
                      <option value="waiter">waiter</option>
                      <option value="koki">koki</option>
                      <option value="pelanggan">Pelanggan</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Tentang</label>
                  <div class="col-sm-10">
                    <textarea name="tentang" placeholder="Silahkan Isi Biodata Anda" class="form-control" style="height: 100px"></textarea>
                  </div>
                </div>

                <div class="row mb-3" style="display:flex;justify-items:center;justify-content:center;">
                  <div class="col-sm-5">
                    <button type="submit"  name="submit" value="submit" class="btn btn-primary">Tambah Karyawan</button>
                  </div>
                </div>

              </form>

            </div>
          </div>

        </div>
    </section>

  </main><!-- End #main -->
