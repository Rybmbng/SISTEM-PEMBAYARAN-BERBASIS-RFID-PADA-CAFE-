<?php
// error_reporting(0);
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
if(isset($_POST['submit'])) {
  $username = $_POST['nama_lengkap'];
  $sqld = mysqli_query($conn,"SELECT *FROM status WHERE username='$usernames'");
  $ceksesi = mysqli_fetch_array($sqld);
  if($ceksesi['session']=="aktif"){
    $meja = $_POST['meja'];
    $total_harga = $_POST['total_harga'];
    $tg = date("Y:m:d");
    $kdd = date("H:i:s");
    $string = $_SESSION['username'].$kdd;
    $kd_transaksi = "KD_".preg_replace("/[^a-zA-Z0-9]/", "", $string);
    $sql = "SELECT * FROM meja WHERE nomor_meja='$meja'";
    mysqli_query($conn,"UPDATE meja set status='terisi',username='$username' WHERE nomor_meja='$meja'");
    mysqli_query($conn,"INSERT INTO transaksi set kd_transaksi='$kd_transaksi', tanggal='$tg', total='$total_harga',username='$username',meja='$meja',status='diproses'");
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
}   
}

?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Transaksi Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
          <li class="breadcrumb-item active">Pesanan</li>
        </ol>
      </nav>
    </div>
    
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
<div class="card">
<div class="card-body">
    <section class="section">
    <section class="ftco-section">
        
    <div class="card">
            <div class="card-body">              
              <h6 class="card-title">MENU RUMAH SINGGAH<h6>
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
                <th align="center" class="text-center">Gambar</th>
                <th align="center" class="text-center">Nama Menu</th>
                <th align="center" class="text-center">Harga</th>
                <th align="center" class="text-center"></th>
                
                </tr>
        </thead>
        <tbody>
        <?php 
                    $no = 1;
                    // error_reporting(0);
                    $result = mysqli_query($conn, "SELECT * FROM tb_menu");
                    $datass = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach ($datass as $datas) : ?>
                    <?php
                      $kode_menu = $datas['kode_menu'];
                      $sqld = mysqli_query($conn,"SELECT *FROM tb_menu WHERE kode_menu ='$kode_menu'");
                      $data = mysqli_fetch_array($sqld);
                      ?>  
            <tr>
                <td align="center"><img src="assets/menu/<?php echo $data['img'] ?>" height='50px' width='50px' style="border-radius:70px"/></td>
                <td align="center"><?php echo ucwords($data['nama_menu']) ?></td>
                <td align="center"><?php echo $datas['harga'] ?></td>
                <td align="center"> <a class="btn btn-lg btn-primary mt-xl-6" href="carts.php?act=add&amp;kode_menu=<?php echo $data['kode_menu']; ?>&amp;ref=?admin=tambah">Tambah Ke Keranjang <i class="fas fa-chevron-right ms-2"></i></a></td>
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

<hr>

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
            $direct = "?admin=tambah";
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
                  <td class="border-0 align-middle"><strong><a href="carts.php?act=plus&amp;kode_menu=<?php echo $key; ?>&amp;ref=<?php echo $direct ?>" > + </a> | <a href="carts.php?act=min&amp;kode_menu=<?php echo $key; ?>&amp;ref=<?php echo $direct ?> "> - </a> | <a href="carts.php?act=del&amp;kode_menu=<?php echo $key; ?>&amp;ref=<?php echo $direct ?>"> Hapus</a></strong></td>
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
              </li>

              <div class="row mb-3">
                    <input  type="text" name="nama_lengkap" class="form-control" placeholder="          Masukkan Nama Pelanggan Disini">
                </div>
                <button name="submit" type="submit" value="submit" class='btn btn-dark rounded-pill py-2 btn-block'>Checkout</button>
          </div>
        </div>
      </div>

    </div>
  </div>
  </form>

</div>


	</section>
    </section>

  </main>
  
  <?php if(@$_SESSION['sukses']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: '<?php echo $_SESSION['sukses']; ?>'
        })
        </script>
    <?php unset($_SESSION['sukses']); } ?>
   

    
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