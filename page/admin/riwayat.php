<?php
require_once 'date.php';
$period = isset($_GET['period']) ? $_GET['period'] : 'semua';
$data = getDataByPeriod($period);

?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Transaksi Rumah Singgah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?admin=">Home</a></li>
          <li class="breadcrumb-item">Transaksi</li>
          <li class="breadcrumb-item active">Selesai</li>
        </ol>
      </nav>
    </div>
<div class="card">
<div class="card-body">
<ul>
<form id="dateForm">
        <label for="tanggal_mulai">Tanggal Mulai:</label>
        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">

        <label for="tanggal_selesai">Tanggal Selesai:</label>
        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai">

        <input class="btn btn-success" type="submit" value="Tampilkan">
    </form>


    </ul>
    <section class="section">
    <section class="ftco-section">
	<div id="resultContainer"></div>

<script>
	$(document).ready(function() {
		// Tangkap form saat disubmit
		$('#dateForm').submit(function(event) {
			// Hentikan aksi default (redirect)
			event.preventDefault();

			// Ambil nilai tanggal_mulai dan tanggal_selesai
			var tanggal_mulai = $('#tanggal_mulai').val();
			var tanggal_selesai = $('#tanggal_selesai').val();

			// Kirim data ke server dengan AJAX
			$.ajax({
				type: 'GET',
				url: 'get.php',
				data: {
					tanggal_mulai: tanggal_mulai,
					tanggal_selesai: tanggal_selesai
				},
				success: function(response) {
					// Tampilkan hasil dari server di dalam container
					$('#resultContainer').html(response);
				},
				error: function() {
					alert('Terjadi kesalahan dalam memuat data transaksi.');
				}
			});
		});

		// Tangkap klik pada tautan "Cetak ke Excel"
		$('#cetakExcel').click(function(event) {
			event.preventDefault();

			// Ambil nilai tanggal_mulai dan tanggal_selesai
			var tanggal_mulai = $('#tanggal_mulai').val();
			var tanggal_selesai = $('#tanggal_selesai').val();

			// Redirect ke halaman "get_transaksi.php" dengan parameter "cetak"
			window.location.href = 'get.php?tanggal_mulai=' + tanggal_mulai + '&tanggal_selesai=' + tanggal_selesai + '&cetak=1';
		});
	});
</script>		
	</section>

	<div align="right">
	<a  href="#" class="btn btn-primary" id="cetakExcel">Cetak ke Excel</a>
	</div>
    </section>
	</div>    
	 <?php
    if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_selesai'])) {
        $tanggal_mulai = $_GET['tanggal_mulai'];
        $tanggal_selesai = $_GET['tanggal_selesai'];
        $excelLink = "export.php?tanggal_mulai=$tanggal_mulai&tanggal_selesai=$tanggal_selesai";
        echo "<a class='btn btn-primary' href=\"$excelLink\" target=\"_blank\">Cetak ke Excel</a>";
    }
    ?>
        </div>
        </div>
      </div>
	  
  </main><!-- End #main -->

  <?php if(@$_SESSION['sukses']){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: '<?php echo $_SESSION['sukses']; ?>'
        })
        </script>
    <?php unset($_SESSION['sukses']); } ?>
   