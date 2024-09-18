<?php
include 'config.php';
$var1 = $_GET['data'];
mysqli_query($conn, "DELETE FROM notif WHERE 1");
mysqli_query($conn, "INSERT INTO notif SET value = '0'");
echo "success";
?>