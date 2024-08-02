-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2024 г., 19:05
-- Версия сервера: 8.0.30
-- Версия PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `neutrino_loc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `nt_applications`
--

CREATE TABLE `nt_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_applications`
--

INSERT INTO `nt_applications` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'help-center', 'help-center/help-center', 0, '2024-08-02 13:02:59', '2024-08-02 13:03:42');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_categories`
--

CREATE TABLE `nt_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `author_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_categories`
--

INSERT INTO `nt_categories` (`id`, `name`, `slug`, `description`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Uncategorized', 'uncategorized', 'Base category created after installation.', 1, '2024-07-17 04:02:44', '2024-07-17 04:02:44');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_comments`
--

CREATE TABLE `nt_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_contact_forms`
--

CREATE TABLE `nt_contact_forms` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_contact_form_databases`
--

CREATE TABLE `nt_contact_form_databases` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` bigint UNSIGNED NOT NULL,
  `form_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_unique_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_content_metas`
--

CREATE TABLE `nt_content_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `page_id` bigint UNSIGNED DEFAULT NULL,
  `post_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `tag_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_failed_jobs`
--

CREATE TABLE `nt_failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_menus`
--

CREATE TABLE `nt_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `author_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_menu_items`
--

CREATE TABLE `nt_menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `target` tinyint DEFAULT NULL,
  `parent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `custom_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_migrations`
--

CREATE TABLE `nt_migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_pages`
--

CREATE TABLE `nt_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_pages`
--

INSERT INTO `nt_pages` (`id`, `name`, `slug`, `parent_id`, `author_id`, `status`, `content`, `template`, `created_at`, `updated_at`) VALUES
(1, 'Home Page', 'home-page', NULL, 1, 1, '<p>This is base page created as default after installation <a href=\"https://intakedigital.net/neutrino-cms/\" title=\"Neutrino CMS\" target=\"_blank\">Neutrino</a>.</p>', 'default', '2024-07-17 02:59:45', '2024-07-17 02:59:45');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_password_resets`
--

CREATE TABLE `nt_password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_password_reset_tokens`
--

CREATE TABLE `nt_password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_personal_access_tokens`
--

CREATE TABLE `nt_personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_posts`
--

CREATE TABLE `nt_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delayed_date` datetime DEFAULT NULL,
  `disable_comments` tinyint NOT NULL DEFAULT '0',
  `thumbnail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_posts`
--

INSERT INTO `nt_posts` (`id`, `name`, `slug`, `author_id`, `status`, `content`, `delayed_date`, `disable_comments`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'Hello, World!', 'hello-world', 1, 1, '<p>This is base post created as default after installation <a href=\"https://intakedigital.net/neutrino-cms/\" title=\"Neutrino CMS\" target=\"_blank\">Neutrino</a>.</p>', NULL, 0, NULL, '2024-07-17 02:59:04', '2024-07-17 02:59:04');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_post_to_categories`
--

CREATE TABLE `nt_post_to_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_post_to_categories`
--

INSERT INTO `nt_post_to_categories` (`id`, `post_id`, `category_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `nt_post_to_tags`
--

CREATE TABLE `nt_post_to_tags` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_settings`
--

CREATE TABLE `nt_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_settings`
--

INSERT INTO `nt_settings` (`id`, `type`, `option_name`, `option_value`) VALUES
(1, '', 'site_name', 'Neutrino CMS'),
(2, NULL, 'blog_base', 'blog'),
(3, NULL, 'category_base', 'category/{category}'),
(4, NULL, 'tag_base', 'tag/{tag}'),
(5, NULL, 'debug_bar', '0'),
(6, NULL, 'homepage_id', '1'),
(7, NULL, 'front_theme', 'moon-base');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_tags`
--

CREATE TABLE `nt_tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `author_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `nt_users`
--

CREATE TABLE `nt_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_users`
--

INSERT INTO `nt_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@admin.com', NULL, '$2y$12$4FCzJ1k19GFnUVJ4JAXcQOh3aAD1VP5rfbkNMMtClpFz9SyiL9hHS', 'C7yTc4FG31uOEGsurnCkRUMgxlZlX1HNG2L32a7LUYu4y2mSVKMYd2pZj0aL', '2024-07-17 00:21:07', '2024-08-02 13:04:06');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_user_metas`
--

CREATE TABLE `nt_user_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `birth_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_user_metas`
--

INSERT INTO `nt_user_metas` (`id`, `user_id`, `first_name`, `last_name`, `display_name`, `description`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '0', NULL, NULL, '2024-07-17 00:21:07', '2024-07-17 00:21:07');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_user_roles`
--

CREATE TABLE `nt_user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_user_roles`
--

INSERT INTO `nt_user_roles` (`id`, `name`) VALUES
(1, 'Superuser'),
(2, 'Administrator'),
(3, 'Writer'),
(4, 'Reader'),
(5, 'Subscriber');

-- --------------------------------------------------------

--
-- Структура таблицы `nt_user_to_roles`
--

CREATE TABLE `nt_user_to_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `nt_user_to_roles`
--

INSERT INTO `nt_user_to_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `nt_applications`
--
ALTER TABLE `nt_applications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_categories`
--
ALTER TABLE `nt_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_comments`
--
ALTER TABLE `nt_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_comments_post_nt_foreign` (`post_id`),
  ADD KEY `nt_comments_author_nt_foreign` (`author_id`);

--
-- Индексы таблицы `nt_contact_forms`
--
ALTER TABLE `nt_contact_forms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_contact_form_databases`
--
ALTER TABLE `nt_contact_form_databases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_content_metas`
--
ALTER TABLE `nt_content_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_content_metas_page_nt_foreign` (`page_id`),
  ADD KEY `nt_content_metas_post_nt_foreign` (`post_id`),
  ADD KEY `nt_content_metas_category_nt_foreign` (`category_id`),
  ADD KEY `nt_content_metas_tag_nt_foreign` (`tag_id`);

--
-- Индексы таблицы `nt_failed_jobs`
--
ALTER TABLE `nt_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nt_failed_jobs_uunt_unique` (`uuid`);

--
-- Индексы таблицы `nt_menus`
--
ALTER TABLE `nt_menus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_menu_items`
--
ALTER TABLE `nt_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_menu_items_menu_nt_foreign` (`menu_id`);

--
-- Индексы таблицы `nt_migrations`
--
ALTER TABLE `nt_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_pages`
--
ALTER TABLE `nt_pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_password_resets`
--
ALTER TABLE `nt_password_resets`
  ADD KEY `nt_password_resets_email_index` (`email`);

--
-- Индексы таблицы `nt_password_reset_tokens`
--
ALTER TABLE `nt_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `nt_personal_access_tokens`
--
ALTER TABLE `nt_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nt_personal_access_tokens_token_unique` (`token`),
  ADD KEY `nt_personal_access_tokens_tokenable_type_tokenable_nt_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `nt_posts`
--
ALTER TABLE `nt_posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_post_to_categories`
--
ALTER TABLE `nt_post_to_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_post_to_categories_post_nt_foreign` (`post_id`),
  ADD KEY `nt_post_to_categories_category_nt_foreign` (`category_id`);

--
-- Индексы таблицы `nt_post_to_tags`
--
ALTER TABLE `nt_post_to_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_post_to_tags_post_nt_foreign` (`post_id`),
  ADD KEY `nt_post_to_tags_tag_nt_foreign` (`tag_id`);

--
-- Индексы таблицы `nt_settings`
--
ALTER TABLE `nt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_tags`
--
ALTER TABLE `nt_tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_users`
--
ALTER TABLE `nt_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nt_users_email_unique` (`email`);

--
-- Индексы таблицы `nt_user_metas`
--
ALTER TABLE `nt_user_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_user_metas_user_nt_foreign` (`user_id`);

--
-- Индексы таблицы `nt_user_roles`
--
ALTER TABLE `nt_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nt_user_to_roles`
--
ALTER TABLE `nt_user_to_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nt_user_to_roles_role_nt_foreign` (`role_id`),
  ADD KEY `nt_user_to_roles_user_nt_foreign` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `nt_applications`
--
ALTER TABLE `nt_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_categories`
--
ALTER TABLE `nt_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_comments`
--
ALTER TABLE `nt_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_contact_forms`
--
ALTER TABLE `nt_contact_forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_contact_form_databases`
--
ALTER TABLE `nt_contact_form_databases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_content_metas`
--
ALTER TABLE `nt_content_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_failed_jobs`
--
ALTER TABLE `nt_failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_menus`
--
ALTER TABLE `nt_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_menu_items`
--
ALTER TABLE `nt_menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_migrations`
--
ALTER TABLE `nt_migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_pages`
--
ALTER TABLE `nt_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_personal_access_tokens`
--
ALTER TABLE `nt_personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_posts`
--
ALTER TABLE `nt_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_post_to_categories`
--
ALTER TABLE `nt_post_to_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_post_to_tags`
--
ALTER TABLE `nt_post_to_tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_settings`
--
ALTER TABLE `nt_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `nt_tags`
--
ALTER TABLE `nt_tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nt_users`
--
ALTER TABLE `nt_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_user_metas`
--
ALTER TABLE `nt_user_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nt_user_roles`
--
ALTER TABLE `nt_user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `nt_user_to_roles`
--
ALTER TABLE `nt_user_to_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `nt_comments`
--
ALTER TABLE `nt_comments`
  ADD CONSTRAINT `nt_comments_author_nt_foreign` FOREIGN KEY (`author_id`) REFERENCES `nt_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nt_comments_post_nt_foreign` FOREIGN KEY (`post_id`) REFERENCES `nt_posts` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nt_content_metas`
--
ALTER TABLE `nt_content_metas`
  ADD CONSTRAINT `nt_content_metas_category_nt_foreign` FOREIGN KEY (`category_id`) REFERENCES `nt_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nt_content_metas_page_nt_foreign` FOREIGN KEY (`page_id`) REFERENCES `nt_pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nt_content_metas_post_nt_foreign` FOREIGN KEY (`post_id`) REFERENCES `nt_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nt_content_metas_tag_nt_foreign` FOREIGN KEY (`tag_id`) REFERENCES `nt_tags` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nt_menu_items`
--
ALTER TABLE `nt_menu_items`
  ADD CONSTRAINT `nt_menu_items_menu_nt_foreign` FOREIGN KEY (`menu_id`) REFERENCES `nt_menus` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nt_post_to_categories`
--
ALTER TABLE `nt_post_to_categories`
  ADD CONSTRAINT `nt_post_to_categories_category_nt_foreign` FOREIGN KEY (`category_id`) REFERENCES `nt_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nt_post_to_categories_post_nt_foreign` FOREIGN KEY (`post_id`) REFERENCES `nt_posts` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nt_post_to_tags`
--
ALTER TABLE `nt_post_to_tags`
  ADD CONSTRAINT `nt_post_to_tags_post_nt_foreign` FOREIGN KEY (`post_id`) REFERENCES `nt_posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nt_post_to_tags_tag_nt_foreign` FOREIGN KEY (`tag_id`) REFERENCES `nt_tags` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nt_user_metas`
--
ALTER TABLE `nt_user_metas`
  ADD CONSTRAINT `nt_user_metas_user_nt_foreign` FOREIGN KEY (`user_id`) REFERENCES `nt_users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `nt_user_to_roles`
--
ALTER TABLE `nt_user_to_roles`
  ADD CONSTRAINT `nt_user_to_roles_role_nt_foreign` FOREIGN KEY (`role_id`) REFERENCES `nt_user_roles` (`id`),
  ADD CONSTRAINT `nt_user_to_roles_user_nt_foreign` FOREIGN KEY (`user_id`) REFERENCES `nt_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
