<?php

error_reporting(0);
$conn = mysqli_connect("localhost", "root", "","skripsi");

function getDataByPeriod($penghasilan) {
    global $conn;

    $sql = "";
    switch ($penghasilan) {
        case 'hari':
            $sql = "SELECT SUM(total) as totals FROM selesai WHERE tanggal = CURDATE()";
            break;
        case 'mingguan':
            $sql = "SELECT SUM(total) as totals FROM selesai WHERE YEARWEEK(tanggal) = YEARWEEK(CURDATE())";
            break;
        case 'bulanan':
            $sql = "SELECT SUM(total) as totals FROM selesai WHERE YEAR(tanggal) = YEAR(CURDATE()) AND MONTH(tanggal) = MONTH(CURDATE())";
            break;
        case 'tahunan':
            $sql = "SELECT SUM(total) as totals FROM selesai WHERE YEAR(tanggal) = YEAR(CURDATE())";
            break;
        default:
            $sql = "SELECT SUM(total) as totals FROM selesai";
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