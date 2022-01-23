-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 16, 2022 at 03:04 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip-bete`
--

-- --------------------------------------------------------

--
-- Table structure for table `batching`
--

CREATE TABLE `batching` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_batch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_batch` date NOT NULL,
  `kardus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batching`
--

INSERT INTO `batching` (`id`, `no_batch`, `tanggal_batch`, `kardus_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'BATCH-1/2022', '2022-01-08', NULL, 1, '2022-01-08 14:07:06', '2022-01-08 14:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bidang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `nama_bidang`, `created_at`, `updated_at`) VALUES
(1, 'KPPBC', '2022-01-08 14:39:47', '2022-01-08 14:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `data_gudang`
--

CREATE TABLE `data_gudang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_gudang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_gudang_id` bigint(20) UNSIGNED NOT NULL,
  `rak_id` bigint(20) UNSIGNED NOT NULL,
  `kardus_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imporpib`
--

CREATE TABLE `imporpib` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pib` int(11) NOT NULL,
  `tgl_pib` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_tt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jalur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_terima` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenisdok` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imporpib_master`
--

CREATE TABLE `imporpib_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pib` int(11) NOT NULL,
  `tgl_pib` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_tt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jalur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_terima` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Pelaksana Pemeriksa', NULL, NULL),
(2, 'PDTT', NULL, NULL),
(3, 'PFPD', NULL, NULL),
(4, 'Kepala Seksi', NULL, NULL),
(5, 'Kepala Kantor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_dok`
--

CREATE TABLE `jenis_dok` (
  `id` int(2) UNSIGNED NOT NULL,
  `nama_dokumen` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_dok`
--

INSERT INTO `jenis_dok` (`id`, `nama_dokumen`, `created_at`, `updated_at`) VALUES
(4, 'BC 2.5', NULL, NULL),
(5, 'Surat Kuasa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kardus`
--

CREATE TABLE `kardus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_kardus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kardus` date NOT NULL,
  `jalur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kardus`
--

INSERT INTO `kardus` (`id`, `no_kardus`, `tanggal_kardus`, `jalur`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'KARDUS-1/2022', '2022-01-08', '', '2022-01-08 15:05:38', '2022-01-08 15:05:38', 1),
(2, 'KARDUS-2/2022', '2022-01-15', '', '2022-01-15 10:08:48', '2022-01-15 10:08:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_18_013002_create_pangkat_table', 1),
(5, '2021_03_18_013631_create_bidang_table', 1),
(6, '2021_03_18_013914_create_seksi_table', 1),
(7, '2021_03_18_013935_create_jabatan_table', 1),
(8, '2021_03_18_014010_create_roles_table', 1),
(9, '2021_03_18_063733_create_pendok_table', 1),
(10, '2021_03_18_083526_create_pfpd_table', 1),
(11, '2021_03_19_145426_create_imporpibs_table', 1),
(12, '2021_03_20_123211_create_batchings_table', 1),
(13, '2021_03_20_124308_create_rak_table', 1),
(14, '2021_03_20_124917_create_gudang_table', 1),
(15, '2021_03_20_125227_create_peminjaman_table', 1),
(16, '2021_03_20_132308_create_status_table', 1),
(17, '2021_03_23_091608_create_sequence_table', 1),
(18, '2021_03_24_042521_create_kardus_table', 1),
(19, '2021_03_24_124938_create_data_gudang_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pangkat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id`, `nama_pangkat`, `created_at`, `updated_at`) VALUES
(1, 'II.a / Pengatur Muda', NULL, NULL),
(2, 'II.b / Pengatur Muda Tk. I', NULL, NULL),
(3, 'II.c / Pengatur', NULL, NULL),
(4, 'II.d / Pengatur Tk. I', NULL, NULL),
(5, 'III.a / Penata Muda', NULL, NULL),
(6, 'III.b / Penata Muda Tk. I', NULL, NULL),
(7, 'III.c / Penata', NULL, NULL),
(8, 'III.d / Penata Tk. I', NULL, NULL),
(9, 'IV.a / Pembina', NULL, NULL),
(10, 'IV.b / Pembina Tk. I', NULL, NULL),
(11, 'IV.c / Pembina Utama Muda', NULL, NULL),
(12, 'IV.e / Pembina Utama', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nd_masuk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_nd_masuk` date NOT NULL,
  `asal_nd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_nd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nd_keluar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_nd_keluar` date DEFAULT NULL,
  `tujuan_nd_keluar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nd_kembali` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_nd_kembali` date DEFAULT NULL,
  `keterangan_nd_kembali` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `nd_masuk`, `tgl_nd_masuk`, `asal_nd`, `tujuan_nd`, `perihal`, `nd_keluar`, `tgl_nd_keluar`, `tujuan_nd_keluar`, `nd_kembali`, `tgl_nd_kembali`, `keterangan_nd_kembali`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '02u', '2022-01-15', 'pkc', 'pinjamm', 'pinjam', '0322', '2022-01-15', 'setuju', '0333', '2022-01-29', NULL, 'DIKEMBALIKAN', 1, '2022-01-15 10:10:19', '2022-01-15 10:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `pendok`
--

CREATE TABLE `pendok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pib` int(11) NOT NULL,
  `tgl_pib` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_pfpd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_tt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jalur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_terima` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `peminjaman_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenisdok` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendok`
--

INSERT INTO `pendok` (`id`, `no_pib`, `tgl_pib`, `importir`, `nip_pfpd`, `pfpd`, `tgl_tt`, `jalur`, `nm_terima`, `batch_id`, `peminjaman_id`, `created_by`, `created_at`, `updated_at`, `jenisdok`) VALUES
(1, 258888, '01-01-2022', 'xyg', '123456', 'Faisal', '15-01-2022 15:29:43', 'Kuning', 'anhar deni', 1, 1, 1, '2022-01-15 08:30:04', '2022-01-15 10:10:32', NULL),
(2, 11111, '01022022', 'xyg', '123456', 'Faisal', '15-01-2022 17:05:32', 'Hijau', 'anhar deni', 1, NULL, 1, '2022-01-15 10:06:01', '2022-01-15 10:07:58', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pfpd`
--

CREATE TABLE `pfpd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_pfpd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pfpd`
--

INSERT INTO `pfpd` (`id`, `pfpd`, `nip_pfpd`, `created_at`, `updated_at`) VALUES
(1, 'Faisal', '123456', '2022-01-08 14:42:46', '2022-01-08 14:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_rak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gudang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_roles` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama_roles`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Rumah Tangga', NULL, NULL),
(3, 'Staff PDAD', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seksi`
--

CREATE TABLE `seksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_seksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seksi`
--

INSERT INTO `seksi` (`id`, `nama_seksi`, `bidang_id`, `created_at`, `updated_at`) VALUES
(1, 'SUB BAGIAN UMUM', 1, '2022-01-08 14:56:34', '2022-01-08 14:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `sequence`
--

CREATE TABLE `sequence` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sequence`
--

INSERT INTO `sequence` (`id`, `nama`, `tahun`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 'batch', 2022, 1, '2022-01-08 14:07:06', '2022-01-08 14:07:06'),
(2, 'kardus', 2022, 2, '2022-01-08 15:05:38', '2022-01-15 10:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `keterangan`, `statusable_type`, `statusable_id`, `created_at`, `updated_at`) VALUES
(1, 'BATCHING', 'Dokumen masuk batch BATCH-1/2022 tgl 2022-01-08', 'App\\Models\\Pendok', 1, '2022-01-15 10:07:49', '2022-01-15 10:07:49'),
(2, 'BATCHING', 'Dokumen masuk batch BATCH-1/2022 tgl 2022-01-08', 'App\\Models\\Pendok', 2, '2022-01-15 10:07:58', '2022-01-15 10:07:58'),
(3, 'PEREKAMAN ND MASUK', 'Dokumen belum diserahkan ke pkc', 'App\\Models\\Pendok', 1, '2022-01-15 10:10:32', '2022-01-15 10:10:32'),
(4, 'DIPINJAM', 'Dokumen masih dipinjam oleh pkc', 'App\\Models\\Pendok', 1, '2022-01-15 10:11:19', '2022-01-15 10:11:19'),
(5, 'DIKEMBALIKAN', 'Dokumen sudah dikembalikan oleh pkc tanggal 2022-01-29', 'App\\Models\\Pendok', 1, '2022-01-15 10:11:40', '2022-01-15 10:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seksi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `nip`, `pangkat`, `bidang`, `seksi`, `jabatan`, `roles`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'anhar deni', 'anhar.deni', '197403141995031001', 'III.d / Penata Tk. I', 'KPPBC', '--Pilih Seksi--', 'Kepala Seksi', 'Admin', '$2y$10$ZUd1g9Ma1kv5l6ItGr.CsOQhAzLU2ZpYvvrjTOS6BiSMzGgSH1Gvu', NULL, NULL, '2022-01-08 15:09:43'),
(2, 'john doe', 'john.doe', '1234567891011487', 'II.a / Pengatur Muda', 'KPPBC', 'SUB BAGIAN UMUM', 'Pelaksana Pemeriksa', 'Staff PDAD', '$2y$10$t00Imn4HoDYeJ2A2wD9amOMbnXUbcwaMToDYsdULorWyBaF9q/x2u', NULL, '2022-01-08 15:13:43', '2022-01-08 15:13:43'),
(3, 'Jane Doe', 'jane.doe', '22222222222222', 'II.a / Pengatur Muda', 'KPPBC', 'SUB BAGIAN UMUM', 'Pelaksana Pemeriksa', 'Rumah Tangga', '$2y$10$B4gz0kOUxCWcL.LGAq3JRuaYEx.H//jOUCH2Tzf3lTO8i25wywUl.', NULL, '2022-01-08 15:15:44', '2022-01-08 15:15:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batching`
--
ALTER TABLE `batching`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batching_no_batch_unique` (`no_batch`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_gudang`
--
ALTER TABLE `data_gudang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_gudang_nama_gudang_unique` (`nama_gudang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imporpib`
--
ALTER TABLE `imporpib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imporpib_master`
--
ALTER TABLE `imporpib_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_dok`
--
ALTER TABLE `jenis_dok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kardus`
--
ALTER TABLE `kardus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kardus_no_kardus_unique` (`no_kardus`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjaman_nd_masuk_unique` (`nd_masuk`);

--
-- Indexes for table `pendok`
--
ALTER TABLE `pendok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pendok_no_pib_tgl_pib_unique` (`no_pib`,`tgl_pib`);

--
-- Indexes for table `pfpd`
--
ALTER TABLE `pfpd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rak_nama_rak_unique` (`nama_rak`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sequence`
--
ALTER TABLE `sequence`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sequence_nama_tahun_unique` (`nama`,`tahun`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_statusable_type_statusable_id_index` (`statusable_type`,`statusable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batching`
--
ALTER TABLE `batching`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_gudang`
--
ALTER TABLE `data_gudang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imporpib`
--
ALTER TABLE `imporpib`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imporpib_master`
--
ALTER TABLE `imporpib_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_dok`
--
ALTER TABLE `jenis_dok`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kardus`
--
ALTER TABLE `kardus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendok`
--
ALTER TABLE `pendok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pfpd`
--
ALTER TABLE `pfpd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seksi`
--
ALTER TABLE `seksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sequence`
--
ALTER TABLE `sequence`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
