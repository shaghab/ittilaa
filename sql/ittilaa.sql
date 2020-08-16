-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2020 at 02:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ittilaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2020_07_04_080632_create_categories_table', 1),
(3, '2020_07_04_215956_create_permissions_table', 1),
(4, '2020_07_04_220623_create_roles_table', 1),
(5, '2020_07_04_221601_create_roles_permissions_table', 1),
(6, '2020_07_05_000000_create_users_table', 1),
(7, '2020_07_18_034131_create_tags_table', 1),
(8, '2020_07_18_034421_create_regions_table', 1),
(9, '2020_07_22_185916_create_issuing_authorities_table', 1),
(10, '2020_07_22_195612_create_notifications_table', 1),
(11, '2020_07_22_221726_create_notifications_tags_table', 1),
(12, '2020_07_24_082313_create_data_import_files_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `x_categories`
--

CREATE TABLE `x_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `css_style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_data_import_files`
--

CREATE TABLE `x_data_import_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_header_row` tinyint(1) NOT NULL DEFAULT 0,
  `file_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_issuing_authorities`
--

CREATE TABLE `x_issuing_authorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_notifications`
--

CREATE TABLE `x_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_cat_caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_banner_style` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_date` datetime NOT NULL,
  `issuer_id` bigint(20) UNSIGNED NOT NULL,
  `issuing_authority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `approver_id` bigint(20) UNSIGNED NOT NULL,
  `approval_date` datetime DEFAULT '2020-08-13 12:41:39',
  `approval_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_notifications_tags`
--

CREATE TABLE `x_notifications_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_permissions`
--

CREATE TABLE `x_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_regions`
--

CREATE TABLE `x_regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_roles`
--

CREATE TABLE `x_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_roles_permissions`
--

CREATE TABLE `x_roles_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_tags`
--

CREATE TABLE `x_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `x_users`
--

CREATE TABLE `x_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `x_categories`
--
ALTER TABLE `x_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `x_data_import_files`
--
ALTER TABLE `x_data_import_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `x_issuing_authorities`
--
ALTER TABLE `x_issuing_authorities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_issuing_authorities_name_designation_unit_name_unique` (`name`,`designation`,`unit_name`);

--
-- Indexes for table `x_notifications`
--
ALTER TABLE `x_notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_notifications_thumbnail_link_unique` (`thumbnail_link`),
  ADD UNIQUE KEY `x_notifications_notice_link_unique` (`notice_link`),
  ADD KEY `x_notifications_category_id_foreign` (`category_id`),
  ADD KEY `x_notifications_region_id_foreign` (`region_id`),
  ADD KEY `x_notifications_issuer_id_foreign` (`issuer_id`),
  ADD KEY `x_notifications_operator_id_foreign` (`operator_id`),
  ADD KEY `x_notifications_approver_id_foreign` (`approver_id`);

--
-- Indexes for table `x_notifications_tags`
--
ALTER TABLE `x_notifications_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_notifications_tags_notification_id_tag_id_unique` (`notification_id`,`tag_id`),
  ADD KEY `x_notifications_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `x_permissions`
--
ALTER TABLE `x_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_permissions_name_unique` (`name`);

--
-- Indexes for table `x_regions`
--
ALTER TABLE `x_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_regions_name_unique` (`name`);

--
-- Indexes for table `x_roles`
--
ALTER TABLE `x_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_roles_name_unique` (`name`);

--
-- Indexes for table `x_roles_permissions`
--
ALTER TABLE `x_roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_roles_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `x_roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `x_tags`
--
ALTER TABLE `x_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_tags_name_unique` (`name`);

--
-- Indexes for table `x_users`
--
ALTER TABLE `x_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `x_users_name_unique` (`name`),
  ADD UNIQUE KEY `x_users_email_unique` (`email`),
  ADD KEY `x_users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `x_categories`
--
ALTER TABLE `x_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_data_import_files`
--
ALTER TABLE `x_data_import_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_issuing_authorities`
--
ALTER TABLE `x_issuing_authorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_notifications`
--
ALTER TABLE `x_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_notifications_tags`
--
ALTER TABLE `x_notifications_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_permissions`
--
ALTER TABLE `x_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_regions`
--
ALTER TABLE `x_regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_roles`
--
ALTER TABLE `x_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_roles_permissions`
--
ALTER TABLE `x_roles_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_tags`
--
ALTER TABLE `x_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `x_users`
--
ALTER TABLE `x_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `x_notifications`
--
ALTER TABLE `x_notifications`
  ADD CONSTRAINT `x_notifications_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `x_users` (`id`),
  ADD CONSTRAINT `x_notifications_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `x_categories` (`id`),
  ADD CONSTRAINT `x_notifications_issuer_id_foreign` FOREIGN KEY (`issuer_id`) REFERENCES `x_issuing_authorities` (`id`),
  ADD CONSTRAINT `x_notifications_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `x_users` (`id`),
  ADD CONSTRAINT `x_notifications_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `x_regions` (`id`);

--
-- Constraints for table `x_notifications_tags`
--
ALTER TABLE `x_notifications_tags`
  ADD CONSTRAINT `x_notifications_tags_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `x_notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `x_notifications_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `x_tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `x_roles_permissions`
--
ALTER TABLE `x_roles_permissions`
  ADD CONSTRAINT `x_roles_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `x_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `x_roles_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `x_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `x_users`
--
ALTER TABLE `x_users`
  ADD CONSTRAINT `x_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `x_roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
