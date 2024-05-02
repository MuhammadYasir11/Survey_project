-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 11:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Students', 'Student Feedback', '2024-05-02 03:41:00', '2024-05-02 03:41:00'),
(2, 'Customer', 'Customer Feedback', '2024-05-02 03:41:25', '2024-05-02 03:41:25'),
(3, 'Employee', 'Employee Feedback', '2024-05-02 03:41:40', '2024-05-02 03:41:40'),
(4, 'Application', 'Application Feedback', '2024-05-02 03:41:49', '2024-05-02 03:41:49'),
(5, 'Quize', 'Quize', '2024-05-02 03:41:59', '2024-05-02 03:41:59'),
(6, 'Parents', 'Parents Feedback', '2024-05-02 03:42:09', '2024-05-02 03:42:09'),
(7, 'Teacher', 'Teacher Feedback', '2024-05-02 03:42:18', '2024-05-02 03:42:18');

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
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2024_05_02_080431_alter_users_table', 2),
(13, '2024_05_02_080633_create__category_table', 3),
(14, '2024_05_02_080633_create_category_table', 4),
(15, '2024_05_02_080828_create_survey_table', 4),
(16, '2024_05_02_081215_create_questions_table', 5),
(17, '2024_05_02_081240_create_answer_table', 5),
(18, '2024_05_02_081312_create_option_table', 5),
(19, '2024_05_02_081616_alter_option_table', 6),
(20, '2024_05_02_081809_alter_option_table', 7),
(21, '2024_05_02_081948_remove_user_id_from_option_table', 8),
(22, '2024_05_02_082258_create_response_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `option`, `question_id`, `min`, `max`, `mid`, `created_at`, `updated_at`) VALUES
(1, 'One', 1, NULL, NULL, NULL, '2024-05-02 03:46:36', '2024-05-02 03:46:36'),
(2, 'Two', 1, NULL, NULL, NULL, '2024-05-02 03:46:36', '2024-05-02 03:46:36'),
(3, 'Four', 1, NULL, NULL, NULL, '2024-05-02 03:46:36', '2024-05-02 03:46:36'),
(4, 'Only Me', 1, NULL, NULL, NULL, '2024-05-02 03:46:36', '2024-05-02 03:46:36'),
(5, 'Karachi', 2, NULL, NULL, NULL, '2024-05-02 03:49:10', '2024-05-02 03:49:10'),
(6, 'lahore', 2, NULL, NULL, NULL, '2024-05-02 03:49:10', '2024-05-02 03:49:10'),
(7, 'Peshawar', 2, NULL, NULL, NULL, '2024-05-02 03:49:10', '2024-05-02 03:49:10'),
(8, 'Quetta', 2, NULL, NULL, NULL, '2024-05-02 03:49:10', '2024-05-02 03:49:10'),
(9, 'Islamabad', 2, NULL, NULL, NULL, '2024-05-02 03:49:10', '2024-05-02 03:49:10'),
(10, 'Bussiness Man', 4, NULL, NULL, NULL, '2024-05-02 03:53:17', '2024-05-02 03:53:17'),
(11, 'Employee', 4, NULL, NULL, NULL, '2024-05-02 03:53:17', '2024-05-02 03:53:17'),
(12, 'Self-Employee', 4, NULL, NULL, NULL, '2024-05-02 03:53:17', '2024-05-02 03:53:17'),
(13, 'HR', 4, NULL, NULL, NULL, '2024-05-02 03:53:17', '2024-05-02 03:53:17'),
(14, 'Cricket', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(15, 'Football', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(16, 'Hockey', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(17, 'Indoor Games', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(18, 'PC Games', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(19, 'Wrestling Games', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(20, 'Mobile Games', 5, NULL, NULL, NULL, '2024-05-02 03:59:54', '2024-05-02 03:59:54');

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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `answer` text DEFAULT NULL,
  `survey_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `question_type`, `answer`, `survey_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'How many siblings are there?', 'mcq', NULL, 1, 1, '2024-05-02 03:46:36', '2024-05-02 03:46:36'),
(2, 'Where are you from?', 'mcq', NULL, 1, 1, '2024-05-02 03:49:10', '2024-05-02 03:49:10'),
(3, 'What is your name?', 'text-box', 'My name is yasir', 1, 1, '2024-05-02 03:51:45', '2024-05-02 03:51:45'),
(4, 'What is your father occupation?', 'mcq', NULL, 1, 1, '2024-05-02 03:53:17', '2024-05-02 03:53:17'),
(5, 'What is your favourate Games?', 'mcq', NULL, 1, 1, '2024-05-02 03:59:54', '2024-05-02 03:59:54'),
(6, 'where are you spend free time?', 'text-box', 'Friends', 1, 1, '2024-05-02 04:02:20', '2024-05-02 04:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_respone` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `survey_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question_id` bigint(20) UNSIGNED DEFAULT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `survey_title`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Student Survey', 1, '2024-05-02 03:43:03', '2024-05-02 03:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
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
(1, 'Admin', 'Admin@gmail.com', 2, NULL, '$2y$10$iVTwYP6gzetdBUNP0.E8vOFe7WvJ3nLgWAKSoIJKb2cL.2qvZdIc2', NULL, '2024-05-02 03:34:13', '2024-05-02 03:34:13'),
(2, 'Muhammad Yasir', 'MuhammadYasir@gmil.com', 1, NULL, '$2y$10$LihDnvLZ3PV.kSsnGqVHye/QHn1zn18E/Wvq13ZWEus6BYS5O.Mfy', NULL, '2024-05-02 03:35:38', '2024-05-02 03:35:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_survey_id_index` (`survey_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_question_id_index` (`question_id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_survey_id_index` (`survey_id`),
  ADD KEY `questions_user_id_index` (`user_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_user_id_index` (`user_id`),
  ADD KEY `response_survey_id_index` (`survey_id`),
  ADD KEY `response_question_id_index` (`question_id`),
  ADD KEY `response_option_id_index` (`option_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_category_id_index` (`category_id`);

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
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `option`
--
ALTER TABLE `option`
  ADD CONSTRAINT `option_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `response_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
