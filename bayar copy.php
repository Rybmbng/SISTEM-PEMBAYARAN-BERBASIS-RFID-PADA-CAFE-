<?php
session_start();
error_reporting(0);
include_once 'controller/config.php';
if(isset($_POST['checkout'])) {
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once 'template/style.php' ?>  
</head>
<body>
    
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
unset($_SESSION['berhasil']); 
} ?>
<div class="event-schedule-area-two bg-color pad100">
    <div class="container">
        <div class="row py-5 overflow-hidden bg-warning">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text">
                        <h2>PEMBAYARAN MENGGUNAKAN KARTU RUMAH SINGGAH</h2>
                    </div>
                    <p>
                       Silahkan pilih atau klik menu untuk melakukan pembayaran.
                    </p>
                </div>
            </div>
            <!-- /.col end-->
        </div>
        <!-- row end-->
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Profile</th>
                                        <th class="text-center" scope="col">Nama</th>
                                        <th class="text-center" scope="col">Total</th>
                                        <th class="text-center" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $no = 1;
                                     $sql = mysqli_query($conn,"SELECT *FROM transaksi WHERE status='dinikmati'");
                                     while ($data = mysqli_fetch_array($sql)){  
                                     $username = $data['username'];
                                     $sqld = mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$username'");
                                     $datas = mysqli_fetch_array($sqld);
                                     $pajak = $data['total']*0.1;
                                     $total = $data['total']+$pajak;
                                     ?>
                                     
                                    <tr class="inner-box" class="text-center">
                                        <th scope="row" class="text-center" >
                                            <div class="event-date">
                                                <span class="text-center"><?php echo $no++; ?> </span>
                                            </div>
                                        </th>
                                        <td class="text-center">
                                            <div class="event-img">
                                                <img src="assets/profile/<?php echo $datas['gambar'] ?>" style="height:80px;width:80px;" class="rounded"alt="" />
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="event-wrap">
                                                <h3><a ><?php?></a></h3>
                                                <div class="meta">
                                                    <div class="organizers">
                                                        <a style="font-weight:bold"><?php echo ucwords($datas['nama_lengkap'])?> </a>
                                                    </div>
                                                    <div class="categories">
                                                        <a >Meja No (<?php echo $data['meja']?>)</a>
                                                    </div>
                                                    <div class="time">
                                                        <span><?php echo $data['tanggal']?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="r-no">
                                                <span>Rp.<?php echo $total ?> </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="primary-btn">
                                                <a class="btn btn-primary" href="detail.php?id=<?php echo $data['kd_transaksi']?>">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
</div>
	<!-- Panggil file JavaScript Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>