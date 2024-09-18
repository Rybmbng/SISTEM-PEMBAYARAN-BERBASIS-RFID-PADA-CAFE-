<?php
include 'controller/config.php';
session_start();

if(isset($_SESSION['username']) && ($_SESSION['level'])=='admin'){
  include 'admin.php';
}else
if(isset($_SESSION['username']) && ($_SESSION['level'])=='kasir'){
  include 'kasir.php';
}else
if(isset($_SESSION['username']) && ($_SESSION['level'])=='koki'){
  include 'koki.php';
}else
if(isset($_SESSION['username']) && ($_SESSION['level'])=='waiter'){
  include 'waiter.php';
}else
if(isset($_SESSION['username']) && ($_SESSION['level'])=='pelanggan'){
  include 'index.php';
}

if(!isset($_SESSION['username'])){
  include 'login.php';
}

?>