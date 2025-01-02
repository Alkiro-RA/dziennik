-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 02, 2025 at 07:45 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dziennik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade`, `comment`, `user_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, '6', 'testcomment01', 9, 1, '2025-01-02 17:15:03', '2025-01-02 17:15:03'),
(2, '6', 'testcomment01', 9, 2, '2025-01-02 17:15:10', '2025-01-02 17:15:10'),
(3, '5', 'testcomment02', 9, 2, '2025-01-02 17:15:25', '2025-01-02 16:19:33'),
(4, '3', 'testcomment03', 9, 2, '2025-01-02 16:19:23', '2025-01-02 16:19:23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'group01', '2025-01-02 17:07:00', '2025-01-02 17:07:00'),
(2, 'group02', '2025-01-02 17:07:05', '2025-01-02 17:07:05'),
(3, 'group03', '2025-01-02 17:07:09', '2025-01-02 17:07:09');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_12_20_222616_create_groups_table', 1),
(2, '2024_12_20_222617_create_users_table', 1),
(3, '2024_12_20_222901_create_sessions_table', 1),
(4, '2024_12_21_005744_create_subjects_table', 1),
(5, '2024_12_21_010045_create_teacher_subject_table', 1),
(6, '2024_12_21_023137_create_subject_group_table', 1),
(7, '2024_12_21_050413_create_grades_table', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CS6dzOYei2Jopuu6UbTIu2iZpraW0GADX5ZRCr4I', 11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWkt6ZDVUY1h0bENvOGhPQ0FYcGNoNG9vSm1BQVVJaU9ybmNlZnVEOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3QvZHppZW5uaWsvcHVibGljL2FkbWluIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1735843166);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'przedmiot01', '2025-01-02 17:06:21', '2025-01-02 17:06:21'),
(2, 'przedmiot02', '2025-01-02 17:06:26', '2025-01-02 17:06:26'),
(3, 'przedmiot03', '2025-01-02 17:06:31', '2025-01-02 17:06:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subject_group`
--

CREATE TABLE `subject_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_group`
--

INSERT INTO `subject_group` (`id`, `subject_id`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-01-02 17:09:19', '2025-01-02 17:09:19'),
(2, 2, 1, '2025-01-02 17:09:29', '2025-01-02 17:09:29'),
(3, 3, 1, '2025-01-02 17:09:33', '2025-01-02 17:09:33'),
(4, 1, 2, '2025-01-02 17:09:55', '2025-01-02 17:09:55'),
(5, 2, 2, '2025-01-02 17:10:00', '2025-01-02 17:10:00'),
(6, 2, 3, '2025-01-02 17:10:11', '2025-01-02 17:10:11'),
(7, 3, 3, '2025-01-02 17:10:19', '2025-01-02 17:10:19');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`id`, `user_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(4, 8, 3, '2025-01-02 17:12:28', '2025-01-02 17:12:28');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `group_id`, `created_at`, `updated_at`) VALUES
(8, 'nauczyciel02', 'nauczyciel02@test.pl', '$2y$12$PIZu/el.b93XMahIjAWuJOQJPKNnhxWxIqH5LIPnZTZWXpnNGGLh.', 'nauczyciel', NULL, '2025-01-02 16:03:07', '2025-01-02 16:03:07'),
(9, 'uczen01', 'uczen01@test.pl', '$2y$12$I9kyWQIW8lxkK23FLmqFOeVHgwMFt6oV9pexZO9FvBE2UtPCYx4Qa', 'uczen', 1, '2025-01-02 16:03:32', '2025-01-02 16:03:32'),
(10, 'uczen02', 'uczen02@test.pl', '$2y$12$lbPArar0cES15/jdkHrhE.BEgGkDNqFY5CvEvpGICR5/ErK96W3bS', 'uczen', 1, '2025-01-02 16:04:10', '2025-01-02 16:04:10'),
(11, 'admin01', 'admin01@test.pl', '$2y$12$JuAlClULjwcoHLvexLaVrObGlr1tr7VqulWKR7L0GKN6Iyz6sNbTG', 'admin', NULL, '2025-01-02 16:04:32', '2025-01-02 16:04:32'),
(12, 'nauczyciel01', 'nauczyciel01@test.pl', '$2y$12$PQQ6MRUt/3PMm8yw9nnZ/eLw4ezmWSkkEIkJR31PjCMf1MtzTaTEi', 'nauczyciel', NULL, '2025-01-02 17:12:53', '2025-01-02 17:12:53'),
(13, 'uczen03', 'uczen03@test.pl', '$2y$12$p.4jkdW.OM8yzVnvUhHA3OKMQQ3nnz/FOwyM04Dy0NO8LL64dCSb6', 'uczen', NULL, '2025-01-02 17:39:04', '2025-01-02 17:39:04'),
(14, 'admin02', 'admin02@test.pl', '$2y$12$8Xv.1vVKMZNot7/eclBNu.9knLvKfOT/dVXfYHkmys74zYKfMiUlG', 'admin', NULL, '2025-01-02 17:39:26', '2025-01-02 17:39:26');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_user_id_foreign` (`user_id`),
  ADD KEY `grades_subject_id_foreign` (`subject_id`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeksy dla tabeli `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjects_name_unique` (`name`);

--
-- Indeksy dla tabeli `subject_group`
--
ALTER TABLE `subject_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_group_group_id_subject_id_unique` (`group_id`,`subject_id`),
  ADD KEY `subject_group_subject_id_foreign` (`subject_id`);

--
-- Indeksy dla tabeli `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_subject_user_id_subject_id_unique` (`user_id`,`subject_id`),
  ADD KEY `teacher_subject_subject_id_foreign` (`subject_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_group`
--
ALTER TABLE `subject_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_group`
--
ALTER TABLE `subject_group`
  ADD CONSTRAINT `subject_group_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_group_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_subject_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
