<?php
    if(isset($_GET['id'])){
    $id = @$_GET['id'];
    $sql = "delete from tb_menu where kode_menu='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
    $id=0;
    header("Location:?admin=menu");
    }else{
      $_SESSION["gagal"] = 'DATA GAGAL DIHAPUS';
    }
    }
    if(isset($_POST['submit']))  {
        $nama_menu = $_POST['nama_menu'];
        $harga = $_POST['harga']; 
        $kategori = $_POST['kategori'];
        $keterangan = $_POST['keterangan'];
        $ekstensi_diperbolehkan	= array('png','jpg');
        $img = $_FILES['file']['name'];
        $x = explode('.', $img);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	
        $sqld = mysqli_query($conn,"SELECT max(kode_menu) as kodeTerbesar FROM tb_menu");
        $fetchsql = mysqli_fetch_array($sqld);
        $kodemenu = $fetchsql['kodeTerbesar'];
        $urutan = (int) substr($kodemenu,3,3);
        $urutan++;
        $autocode = sprintf("%03s",$urutan);
        
        $kategorisql = "SELECT *FROM tb_kategori WHERE nama_kategori='$kategori'";
        $sqldd = mysqli_query($conn, $kategorisql);
        $result = mysqli_fetch_array($sqldd);
        if($kategori == $result['nama_kategori']){
        $kode_kategori = $result['kd_kategori'];
        $kode_menu = $result['kd_kategori'].$autocode;
        }

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
          if($ukuran < 1044070){			
            move_uploaded_file($file_tmp, 'assets/menu/'.$kode_kategori.'/'.$nama_menu.$img);
            $gambar = $kode_kategori.'/'.$nama_menu.$img;
             $query = mysqli_query($conn, "INSERT INTO tb_menu SET kode_menu='$kode_menu',kd_kategori='$kode_kategori',nama_menu='$nama_menu',harga='$harga', status='tersedia', img='$gambar',keterangan='$keterangan'");
            if($query){
              $_SESSION["success"] = 'MENU BERHASIL DI TAMBAHKAN';
              $nama_menu= "";
              $kode_menu = "";
              $kode_kategori = "";
              $keterangan = "";
              $kategori = "";
              $harga = "";
            }else{
              $_SESSION["gagal"] = 'GAGAL MENGUPLOAD GAMBAR';
            }
          }else{
            $_SESSION["gagal"] = 'GAMBAR TERLALU BESAR';
          }
        }else{
          $_SESSION["gagal"] = 'EKSTENSI DI LARANG';
        }
    }
?>
       

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Menu Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Menu</li>
          <li class="breadcrumb-item active">Menu</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5>
               <table class="table table">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nama Menu</th>
                    <th scope="col" class="text-center">Harga</th>
                    <th scope="col" class="text-center">Deskripsi</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Foto</th>
                    <th scope="col" class="text-center">Edit</th>
                    <th scope="col" class="text-center">Hapus</th>
                  </tr>
                </thead>
                <?php
            $fetchdata = mysqli_query($conn,"SELECT * FROM tb_menu");
            while ( $data = mysqli_fetch_array($fetchdata)){
            ?>
                <tbody>    
                  <tr>
                    <th scope="row" class="text-center"><?php echo $data['kode_menu'] ?></th>
                    <td class="text-center"><?php echo $data['nama_menu'] ?></td>
                    <td>Rp.<?php echo $data['harga'] ?></td>
                    <td class="text-center"><?php echo substr($data['keterangan'], 0, 20); ?></td>
                    <td class="text-center"><?php echo $data['status'] ?></td>
                    <td class="text-center"><img src="assets/menu/<?php echo $data['img'] ?>" style="height:50px;width:5    0px;"/></td>
                    <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-primary">Edit</button>
                    </div>
                    </td> 
                    <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-danger"><a style="text-decoration:none;color:white" href="?admin=menu&id=<?php echo $data['kode_menu'] ?>" >Hapus </a></button>
                    </div>
                    </td>  
                </tr>
                </tbody>
                <?php } ?>
              </table>
             <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Menu <i class="bi bi-plus"></i></button>
        </div>
        </div>
        </div>
      </div>
    </section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="card">
            <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="row g-4">
                <div class="col-md-6">
                  <label for="validationDefault01" class="form-label">Kode Menu</label>
                  <input type="text" class="form-control" placeholder="Sudah Terisi Otomatis" id="validationDefault01"  Readonly>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault04" name="kategori" class="form-label">Kategori</label>
                  
                  <select id="inputState" class="form-select" name="kategori" required>
                        <option selected>Kategori...</option>
                        <?php  
                        $sql = "SELECT * FROM tb_kategori ORDER BY kd_kategori";
                        $result = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($result)){
                        ?>
                        <option  style="color:black" value="<?php echo $data['nama_kategori'];?>">
                        <?php echo $data['nama_kategori'] ?>
                        </option>
                        <?php } ?>   
                    </select> 
                </div>  
                <div class="col-md-6">
                  <label for="menu" class="form-label">Nama Menu</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="nama_menu" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault03" class="form-label">Harga</label>
                  <input type="number" class="form-control" name="harga" id="validationDefault03" required>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Deskripsi</label>
                  <textarea name="keterangan" placeholder="Silahkan Isi Keterangan Menu" name="keterangan" id="validationDefault05" class="form-control" style="height: 100px"></textarea>
                </div>
                
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Gambar Menu</label>
                  <input type="file" name="file" class="form-control" id="validationDefault05" required>
                </div>
                
                <div class="col-12">
                  <button type="submit" name="submit" class="btn btn-primary" >Tambah</button>
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


  
  <?php if(@$_SESSION['success']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '<?php echo $_SESSION['success']; ?>'
        }).then(function() {
         window.location = "home.php?admin=menu";
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
         window.location = "home.php?admin=menu";
        });
        </script>
    <?php unset($_SESSION['gagal']); } ?>
    