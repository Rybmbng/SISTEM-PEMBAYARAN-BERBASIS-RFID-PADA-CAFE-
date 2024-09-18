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

if($_POST['topup'])  {
  $id_kartu = $_POST['id_kartu'];
  $ceksaldo = (int)$_POST['saldo'];

  if($ceksaldo == 5000){
    $saldo = 5000;
  }else  if($ceksaldo == 10000){
    $saldo = 10000;
  }else  if($ceksaldo == 20000){
    $saldo = 20000;
  }else  if($ceksaldo == 50000){
    $saldo = 50000;
  }else  if($ceksaldo == 100000){
    $saldo = 100000;
  }else  if($ceksaldo == 200000){
    $saldo = 200000;
  }else  if($ceksaldo == 500000){
    $saldo = 500000;
  }else  if($ceksaldo == 1000000){
    $saldo = 1000000;
  }

  $sqld = mysqli_query($conn, "SELECT *FROM cards WHERE id_kartu='$id_kartu'");
  $dataa = mysqli_fetch_array($sqld);
  $saldosekarang = $dataa['saldo'];
  $saldo += $saldosekarang;
  $result = mysqli_query($conn, "UPDATE cards SET saldo='$saldo' WHERE id_kartu='$id_kartu'");
  if($result){
    $_SESSION["success"] = 'BERHASIL';
  }else{
    $_SESSION["gagal"] = 'GAGAL';
  }
}


?>


<script>
  new DataTable('#example', {
    columnDefs: [
        {
            className: 'dtr-control',
            orderable: false,
            target: 0
        }
    ],
    order: [1, 'asc'],
    responsive: {
        details: {
            type: 'column',
            target: 'tr'
        }
    }
});
</script>
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
              
          <button class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah Kartu <i class="bi bi-plus"></i></button>              
              <h6 class="card-title">CARD MANAGER RUMAH SINGGAH<h6>
              
              <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
              <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
              <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

              <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
              <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
              <div class="container">
	<div class="row" >
	<table  id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th align="center" class="text-center">Profile</th>
                <th align="center" class="text-center">Nama Lengkap</th>
                <th align="center" class="text-center">Saldo</th>
                <th align="center" class="text-center"></th>
                
                </tr>
        </thead>
        <tbody>
        <?php 
                    $no = 1;
                    // error_reporting(0);
                    $result = mysqli_query($conn, "SELECT * FROM cards");
                    $datass = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($datass as $datas) : ?>
                    <?php
                      $nama_lengkap = $datas['nama_lengkap'];
                      $sqld = mysqli_query($conn,"SELECT *FROM tb_user WHERE nama_lengkap ='$nama_lengkap'");
                      $data = mysqli_fetch_array($sqld);
                      ?>  
            <tr>
                <td align="center"><img src="assets/profile/<?php echo $data['gambar'] ?>" height='50px' width='50px' style="border-radius:70px"/></td>
                <td align="center"><?php echo ucwords($data['nama_lengkap']) ?></td>
                <td align="center"><?php echo $datas['saldo'] ?></td>
                <td align="center"> <button class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#topUP-<?php echo $datas['id_kartu'] ?>"> TopUP <i class="bi bi-plus"></i></button></td>
            </tr>

            
<div class="modal fade" id="topUP-<?php echo $datas['id_kartu']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<?php 
            $topup = mysqli_query($conn,"SELECT *FROM cards WHERE id_kartu='$datas[id_kartu]'");
            while ($dataTopup = mysqli_fetch_array($topup)){
            ?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">TopUP <?php echo $datas['id_kartu']?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" align="center">
         <div class="card">
            <div class="card-body">
            
            <form method="post" enctype="multipart/form-data" class="row g-4">
                <div align="center" class="text-center">
                  <label for="menu" class="form-label">Nomor Kartu</label>
                  <div class="input-group">
                  <input type="number" align="center" class="form-control" placeholder="<?php echo $dataTopup['id_kartu'] ?>" name="id_kartu" id="id_kartu" aria-describedby="inputGroupPrepend2" disabled>
                  <input type="number" align="center" class="form-control" placeholder="<?php echo $dataTopup['id_kartu'] ?>" value="<?php echo $dataTopup['id_kartu'] ?>" name="id_kartu" id="id_kartu" aria-describedby="inputGroupPrepend2" hidden>
                  </div>
                </div>
                <div  align="center" class="text-center">
                  <label for="validationDefault03" class="form-label">Saldo</label>
                  <select class="form-control" name="saldo" id="saldo">
                  <option class="text-center" value="5000">Rp 5000</option>
                  <option class="text-center" value="10000">Rp 10.000</option>
                  <option class="text-center" value="20000">Rp 20.000</option>
                  <option class="text-center" value="50000">Rp 50.000</option>
                  <option class="text-center" value="100000">Rp 100.000</option>
                  <option class="text-center" value="500000">Rp 500.000</option>
                  <option class="text-center" value="1000000">Rp 1.000.000</option>
                </select>                
              </div>
                <div class="col-12">
                  <button type="submit" name="topup" value="topup" class="btn centeralign-content-center btn-primary" >Tambah</button>
                </div>
              </form>
            <?php } ?>
              <!-- End Browser Default Validation -->

            </div>
          </div>

      </div>
    </div>
  </div>
  <!-- <?php ?> -->

</div>

              <?php endforeach; ?>
            </tbody>
        <tfoot>
            <tr>
                <th align="center" class="text-center" >Profile</th>
                <th align="center" class="text-center" >Nama Lengkap</th>
                <th align="center" class="text-center" >Saldo</th>
                <th align="center" class="text-center" ></th>
                </tr>
            </tr>
        </tfoot>
    </table>
	</div>
</div>            

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
   

    <script>
new DataTable('#example', {
    responsive: {
        details: {
            display: DataTable.Responsive.display.modal({
                header: function (row) {
                    var data = row.data();
                    return 'Details for ' + data[0] + ' ' + data[1];
                }
            }),
            renderer: DataTable.Responsive.renderer.tableAll({
                tableClass: 'table'
            })
        }
    }
});

    </script>