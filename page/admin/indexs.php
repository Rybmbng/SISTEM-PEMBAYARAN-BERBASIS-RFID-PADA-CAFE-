<?php
include_once 'controller/config.php';
$sql = mysqli_query($conn, "SELECT * FROM transaksi");
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Penjualan <span>| Hari Ini</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $sql = mysqli_query($conn,"SELECT *FROM transaksi");
                      $total = mysqli_num_rows($sql);
                      ?>
                      <h6><?php echo $total ?></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Pendapatan <span>| Hari Ini</span></h5>
                  <?php
                      $total = mysqli_query($conn,"SELECT SUM(total) as totals
                      FROM selesai");
                      $sum = mysqli_fetch_array($total);
                      ?>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Rp. <?php echo $sum['totals'] ?></h6>
                     </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Riwayat Penjualan <span>| Hari ini</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $result = mysqli_query($conn,"SELECT * FROM aktifitas");
                        $no = 1;
                        while ($data = mysqli_fetch_array($result)){
                        $sql = mysqli_query($conn, "SELECT *FROM tb_user WHERE username='$data[username]'");
                        $fetch = mysqli_fetch_array($sql);
                      ?>
                      <tr>
                        <th scope="row"><a href="#"><?php echo $no++; ?></a></th>
                        <td><a href="?admin=detail&id=<?php echo $data['kd_transaksi'] ?>"><?php echo $data['kd_transaksi']?> </a></td>
                        <td><?php echo ucwords($fetch['nama_lengkap']); ?></td>
                        <td><?php echo $data['tanggal']?></td>
                        <?php
                        if($data['aksi'] == 'dipesan'){
                          echo '<td><span class="badge bg-primary">Dipesan</span></td>';
                       }else
                       if($data['aksi'] == 'diproses'){
                        echo '<td><span class="badge bg-info">diproses</span></td>';
                     }else 
                     if($data['aksi'] == 'dimasak'){
                      echo '<td><span class="badge bg-warning">dimasak</span></td>';
                      }else
                      if($data['aksi'] == 'diantar'){
                       echo '<td><span class="badge bg-primary">diantar</span></td>';
                     }else
                     if($data['aksi'] == 'selesai'){
                      echo '<td><span class="badge bg-succes">selesai</span></td>';
                    }else
                    if($data['aksi'] == 'gagal'){
                     echo '<td><span class="badge bg-danger">gagal</span></td>';
                   }else
                   if($data['aksi'] == 'dinikmati'){
                    echo '<td><span class="badge bg-primary">Menunggu Pembayaran</span></td>';
                  }
                        ?>
                      </tr>
                      <?php } ?>

                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Menu Populer <span>| 2023</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Terjual</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php
                        $result = mysqli_query($conn,"SELECT * FROM popular_items");
                        while ($data = mysqli_fetch_array($result)){
                          $no = 1;
                          $nama_menu = $data['nama_menu'];
                        $fetchdata = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$nama_menu'");
                        $fetch = mysqli_fetch_array($fetchdata);
                        $total = $data['total']*$fetch['harga'];
                      ?>
                      <tr>
                        <th scope="row"><?php echo $no++; ?> </th>
                        <td><a href="?pelanggan=detail&id=<?php echo $fetch['kode_menu'] ?>" class="text-primary fw-bold"><?php echo ucwords($data['nama_menu']);; ?> </a></td>
                        <td>Rp.<?php echo $fetch['harga'] ?>,00</td>
                        <td class="fw-bold"><?php echo $data['total'] ?></td>
                        <td>Rp.<?php echo $total ?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          
            <!-- Customers Card -->

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Users <span>| Bulan Ini</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <?php
                    $pel = mysqli_query($conn,"SELECT COUNT(*) as baris FROM tb_user");
                    $sqlq = mysqli_query($conn, "SELECT COUNT(*) as baris FROM tb_user WHERE level='pelanggan'");
                    $ceksqlq = mysqli_fetch_array($sqlq);
                    $cekpel = mysqli_fetch_array($pel);
                    ?>
                    <div class="ps-3">
                      <h6><?php echo $cekpel['baris'] ?> User <br> <?php echo $ceksqlq['baris']?> Pelanggan</h6>
                     </div>
                  </div>

                </div>
              </div>
          <!-- Recent Activity -->
          <div class="card">
              <div class="card-body">
              <h5 class="card-title">Riwayat Transaksi <span>| Today</span></h5>
              
              <?php
                $result = mysqli_query($conn,"SELECT * FROM aktifitas");
                while ($data = mysqli_fetch_array($result)){
                $sql = mysqli_query($conn, "SELECT *FROM tb_user WHERE username='$data[username]'");
                $fetch = mysqli_fetch_array($sql);
              ?>
              <div class="activity">
                <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo $data['tanggal'] ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Transaksi atas Nama <a class="fw-bold text-dark"><?php echo ucwords($fetch['nama_lengkap']) ?></a> telah <?php echo ucwords($data['aksi']) ?>
                  </div>
                </div>
              </div>
              <?php } ?>
              
            </div>
            

            

          </div><!-- End Recent Activity -->

          <div class="card">
              <div class="card-body">
              <h5 class="card-title">Riwayat Transaksi <span>| Today</span></h5>
              
              <?php
                $result = mysqli_query($conn,"SELECT * FROM selesai");
                while ($data = mysqli_fetch_array($result)){
                $sql = mysqli_query($conn, "SELECT *FROM tb_user WHERE username='$data[username]'");
                $fetch = mysqli_fetch_array($sql);
              ?>
              <div class="activity">
                <div class="activity-item d-flex">
                  <div class="activite-label">Rp. <?php echo $data['total'] ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Transaksi atas Nama <a class="fw-bold text-dark"><?php echo ucwords($fetch['nama_lengkap']) ?></a> telah Selesai
                  </div>
                </div>
              </div>
              <?php } ?>
              
            </div>
            

            

          </div><!-- End Recent Activity -->


        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
