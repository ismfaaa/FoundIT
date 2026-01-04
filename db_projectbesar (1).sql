-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2026 pada 17.48
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
-- Database: `db_projectbesar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `verifikasi_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `isi_pesan` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claims`
--

CREATE TABLE `claims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `warna` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `foto_bukti` varchar(255) DEFAULT NULL,
  `deskripsi_bukti` text NOT NULL,
  `status_claim` enum('Proses','Diterima','Ditolak') NOT NULL DEFAULT 'Proses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `claims`
--

INSERT INTO `claims` (`id`, `item_id`, `user_id`, `warna`, `material`, `ukuran`, `kondisi`, `merk`, `foto_bukti`, `deskripsi_bukti`, `status_claim`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 'Cokelat', 'Kain', 'Besar', 'Utuh/Baru', '-', '1767543511_bukti_3.jpg', 'dalam tas ada dompet biru, syal putih tebal, earphone, buku paket dan botol minum\r\n\r\nd', 'Diterima', '2026-01-04 09:18:31', '2026-01-04 09:37:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tipe_laporan` enum('Kehilangan','Temuan') NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `foto_item` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_detail` varchar(255) NOT NULL,
  `tanggal_kejadian` date NOT NULL,
  `warna` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `status_item` enum('Aktif','Selesai') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `user_id`, `tipe_laporan`, `nama_item`, `foto_item`, `kategori_id`, `kecamatan_id`, `lokasi_detail`, `tanggal_kejadian`, `warna`, `merk`, `material`, `ukuran`, `kondisi`, `status_item`, `created_at`, `updated_at`) VALUES
(1, 2, 'Temuan', 'Topi SD', '1767541807_topi sd.jfif', 18, 1, 'dekat kolam renang green valley', '2026-01-02', 'Merah', '-', 'Kain', 'Sedang', 'Utuh/Baru', 'Aktif', '2026-01-04 08:50:09', '2026-01-04 08:50:09'),
(2, 2, 'Kehilangan', 'Tumbler', '1767541896_tumbl.jfif', 8, 4, 'Belakang Smanca dekat pohon tebu', '2026-01-01', 'Hitam', '-', 'Plastik', 'Sedang', 'Utuh/Baru', 'Aktif', '2026-01-04 08:51:36', '2026-01-04 08:51:36'),
(3, 2, 'Kehilangan', 'Handphone', '1767541962_Ilustrasi-Notif-WA-di-iPhone.jpg', 1, 8, 'SItu wanayasa deket aula', '2026-01-04', 'Abu', 'iPhone', 'Logam', 'Sedang', 'Utuh/Baru', 'Aktif', '2026-01-04 08:52:42', '2026-01-04 08:52:42'),
(4, 3, 'Temuan', 'Ransel Coklat', '1767542521_ransel-coklat.jpg', 4, 1, 'Dekat KAI Purwakarta arah bojong', '2026-01-02', 'Cokelat', '-', 'Kain', 'Besar', 'Utuh/Baru', 'Aktif', '2026-01-04 09:02:01', '2026-01-04 09:02:01'),
(5, 3, 'Temuan', 'Buku Buffet', '1767542605_buffet.jpg', 12, 12, 'Area waterboom Plered', '2025-12-03', 'Hitam', '-', 'Kulit', 'Sedang', 'Utuh/Baru', 'Aktif', '2026-01-04 09:03:25', '2026-01-04 09:03:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Handphone', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(2, 'Laptop', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(3, 'Dompet', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(4, 'Tas', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(5, 'Kunci', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(6, 'Jam Tangan', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(7, 'Kamera', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(8, 'Tumblr', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(9, 'Kalung', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(10, 'Gelang', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(11, 'Sepatu', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(12, 'Buku', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(13, 'Helm', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(14, 'Kacamata', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(15, 'Gantungan Kunci', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(16, 'Jaket', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(17, 'Payung', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(18, 'Topi', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(19, 'Pouch', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(20, 'Lain-lain', '2026-01-04 08:46:41', '2026-01-04 08:46:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama_kecamatan`, `created_at`, `updated_at`) VALUES
(1, 'Purwakarta', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(2, 'Babakancikao', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(3, 'Pasawahan', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(4, 'Campaka', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(5, 'Cibatu', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(6, 'Bungursari', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(7, 'Pondoksalam', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(8, 'Wanayasa', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(9, 'Kiarapedes', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(10, 'Bojong', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(11, 'Darangdan', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(12, 'Plered', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(13, 'Tegalwaru', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(14, 'Maniis', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(15, 'Jatiluhur', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(16, 'Sukasari', '2026-01-04 08:46:41', '2026-01-04 08:46:41'),
(17, 'Sukatani', '2026-01-04 08:46:41', '2026-01-04 08:46:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_01_03_000003_create_users_table', 1),
(4, '2026_01_03_063212_create_kategoris_table', 1),
(5, '2026_01_03_063242_create_kecamatans_table', 1),
(6, '2026_01_03_063250_create_items_table', 1),
(7, '2026_01_03_063302_create_verifikasis_table', 1),
(8, '2026_01_03_063337_create_chats_table', 1),
(9, '2026_01_04_134455_create_claims_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  `domisili` varchar(255) DEFAULT NULL,
  `help_point` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `foto_user`, `domisili`, `help_point`, `created_at`, `updated_at`) VALUES
(1, 'Miss Isma', '$2y$12$irW7bsKN7KGF3JveUTBn3.W0xqz3GYouzUbqNCc8nBbtXb7MLmVBm', 'user', 'fdlhisma@upi.edu', NULL, NULL, 0, '2026-01-04 07:47:08', '2026-01-04 07:47:08'),
(2, 'Zaidan', '$2y$12$iwegLxyUR8/so3fm4YYrHuTOziQKXu8aUoaoCw8pUjA4Asej.ZQMC', 'user', 'Zaidan@gmail.com', NULL, NULL, 0, '2026-01-04 08:06:22', '2026-01-04 08:06:22'),
(3, 'Resa', '$2y$12$RsD4UScnxFNSfWXh28R90u2OZzMA45r204y6sr2YXANHJXJEmRcsK', 'user', 'Resa@gmail.com', NULL, NULL, 0, '2026-01-04 08:59:34', '2026-01-04 08:59:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasis`
--

CREATE TABLE `verifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foto_bukti` varchar(255) NOT NULL,
  `deskripsi_klaim` text NOT NULL,
  `status_verifikasi` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `alasan_penolakan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `verifikasis`
--

INSERT INTO `verifikasis` (`id`, `item_id`, `user_id`, `foto_bukti`, `deskripsi_klaim`, `status_verifikasi`, `alasan_penolakan`, `created_at`, `updated_at`) VALUES
(1, 4, 3, '1767543511_bukti_3.jpg', 'dalam tas ada dompet biru, syal putih tebal, earphone, buku paket dan botol minum\r\n\r\nd', 'Pending', NULL, '2026-01-04 09:37:52', '2026-01-04 09:37:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_verifikasi_id_foreign` (`verifikasi_id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`);

--
-- Indeks untuk tabel `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claims_item_id_foreign` (`item_id`),
  ADD KEY `claims_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_user_id_foreign` (`user_id`),
  ADD KEY `items_kategori_id_foreign` (`kategori_id`),
  ADD KEY `items_kecamatan_id_foreign` (`kecamatan_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `verifikasis`
--
ALTER TABLE `verifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verifikasis_item_id_foreign` (`item_id`),
  ADD KEY `verifikasis_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `verifikasis`
--
ALTER TABLE `verifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_verifikasi_id_foreign` FOREIGN KEY (`verifikasi_id`) REFERENCES `verifikasis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `claims_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `verifikasis`
--
ALTER TABLE `verifikasis`
  ADD CONSTRAINT `verifikasis_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `verifikasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
