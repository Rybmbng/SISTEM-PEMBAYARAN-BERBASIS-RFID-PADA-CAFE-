<?php 
$username = @$_GET['id'];
$tg = date("Y:m:d");
$cekkd = mysqli_query($conn,"SELECT *FROM transaksi WHERE username='$username'");
$fetchkd = mysqli_fetch_array($cekkd);
$kd_transaksi = $fetchkd['kd_transaksi'];
$sql = mysqli_query($conn, "UPDATE transaksi SET status='dinikmati' WHERE username='$username'");
if($sql){
	mysqli_query($conn, "INSERT into aktifitas SET aksi='dinikmati', username='$username',tanggal='$tg', kd_transaksi='$kd_transaksi'");
    echo "<script>window.location.href = '?admin=waiter'</script>";
	$_SESSION["sukses"] = 'PESANAN SEDANG DINIKMATI';
}
?>