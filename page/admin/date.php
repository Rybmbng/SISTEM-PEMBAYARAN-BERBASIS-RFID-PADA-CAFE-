<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "","skripsi");
  
  function getDataByPeriod($period) {
      global $conn;
      global $url;

      $sql = "";
      switch ($period) {
          case 'hari':
              $sql = "SELECT * FROM selesai WHERE tanggal = CURDATE()";
              $url = "export_harian.php";
              break;
          case 'mingguan':
              $sql = "SELECT * FROM selesai WHERE YEARWEEK(tanggal) = YEARWEEK(CURDATE())";
              $url = "export_mingguan.php";
              break;
          case 'bulanan':
              $sql = "SELECT * FROM selesai WHERE YEAR(tanggal) = YEAR(CURDATE()) AND MONTH(tanggal) = MONTH(CURDATE())";
              $url = "export_bulanan.php";
              break;
          case 'tahunan':
              $sql = "SELECT * FROM selesai WHERE YEAR(tanggal) = YEAR(CURDATE())";
              $url = "export_tahunan.php";
              break;
          default:
              $sql = "SELECT * FROM selesai";
              $url = "export.php";
              break;
      }
  
      $result = $conn->query($sql);
      $data = array();
  
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
      }
      return $data;
  }
  
?>