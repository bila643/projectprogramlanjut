-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2026 pada 01.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pdam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal_publish` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal_publish`) VALUES
(1, 'PDAM Menambah Sambungan Baru', 'PDAM membuka layanan sambungan baru tahun 2026', 'pdam.jpg', '2026-06-02'),
(2, 'WASPADA PENCURIAN WATER METER PDAM', 'HIMBAUAN WASPADA PENCURIAN WATER METER PDAM\r\n\r\nKami menghimbau kepada seluruh pelanggan Perumda Air Minum Kabupaten Lamongan  agar meningkatkan kewaspadaan terhadap tindak pencurian water meter yang akhir-akhir ini terjadi di beberapa wilayah.\r\n\r\nUntuk mencegah hal tersebut, pelanggan diharapkan:\r\n✅ Memastikan water meter terpasang dengan kuat dan aman\r\n✅ Memberi pengaman tambahan (gembok/pelindung besi) bila perlu\r\n✅ Rutin memeriksa kondisi water meter\r\n✅ Segera melapor ke PDAM atau pihak berwajib jika melihat aktivitas mencurigakan\r\n\r\nMari bersama-sama menjaga fasilitas PDAM demi kelancaran layanan air bersih untuk kita semua.\r\n', 'beritaa.jpg', '2026-06-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meter_air`
--

CREATE TABLE `meter_air` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `bulan` date DEFAULT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL,
  `pemakaian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `meter_air`
--

INSERT INTO `meter_air` (`id`, `pelanggan_id`, `bulan`, `meter_awal`, `meter_akhir`, `pemakaian`) VALUES
(1, 2, '2026-06-02', 100, 135, 35),
(2, 3, '2026-06-03', 200, 400, 200),
(3, 4, '2026-06-06', 250, 400, 150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tarif_id` int(11) DEFAULT NULL,
  `no_pelanggan` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `user_id`, `tarif_id`, `no_pelanggan`, `nama`, `alamat`, `no_hp`, `status`) VALUES
(2, 5, 1, 'PD001', 'Budi', 'Jl.Mawar', '08123456789', 'aktif'),
(3, 5, 2, 'PD002', 'Wahyu A', 'Jl.Pahlawan', '081345346754', 'aktif'),
(4, 7, 1, 'PD003', 'Nabila', 'Jl.Melati', ' 08123456798', 'aktif'),
(7, NULL, NULL, 'PD004', 'Silvi ', 'Jl.depok', '08218796609', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `tagihan_id` int(11) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_verifikasi` enum('pending','diterima','ditolak') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_pengaduan` date DEFAULT NULL,
  `status` enum('diajukan','diproses','selesai') DEFAULT 'diajukan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `kategori`, `deskripsi`, `foto`, `tanggal_pengaduan`, `status`) VALUES
(1, 2, 'Pipa Bocor', 'Air tidak mengalir sejak kemarin malam di Jl. Mawar.', NULL, '2026-06-02', 'selesai'),
(2, 4, 'Pipa Patah', 'Air tidak mengalir ', NULL, '2026-06-03', 'selesai'),
(3, 4, 'saluran pipa mampet', 'tidak mengalir airnya', NULL, '2026-06-04', 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sambungan_baru`
--

CREATE TABLE `sambungan_baru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `foto_rumah` varchar(255) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `status` enum('menunggu','survey','disetujui','ditolak') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sambungan_baru`
--

INSERT INTO `sambungan_baru` (`id`, `nama`, `nik`, `alamat`, `no_hp`, `foto_ktp`, `foto_rumah`, `tanggal_pengajuan`, `status`) VALUES
(1, 'Budi', '123456789', 'Jl.Mawar', '08123456789', 'ktp karakter.jpg', 'rumah.jpg', '2026-06-02', 'disetujui'),
(2, 'Nabila', '123456789', 'Jl.Melati', '08123456798', NULL, NULL, '2026-06-03', 'disetujui'),
(4, 'Wahyu A', '123456787', 'Jl.Pahlawan', '089767564344', 'ktp gambar.jpg', 'rumah.jpg', '2026-06-06', 'menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `meter_id` int(11) DEFAULT NULL,
  `bulan` date DEFAULT NULL,
  `total_tagihan` decimal(12,2) DEFAULT NULL,
  `status` enum('belum_lunas','lunas') DEFAULT 'belum_lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `pelanggan_id`, `meter_id`, `bulan`, `total_tagihan`, `status`) VALUES
(1, 2, 1, '2026-06-02', 122500.00, 'lunas'),
(4, 4, 1, '2026-06-01', 75000.00, 'lunas'),
(5, 2, 1, '2026-06-02', 122500.00, 'lunas'),
(6, 3, 2, '2026-06-03', 1000000.00, 'belum_lunas'),
(7, 4, 3, '2026-06-06', 525000.00, 'belum_lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL,
  `nama_tarif` varchar(50) DEFAULT NULL,
  `harga_per_m3` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id`, `nama_tarif`, `harga_per_m3`) VALUES
(1, 'Rumah Tangga', 3500.00),
(2, 'Bisnis', 5000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','pelanggan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin123', 'admin'),
(3, 'Petugas', 'petugas@gmail.com', 'petugas123', 'petugas'),
(5, 'Budi', 'budi@gmail.com', 'budi123', 'pelanggan'),
(6, 'andi', 'andi@gmail.com', 'adni123', 'pelanggan'),
(7, 'Nabila', 'nabila@gmail.com', '12345a', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `meter_air`
--
ALTER TABLE `meter_air`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pelanggan` (`no_pelanggan`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tarif_id` (`tarif_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagihan_id` (`tagihan_id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `sambungan_baru`
--
ALTER TABLE `sambungan_baru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `meter_id` (`meter_id`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `meter_air`
--
ALTER TABLE `meter_air`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sambungan_baru`
--
ALTER TABLE `sambungan_baru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `meter_air`
--
ALTER TABLE `meter_air`
  ADD CONSTRAINT `meter_air_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pelanggan_ibfk_2` FOREIGN KEY (`tarif_id`) REFERENCES `tarif` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_2` FOREIGN KEY (`meter_id`) REFERENCES `meter_air` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
