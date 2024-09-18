<?php 
include_once 'controller/config.php';  
$kd = @$_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM detail WHERE kd_transaksi='$kd'");
$sqld = mysqli_query($conn, "SELECT * FROM transaksi WHERE kd_transaksi='$kd'");
$fetch = mysqli_fetch_array($sqld);
$username = $fetch['username'];
$status = $fetch['status'];
$username =ucwords($username);

if(isset($_POST['submit'])){
  $tg = date("Y:m:d");
  $bayar = $_POST['bayar'];
  $kd_transaksi = $_POST['kd_transaksi'];
  $total = $_POST['total'];
  $kembalian = $bayar-$total;
  if($status != "dinikmati"){
    $_SESSION["gagal"] = 'PESANAN BELUM DINIKMATI';
  }else{
  if($total > $bayar){
    $_SESSION["gagal"] = 'NOMINAL YANG DIMASUKKAN KURANG';
  }else{
    $insertdata = mysqli_query($conn,"INSERT INTO selesai SET kd_transaksi='$kd_transaksi',username='$username',total='$total', tanggal='$tg',uang='$bayar',kembalian='$kembalian',kasir='$_SESSION[username]' ");
    if($insertdata){
      mysqli_query($conn,("INSERT into riwayat_detail SELECT *FROM detail where kd_transaksi='$kd_transaksi'"));
      mysqli_query($conn,("DELETE FROM aktifitas WHERE username='$username'"));
      mysqli_query($conn,("DELETE FROM transaksi WHERE username='$username'"));
      mysqli_query($conn,("DELETE FROM detail WHERE username='$username'"));
      mysqli_query($conn,("UPDATE meja SET status='kosong',username='' WHERE username='$username'"));
      $_SESSION["berhasil"] = 'PESANAN TELAH SELESAI';
    }else{
      $_SESSION["gagal"] = 'ADA MASALAH';

    }
  }
}
}


?>

<?php if(@$_SESSION['gagal']){ ?>
        <script>
            swal({
            title: "ALERT",
            text: "<?php echo $_SESSION['gagal']; ?>",
            icon: "warning"
            });
        </script>
<?php unset($_SESSION['gagal']); } ?>
   

<?php if(@$_SESSION['berhasil']){ ?>
        <script>
            swal({
            title: "ALERT",
            text: "<?php echo $_SESSION['berhasil']; ?>",
            text: "Kembalian Rp.<?php echo $kembalian ?>",
            icon: "success"
            });
        </script>
<?php 
echo "<script>window.location.href = '?admin=home'</script>";
unset($_SESSION['berhasil']); 
} ?>
   

<main id="main" class="main">
      
    <div class="pagetitle">
      <h1>DETAIL TRANSAKSI</h1>
    </div>

<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-4">
					<h2 class="heading-section"><?php echo $username ?> | Meja No (<?php echo $fetch['meja']?>) </h2>
				</div>
			</div>
			
        

  <!-- End -->
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
            while ($rs = mysqli_fetch_array($sql)){  
            $data = $rs['nama_menu'];
            $sqld = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$data'");
            $datas = mysqli_fetch_array($sqld);
            $sqldd = mysqli_query($conn,"SELECT *FROM aktifitas WHERE username='$username'");
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
                  <td class="border-0 align-middle"><strong><?php echo $datass['aksi']; ?></strong></td>
                  
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
      </div>
      </tr>
    </div>
  </div>
		</div>
	</section>


    
			</div>
		</div>
	</section>

    </section>

  </main><!-- End #main -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Transaksi ( <?php echo $username ?> )</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  <div class="text-center">               
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sub Total</strong><strong>Rp. <?php echo $subtotal ?></strong>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Pajak</strong><strong>Rp. <?php echo $pajak ?></strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong><strong>Rp. <?php echo $total?></strong>
                  </li>
                  </div>
                  <form method="post">
                  <div class="mb-3">
                    <input type="number" name="bayar" placeholder="Masukkan Nominal Disini"class="form-control" id="bayar" aria-describedby="emailHelp" required>
                    <div id="bayar" class="form-text">Harap Perhatikan Dalam Memasukkan Nominal</div>
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

