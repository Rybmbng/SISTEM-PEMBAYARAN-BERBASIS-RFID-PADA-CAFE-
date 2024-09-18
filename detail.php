<?php 
error_reporting(0);
session_start();
include_once 'controller/config.php';  
$kd = @$_GET['id'];
$sqld = mysqli_query($conn, "SELECT * FROM transaksi WHERE kd_transaksi='$kd' ");
$fetch = mysqli_fetch_array($sqld);
$username = $fetch['username'];
$status = $fetch['status'];
$username =ucwords($username);
$user = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_user WHERE username='$username'"));

if(isset($_POST['submit'])){
  $id_kartu = $_POST['id_kartu'];
  $rfid = mysqli_query($conn, "SELECT * FROM cards WHERE id_kartu='$id_kartu'");
  $fetchrfid = mysqli_fetch_array($rfid);
  $saldo = $fetchrfid['saldo'];
  $tg = date("Y:m:d");
  $bayar = $_POST['bayar'];
  $kd_transaksi = $_POST['kd_transaksi'];
  $total = $_POST['total'];
  $kembalian = $saldo-$total;
  if($status != "dinikmati"){
    $_SESSION["gagal"] = 'PESANAN BELUM DINIKMATI'; 
    mysqli_query($conn, "DELETE FROM `rfid` WHERE 1");
  }else{
    if($id_kartu != ""){
      $cekkartu = mysqli_query($conn, "SELECT * FROM cards WHERE id_kartu='$id_kartu'");
      if($cekkartu ->num_rows >0){
  if($total > $saldo){
    $_SESSION["gagal"] = 'SALDO KARTU ANDA TIDAK MENCUKUPI';
    mysqli_query($conn, "UPDATE `notif` SET `value`='1' WHERE 1");
    mysqli_query($conn, "DELETE FROM `rfid` WHERE 1");
  }else{
    $updatesaldo = $saldo-$total;
    $insertdata = mysqli_query($conn,"INSERT INTO selesai SET kd_transaksi='$kd_transaksi',username='$username',total='$total', tanggal='$tg',uang='$saldo',kembalian='0',kasir='card' ");
    if($insertdata){
      mysqli_query($conn,("INSERT into riwayat_detail SELECT *FROM detail where kd_transaksi='$kd_transaksi'"));
      mysqli_query($conn,("DELETE FROM aktifitas WHERE username='$username'"));
      mysqli_query($conn,("DELETE FROM transaksi WHERE username='$username'"));
      mysqli_query($conn,("DELETE FROM detail WHERE username='$username'"));
      mysqli_query($conn,("UPDATE cards set saldo='$updatesaldo' WHERE id_kartu='$id_kartu'"));
      mysqli_query($conn,("UPDATE meja SET status='kosong',username='' WHERE username='$username'"));
      $_SESSION["berhasil"] = 'PESANAN TELAH DIBAYAR';
      mysqli_query($conn, "DELETE FROM `rfid` WHERE 1");
    }else{
      $_SESSION["gagal"] = 'ADA MASALAH';
      mysqli_query($conn, "DELETE FROM `rfid` WHERE 1");
    }
  }
}else{
  $_SESSION["gagal"] = 'KARTU TIDAK TERDAFTAR';
  mysqli_query($conn, "UPDATE `notif` SET `value`='1' WHERE 1");
  mysqli_query($conn, "DELETE FROM `rfid` WHERE 1");

}
}else{
  $_SESSION["gagal"] = 'KARTU BELUM DI TEMPEL';
  mysqli_query($conn, "UPDATE `notif` SET `value`='1' WHERE 1");
  mysqli_query($conn, "DELETE FROM `rfid` WHERE 1");

}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icon/favicon-16x16.png">
    <link rel="manifest" href="assets/icon/site.webmanifest">

<?php include_once 'template/style.php' ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="assetsdetail/css/nucleo-icons.css" rel="stylesheet" />
<link href="assetsdetail/css/nucleo-svg.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="assetsdetail/css/nucleo-svg.css" rel="stylesheet" />
<link id="pagestyle" href="assetsdetail/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<script src="assets/css/style.css" crossorigin="anonymous"></script>
<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
<link id="pagestyle" href="assets/css/soft-ui-dashboard.min.css?v=1.0.6" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/side-navbar.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/side-navbar.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<script  src="assets/js/mdb.min.js"></script>
<script  src="assets/js/jquery-3.4.0.min.js"></script>
<script src="assets/js/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/jquery.table2excel.js"></script>
<script src="js/jquery.table2excel.js"></script>    
<script src="assets/js/jquery-3.4.0.min.js"></script>
<script src="assets/js/mdb.min.js"></script>
<script src="assets/js/jquery-latest.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css"> 

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


  $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>


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
    
<?php if(@$_SESSION['berhasil']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: '<?php echo $_SESSION['berhasil']; ?>'
        }).then(function() {
         window.location = "bayar.php";
        });
        </script>
    <?php unset($_SESSION['berhasil']); } ?>
   
<div class="event-schedule-area-two bg-color pad100">
    <div class="container">
        <div class="row py-5 overflow-hidden bg-warning">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text">
                        <h2>PEMBAYARAN MENGGUNAKAN KARTU RUMAH SINGGAH</h2>
                    </div>
                    <p>
                    Detail Transaksi	<h2 class="heading-section"><a style="font-weight:bold"><?php echo ucwords($user['nama_lengkap']) ?></a> | Meja No (<?php echo $fetch['meja']?>) </h2>
                    </p>
                </div>
            </div>
            <!-- /.col end-->
        </div>

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr  scope="col" class="border-0 bg-light">
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Produk</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Harga</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Kuantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Total</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Status</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM detail WHERE kd_transaksi='$kd' ");
            while ($rs = mysqli_fetch_array($sql)){  
            $data = $rs['nama_menu'];
            $menu = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$data'");
            $datas = mysqli_fetch_array($menu);
            $sqldd = mysqli_query($conn,"SELECT *FROM aktifitas WHERE username='$username'  ORDER BY no DESC LIMIT 1");
            $datass = mysqli_fetch_array($sqldd);
            $no =1;
            ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="assets/menu/<?php echo $datas['img']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0 text-dark d-inline-block align-middle"> <?php echo ucwords($rs['nama_menu']); ?></h5>
                         </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>Rp. <?php echo $rs['harga']; ?></strong></td>              
                  <td class="border-0 align-middle"><strong><?php echo $rs['jumlah']; ?></strong></td>
                  <td class="border-0 align-middle"><strong>Rp. <?php echo $rs['jumlah_harga']; ?></strong></td>                  
                  <?php if($datass['aksi'] == 'dinikmati'){
                  echo '<td><span class="badge bg-danger">Menunggu Pembayaran</span></td>';
                  }else{
                  echo '<td class="border-0 align-middle"><strong><?php echo $datass[aksi]; ?></strong></td>';
                  }
                  ?>
                  
                <?php
                $subtotal += $rs['jumlah_harga']; 
                $pajak = $subtotal * 0.1;
                $total = $subtotal + $pajak;
            }
            
            ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-5">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Detail Order </div>
          <div class="p-4">
            <ul class="list-unstyled mb-4">
            <div class="text-center">               
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sub Total</strong><strong>Rp. <?php echo $subtotal ?></strong>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Pajak</strong><strong>Rp. <?php echo $pajak ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong><strong>Rp. <?php echo $total?></strong>
              </li>
          </div>
        </div>
        <button name='bayar' class='btn btn-success rounded-pill py-2 btn-block' data-bs-toggle="modal" data-bs-target="#exampleModal" >Bayar Pesanan</button>
        <button class='btn btn-danger rounded-pill py-2 btn-block '><a style="color:white;text-decoration:none" href="bayar.php">Kembali</a></button>
      </div>
      </tr>
    </div>
    </div>
	</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Transaksi (<a style="font-weight:bold"><?php echo ucwords($user['nama_lengkap']) ?></a>)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  <div class="text-center">   
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-bold">Meja</strong><strong><?php echo $fetch['meja'] ?></strong>            
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-bold">Sub Total</strong><strong>Rp. <?php echo $subtotal ?></strong>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-bold">Pajak</strong><strong>Rp. <?php echo $pajak ?></strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-bold">Total</strong><strong>Rp. <?php echo $total?></strong>
                  </li>
                  </div>
                  <form method="post"  id="myForm">
                  <div id="cekkartu">
                  </div>
                  <input type="text" name="kd_transaksi" value="<?php echo $datass['kd_transaksi']; ?>" hidden>
                    <input type="text" name="username" value="<?php echo $username; ?>" hidden>
                    <input type="number" name="total" value="<?php echo $total; ?>" hidden>
                </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary" >Bayar</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
      </div>
    </div>
  </div>
</div>
 <script src="assetsdetail/js/core/popper.min.js"></script>
  <script src="assetsdetail/js/core/bootstrap.min.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="assetsdetail/js/soft-ui-dashboard.min.js?v=1.0.6"></script>

<!--  -->
<script>
$(document).ready(function() {
    setInterval(function() {
      var inputField = $('#cekkartu');

        $("#cekkartu").load('controller/cekkartu.php')
        inputField.on('input', function() {
        if (inputField.val() !== '') {
        $('#myForm').submit();
        }
      });
    }, 0);

 
});
</script>
<!--  -->

</body>
</html>