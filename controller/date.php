<?php
  
  require_once 'config.php';
  function getDataByPeriod($period) {
      global $conn;
  
      $sql = "";
      switch ($period) {
          case 'hari':
              $sql = "SELECT * FROM selesai WHERE tanggal = CURDATE()";
              break;
          case 'mingguan':
              $sql = "SELECT * FROM selesai WHERE YEARWEEK(tanggal) = YEARWEEK(CURDATE())";
              break;
          case 'bulanan':
              $sql = "SELECT * FROM selesai WHERE YEAR(tanggal) = YEAR(CURDATE()) AND MONTH(tanggal) = MONTH(CURDATE())";
              break;
          case 'tahunan':
              $sql = "SELECT * FROM selesai WHERE YEAR(tanggal) = YEAR(CURDATE())";
              break;
          default:
              $sql = "SELECT * FROM selesai";
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