-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2023 at 10:52 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dikaper_lama`
--

-- --------------------------------------------------------

--
-- Table structure for table `baznas`
--

CREATE TABLE `baznas` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(11) NOT NULL,
  `tgl_surat` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `rt` varchar(3) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `kelurahan` varchar(25) NOT NULL,
  `tunggakan_bpjs` varchar(100) NOT NULL,
  `denda_layanan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baznas`
--

INSERT INTO `baznas` (`id`, `no_surat`, `tgl_surat`, `nama`, `tgl_lahir`, `alamat`, `rt`, `rw`, `kelurahan`, `tunggakan_bpjs`, `denda_layanan`) VALUES
(5, '460/003/R-B', '2023-01-16', 'Iyan Arif Frianto', '1976-01-06', 'Jl. Sukasari III ', '005', '006', 'SUKASARI', '737.500', '-'),
(6, '460/004/R-B', '2023-02-02', 'SOPIAN ', '1984-06-08', 'Pulo geulis\r\n', '003', '004', 'Babakan Pasar', '2.940.500', '-'),
(7, '422/211-RM', '2023-02-06', 'RUDIYANTO', '1985-01-28', 'KP. SIRNAGALIG', '002', '003', 'RANGGAMEKAR', '2.625.000', '-'),
(8, '460/005/R-B', '2023-02-15', 'Devior Haryono Ursia', '1977-03-12', 'Ceremai Ujung gg. Melati, ', '002', '012', 'Bantarjati', '7.816.499', '-'),
(9, '006', '2023-02-27', 'FEMI FATIMAH', '1982-05-05', 'CIBALAGUNG', '005', '003', 'PASIR KUDA', '647.000', '-'),
(10, '007', '2023-02-27', 'MULYADI', '1957-05-05', 'CIBALAGUNG NO 6', '005', '003', 'PASIR KUDA', '4.400.000', '-'),
(11, '460/006/R/B', '2023-03-06', 'Samsul M. Arif ', '1976-03-20', 'Gg. Budi No.254', '002', '012', 'Loji', '2.431.500', '0'),
(12, '460/007/R/B', '2023-04-12', 'RUDI TRESNA BIMANTARA SILABAN', '1991-08-15', 'JL. KOL. ENJO MARTADISASTRA NO. 108 ', '005', '012', 'KEDUNG BADAK', '1.050.000', '-'),
(13, '460/008/R/B', '2023-05-15', 'ABDUL SUBUR', '1957-12-10', 'KP. SUKAWARNA ', '002', '010', 'CIPAKU', '1.795.000', '-'),
(14, '460/009/R/B', '2023-05-30', 'DICKY', '1985-07-17', 'CIBEREUM ', '004', '008', 'MULYAHARJA', '2.648.000', '-'),
(15, '460/010/R/B', '2023-06-13', 'ARISKA DINDA HERMAWAN', '2022-09-14', 'BATUHALUNG', '002', '002', 'BALUMBANG JAYA', '0', '4.091.235'),
(16, '460/011/R/B', '2023-06-27', 'ASEP KOSWARA', '1968-01-01', 'PANCASAN BARU ', '04', '12', 'PASIR JAYA', '0', 'Rp 3.156.650');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baznas`
--
ALTER TABLE `baznas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baznas`
--
ALTER TABLE `baznas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
