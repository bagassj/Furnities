-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 05:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furnities`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama_lengkap`, `alamat`, `email`, `password`, `no_hp`) VALUES
(1, 'admin1', 'aa', 'admin1@gmail.com', '123', '0873737733');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama_lengkap`, `alamat`, `no_hp`, `email`, `password`) VALUES
(1, 'Customer1', 'dwawad', '0872477247', 'customer1@gmail.com', '123'),
(2, 'Customer2', 'adawda', '11234114141', 'customer2@gmail.com', '123'),
(4, 'Dion Alif', 'Jl Letjen S Parman', 'IQWY', 'dion@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kayu`
--

CREATE TABLE `jenis_kayu` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kayu`
--

INSERT INTO `jenis_kayu` (`id`, `nama_jenis`) VALUES
(1, 'Kayu Jati'),
(5, 'Kayu Mahogani'),
(6, 'Kayu Trembesi'),
(7, 'Kayu Jati Belanda'),
(8, 'Kayu Sungkai');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_product`
--

CREATE TABLE `jenis_product` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_product`
--

INSERT INTO `jenis_product` (`id`, `nama_jenis`) VALUES
(1, 'Meja'),
(2, 'Kursi'),
(3, 'Lemari');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `lokasi_tujuan` varchar(100) DEFAULT NULL,
  `status_pesanan` enum('Menunggu Konfirmasi','Diproses','Sedang Diperjalanan','Selesai','Ditolak') DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `admin_id`, `product_id`, `lokasi_tujuan`, `status_pesanan`, `tanggal`) VALUES
(2, 1, NULL, 2, 'Tes', 'Selesai', '2022-06-16 11:28:08'),
(3, 1, NULL, 6, 'w', 'Menunggu Konfirmasi', '2022-06-16 08:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `jenis_product_id` int(11) DEFAULT NULL,
  `jenis_kayu_id` int(11) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(1000) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `isCustom` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `jenis_product_id`, `jenis_kayu_id`, `nama_produk`, `deskripsi`, `harga`, `foto`, `isCustom`) VALUES
(2, 1, 1, 'Meja Ruang Tamu', '-', 120000, '1655344349.png', 0),
(3, 1, 1, 'Meja Makan', '-', 450000, '1652080593.jpg', 0),
(4, 1, 1, 'Meja Belajar', '-', 150000, '1652080624.jpg', 0),
(6, 2, 6, NULL, 'w', 150000, '1655368227.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kayu_id` int(11) DEFAULT NULL,
  `diameter` int(11) DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_pesanan` enum('Baru','Diterima','Ditolak','Selesai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `customer_id`, `alamat`, `jenis_kayu_id`, `diameter`, `tinggi`, `tanggal`, `harga`, `keterangan`, `foto`, `status_pesanan`) VALUES
(2, 1, 'wad', 5, 12, 221, '2022-06-16', 21, 'adwa', '1655363857.jpg', 'Ditolak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kayu`
--
ALTER TABLE `jenis_kayu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_product`
--
ALTER TABLE `jenis_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_product_id` (`jenis_product_id`),
  ADD KEY `jenis_kayu_id` (`jenis_kayu_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `jenis_kayu_id` (`jenis_kayu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_kayu`
--
ALTER TABLE `jenis_kayu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_product`
--
ALTER TABLE `jenis_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`jenis_product_id`) REFERENCES `jenis_product` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`jenis_kayu_id`) REFERENCES `jenis_kayu` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`jenis_kayu_id`) REFERENCES `jenis_kayu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
