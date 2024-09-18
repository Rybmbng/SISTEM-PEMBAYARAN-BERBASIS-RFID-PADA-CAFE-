<?php
    require_once ('controller/config.php');
        session_start();
    if (isset($_GET['act']) && isset($_GET['ref'])) {
        $act = $_GET['act'];
        $ref = $_GET['ref'];
             
        if ($act == "add") {
            if (isset($_GET['kode_menu'])) {
                $kode_menu = $_GET['kode_menu'];
                if (isset($_SESSION['items'][$kode_menu])) {
                  $_SESSION['items'][$kode_menu] += 1;
                } else {
                  $_SESSION['items'][$kode_menu] = 1; 
                }
            }
        } elseif ($act == "plus") {
            if (isset($_GET['kode_menu'])) {
                $kode_menu = $_GET['kode_menu'];
                if (isset($_SESSION['items'][$kode_menu])) {
                  $_SESSION['items'][$kode_menu] += 1;
                }
            }
        } elseif ($act == "min") {
            if (isset($_GET['kode_menu'])) {
                $kode_menu = $_GET['kode_menu'];
                if (isset($_SESSION['items'a][$kode_menu])) {
                 $_SESSION['items'][$kode_menu] -= 1;
                }
            }
        } elseif ($act == "del") {
            if (isset($_GET['kode_menu'])) {
                $kode_menu = $_GET['kode_menu'];
                if (isset($_SESSION['items'][$kode_menu])) {
                    unset($_SESSION['items'][$kode_menu]);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $val) {
                    unset($_SESSION['items'][$key]);
                }
                unset($_SESSION['items']);
            }
        } 
        header ("location:" . $ref);
    }   
     
?>