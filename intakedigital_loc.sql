-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 29 2024 г., 01:05
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `intakedigital_loc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `id_categories`
--

CREATE TABLE `id_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_categories`
--

INSERT INTO `id_categories` (`id`, `name`, `slug`, `description`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 'Car Accidents', 'car-accidents', NULL, 1, '2024-06-28 17:45:35', '2024-06-28 17:45:35'),
(3, 'Wrongful Death', 'wrongful-death', NULL, 1, '2024-06-28 17:46:46', '2024-06-28 17:46:46'),
(4, 'Dog Bites', 'dog-bites', NULL, 1, '2024-06-28 17:46:55', '2024-06-28 17:46:55'),
(5, 'Personal Injury', 'personal-injury', NULL, 1, '2024-06-28 17:47:04', '2024-06-28 17:47:04');

-- --------------------------------------------------------

--
-- Структура таблицы `id_failed_jobs`
--

CREATE TABLE `id_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_menus`
--

CREATE TABLE `id_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_menu_items`
--

CREATE TABLE `id_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `target` tinyint(4) DEFAULT NULL,
  `custom_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_migrations`
--

CREATE TABLE `id_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_migrations`
--

INSERT INTO `id_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_06_27_111245_create_user_metas_table', 1),
(7, '2024_06_27_111916_create_user_roles_table', 1),
(8, '2024_06_27_112115_create_user_to_roles_table', 1),
(10, '2024_06_27_130942_create_settings_table', 2),
(12, '2024_06_28_103352_create_menus_table', 3),
(13, '2024_06_28_114821_create_menu_items_table', 4),
(14, '2024_06_28_201250_create_categories_table', 5),
(15, '2024_06_28_204825_create_tags_table', 6),
(17, '2024_06_28_210821_create_posts_table', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `id_password_resets`
--

CREATE TABLE `id_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_password_reset_tokens`
--

CREATE TABLE `id_password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_personal_access_tokens`
--

CREATE TABLE `id_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_posts`
--

CREATE TABLE `id_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_settings`
--

CREATE TABLE `id_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_settings`
--

INSERT INTO `id_settings` (`id`, `type`, `option_name`, `option_value`) VALUES
(1, NULL, 'site_url', 'http://intakedigital.loc'),
(2, NULL, 'site_email', 'thewitness45@gmail.com'),
(3, NULL, 'site_name', 'INTAKE Digital'),
(4, NULL, 'site_description', 'This is my first website'),
(5, NULL, 'posts_per_page', '10'),
(6, NULL, 'debug_bar', '1'),
(7, NULL, 'mailer_type', 'smtp'),
(8, NULL, 'mailer_host', NULL),
(9, NULL, 'mailer_port', NULL),
(10, NULL, 'mailer_username', NULL),
(11, NULL, 'mailer_password', NULL),
(12, NULL, 'mailer_encryption', '0'),
(13, NULL, 'mailer_sender_address', NULL),
(14, NULL, 'mailer_title', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `id_tags`
--

CREATE TABLE `id_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `id_users`
--

CREATE TABLE `id_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_users`
--

INSERT INTO `id_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Roman', 'thewitness45@gmail.com', NULL, '$2y$12$CeHW.01XDZB5RRSbzrmqr.7zw/ebFGPf2X3r7N4kumFCKIwLYPmkW', 'onHRiAj20xuhFyXKfH3ICzEq9amKwFZebwXe3kKWzxkPMhCD3pzcBc3qEvR2', '2024-06-27 09:02:20', '2024-06-27 16:55:25'),
(2, 'Victor', 'victor@site.com', NULL, '$2y$12$8Pr.GfzwS89SSP5WU/33o.DCCAH02Y8u3.RutFd2f6w3VgUib45qe', NULL, '2024-06-27 17:51:16', '2024-06-27 17:51:16'),
(3, 'Test', 'diny@site.com', NULL, '$2y$12$kAR4Nq2g6qQAevac.Amn8OKyWqyrNmYzPsxjMGCclerVnIjaQV4Ky', NULL, '2024-06-27 17:55:39', '2024-06-27 17:55:39');

-- --------------------------------------------------------

--
-- Структура таблицы `id_user_metas`
--

CREATE TABLE `id_user_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_user_metas`
--

INSERT INTO `id_user_metas` (`id`, `user_id`, `first_name`, `last_name`, `display_name`, `description`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '0', NULL, '1991-04-28', '2024-06-27 09:02:20', '2024-06-27 16:55:45'),
(2, 2, NULL, NULL, '0', NULL, NULL, '2024-06-27 17:51:16', '2024-06-27 17:52:18'),
(3, 3, NULL, 'Jho', '0', NULL, NULL, '2024-06-27 17:55:39', '2024-06-27 17:56:04');

-- --------------------------------------------------------

--
-- Структура таблицы `id_user_roles`
--

CREATE TABLE `id_user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_user_roles`
--

INSERT INTO `id_user_roles` (`id`, `name`) VALUES
(1, 'Superuser'),
(2, 'Administrator'),
(3, 'Writer'),
(4, 'Reader'),
(5, 'Subscriber');

-- --------------------------------------------------------

--
-- Структура таблицы `id_user_to_roles`
--

CREATE TABLE `id_user_to_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `id_user_to_roles`
--

INSERT INTO `id_user_to_roles` (`id`, `user_id`, `role_id`) VALUES
(2, 1, 1),
(3, 2, 4),
(4, 3, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `id_categories`
--
ALTER TABLE `id_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_failed_jobs`
--
ALTER TABLE `id_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `id_menus`
--
ALTER TABLE `id_menus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_menu_items`
--
ALTER TABLE `id_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu_items_menu_id_foreign` (`menu_id`);

--
-- Индексы таблицы `id_migrations`
--
ALTER TABLE `id_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_password_resets`
--
ALTER TABLE `id_password_resets`
  ADD KEY `id_password_resets_email_index` (`email`);

--
-- Индексы таблицы `id_password_reset_tokens`
--
ALTER TABLE `id_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `id_personal_access_tokens`
--
ALTER TABLE `id_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_personal_access_tokens_token_unique` (`token`),
  ADD KEY `id_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `id_posts`
--
ALTER TABLE `id_posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_settings`
--
ALTER TABLE `id_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_tags`
--
ALTER TABLE `id_tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_users`
--
ALTER TABLE `id_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_users_email_unique` (`email`);

--
-- Индексы таблицы `id_user_metas`
--
ALTER TABLE `id_user_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_metas_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `id_user_roles`
--
ALTER TABLE `id_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `id_user_to_roles`
--
ALTER TABLE `id_user_to_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_to_roles_role_id_foreign` (`role_id`),
  ADD KEY `id_user_to_roles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `id_categories`
--
ALTER TABLE `id_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `id_failed_jobs`
--
ALTER TABLE `id_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `id_menus`
--
ALTER TABLE `id_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `id_menu_items`
--
ALTER TABLE `id_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `id_migrations`
--
ALTER TABLE `id_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `id_personal_access_tokens`
--
ALTER TABLE `id_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `id_posts`
--
ALTER TABLE `id_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `id_settings`
--
ALTER TABLE `id_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `id_tags`
--
ALTER TABLE `id_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `id_users`
--
ALTER TABLE `id_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `id_user_metas`
--
ALTER TABLE `id_user_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `id_user_roles`
--
ALTER TABLE `id_user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `id_user_to_roles`
--
ALTER TABLE `id_user_to_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `id_menu_items`
--
ALTER TABLE `id_menu_items`
  ADD CONSTRAINT `id_menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `id_menus` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `id_user_metas`
--
ALTER TABLE `id_user_metas`
  ADD CONSTRAINT `id_user_metas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `id_users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `id_user_to_roles`
--
ALTER TABLE `id_user_to_roles`
  ADD CONSTRAINT `id_user_to_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `id_user_roles` (`id`),
  ADD CONSTRAINT `id_user_to_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `id_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
