  
        <section class="py-4 overflow-hidden">
          <div class="container">
            <div class="row h-100">
              <div class="col-lg-7 mx-auto text-center mt-7 mb-5">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Menu Rumah Singgah</h5>
              </div>
              <div class="col-12">
                <div class="carousel slide" id="carouselPopularItems" data-bs-touch="false" data-bs-interval="false">
                  <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                      <div class="row gx-3 h-100 align-items-center">
                    
                      <?php
                            $conn = mysqli_connect("localhost","root","","skripsi");
                            $id = @$_GET['id'];
                            $fetchdata = mysqli_query($conn,"SELECT * FROM tb_menu WHERE kd_kategori='$id'");
                    ?>

                        <?php
                        while ( $data = mysqli_fetch_array($fetchdata)){
                        ?>


                        <div class="col-sm-6 col-md-4 col-xl mb-5 h-100">
                          <div class="card card-span h-100 rounded-3"><img class="img-fluid rounded-3 h-100" src="assets/menu/<?php echo $data['img'] ?>" alt="..." />
                            <div class="card-body ps-0">
                              <h5 class="fw-bold text-1000 text-truncate mb-1"><?php echo $data['nama_menu'] ?></h5>
                              <div><span class="text-warning me-2"><i class="fas fa-map-marker-alt"></i></span><span class="text-primary">Rumah Singgah</span></div><span class="text-1000 fw-bold">Rp.<?php echo $data['harga'] ?>,00</span>
                            </div>
                          </div>
                          <div class="d-grid gap-2"><a class="btn btn-lg btn-danger" href="?pelanggan=detail&id=<?php echo $data['kode_menu'] ?>" role="button">Order now</a></div>
                        </div>
                        <?php } ?>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </section>