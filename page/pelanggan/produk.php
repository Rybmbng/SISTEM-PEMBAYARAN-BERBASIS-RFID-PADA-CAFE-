<?php

if(isset($_GET['kode_menu']) && isset($_GET['jumlah'])){
    $kode_menu = $_GET['kode_menu'];
    $jumlah = $_GET['jumlah'];
    $query = mysqli_query($conn, "SELECT * FROM tb_menu WHERE kode_menu='$kode_menu'")''
    $datas = mysqli_fetch_array($query);
    $kode_menu = $datas['kode_menu'];
    $nama_menu = $datas['nama_menu'];
    $harga = $datas['harga'];
    $stok = $datas['stok'];
}else{
    $kode_menu = "";
    $jumlah = "";
}
?>