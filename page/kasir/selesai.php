
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Transaksi Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
          <li class="breadcrumb-item active">Selesai</li>
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
						      <th>Kode Transaksi</th>
						      <th>Tanggal</th>
						      <th>Total</th>
						    </tr>
						  </thead>
						  <tbody>
                          	<?php
							$date = date("y-m-d");
                        	 $sql = mysqli_query($conn,"SELECT * FROM selesai WHERE tanggal='$date'");
                            while ($data = mysqli_fetch_array($sql)){
								
								$fetch = mysqli_fetch_array(mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$data[username]'"));
							?>
						    <tr>
						      <th scope="row"><?php echo $data['no'] ?></th>
						      <td><a href="?admin=detail_old&kd_transaksi=<?php echo $data['kd_transaksi'] ?>"><?php echo ucwords($fetch['nama_lengkap']) ?></a></td>
						      <td><?php echo $data['kd_transaksi'] ?></td>
							  <td><?php echo $data['tanggal'] ?></td>
							  <td>Rp.<?php echo $data['total'] ?></td>
							</tr>
                        <?php } ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

    </section>
	</div>
        </div>
        </div>
      </div>
  </main><!-- End #main -->

  <?php if(@$_SESSION['sukses']){ ?>
        <script>
            swal("<?php echo $_SESSION['sukses']; ?>");
        </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>
   