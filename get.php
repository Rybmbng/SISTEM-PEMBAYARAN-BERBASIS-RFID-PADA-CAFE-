<?php
require 'vendor/autoload.php'; // Lokasi vendor/autoload.php sesuaikan dengan proyek Anda

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fungsi untuk mengambil data transaksi dari database berdasarkan rentang tanggal
function getDataTransaksi($tanggal_mulai, $tanggal_selesai)
{
    // Koneksi ke database (sesuaikan dengan konfigurasi database Anda)
  include 'controller/config.php';

    // Cek koneksi
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query untuk mengambil data transaksi berdasarkan rentang tanggal
    $sql = "SELECT * FROM selesai WHERE tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
    $result = mysqli_query($conn, $sql);

    // Buat array untuk menampung data transaksi
    $data = array();

    // Tambahkan hasil query ke dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Tutup koneksi database
    mysqli_close($conn);

    return $data;
}

// Ambil parameter tanggal dari request AJAX
$tanggal_mulai = $_GET['tanggal_mulai'];
$tanggal_selesai = $_GET['tanggal_selesai'];

// Dapatkan data transaksi
$data_transaksi = getDataTransaksi($tanggal_mulai, $tanggal_selesai);

// Jika parameter "cetak" terdapat pada URL, cetak spreadsheet
if (isset($_GET['cetak'])) {
    // Buat objek spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set judul dan format tabel
    $sheet->setCellValue('A1', 'Laporan Data Transaksi');
    $sheet->mergeCells('A1:F1');
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Header kolom pada Excel
    $sheet->setCellValue('A2', 'No');
    $sheet->setCellValue('B2', 'Nama Customer');
    $sheet->setCellValue('C2', 'Kode Transaksi');
    $sheet->setCellValue('D2', 'Tanggal');
    $sheet->setCellValue('E2', 'Total');

    // Set lebar kolom
    $sheet->getColumnDimension('A')->setWidth(5);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);

    // Set warna latar belakang header kolom
    $headerStyle = [
        'font' => ['bold' => true],
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DCE6F1']],
    ];
    $sheet->getStyle('A2:E2')->applyFromArray($headerStyle);

    // Menambahkan border pada seluruh tabel
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ];
    $sheet->getStyle('A1:E' . (count($data_transaksi) + 2))->applyFromArray($styleArray);

    // Menambahkan warna baris bergantian
    for ($i = 3; $i <= (count($data_transaksi) + 2); $i += 2) {
        $sheet->getStyle('A' . $i . ':E' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2'); // Warna abu-abu untuk baris ganjil
    }

    // Menggunakan font yang berbeda untuk judul dan teks
    $fontJudul = ['bold' => true, 'size' => 14, 'name' => 'Arial'];
    $fontTeks = ['size' => 12, 'name' => 'Calibri'];
    $sheet->getStyle('A1')->getFont()->applyFromArray($fontJudul);
    $sheet->getStyle('A2:E' . (count($data_transaksi) + 2))->getFont()->applyFromArray($fontTeks);

    // Isi data transaksi ke dalam spreadsheet
    $rowNumber = 3;
    $no = 1;
    foreach ($data_transaksi as $row) {
        $sheet->setCellValue('A' . $rowNumber, $no++);
        $sheet->setCellValue('B' . $rowNumber, ucwords($row['username']));
        $sheet->setCellValue('C' . $rowNumber, $row['kd_transaksi']);
        $sheet->setCellValue('D' . $rowNumber, $row['tanggal']);
        $sheet->setCellValue('E' . $rowNumber, $row['total']);
        $rowNumber++;
    }

    // Membuat file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'laporan_transaksi_' . date('Y-m-d') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');

    exit; // Jangan lanjutkan ke proses selanjutnya
}

include 'view.php';
?>
