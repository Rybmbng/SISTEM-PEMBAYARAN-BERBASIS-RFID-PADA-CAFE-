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
    
<div class="card">
<div class="card-body">
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
            
