<?php
include_once 'controller/config.php';
if (isset($_POST['submit'])) {
    $totalMeja = $_POST['total_meja'];
    $query = "SELECT nomor_meja FROM meja";
    $result = mysqli_query($conn, $query);
    $mejaTerpakai = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $nomorMejaTerpakai = array_column($mejaTerpakai, 'nomor_meja');

    for ($i = 1; $i <= $totalMeja; $i++) {
        while (in_array($i, $nomorMejaTerpakai)) {
            $i++; 
        }
        $query = "INSERT INTO meja (nomor_meja, status, username) VALUES ('$i', 'kosong', '')";
        $result = mysqli_query($conn, $query);

    }
    if($result){
        $_SESSION["success"] = 'Meja Telah Di Tambah Sebanyak '.$totalMeja;
    }
}

function hapusMeja($mejaId) {
    $conn = mysqli_connect("localhost", "root", "", "skripsi");

    if (!$conn) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
    $sql = mysqli_query($conn, "SELECT *FROM meja WHERE id=$mejaId");
    $data = mysqli_fetch_array($sql);
    $query = "DELETE FROM meja WHERE id = $mejaId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION["success"] = 'Meja '.$data['nomor_meja'].' Telah hapus';

    } else {
        $_SESSION["gagal"] = 'Gagal Menghapus Meja';

    }
}
    if(isset($_GET['nomor_meja'])){
        $mejaId = @$_GET['nomor_meja'];
        $query = "DELETE FROM meja WHERE nomor_meja = $mejaId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Meja berhasil dihapus.";
        } else {
            echo "Terjadi kesalahan saat menghapus meja.";
        }

}
$query = "SELECT * FROM meja";
$result = mysqli_query($conn, $query);
$mejaPelanggan = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php if(@$_SESSION['success']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Selamat',
          text: '<?php echo $_SESSION['success']; ?>'
        })
        </script>
    <?php unset($_SESSION['success']); } ?>
   

    <?php if(@$_SESSION['gagal']){ ?>
        <script>
          Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?php echo $_SESSION['gagal']; ?>'
        })
        </script>
    <?php unset($_SESSION['gagal']); } ?>
   

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Meja Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item active">Meja</li>
          
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">

    <form method="POST" action="">
        <label for="total_meja" style="font-weight:bold">Tambah Meja :</label>
        <input type="number" name="total_meja" required>

        <input type="submit" name="submit" value="Tambah">
    </form>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><h5>
    <style>
        .meja {
            display: inline-block;
            border: 1px solid black;
            text-align: center;
            width: 200px;
            height: 200px;
            margin: 10px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
        .terisi {
            background-color: #eca1a6; 
        }

        .kosong {
            background-color: #b5e7a0; 
        }
    </style>

    <div class="container">
        <div class="row">
            
    <?php 
    $query = "SELECT * FROM meja ORDER BY nomor_meja asc";
    $result = mysqli_query($conn, $query);
    $mejaPelanggan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($mejaPelanggan as $meja) : ?>
                <div class="col-md-3">
                    <div class="meja <?php echo ($meja['status'] == 'kosong') ? 'kosong' : 'terisi'; ?>">
                        <h3>Meja <?php echo $meja['nomor_meja']; ?></h3>
                        <p>Username: <?php echo $meja['username']; ?></p>
                        <p>Status: <?php echo $meja['status']; ?></p>
                        <?php if ($meja['status'] == 'terisi') : ?>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $meja['nomor_meja']; ?>" >Detail</button>    
                        <?php else : ?>
                            <form method="POST" action="">
                                <input type="hidden" name="meja_id" value="<?php echo $meja['id']; ?>">
                                <input type="submit" name="hapus_<?php echo $meja['id']; ?>" value="Hapus" class="btn btn-danger">
                            </form>
                        <?php endif; ?>

                        
                    </div>
                </div>
                <?php
                // Menghapus meja jika tombol hapus ditekan
                if (isset($_POST['hapus_' . $meja['id']])) {
                    $mejaId = $_POST['meja_id'];
                    hapusMeja($mejaId);
                    // Refresh halaman setelah meja dihapus
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                ?>
                
  <div class="modal fade" id="modal-<?php echo $meja['nomor_meja']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Meja ( <?php echo $meja['nomor_meja']; ?> )</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  <div class="text-center">   
                  <h2>Tabel Produk</h2>
                <table class="table">
                 <thead>
             <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $detail = mysqli_query($conn, "SELECT *FROM transaksi WHERE meja='$meja[nomor_meja]'");
        $fetchdata = mysqli_fetch_array($detail);
        $subtotal = $fetchdata['total'];
        $pajak = $subtotal * 0.1;
        $total = $subtotal + $pajak;
        $kd = $fetchdata['kd_transaksi'];
        $no = 1;
        $sql = mysqli_query($conn,"SELECT *FROM detail WHERE kd_transaksi='$kd'");
        while ($data = mysqli_fetch_array($sql)){
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo ucwords($data['nama_menu']); ?></td>
                <td><?php echo $data['jumlah']?></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
            </div>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sub Total</strong><strong>Rp. <?php echo $subtotal ?></strong>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Pajak</strong><strong>Rp. <?php echo $pajak ?></strong></li>
                  <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong><strong>Rp. <?php echo $total?></strong></li>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>

            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    