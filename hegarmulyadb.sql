-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 06:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hegarmulyadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` varchar(11) NOT NULL,
  `jenis` enum('Wolly 91 58','Woll Peach 58','Castella 58','Peach Velvet 58','Fluid 58','Royal Twist 58') NOT NULL,
  `warna` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `jenis`, `warna`, `stok`) VALUES
('AOOM1402', 'Wolly 91 58', 'Dasty Pink', 20),
('BRTT0121', 'Fluid 58', 'Olive', 103),
('BTGT0223', 'Peach Velvet 58', 'Olive', 4),
('BULB0201', 'Royal Twist 58', 'Hitam', 18),
('CZJM0041', 'Wolly 91 58', 'Coklat', 49),
('DPOI0331', 'Royal Twist 58', 'Maroon', 145),
('EJSA0310', 'Wolly 91 58', 'Maroon', 41),
('FJUR2444', 'Fluid 58', 'Hijau', 2),
('FNXZ3203', 'Peach Velvet 58', 'Dasty Pink', 45),
('FQKL3110', 'Royal Twist 58', 'Coklat', 94),
('GBJD0430', 'Wolly 91 58', 'Olive', 113),
('GBKU4413', 'Castella 58', 'Olive', 79),
('HWMC2144', 'Royal Twist 58', 'Hitam', 141),
('IMTH4124', 'Royal Twist 58', 'Coklat', 98),
('JEKF4044', 'Royal Twist 58', 'Dasty Pink', 55),
('JLIP1111', 'Wolly 91 58', 'Fanta', 29),
('JXRH1410', 'Woll Peach 58', 'Maroon', 136),
('KARF0142', 'Woll Peach 58', 'Hijau', 10),
('KFDY3304', 'Royal Twist 58', 'Dasty Pink', 100),
('KJJW0411', 'Wolly 91 58', 'Hijau', 120),
('KMGE3324', 'Royal Twist 58', 'Coklat', 42),
('KPRP1204', 'Peach Velvet 58', 'Hijau', 27),
('KPTZ3233', 'Royal Twist 58', 'Fanta', 44),
('KXDA0330', 'Royal Twist 58', 'Hitam', 56),
('LBFI4004', 'Peach Velvet 58', 'Hijau', 53),
('LBKZ2040', 'Woll Peach 58', 'Dasty Pink', 70),
('NQOA3131', 'Peach Velvet 58', 'Hijau', 132),
('NRGZ0103', 'Wolly 91 58', 'Hitam', 131),
('NVAP1431', 'Woll Peach 58', 'Maroon', 44),
('NZNI3403', 'Wolly 91 58', 'Fanta', 59),
('ONRM4230', 'Royal Twist 58', 'Maroon', 124),
('PUAW4204', 'Woll Peach 58', 'Maroon', 5),
('QRAC1001', 'Royal Twist 58', 'Coklat', 110),
('RRBP3331', 'Royal Twist 58', 'Hijau', 117),
('SOYH4221', 'Peach Velvet 58', 'Olive', 61),
('UEVJ3012', 'Castella 58', 'Fanta', 87),
('UMER3001', 'Castella 58', 'Hitam', 42),
('UORH2130', 'Woll Peach 58', 'Maroon', 7),
('UWFU3044', 'Castella 58', 'Olive', 24),
('WFNM2000', 'Wolly 91 58', 'Dasty Pink', 15),
('WKJA1234', 'Wolly 91 58', 'Hitam', 60),
('WXWD3114', 'Peach Velvet 58', 'Fanta', 80),
('XDHC0210', 'Peach Velvet 58', 'Olive', 126),
('XEYY0222', 'Wolly 91 58', 'Coklat', 117),
('XGVE0140', 'Wolly 91 58', 'Coklat', 53),
('YBYI3333', 'Peach Velvet 58', 'Hitam', 14),
('YVSZ0132', 'Castella 58', 'Fanta', 88);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(11) NOT NULL,
  `nama_pemesan` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `id_bahan` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nama_pemesan`, `alamat`, `kontak`, `id_bahan`, `jumlah`, `tgl_pesan`) VALUES
('CMMS2424', 'Jaclyn O\'Conner V', '547 Bradtke Falls\nVolkmanmouth, OK 12198', '+19547053694', 'UMER3001', 107, '2015-09-20'),
('CNFP4233', 'Letha Klocko', '2810 Wisozk Street\nFriesenfort, AK 75032-5861', '+17577467019', 'EJSA0310', 88, '2020-08-10'),
('DAAW2303', 'Kaia Frami', '977 Boehm Run Apt. 016\nNorth Noel, CT 77793-5448', '+18458585462', 'JEKF4044', 14, '2016-05-02'),
('DOLJ2011', 'Henri Jast', '16643 Hobart Village Apt. 984\nSummerton, FL 06562', '+15743940625', 'WFNM2000', 132, '2021-10-10'),
('FMSC0440', 'Rubye Doyle', '271 Dax Junctions\nWest Sienna, IA 59120', '+13516437178', 'KARF0142', 146, '2015-10-27'),
('GXKZ3113', 'Kim O\'Conner', '6188 Adams Loop\nMorarport, IN 76237-3344', '+13855859093', 'JLIP1111', 88, '2014-10-20'),
('HPHP4231', 'Benton Goyette', '2927 Kiehn Ridges Apt. 007\nSouth Richmondbury, KY 16835-1508', '+18704556992', 'YBYI3333', 24, '2022-01-23'),
('NMLK4200', 'Stanford Yost', '4527 Jed River Suite 713\nEmmerichton, MN 62818', '+12187178656', 'FJUR2444', 69, '2017-05-11'),
('PDLA2244', 'Pinkie Koepp', '74285 Brady Lock\nSporerbury, IA 20320', '+18063836134', 'BTGT0223', 113, '2015-06-25'),
('PXXW4311', 'Ceasar Koelpin DVM', '326 Lesch Circle\nElroyberg, HI 30865', '+13606637618', 'KPRP1204', 133, '2017-02-26'),
('RWVN4420', 'Carolyn Hayes', '7180 Lempi Port\nLucilehaven, CO 56134-0820', '+15708469709', 'KMGE3324', 118, '2017-11-28'),
('SRDH2230', 'Lavina Roberts', '8738 Moore Lights\nSouth Angelfurt, WI 03882', '+19787563086', 'FQKL3110', 87, '2017-01-17'),
('SWDP2041', 'Jo Vandervort', '8840 Otto Radial Suite 555\nSouth Bernadine, HI 09618-0476', '+19309974325', 'KXDA0330', 53, '2017-09-02'),
('USRL1323', 'Dr. Miles Frami V', '53881 Matilde Ford Apt. 879\nMorissettemouth, MA 75746-5951', '+19163178599', 'JXRH1410', 81, '2021-06-10'),
('XTMY1231', 'Amparo Veum', '12293 Madelyn Groves\nEast Henriettestad, WY 29934-7491', '+12398568116', 'BTGT0223', 47, '2017-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` varchar(11) NOT NULL,
  `id_pesanan` varchar(11) NOT NULL,
  `id_bahan` varchar(11) NOT NULL,
  `estimasi` date NOT NULL,
  `status` enum('0','1','2','3','4','5','6') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `id_pesanan`, `id_bahan`, `estimasi`, `status`) VALUES
('BTGT0223XTM', 'XTMY1231', 'BTGT0223', '2023-02-07', '6'),
('EJSA0310CNF', 'CNFP4233', 'EJSA0310', '2023-02-07', '4'),
('JLIP1111GXK', 'GXKZ3113', 'JLIP1111', '2023-02-07', '5'),
('JXRH1410USR', 'USRL1323', 'JXRH1410', '2023-02-07', '4'),
('KXDA0330SWD', 'SWDP2041', 'KXDA0330', '2023-02-07', '5'),
('UMER3001CMM', 'CMMS2424', 'UMER3001', '2023-02-08', '6');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` enum('dyeing','printing','finishing','admin','manajer','ppic') NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jabatan`, `email`, `username`, `password`) VALUES
('A01', 'Andre Hilmi', 'admin', 'andre.hilmi88@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
('C01', 'pratama', 'ppic', 'pratama@gmail.com', 'ppic', '10445f9a51c9dce6a86c529d671e76a8'),
('D01', 'papa', 'dyeing', 'papa@gmail.com', 'dyeing', '2a67fc49054b7eb8190b3511b5af92af'),
('F01', 'dude', 'finishing', 'dude@gmail.com', 'finishing', '0c115e260619516ae760def05ae53567'),
('M01', 'Manajer Produksi', 'manajer', 'manajer@gmail.com', 'Manajer Produksi', '69b731ea8f289cf16a192ce78a37b4f0'),
('P01', 'mama', 'printing', 'mama@gmail.com', 'printing', '2d00721e59e89d24266c9cdbd9f10c6e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_bahan_2` (`id_bahan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `id_bahan` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `id_bahan_2` FOREIGN KEY (`id_bahan`) REFERENCES `pesanan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
