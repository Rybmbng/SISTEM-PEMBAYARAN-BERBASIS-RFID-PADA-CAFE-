
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Transaksi Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
          <li class="breadcrumb-item active">Kasir</li>
        </ol>
      </nav>
    </div>
<div class="card">
<a href="?admin=tambah" class="btn btn-primary me-md-2" > Buat Pesanan <i class="bi bi-plus"></i> </a> 
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
                          $sql = mysqli_query($conn,"SELECT * FROM transaksi");
                            while ($data = mysqli_fetch_array($sql)){
                              $fetch = mysqli_fetch_array(mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$data[username]'"));

                            $pajak = $data['total'] * 0.1;
                            $subtotal = $data['total'];
							$total = $subtotal + $pajak;
                        ?>
						    <tr>
						      <th scope="row"><?php echo $data['no'] ?></th>
						      <td><a href="?admin=detail&id=<?php echo $data['kd_transaksi'] ?>"><?php echo ucwords($fetch['nama_lengkap']) ?></a></td>
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
                        }else
                        if($data['status'] == 'dinikmati'){
                        echo '<td><span class="badge bg-danger">Menunggu Pembayaran</span></td>';
                        }
                        ?>
						<td>
						<?php 
						if($data['status'] == 'dipesan'){
                          echo "<a class='badge bg-info' href='?admin=diproses&id=$data[username]'>Terima</a>";
                        }else if($data['status'] == 'dinikmati'){
							echo "<a class='badge bg-info' href='?admin=detail&id=$data[kd_transaksi]'>Bayar</a>";
						  }else{
							echo "<span class='badge bg-primary'>Diterima</span>";
						}
						?>
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
   

    
<div class="modal fade" id="buat-pesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <label for="menu" class="form-label">Nama Lengkap</label>
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="Nomor Tertera Dikartu" name="nomor_kartu" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="menu" class="form-label">Nomor Kartu</label>
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="Nomor Tertera Dikartu" name="nomor_kartu" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="menu" class="form-label">Nomor Kartu</label>
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="Nomor Tertera Dikartu" name="nomor_kartu" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="menu" class="form-label">Nomor Kartu</label>
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="Nomor Tertera Dikartu" name="nomor_kartu" id="menu" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
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
