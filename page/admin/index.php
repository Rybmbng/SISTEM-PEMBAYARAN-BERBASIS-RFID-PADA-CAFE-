<?php
include_once 'controller/config.php';
$sql = mysqli_query($conn, "SELECT * FROM transaksi");

require_once 'penghasilan.php';

$period = isset($_GET['penghasilan']) ? $_GET['penghasilan'] : 'semua';
$data = getDataByPeriod($penghasilan);
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
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Pendapatan Hari ini <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    
                    <?php
                      $total = mysqli_query($conn,"SELECT SUM(total) as totals
                      FROM selesai  WHERE tanggal = CURDATE()");
                      $sum = mysqli_fetch_array($total);
                      ?>
                    <h2 class="mb-5">Rp. <?php if($sum['totals'] == ""){ echo "0"; }else {
                      echo $sum['totals']; } ?></h2>                  
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Penjualan Hari ini <i class="mdi mdi-cart mmdi-24px float-right"></i>
                    </h4>
                    <?php
                      $sql = mysqli_query($conn,"SELECT *FROM selesai   WHERE tanggal = CURDATE() ");
                      $total = mysqli_num_rows($sql);
                      ?>
                    <h2 class="mb-5"><?php if($total == ""){ echo "0"; }else {
                      echo $total; } ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> Users <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                    </h4>
                    <?php
                    $pel = mysqli_query($conn,"SELECT COUNT(*) as baris FROM tb_user");
                    $sqlq = mysqli_query($conn, "SELECT COUNT(*) as baris FROM tb_user WHERE level='pelanggan'");
                    $ceksqlq = mysqli_fetch_array($sqlq);
                    $cekpel = mysqli_fetch_array($pel);
                    ?>
                    <h2 class="mb-5"><?php echo $cekpel['baris'] ?> User</h2>
                    <h6 class="card-text"><?php echo $ceksqlq['baris']?> Pelanggan</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Transaksi Hari Ini</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          <th scope="col">#</th>
                          <th scope="col">Kode Transaksi</th>
                          <th scope="col">Meja</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = mysqli_query($conn,"SELECT * FROM aktifitas ORDER BY no DESC LIMIT 1");
                        $no = 1;
                        while ($data = mysqli_fetch_array($result)){  
                        $sql = mysqli_query($conn, "SELECT *FROM tb_user WHERE username='$data[username]'");
                        $fetch = mysqli_fetch_array($sql);
                        $fetch1 = mysqli_fetch_array(mysqli_query($conn,"SELECT *FROM transaksi WHERE username='$data[username]'"));
                        ?>
                          <tr>
                            <td>
                              <img src="assets/profile/<?php echo $fetch['gambar'] ?>" class="me-2" alt="image"> <?php echo ucwords($fetch['nama_lengkap']) ?>
                            </td>
                            <td> <a href="?admin=detail&id=<?php echo $data['kd_transaksi'] ?>" style="text-decoration:none;"><?php echo $data['kd_transaksi']?> </a> </td>
                            <td>
                              <label class="badge badge-gradient-success"><?php echo $fetch1['meja']; ?></label>
                            </td>
                            <td><?php echo $data['tanggal']?> </td>

                        <?php
                        if($data['aksi'] == 'dipesan'){
                            echo '<td><span class="badge bg-primary">Di Pesan</span></td>';
                        }else
                        if($data['aksi'] == 'diproses'){
                            echo '<td><span class="badge bg-info">Di Proses</span></td>';
                        }else 
                        if($data['aksi'] == 'dimasak'){
                            echo '<td><span class="badge bg-warning">Di Masak</span></td>';
                        }else
                        if($data['aksi'] == 'diantar'){
                            echo '<td><span class="badge bg-primary">Di Antar</span></td>';
                        }else
                        if($data['aksi'] == 'selesai'){
                            echo '<td><span class="badge bg-succes">Selesai</span></td>';
                        }else
                        if($data['aksi'] == 'gagal'){
                            echo '<td><span class="badge bg-danger">Gagal</span></td>';
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
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
              </div>
              <div class="col-md-5 grid-margin stretch-card">
    
          </div>
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
                        $result = mysqli_query($conn,"SELECT * FROM popular_items WHERE total > 3 ORDER BY total desc");
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
            </div>