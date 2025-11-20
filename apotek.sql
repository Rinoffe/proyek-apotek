-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 07:49 AM
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
(2, 'rahma', 1, 2),
(3, 'rahma', 4, 1),
(4, 'rahma', 2, 2),
(5, 'rahma', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `kategori` varchar(100) NOT NULL,
  `bentuk` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `gambar`, `nama_obat`, `kategori`, `bentuk`, `deskripsi`, `stok`, `harga`) VALUES
(1, 'paracetamol.jpg', 'Paracetamol 500mg', 'Obat bebas', 'Kaplet', 'Obat untuk menurunkan demam dan meredakan nyeri kepala, otot, serta sakit gigi.', 120, 1500),
(2, 'amoxicillin.jpg', 'Amoxicillin 500mg', 'Obat keras', 'Kapsul', 'Antibiotik untuk mengobati infeksi bakteri seperti ISPA, infeksi kulit, dan telinga.', 80, 3000),
(3, 'vitamin_c.jpg', 'Vitamin C 1000mg', 'Obat bebas', 'Tablet', 'Suplemen untuk meningkatkan daya tahan tubuh dan menjaga kesehatan kulit.', 150, 2500),
(4, 'salbutamol.jpg', 'Salbutamol Inhaler', 'Obat keras', 'Inhaler', 'Obat bronkodilator untuk meredakan sesak napas akibat asma dan PPOK.', 60, 35000),
(5, 'betadine.jpg', 'Betadine Antiseptic Solution 30ml', 'Obat bebas', 'Salep', 'Cairan antiseptik untuk membersihkan luka dan mencegah infeksi.', 90, 12000),
(6, 'promag.jpg', 'Promag Tablet', 'Obat bebas', 'Tablet', 'Obat antasida yang cepat meredakan gejala sakit maag, perut kembung, dan rasa perih.', 20, 9000),
(8, 'tolak_angin_cair.jpg', 'Tolak Angin Cair', 'Obat tradisional', '', 'Obat herbal terstandar untuk masuk angin, perut kembung, mual, dan sakit kepala.', 6, 18000),
(9, 'kayu_putih.jpeg', 'Minyak Kayu Putih Cap Lang', 'Obat tradisional', '', 'Minyak serbaguna untuk menghangatkan tubuh, meredakan sakit perut, dan gigitan serangga.', 11, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id_history` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `lokasi` text NOT NULL,
  `metode_pembayaran` enum('Tunai','Transfer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('rahma', '', '123', 'user'),
('Reno', '', '123', 'user');

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
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `username` (`username`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `username` (`username`),
  ADD KEY `id_obat` (`id_obat`);

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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
