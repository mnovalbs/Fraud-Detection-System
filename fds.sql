-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2017 at 03:11 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fds`
--

-- --------------------------------------------------------

--
-- Table structure for table `blacklisted_cc`
--

CREATE TABLE `blacklisted_cc` (
  `id` int(11) NOT NULL,
  `cc_number` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blacklisted_email`
--

CREATE TABLE `blacklisted_email` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

CREATE TABLE `creditcard` (
  `cc_id` int(11) NOT NULL,
  `order_key` varchar(40) NOT NULL,
  `cc_number` varchar(16) NOT NULL,
  `nama_cc` varchar(40) NOT NULL,
  `bulan_expired` int(2) NOT NULL,
  `tahun_expired` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `password_salt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `username`, `email`, `password`, `password_salt`) VALUES
(1, 'Noval Bintang', 'mnovalbs', 'masbintangblog@gmail.com', '0999c17c6cbae054b26963055f6f451fc853093c', '3f4125082015b46159dd85c482bd7d000fb4b924');

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `order_id` int(11) NOT NULL,
  `order_key` varchar(40) NOT NULL,
  `nama_pemesan` varchar(40) NOT NULL,
  `is_registered` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `email_address` varchar(40) NOT NULL,
  `kota_asal` varchar(4) NOT NULL,
  `kota_tujuan` varchar(4) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `airline` varchar(2) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `order_time` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`order_id`, `order_key`, `nama_pemesan`, `is_registered`, `harga`, `email_address`, `kota_asal`, `kota_tujuan`, `tanggal_berangkat`, `airline`, `ip_address`, `order_time`, `status`) VALUES
(3, 'jasdas9n1oin931uc2nuc23', 'asdasd', 0, 893647, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'JT', '123.121.123.123', '2017-01-11 04:15:25', 0),
(5, 'd932ef4b982a7e3b88e79169b27280109a0566c9', 'Noval Bintang', 0, 372075, 'masbintangblog@gmail.com', 'PCB', 'CXP', '2017-01-14', 'GA', '123.123.123.123', '2017-01-11 04:18:17', 0),
(6, '5c2ab3aa01bdbbc90d90cf07075b9a95f3f0b05f', 'Noval Bintang', 1, 1041640, 'masbintangblog@gmail.com', 'DPS', 'JKTA', '2017-01-13', 'SJ', '123.123.123.123', '2017-01-11 07:20:34', 1),
(7, 'e45867cabe62c44381dc91f748bd46a673dd2a58', 'Noval Bintang', 1, 1200264, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'GA', '123.123.123.123', '2017-01-11 07:23:37', 0),
(8, '0821f895a62e02580c5142a2c0f10f9cf5ac6790', 'Noval Bintang', 1, 1029159, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'JT', '123.121.123.123', '2017-01-11 07:25:21', 0),
(9, '1dd3038a9ade687e1713bfeadf65d7a72ace5cbc', 'Noval Bintang', 1, 2775954, 'masbintangblog@gmail.com', 'DPS', 'JKTA', '2017-01-13', 'JT', '123.121.123.123', '2017-01-11 07:26:31', 0),
(11, '2176cec10c944b004da08ea93645d0fc5449d7e2', 'Noval Bintang', 1, 753236, 'masbintangblog@gmail.com', 'BWX', 'JKTA', '2017-01-13', 'QZ', '123.123.123.123', '2017-01-11 07:34:48', 0),
(13, '7121edb6a0895c35c3a88458e7e63c1153fc5e75', 'NOval', 1, 40136, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'GA', '123.123.123.123', '2017-01-11 07:37:45', 0),
(14, 'dd794047fb193d643c17e4601d3e8f24d9a30ab8', 'Noval Bintang', 1, 405250, 'masbintangblog@gmail.com', 'CBN', 'JKTA', '2017-01-13', 'GA', '123.123.123.123', '2017-01-11 07:38:23', 0),
(15, 'c9ceaefc328fe4612d2cd6dceeaf56a99d4c92a7', 'Noval Bintang', 1, 161700, 'masbintangblog@gmail.com', 'BWX', 'JKTA', '2017-01-13', 'JT', '123.123.123.123', '2017-01-11 07:46:19', 0),
(16, '39453948c0c7fc6d22b980f48f2fd484ab49b525', 'Noval Bintang', 1, 284848, 'masbintangblog@gmail.com', 'CBN', 'JKTA', '2017-01-13', 'JT', '123.123.123.123', '2017-01-11 07:49:03', 0),
(21, 'dfa2a5dadc123bc3ba68a48a612c7977b29591ef', 'Noval BIntang', 1, 1951800, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'SJ', '123.123.123.123', '2017-01-11 07:57:15', 0),
(22, '4352b55c7129dc39b9084f80ae7f9082150e68d3', 'Noval Bintang', 1, 94898, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'JT', '123.123.123.123', '2017-01-11 07:58:28', 0),
(23, 'bf4e915fdc22d3dc9a1667195e95e5a61bb91369', 'Noval Bintang', 1, 922018, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'SJ', '123.123.123.123', '2017-01-11 07:59:11', 0),
(25, '0c7bd0a685a297616ae96bd7ee515abb788b2ed3', 'Noval Bintang', 1, 767534, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'SJ', '123.123.123.123', '2017-01-11 08:02:08', 0),
(26, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Noval Bintang', 1, 4748408, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'JT', '123.123.123.123', '2017-01-11 08:02:53', 0),
(28, '2552cd3edc78bcf03a9322abc66ce656f4dcbc0f', 'Noval Bintang', 1, 261714, 'masbintangblog@gmail.com', 'JKTA', 'JKTA', '2017-01-13', 'SJ', '123.123.123.123', '2017-01-11 08:05:29', 1),
(29, '0508f5271bff80d0c43653ba78fd140dbb147bfa', 'Noval Bintang', 0, 20000000, 'gavin@wijaya.com', 'PCB', 'HLP', '2017-01-13', 'SJ', '123.123.123.123', '2017-01-11 08:08:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `passenger_id` int(11) NOT NULL,
  `order_key` varchar(40) NOT NULL,
  `nama_penumpang` varchar(40) NOT NULL,
  `title` int(1) NOT NULL,
  `tipe` int(1) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`passenger_id`, `order_key`, `nama_penumpang`, `title`, `tipe`, `tanggal_lahir`) VALUES
(1, 'jasdas9n1oin931uc2nuc23', 'dasdsa', 2, 1, '2014-05-05'),
(2, 'd932ef4b982a7e3b88e79169b27280109a0566c9', 'Noval', 1, 1, '1997-04-27'),
(3, 'd932ef4b982a7e3b88e79169b27280109a0566c9', 'Bintang', 2, 1, '2017-01-01'),
(4, 'd932ef4b982a7e3b88e79169b27280109a0566c9', 'Salim', 1, 2, '2010-08-23'),
(9, '0821f895a62e02580c5142a2c0f10f9cf5ac6790', 'Bintang', 1, 1, '2017-01-01'),
(10, '0821f895a62e02580c5142a2c0f10f9cf5ac6790', 'Noval', 1, 1, '2017-01-01'),
(11, '0821f895a62e02580c5142a2c0f10f9cf5ac6790', 'Salim', 1, 1, '2017-01-01'),
(15, '1dd3038a9ade687e1713bfeadf65d7a72ace5cbc', 'Noval', 3, 1, '2010-06-07'),
(16, '1dd3038a9ade687e1713bfeadf65d7a72ace5cbc', 'Gavin', 1, 2, '1984-05-10'),
(17, '1dd3038a9ade687e1713bfeadf65d7a72ace5cbc', 'Bintang', 2, 1, '2017-01-01'),
(20, '2176cec10c944b004da08ea93645d0fc5449d7e2', 'Gavin Wijaya', 1, 1, '2017-05-06'),
(21, '2176cec10c944b004da08ea93645d0fc5449d7e2', 'Noval Bintang', 3, 2, '2017-05-05'),
(22, '7121edb6a0895c35c3a88458e7e63c1153fc5e75', 'Noval', 1, 1, '2017-01-01'),
(24, 'dd794047fb193d643c17e4601d3e8f24d9a30ab8', 'Bintang', 3, 1, '2011-11-14'),
(26, 'bf4e915fdc22d3dc9a1667195e95e5a61bb91369', 'Satu', 1, 1, '2017-01-01'),
(27, 'bf4e915fdc22d3dc9a1667195e95e5a61bb91369', 'Dua', 1, 1, '2017-01-01'),
(28, '0c7bd0a685a297616ae96bd7ee515abb788b2ed3', 'asdasdsa', 1, 1, '2017-01-01'),
(30, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Satu', 1, 1, '2017-01-01'),
(31, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Dua', 1, 1, '2017-01-01'),
(32, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Tiga', 1, 1, '2017-01-01'),
(33, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Empat', 1, 1, '2017-01-01'),
(34, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Lima', 1, 1, '2017-01-01'),
(35, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Enam', 1, 1, '2017-01-01'),
(36, 'ee9d37c1d446d4572064c39793436a4a0c4d020c', 'Tujuh', 1, 1, '2017-01-01'),
(37, '2552cd3edc78bcf03a9322abc66ce656f4dcbc0f', 'Coba 1', 1, 1, '2017-01-01'),
(38, '2552cd3edc78bcf03a9322abc66ce656f4dcbc0f', 'Coba 2', 1, 1, '2017-01-01'),
(39, '2552cd3edc78bcf03a9322abc66ce656f4dcbc0f', 'Coba 3', 1, 1, '2017-01-01'),
(40, '0508f5271bff80d0c43653ba78fd140dbb147bfa', 'Test 1', 1, 1, '2017-01-01'),
(41, '0508f5271bff80d0c43653ba78fd140dbb147bfa', 'Test 2', 1, 1, '2017-01-01'),
(42, '0508f5271bff80d0c43653ba78fd140dbb147bfa', 'Test 4', 1, 1, '2017-01-01'),
(43, '0508f5271bff80d0c43653ba78fd140dbb147bfa', 'Test 3', 1, 1, '2017-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklisted_cc`
--
ALTER TABLE `blacklisted_cc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blacklisted_email`
--
ALTER TABLE `blacklisted_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`cc_id`),
  ADD KEY `order_id` (`order_key`),
  ADD KEY `order_key` (`order_key`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_key` (`order_key`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `order_key` (`order_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklisted_cc`
--
ALTER TABLE `blacklisted_cc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blacklisted_email`
--
ALTER TABLE `blacklisted_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`order_key`) REFERENCES `detail_order` (`order_key`);

--
-- Constraints for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD CONSTRAINT `penumpang_ibfk_1` FOREIGN KEY (`order_key`) REFERENCES `detail_order` (`order_key`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
