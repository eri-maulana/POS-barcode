-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2023 pada 16.46
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos-barcode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(100) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stock_minimal` int(11) NOT NULL,
  `gambar` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `barcode`, `nama_barang`, `harga_beli`, `harga_jual`, `stock`, `satuan`, `stock_minimal`, `gambar`) VALUES
('BRG-001', '8994016011537', 'Tisu Wajah', 20000, 25000, 3, 'piece', 3, 'BRG-001.jpg'),
('BRG-002', '6222210290', 'Buku ', 70000, 100000, 15, 'piece', 3, 'BRG-002.jpg'),
('BRG-003', '722050589', 'Buku Python', 80000, 100000, 0, 'kaleng', 3, 'BRG-003.jpg'),
('BRG-004', '8993175547413', 'time break', 700, 1000, -2, 'piece', 3, 'BRG-004.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli_detail`
--

CREATE TABLE `tbl_beli_detail` (
  `id` int(11) NOT NULL,
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_beli_detail`
--

INSERT INTO `tbl_beli_detail` (`id`, `no_beli`, `tgl_beli`, `kode_brg`, `nama_brg`, `qty`, `harga_beli`, `jml_harga`) VALUES
(3, 'PB0001', '2023-12-04', 'BRG-001', 'Tisu Wajah', 2, 20000, 40000),
(4, 'PB0001', '2023-12-04', 'BRG-002', 'Buku ', 1, 70000, 70000),
(6, 'PB0002', '2023-12-04', 'BRG-001', 'Tisu Wajah', 8, 20000, 160000),
(7, 'PB0002', '2023-12-04', 'BRG-002', 'Buku ', 9, 70000, 630000),
(8, 'PB0003', '2023-12-05', 'BRG-001', 'Tisu Wajah', 8, 20000, 160000),
(9, 'PB0005', '2023-12-05', 'BRG-002', 'Buku ', 2, 70000, 140000),
(10, 'PB0006', '2023-12-07', 'BRG-001', 'Tisu Wajah', 2, 20000, 40000),
(13, 'PB0007', '2023-12-08', 'BRG-002', 'Buku ', 10, 70000, 700000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli_head`
--

CREATE TABLE `tbl_beli_head` (
  `no_beli` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `suplier` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_beli_head`
--

INSERT INTO `tbl_beli_head` (`no_beli`, `tgl_beli`, `suplier`, `total`, `keterangan`) VALUES
('PB0001', '2023-12-04', 'PT Putri Narila', 110000, 'My Home.~'),
('PB0002', '2023-12-04', 'PT Putri Narila', 790000, 'Home ;v '),
('PB0003', '2023-12-05', 'PT Putri Narila', 160000, 'Home.~'),
('PB0005', '2023-12-05', 'CV Eri Maulana', 140000, ''),
('PB0006', '2023-12-07', 'PT Putri Narila', 40000, 'Home'),
('PB0007', '2023-12-08', 'PT Putri Narila', 700000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`id_customer`, `nama`, `telpon`, `deskripsi`, `alamat`) VALUES
(1, 'Umum', '123456789', 'xxx', 'xxx'),
(3, 'Eri', '987654321', 'xxx', 'xxx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual_detail`
--

CREATE TABLE `tbl_jual_detail` (
  `id` int(11) NOT NULL,
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jual_detail`
--

INSERT INTO `tbl_jual_detail` (`id`, `no_jual`, `tgl_jual`, `barcode`, `nama_brg`, `qty`, `harga_jual`, `jml_harga`) VALUES
(10, 'PJ0001', '2023-12-05', '8994016011537', 'Tisu Wajah', 1, 25000, 25000),
(11, 'PJ0002', '2023-12-05', '6222210290', 'Buku ', 1, 100000, 100000),
(13, 'PJ0003', '2023-12-04', '8994016011537', 'Tisu Wajah', 1, 25000, 25000),
(14, 'PJ0004', '2023-12-05', '6222210290', 'Buku ', 1, 100000, 100000),
(15, 'PJ0005', '2023-12-05', '6222210290', 'Buku ', 2, 100000, 200000),
(16, 'PJ0006', '2023-12-05', '6222210290', 'Buku ', 1, 100000, 100000),
(18, 'PJ0007', '2023-12-07', '8994016011537', 'Tisu Wajah', 2, 25000, 50000),
(19, 'PJ0008', '2023-12-07', '8993175547413', 'time break', 2, 1000, 2000),
(20, 'PJ0008', '2023-12-07', '8994016011537', 'Tisu Wajah', 3, 25000, 75000),
(21, 'PJ0009', '2023-12-08', '8994016011537', 'Tisu Wajah', 1, 25000, 25000),
(22, 'PJ0010', '2023-12-08', '8994016011537', 'Tisu Wajah', 1, 25000, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual_head`
--

CREATE TABLE `tbl_jual_head` (
  `no_jual` varchar(20) NOT NULL,
  `tgl_jual` date NOT NULL,
  `customer` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jual_head`
--

INSERT INTO `tbl_jual_head` (`no_jual`, `tgl_jual`, `customer`, `total`, `keterangan`, `jml_bayar`, `kembalian`) VALUES
('PJ0001', '2023-12-05', 'Maulanaaa', 25000, 'Meeeeeee', 50000, 25000),
('PJ0002', '2023-12-05', 'Maulanaaa', 100000, '', 100000, 0),
('PJ0003', '2023-12-04', 'Maulanaaa', 25000, '', 30000, 5000),
('PJ0004', '2023-12-05', 'Maulanaaa', 100000, '', 100000, 0),
('PJ0005', '2023-12-05', 'Maulanaaa', 200000, '', 200000, 0),
('PJ0006', '2023-12-05', 'Maulanaaa', 100000, '', 100000, 0),
('PJ0007', '2023-12-07', 'Maulanaaa', 50000, '', 100000, 50000),
('PJ0008', '2023-12-07', 'Maulanaaa', 77000, '', 100000, 23000),
('PJ0009', '2023-12-08', 'Umum', 25000, '', 50000, 25000),
('PJ0010', '2023-12-08', 'Umum', 25000, '', 30000, 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `deskripsi` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama`, `telpon`, `deskripsi`, `alamat`) VALUES
(1, 'CV Eri Maulana', '08123123123', 'Supplier', 'Sukabumi'),
(3, 'PT Putri Narila', '08321321321', 'Supplier Hidup ;v ', 'Lembur Situ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `address` varchar(100) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1-administrator\r\n2-supervisor\r\n3-operator',
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `address`, `level`, `foto`) VALUES
(5, 'putri', 'Putri Narila', '$2y$10$Z9OvkUwwH49p6zcggdnpL..m51Em1pJ8pk4t5DPqzFrREawdmUpqO', 'Sukabumi', 2, '117-tikus1.png'),
(8, 'eri', 'Eri Maulana', '$2y$10$oMK1pp2m37gc2Ibl8DPjt.co6d.M1u5TXnylmjNWirusiUGwtIMWK', 'Sukabumi', 3, '399-gede.png'),
(9, 'xxx', 'xxx', '$2y$10$EuphomrOvaQyDy5qZghEpejk0AjF1HxTyxtgwl9qj/piaVvYgEh9W', 'xxx', 1, '217-eri.png ');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_beli_head`
--
ALTER TABLE `tbl_beli_head`
  ADD PRIMARY KEY (`no_beli`);

--
-- Indeks untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jual_head`
--
ALTER TABLE `tbl_jual_head`
  ADD PRIMARY KEY (`no_jual`);

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_beli_detail`
--
ALTER TABLE `tbl_beli_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_jual_detail`
--
ALTER TABLE `tbl_jual_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
