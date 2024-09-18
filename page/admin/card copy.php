<?php
if($_POST['submit'])  {
  $username = $_POST['username'];
  $nomor_kartu = $_POST['nomor_kartu'];

  $cekkartu = mysqli_query($conn, "SELECT *FROM cards WHERE id_kartu = '$nomor_kartu'");
  if($cekkartu -> num_rows > 0){
    $_SESSION["gagal"] = 'KARTU TELAH DIDAFTARKAN';
  }else{
  $sql = mysqli_query($conn, "SELECT *FROM tb_user WHERE username='$username'");
  $data = mysqli_fetch_array($sql);
  if($sql->num_rows > 0){
    $result= mysqli_query($conn,"INSERT INTO cards SET nama_lengkap='$data[nama_lengkap]',id_kartu='$nomor_kartu'");
      if($result){
        $_SESSION["success"] = 'KARTU DIDAFTARKAN';
      }
    
  }else{
    $_SESSION["gagal"] = 'USERNAME TIDAK DITEMUKAN';
  }
}
}
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Member Card Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item active">Card</li>
        </ol>
      </nav>
    </div>
    
    <section class="section">
      <div class="row">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5>
              <button class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Kartu <i class="bi bi-plus"></i></button>
              <button class="btn btn-success me-md-2"  data-bs-toggle="modal" data-bs-target="#topUP"> Top-UP <i class="bi bi-plus"></i></button>
               <table class="table table">
                <thead>
                  <tr>
                  <table class="table table-striped" >
                      <thead center>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Foto
                          </th>
                          <th>
                            Nomor Kartu
                          </th>
                          <th>
                            Nama Lengkap
                          </th>
                          <th>
                            Detail
                          </th>
                        </tr>
                      </thead>
                  </tr>
                </thead>
                <?php
                 $no = 1;
                    error_reporting(0);
                    $result = mysqli_query($conn, "SELECT * FROM cards");
                    while ($datas = mysqli_fetch_array($result)){
                      $nama_lengkap = $datas['nama_lengkap'];
                      $sqld = mysqli_query($conn,"SELECT *FROM tb_user WHERE nama_lengkap ='$nama_lengkap'");
                      $data = mysqli_fetch_array($sqld);
                      ?>  
                <tbody>    
                  <tr>
                          <th class="text-center">
                          <?php echo $no++; ?>
                          </th>
                          <td class="py-1">
                            <img src="assets/profile/<?php echo $data['gambar'] ?>" height='50px' width='50px' style="border-radius:70px"/>
                          </td>
                          <td>
                          <?php echo $datas['id_kartu'] ?>
                          </td>
                          <td>
                            <?php echo ucwords($data['nama_lengkap']) ?>
                          </td>
                          <td>
                          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-danger"><a style="color:white" href="#" > Detail </a></button>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kartu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" align="center">
         <div class="card">
            <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="row g-4">
                <div class="col-md-6">
                  <label for="menu" class="form-label">Nomor Kartu</label>
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="Nomor Tertera Dikartu" name="nomor_kartu" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationDefault03" class="form-label">Username</label>
                  <input type="text" class="form-control" placeholder="Masukkan Username" name="username" id="validationDefault03" required>
                </div>
                <div class="col-12">
                  <button type="submit" name="submit" value="submit" class="btn centeralign-content-center btn-primary" >Tambah</button>
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


  
  <?php if(@$_SESSION['gagal']){ ?>
        <script>
          Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?php echo $_SESSION['gagal']; ?>'
        })
        </script>
    <?php unset($_SESSION['gagal']); } ?>
   

  
    <?php if(@$_SESSION['success']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Selamat',
          text: '<?php echo $_SESSION['success']; ?>'
        })
        </script>
    <?php unset($_SESSION['success']); } ?>
   
