<?php 
    $page = (isset($_GET['waiter']))?$_GET['waiter'] : '';
    switch($page){
        case  'waiter':
            include './page/waiter/waiter.php';
            break;
        case  'dinikmati':
            include './page/admin/nikmati.php';
            break;
        
        default :
        include './page/waiter/index.php';
        break;    
        }

            


?>