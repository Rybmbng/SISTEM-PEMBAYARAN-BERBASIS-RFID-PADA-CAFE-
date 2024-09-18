-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2023 at 06:03 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktifitas`
--

CREATE TABLE `aktifitas` (
  `aksi` varchar(255) NOT NULL,
  `kd_transaksi` varchar(255) NOT NULL,
  `no` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktifitas`
--

INSERT INTO `aktifitas` (`aksi`, `kd_transaksi`, `no`, `tanggal`, `username`) VALUES
('dipesan', 'KD_randa195441', 91, '2023-06-18', 'randa');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `no` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `id_kartu` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`no`, `nama_lengkap`, `id_kartu`, `saldo`) VALUES
(1, 'Randa Atni Pratama', 12345, 16400);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `kode_order` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `kode_menu` varchar(15) NOT NULL,
  `kode_transaksi` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_keterangan` varchar(255) NOT NULL,
  `balasan_keterangan` varchar(255) NOT NULL,
  `status_detail` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `no` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kd_transaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`harga`, `jumlah`, `jumlah_harga`, `nama_menu`, `no`, `username`, `kd_transaksi`) VALUES
(12000, 1, 12000, 'Nasi Goreng', 47, 'randa', 'KD_randa195441 ');

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `nomor_kartu` int(11) DEFAULT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `kode_menu` varchar(30) NOT NULL,
  `nama_pesanan` varchar(50) NOT NULL,
  `banyak` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `bayar` int(11) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `no` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id` int(11) NOT NULL,
  `nomor_meja` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id`, `nomor_meja`, `status`, `username`) VALUES
(1, 1, 'terisi', 'randa'),
(2, 2, 'kosong', '');

-- --------------------------------------------------------

--
-- Table structure for table `popular_items`
--

CREATE TABLE `popular_items` (
  `no` int(11) NOT NULL,
  `kd_menu` varchar(255) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `popular_items`
--

INSERT INTO `popular_items` (`no`, `kd_menu`, `nama_menu`, `total`) VALUES
(5, 'Teh Es', 'Teh Es', 9),
(6, 'Nasi Goreng', 'Nasi Goreng', 14),
(7, 'Teh Panas', 'Teh Panas', 6),
(8, 'adsasda', 'adsasda', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `no` int(11) NOT NULL,
  `id_kartu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`no`, `id_kartu`) VALUES
(1, 12345);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_detail`
--

CREATE TABLE `riwayat_detail` (
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `no` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kd_transaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_detail`
--

INSERT INTO `riwayat_detail` (`harga`, `jumlah`, `jumlah_harga`, `nama_menu`, `no`, `username`, `kd_transaksi`) VALUES
(10000, 1, 10000, 'Teh Es', 43, 'adil', 'KD_adil194104 '),
(10000, 1, 10000, 'Teh Es', 44, 'adil', 'KD_adil195113 '),
(3000, 1, 3000, 'Teh Panas', 45, 'adil', 'KD_adil195113 '),
(12000, 1, 12000, 'Nasi Goreng', 46, 'adil', 'KD_adil195113 ');

-- --------------------------------------------------------

--
-- Table structure for table `selesai`
--

CREATE TABLE `selesai` (
  `kd_transaksi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `no` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `uang` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `kasir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selesai`
--

INSERT INTO `selesai` (`kd_transaksi`, `username`, `tanggal`, `no`, `total`, `uang`, `kembalian`, `kasir`) VALUES
('KD_adil195113', 'Adil', '2023-06-18', 14, 27500, 30000, 2500, 'reyvans');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `devices` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `session` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `nama_kategori`, `deskripsi`, `gambar`) VALUES
('MD', 'Dessert', 'Makanan Penutup', 'MD/teh es.jpg'),
('MKB', 'Makanan Berkuah', 'Makanan Yang Menghangatkan', 'MKB/teh es.jpg'),
('MKK', 'Makanan Kering', 'Makanan Yang Lezat dan bergizi', 'MKK/teh es.jpg'),
('MND', 'Minuman Dingin', 'Segaar', 'MND/teh es.jpg'),
('MNP', 'Minuman Panas', 'Minuman Panas Yang Menghangatkan', 'MNP/teh es.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `kode_menu` varchar(15) NOT NULL,
  `kd_kategori` varchar(15) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `img` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`kode_menu`, `kd_kategori`, `nama_menu`, `harga`, `keterangan`, `status`, `img`, `stok`) VALUES
('MND001', 'MND', 'Teh Es', 10000, 'Belila', 'tersedia', 'MND/Teh Esteh es.jpg', 0),
('MND002', 'MND', 'adsasda', 10000, 'adasd', 'tersedia', 'MND/adsasdateh es.jpg', 0),
('MNP003', 'MNP', 'Teh Panas', 3000, 'Minuman Hangat Yang Membantu Menghangatkan Badan', 'tersedia', 'MNP/Teh Panasteh es.jpg', 0),
('MKK004', 'MKK', 'Nasi Goreng', 12000, 'MAKANAN BLABLA', 'tersedia', 'MKK/Nasi Gorengnasi.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `nomor_hp` varchar(17) NOT NULL,
  `email` varchar(40) NOT NULL,
  `about` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `level`, `nama_lengkap`, `gambar`, `password`, `alamat`, `nomor_hp`, `email`, `about`) VALUES
('adit', 'adit', 'waiter', 'adit', 'aditlogo.jpg', '486b6c6b267bc61677367eb6b6458764', 'adasd', '+622412412', 'adil@adil.com', 'adasd'),
('A_admin', 'admin', 'pelanggan', 'admin', 'adminteh es.jpg', '21232f297a57a5a743894a0e4a801fc3', 'admin', '+6283182485587', 'admin@admin.com', 'jancok'),
('A_rafi', 'rafi', 'admin', 'Abdrurrahman Ahmad Alkahfi', 'rafiSheeeshh 20221214_153059.jpg', '139c4e89cdbedaf144d05ca54a12a57b', 'Damasraya', '+6280182301823', 'rafi@jancok.com', 'Kuliah Tidak Penting, Baca Novel Nomor Satu.!!!!!!!1'),
('A_reyvans', 'reyvans', 'admin', 'Reyvans Pahlevi', 'reyvansa.jpg', '827ccb0eea8a706c4c34a16891f84e7b', 'Ujung Gading', '+6283182485598', 'reyvans.pahlevi04@gmail.com', 'Ayo Semangat'),
('K_rahmat', 'rahmat', 'kasir', 'Rahmat Alfarizi', 'rahmatSheeeshh 20221214_153059.jpg', 'af2a4c9d4c4956ec9d6ba62213eed568', 'Kuamang', '+620831231231', 'rahmat@gmail.com', 'kasir'),
('pisal', 'pisal', 'waiter', 'paisal ultimate', 'pisallogo.jpg', 'ec837d4100f9cc0d10b96bab2081286f', 'padang', '+6283123123', 'pisal@gmail.com', 'Sudah Ganteng Sejak Lahir'),
('P_adil', 'adil', 'pelanggan', 'adil aulia azuri', 'adillogo.jpg', '5c3bea5d394835b2af9d2cfd632147f8', 'adaksdjad', '+6283182495598', 'adil@adil.com', 'kecil kecil cabe rawit'),
('P_randa', 'randa', 'pelanggan', 'randa atni pratama', 'randa315079696_1968490466875560_2248799196410825677_n.jpg', '14b092c133fb19b07651a005ed83860b', 'asdasd', '+62123123', 'randa@asda.com', 'asdad'),
('yoji', 'yoji', 'koki', 'yoji', 'yojilogo.png', '5ab47e39b186df2823ecbef0a2e44e96', 'q423as', '+62213131', 'yjoi@asda.conm', 'asfdsafs');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kd_transaksi` varchar(255) NOT NULL,
  `meja` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kd_transaksi`, `meja`, `no`, `status`, `tanggal`, `total`, `username`) VALUES
('KD_randa195441', 1, 34, 'dipesan', '2023-06-18', 12000, 'randa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktifitas`
--
ALTER TABLE `aktifitas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_items`
--
ALTER TABLE `popular_items`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `riwayat_detail`
--
ALTER TABLE `riwayat_detail`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `selesai`
--
ALTER TABLE `selesai`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktifitas`
--
ALTER TABLE `aktifitas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `popular_items`
--
ALTER TABLE `popular_items`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat_detail`
--
ALTER TABLE `riwayat_detail`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `selesai`
--
ALTER TABLE `selesai`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
