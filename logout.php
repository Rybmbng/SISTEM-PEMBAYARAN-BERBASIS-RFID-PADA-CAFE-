<?php
include_once'controller/config.php';
session_start();
mysqli_query($conn, "delete from status where username='$_SESSION[username]'");
session_destroy();
header("Location: login.php");
?>  