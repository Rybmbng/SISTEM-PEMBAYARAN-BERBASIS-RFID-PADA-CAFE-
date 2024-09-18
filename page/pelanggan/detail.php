
        <?php
        $conn = mysqli_connect("localhost","root","","skripsi");
        $sql   = "SELECT * FROM tb_kategori";
        $query = mysqli_query($conn, $sql);
        $menu = @$_GET['id'];
        $fetchdata = mysqli_query($conn,"SELECT * FROM tb_menu WHERE kode_menu='$menu'"); 
        ?>
        <?php
        while ( $data = mysqli_fetch_array($fetchdata)){
        ?>
        <section class="pb-5 pt-8">
        <div class="container">
        <div class="row">
            <div class="col-12">
            <div class="card card-span mb-3 shadow-lg">
                <div class="card-body py-0">
                <div class="row justify-content-center">
                    <div class="col-md-5 col-xl-7 col-xxl-8 g-0 order-0 order-md-1"><img class="img-fluid w-100 fit-cover h-100 rounded-top rounded-md-end rounded-md-top-0" src="assets/menu/<?php echo $data['img']?>" alt="..." /></div>
                    <div class="col-md-7 col-xl-5 col-xxl-4 p-4 p-lg-5">
                    <h1 class="card-title mt-xl-5 mb-4">Yuk Cobain <span class="text-primary"> <?php echo $data['nama_menu'] ?> </span></h1>
                    <p class="fs-1"><?php echo $data['keterangan'] ?></p>
                    harga : <span class="text-1000 fw-bold">Rp.<?php echo $data['harga'] ?>,00</span>
                    <div class="d-grid bottom-0"><a class="btn btn-lg btn-primary mt-xl-6" href="cart.php?act=add&amp;kode_menu=<?php echo $data['kode_menu']; ?>&amp;ref=?pelanggan=keranjang">Tambah Ke Keranjang <i class="fas fa-chevron-right ms-2"></i></a></div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div><!-- end of .container-->

        </section>
        
        <?php } ?>
