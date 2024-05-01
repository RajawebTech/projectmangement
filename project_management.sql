-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 05:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `amc_frequency` varchar(255) DEFAULT NULL,
  `certification_standard_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `contact_name`, `email_id`, `mobile_number`, `address`, `amc_frequency`, `certification_standard_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pricol', 'Bharath', 'pricol@gmail.com', '8870734869', 'No,2 Neart maruthi showroom Coimbatore', 'yearly', '[\"2\"]', '1', '2024-04-24 07:21:19', '2024-04-24 07:21:19'),
(2, 'Bajaj', 'Farooq', 'Bajajfinance@gmail.com', '8870734869', 'Coimabtore', 'half_yearly', '[\"1\",\"3\"]', '1', '2024-04-24 07:22:14', '2024-04-24 07:22:14'),
(3, 'asfadsf', 'asd', 'raj@gmail.com', '6534727832', 'adsf', 'once_a_quarter', '[\"2\"]', '2', '2024-04-24 07:23:12', '2024-04-24 07:23:19'),
(4, 'MRF Tyres', 'Gowtham', 'mrf@gmail.com', '7782892911', 'Salem', 'yearly', '[\"1\"]', '1', '2024-04-24 07:23:53', '2024-04-24 07:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT '1',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_id`, `name`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'dashboard', '/dashboard', '1', '2024-04-30 16:50:10', '2024-04-30 16:52:11'),
(2, 2, 'certificates', 'certifications/list', '1', '2024-04-30 16:50:46', '2024-04-30 16:52:43'),
(3, 2, 'certificates', 'certifications/create', '1', '2024-04-30 16:50:53', '2024-04-30 16:53:35'),
(4, 2, 'certificates', 'certifications/edit', '1', '2024-04-30 16:50:56', '2024-04-30 16:52:47'),
(5, 2, 'certificates', 'certifications/delete', '1', '2024-04-30 16:52:23', '2024-04-30 16:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'superadmin', '1', '2024-04-30 16:39:43', '2024-04-30 16:39:43'),
(2, '2', 'user', '1', '2024-04-30 16:39:59', '2024-04-30 16:39:59'),
(3, '3', 'projectmanager', '1', '2024-04-30 22:21:32', '2024-04-30 22:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '2024-04-30 16:55:11', '2024-04-30 16:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `title`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, '1704361469.svg', '1704361319.png', NULL, 'Cameo', 'Meta Title', 'Meta Desc', '2024-01-04 10:53:02', '2024-01-04 09:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `email`, `image`, `mobile_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Project Manager', 'projectmanager@gmail.com', NULL, '9543220298', 'Coimbatore Nava India', '1', '2024-04-24 06:19:18', '2024-04-30 21:11:57'),
(5, 'Team member', 'teammember@gmail.com', NULL, '8870734869', 'No.3 Sns Nagar Coimbatore', '1', '2024-05-01 00:06:28', '2024-05-01 00:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '1', NULL, NULL, '$2y$12$V5Xmo2gOfUHVLuUDhph7Rul5O4vOcS./8Yux7BB6xJNQTqN8bH.vG', NULL, '2024-04-30 01:15:38', '2024-04-30 01:15:38'),
(12, 'Team Member', 'team@gmail.com', '2', NULL, NULL, '$2y$12$xxnKnOC4gKkNBIRZZGFUZuoF1SeOP2XE/fSKc16.mkPSbyGnoxj6m', NULL, '2024-04-30 10:23:23', '2024-04-30 10:23:23'),
(13, 'Project Manager', 'projectmanager@gmail.com', '3', NULL, NULL, '$2y$12$dS9Gj6tbOhNS43WSg/qd8.QsxAu/QsSpw3BWEdDrJdBkKLIgT97PG', NULL, '2024-04-30 19:05:25', '2024-04-30 19:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(50) NOT NULL,
  `login_at` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `session_id`, `login_at`, `logout_at`) VALUES
(1, 1, '1674814905', '2023-01-27 10:21:45', NULL),
(2, 1, '1674815393', '2023-01-27 10:29:53', NULL),
(3, 1, '1674815599', '2023-01-27 10:33:19', NULL),
(4, 1, '1674815880', '2023-01-27 10:38:00', NULL),
(5, 1, '1674815915', '2023-01-27 10:38:35', NULL),
(6, 1, '1674816055', '2023-01-27 10:40:55', NULL),
(7, 1, '1674816215', '2023-01-27 10:43:35', '2023-01-27 10:44:11'),
(8, 1, '1674816260', '2023-01-27 10:44:20', '2023-01-27 10:44:28'),
(9, 1, '1674817013', '2023-01-27 10:56:53', '2023-01-27 11:38:41'),
(10, 1, '1675056651', '2023-01-30 05:30:51', NULL),
(11, 1, '1675248634', '2023-02-01 10:50:34', NULL),
(12, 1, '1675334483', '2023-02-02 10:41:23', NULL),
(13, 1, '1675835906', '2023-02-08 05:58:26', NULL),
(14, 1, '1676010008', '2023-02-10 06:20:08', NULL),
(15, 1, '1676550704', '2023-02-16 12:31:44', NULL),
(16, 1, '1702386758', '2023-12-12 13:12:38', '2023-12-12 13:34:41'),
(17, 1, '1702398372', '2023-12-12 16:26:12', '2023-12-12 16:26:34'),
(18, 1, '1702398726', '2023-12-12 16:32:06', '2023-12-12 17:18:56'),
(19, 1, '1702401547', '2023-12-12 17:19:07', '2023-12-12 17:47:17'),
(20, 1, '1702443995', '2023-12-13 05:06:35', '2023-12-13 06:23:59'),
(21, 1, '1702448656', '2023-12-13 06:24:16', '2023-12-13 06:25:46'),
(22, 1, '1702448773', '2023-12-13 06:26:13', '2023-12-13 06:26:55'),
(23, 1, '1702448819', '2023-12-13 06:26:59', NULL),
(24, 1, '1702530882', '2023-12-14 05:14:42', NULL),
(25, 1, '1702531058', '2023-12-14 05:17:38', NULL),
(26, 1, '1702616500', '2023-12-15 05:01:40', NULL),
(27, 1, '1702616580', '2023-12-15 05:03:00', NULL),
(28, 1, '1702632744', '2023-12-15 09:32:24', '2023-12-15 11:24:14'),
(29, 1, '1702639467', '2023-12-15 11:24:27', NULL),
(30, 1, '1702800884', '2023-12-17 08:14:44', NULL),
(31, 1, '1702828645', '2023-12-17 15:57:25', NULL),
(32, 1, '1702875881', '2023-12-18 05:04:41', NULL),
(33, 1, '1702961440', '2023-12-19 04:50:40', NULL),
(34, 1, '1703048516', '2023-12-20 05:01:56', NULL),
(35, 1, '1703134308', '2023-12-21 04:51:48', NULL),
(36, 1, '1703230409', '2023-12-22 07:33:29', NULL),
(37, 1, '1703566301', '2023-12-26 04:51:41', NULL),
(38, 1, '1703581031', '2023-12-26 08:57:11', NULL),
(39, 1, '1703581031', '2023-12-26 08:57:11', NULL),
(40, 1, '1703581031', '2023-12-26 08:57:11', NULL),
(41, 1, '1703652445', '2023-12-27 04:47:25', NULL),
(42, 1, '1703739252', '2023-12-28 04:54:12', '2023-12-28 06:25:18'),
(43, 1, '1703744737', '2023-12-28 06:25:37', NULL),
(44, 1, '1703769277', '2023-12-28 13:14:37', '2023-12-28 13:44:20'),
(45, 1, '1703769590', '2023-12-28 13:19:50', NULL),
(46, 1, '1703771093', '2023-12-28 13:44:53', NULL),
(47, 1, '1703852353', '2023-12-29 12:19:14', NULL),
(48, 1, '1703852971', '2023-12-29 12:29:31', NULL),
(49, 1, '1704173359', '2024-01-02 05:29:19', NULL),
(50, 1, '1704173650', '2024-01-02 05:34:10', NULL),
(51, 1, '1704188869', '2024-01-02 09:47:49', NULL),
(52, 1, '1704199808', '2024-01-02 12:50:08', NULL),
(53, 1, '1704260446', '2024-01-03 05:40:46', NULL),
(54, 1, '1704284448', '2024-01-03 12:20:48', NULL),
(55, 1, '1704284846', '2024-01-03 12:27:26', NULL),
(56, 1, '1704284902', '2024-01-03 12:28:22', NULL),
(57, 1, '1704286351', '2024-01-03 12:52:31', NULL),
(58, 1, '1704287847', '2024-01-03 13:17:27', NULL),
(59, 1, '1704344126', '2024-01-04 04:55:26', NULL),
(60, 1, '1704360666', '2024-01-04 09:31:06', NULL),
(61, 1, '1704371204', '2024-01-04 12:26:44', NULL),
(62, 1, '1704710603', '2024-01-08 10:43:23', NULL),
(63, 1, '1704778567', '2024-01-09 05:36:07', NULL),
(64, 1, '1704791524', '2024-01-09 09:12:04', NULL),
(65, 1, '1704886196', '2024-01-10 11:29:56', NULL),
(66, 1, '1705486898', '2024-01-17 10:21:38', NULL),
(67, 1, '1708757281', '2024-02-24 06:48:01', '2024-02-24 06:48:12'),
(68, 1, '1708757333', '2024-02-24 06:48:53', '2024-02-24 06:49:02'),
(69, 1, '1708757375', '2024-02-24 06:49:35', '2024-02-24 06:49:42'),
(70, 1, '1708760425', '2024-02-24 07:40:25', NULL),
(71, 1, '1712216406', '2024-04-04 07:40:06', '2024-04-04 07:40:37'),
(72, 1, '1712217338', '2024-04-04 07:55:38', '2024-04-04 08:07:21'),
(73, 1, '1712218187', '2024-04-04 08:09:47', '2024-04-04 09:05:33'),
(74, 1, '1712221713', '2024-04-04 09:08:33', '2024-04-04 09:11:30'),
(75, 1, '1712221898', '2024-04-04 09:11:38', '2024-04-04 09:12:27'),
(76, 1, '1712223571', '2024-04-04 09:39:31', NULL),
(77, 1, '1712225054', '2024-04-04 10:04:14', '2024-04-04 10:31:09'),
(78, 1, '1712226701', '2024-04-04 10:31:41', '2024-04-04 10:33:09'),
(79, 1, '1712226860', '2024-04-04 10:34:20', NULL),
(80, 1, '1712302292', '2024-04-05 07:31:33', '2024-04-05 08:17:51'),
(81, 1, '1712305073', '2024-04-05 08:17:53', '2024-04-05 13:23:30'),
(82, 1, '1712323413', '2024-04-05 13:23:33', NULL),
(83, 1, '1712324442', '2024-04-05 13:40:42', NULL),
(84, 1, '1712324906', '2024-04-05 13:48:26', NULL),
(85, 1, '1712325835', '2024-04-05 14:03:55', NULL),
(86, 1, '1712550207', '2024-04-08 04:23:27', '2024-04-08 06:15:22'),
(87, 1, '1712557185', '2024-04-08 06:19:45', NULL),
(88, 1, '1712569253', '2024-04-08 09:40:53', '2024-04-08 14:04:45'),
(89, 1, '1712635419', '2024-04-09 04:03:39', NULL),
(90, 1, '1712728765', '2024-04-10 05:59:26', NULL),
(91, 1, '1712755681', '2024-04-10 13:28:01', NULL),
(92, 1, '1712814362', '2024-04-11 05:46:03', NULL),
(93, 1, '1712827301', '2024-04-11 09:21:41', NULL),
(94, 1, '1712914718', '2024-04-12 09:38:38', NULL),
(95, 1, '1713244957', '2024-04-16 05:22:37', '2024-04-16 05:22:56'),
(96, 1, '1713244979', '2024-04-16 05:22:59', '2024-04-16 05:23:03'),
(97, 1, '1713245399', '2024-04-16 05:29:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_items`
--

CREATE TABLE `work_items` (
  `id` int(11) NOT NULL,
  `work_item_name` varchar(255) DEFAULT NULL,
  `assign_to` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_items`
--

INSERT INTO `work_items` (`id`, `work_item_name`, `assign_to`, `start_date`, `end_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Login Page Design', 'Team member', '2024-05-01', '2024-05-10', 'Create a Login Page Design', '1', '2024-05-01 00:33:16', '2024-05-01 00:33:16'),
(2, 'Custom Registeration', 'Team member', '2024-05-01', '2024-05-10', 'Create a Custom Register Form', '1', '2024-05-01 00:34:30', '2024-05-01 00:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_items`
--
ALTER TABLE `work_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `work_items`
--
ALTER TABLE `work_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
