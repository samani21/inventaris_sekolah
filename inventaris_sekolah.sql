-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2024 pada 13.05
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `merek` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nm_barang`, `satuan`, `merek`) VALUES
(10, 'k9332', 'Laptop', 'Unit', 'Acer'),
(11, 'KD0012', 'Proyektor', 'Unit', 'Canon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_barang`, `tgl`, `total`, `status`) VALUES
(2, 2, '2024-01-05', 21, 'Pemerintah'),
(3, 2, '2024-01-01', 1, 'Pemerintah'),
(9, 1, '2024-01-03', 3, 'Pembelian'),
(10, 1, '2024-01-04', 2, 'Pembelian'),
(11, 2, '2024-01-06', 10, 'Pemerintah'),
(13, 234, '2024-01-19', 324, '342'),
(15, 5, '2024-01-22', 1, 'Pemerintah'),
(16, 8, '2024-01-22', 12, '3'),
(17, 10, '2024-01-23', 1, 'Pemerintah'),
(18, 10, '2024-01-23', 7, 'sadsa'),
(19, 10, '2024-01-24', 1, 'addas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_peruangan`
--

CREATE TABLE `barang_peruangan` (
  `id_barang_peruangan` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_barang_masuk` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `stok` int(10) NOT NULL,
  `stok_selesai` int(10) NOT NULL,
  `ruangan` varchar(50) NOT NULL,
  `status_r` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_peruangan`
--

INSERT INTO `barang_peruangan` (`id_barang_peruangan`, `id_guru`, `id_barang_masuk`, `tgl_pinjam`, `tgl_selesai`, `stok`, `stok_selesai`, `ruangan`, `status_r`) VALUES
(47, 10, 18, '2024-01-23', '0000-00-00', 2, 2, 'Kantor', 2),
(48, 10, 18, '2024-01-23', '2024-01-23', 3, 3, 'Kantor', 2),
(49, 4, 18, '2024-01-24', '2024-01-24', 1, 1, 'sadsa', 2),
(50, 4, 18, '2024-01-24', '2024-01-24', 1, 1, 'sadsa', 2);

--
-- Trigger `barang_peruangan`
--
DELIMITER $$
CREATE TRIGGER `edit_pinjam` AFTER UPDATE ON `barang_peruangan` FOR EACH ROW BEGIN
	UPDATE barang_masuk SET total = total + OLD.stok - NEW.stok
    WHERE id_barang_masuk = OLD.id_barang_masuk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus__pinajm` AFTER DELETE ON `barang_peruangan` FOR EACH ROW BEGIN
	UPDATE barang_masuk SET total = total + OLD.stok
    WHERE id_barang_masuk = OLD.id_barang_masuk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `slesai` AFTER UPDATE ON `barang_peruangan` FOR EACH ROW BEGIN
	UPDATE barang_masuk SET total = total - OLD.stok_selesai + NEW.stok_selesai
    WHERE id_barang_masuk = OLD.id_barang_masuk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_pinjam` AFTER INSERT ON `barang_peruangan` FOR EACH ROW BEGIN
	UPDATE barang_masuk SET total = total - NEW.stok
    WHERE id_barang_masuk = NEW.id_barang_masuk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_status`
--

CREATE TABLE `barang_status` (
  `id_barang_status` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `stok` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang_status`
--

INSERT INTO `barang_status` (`id_barang_status`, `id_barang`, `tgl`, `stok`, `keterangan`, `status`) VALUES
(5, 2, '2024-01-02', 15, 'ddsfdf\nsadsadasdasasasdsfdfdfsasasas', 2),
(8, 1, '2024-01-04', 15, 'dsadsadasd', 2),
(9, 2, '2024-01-06', 12, 'sasda', 2),
(10, 2, '2024-01-06', 11, 'dasdas', 2),
(12, 3, '2024-01-18', 15, '123dasas', 2),
(13, 2, '2024-01-19', 2, '23', 2),
(14, 4, '2024-01-19', 2, 'sdsad', 2),
(15, 8, '2024-01-22', 2, 'sadas', 2),
(16, 8, '2024-01-22', 2, 'sadas', 2),
(17, 1, '2024-01-22', 12, 'asdasd', 1),
(19, 10, '2024-01-23', 121, 'sadsadas', 1),
(20, 10, '2024-01-23', 1, 'as', 1),
(21, 11, '2024-01-23', 3, 'sadas', 2),
(22, 11, '2024-01-24', 2, '1212', 1),
(27, 11, '2024-01-24', 1, 'dadsad', 1),
(28, 11, '2024-01-24', 1, 'asdsad', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `t_lahir` date NOT NULL,
  `j_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nip`, `nama`, `tempat`, `t_lahir`, `j_kelamin`, `agama`, `no_hp`, `foto`) VALUES
(4, 1, '87878687', 'Admin1', 'banjarmasin', '2024-01-03', 'Laki-laki', 'Islam', '777868', '1704285727_3cfda33f9fb20c6ec87f.png'),
(8, 16, '342', 'jbsdbhs', 'sadsa', '2024-11-30', 'Laki-laki', 'Islam', '3243', '1704533652_b50fda14f4e3e97d66c3.png'),
(9, 17, '432432', 'asda', '234', '2024-01-18', 'Laki-laki', 'Islam', '432432', '1705585440_6f959e52f4e9f206a45e.png'),
(10, 18, '373', 'tu', 'bdsf', '2022-10-30', 'Laki-laki', 'Islam', '3342', '1705978066_f9938b1d05bccbdbb6c1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-12-30-140937', 'App\\Database\\Migrations\\Users', 'default', 'App', 1703945437, 1),
(2, '2023-12-30-144108', 'App\\Database\\Migrations\\Users', 'default', 'App', 1703947321, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nm_ruangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nm_ruangan`) VALUES
(2, 'asasaasas'),
(3, 'sadsa'),
(4, 'Kantor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin', 'admin@admin', '$2y$10$X9v/8JPNhECHVSWipKwwNOtOdPyY6G4ngVWl96tltMTkCWprSLq9q', 'Admin', NULL, NULL),
(15, 'guru', 'guru', 'guru@guru', '$2y$10$KDgJO4KUKv0lTW5OFRpByOWdJWkvogllXo56tN8m7Au15liYgLwb.', 'Tata Usaha', NULL, NULL),
(16, 'adi', 'adi', 'adi@a', '$2y$10$PqZZCVrVwTN2FQKGbw7vROOkVayMp33UW0EtFPECPUjDE6.gus6nW', 'Tata Usaha', NULL, NULL),
(17, 'ayu', 'ayu', 'ayu@sd', '$2y$10$Nuqo8iSQsSCq9QmGzVKxe.8G3dfws61WLk0W2t1s0HHWcEez5hgVG', 'Tata Usaha', NULL, NULL),
(18, 'tu', 'tu', 'tu@tu', '$2y$10$Yg3YCC5vWX3GtoNTwCC06OpfBOoI/uUAbTsEmSBZW/XYTPdjf4cTa', 'Tata Usaha', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indeks untuk tabel `barang_peruangan`
--
ALTER TABLE `barang_peruangan`
  ADD PRIMARY KEY (`id_barang_peruangan`);

--
-- Indeks untuk tabel `barang_status`
--
ALTER TABLE `barang_status`
  ADD PRIMARY KEY (`id_barang_status`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `barang_peruangan`
--
ALTER TABLE `barang_peruangan`
  MODIFY `id_barang_peruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `barang_status`
--
ALTER TABLE `barang_status`
  MODIFY `id_barang_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
