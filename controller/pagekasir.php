<?php 
    $page = (isset($_GET['kasir']))?$_GET['kasir'] : '';
    switch($page){
        case 'pelanggan':
            include './page/kasir/pelanggan.php';
            break;
        case 'karyawan':
            include './page/kasir/karyawan.php';
            break;
        case  'profile':
            include './page/kasir/profil.php';
            break;
        case  'menu':
            include './page/kasir/menu.php';
            break;
        case  'profiled':
            include './page/kasir/profile.php';
            break;
        case  'kategori':
            include './page/kasir/kategori.php';
            break;
        case  'riwayat':
            include './page/kasir/riwayat.php';
            break;
        case  'detail':
            include './page/kasir/detail_transaksi.php';
            break;
        case  'detail_transaksi':
            include './page/kasir/detail.php';
            break;
        case  'detail_old':
            include './page/kasir/detail_transaksi_old.php';
            break;
            
        case  'transaksi':
            include './page/kasir/kasir.php';
            break;
        case  'dapur':
            include './page/kasir/koki.php';
            break;
        case  'selesai':
            include './page/kasir/selesai.php';
            break;
        case  'waiter':
            include './page/kasir/waiter.php';
            break;

        case  'diproses':
            include './page/kasir/proses.php';
            break;
        case  'dimasak':
            include './page/kasir/masak.php';
            break;
        case  'diantar':
            include './page/kasir/antar.php';
            break;
        case  'dinikmati':
            include './page/kasir/nikmati.php';
            break;
        
        default :
        include './page/kasir/index.php';
        break;    
        }

            


?>