-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 05:48 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fotografi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama_admin` varchar(40) NOT NULL,
  `jabatan` varchar(35) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama_admin`, `jabatan`, `username`, `password`, `level`) VALUES
(23, 'Rizky Efendy', 'Operator', '11', '11', 'Admin'),
(27, 'Dicky Julian', 'Manager', '22', '22', 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `id_paket` varchar(20) NOT NULL,
  `jenis_pemotretan` varchar(25) NOT NULL,
  `lokasi` text NOT NULL,
  `kegiatan` text NOT NULL,
  `tanggal_mulai` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_selesai` varchar(25) NOT NULL,
  `tanggal_booking` varchar(25) NOT NULL,
  `lama_acara` int(3) NOT NULL,
  `status` varchar(25) NOT NULL,
  `id_tagihan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_pelanggan`, `id_paket`, `jenis_pemotretan`, `lokasi`, `kegiatan`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_booking`, `lama_acara`, `status`, `id_tagihan`) VALUES
(8, '7', '7', 'Indoor', '', '', '2021-08-11 03:25:30', '2021-08-11 13:00', '2021-08-11 09:49:18', 2, 'Diterima Pelanggan', '2'),
(9, '7', '6', 'Outdoor', 'Kampus STMIK Indonesia Padang', '', '2021-08-11 03:07:33', '2021-08-11 13:00', '2021-08-11 09:49:18', 2, 'Selesai', '2'),
(10, '7', '6', 'Outdoor', 'A', '', '2021-08-11 02:58:16', '2021-08-11 13:05', '2021-08-11 09:49:18', 0, 'Dalam Proses', '2'),
(11, '7', '7', 'Indoor', '', '', '2021-08-10 05:12:00', '2021-08-10 13:12', '', 0, 'Masuk Ke Keranjang', ''),
(12, '8', '6', 'Indoor', '', '', '2021-08-11 03:36:50', '2021-08-11 15:12', '2021-08-11 10:36:50', 0, 'Order', '3'),
(14, '8', '10', 'Indoor', '', '', '2021-08-11 03:38:13', '2021-08-12 13:00', '2021-08-11 10:38:13', 0, 'Order', '4'),
(15, '7', '9', 'Indoor', '', '', '2021-08-11 03:40:48', '2021-08-20 13:12', '2021-08-11 10:40:48', 0, 'Order', '5'),
(16, '7', '9', 'Indoor', '', '', '2021-08-11 03:44:34', '2021-08-21 13:12', '2021-08-11 10:44:34', 0, 'Order', '6'),
(17, '7', '7', 'Indoor', '', '', '2021-08-11 03:45:22', '2021-08-23 13:12', '2021-08-11 10:45:22', 0, 'Order', '3');

-- --------------------------------------------------------

--
-- Table structure for table `cetak_foto`
--

CREATE TABLE `cetak_foto` (
  `id_cetak` int(4) NOT NULL,
  `id_pelanggan` varchar(10) NOT NULL,
  `id_he` varchar(10) NOT NULL,
  `id_hc` varchar(10) NOT NULL,
  `with_frame` varchar(10) NOT NULL,
  `qty` int(3) NOT NULL,
  `order_via` varchar(15) NOT NULL,
  `waktu_pesan` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL,
  `foto` text NOT NULL,
  `bersihkan` varchar(15) NOT NULL,
  `id_file` varchar(10) NOT NULL,
  `id_tagihan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `post` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `harga_cetak`
--

CREATE TABLE `harga_cetak` (
  `id_hc` int(11) NOT NULL,
  `ukuran` varchar(25) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `tanpa_frame` int(12) NOT NULL,
  `dengan_frame` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_cetak`
--

INSERT INTO `harga_cetak` (`id_hc`, `ukuran`, `keterangan`, `tanpa_frame`, `dengan_frame`) VALUES
(2, 'Pas Foto', '3x4, 2x3, 4x6, 2x1.5', 2000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `harga_edit`
--

CREATE TABLE `harga_edit` (
  `id_he` int(11) NOT NULL,
  `nama_edit` varchar(25) NOT NULL,
  `harga_edit` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_edit`
--

INSERT INTO `harga_edit` (`id_he`, `nama_edit`, `harga_edit`) VALUES
(1, 'Gant Backgroun', 14000),
(2, 'Buat Jaz', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(25) NOT NULL,
  `bisa_booking` varchar(10) NOT NULL,
  `lama_potret` varchar(25) NOT NULL,
  `jenis_waktu` varchar(10) NOT NULL,
  `level_paket` varchar(15) NOT NULL,
  `biaya` int(12) NOT NULL,
  `fasilitas` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `bisa_booking`, `lama_potret`, `jenis_waktu`, `level_paket`, `biaya`, `fasilitas`, `gambar`) VALUES
(8, 'Personal & Couple Portrai', 'Ya', '1', 'Jam', 'Silver', 750000, ' 2X Photo 1rR+ Non Frame<br />\r\n2X Photo 10R+ Non frame<br />\r\n1 * All soft copy', ''),
(7, 'Personal & Couple Portrai', 'Ya', '1', 'Jam', 'Gold', 500000, '                                                                                                    5X Photo 10R+ Non Frame<br />\r\n1 * All soft copy                                                                                                            ', '20210811084955padi.jpg'),
(6, 'Personal & Couple Portrai', 'Ya', '1', 'Jam', 'Platinum', 350000, '                                        2X Photo 10R+ Non Frame<br />\r\n2X Photo 5R<br />\r\n1 * All soft copy                                                      ', ''),
(9, 'Family Portrait', 'Ya', '1', 'Jam', 'Silver', 500000, '1X Photo 16R+ Frame<br />\r\n1X Photo 16R+ Non frame<br />\r\n1 * All soft copy', ''),
(10, 'Family Portrait', 'Ya', '1', 'Jam', 'Gold', 1000000, '1X Photo 20R+ Frame<br />\r\n1X Photo 20R+ Non frame<br />\r\n1 * All soft copy', ''),
(11, 'Family Portrait', 'Ya', '1', 'Jam', 'Platinum', 1500000, '1X Photo 24R+ Frame<br />\r\n1X Photo 24R+ Non frame<br />\r\n1 * All soft copy', ''),
(12, 'Graduation / Wisuda (A)', 'Ya', '1', 'Jam', 'Silver', 450000, '1X Photo 10R+ Frame<br />\r\n3X Photo 5R+ <br />\r\n1X Album Portrait 5R<br />\r\n1 * All soft copy', ''),
(13, 'Graduation / Wisuda (B)', 'Ya', '1', 'Jam', 'Silver', 350000, '                    1X Photo 10R+ Frame<br />\r\n3X Photo 10R+ Non Frame<br />\r\n1 * All soft copy                  ', ''),
(14, 'Graduation / Wisuda (A)', 'Ya', '1', 'Jam', 'Gold', 600000, '1X Photo 16R+ Frame<br />\r\n1X Photo 16R+ Non Frame<br />\r\n3X Photo 5R+<br />\r\n1X Album Portrait 5R<br />\r\n1 * All soft copy', ''),
(15, 'Graduation / Wisuda (A)', 'Ya', '1', 'Jam', 'Platinum', 850000, '1X Photo 16R+ Frame<br />\r\n1X Photo 20R+ Non Frame<br />\r\n3X Photo 5R<br />\r\n1X Album Portrait 5R<br />\r\n1 * All soft copy', ''),
(16, 'Pre Wedding (A)', 'Ya', '1', 'Jam', 'Silver', 750000, '1X Photo 16R+ Frame<br />\r\n1X Photo 16R+ Non Frame<br />\r\n1 * All soft copy', ''),
(17, 'Paket hemat', 'Ya', '1', 'Jam', 'Silver', 300000, 'Ini', '20210811082811kochenk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `nohp_pelanggan` varchar(16) NOT NULL,
  `email_pelanggan` text NOT NULL,
  `password` text NOT NULL,
  `reg_via` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `nohp_pelanggan`, `email_pelanggan`, `password`, `reg_via`) VALUES
(7, 'Ucok Baba', 'Disana', '081212121212', '11', '11', 'Online'),
(8, 'Udin Penyok', 'Disana', '0182', '22', '123', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_tagihan` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `id_rekening` varchar(5) NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `bayar_via` varchar(20) NOT NULL,
  `file` text NOT NULL,
  `waktu_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `id_rekening`, `jumlah_pembayaran`, `keterangan`, `bayar_via`, `file`, `waktu_bayar`, `status`) VALUES
(12, '2', '7', '', 1200000, 'Lunas', 'Tunai', '', '2021-08-11 02:54:15', 'Acc'),
(11, '1', '7', '', 750000, 'Lunas', 'Tunai', '', '2021-08-07 02:04:12', 'Acc');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `no_rek` varchar(40) NOT NULL,
  `namabank` varchar(25) NOT NULL,
  `kodebank` varchar(4) NOT NULL,
  `namarekening` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `no_rek`, `namabank`, `kodebank`, `namarekening`) VALUES
(2, '123456789', 'BRI', '005', 'Rizky Efendy');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `nama_tagihan` varchar(30) NOT NULL,
  `jumlah_tagihan` int(11) NOT NULL,
  `waktu_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `berakhir_pembayaran` varchar(25) NOT NULL,
  `metode_pembayaran` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_pelanggan`, `nama_tagihan`, `jumlah_tagihan`, `waktu_create`, `berakhir_pembayaran`, `metode_pembayaran`) VALUES
(1, '7', 'Order Paket', 750000, '2021-08-07 01:57:32', '2021-08-10', 'Tunai'),
(2, '7', 'Order Paket', 1200000, '2021-08-11 02:49:18', '2021-08-14', 'Transfer'),
(3, '7', 'Order Paket', 500000, '2021-08-11 03:45:22', '2021-08-14', 'Tunai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `cetak_foto`
--
ALTER TABLE `cetak_foto`
  ADD PRIMARY KEY (`id_cetak`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `harga_cetak`
--
ALTER TABLE `harga_cetak`
  ADD PRIMARY KEY (`id_hc`);

--
-- Indexes for table `harga_edit`
--
ALTER TABLE `harga_edit`
  ADD PRIMARY KEY (`id_he`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cetak_foto`
--
ALTER TABLE `cetak_foto`
  MODIFY `id_cetak` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `harga_cetak`
--
ALTER TABLE `harga_cetak`
  MODIFY `id_hc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `harga_edit`
--
ALTER TABLE `harga_edit`
  MODIFY `id_he` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
