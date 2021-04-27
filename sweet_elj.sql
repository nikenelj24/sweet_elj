-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 03:36 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweet_elj`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan`
--

CREATE TABLE `tb_bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bahan`
--

INSERT INTO `tb_bahan` (`id_bahan`, `nama_bahan`) VALUES
(1, 'Kulit Sintetis'),
(2, 'Dinir'),
(3, 'Micro'),
(4, 'Baby ripstop'),
(5, 'Parasut'),
(6, 'Polyester'),
(7, 'Kanvas'),
(8, 'Corduroy');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(4) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `gambar` mediumtext DEFAULT NULL,
  `berat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `id_kategori`, `harga`, `stok`, `deskripsi`, `id_bahan`, `gambar`, `berat`) VALUES
(1, 'Tas Selempang', 1, 50000, 9, 'poiqouwioquifhsvooashpqo', 1, 'tas13.jpg', 50),
(2, 'Totebag', 2, 20000, 10, 'noiyuit', 2, 'tas76.jpg', 50),
(4, 'Tas wanita', 3, 500000, 10, 'awertyuuiop', 1, 'tas51.jpg', 50),
(5, 'Tas Pinggang Wanita', 5, 150000, 10, 'tas blablablabla', 1, 'tas21.jpg', 50),
(6, 'Ransel Wanita', 6, 50000, 10, 'blablabalabalbalabalablabalbla', 3, 'tas41.jpg', 50),
(7, 'Tas tangan', 4, 125000, 10, 'poqpiwouqieyuewtgsajbsdhjdagjd', 1, 'tas61.jpg', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_gambar`
--

INSERT INTO `tb_gambar` (`id_gambar`, `id_barang`, `ket`, `gambar`) VALUES
(1, 1, 'tas selempang', 'tasCb.png'),
(2, 1, 'tas selempang', 'tasCb1.png'),
(3, 1, 'tas selempang', 'tasCb2.png'),
(4, 1, 'tas selempang', 'tasCb3.png'),
(6, 4, 'clucts 1', 'tas5-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Tas Selempang'),
(2, 'Totebag'),
(3, 'Clutch'),
(4, 'Top Handle'),
(5, 'Tas Pinggang'),
(6, 'Ransel'),
(8, 'Dompet');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `level_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `foto`, `level_user`) VALUES
(1, 'nana', 'ninanano1509@gmail.com', '12345', 'foto.png', 2),
(2, 'JK', 'jeykei123@gmail.com', '123456', 'jk.jpg', 2);

-- --------------------------------------------------------


CREATE TABLE `tb_rating` (
  `id_rating` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rating`
--

INSERT INTO `tb_rating` (`id_rating`, `user`, `id_barang`, `rating`, `comment`, `created_at`) VALUES
(3, 'Jamal', 4, 4, 'Bagus', '2021-04-27 05:03:53'),
(4, 'Andi Arsyil', 6, 5, 'Lettau', '2021-04-27 05:33:25'),
(5, 'Joel Liminata', 7, 4, 'Bagus', '2021-04-27 06:13:03'),
(6, 'Juanietto', 7, 5, 'Keren', '2021-04-27 06:13:19'),
(7, 'Joel Liminata', 4, 5, 'Keren', '2021-04-27 07:28:19'),
(8, 'Joel Liminata', 5, 1, 'Jelek', '2021-04-27 08:26:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rating`
--
ALTER TABLE `tb_rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Table structure for table `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `atas_nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekening`
--

INSERT INTO `tb_rekening` (`id_rekening`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'MANDIRI', '40971230-20394-019', 'Niken'),
(2, 'BRI', '271823041-24493-123', 'Niken');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rinci_transaksi`
--

CREATE TABLE `tb_rinci_transaksi` (
  `id_rinci` int(11) NOT NULL,
  `no_order` varchar(50) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rinci_transaksi`
--

INSERT INTO `tb_rinci_transaksi` (`id_rinci`, `no_order`, `id_barang`, `qty`) VALUES
(1, '20210328ELLAJ6SH', 7, 1),
(2, '20210328ELLAJ6SH', 4, 1),
(3, '20210328ELLAJ6SH', 1, 1),
(4, '20210328PMW3FEHB', 7, 1),
(5, '20210328PMW3FEHB', 4, 2),
(6, '20210328PMW3FEHB', 1, 1),
(7, '20210328LHEX6COY', 7, 1),
(8, '20210328LHEX6COY', 4, 2),
(9, '20210328LHEX6COY', 1, 1),
(10, '2021032851CX9K7D', 5, 1),
(11, '202103281B9PVRNX', 1, 1),
(12, '202103281B9PVRNX', 2, 1),
(13, '202103281B9PVRNX', 5, 1),
(14, '20210329YXQNA81C', 1, 1),
(15, '20210329YXQNA81C', 2, 1),
(16, '20210329YXQNA81C', 4, 1),
(17, '20210329GAFKX8Q0', 1, 1),
(18, '20210329TXZYX4OL', 1, 1),
(19, '20210329TXZYX4OL', 2, 1),
(20, '20210329TH0URNWF', 2, 1),
(21, '20210329NWRNTGYE', 2, 1),
(22, '202103294Q0IFAOR', 1, 1),
(23, '20210329FVJ9EW3K', 1, 1),
(24, '20210329KSD4JOVE', 1, 1),
(25, '2021040254YMAGV2', 1, 1),
(26, '20210410W8TIO3LV', 1, 1);

--
-- Triggers `tb_rinci_transaksi`
--
DELIMITER $$
CREATE TRIGGER `transaksi_penjualan` AFTER INSERT ON `tb_rinci_transaksi` FOR EACH ROW BEGIN
 UPDATE tb_barang SET stok = stok-NEW.qty
 WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id` int(1) NOT NULL,
  `nama_toko` varchar(255) DEFAULT NULL,
  `lokasi` int(11) DEFAULT NULL,
  `alamat_toko` text DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id`, `nama_toko`, `lokasi`, `alamat_toko`, `no_tlp`) VALUES
(1, 'Sweet Elj', 419, 'Jl. RingRoad Utara, Yogyakarta', '08298123456');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `no_order` varchar(50) NOT NULL,
  `tgl_order` date DEFAULT NULL,
  `nama_penerima` varchar(25) DEFAULT NULL,
  `tlp_penerima` varchar(15) DEFAULT NULL,
  `provinsi` varchar(25) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `expedisi` varchar(25) DEFAULT NULL,
  `paket` varchar(25) DEFAULT NULL,
  `estimasi` varchar(25) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT NULL,
  `bukti_bayar` text DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `no_rek` varchar(25) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  `no_resi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pelanggan`, `no_order`, `tgl_order`, `nama_penerima`, `tlp_penerima`, `provinsi`, `kota`, `alamat`, `kode_pos`, `expedisi`, `paket`, `estimasi`, `ongkir`, `berat`, `sub_total`, `total_bayar`, `status_bayar`, `bukti_bayar`, `atas_nama`, `nama_bank`, `no_rek`, `status_order`, `no_resi`) VALUES
(1, 1, '20210328ELLAJ6SH', '2021-03-28', 'gk', '08976756345', 'Jambi', 'Tanjung Jabung Barat', 'BTN Pengabuan Permai', '36511', 'jne', 'OKE', '7-8 Hari', 46000, 150, 675000, 721000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(2, 1, '20210328PMW3FEHB', '2021-03-28', 'nk', '089761244668', 'DI Yogyakarta', 'Sleman', 'jl ringroad', '55541', 'jne', 'CTCYES', '1-1 Hari', 10000, 200, 1175000, 1185000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(3, 1, '20210328LHEX6COY', '2021-03-28', 'ade', '08976715676980', 'Jambi', 'Tanjung Jabung Barat', 'BTN Pengabuan Permai', '36511', 'jne', 'REG', '4-5 Hari', 51000, 200, 1175000, 1226000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(4, 1, '2021032851CX9K7D', '2021-03-28', 'dk', '08976756345', 'DKI Jakarta', 'Jakarta Pusat', 'jkt', '36512', 'jne', 'OKE', '3-4 Hari', 13000, 50, 150000, 163000, 1, 'bukti_bayar.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(5, 2, '202103281B9PVRNX', '2021-03-28', 'jk', '087641567890', 'Bali', 'Bangli', 'jl cendrawasi', '11111', 'tiki', 'REG', '3 Hari', 34000, 150, 220000, 254000, 1, 'bukti_bayar1.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(6, 2, '20210329YXQNA81C', '2021-03-29', 'dk', '08976756345', 'Bali', 'Tabanan', 'jl ringroad', '12345', 'jne', 'OKE', '7-8 Hari', 32000, 150, 570000, 602000, 1, 'bukti_bayar2.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(7, 2, '20210329GAFKX8Q0', '2021-03-29', 'gk', '08976756345', 'Bangka Belitung', 'Pangkal Pinang', 'jl ringroad', '12345', 'pos', 'Paket Kilat Khusus', '5 HARI Hari', 37500, 50, 50000, 87500, 1, 'bukti_bayar3.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(8, 2, '20210329TXZYX4OL', '2021-03-29', 'gk', '087641567890', 'Banten', 'Pandeglang', 'jl ringroad', '12345', 'tiki', 'REG', '3 Hari', 22000, 100, 70000, 92000, 1, 'bukti_bayar4.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(9, 2, '20210329TH0URNWF', '2021-03-29', 'dk', '08976756345', 'Bangka Belitung', 'Belitung Timur', 'jkt', '11111', 'pos', 'Paket Kilat Khusus', '10 HARI Hari', 40000, 50, 20000, 60000, 1, 'bukti_bayar5.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(10, 2, '20210329NWRNTGYE', '2021-03-29', 'nk', '087641567890', 'Jawa Barat', 'Bogor', 'jl cendrawasi', '12345', 'tiki', 'ECO', '4 Hari', 13000, 50, 20000, 33000, 1, 'bukti_bayar6.jpeg', 'ade', 'Mandiri', '123456789532340', 1, NULL),
(11, 2, '202103294Q0IFAOR', '2021-03-29', 'nk', '089761244668', 'Maluku', 'Maluku Tenggara Barat', 'jkt', '12345', 'jne', 'OKE', '7-8 Hari', 86000, 50, 50000, 136000, 1, 'bukti_bayar7.jpeg', 'ade', 'Mandiri', '123456789532340', 3, 'KSAKHDA1245668'),
(12, 2, '20210329FVJ9EW3K', '2021-03-29', 'gk', '089761244668', 'Kalimantan Tengah', 'Barito Timur', 'jkt', '11111', 'jne', 'OKE', '7-8 Hari', 43000, 50, 50000, 93000, 1, 'bukti_bayar8.jpeg', 'ade', 'Mandiri', '123456789532340', 3, '1234567890'),
(13, 2, '20210329KSD4JOVE', '2021-03-29', 'dk', '087641567890', 'Maluku', 'Seram Bagian Timur', 'jkt', '12345', 'jne', 'REG', '10+ Hari', 106000, 50, 50000, 156000, 0, NULL, NULL, NULL, NULL, 0, NULL),
(14, 1, '2021040254YMAGV2', '2021-04-02', 'ade', '087641567890', 'Bangka Belitung', 'Bangka', 'BTN Pengabuan Permai', '36511', 'jne', 'OKE', '7-8 Hari', 46000, 50, 50000, 96000, 1, 'bukti_bayar31.jpeg', 'ade', 'Mandiri', '123456789532340', 0, NULL),
(15, 1, '20210410W8TIO3LV', '2021-04-10', 'dk', '08976756345', 'Banten', 'Pandeglang', 'jl cendrawasi', '11111', 'pos', 'Paket Kilat Khusus', '3 HARI Hari', 20000, 50, 50000, 70000, 0, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `level_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level_user`) VALUES
(1, 'nk', 'admin', 'admin', 1),
(2, 'guci', 'user', 'user', 2),
(4, 'abang', 'abang', '1234', 1),
(5, 'gucce', 'gucce', 'gucce', 2),
(6, 'Nik', 'nik', '1234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
--
-- Indexes for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `tb_rinci_transaksi`
--
ALTER TABLE `tb_rinci_transaksi`
  ADD PRIMARY KEY (`id_rinci`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rating`
--
ALTER TABLE `tb_rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rinci_transaksi`
--
ALTER TABLE `tb_rinci_transaksi`
  MODIFY `id_rinci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
