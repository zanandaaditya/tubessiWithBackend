-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2020 at 02:56 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tubessi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nam_kota` varchar(50) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nam_kota`, `tarif`) VALUES
(1, 'Kota Pangkalpinang', 34000),
(2, 'Kabupaten Bangka', 39000),
(3, 'Kabupaten Bangka Barat', 41000),
(4, 'Kabupaten Bangka Tengah', 39000),
(5, 'Kabupaten Bangka Selatan', 40000),
(6, 'Kabupaten Belitung', 45000),
(7, 'Kabupaten Belitung Timur', 49000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `nomor_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `nomor_pelanggan`) VALUES
(1, 'nanda@yahoo.com', 'nanda', 'Zananda Aditya', '081440067807'),
(2, 'indra@yahoo.com', 'indra', '09999999', ''),
(3, 'gigs@yahoo.com', '$2y$10$f95jzcRa8rt1.A4/tV.NIuIYtkpcwhIWDAbhIjxYvVzu6oBk0sIMu', 'gigasaputra', '081440067807'),
(5, '1111@gmail.com', '$2y$10$mckb3sCiEDNVZ2ErIXhOUuXbQTRw8joftorWnrtR3VozOyvkneAjO', 'admin', '12'),
(6, 'zanandaaditya@gmail.com', '$2y$10$vFJ3U5b0e1Tby6FO6LoKNeUoCW/vaWYG94/mvKyqvyL.lLKnzx/12', 'zananda', '081440067807'),
(7, 'muhammad@gmail.com', '$2y$10$bcS0F1lCpE8/0iLRZtitmOpyv00MyZ8C.8KPHIZ3NtAhmKBmtce/m', 'muhammadi', '081992718183');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `foto`) VALUES
(5, 13, 'Nanda', 'Bank Negara Indonesia (BNI)', 57000, '2020-12-07', '5fce5c07c1c75.jpg'),
(6, 14, 'Indra anjing', 'Bank Rakyat Indonesia (BRI)', 134000, '2020-12-07', '5fce7efa5099a.jpg'),
(7, 13, 'Indra anjing', 'Bank Mandiri (Mandiri)', 57000, '2020-12-07', '5fce7f2dd3bcc.jpg'),
(8, 14, 'zananda aditya', 'Bank Central Asia (BCA)', 134000, '2020-12-08', '5fcebde631697.jpeg'),
(9, 15, 'Indra anjing', 'Bank Negara Indonesia (BNI)', 373200, '2020-12-08', '5fcec84b5a016.png'),
(10, 16, 'Hardian Theja', 'Bank Mandiri (Mandiri)', 373200, '2020-12-08', '5fced7225d663.jpg'),
(11, 20, 'Hardian Theja', 'Bank Mandiri (Mandiri)', 214000, '2020-12-08', '5fced95e74e1a.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `alamat1` varchar(50) NOT NULL,
  `alamat2` varchar(50) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif_ongkir` int(11) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'PENDING',
  `resi_pengiriman` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `alamat1`, `alamat2`, `nama_provinsi`, `nama_kota`, `tarif_ongkir`, `status_pembelian`, `resi_pengiriman`) VALUES
(7, 1, 2, '2020-12-05', 39000, '', '', '', 'Kabupaten Bangka', 39000, 'PENDING', ''),
(8, 1, 5, '2020-12-05', 368400, '', '', 'Bangka Belitung', 'Kabupaten Bangka Sel', 40000, 'PENDING', ''),
(9, 1, 5, '2020-12-05', 288800, '', '', 'Bangka Belitung', 'Kabupaten Bangka Sel', 40000, 'PENDING', ''),
(10, 1, 7, '2020-12-05', 522800, '', '', 'Bangka Belitung', 'Kabupaten Belitung T', 49000, 'PENDING', ''),
(11, 1, 3, '2020-12-05', 287300, '', '', 'Bangka Belitung', 'Kabupaten Bangka Barat', 41000, 'PENDING', ''),
(12, 6, 5, '2020-12-06', 585500, '', '', 'Bangka Belitung', 'Kabupaten Bangka Selatan', 40000, 'Lunas', 'JT671931'),
(13, 5, 0, '2020-12-07', 57000, '', '', '', '', 0, 'Sudah melakukan pembayaran', ''),
(14, 5, 2, '2020-12-07', 134000, '', '', 'Bangka Belitung', 'Kabupaten Bangka', 39000, 'Proses Pengiriman', 'JT671931'),
(15, 7, 0, '2020-12-08', 373200, '', '', '', '', 0, 'Pembayaran berhasil dikirim', ''),
(16, 7, 0, '2020-12-08', 373200, '', '', '', '', 0, 'Pembayaran berhasil dikirim', ''),
(17, 7, 0, '2020-12-08', 330900, '', '', '', '', 0, 'PENDING', ''),
(18, 7, 0, '2020-12-08', 373200, '', '', '', '', 0, 'PENDING', ''),
(19, 7, 1, '2020-12-08', 54000, 'Jalan Gang Pipit', 'No 233', 'Bangka Belitung', 'Kota Pangkalpinang', 34000, 'PENDING', ''),
(20, 7, 1, '2020-12-08', 214000, 'Jalan Gang Pipit', 'No 233', 'Bangka Belitung', 'Kota Pangkalpinang', 34000, 'Lunas', '2132121');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(11, 10, 34, 2, 'Kopi Florea Arabica', 124400, 3, 6, 248800),
(12, 10, 25, 5, 'Kopi Toraja', 45000, 2, 10, 225000),
(13, 11, 37, 3, 'Kopi Latte Vanila', 82100, 1000, 3000, 246300),
(14, 12, 25, 3, 'Kopi Toraja', 45000, 2, 6, 135000),
(15, 12, 37, 5, 'Kopi Latte Vanila', 82100, 1000, 5000, 410500),
(16, 13, 38, 3, 'Kopi Flores', 19000, 300, 900, 57000),
(17, 14, 38, 5, 'Kopi Flores', 19000, 300, 1500, 95000),
(18, 15, 34, 3, 'Kopi Florea Arabica', 124400, 3, 9, 373200),
(19, 16, 34, 3, 'Kopi Florea Arabica', 124400, 3, 9, 373200),
(20, 17, 37, 1, 'Kopi Latte Vanila', 82100, 1000, 1000, 82100),
(21, 17, 34, 2, 'Kopi Florea Arabica', 124400, 3, 6, 248800),
(22, 18, 34, 3, 'Kopi Florea Arabica', 124400, 3, 9, 373200),
(23, 19, 33, 2, 'Kopi Flores', 10000, 1, 2, 20000),
(24, 20, 25, 4, 'Kopi Toraja', 45000, 2, 8, 180000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `gambar_produk`, `deskripsi_produk`) VALUES
(25, 'Kopi Toraja', 45000, 2, '5fc2787a86be7.png', 'Kopi Liberika merupakan kopi yang menghasilkan buah yang jauh lebih besar, jika dibandingkan dengan jenis kopi lain.\r\nCita rasa dari kopi liberika ini punya rasa dan warna yang sangat kuat dan nikmat.\r\nKopi ini cukup digemari dan populer bagi masyarakat di Malaysia.\r\n'),
(33, 'Kopi Flores', 10000, 1, '5fc26a50a97a7.png', 'Kopi Liberika merupakan kopi yang menghasilkan buah yang jauh lebih besar, jika dibandingkan dengan jenis kopi lain. Cita rasa dari kopi liberika ini punya rasa dan warna yang sangat kuat dan nikmat. Kopi ini cukup digemari dan populer bagi masyarakat di Malaysia.'),
(34, 'Kopi Florea Arabica', 124400, 3, '5fc26a75ede4b.png', 'Kopi Liberika merupakan kopi yang menghasilkan buah yang jauh lebih besar, jika dibandingkan dengan jenis kopi lain. Cita rasa dari kopi liberika ini punya rasa dan warna yang sangat kuat dan nikmat. Kopi ini cukup digemari dan populer bagi masyarakat di Malaysia'),
(37, 'Kopi Latte Vanila', 82100, 1000, '5fc5da2499af8.png', 'Terenak sumpah gak banget ngab'),
(38, 'Kopi Flores', 19000, 300, '5fc5d9e597ad9.png', 'Tercaanthek'),
(39, 'Kopi Pempek Palembang', 50000, 400, '5fced885baca5.png', 'Kopi Terbaik se Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `password_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password_user`) VALUES
(1, 'admin', 'admin'),
(6, 'zanandaaditya', '$2y$10$iZpquH0kxyP1GSUZOyPagO2sTkrQPUWqJrZ.HOz0psWn8GWajt82G'),
(10, '11111', '$2y$10$Za15I0pPBpY9amqRHq/A4.V4bicacvFokwlr9rrKsWSbN7xzrLmpW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

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
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
