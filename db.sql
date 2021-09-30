DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tasks` (`id`, `name`, `email`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ningguang', 'zolo@site.com', 'Re Lorem ipsum dolor sit amet, consectetur...', 0, '2019-10-12 20:05:31', NULL),
(2, 'Albedo', 'alhim@site.com', 'Fo Lorem ipsum dolor sit amet, consectetur...', 0, '2019-10-12 20:05:31', '2019-10-12 20:05:31'),
(3, 'Xianlin', 'fisnfjds@site.com', 'Co Lorem ipsum dolor sit amet, consectetur...', 0, '2019-10-12 20:05:31', NULL),
(4, 'Barbara', 'monaxt@site.com', 'Zu Lorem ipsum dolor sit amet, consectetur...', 1, '2019-10-12 20:05:31', NULL);


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'admin', '123');