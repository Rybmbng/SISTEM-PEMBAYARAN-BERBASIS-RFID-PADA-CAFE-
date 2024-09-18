<?php

    if(isset($_GET['id'])){
    $id = @$_GET['id'];
    $sql = "delete from tb_kategori where kd_kategori='$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
    $id=0;
    header("Location:?admin=kategori");
    }else{
    echo "<script> alert('Data gagal dihapus') </script>"; 
    }
    }
    if(isset($_POST['submit']))  {
        $nama_kategori = $_POST['nama_kategori'];
        $kd_kategori = $_POST['kd_kategori']; 
        $deskripsi = $_POST['deskripsi'];
        $ekstensi_diperbolehkan	= array('png','jpg');
        $img = $_FILES['file']['name'];
        $x = explode('.', $img);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
          if($ukuran < 1044070){			
            move_uploaded_file($file_tmp, 'assets/menu/'.$kd_kategori.'/'.$img);
            $gambar = $kd_kategori.'/'.$img;
             $query = mysqli_query($conn, "INSERT INTO tb_kategori SET kd_kategori='$kd_kategori',nama_kategori='$nama_kategori',deskripsi='$deskripsi', gambar='$gambar'");
            if($query){
              echo 'BERHASIL DI UPLOAD'; 
              $kd_kategori= "";
              $nama_kategori= "";
              $deskripsi = "";
              $gambar = "";
            }else{
              echo 'GAGAL MENGUPLOAD GAMBAR';
            }
          }else{
            echo 'UKURAN FILE TERLALU BESAR';
          }
        }else{
          echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
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
          <li class="breadcrumb-item active">Kategori</li>
        </ol>
      </nav>
    </div>
    
    <section class="section">
      <div class="row">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5>
               <table class="table table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Kategori</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                  </tr>
                </thead>
                <?php
                $fetchdata = mysqli_query($conn,"SELECT * FROM tb_kategori");
                $no = 1;
                while ( $data = mysqli_fetch_array($fetchdata)){
                ?>
                <tbody>    
                  <tr>
                    <th><?php echo $no++ ?></th>
                    <td scope="row"><?php echo $data['kd_kategori'] ?></td>
                    <td><?php echo $data['nama_kategori'] ?></td>
                    <td><?php echo $data['deskripsi'] ?></td>
                   
                    <td><img src="assets/menu/<?php echo $data['gambar'] ?>" style="height:50px;width:50px;"/></td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-primary">Edit</button>
                    </div>
                    </td> 
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-danger"><a style="color:white" href="?admin=kategori&id=<?php echo $data['kd_kategori'] ?>" >Hapus </a></button>
                    </div>
                    </td>  
                </tr>
                </tbody>
                <?php } ?>
              </table>
             <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Kategori <i class="bi bi-plus"></i></button>
        </div>
        </div>
        </div>
      </div>
    </section>

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
                  <label for="validationDefault01" class="form-label">Kode Kategori</label>
                  <input type="text" class="form-control" name="kd_kategori" placeholder="Masukkan 3 Digit Kode"  min="1" max="3" id="validationDefault01" >
                </div>
                <div class="col-md-6">
                  <label for="menu" class="form-label">Kategori Menu</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="nama_kategori" id="menu" placeholder="Nama Kategori" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Deskripsi</label>
                  <textarea placeholder="Silahkan Isi Keterangan Menu" name="deskripsi" id="validationDefault05" class="form-control" style="height: 100px"></textarea>
                </div>
                
                <div class="col-md-6">
                  <label for="validationDefault05" class="form-label">Gambar Kategori</label>
                  <input type="file" name="file" class="form-control" id="validationDefault05" required>
                </div>
                
                <div class="col-12">
                  <button type="submit"  name="submit"  class="btn btn-primary" >Tambah</button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

  </main><!-- End #main -->


  