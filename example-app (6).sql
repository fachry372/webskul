-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2025 at 03:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('jurusans', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:18:\"App\\Models\\Jurusan\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"jurusans\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:12;s:4:\"name\";s:31:\"Akuntansi dan Keuangan Lembagaa\";s:4:\"slug\";s:31:\"akuntansi-dan-keuangan-lembagaa\";s:10:\"created_at\";s:19:\"2025-08-21 06:02:38\";s:10:\"updated_at\";s:19:\"2025-09-09 05:46:07\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:12;s:4:\"name\";s:31:\"Akuntansi dan Keuangan Lembagaa\";s:4:\"slug\";s:31:\"akuntansi-dan-keuangan-lembagaa\";s:10:\"created_at\";s:19:\"2025-08-21 06:02:38\";s:10:\"updated_at\";s:19:\"2025-09-09 05:46:07\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:1:{i:0;s:4:\"name\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:18:\"App\\Models\\Jurusan\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"jurusans\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:5:{s:2:\"id\";i:14;s:4:\"name\";s:9:\"Pemasaran\";s:4:\"slug\";s:9:\"pemasaran\";s:10:\"created_at\";s:19:\"2025-08-22 07:50:15\";s:10:\"updated_at\";s:19:\"2025-08-22 07:50:15\";}s:11:\"\0*\0original\";a:5:{s:2:\"id\";i:14;s:4:\"name\";s:9:\"Pemasaran\";s:4:\"slug\";s:9:\"pemasaran\";s:10:\"created_at\";s:19:\"2025-08-22 07:50:15\";s:10:\"updated_at\";s:19:\"2025-08-22 07:50:15\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:1:{i:0;s:4:\"name\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1758081545);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `judul`, `slug`, `created_at`, `updated_at`) VALUES
(13, 'Galeri Sekolah', 'galeri-sekolah', '2025-09-08 19:02:08', '2025-09-08 19:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_blocks`
--

CREATE TABLE `galeri_blocks` (
  `id` bigint UNSIGNED NOT NULL,
  `galeri_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `photos` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `videos_link` json DEFAULT NULL COMMENT 'Array link video platform (YT, TikTok, IG, FB, dll)',
  `files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri_blocks`
--

INSERT INTO `galeri_blocks` (`id`, `galeri_id`, `title`, `text`, `photos`, `videos`, `videos_link`, `files`, `created_at`, `updated_at`) VALUES
(34, 13, NULL, '<p><br></p>', '\"[]\"', '\"[]\"', '\"[]\"', '\"[\\\"galeri\\\\/files\\\\/Oxo8KLWmRyDWMZMiJ9THCaoLp8i3sLi4QQ6UILLT.pdf\\\",\\\"galeri\\\\/files\\\\/QbKPvsMzTG1ckkV463XOWLeb8RmEC1Y31veGxFAr.xlsx\\\"]\"', '2025-09-08 19:02:08', '2025-09-12 00:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `ikms`
--

CREATE TABLE `ikms` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ikms`
--

INSERT INTO `ikms` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(9, 'Modul Ajar', 'modul-ajar', '2025-08-26 19:58:47', '2025-08-26 19:58:47'),
(10, 'KSP', 'ksp', '2025-08-26 19:58:53', '2025-08-26 19:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `ikm_konten`
--

CREATE TABLE `ikm_konten` (
  `id` bigint UNSIGNED NOT NULL,
  `ikm_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `text` text,
  `photos` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `file` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ikm_konten`
--

INSERT INTO `ikm_konten` (`id`, `ikm_id`, `title`, `text`, `photos`, `videos`, `file`, `created_at`, `updated_at`) VALUES
(31, 9, NULL, NULL, NULL, NULL, NULL, '2025-08-28 19:54:32', '2025-08-28 19:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `ikm_konten_blocks`
--

CREATE TABLE `ikm_konten_blocks` (
  `id` bigint UNSIGNED NOT NULL,
  `ikm_konten_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `photos` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `videos_link` json DEFAULT NULL COMMENT 'Array link video platform (YT, TikTok, IG, FB, dll)',
  `files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ikm_konten_blocks`
--

INSERT INTO `ikm_konten_blocks` (`id`, `ikm_konten_id`, `title`, `text`, `photos`, `videos`, `videos_link`, `files`, `created_at`, `updated_at`) VALUES
(48, 31, 'Modul', '<h1 class=\"ql-align-center\">zdbvbfs</h1>', '[\"ikm/photos/q1btgephLO2Bl5cAsnEDh9igK4ugXKJKt3cmA601.jpg\", \"ikm/photos/RRL4okmLoOo8sqkaq6qahf2urd20SMCqAT09kt0p.jpg\", \"ikm/photos/qgbj48QJAYCulavxZwLLfA5bZ4tw1b4xx7mDlzu9.jpg\", \"ikm/photos/RcELQt8EeKzPdsjYkTbkpTbO2AwXDX1YTDEV4jx1.jpg\"]', '[]', '[\"https://www.instagram.com/p/DKd4KBORcUV/embed\", \"https://www.instagram.com/p/DKd4KBORcUV/embed\", \"https://www.instagram.com/p/DKd4KBORcUV/embed\", \"https://www.youtube.com/embed/aSCdFpJMhyE\"]', '[\"ikm/files/D1eYgxCab1feGSqukMNTNO3XwY5uxKe0FoqrIJsR.pdf\"]', '2025-08-28 19:54:32', '2025-09-11 01:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_terbaru`
--

CREATE TABLE `informasi_terbaru` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `status` enum('draft','publish') NOT NULL DEFAULT 'draft',
  `tanggal_publish` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informasi_terbaru`
--

INSERT INTO `informasi_terbaru` (`id`, `judul`, `slug`, `isi`, `kategori_id`, `status`, `tanggal_publish`, `created_at`, `updated_at`) VALUES
(7, 'mbhfg', 'mbhfg', '<p>#NesasInfo</p><p>SMKN 1 Subang jalin MOU dengan Anabuki college Japanese Course,</p><p>dalam kerjasama tersebut, kedua belah pihak akan bekerjasama antara lain :</p><p>1. Menggiatkan pertukaran antara pelajar, pengajar, hingga pimpinan institusi.</p><p>2. Mengupayakan kerjasama untuk meningkatkan kualitas pendidikan</p><p>3. Jika ada permohonan untuk pertukaran pelajar, General Incorporated Association KAGAWA Professional Institution Association akan membantu dalam hal penyediaan informasi dan penunjang lainnya&nbsp;terhadap institusi pendidikan yang dituju agar proses pengajuaan permohonan dapat berjalan lancar.</p><p>4. Kegiatan-kegiatan lain yang telah disetujui oleh kedua belah pihak.</p><p>Semoga dengan adanya kerjasama ini dapat menambah Link and Match SMKN 1 Subang.</p><p>#SMKNEGERI1SUBANG</p><p>#NESASCYBERMEDIA</p><p class=\"ql-align-center\">#NESASCEREN</p>', 2, 'publish', '2025-09-04', '2025-09-02 20:26:45', '2025-09-02 23:33:43'),
(8, 'aaa', 'aaa', '<p>AAaaaaa</p>', 2, 'publish', '2025-09-03', '2025-09-02 20:57:31', '2025-09-02 23:12:49'),
(9, 'bbbb', 'bbbb', '<p>zzz</p>', 3, 'publish', '2025-09-03', '2025-09-02 23:20:38', '2025-09-08 22:53:34'),
(10, 'Galeri Sekolah', 'galeri-sekolah', '<p>aaaa</p>', 2, 'publish', '2025-09-08', '2025-09-07 21:47:04', '2025-09-07 21:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_terbaru_gambar`
--

CREATE TABLE `informasi_terbaru_gambar` (
  `id` bigint UNSIGNED NOT NULL,
  `informasi_id` bigint UNSIGNED NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informasi_terbaru_gambar`
--

INSERT INTO `informasi_terbaru_gambar` (`id`, `informasi_id`, `nama_file`, `created_at`, `updated_at`) VALUES
(26, 7, 'informasi/72d9M5h2xDoq9Q4ZW0MBVkioM0Jl8xDm5foA0f4W.png', '2025-09-02 23:37:34', '2025-09-02 23:37:34'),
(27, 7, 'informasi/3G8nvX8pzgqyWKRJaii13Q54xzjiHigFOGlbXM9j.png', '2025-09-02 23:37:55', '2025-09-02 23:37:55'),
(28, 7, 'informasi/oWeSEdYduh4hrKYSRRnK2BT3ic5ya8nPjE5AEuZV.png', '2025-09-02 23:37:55', '2025-09-02 23:37:55'),
(29, 7, 'informasi/yuf7FxBI7s3WmMlLDUdYYwxlMet2w22R1injB8pQ.png', '2025-09-02 23:37:55', '2025-09-02 23:37:55'),
(30, 7, 'informasi/vlDzoUyJTeNnLcOata78CNEhJeQxPpbLWVFWZkIZ.jpg', '2025-09-02 23:43:12', '2025-09-02 23:43:12'),
(31, 7, 'informasi/5AylT0pOjfwirdMMqD6ogeGSRU25nzwznJvwg23z.jpg', '2025-09-02 23:43:12', '2025-09-02 23:43:12'),
(32, 7, 'informasi/itRxJ33h89lvPcGShRB1J6vzvovp3Hgn9lUUFqvV.jpg', '2025-09-02 23:43:12', '2025-09-02 23:43:12'),
(33, 7, 'informasi/1cy8XOtWSDkC7yClR4SM7jA8MmQLwVXIf6gKKjPB.jpg', '2025-09-02 23:43:12', '2025-09-02 23:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(12, 'Akuntansi dan Keuangan Lembagaa', 'akuntansi-dan-keuangan-lembagaa', '2025-08-20 23:02:38', '2025-09-08 22:46:07'),
(14, 'Pemasaran', 'pemasaran', '2025-08-22 00:50:15', '2025-08-22 00:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_informasi`
--

CREATE TABLE `kategori_informasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_informasi`
--

INSERT INTO `kategori_informasi` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Lowongan Kerja', 'lowongan-kerja', '2025-09-02 17:59:15', '2025-09-02 17:59:15'),
(3, 'safadf', 'safadf', '2025-09-02 23:10:41', '2025-09-02 23:10:41'),
(4, 'asfdfad', 'asfdfad', '2025-09-02 23:10:45', '2025-09-02 23:10:45'),
(5, 'aa', 'aa', '2025-09-09 23:20:14', '2025-09-09 23:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `kelulusans`
--

CREATE TABLE `kelulusans` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('draft','publish') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelulusans`
--

INSERT INTO `kelulusans` (`id`, `judul`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Kelulusan', 'kelulusan', 'draft', '2025-09-08 19:15:24', '2025-09-16 18:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `kelulusan_blocks`
--

CREATE TABLE `kelulusan_blocks` (
  `id` bigint UNSIGNED NOT NULL,
  `kelulusan_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `photos` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `videos_link` json DEFAULT NULL COMMENT 'Array link video platform (YT, TikTok, IG, FB, dll)',
  `files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelulusan_blocks`
--

INSERT INTO `kelulusan_blocks` (`id`, `kelulusan_id`, `title`, `text`, `photos`, `videos`, `videos_link`, `files`, `created_at`, `updated_at`) VALUES
(9, 6, NULL, '<p><br></p>', '\"[\\\"kelulusan\\\\/photos\\\\/P1mGByFAFC1BZ2iajrCIs74fRKKqpPOMhZyRb2D0.jpg\\\"]\"', '\"[]\"', '\"[]\"', '\"[\\\"kelulusan\\\\/files\\\\/paqXjVgpFuYT7X1cIf1GUHOyuknV2BVNTwyHE6TZ.xlsx\\\",\\\"kelulusan\\\\/files\\\\/VJYmTvXjXypfQO6LPncSmlgVFUNnSet1WCtxoW5I.pdf\\\"]\"', '2025-09-08 19:15:24', '2025-09-12 00:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `lainnya`
--

CREATE TABLE `lainnya` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lainnya`
--

INSERT INTO `lainnya` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'BURSA KERJA KHUSUS', 'bursa-kerja-khusus', '2025-09-03 00:08:42', '2025-09-03 00:31:11'),
(3, 'SPW', 'spw', '2025-09-03 00:08:47', '2025-09-03 00:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `lainnya_konten`
--

CREATE TABLE `lainnya_konten` (
  `id` bigint UNSIGNED NOT NULL,
  `lainnya_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `text` text,
  `photos` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lainnya_konten`
--

INSERT INTO `lainnya_konten` (`id`, `lainnya_id`, `title`, `text`, `photos`, `videos`, `file`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, NULL, NULL, '2025-09-03 01:00:56', '2025-09-03 01:00:56'),
(2, 3, NULL, NULL, NULL, NULL, NULL, '2025-09-10 00:02:12', '2025-09-10 00:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `lainnya_konten_blocks`
--

CREATE TABLE `lainnya_konten_blocks` (
  `id` bigint UNSIGNED NOT NULL,
  `lainnya_konten_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` longtext,
  `photos` json DEFAULT NULL,
  `videos` json DEFAULT NULL,
  `files` json DEFAULT NULL,
  `videos_link` json DEFAULT NULL COMMENT 'Array link video platform',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lainnya_konten_blocks`
--

INSERT INTO `lainnya_konten_blocks` (`id`, `lainnya_konten_id`, `title`, `text`, `photos`, `videos`, `files`, `videos_link`, `created_at`, `updated_at`) VALUES
(5, 1, 'Modul', '<p><br></p>', '[]', '[]', '[]', '[\"https://www.instagram.com/p/DKd4KBORcUV/embed\"]', '2025-09-03 01:14:31', '2025-09-03 01:20:55'),
(6, 2, NULL, '<p><br></p>', '[]', '[]', '[]', '[null]', '2025-09-10 00:02:12', '2025-09-10 00:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `content_section_photos` json DEFAULT NULL,
  `content_section_photos_text` text,
  `content_section_files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `profile_id`, `title`, `content`, `image`, `content_section_photos`, `content_section_photos_text`, `content_section_files`, `created_at`, `updated_at`) VALUES
(16, 4, NULL, '<h2 class=\"ql-align-center\"><strong>VISI</strong></h2><p class=\"ql-align-center\">“Menjadi Lembaga Pendidikan yang Terdepan dalam Menyiapkan Lulusan yang Berkarakter Agamis, Berjiwa WIrausaha, Mampu Beradaptasi dengan Perkembangan Zaman, Profesional di Bidangnya dan Peduli Terhadap Lingkungan Sekitar baik Nasional maupun Regional pada Tahun 2024”</p><h2 class=\"ql-align-center\"><strong>MISI</strong></h2><ol><li>Menyiapkan lulusan yang berkarakter agamis.</li><li>Menyiapkan Lulusan yang berjiwa wirausaha.</li><li>Menyiapkan Lulusan yang mampu beradaptasi dengan perkembangan zaman.</li><li>Menyiapkan Lulusan yang professional di bidang keahliannya.</li><li>Menyiapkan Lulusan yang peduli terhadap lingkungan sekitar baik Nasional maupun global.</li></ol><h2 class=\"ql-align-center\"><strong>TUJUAN</strong></h2><ol><li>Dalam upaya mewujudkan misi menyiapkan lulusan yang berkarakter agamis, sekolah Menyusun program yang terintegrasi dalam model sekolah yaitu CEREN, dimana Caharacter Building (C) merupkan program sekolah untuk membentuk karakter siswa yang agamis melalui program Islamic School Culture, membentuk karakter siswa yang kuat fisik dan Tangguh melalui program bela negara dan untuk membentuk karakter bekerja sama atau bergotong royong dilaksanakan dengan program kebersamaan.</li><li>Dalam Upaya mewujudkan misi menyiapkan lulusan yang berjiwa wirausaha (mampu membaca peluang, pantang menyerah, berani, ulet dan bekerja keras), sekolah membuat program yang terintegrasi dalam model CEREN yaitu Entrepreneruship (E), melalui program unit produksi pada masing-masing kompetensi keahlian, optimalisasi mimake dengan konsep SMK Masuk Desa, penciptaan berbagai peluang dengan konsep Start Up Bisnis.</li><li>Dalam Upaya mewujudkan lulusan yang mampu beradaptasi dengan perkembangan zaman, sekolah Menyusun program yang terintegrasi dalam model CEREN, yaitu Responsive (R), melalui program Smart School dengan konsep “One for All”, digitalisasi seluruh program yang dilaksakan sekolah, terbiasa merancang teknologi terbarukan yang dibutuhkan masyarakat luas.</li><li>Dalam upaya mewujudkan lulusan yang professional di bidangnya, sekolah menyusun program yang terintegrasi dalam model CEREN yaitu Excellent of Competency, melalui program kelas industry untuk setiap kompetensi keahlian, pelaksanaan pembelajaran dengan system teaching Factory, Sinkronisasi kurikulum industry dan program&nbsp;pencapaian kluster SMKN 1 Subang menajdi kluster industry pad tahun 2024.</li><li>Dalam Upaya mewujudkan lulusan yang peduli terhadap lingkungan sekitar baik secara nasional maupun global, sekolah Menyusun program yang terintegrasi dalam model CEREN, yaitu Nature (N), melalui program kegiatan Greeen School.</li></ol><p><br></p>', NULL, '\"[]\"', '<p><br></p>', '\"[]\"', '2025-08-25 02:06:15', '2025-08-25 02:20:57'),
(17, 3, NULL, '<pre class=\"ql-syntax\" spellcheck=\"false\">Nama Sekolah 		: SMK NEGERI 1 SUBANG \r\nNPSN 				: 20233680\r\nProvinsi 			: Jawa Barat\r\nKabupaten 			: Subang \r\nKecamatan 			: Subang\r\nKelurahan 			: Cigadung\r\nKode Pos			: 41213\r\nJalan 				: Arief Rahman Hakim N0. 35\r\nTelepon/Fax			: 0260 411410\r\nStatus Sekolah 		: Negeri\r\nAkreditasi 			: Ya\r\nTahun Berdiri 		: 1965\r\nStatus Tanah 		: Milik Sendiri\r\nStatus Bangunan 	: Milik Sendiri\r\nLuas Area’ 			: 5.000 M’\r\nKompetensi Keahlian : 1. Akuntansi dan Keuangan Lembaga \r\n    				  2. Bisnis Daring dan Pemasaran \r\n      				  3. Otomatisasi Tata Kelola Perkantoran \r\n    				  4. Rekayasa Perangkat Lunak \r\n    				  5. Teknik Komputer dan Jaringan \r\n    				  6. Teknik Bisnis Sepeda Motor \r\n    				  7. Desain Grafika \r\n    				  8. Teknik Pemesinan \r\n    				  9. Teknik Logistik \r\n        			  10. Tata Boga \r\nWebsite 			: www.smkn1subang.sch.id\r\nE-mail 				: info@smkn1subang.sch.id\r\nSosial Media 		: SMK Negeri 1 Subang Resmi\r\n                      @officialsmkn1subang \r\n                      SMK Negeri 1 Subang Official\r\n\r\n</pre><p><br></p>', NULL, '\"[]\"', '<p><br></p>', '\"[]\"', '2025-08-25 02:24:52', '2025-08-25 02:37:56'),
(18, 5, NULL, '<p><br></p>', NULL, '\"[\\\"menus\\\\/photos\\\\/ctP6MIXAl6DLQ2c5lLvdVxjiLLoJXQjRzUtQfo4s.jpg\\\"]\"', '<p><br></p>', '\"[\\\"menus\\\\/files\\\\/GLFr6svAAqVOoeW3kPClGe2srVoxVnXfN6Qh9ude.pdf\\\",\\\"menus\\\\/files\\\\/tt2Q3p83t63C0afQ1qX09ZaEzl6NEv6wF8X9qOgN.xlsx\\\"]\"', '2025-08-25 19:05:08', '2025-09-12 00:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2025_08_07_020853_create_jurusan_table', 1),
(7, '0001_01_01_000000_create_users_table', 2),
(8, '0001_01_01_000001_create_cache_table', 2),
(9, '0001_01_01_000002_create_jobs_table', 2),
(10, '2025_08_05_040945_create_personal_access_tokens_table', 2),
(11, '2025_08_07_020853_create_jurusans_table', 2),
(12, '2025_08_07_020905_create_posts_table', 2),
(13, '2025_08_11_040422_add_tim_pengajar_photos_to_posts_table', 3),
(14, '2025_08_12_021942_add_galeri_kegiatan_photos_to_posts_table', 4),
(15, '2025_08_12_032649_add_all_photos_columns', 5),
(16, '2025_08_19_060908_add_slug_to_jurusans_table', 6),
(17, '2025_08_22_031823_add_files_columns_to_posts_table', 7),
(18, '2025_08_22_063753_add_photos_text_to_posts_table', 8),
(19, '2025_08_25_030823_create_profiles_table', 9),
(20, '2025_08_25_030824_create_profile_items_table', 9),
(21, '2025_08_25_035237_create_profile_menus_table', 10),
(22, '2025_08_25_060315_create_menus_table', 11),
(23, '2025_08_26_024230_create_ikms_table', 12),
(24, '2025_08_26_033333_create_ikm_konten_table', 13),
(25, '2025_08_26_033928_create_ikm_konten_table', 14),
(26, '2025_08_26_073917_create_ikm_konten_blocks_table', 15),
(27, '2025_08_27_ikm_konten_blocks_add_videos_link', 16),
(28, '2025_09_02_010435_create_galeris_table', 17),
(29, '2025_09_02_010821_create_galeris_table', 18),
(30, '2025_09_02_010833_create_galeri_blocks_table', 18),
(31, '2025_09_02_011754_create_galeris_table', 19),
(32, '2025_09_02_011823_create_galeri_blocks_table', 19),
(33, '2025_09_02_040755_create_kelulusans_table', 20),
(34, '2025_09_02_040810_create_kelulusan_blocks_table', 20),
(35, '2025_09_03_003259_create_kategori_informasi_table', 21),
(36, '2025_09_03_003300_create_informasi_terbaru_table', 22),
(37, '2025_09_03_003953_create_informasi_terbaru_gambar_table', 23),
(38, '2025_09_03_065731_create_lainnya_table', 24),
(39, '2025_09_03_065746_create_lainnya_konten_table', 24),
(40, '2025_09_03_065800_create_lainnya_konten_blocks_table', 24),
(41, '2025_09_08_015033_create_sarans_table', 25),
(42, '2025_09_08_034113_create_pengunjung_table', 26),
(43, '2025_09_08_034125_create_page_views_table', 26),
(44, '2025_09_09_021008_add_status_to_kelulusans_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `url`, `created_at`, `updated_at`) VALUES
(1, '/', '2025-09-07 21:06:03', '2025-09-07 21:06:03'),
(2, '/', '2025-09-07 21:06:09', '2025-09-07 21:06:09'),
(3, '/', '2025-09-07 21:06:19', '2025-09-07 21:06:19'),
(4, '/', '2025-09-07 21:06:35', '2025-09-07 21:06:35'),
(5, '/', '2025-09-07 21:14:51', '2025-09-07 21:14:51'),
(6, '/', '2025-09-07 21:15:46', '2025-09-07 21:15:46'),
(7, '/', '2025-09-07 21:23:31', '2025-09-07 21:23:31'),
(8, '/', '2025-09-07 21:26:06', '2025-09-07 21:26:06'),
(9, '/', '2025-09-07 21:28:17', '2025-09-07 21:28:17'),
(10, '/', '2025-09-07 21:31:33', '2025-09-07 21:31:33'),
(11, '/', '2025-09-07 21:34:18', '2025-09-07 21:34:18'),
(12, '/', '2025-09-07 21:36:44', '2025-09-07 21:36:44'),
(13, '/', '2025-09-07 21:36:58', '2025-09-07 21:36:58'),
(14, '/', '2025-09-07 21:37:13', '2025-09-07 21:37:13'),
(15, '/', '2025-09-07 21:40:06', '2025-09-07 21:40:06'),
(16, '/', '2025-09-07 21:43:10', '2025-09-07 21:43:10'),
(17, '/', '2025-09-07 21:43:26', '2025-09-07 21:43:26'),
(18, '/', '2025-09-07 22:43:16', '2025-09-07 22:43:16'),
(19, '/', '2025-09-07 22:43:22', '2025-09-07 22:43:22'),
(20, '/', '2025-09-07 22:43:29', '2025-09-07 22:43:29'),
(21, '/', '2025-09-07 22:43:31', '2025-09-07 22:43:31'),
(22, '/', '2025-09-07 22:44:48', '2025-09-07 22:44:48'),
(23, '/', '2025-09-07 22:44:56', '2025-09-07 22:44:56'),
(24, '/', '2025-09-07 22:46:03', '2025-09-07 22:46:03'),
(25, '/', '2025-09-07 22:47:12', '2025-09-07 22:47:12'),
(26, '/', '2025-09-07 22:47:45', '2025-09-07 22:47:45'),
(27, '/', '2025-09-07 22:49:18', '2025-09-07 22:49:18'),
(28, '/', '2025-09-07 22:52:27', '2025-09-07 22:52:27'),
(29, '/', '2025-09-07 22:52:31', '2025-09-07 22:52:31'),
(30, '/', '2025-09-07 22:52:50', '2025-09-07 22:52:50'),
(31, '/', '2025-09-07 23:10:51', '2025-09-07 23:10:51'),
(32, '/', '2025-09-07 23:12:53', '2025-09-07 23:12:53'),
(33, '/', '2025-09-07 23:45:09', '2025-09-07 23:45:09'),
(34, '/', '2025-09-07 23:45:20', '2025-09-07 23:45:20'),
(35, '/', '2025-09-07 23:45:22', '2025-09-07 23:45:22'),
(36, '/', '2025-09-07 23:45:46', '2025-09-07 23:45:46'),
(37, '/', '2025-09-08 00:06:11', '2025-09-08 00:06:11'),
(38, '/', '2025-09-08 17:18:26', '2025-09-08 17:18:26'),
(39, '/', '2025-09-08 17:22:57', '2025-09-08 17:22:57'),
(40, '/', '2025-09-08 17:32:13', '2025-09-08 17:32:13'),
(41, '/', '2025-09-08 19:21:52', '2025-09-08 19:21:52'),
(42, '/', '2025-09-08 19:22:01', '2025-09-08 19:22:01'),
(43, '/', '2025-09-08 19:22:29', '2025-09-08 19:22:29'),
(44, '/', '2025-09-08 19:26:32', '2025-09-08 19:26:32'),
(45, '/', '2025-09-08 19:27:08', '2025-09-08 19:27:08'),
(46, '/', '2025-09-08 19:28:15', '2025-09-08 19:28:15'),
(47, '/', '2025-09-08 22:30:48', '2025-09-08 22:30:48'),
(48, '/', '2025-09-08 22:40:40', '2025-09-08 22:40:40'),
(49, '/', '2025-09-08 22:40:58', '2025-09-08 22:40:58'),
(50, '/', '2025-09-08 22:42:13', '2025-09-08 22:42:13'),
(51, '/', '2025-09-08 22:57:51', '2025-09-08 22:57:51'),
(52, '/', '2025-09-08 22:59:06', '2025-09-08 22:59:06'),
(53, '/', '2025-09-08 23:28:41', '2025-09-08 23:28:41'),
(54, '/', '2025-09-09 19:13:09', '2025-09-09 19:13:09'),
(55, '/', '2025-09-09 22:07:20', '2025-09-09 22:07:20'),
(56, '/', '2025-09-09 22:09:01', '2025-09-09 22:09:01'),
(57, '/', '2025-09-09 22:43:11', '2025-09-09 22:43:11'),
(58, '/', '2025-09-09 22:43:30', '2025-09-09 22:43:30'),
(59, '/', '2025-09-09 22:44:45', '2025-09-09 22:44:45'),
(60, '/', '2025-09-09 22:50:11', '2025-09-09 22:50:11'),
(61, '/', '2025-09-09 22:50:23', '2025-09-09 22:50:23'),
(62, '/', '2025-09-09 22:50:31', '2025-09-09 22:50:31'),
(63, '/', '2025-09-09 22:50:37', '2025-09-09 22:50:37'),
(64, '/', '2025-09-09 22:50:44', '2025-09-09 22:50:44'),
(65, '/', '2025-09-09 22:50:51', '2025-09-09 22:50:51'),
(66, '/', '2025-09-09 22:50:57', '2025-09-09 22:50:57'),
(67, '/', '2025-09-09 22:51:10', '2025-09-09 22:51:10'),
(68, '/', '2025-09-09 22:52:34', '2025-09-09 22:52:34'),
(69, '/', '2025-09-10 00:07:44', '2025-09-10 00:07:44'),
(70, '/', '2025-09-10 00:08:40', '2025-09-10 00:08:40'),
(71, '/', '2025-09-10 01:08:28', '2025-09-10 01:08:28'),
(72, '/', '2025-09-10 01:08:49', '2025-09-10 01:08:49'),
(73, '/', '2025-09-10 19:13:51', '2025-09-10 19:13:51'),
(74, '/', '2025-09-10 19:16:37', '2025-09-10 19:16:37'),
(75, '/', '2025-09-11 01:05:59', '2025-09-11 01:05:59'),
(76, '/', '2025-09-11 01:11:25', '2025-09-11 01:11:25'),
(77, '/', '2025-09-11 01:11:39', '2025-09-11 01:11:39'),
(78, '/', '2025-09-11 01:15:57', '2025-09-11 01:15:57'),
(79, '/', '2025-09-11 01:16:09', '2025-09-11 01:16:09'),
(80, '/', '2025-09-11 01:21:33', '2025-09-11 01:21:33'),
(81, '/', '2025-09-11 01:35:53', '2025-09-11 01:35:53'),
(82, '/', '2025-09-11 22:53:19', '2025-09-11 22:53:19'),
(83, '/', '2025-09-11 23:26:31', '2025-09-11 23:26:31'),
(84, '/', '2025-09-14 18:27:25', '2025-09-14 18:27:25'),
(85, '/', '2025-09-14 20:22:26', '2025-09-14 20:22:26'),
(86, '/', '2025-09-14 20:42:06', '2025-09-14 20:42:06'),
(87, '/', '2025-09-16 18:30:43', '2025-09-16 18:30:43'),
(88, '/', '2025-09-16 18:31:00', '2025-09-16 18:31:00'),
(89, '/', '2025-09-16 18:31:06', '2025-09-16 18:31:06'),
(90, '/', '2025-09-16 18:31:58', '2025-09-16 18:31:58'),
(91, '/', '2025-09-16 18:32:15', '2025-09-16 18:32:15'),
(92, '/', '2025-09-16 18:32:37', '2025-09-16 18:32:37'),
(93, '/', '2025-09-16 18:32:54', '2025-09-16 18:32:54'),
(94, '/', '2025-09-16 19:59:11', '2025-09-16 19:59:11'),
(95, '/', '2025-09-16 20:23:35', '2025-09-16 20:23:35'),
(96, '/', '2025-09-16 20:38:27', '2025-09-16 20:38:27'),
(97, '/', '2025-09-16 20:48:32', '2025-09-16 20:48:32'),
(98, '/', '2025-09-16 20:48:35', '2025-09-16 20:48:35'),
(99, '/', '2025-09-16 20:48:36', '2025-09-16 20:48:36'),
(100, '/', '2025-09-16 20:48:38', '2025-09-16 20:48:38'),
(101, '/', '2025-09-16 20:48:41', '2025-09-16 20:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` bigint UNSIGNED NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id`, `ip`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', '2025-09-07 21:06:03', '2025-09-07 21:06:03'),
(2, '127.0.0.1', '2025-09-07 21:06:09', '2025-09-07 21:06:09'),
(3, '127.0.0.1', '2025-09-07 21:06:19', '2025-09-07 21:06:19'),
(4, '127.0.0.1', '2025-09-07 21:06:35', '2025-09-07 21:06:35'),
(5, '127.0.0.1', '2025-09-07 21:14:51', '2025-09-07 21:14:51'),
(6, '127.0.0.1', '2025-09-07 21:15:46', '2025-09-07 21:15:46'),
(7, '127.0.0.1', '2025-09-07 21:23:31', '2025-09-07 21:23:31'),
(8, '127.0.0.1', '2025-09-07 21:26:06', '2025-09-07 21:26:06'),
(9, '127.0.0.1', '2025-09-07 21:28:17', '2025-09-07 21:28:17'),
(10, '127.0.0.1', '2025-09-07 21:31:33', '2025-09-07 21:31:33'),
(11, '127.0.0.1', '2025-09-07 21:34:18', '2025-09-07 21:34:18'),
(12, '127.0.0.1', '2025-09-07 21:36:44', '2025-09-07 21:36:44'),
(13, '127.0.0.1', '2025-09-07 21:36:58', '2025-09-07 21:36:58'),
(14, '127.0.0.1', '2025-09-07 21:37:13', '2025-09-07 21:37:13'),
(15, '127.0.0.1', '2025-09-07 21:40:06', '2025-09-07 21:40:06'),
(16, '127.0.0.1', '2025-09-07 21:43:10', '2025-09-07 21:43:10'),
(17, '127.0.0.1', '2025-09-07 21:43:26', '2025-09-07 21:43:26'),
(18, '127.0.0.1', '2025-09-07 22:43:16', '2025-09-07 22:43:16'),
(19, '127.0.0.1', '2025-09-07 22:43:22', '2025-09-07 22:43:22'),
(20, '127.0.0.1', '2025-09-07 22:43:29', '2025-09-07 22:43:29'),
(21, '127.0.0.1', '2025-09-07 22:43:31', '2025-09-07 22:43:31'),
(22, '127.0.0.1', '2025-09-07 22:44:48', '2025-09-07 22:44:48'),
(23, '127.0.0.1', '2025-09-07 22:44:56', '2025-09-07 22:44:56'),
(24, '127.0.0.1', '2025-09-07 22:46:03', '2025-09-07 22:46:03'),
(25, '127.0.0.1', '2025-09-07 22:47:12', '2025-09-07 22:47:12'),
(26, '127.0.0.1', '2025-09-07 22:47:45', '2025-09-07 22:47:45'),
(27, '127.0.0.1', '2025-09-07 22:49:18', '2025-09-07 22:49:18'),
(28, '127.0.0.1', '2025-09-07 22:52:27', '2025-09-07 22:52:27'),
(29, '127.0.0.1', '2025-09-07 22:52:31', '2025-09-07 22:52:31'),
(30, '127.0.0.1', '2025-09-07 22:52:50', '2025-09-07 22:52:50'),
(31, '127.0.0.1', '2025-09-07 23:10:51', '2025-09-07 23:10:51'),
(32, '127.0.0.1', '2025-09-07 23:12:53', '2025-09-07 23:12:53'),
(33, '127.0.0.1', '2025-09-07 23:45:09', '2025-09-07 23:45:09'),
(34, '127.0.0.1', '2025-09-07 23:45:20', '2025-09-07 23:45:20'),
(35, '127.0.0.1', '2025-09-07 23:45:22', '2025-09-07 23:45:22'),
(36, '127.0.0.1', '2025-09-07 23:45:46', '2025-09-07 23:45:46'),
(37, '127.0.0.1', '2025-09-08 00:06:11', '2025-09-08 00:06:11'),
(38, '127.0.0.1', '2025-09-08 17:18:26', '2025-09-08 17:18:26'),
(39, '127.0.0.1', '2025-09-08 17:22:57', '2025-09-08 17:22:57'),
(40, '127.0.0.1', '2025-09-08 17:32:13', '2025-09-08 17:32:13'),
(41, '127.0.0.1', '2025-09-08 19:21:52', '2025-09-08 19:21:52'),
(42, '127.0.0.1', '2025-09-08 19:22:01', '2025-09-08 19:22:01'),
(43, '127.0.0.1', '2025-09-08 19:22:29', '2025-09-08 19:22:29'),
(44, '127.0.0.1', '2025-09-08 19:26:32', '2025-09-08 19:26:32'),
(45, '127.0.0.1', '2025-09-08 19:27:08', '2025-09-08 19:27:08'),
(46, '127.0.0.1', '2025-09-08 19:28:15', '2025-09-08 19:28:15'),
(47, '127.0.0.1', '2025-09-08 22:30:48', '2025-09-08 22:30:48'),
(48, '127.0.0.1', '2025-09-08 22:40:40', '2025-09-08 22:40:40'),
(49, '127.0.0.1', '2025-09-08 22:40:58', '2025-09-08 22:40:58'),
(50, '127.0.0.1', '2025-09-08 22:42:13', '2025-09-08 22:42:13'),
(51, '127.0.0.1', '2025-09-08 22:57:51', '2025-09-08 22:57:51'),
(52, '127.0.0.1', '2025-09-08 22:59:06', '2025-09-08 22:59:06'),
(53, '127.0.0.1', '2025-09-08 23:28:41', '2025-09-08 23:28:41'),
(54, '127.0.0.1', '2025-09-09 19:13:09', '2025-09-09 19:13:09'),
(55, '127.0.0.1', '2025-09-09 22:07:20', '2025-09-09 22:07:20'),
(56, '127.0.0.1', '2025-09-09 22:09:01', '2025-09-09 22:09:01'),
(57, '127.0.0.1', '2025-09-09 22:43:11', '2025-09-09 22:43:11'),
(58, '127.0.0.1', '2025-09-09 22:43:30', '2025-09-09 22:43:30'),
(59, '127.0.0.1', '2025-09-09 22:44:45', '2025-09-09 22:44:45'),
(60, '127.0.0.1', '2025-09-09 22:50:11', '2025-09-09 22:50:11'),
(61, '127.0.0.1', '2025-09-09 22:50:23', '2025-09-09 22:50:23'),
(62, '127.0.0.1', '2025-09-09 22:50:31', '2025-09-09 22:50:31'),
(63, '127.0.0.1', '2025-09-09 22:50:37', '2025-09-09 22:50:37'),
(64, '127.0.0.1', '2025-09-09 22:50:44', '2025-09-09 22:50:44'),
(65, '127.0.0.1', '2025-09-09 22:50:51', '2025-09-09 22:50:51'),
(66, '127.0.0.1', '2025-09-09 22:50:57', '2025-09-09 22:50:57'),
(67, '127.0.0.1', '2025-09-09 22:51:10', '2025-09-09 22:51:10'),
(68, '127.0.0.1', '2025-09-09 22:52:34', '2025-09-09 22:52:34'),
(69, '127.0.0.1', '2025-09-10 00:07:44', '2025-09-10 00:07:44'),
(70, '127.0.0.1', '2025-09-10 00:08:40', '2025-09-10 00:08:40'),
(71, '127.0.0.1', '2025-09-10 01:08:28', '2025-09-10 01:08:28'),
(72, '127.0.0.1', '2025-09-10 01:08:49', '2025-09-10 01:08:49'),
(73, '127.0.0.1', '2025-09-10 19:13:50', '2025-09-10 19:13:50'),
(74, '127.0.0.1', '2025-09-10 19:16:37', '2025-09-10 19:16:37'),
(75, '127.0.0.1', '2025-09-11 01:05:59', '2025-09-11 01:05:59'),
(76, '127.0.0.1', '2025-09-11 01:11:25', '2025-09-11 01:11:25'),
(77, '127.0.0.1', '2025-09-11 01:11:39', '2025-09-11 01:11:39'),
(78, '127.0.0.1', '2025-09-11 01:15:57', '2025-09-11 01:15:57'),
(79, '127.0.0.1', '2025-09-11 01:16:09', '2025-09-11 01:16:09'),
(80, '127.0.0.1', '2025-09-11 01:21:33', '2025-09-11 01:21:33'),
(81, '128.1.86.228', '2025-09-11 01:35:53', '2025-09-11 01:35:53'),
(82, '127.0.0.1', '2025-09-11 22:53:19', '2025-09-11 22:53:19'),
(83, '127.0.0.1', '2025-09-11 23:26:31', '2025-09-11 23:26:31'),
(84, '127.0.0.1', '2025-09-14 18:27:25', '2025-09-14 18:27:25'),
(85, '127.0.0.1', '2025-09-14 20:22:26', '2025-09-14 20:22:26'),
(86, '127.0.0.1', '2025-09-14 20:42:06', '2025-09-14 20:42:06'),
(87, '127.0.0.1', '2025-09-16 18:30:43', '2025-09-16 18:30:43'),
(88, '127.0.0.1', '2025-09-16 18:31:00', '2025-09-16 18:31:00'),
(89, '127.0.0.1', '2025-09-16 18:31:06', '2025-09-16 18:31:06'),
(90, '127.0.0.1', '2025-09-16 18:31:58', '2025-09-16 18:31:58'),
(91, '127.0.0.1', '2025-09-16 18:32:15', '2025-09-16 18:32:15'),
(92, '127.0.0.1', '2025-09-16 18:32:37', '2025-09-16 18:32:37'),
(93, '127.0.0.1', '2025-09-16 18:32:54', '2025-09-16 18:32:54'),
(94, '127.0.0.1', '2025-09-16 19:59:11', '2025-09-16 19:59:11'),
(95, '127.0.0.1', '2025-09-16 20:23:35', '2025-09-16 20:23:35'),
(96, '127.0.0.1', '2025-09-16 20:38:27', '2025-09-16 20:38:27'),
(97, '127.0.0.1', '2025-09-16 20:48:32', '2025-09-16 20:48:32'),
(98, '127.0.0.1', '2025-09-16 20:48:35', '2025-09-16 20:48:35'),
(99, '127.0.0.1', '2025-09-16 20:48:36', '2025-09-16 20:48:36'),
(100, '127.0.0.1', '2025-09-16 20:48:38', '2025-09-16 20:48:38'),
(101, '127.0.0.1', '2025-09-16 20:48:41', '2025-09-16 20:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text,
  `description_files` json DEFAULT NULL,
  `description_photos` json DEFAULT NULL,
  `description_photos_text` text,
  `kompetensi_dasar` text,
  `kompetensi_dasar_files` json DEFAULT NULL,
  `kompetensi_dasar_photos` json DEFAULT NULL,
  `kompetensi_dasar_photos_text` text,
  `tujuan_pembelajaran` text,
  `tujuan_pembelajaran_files` json DEFAULT NULL,
  `tujuan_pembelajaran_photos` json DEFAULT NULL,
  `tujuan_pembelajaran_photos_text` text,
  `kurikulum_sinkronisasi` text,
  `kurikulum_sinkronisasi_files` json DEFAULT NULL,
  `kurikulum_sinkronisasi_photos` json DEFAULT NULL,
  `kurikulum_sinkronisasi_photos_text` text,
  `program_unggulan` text,
  `program_unggulan_files` json DEFAULT NULL,
  `program_unggulan_photos` json DEFAULT NULL,
  `program_unggulan_photos_text` text,
  `tim_pengajar` text,
  `tim_pengajar_files` json DEFAULT NULL,
  `tim_pengajar_photos` json DEFAULT NULL,
  `tim_pengajar_photos_text` text,
  `galeri_kegiatan` text,
  `galeri_kegiatan_files` json DEFAULT NULL,
  `galeri_kegiatan_photos` json DEFAULT NULL,
  `galeri_kegiatan_photos_text` text,
  `kundudi` text,
  `kundudi_files` json DEFAULT NULL,
  `kundudi_photos` json DEFAULT NULL,
  `kundudi_photos_text` text,
  `industri_pasangan` text,
  `industri_pasangan_files` json DEFAULT NULL,
  `industri_pasangan_photos` json DEFAULT NULL,
  `industri_pasangan_photos_text` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `jurusan_id`, `user_id`, `title`, `description`, `description_files`, `description_photos`, `description_photos_text`, `kompetensi_dasar`, `kompetensi_dasar_files`, `kompetensi_dasar_photos`, `kompetensi_dasar_photos_text`, `tujuan_pembelajaran`, `tujuan_pembelajaran_files`, `tujuan_pembelajaran_photos`, `tujuan_pembelajaran_photos_text`, `kurikulum_sinkronisasi`, `kurikulum_sinkronisasi_files`, `kurikulum_sinkronisasi_photos`, `kurikulum_sinkronisasi_photos_text`, `program_unggulan`, `program_unggulan_files`, `program_unggulan_photos`, `program_unggulan_photos_text`, `tim_pengajar`, `tim_pengajar_files`, `tim_pengajar_photos`, `tim_pengajar_photos_text`, `galeri_kegiatan`, `galeri_kegiatan_files`, `galeri_kegiatan_photos`, `galeri_kegiatan_photos_text`, `kundudi`, `kundudi_files`, `kundudi_photos`, `kundudi_photos_text`, `industri_pasangan`, `industri_pasangan_files`, `industri_pasangan_photos`, `industri_pasangan_photos_text`, `image`, `created_at`, `updated_at`) VALUES
(29, 12, 2, NULL, '<p>Akuntansi adalah ilmu proses mencatat dan merangkum informasi finansial yang berkaitan dengan semua transaksi dan kejadian di perusahaan atau organisasi, serta menyajikan informasi tersebut untuk dipahami oleh penggunanya, baik pihak internal maupun pihak eksternal.</p><p>Kompetensi Keahlian Akuntansi dan Keuangan Lembaga di SMK Negeri 1 Subang menyiapkan lulusan berkualitas dan kompetitif dalam bidang pembukuan/administrasi keuangan dan akuntansi dengan berbagai keterampilan dan kompetensi dalam bidang akuntansi dan keuangan di berbagai perusahaan/instansi baik perusahaan jasa, dagang, manufaktur maupun lembaga/instansi pemerintah.</p>', NULL, NULL, NULL, '<ul><li>Etika Profesi</li><li>Aplikasi Pengolah Angka / Spreadsheet</li><li>Akuntansi Dasar</li><li>Perbankan Dasar</li><li>Praktikum Akuntansi Perusahaan Jasa, Dagang, dan Manufaktur</li><li>Praktikum Akuntansi Lembaga / Instansi Pemerintah</li><li>Akuntansi Keuangan</li><li>Komputer Akuntansi</li><li>Administrasi Pajak</li><li>Produk Kreatif dan Kewirausahaan</li></ul><p><br /></p>', NULL, '[\"uploads/1755830368_x3hwzDsLoU.jpeg\"]', NULL, '<p>Tujuan Kompetensi Keahlian Akuntansi dan Keuangan Lembaga secara umum mengacu pada isi Undang-Undang Sistem Pendidikan Nasional (UU SPN) pasal 3 mengenai Tujuan Pendidikan Nasional dan penjelasan pasal 15 yang menyebutkan bahwa pendidikan kejuruan merupakan pendidikan menengah yang mempersiapkan peserta didik terutama untuk bekerja dalam bidang tertentu.</p><p>Secara khusus tujuan Kompetensi Keahlian Akuntansi dan Keuangan Lembaga adalah membekali peserta didik dengan keterampilan, pengetahuan dan sikap agar kompeten dalam:</p><ol><li>Bekerja baik secara mandiri atau mengisi lowongan pekerjaan yang ada di dunia usaha dan dunia industri sebagai tenaga kerja tingkat menengah dalam bidang Akuntansi dan Keuangan Lembaga;</li><li>Memilih karir, berkompetensi, dan mengembangkan sikap profesional dalam bidang Akuntansi dan Keuangan Lembaga;</li><li>Memiliki kompetensi sesuai jenjang dalam bidang Akuntansi dan Keuangan Lembaga.</li></ol><p><br /></p>', NULL, NULL, NULL, '<p>Kompetensi Keahlian Akuntansi Keuangan Lembaga, telah melaksanakan sinkronisasi kurikulum dengan:</p><ol><li>PT. Bank Perkreditan Rakyat Karya Utama Jabar</li><li>Kantor Akuntan Publik Bambang Moedjiono &amp; Rekan, Jakarta</li></ol><p>Berikut ini <strong><em>dokumen penyelarasan kurikulum</em></strong>, di dalamnya memuat kompetensi dasar yang telah disesuaikan dengan kebutuhan Dunia Usaha.</p><p><br /></p>', '[{\"path\": \"uploads/1756107783_D4XKfdjKrr.xlsx\", \"size\": 8091, \"filename\": \"1755833814_FgcNsb0Xvj.xlsx\", \"mime_type\": \"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet\"}]', NULL, NULL, '<p>Dalam upaya mewujudkan salah satu misi SMK Negeri 1 Subang yaitu menyiapkan lulusan yang berjiwa wirausaha (mampu membaca peluang, pantang menyerah, berani, ulet dan bekerja keras), sekolah membuat program yang terintegrasi dalam model CEREN yaitu Entrepreneruship (E) diantara programnya adalah program unit produksi pada masing-masing kompetensi keahlian.</p><p>Sejalan dengan misi SMK Negeri 1 Subang tersebut, maka Program Keahlian Akuntansi dan Keuangan menyusun program kerja terkait Unit Produksi yang akan dilaksanakan oleh Program Keahlian Akuntansi dan Keuangan antara lain:</p><ol><li>Bank Mini dan PPOB dengan nama “Bank Mini Nesas”</li></ol><p>Program yang akan berjalan pada Januari 2022 adalah Tabungan Siswa dengan nama program <strong>“TaWa NeSas Ku”</strong> (Tabungan Siswa SMK Negeri 1 Subang bekerja sama dengan BPR KU) yang akan dihimpun oleh Bank Mini SMK Negeri 1 Subang bekerja sama dengan PT. BPR Karya Utama Jabar.</p><p><br /></p>', NULL, '[\"uploads/1755841283_fOo9exLpYP.jpeg\"]', NULL, '<p><span style=\"color:rgb(107,107,107);\">Berikut ini kami perkenalkan guru-guru pengajar Mapel Produktif Kompetensi Keahlian Akuntansi dan Keuangan Lembaga SMK Negeri 1 Subang Tahun Pelajaran 2021/2022:</span></p><ol><li>Siti Maryam, S.Pd.</li><li>Pepen Apendi, S.Pd., M.P<span style=\"color:rgb(255,255,255);\">d.I</span></li><li>Ismiyanti, S.Pd.</li><li>Dani Nur Muhamad, S.E.</li><li>Rikawati, S.Mn.</li><li>Tina Mulayyinatun Nisa, S.Pd.</li><li>Iis Ismawati, S.Pd.</li><li>Putri Maulida Hutami, S.Pd.</li></ol><p><br /></p>', NULL, '[\"uploads/1756085483_oykm7qz7NM.jpeg\", \"uploads/1756085483_vUmPdjDFu6.jpeg\", \"uploads/1756085483_FGEaAO6QeA.jpeg\", \"uploads/1756085483_cMBj3uIEqH.jpeg\", \"uploads/1756085483_LW7IkvgMt8.jpeg\", \"uploads/1756085483_KXmEvlOcnm.jpeg\", \"uploads/1756085483_O2kwif3OvJ.jpeg\", \"uploads/1756085483_XQNAdjome9.jpeg\"]', '<p><span style=\"color: rgb(107, 107, 107);\">Pada Tahun Pelajaran 2021/2022 sebagai Kepala Program Keahlian Akuntansi dan Keuangan adalah Ibu Rikawati, S.Mn. dan sebagai Sekretasis Program Keahlian Akuntansi dan Keuangan adalah Ibu Ela Nurlela, S.Pd.</span></p>', '<p><strong>Penyelarasan (Sinkronisasi) Kurikulum</strong></p><p>Untuk menyempurnakan pengembangan kurikulum yang selaras antara dunia pendidikan dan dunia industri, Kompetensi Keahlian Akuntansi dan Keuangan Lembaga (AKL) SMK Negeri 1 Subang telah menggandeng <strong><em>PT. BPR Karya Utama Jabar</em></strong> dan <strong><em>Kantor Akuntan Publik Bambang Moedjiono dan Rekan</em></strong> sebagai rekanan industrinya. Melalui sinkronisasi, sekolah dalam hal ini Kompetensi Keahlian AKL melakukan penyelarasan dengan merumuskan kurikulum bersama yang dituangkan dalam bentuk Sinkronisasi Kurikulum Tingkat Satuan Pendidikan, serta mengikuti cara kerja atau materi dari industri tersebut. Dilakukan analisis kompetensi dasar-kompetensi dasar yang ada dalam mata pelajaran kejuruan baik C1, C2 maupun C3 yang relevan dengan pekerjaan yang dilakukan. Analisis KD seluruh Mata Pelajaran dilakukan oleh musyawarah guru mata pelajaran berdasarkan urutan logis, penentuan indikator, pengaturan alokasi waktu dan penambahan atau pengurangan Kompetensi Dasar apabila diperlukan. Penyesuaian silabus dilakukan dengan tetap memperhatikan karakter mata pelajaran masing-masing seperti tujuan mata pelajaran dan materi prasyarat.</p>', NULL, NULL, NULL, '<p><span style=\"color:rgb(107,107,107);\">Berikut ini adalah dokumentasi kegiatan KUNDUDI Kompetensi Keahlian Akuntansi dan Keuangan Lembaga pada </span><strong><em>Maret 2019 ke Kantor Otoritas Jasa Keuangan (OJK) Kantor Regional Jawa Barat</em></strong><span style=\"color:rgb(107,107,107);\"> dan </span><strong><em>pada Januari 2020 ke Bank Indonesia (Pusat, Jakarta)</em></strong><span style=\"color:rgb(107,107,107);\">. Semoga pandemi segera berakhir, agar kegiatan KUNDUDI dapat segera dilaksanakan kembali.</span></p>', NULL, '[\"uploads/1756088998_z8IIqDNpGZ.jpeg\", \"uploads/1756088998_pcvGMwjex3.jpeg\", \"uploads/1756088998_jn5EubCPw6.jpeg\"]', NULL, '<p><span style=\"color:rgb(107,107,107);\">Berikut ini adalah IDUKA (Instansi, Dunia Usaha dan Dunia Kerja) yang telah bekerja sama dengan Kompetensi Keahlian Akuntansi dan Keuangan Lembaga, antara lain:</span></p>', NULL, '[\"uploads/1756088782_NBBphaNZly.png\"]', NULL, NULL, '2025-08-21 19:16:05', '2025-08-26 20:57:24'),
(41, 14, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 20:57:33', '2025-08-26 20:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(3, 'Data Pokok Sekolah', 'data-pokok-sekolah', '2025-08-24 23:57:07', '2025-08-25 00:04:26'),
(4, 'visi dan misi', 'visi-dan-misi', '2025-08-25 00:31:47', '2025-08-25 00:31:47'),
(5, 'Struktur Organisasi', 'struktur-organisasi', '2025-08-25 19:04:32', '2025-08-25 19:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `profile_menus`
--

CREATE TABLE `profile_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sarans`
--

CREATE TABLE `sarans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `saran` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sarans`
--

INSERT INTO `sarans` (`id`, `nama`, `email`, `saran`, `created_at`, `updated_at`) VALUES
(4, 'aaa', 'aaa@gmail.com', 'aaaa', '2025-09-07 19:06:37', '2025-09-07 19:06:37'),
(5, 'aa', 'aa@gmail.com', 'aaa', '2025-09-07 19:11:43', '2025-09-07 19:11:43'),
(6, 'zzz', 'admin1@gmail.com', 'zzz', '2025-09-07 19:25:31', '2025-09-07 19:25:31'),
(7, 'mil', 'mil@example.com', 'mil', '2025-09-07 22:49:18', '2025-09-07 22:49:18'),
(8, 'AAAAAAAAA', 'admin1@gmail.com', 'AAAA', '2025-09-09 22:50:23', '2025-09-09 22:50:23'),
(9, 'aaa', 'kasir@gmail.com', 'AAAA', '2025-09-09 22:50:30', '2025-09-09 22:50:30'),
(10, 'AAAA', 'aa@gmail.com', 'AAAAA', '2025-09-09 22:50:37', '2025-09-09 22:50:37'),
(11, 'AAAA', 'aaaaaa@gmail.com', 'AAAA', '2025-09-09 22:50:44', '2025-09-09 22:50:44'),
(12, 'AAA', 'admin1@gmail.com', 'AAAA', '2025-09-09 22:50:51', '2025-09-09 22:50:51'),
(13, 'AAA', 'aaa@gmail.com', 'AAA', '2025-09-09 22:50:56', '2025-09-09 22:50:56'),
(14, 'zzz', 'zydan@gmail.com', 'ZZZZ', '2025-09-09 22:51:09', '2025-09-09 22:51:09'),
(15, 'zydan', 'zydan@gmail.com', '✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter? dddddddddddddddddddddddddddddddddddddddddddddddddddddddd✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?d✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?d✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?✨ Perubahan penting biar lebih ramah pengguna:\r\n\r\nDeskripsi singkat → supaya admin tahu fungsi halaman.\r\n\r\nLabel form filter → lebih jelas daripada cuma input kosong.\r\n\r\nEmoji + warna tombol → memudahkan membedakan tombol.\r\n\r\nInfo jumlah data → admin tahu data yang sedang tampil.\r\n\r\nHover row di tabel → lebih enak baca dan ikuti baris.\r\n\r\nMau saya tambahkan juga export PDF/Excel langsung di atas tabel supaya admin bisa unduh hasil filter?Placeholder lebih spesifik.', '2025-09-10 00:08:39', '2025-09-10 00:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('q5pjk3CiKm6tcml2YwhuKRsNchR9CH5iezOOilwO', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVnNhNlh6MVdlRXRwYUxzbmxnY1ZTeXIxMHc0STJmMGhFSXd5clNlQSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIzOiJodHRwOi8vZXhhbXBsZS1hcHAudGVzdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1758080921),
('qJmsx2RkOWcqqNZ0wlFd4twExdWfarYRwCLvS8a8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjExSWZxblROZDMxNkpJZzFmU1J4bHdxa2E5OGVzemFRZXJsSXVLSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9leGFtcGxlLWFwcC50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1757907726);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ajmil', 'ajmil@gmail.com', NULL, '$2y$12$VpbnCH8/zGaoztJ3n.kjW.q.PE0FUsqqgDB.T38zMwv41KbQzW.wi', 'admin', 'd8qgqfk22ZaUUbqP4I7KuugorRgNI5pN3SUEQ4fmtvf3ZIMeOM4tjR4wJdTn', '2025-08-06 19:29:36', '2025-08-06 19:29:36'),
(2, 'admin1', 'admin1@gmail.com', NULL, '$2y$12$A7mET4/CkrCutk7aJPgj9emWj9H5MFQCKbUIYVyS.7MBX44fnYoNO', 'admin', 'CAC9RGFmBrKG609rf43qKjA45F5R6Y6xAa9DrjfShyo0wF1jYUGfuUkgOexO', '2025-08-07 20:14:04', '2025-08-07 20:14:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `galeris_judul_unique` (`judul`),
  ADD UNIQUE KEY `galeris_slug_unique` (`slug`);

--
-- Indexes for table `galeri_blocks`
--
ALTER TABLE `galeri_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_blocks_galeri_id_foreign` (`galeri_id`);

--
-- Indexes for table `ikms`
--
ALTER TABLE `ikms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ikms_title_unique` (`title`),
  ADD UNIQUE KEY `ikms_slug_unique` (`slug`);

--
-- Indexes for table `ikm_konten`
--
ALTER TABLE `ikm_konten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ikm_konten_ikm_id_foreign` (`ikm_id`);

--
-- Indexes for table `ikm_konten_blocks`
--
ALTER TABLE `ikm_konten_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ikm_konten_blocks_ikm_konten_id_foreign` (`ikm_konten_id`);

--
-- Indexes for table `informasi_terbaru`
--
ALTER TABLE `informasi_terbaru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `informasi_terbaru_slug_unique` (`slug`),
  ADD KEY `informasi_terbaru_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `informasi_terbaru_gambar`
--
ALTER TABLE `informasi_terbaru_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informasi_terbaru_gambar_informasi_id_foreign` (`informasi_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusans_name_unique` (`name`),
  ADD UNIQUE KEY `jurusans_slug_unique` (`slug`);

--
-- Indexes for table `kategori_informasi`
--
ALTER TABLE `kategori_informasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_informasi_slug_unique` (`slug`);

--
-- Indexes for table `kelulusans`
--
ALTER TABLE `kelulusans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelulusans_judul_unique` (`judul`),
  ADD UNIQUE KEY `kelulusans_slug_unique` (`slug`);

--
-- Indexes for table `kelulusan_blocks`
--
ALTER TABLE `kelulusan_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelulusan_blocks_kelulusan_id_foreign` (`kelulusan_id`);

--
-- Indexes for table `lainnya`
--
ALTER TABLE `lainnya`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lainnya_title_unique` (`title`),
  ADD UNIQUE KEY `lainnya_slug_unique` (`slug`);

--
-- Indexes for table `lainnya_konten`
--
ALTER TABLE `lainnya_konten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lainnya_konten_lainnya_id_foreign` (`lainnya_id`);

--
-- Indexes for table `lainnya_konten_blocks`
--
ALTER TABLE `lainnya_konten_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lainnya_konten_blocks_lainnya_konten_id_foreign` (`lainnya_konten_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_slug_unique` (`slug`);

--
-- Indexes for table `profile_menus`
--
ALTER TABLE `profile_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_menus_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `sarans`
--
ALTER TABLE `sarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `galeri_blocks`
--
ALTER TABLE `galeri_blocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ikms`
--
ALTER TABLE `ikms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ikm_konten`
--
ALTER TABLE `ikm_konten`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ikm_konten_blocks`
--
ALTER TABLE `ikm_konten_blocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `informasi_terbaru`
--
ALTER TABLE `informasi_terbaru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `informasi_terbaru_gambar`
--
ALTER TABLE `informasi_terbaru_gambar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategori_informasi`
--
ALTER TABLE `kategori_informasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelulusans`
--
ALTER TABLE `kelulusans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelulusan_blocks`
--
ALTER TABLE `kelulusan_blocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lainnya`
--
ALTER TABLE `lainnya`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lainnya_konten`
--
ALTER TABLE `lainnya_konten`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lainnya_konten_blocks`
--
ALTER TABLE `lainnya_konten_blocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile_menus`
--
ALTER TABLE `profile_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sarans`
--
ALTER TABLE `sarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galeri_blocks`
--
ALTER TABLE `galeri_blocks`
  ADD CONSTRAINT `galeri_blocks_galeri_id_foreign` FOREIGN KEY (`galeri_id`) REFERENCES `galeris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ikm_konten`
--
ALTER TABLE `ikm_konten`
  ADD CONSTRAINT `ikm_konten_ikm_id_foreign` FOREIGN KEY (`ikm_id`) REFERENCES `ikms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ikm_konten_blocks`
--
ALTER TABLE `ikm_konten_blocks`
  ADD CONSTRAINT `ikm_konten_blocks_ikm_konten_id_foreign` FOREIGN KEY (`ikm_konten_id`) REFERENCES `ikm_konten` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `informasi_terbaru`
--
ALTER TABLE `informasi_terbaru`
  ADD CONSTRAINT `informasi_terbaru_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_informasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `informasi_terbaru_gambar`
--
ALTER TABLE `informasi_terbaru_gambar`
  ADD CONSTRAINT `informasi_terbaru_gambar_informasi_id_foreign` FOREIGN KEY (`informasi_id`) REFERENCES `informasi_terbaru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelulusan_blocks`
--
ALTER TABLE `kelulusan_blocks`
  ADD CONSTRAINT `kelulusan_blocks_kelulusan_id_foreign` FOREIGN KEY (`kelulusan_id`) REFERENCES `kelulusans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lainnya_konten`
--
ALTER TABLE `lainnya_konten`
  ADD CONSTRAINT `lainnya_konten_lainnya_id_foreign` FOREIGN KEY (`lainnya_id`) REFERENCES `lainnya` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lainnya_konten_blocks`
--
ALTER TABLE `lainnya_konten_blocks`
  ADD CONSTRAINT `lainnya_konten_blocks_lainnya_konten_id_foreign` FOREIGN KEY (`lainnya_konten_id`) REFERENCES `lainnya_konten` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profile_menus`
--
ALTER TABLE `profile_menus`
  ADD CONSTRAINT `profile_menus_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
