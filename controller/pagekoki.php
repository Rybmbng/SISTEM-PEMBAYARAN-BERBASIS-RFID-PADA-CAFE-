<?php 
    $page = (isset($_GET['koki']))?$_GET['koki'] : '';
    switch($page){
        case  'profile':
            include './page/koki/profil.php';
            break;
        case  'menu':
            include './page/koki/menu.php';
            break;
        case  'profiled':
            include './page/koki/profile.php';
            break;
        case  'kategori':
            include './page/koki/kategori.php';
            break;
        case  'detail':
            include './page/koki/detail_transaksi.php';
            break;
        case  'detail_transaksi':
            include './page/koki/detail.php';
            break;
       
        case  'dapur':
            include './page/koki/koki.php';
            break;
        case  'diproses':
            include './page/koki/proses.php';
            break;
        case  'dimasak':
            include './page/koki/masak.php';
            break;
        case  'diantar':
            include './page/koki/antar.php';
            break;
        case  'dinikmati':
            include './page/koki/nikmati.php';
            break;
        
        default :
        include './page/koki/index.php';
        break;    
        }

            


?>