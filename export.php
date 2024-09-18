<?php
require 'vendor/autoload.php'; // Lokasi vendor/autoload.php sesuaikan dengan proyek Anda

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'controller/config.php';
// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil parameter tanggal dari URL
$tanggal_mulai = $_GET['tanggal_mulai'];
$tanggal_selesai = $_GET['tanggal_selesai'];

// Query untuk mengambil data transaksi berdasarkan rentang tanggal
$sql = "SELECT * FROM selesai WHERE tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
$result = mysqli_query($conn, $sql);

// Buat objek spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom pada Excel
$sheet->setCellValue('A1', 'ID Transaksi');
$sheet->setCellValue('B1', 'Tanggal');
$sheet->setCellValue('C1', 'Jumlah');
// Tambahkan kolom lain sesuai kebutuhan

// Isi data dari hasil query
$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['id_transaksi']);
    $sheet->setCellValue('B' . $rowNumber, $row['tanggal']);
    $sheet->setCellValue('C' . $rowNumber, $row['jumlah']);
    // Isi kolom lain sesuai kebutuhan
    $rowNumber++;
}

// Membuat file Excel
$writer = new Xlsx($spreadsheet);
$filename = 'data_transaksi_' . date('Y-m-d') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

// Tutup koneksi database
mysqli_close($conn);
?>
