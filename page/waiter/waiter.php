
<main id="main" class="main">
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

    </section>

  </main><!-- End #main -->
  <?php if(@$_SESSION['sukses']){ ?>
        <script>
            swal("<?php echo $_SESSION['sukses']; ?>");
        </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['sukses']); } ?>
   