-- Użyj istniejącej bazy danych
USE dziennik;

-- Tworzenie tabel, jeśli nie istnieją
CREATE TABLE IF NOT EXISTS `grades` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `grade` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grades_user_id_foreign` (`user_id`),
  KEY `grades_subject_id_foreign` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `subject_group` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject_group_group_id_subject_id_unique` (`group_id`,`subject_id`),
  FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `teacher_subject` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teacher_subject_user_id_subject_id_unique` (`user_id`,`subject_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Wstawianie danych tylko jeśli nie istnieją
INSERT IGNORE INTO `grades` (`id`, `grade`, `comment`, `user_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, '6', 'testcomment01', 9, 1, '2025-01-02 17:15:03', '2025-01-02 17:15:03'),
(2, '6', 'testcomment01', 9, 2, '2025-01-02 17:15:10', '2025-01-02 17:15:10'),
(3, '5', 'testcomment02', 9, 2, '2025-01-02 17:15:25', '2025-01-02 16:19:33'),
(4, '3', 'testcomment03', 9, 2, '2025-01-02 16:19:23', '2025-01-02 16:19:23');

INSERT IGNORE INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'group01', '2025-01-02 17:07:00', '2025-01-02 17:07:00'),
(2, 'group02', '2025-01-02 17:07:05', '2025-01-02 17:07:05'),
(3, 'group03', '2025-01-02 17:07:09', '2025-01-02 17:07:09');

INSERT IGNORE INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'przedmiot01', '2025-01-02 17:06:21', '2025-01-02 17:06:21'),
(2, 'przedmiot02', '2025-01-02 17:06:26', '2025-01-02 17:06:26'),
(3, 'przedmiot03', '2025-01-02 17:06:31', '2025-01-02 17:06:31');

INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `role`, `group_id`, `created_at`, `updated_at`) VALUES
(8, 'nauczyciel02', 'nauczyciel02@test.pl', '$2y$12$PIZu/el.b93XMahIjAWuJOQJPKNnhxWxIqH5LIPnZTZWXpnNGGLh.', 'nauczyciel', NULL, '2025-01-02 16:03:07', '2025-01-02 16:03:07'),
(9, 'uczen01', 'uczen01@test.pl', '$2y$12$I9kyWQIW8lxkK23FLmqFOeVHgwMFt6oV9pexZO9FvBE2UtPCYx4Qa', 'uczen', 1, '2025-01-02 16:03:32', '2025-01-02 16:03:32'),
(10, 'uczen02', 'uczen02@test.pl', '$2y$12$lbPArar0cES15/jdkHrhE.BEgGkDNqFY5CvEvpGICR5/ErK96W3bS', 'uczen', 1, '2025-01-02 16:04:10', '2025-01-02 16:04:10'),
(11, 'admin01', 'admin01@test.pl', '$2y$12$JuAlClULjwcoHLvexLaVrObGlr1tr7VqulWKR7L0GKN6Iyz6sNbTG', 'admin', NULL, '2025-01-02 16:04:32', '2025-01-02 16:04:32'),
(12, 'nauczyciel01', 'nauczyciel01@test.pl', '$2y$12$PQQ6MRUt/3PMm8yw9nnZ/eLw4ezmWSkkEIkJR31PjCMf1MtzTaTEi', 'nauczyciel', NULL, '2025-01-02 17:12:53', '2025-01-02 17:12:53'),
(13, 'uczen03', 'uczen03@test.pl', '$2y$12$p.4jkdW.OM8yzVnvUhHA3OKMQQ3nnz/FOwyM04Dy0NO8LL64dCSb6', 'uczen', NULL, '2025-01-02 17:39:04', '2025-01-02 17:39:04'),
(14, 'admin02', 'admin02@test.pl', '$2y$12$8Xv.1vVKMZNot7/eclBNu.9knLvKfOT/dVXfYHkmys74zYKfMiUlG', 'admin', NULL, '2025-01-02 17:39:26', '2025-01-02 17:39:26');
