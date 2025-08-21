-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 02:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `activity_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `activation_id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `employee_key` varchar(255) NOT NULL,
  `mac_address` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`activation_id`, `employer_id`, `employee_id`, `employee_key`, `mac_address`, `is_active`, `created_at`, `updated_at`) VALUES
(23, 11, 1, '64a97286e33ff', 'fh56tyrty655657', 1, '2023-07-19 02:42:56', '2023-07-19 02:42:56'),
(24, 4, 9, '64b66b4f43884', 'fh56tyrty655657', 1, '2023-07-19 02:43:25', '2023-07-19 02:43:25'),
(25, 4, 3, '64a972d32625e', 'fh56tyrty655657', 1, '2023-07-19 02:43:35', '2023-07-19 02:43:35'),
(26, 4, 4, '64a972fceebec', 'fh56tyrty655657', 1, '2023-07-19 02:43:48', '2023-07-19 02:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `email`, `group_id`, `employer_id`, `key`, `created_at`, `updated_at`) VALUES
(1, 'The witcher', 'witcher@witcher.com', 2, 11, '64a97286e33ff', '2023-07-08 09:28:22', '2023-07-08 09:28:22'),
(2, 'Sana Azmat Khan', 'sanaazmatkhan1@gmail.com', 1, 11, '64a9728be19ee', '2023-07-08 09:28:27', '2023-07-08 09:28:27'),
(3, 'Abc xyz', 'abc@xyz.com', 5, 4, '64a972d32625e', '2023-07-08 09:29:39', '2023-07-08 09:29:39'),
(4, 'One two', 'one@two.com', 4, 4, '64a972fceebec', '2023-07-08 09:30:20', '2023-07-08 09:30:20'),
(7, 'Sana Azmat Khan', 'sana@learningpitch.com', 6, 14, '64abc2af1a300', '2023-07-10 03:34:55', '2023-07-10 03:35:33'),
(8, 'bb', 'bilqees@bano.com', 7, 15, '64b00c3ee291b', '2023-07-13 09:37:50', '2023-07-13 09:37:50'),
(9, 'Sana', 'sana@sana.com', 3, 4, '64b66b4f43884', '2023-07-18 05:37:03', '2023-07-18 05:37:03'),
(13, 'The witcher', 'witcher@gmail.com', 4, 4, '64b7cb76e54f7', '2023-07-19 06:39:34', '2023-07-19 06:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `description`, `employer_id`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'lorem ipsum', 11, '2023-07-08 09:27:56', '2023-07-08 09:27:56'),
(2, 'HR', 'lorem ipsum', 11, '2023-07-08 09:28:12', '2023-07-08 09:28:12'),
(3, 'HR', 'lorem ipsum', 4, '2023-07-08 09:28:52', '2023-07-08 09:28:52'),
(4, 'Marketing', 'lorem ipsum', 4, '2023-07-08 09:29:02', '2023-07-08 09:29:02'),
(5, 'Management', 'lorem ipsum', 4, '2023-07-08 09:29:17', '2023-07-08 09:29:17'),
(6, 'HR', 'abcd xyz', 14, '2023-07-10 03:34:14', '2023-07-10 03:34:25'),
(7, 'aa', 'aa', 15, '2023-07-13 09:37:37', '2023-07-13 09:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `log_type` varchar(255) DEFAULT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `total_usage` float NOT NULL,
  `idle_time` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_type`, `employer_id`, `employee_id`, `total_usage`, `idle_time`, `created_at`, `updated_at`) VALUES
(8, NULL, 11, 1, 4.02147, 4.02147, '2023-07-18 03:38:55', '2023-07-18 05:33:01'),
(9, NULL, 4, 4, 123.6, 1554.38, '2023-07-16 05:36:14', '2023-07-18 05:36:14'),
(10, NULL, 4, 9, 2433.6, 35453.1, '2023-07-18 05:37:29', '2023-07-18 05:37:33'),
(11, NULL, 4, 3, 43984.3, 4646.03, '2023-07-18 05:38:24', '2023-07-18 08:20:19'),
(12, NULL, 11, 1, 213.253, 15.6217, '2023-07-19 02:19:50', '2023-07-19 02:36:58'),
(13, NULL, 4, 3, 22.0488, 0, '2023-07-19 02:50:13', '2023-07-19 06:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
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
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(21, '2023_07_08_063950_create_groups_table', 3),
(22, '2023_07_08_071209_create_employees_table', 3),
(27, '2023_07_10_124156_create_activations_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Admin','Employer') NOT NULL DEFAULT 'Employer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sana Azmat', 'sanaazmatkhan1@gmail.com', 'Admin', NULL, '$2y$10$ulbnnFWLu91MN698SaD.OeU8FWFp7iZO01PLCI25yCHzg3lrglKN.', NULL, '2023-06-26 08:47:01', '2023-06-26 08:47:01'),
(4, 'Sana Azmat', 'sanaazmatkhan12@gmail.com', 'Employer', NULL, '$2y$10$j7NzwmMnXE/cIJTCycIV8OeizLc/3syfPY.NfEWAS31lY19hU6MpO', NULL, '2023-07-04 01:45:22', '2023-07-04 01:45:22'),
(11, 'Employer for test', 'employerfortest@test.com', 'Employer', NULL, '$2y$10$ImFSS2ZpdxPBK2bgY.mKGuczX0U3wyUuCVJtD3ODfUM.hycE30HPe', NULL, '2023-07-06 01:31:50', '2023-07-06 01:31:50'),
(12, 'The witcher', 'witcher@witcher.com', 'Employer', NULL, '$2y$10$oDL32vay0WXlQvruoMcFU.oY/SDYYQga75jyHO8dKNn5PRlKqO6nO', NULL, '2023-07-07 09:19:35', '2023-07-07 09:19:35'),
(13, 'Administrator nn', 'test@test.com', 'Employer', NULL, '$2y$10$ib9s1/x5N0DY6NGvJBmm5Og4HM.sjmvuIZSLLxeBEXIEpr9d0E8HK', NULL, '2023-07-07 09:21:21', '2023-07-07 09:21:21'),
(14, 'Naeem testing', 'naeem@testing.com', 'Employer', NULL, '$2y$10$94GXdFpLYpn5wx6TqcE/8eZYeRH3QHt4yOsxwQuPyWsEMa7mfUuxq', NULL, '2023-07-10 03:33:29', '2023-07-10 03:33:29'),
(15, 'Sana Azmat', 'contactus@learningpitch.com', 'Employer', NULL, '$2y$10$T5dL3oqyXzajhveMaTr9pu/6B8rQh9qAJ0cJxAqoOKVIPVzyN27uG', NULL, '2023-07-13 08:39:06', '2023-07-13 08:39:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`activation_id`),
  ADD KEY `activations_employer_id_foreign` (`employer_id`),
  ADD KEY `activations_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_key_unique` (`key`),
  ADD KEY `employees_group_id_foreign` (`group_id`),
  ADD KEY `employees_user_id_foreign` (`employer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `groups_user_id_foreign` (`employer_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `activation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `activations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activations_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
