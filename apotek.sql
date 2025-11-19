-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Nov 17, 2025 at 03:10 PM
=======
-- Generation Time: Nov 19, 2025 at 10:18 AM
>>>>>>> 36dd2cb595ccba9116fbc43e74b77ca598344614
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
  `nama_obat` varchar(100) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
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
<<<<<<< HEAD
  `harga` decimal(10,2) NOT NULL
=======
  `harga` int(11) NOT NULL
>>>>>>> 36dd2cb595ccba9116fbc43e74b77ca598344614
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `gambar`, `nama_obat`, `deskripsi`, `stok`, `harga`) VALUES
<<<<<<< HEAD
(1, 'paracetamol.jpg', 'Paracetamol 500mg', 'Obat untuk menurunkan demam dan meredakan nyeri kepala, otot, serta sakit gigi.', 120, 1500.00),
(2, 'amoxicillin.jpg', 'Amoxicillin 500mg', 'Antibiotik untuk mengobati infeksi bakteri seperti ISPA, infeksi kulit, dan telinga.', 80, 3000.00),
(3, 'vitamin_c.jpg', 'Vitamin C 1000mg', 'Suplemen untuk meningkatkan daya tahan tubuh dan menjaga kesehatan kulit.', 150, 2500.00),
(4, 'salbutamol.jpg', 'Salbutamol Inhaler', 'Obat bronkodilator untuk meredakan sesak napas akibat asma dan PPOK.', 60, 35000.00),
(5, 'betadine.jpg', 'Betadine Antiseptic Solution 30ml', 'Cairan antiseptik untuk membersihkan luka dan mencegah infeksi.', 90, 12000.00);
=======
(1, 'paracetamol.jpg', 'Paracetamol 500mg', 'Obat untuk menurunkan demam dan meredakan nyeri kepala, otot, serta sakit gigi.', 120, 1500),
(2, 'amoxicillin.jpg', 'Amoxicillin 500mg', 'Antibiotik untuk mengobati infeksi bakteri seperti ISPA, infeksi kulit, dan telinga.', 80, 3000),
(3, 'vitamin_c.jpg', 'Vitamin C 1000mg', 'Suplemen untuk meningkatkan daya tahan tubuh dan menjaga kesehatan kulit.', 150, 2500),
(4, 'salbutamol.jpg', 'Salbutamol Inhaler', 'Obat bronkodilator untuk meredakan sesak napas akibat asma dan PPOK.', 60, 35000),
(5, 'betadine.jpg', 'Betadine Antiseptic Solution 30ml', 'Cairan antiseptik untuk membersihkan luka dan mencegah infeksi.', 90, 12000),
(6, 'promag.jpg', 'Promag Tablet', 'Obat antasida yang cepat meredakan gejala sakit maag, perut kembung, dan rasa perih.', 20, 9000),
(8, 'tolak_angin_cair.jpg', 'Tolak Angin Cair', 'Obat herbal terstandar untuk masuk angin, perut kembung, mual, dan sakit kepala.', 6, 18000),
(9, 'kayu_putih.jpeg', 'Minyak Kayu Putih Cap Lang', 'Minyak serbaguna untuk menghangatkan tubuh, meredakan sakit perut, dan gigitan serangga.', 11, 25000);
>>>>>>> 36dd2cb595ccba9116fbc43e74b77ca598344614

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
<<<<<<< HEAD
=======
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama`, `password`, `role`) VALUES
('admin', 'admin', 'admin', 'admin');

--
>>>>>>> 36dd2cb595ccba9116fbc43e74b77ca598344614
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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
<<<<<<< HEAD
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
=======
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
>>>>>>> 36dd2cb595ccba9116fbc43e74b77ca598344614

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
