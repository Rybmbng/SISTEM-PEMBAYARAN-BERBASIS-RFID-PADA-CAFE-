<?php
	include 'config.php';
	error_reporting(0);
	$sql = mysqli_query($conn, "SELECT * FROM rfid");
	$data = mysqli_fetch_array($sql);
	$id_kartu = $data['id_kartu'];
	$sqld = mysqli_query($conn, "SELECT * FROM cards WHERE id_kartu='$id_kartu'");
	$fetch = mysqli_fetch_array($sqld);

?>
 <input type="text" readonly class="form-control" id="inputText4" name="id_kartu" placeholder="Kode Kartu"  value="<?php echo $id_kartu;?>" hidden require>
<p class="color-white"></p>
 <input type="text" readonly class="form-control" id="inputText4" name="nama_lengkap" placeholder="Nama Anggota"  value="<?php echo $fetch['nama_lengkap']; ?>" hidden>
 <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-bold" >ID_KARTU</strong><strong><?php echo $id_kartu?></strong>
 <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-bold" >Nama Lengkap</strong><strong><?php echo $fetch['nama_lengkap']?></strong>
