<?php
include_once 'controller/config.php';
$sql = mysqli_query($conn, "SELECT * FROM transaksi");
?>

<div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
</div>
            
    <div class="pagetitle">
      <h1>Transaksi Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?waiter=">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
          <li class="breadcrumb-item active">Waiter</li>
        </ol>
      </nav>
    </div>
<div class="card">
<div class="card-body">
    <section class="section">
    <section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
						  <thead>
						    <tr>
						      <th>#</th>
						      <th>Customer</th>
						      <th>Tanggal</th>
						      <th>Sub Total</th>
						      <th>Total</th>
						      <th>Status</th>
						      <th>Aksi</th>
						    </tr>
						  </thead>
						  <tbody>
                          	<?php
                        	 $sql = mysqli_query($conn,"SELECT * FROM transaksi WHERE status='diantar'");
                            while ($data = mysqli_fetch_array($sql)){
                              $fetch = mysqli_fetch_array(mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$data[username]'"));

                            $pajak = $data['total'] * 0.1;
                            $subtotal = $data['total'];
							$total = $subtotal + $pajak;
							?>
						    <tr>
						      <th scope="row"><?php echo $data['no'] ?></th>
						      <td><a href="?waiter=detail_transaksi&id=<?php echo $data['kd_transaksi'] ?>"><?php echo ucwords($fetch['nama_lengkap']) ?></a></td>
						      <td><?php echo $data['tanggal'] ?></td>
						      <td><?php echo $subtotal ?></td>
						      <td><?php echo $total ?></td>
						    <?php
                        if($data['status'] == 'dipesan'){
                          echo '<td><span class="badge bg-primary">Dipesan</span></td>';
                        }else
                         if($data['status'] == 'diproses'){
                        echo '<td><span class="badge bg-info">diproses</span></td>';
                        }else 
                         if($data['status'] == 'dimasak'){
                        echo '<td><span class="badge bg-warning">dimasak</span></td>';
                        }else
                        if($data['status'] == 'diantar'){
                        echo '<td><span class="badge bg-primary">diantar</span></td>';
                        }else
                        if($data['status'] == 'selesai'){
                        echo '<td><span class="badge bg-succes">selesai</span></td>';
                        }else
                        if($data['status'] == 'gagal'){
                        echo '<td><span class="badge bg-danger">gagal</span></td>';
                        }
                        ?>
						<td>
						<a class='badge bg-info' href='?waiter=dinikmati&id=<?php echo $data['username'] ?>'>Antar</a>
						</td>	
						</tr>
                        <?php } ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

  <?php if(@$_SESSION['sukses']){ ?>
        <script>
            swal("<?php echo $_SESSION['sukses']; ?>");
        </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>
   
            </div> <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Menu Populer <span>| 2023</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Menu</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Terjual</th>
                        <th scope="col" class="text-center">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php                          
                        $no = 1;
                        $result = mysqli_query($conn,"SELECT * FROM popular_items WHERE total > 3");
                        while ($data = mysqli_fetch_array($result)){
                          $nama_menu = $data['nama_menu'];
                        $fetchdata = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$nama_menu'");
                        $fetch = mysqli_fetch_array($fetchdata);
                        $total = $data['total']*$fetch['harga'];
                      ?>
                      <tr>
                        <th scope="row" class="text-center"><?php echo $no++; ?> </th>
                        <td class="text-center"><a  style="text-decoration:none;" href="?pelanggan=detail&id=<?php echo $fetch['kode_menu'] ?>" class="text-primary fw-bold"><?php echo ucwords($data['nama_menu']);; ?> </a></td>
                        <td class="text-center">Rp.<?php echo $fetch['harga'] ?></td>
                        <td class="fw-bold text-center"><?php echo $data['total'] ?></td>
                        <td class="text-center">Rp.<?php echo $total ?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>


            </div><!-- End Top Selling -->
            
