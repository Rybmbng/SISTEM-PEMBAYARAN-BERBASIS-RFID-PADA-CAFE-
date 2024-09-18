<?php 
    $page = (isset($_GET['admin']))?$_GET['admin'] : '';
    switch($page){
        case 'pelanggan':
            include './page/admin/pelanggan.php';
            break;
        case 'karyawan':
            include './page/admin/karyawan.php';
            break;
        case  'profile':
            include './page/admin/profil.php';
            break;
        case  'menu':
            include './page/admin/menu.php';
            break;
        case  'profiled':
            include './page/admin/profile.php';
            break;
        case  'kategori':
            include './page/admin/kategori.php';
            break;
        case  'riwayat':
            include './page/admin/riwayat.php';
            break;
        case  'detail':
            include './page/admin/detail_transaksi.php';
            break;
        case  'card':
            include './page/admin/card.php';
            break;
        case  'detail_transaksi':
            include './page/admin/detail.php';
            break;
        case  'detail_old':
            include './page/admin/detail_transaksi_old.php';
            break;
        case  'meja':
            include './page/admin/meja.php';
            break;
             
            
        case  'transaksi':
            include './page/admin/kasir.php';
            break;
        case  'dapur':
            include './page/admin/koki.php';
            break;
        case  'selesai':
            include './page/admin/selesai.php';
            break;
        case  'waiter':
            include './page/admin/waiter.php';
            break;

        case  'diproses':
            include './page/admin/proses.php';
            break;
        case  'dimasak':
            include './page/admin/masak.php';
            break;
        case  'diantar':
            include './page/admin/antar.php';
            break;
        case  'dinikmati':
            include './page/admin/nikmati.php';
            break;
        
        case  'tambah':
            include './page/admin/pesanan.php';
            break;
        
        default :
        include './page/admin/index.php';
        break;    
        }

      
?>