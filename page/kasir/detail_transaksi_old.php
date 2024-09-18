<?php 
include_once 'controller/config.php';  
$kd = @$_GET['kd_transaksi'];
$sql = mysqli_query($conn, "SELECT * FROM riwayat_detail WHERE kd_transaksi='$kd'");
$sqld = mysqli_query($conn, "SELECT * FROM selesai WHERE kd_transaksi='$kd'");
$fetch = mysqli_fetch_array($sqld);
$username = $fetch['username'];
$sqldd = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username'");
$fetchd = mysqli_fetch_array($sqldd);
$nama = $fetchd['nama_lengkap'];
$nama =ucwords($nama);



?>

<main id="main" class="main">
      
    <div class="pagetitle">
      <h1>DETAIL TRANSAKSI</h1>
    </div>

<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-4">
					<h2 class="heading-section"><?php echo $nama ?> </h2>
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
                    <div class="py-2 text-uppercase text-center">Kuantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Total</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase text-center">Status</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php
            while ($rs = mysqli_fetch_array($sql)){  
            $data = $rs['nama_menu'];
            $sqld = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$data'");
            $datas = mysqli_fetch_array($sqld);
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
                  <td class="border-0 align-middle text-center"><strong><?php echo $rs['jumlah']; ?></strong></td>
                  <td class="border-0 align-middle"><strong>Rp. <?php echo $rs['jumlah_harga']; ?></strong></td>
                  <td class="border-0 align-middle text-center"><strong>Selesai</strong></td>
                  
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
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Uang</strong><strong>Rp. <?php echo $fetch['uang']?></strong>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong><strong>Rp. <?php echo $fetch['kembalian']?></strong>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Kasir</strong><strong style="color:black"><?php echo ucwords($fetch['kasir'])?></strong>
              </li>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cetak Struk</button>

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

