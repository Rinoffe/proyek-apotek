-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 03:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `username`, `id_obat`, `qty`) VALUES
(7, 'Reno', 1, 10),
(18, 'rahma', 9, 1),
(19, 'rahma', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `username` varchar(50) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `qty` int(11) DEFAULT 1,
  `tanggal` datetime NOT NULL,
  `lokasi` text NOT NULL,
  `metode_pembayaran` enum('Tunai','Transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `gambar`, `nama_obat`, `deskripsi`, `stok`, `harga`) VALUES
(1, 'paracetamol.jpg', 'Paracetamol 500mg', 'Obat untuk menurunkan demam dan meredakan nyeri kepala, otot, serta sakit gigi.', 120, 1500),
(2, 'amoxicillin.jpg', 'Amoxicillin 500mg', 'Antibiotik untuk mengobati infeksi bakteri seperti ISPA, infeksi kulit, dan telinga.', 79, 3000),
(3, 'vitamin_c.jpg', 'Vitamin C 1000mg', 'Suplemen untuk meningkatkan daya tahan tubuh dan menjaga kesehatan kulit.', 150, 2500),
(4, 'salbutamol.jpg', 'Salbutamol Inhaler', 'Obat bronkodilator untuk meredakan sesak napas akibat asma dan PPOK.', 60, 35000),
(5, 'betadine.jpg', 'Betadine Antiseptic Solution 30ml', 'Cairan antiseptik untuk membersihkan luka dan mencegah infeksi.', 90, 12000),
(6, 'promag.jpg', 'Promag Tablet', 'Obat antasida yang cepat meredakan gejala sakit maag, perut kembung, dan rasa perih.', 18, 9000),
(8, 'tolak_angin_cair.jpg', 'Tolak Angin Cair', 'Obat herbal terstandar untuk masuk angin, perut kembung, mual, dan sakit kepala.', 10, 18000),
(9, 'kayu_putih.jpeg', 'Minyak Kayu Putih Cap Lang', 'Minyak serbaguna untuk menghangatkan tubuh, meredakan sakit perut, dan gigitan serangga.', 6, 25000),
(10, '1764122636_hansaplast.jpg', 'Hansaplast 1 pak isi 6', 'Plester hypoallergenic, memiliki kemungkinan yang sangat kecil untuk membuat kulit iritasi untuk Anda yang memiliki kulit sensitif. Kecocokan terhadap kulit telah diuji secara dermatologi.', 4, 16000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `username` varchar(50) DEFAULT NULL,
  `lokasi` text NOT NULL,
  `metode_pembayaran` enum('Tunai','Transfer') NOT NULL,
  `status` enum('Dikemas','Dikirim','Selesai') NOT NULL DEFAULT 'Dikemas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `username`, `lokasi`, `metode_pembayaran`, `status`) VALUES
(5, '2025-11-25 19:40:44', 'rahma', 'Nitikan', 'Transfer', 'Dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_detail`, `id_transaksi`, `username`, `id_obat`, `qty`) VALUES
(6, 5, 'rahma', 2, 1),
(7, 5, 'rahma', 1, 1),
(8, 5, 'rahma', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama`, `password`, `role`) VALUES
('admin', 'admin', 'admin', 'admin'),
('rahma', 'Nisrina', '123', 'user'),
('Reno', 'Reno', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `username` (`username`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD KEY `username` (`username`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_user` (`username`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
