<?php

if(!isset($_SESSION['username'])){
  echo "<script>window.location.href = 'login.php'</script>";
}
error_reporting(0);
include_once 'controller/config.php';
if(isset($_POST['cekmeja'])){
  $meja = $_POST['meja'];
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_array($result);
  $statusmeja = $data['status'];
  if($statusmeja == "kosong"){
    $_SESSION["success"] = 'MEJA DAPAT DIPAKAI';
  }else{
    $_SESSION["gagal"] = 'MEJA TIDAK DAPAT DIPAKAI';
  }
}
if(isset($_POST['checkout'])) {
  $usernames = $_SESSION['username'];
  $sqld = mysqli_query($conn,"SELECT *FROM status WHERE username='$usernames'");
  $ceksesi = mysqli_fetch_array($sqld);
  if($ceksesi['session']=="aktif"){
    $meja = $_POST['meja'];
    $total_harga = $_POST['total_harga'];
    $tg = date("Y:m:d");
    $kdd = date("H:i:s");
    $string = $_SESSION['username'].$kdd;
    $kd_transaksi = "KD_".preg_replace("/[^a-zA-Z0-9]/", "", $string);
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM meja WHERE nomor_meja='$meja'";
    mysqli_query($conn,"UPDATE meja set status='terisi',username='$username' WHERE nomor_meja='$meja'");
    mysqli_query($conn,"INSERT INTO transaksi set kd_transaksi='$kd_transaksi', tanggal='$tg', total='$total_harga',username='$username',meja='$meja',status='dipesan'");
    mysqli_query($conn,"INSERT INTO aktifitas SET tanggal='$tg',username='$username', aksi='dipesan', kd_transaksi='$kd_transaksi'");
    foreach ($_SESSION['items'] as $key => $val){
      $query = mysqli_query ($conn,"SELECT * FROM tb_menu WHERE kode_menu='$key'");
      $rs = mysqli_fetch_array ($query);
      $jumlah_harga = $rs['harga'] * $val;
      $menu = $rs['nama_menu'];
      $harga = $rs['harga'];
      $total += $jumlah_harga;
      $sql = mysqli_query($conn,"INSERT INTO detail SET username='$username',nama_menu='$menu',harga='$harga',jumlah='$val', jumlah_harga='$jumlah_harga',kd_transaksi='$kd_transaksi '");
      $items = mysqli_query($conn, "SELECT *FROM popular_items WHERE nama_menu='$menu'");
      $fetchitem = mysqli_fetch_array($items);
      $total_popular = $fetchitem['total'];
      $total_popular += $val;
      if($items -> num_rows > 0){
      mysqli_query($conn,"UPDATE popular_items set total='$total_popular' WHERE nama_menu='$menu'");
      }else{
        mysqli_query($conn,"INSERT into popular_items set kd_menu='$menu',total='$total_popular',nama_menu='$menu'");
      }
      if($sql){
        $_SESSION["success"] = 'PESANAN DIBUAT, HARAP MENUNGGU';
        unset($_SESSION["items"]);
      }		
  } 
}else{ 
  $_SESSION["gagal"] = 'BUKAN PELANGGAN, LOGIN DULU';
}    
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Panggil file CSS Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="assets_pelanggan/css/theme.css" rel="stylesheet" />

</head>
<body>
     
<section class="py-5 overflow-hidden bg-primary" id="home">
        <div class="container">
          <div class="row flex-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 mt-8 mt-md-0">
        </div>
      </section>

<div class="px-4 px-lg-0">
  <!-- For demo purpose -->
  <div class="container text-white py-5 text-center">
    <h1 class="display-4">KERANJANG BELANJA</h1>
   
   </div>
  <!-- End -->
  <form method="post">
  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
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
                    <div class="py-2 text-uppercase">Aksi</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php
            $direct = "?pelanggan=keranjang";
            $total = 0;
            if (isset($_SESSION['items'])) {
            foreach ($_SESSION['items'] as $key => $val){
              $query = mysqli_query ($conn,"SELECT * FROM tb_menu WHERE kode_menu='$key'");
              $rs = mysqli_fetch_array ($query);
              $kategori=$rs['kd_kategori'];
              $jumlah_harga = $rs['harga'] * $val;
              $subtotal += $jumlah_harga;
              $pajak = $subtotal * 0.1;
              $total = $subtotal + $pajak;
              $no = 1;
            ?>
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="assets/menu/<?php echo $rs['img']; ?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?php echo $rs['nama_menu']; ?></a></h5>
                         </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>Rp.<?php echo $rs['harga']; ?></strong></td>
                  <td class="border-0 align-middle"><strong><?php echo number_format($val);?></strong></td>
                  <td class="border-0 align-middle"><strong>Rp.<?php echo $jumlah_harga;?></strong></td>
                  <td class="border-0 align-middle"><strong><a href="cart.php?act=plus&amp;kode_menu=<?php echo $key; ?>&amp;ref=<?php echo $direct ?>" > + </a> | <a href="cart.php?act=min&amp;kode_menu=<?php echo $key; ?>&amp;ref=<?php echo $direct ?> "> - </a> | <a href="cart.php?act=del&amp;kode_menu=<?php echo $key; ?>&amp;ref=<?php echo $direct ?>"> Hapus</a></strong></td>
                </tr>
                <?php
                mysqli_free_result($query);
                }
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>

      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-5">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Detail Order </div>
          <div class="p-4">
            <ul class="list-unstyled mb-4">
            <div class="text-center"> 
            <b>Silahkan Tentukan Meja Anda </b>
            </br>
            <select id="inputState" class="form-select" name="meja" value="<?php echo $data['nomor_meja'] ?>" required>
                        <?php  
                        $sql = "SELECT * FROM meja WHERE status='kosong'";
                        $result = mysqli_query($conn, $sql);
                        while($data = mysqli_fetch_array($result)){
                        ?>
                        <option  style="color:black" value="<?php echo $data['nomor_meja'];?>">
                        <?php echo $data['nomor_meja'] ?>
                        </option>
                        
                        <?php } ?> 
                        
                    </select>  
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sub Total</strong><strong>Rp. <?php echo $subtotal ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Pajak(10%)</strong><strong>Rp. <?php echo $pajak ?></strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted"></strong>
              <td><input type="text" name="total_harga" value="<?php echo $subtotal; ?>" hidden></td>

              <h5 class="font-weight-bold">Rp.<?php echo $total; ?></h5>
              </li><?php
             
              $result = mysqli_query($conn, "SELECT *FROM transaksi WHERE username='$_SESSION[username]'");
              if($result->num_rows > 0){
                echo "MAAP UNTUK MENAMBAH MENU HARAP MENGHUBUNGI KASIR ATAU WAITER";
              }else{
                echo "<button name='checkout' class='btn btn-dark rounded-pill py-2 btn-block'>Checkout</button>";
              }
              
              ?>

            <a href="index.php" class="btn btn-primary rounded-pill py-2 btn-block">Lanjutkan Belanja</a>
          </div>
        </div>
      </div>

    </div>
  </div>
  </form>

</div>

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
         window.location = "?pelanggan=belanja";
        });
        </script>
    <?php unset($_SESSION['berhasil']); } ?>
   

	<!-- Panggil file JavaScript Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>