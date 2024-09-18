<?php
include_once 'controller/config.php';
$aktifitas = mysqli_query($conn,"delete from aktifitas where username='$_SESSION[username]'");
if($aktifitas){
    $hapus_detail = mysqli_query($conn,"delete from detail where username='$_SESSION[username]'");
        if($hapus_detail){
            $hapus_transaksi = mysqli_query($conn,"delete from transaksi where username='$_SESSION[username]'");
        }else{
            echo "<script>alert('GAGAL')</script>";

        }
}

?>