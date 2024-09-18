<?php
include 'config.php';
$var1 = $_GET['data'];
mysqli_query($conn, "DELETE FROM rfid WHERE 1");
mysqli_query($conn, "INSERT INTO rfid SET id_kartu = '$var1'");
echo "success";
?>