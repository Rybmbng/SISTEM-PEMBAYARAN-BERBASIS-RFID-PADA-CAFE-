
        
        <section class="py-5 overflow-hidden bg-primary" id="home">
        <div class="container">
          <div class="row flex-center">
            <div class="col-md-5 col-lg-6 order-0 order-md-1 mt-8 mt-md-0"><a class="img-landing-banner" href="#!"><img class="img-fluid" src="assets_pelanggan/img/gallery/hero-header.png" alt="hero-header" /></a></div>
            <div class="col-md-7 col-lg-6 py-8 text-md-start text-center">
              <h1 class="display-1 fs-md-5 fs-lg-6 fs-xl-8 text-light">Are you starving?</h1>
              <h1 class="text-800 mb-5 fs-4">Dengan beberapa klik,<br class="d-none d-xxl-block" />makanan akan tiba dimejamu.</h1>
            </div>
          </div>
        </div>
      </section>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 bg-primary-gradient">

        <div class="container">
          <div class="row justify-content-center g-0">
            <div class="col-xl-9">
              <div class="col-lg-6 text-center mx-auto mb-3 mb-md-5 mt-4">
                <h5 class="fw-bold text-danger fs-3 fs-lg-5 lh-sm my-6">Bagaimana Pemesanan?</h5>
              </div>
              <div class="row">
                <div class="col-sm-6 col-md-3 mb-6">
                  <div class="text-center"><img class="shadow-icon" src="assets_pelanggan/img/gallery/location.png" height="112" alt="..." />
                    <h5 class="mt-4 fw-bold">Login</h5>
                    <p class="mb-md-0">Anda Diwajibkan Login Ke Akun Sendiri Untuk Pemesanan.</p>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-6">
                  <div class="text-center"><img class="shadow-icon" src="assets_pelanggan/img/gallery/order.png" height="112" alt="..." />
                    <h5 class="mt-4 fw-bold">Pilih Menu</h5>
                    <p class="mb-md-0">Silahkan Pilih Menu Yang Anda Di Etalase Web, Ada Banyak Menu Masakan Yang Bisa Anda Nikmati</p>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-6">
                  <div class="text-center"><img class="shadow-icon" src="assets_pelanggan/img/gallery/meals.png" height="112" alt="..." />
                    <h5 class="mt-4 fw-bold">Nikmati Hidangan Anda</h5>
                    <p class="mb-md-0">Makanan Telah Disajikan Kepada Anda</p>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-6">
                  <div class="text-center"><img class="shadow-icon" src="assets_pelanggan/img/gallery/pay.png" height="112" alt="..." />
                    <h5 class="mt-4 fw-bold">Pembayaran</h5>
                    <p class="mb-md-0">Anda Dapat Melakukan Pembayaran Cash Ke Kasir Atau Menggunakan Kartu Pada Tempat Yang Telah Disediakan</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




    

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-8 overflow-hidden">

        <div class="container">
          <div class="row flex-center mb-6">
            <div class="col-lg-7">
              <h5 class="fw-bold fs-3 fs-lg-5 lh-sm text-center text-lg-start">Pilih Berdasarkan Kategori</h5>
            </div>
            <div class="col-lg-4 text-lg-end text-center"><a class="btn btn-lg text-800 me-2" href="#" role="button">VIEW ALL <i class="fas fa-chevron-right ms-2"></i></a></div>
            <div class="col-lg-auto position-relative">
              <button class="carousel-control-prev s-icon-prev carousel-icon" type="button" data-bs-target="#carouselSearchByFood" data-bs-slide="prev"><span class="carousel-control-prev-icon hover-top-shadow" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
              <button class="carousel-control-next s-icon-next carousel-icon" type="button" data-bs-target="#carouselSearchByFood" data-bs-slide="next"><span class="carousel-control-next-icon hover-top-shadow" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
            </div>
          </div>
          <div class="row flex-center">
            <div class="col-12">
              <div class="carousel slide" id="carouselSearchByFood" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                  <div class="carousel-item active" data-bs-interval="10000">
                    <div class="row h-100 align-items-center">

                                        <?php
                        while ($data = mysqli_fetch_array($result)){
                        ?>
        <div class="col-sm-6 col-md-4 col-xl mb-5 h-100">
                        <div class="card card-span h-100"><a href="?pelanggan=menu&id=<?php echo $data['kd_kategori'] ?>"><img class="img-fluid rounded h-100" src="assets/menu/<?php $data['kd_kategori'] ?><?php echo $data['gambar'] ?>" alt="..." />
                          <div class="card-body ps-0">
                            <h5 class="text-center fw-bold text-1000 text-truncate mb-2"><?php echo $data['nama_kategori']?></h5>
                          </div>
                        </a>
                        </div>
                      </div>
<?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pb-5 pt-8">

        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card card-span mb-3 shadow-lg">
                <div class="card-body py-0">
                <?php
                    $sql = mysqli_query($conn, "SELECT * FROM tb_menu WHERE nama_menu='Mie Pedas'");
                        while ($data = mysqli_fetch_array($sql)){
                        ?>
                  <div class="row justify-content-center">
                    <div class="col-md-5 col-xl-7 col-xxl-8 g-0 order-0 order-md-1"><img class="img-fluid w-100 fit-cover h-100 rounded-top rounded-md-end rounded-md-top-0" src="assets/menu/<?php echo $data['img'] ?>" alt="..." /></div>
                    <div class="col-md-7 col-xl-5 col-xxl-4 p-4 p-lg-5">
                      <h1 class="card-title mt-xl-5 mb-4">Yuk Cobain <span class="text-primary"> Mie Pedas</span></h1>
                      <p class="fs-1">Rasakan sensasi pedas nikmat yang membuat anda tidak galau lagi</p>
                      <div class="d-grid bottom-0"><a class="btn btn-lg btn-primary mt-xl-6" href="?pelanggan=detail&id=<?php echo $data['kode_menu'] ?>">PROCEED TO ORDER<i class="fas fa-chevron-right ms-2"></i></a></div>
                    </div>
                  </div>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0">

        <div class="container">
          <div class="row">
            <div class="col-12">
            <?php
                    $sql = mysqli_query($conn, "SELECT * FROM tb_menu WHERE nama_menu='Ayam Goreng'");
                        while ($data = mysqli_fetch_array($sql)){
                        ?>
              <div class="card card-span mb-3 shadow-lg">
                <div class="card-body py-0">
                  <div class="row justify-content-center">
                    <div class="col-md-5 col-xl-7 col-xxl-8 g-0 order-md-0"><img class="img-fluid w-100 fit-cover h-100 rounded-top rounded-md-start rounded-md-top-0" src="assets/menu/<?php echo $data['img'] ?>" alt="..." /></div>
                    <div class="col-md-7 col-xl-5 col-xxl-4 p-4 p-lg-5">
                      <h1 class="card-title mt-xl-5 mb-4">Celebrate parties with <span class="text-primary">Fried Chicken</span></h1>
                      <p class="fs-1">Get the best fried chicken smeared with a lip smacking lemon chili flavor. Check out best deals for fried chicken.</p>
                      <div class="d-grid bottom-0"><a class="btn btn-lg btn-primary mt-xl-6" href="?pelanggan=detail&id=<?php echo $data['kode_menu'] ?>">PROCEED TO ORDER<i class="fas fa-chevron-right ms-2"></i></a></div>
                    </div>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-5">

        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card card-span mb-3 shadow-lg">
              <?php
                    $sql = mysqli_query($conn, "SELECT * FROM tb_menu WHERE nama_menu='moktail'");
                        while ($data = mysqli_fetch_array($sql)){
                        ?>
                <div class="card-body py-0">
                  <div class="row justify-content-center">
                    <div class="col-md-5 col-xl-7 col-xxl-8 g-0 order-0 order-md-1"><img class="img-fluid w-100 fit-cover h-100 rounded-top rounded-md-end rounded-md-top-0" src="assets/menu/<?php echo $data['img'] ?>" alt="..." /></div>
                    <div class="col-md-7 col-xl-5 col-xxl-4 p-4 p-lg-5">
                      <h1 class="card-title mt-xl-5 mb-4">Wanna Drink Cool & <span class="text-primary">Fresh Moktail?</span></h1>
                      <p class="fs-1">Pair up with a friend and enjoy the Moktail. Try it with the best deals.</p>
                      <div class="d-grid bottom-0"><a class="btn btn-lg btn-primary mt-xl-6" href="?pelanggan=detail&id=<?php echo $data['kode_menu'] ?>">PROCEED TO ORDER<i class="fas fa-chevron-right ms-2"></i></a></div>
                    </div>
                  </div>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->

  <!-- ============================================-->
      <!-- <section> begin ============================-->
        <section class="py-4 overflow-hidden">
          <div class="container">
            <div class="row h-100">
              <div class="col-lg-7 mx-auto text-center mt-7 mb-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Popular items</h5>
              </div>
              <div class="col-12">
                <div class="carousel slide" id="carouselPopularItems" data-bs-touch="false" data-bs-interval="false">
                  <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                      <div class="row gx-3 h-100 align-items-center">
                         <?php
                        $result = mysqli_query($conn,"SELECT * FROM popular_items WHERE total > 3");
                        while ($data = mysqli_fetch_array($result)){
                          $no = 1;
                          $nama_menu = $data['nama_menu'];
                        $fetchdata = mysqli_query($conn,"SELECT *FROM tb_menu WHERE nama_menu='$nama_menu' ");
                        $fetch = mysqli_fetch_array($fetchdata);
                        $total = $data['total']*$fetch['harga'];
                      ?>

                        <div class="col-sm-6 col-md-4 col-xl mb-5 h-100">
                          <div class="card card-span h-100 rounded-3"><img class="img-fluid rounded-3 h-100" src="assets/menu/<?php echo $fetch['img'] ?>" alt="..." />
                            <div class="card-body ps-0">
                              <h5 class="fw-bold text-1000 text-truncate mb-1"><?php echo $data['nama_menu'] ?></h5>
                              <div><span class="text-warning me-2"><i class="fas fa-map-marker-alt"></i></span><span class="text-primary">Rumah Singgah</span></div><span class="text-1000 fw-bold">Rp.<?php echo $fetch['harga'] ?>,00</span>
                            </div>
                          </div>
                          <div class="d-grid gap-2"><a class="btn btn-lg btn-danger" href="?pelanggan=detail&id=<?php echo $fetch['kode_menu'] ?>" role="button">Order now</a></div>
                        </div>
                        <?php } ?>
                      </div>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-primary" href="#!">View All <i class="fas fa-chevron-right ms-2"> </i></a></div>
            </div>
          </div>
        </section>

        

