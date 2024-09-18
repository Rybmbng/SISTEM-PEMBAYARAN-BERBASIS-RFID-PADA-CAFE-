<?php 
    $page = (isset($_GET['pelanggan']))?$_GET['pelanggan'] : '';
    switch($page){
        case 'menu':
            include './page/kartu.php';
            break;
         default :
            include '/index.php';
            break;    
        }
?>