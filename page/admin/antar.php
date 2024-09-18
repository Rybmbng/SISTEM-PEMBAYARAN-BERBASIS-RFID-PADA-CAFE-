<?php 
$username = @$_GET['id'];
$tg = date("Y:m:d");
$cekkd = mysqli_query($conn,"SELECT *FROM transaksi WHERE username='$username'");
$fetchkd = mysqli_fetch_array($cekkd);
$kd_transaksi = $fetchkd['kd_transaksi'];
$sql = mysqli_query($conn, "UPDATE transaksi SET status='diantar' WHERE username='$username'");
if($sql){
	mysqli_query($conn, "INSERT into aktifitas SET aksi='diantar', username='$username',tanggal='$tg', kd_transaksi='$kd_transaksi'");
	echo "<script>window.location.href = '?admin=dapur'</script>";
	$_SESSION["sukses"] = 'PESANAN SIAP DIANTAR';

}
?>