-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 10:39 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accidents`
--

CREATE TABLE `accidents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `passenger` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accidents`
--

INSERT INTO `accidents` (`id`, `location`, `description`, `date`, `passenger`, `type`, `vehicle_status`, `created_at`, `updated_at`, `driver_id`, `vehicle_id`) VALUES
(1, 'Ihumwa', 'Tyle bust', '2021-02-21', 4, 'Overspeeding', 'okay', '2021-02-23 04:30:06', '2021-02-23 04:30:06', 1, 1),
(2, 'Ihumwa', 'Tyle bust', '2021-02-21', 15, 'Overspeeding', 'okay', '2021-02-23 04:30:26', '2021-02-23 05:11:21', NULL, 1),
(3, 'Ihumwa', 'Tyle bust', '2021-02-21', 1, 'Overspeeding', 'okay', '2021-02-23 05:02:51', '2021-02-23 05:11:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `accident_vehicle`
--

CREATE TABLE `accident_vehicle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `accident_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\User', 3, 'App\\Models\\User', 1, '[]', '2021-02-19 05:15:32', '2021-02-19 05:15:32'),
(2, 'default', 'updated', 'App\\Models\\User', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"name\":null,\"text\":null},\"old\":{\"name\":null,\"text\":null}}', '2021-02-19 05:31:46', '2021-02-19 05:31:46'),
(3, 'default', 'updated', 'App\\Models\\User', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Deusdedit\",\"last_name\":\"Byaba\",\"email\":\"db@gmail.com\"},\"old\":{\"first_name\":\"Deusdedit\",\"last_name\":\"Byaba\",\"email\":\"db@gmail.com\"}}', '2021-02-19 05:33:20', '2021-02-19 05:33:20'),
(4, 'default', 'updated', 'App\\Models\\User', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Deusdedit\",\"last_name\":\"Byaba\",\"email\":\"db@gmail.com\"},\"old\":{\"first_name\":\"Deusdedit\",\"last_name\":\"Byaba\",\"email\":\"db@gmail.com\"}}', '2021-02-19 06:51:27', '2021-02-19 06:51:27'),
(5, 'default', 'Look mum, I logged something', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-19 06:51:27', '2021-02-19 06:51:27'),
(6, 'default', 'created', 'App\\Models\\Asset', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"name\":\"dfknj\"}}', '2021-02-19 06:55:26', '2021-02-19 06:55:26'),
(7, 'default', ' its asset Look mum, I logged something on ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-19 06:55:26', '2021-02-19 06:55:26'),
(8, 'default', 'created', 'App\\Models\\Asset', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"name\":\"dfhsj\"}}', '2021-02-19 06:58:00', '2021-02-19 06:58:00'),
(9, 'default', 'created', 'App\\Models\\Asset', 4, 'App\\Models\\User', 3, '[]', '2021-02-19 07:02:08', '2021-02-19 07:02:08'),
(10, 'default', ' its asset Look mum, I logged something on ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-19 07:02:08', '2021-02-19 07:02:08'),
(11, 'default', ' new asseted its asset Look mum, I logged something on ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-21 23:03:23', '2021-02-21 23:03:23'),
(12, 'default', ' officials new asseted its asset Look mum.', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-21 23:05:19', '2021-02-21 23:05:19'),
(13, 'default', 'Deleted asset  hii serial number jdnw', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-21 23:13:20', '2021-02-21 23:13:20'),
(14, 'default', 'Deactivated user  Mathayo Mat surname email mat@gmail.com', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-21 23:33:20', '2021-02-21 23:33:20'),
(15, 'default', 'updated', 'App\\Models\\User', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Mathayo\",\"last_name\":\"Mat surname\",\"email\":\"mat@gmail.com\"},\"old\":{\"first_name\":\"Mathayo\",\"last_name\":\"Mat surname\",\"email\":\"mat@gmail.com\"}}', '2021-02-21 23:33:20', '2021-02-21 23:33:20'),
(16, 'default', 'Activated user  Mathayo Mat surname email mat@gmail.com', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-21 23:35:06', '2021-02-21 23:35:06'),
(17, 'default', 'updated', 'App\\Models\\User', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Mathayo\",\"last_name\":\"Mat surname\",\"email\":\"mat@gmail.com\"},\"old\":{\"first_name\":\"Mathayo\",\"last_name\":\"Mat surname\",\"email\":\"mat@gmail.com\"}}', '2021-02-21 23:35:06', '2021-02-21 23:35:06'),
(18, 'default', 'Added information of received item ksjdn on ledger number sdf89', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 01:55:58', '2021-02-22 01:55:58'),
(19, 'default', 'Edited asset  dfknj serial number jdb3', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 02:13:51', '2021-02-22 02:13:51'),
(20, 'default', 'Edited asset  new name serial number jdb3', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 02:15:38', '2021-02-22 02:15:38'),
(21, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 03:30:09', '2021-02-22 03:30:09'),
(22, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 03:32:03', '2021-02-22 03:32:03'),
(23, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:36:29', '2021-02-22 03:36:29'),
(24, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:39:38', '2021-02-22 03:39:38'),
(25, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:40:03', '2021-02-22 03:40:03'),
(26, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:40:13', '2021-02-22 03:40:13'),
(27, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:40:58', '2021-02-22 03:40:58'),
(28, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:42:03', '2021-02-22 03:42:03'),
(29, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:42:19', '2021-02-22 03:42:19'),
(30, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:42:41', '2021-02-22 03:42:41'),
(31, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:42:52', '2021-02-22 03:42:52'),
(32, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:43:36', '2021-02-22 03:43:36'),
(33, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:44:08', '2021-02-22 03:44:08'),
(34, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:44:49', '2021-02-22 03:44:49'),
(35, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:45:04', '2021-02-22 03:45:04'),
(36, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:46:50', '2021-02-22 03:46:50'),
(37, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:47:31', '2021-02-22 03:47:31'),
(38, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:47:46', '2021-02-22 03:47:46'),
(39, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:48:49', '2021-02-22 03:48:49'),
(40, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 03:49:35', '2021-02-22 03:49:35'),
(41, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 03:50:50', '2021-02-22 03:50:50'),
(42, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 03:51:04', '2021-02-22 03:51:04'),
(43, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 03:51:40', '2021-02-22 03:51:40'),
(44, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 03:52:06', '2021-02-22 03:52:06'),
(45, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 03:52:50', '2021-02-22 03:52:50'),
(46, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:53:55', '2021-02-22 03:53:55'),
(47, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-22 03:54:32', '2021-02-22 03:54:32'),
(48, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 03:57:58', '2021-02-22 03:57:58'),
(49, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 03:58:58', '2021-02-22 03:58:58'),
(50, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:05:03', '2021-02-22 04:05:03'),
(51, 'default', 'Added new Generator siugh capacity 300', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:06:00', '2021-02-22 04:06:00'),
(52, 'default', 'Added new vehicle rte1 registration number dfhnj', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:08:18', '2021-02-22 04:08:18'),
(53, 'default', 'Added fuel information of 2021-02-17 for dfsfd', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:08:48', '2021-02-22 04:08:48'),
(54, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:15:04', '2021-02-22 04:15:04'),
(55, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:17:31', '2021-02-22 04:17:31'),
(56, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-22 04:19:18', '2021-02-22 04:19:18'),
(57, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 04:33:37', '2021-02-22 04:33:37'),
(58, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 05:06:24', '2021-02-22 05:06:24'),
(59, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 05:19:29', '2021-02-22 05:19:29'),
(60, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 05:34:40', '2021-02-22 05:34:40'),
(61, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 05:42:45', '2021-02-22 05:42:45'),
(62, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 05:51:18', '2021-02-22 05:51:18'),
(63, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 05:55:01', '2021-02-22 05:55:01'),
(64, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-22 07:55:05', '2021-02-22 07:55:05'),
(65, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 08:13:18', '2021-02-22 08:13:18'),
(66, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 08:13:37', '2021-02-22 08:13:37'),
(67, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 09:24:59', '2021-02-22 09:24:59'),
(68, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 09:26:04', '2021-02-22 09:26:04'),
(69, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 09:27:00', '2021-02-22 09:27:00'),
(70, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 09:30:11', '2021-02-22 09:30:11'),
(71, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 09:34:48', '2021-02-22 09:34:48'),
(72, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-22 09:34:53', '2021-02-22 09:34:53'),
(73, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-22 09:43:41', '2021-02-22 09:43:41'),
(74, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 01:34:49', '2021-02-23 01:34:49'),
(75, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 03:31:15', '2021-02-23 03:31:15'),
(76, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 03:36:04', '2021-02-23 03:36:04'),
(77, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-23 03:44:07', '2021-02-23 03:44:07'),
(78, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 04:09:47', '2021-02-23 04:09:47'),
(79, 'default', 'Added new user Lusubilo Mwakyusa email lusubilo.mwakyusa@gst.go.tz', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 04:12:30', '2021-02-23 04:12:30'),
(80, 'default', 'Deactivated user  Lusubilo Mwakyusa email lusubilo.mwakyusa@gst.go.tz', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 04:13:44', '2021-02-23 04:13:44'),
(81, 'default', 'Activated user  Lusubilo Mwakyusa email lusubilo.mwakyusa@gst.go.tz', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 04:13:59', '2021-02-23 04:13:59'),
(82, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 04:15:08', '2021-02-23 04:15:08'),
(83, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:16:13', '2021-02-23 04:16:13'),
(84, 'default', 'Added new Driver Dusdedit Byaba license number GU67587HJ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:23:44', '2021-02-23 04:23:44'),
(85, 'default', 'Added service information of 2021-02-22 supervised by Bwamwojo', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:27:33', '2021-02-23 04:27:33'),
(86, 'default', 'Edited service information of 2021-02-22 supervised by Bwamwojo', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:28:18', '2021-02-23 04:28:18'),
(87, 'default', 'Added accident record of  dfhnj occurred on 2021-02-21', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:30:06', '2021-02-23 04:30:06'),
(88, 'default', 'Added accident record of  dfhnj occurred on 2021-02-21', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:30:26', '2021-02-23 04:30:26'),
(89, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:31:41', '2021-02-23 04:31:41'),
(90, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 04:32:53', '2021-02-23 04:32:53'),
(91, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:33:39', '2021-02-23 04:33:39'),
(92, 'default', 'Added new asset  Table serial number GST/HQ/200', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:36:51', '2021-02-23 04:36:51'),
(93, 'default', 'Edited asset  Table serial number GST/HQ/200', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:37:13', '2021-02-23 04:37:13'),
(94, 'default', 'Disposed asset  Table', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:38:04', '2021-02-23 04:38:04'),
(95, 'default', 'Added information of received item Laptop on ledger number T001', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:40:58', '2021-02-23 04:40:58'),
(96, 'default', 'Edited information of received item Laptop on ledger number T001', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:41:31', '2021-02-23 04:41:31'),
(97, 'default', 'Edited information of received item Laptop on ledger number T001', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:41:55', '2021-02-23 04:41:55'),
(98, 'default', 'Added new asset  Laptop serial number GST/HQ/INTEL', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:44:56', '2021-02-23 04:44:56'),
(99, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 04:52:39', '2021-02-23 04:52:39'),
(100, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-23 04:55:32', '2021-02-23 04:55:32'),
(101, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 05:02:29', '2021-02-23 05:02:29'),
(102, 'default', 'Added accident record of  dfhnj occurred on 2021-02-21', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 05:02:51', '2021-02-23 05:02:51'),
(103, 'default', 'Edited accident record of  dfhnj occurred on 2021-02-21', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 05:11:12', '2021-02-23 05:11:12'),
(104, 'default', 'Edited accident record of  dfhnj occurred on 2021-02-21', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 05:11:21', '2021-02-23 05:11:21'),
(105, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:22:32', '2021-02-23 05:22:32'),
(106, 'default', 'Added information of received item khui on ledger number khkn', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:28:59', '2021-02-23 05:28:59'),
(107, 'default', 'Edited information of received item ksjdn on ledger number sdf89', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:29:28', '2021-02-23 05:29:28'),
(108, 'default', 'Edited information of received item ksjdn on ledger number sdf89', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:29:58', '2021-02-23 05:29:58'),
(109, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 4, '[]', '2021-02-23 05:31:09', '2021-02-23 05:31:09'),
(110, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 05:31:25', '2021-02-23 05:31:25'),
(111, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:31:46', '2021-02-23 05:31:46'),
(112, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:38:02', '2021-02-23 05:38:02'),
(113, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:51:41', '2021-02-23 05:51:41'),
(114, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:52:15', '2021-02-23 05:52:15'),
(115, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 05:55:21', '2021-02-23 05:55:21'),
(116, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 2, '[]', '2021-02-23 05:55:33', '2021-02-23 05:55:33'),
(117, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 06:05:15', '2021-02-23 06:05:15'),
(118, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 3, '[]', '2021-02-23 06:05:41', '2021-02-23 06:05:41'),
(119, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 06:13:49', '2021-02-23 06:13:49'),
(120, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 06:14:06', '2021-02-23 06:14:06'),
(121, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 06:17:13', '2021-02-23 06:17:13'),
(122, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 06:17:19', '2021-02-23 06:17:19'),
(123, 'default', 'Logged in ', NULL, NULL, 'App\\Models\\User', 1, '[]', '2021-02-23 06:30:11', '2021-02-23 06:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchased_date` date NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiving_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `purchased_date`, `condition`, `serial_number`, `product_number`, `location`, `activity`, `receiving_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'new name', '2021-02-05', 'Used', 'jdb3', 'dsjbv3', 'sadfbh', 'sdhvdbs', NULL, 3, 0, '2021-02-19 06:55:26', '2021-02-22 02:15:38'),
(2, 'dfhsj', '2021-02-11', 'Used', 'sdhb3', 'udbu', 'uwbf3', 'duh3', NULL, 3, 0, '2021-02-19 06:58:00', '2021-02-19 06:58:00'),
(4, 'dsjb', '2021-02-05', 'Refurbished', 'jdsbh', 'udbsfuh', 'ubdhaj', 'udhbfad', NULL, 3, 0, '2021-02-19 07:02:08', '2021-02-19 07:02:08'),
(6, 'skvjdn', '2021-02-12', 'Used', 'dsjbsi', 'sjdbve', 'isdvn', 'shui', NULL, 3, 0, '2021-02-21 23:05:18', '2021-02-21 23:05:18'),
(7, 'Table', '2021-02-01', 'Refurbished', 'GST/HQ/200', 'GST/HQ/TB/44', 'Romm no 3', 'Official', NULL, 3, 1, '2021-02-23 04:36:50', '2021-02-23 04:38:05'),
(8, 'Laptop', '2021-02-05', 'New', 'GST/HQ/INTEL', 'GST/HQ/IT/200', 'Laboratory', 'Data entry', 2, 3, 0, '2021-02-23 04:44:56', '2021-02-23 04:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `disposals`
--

CREATE TABLE `disposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(19,2) NOT NULL,
  `date` date NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disposals`
--

INSERT INTO `disposals` (`id`, `price`, `date`, `asset_id`, `created_at`, `updated_at`, `reason`) VALUES
(1, '150000.00', '2021-02-17', 7, '2021-02-23 04:38:04', '2021-02-23 04:38:04', 'oldish');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `fullname`, `license`, `created_at`, `updated_at`) VALUES
(1, 'Dusdedit Byaba', 'GU67587HJ', '2021-02-23 04:23:44', '2021-02-23 04:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE `fuels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `previous_odometer` int(11) NOT NULL,
  `current_odometer` int(11) NOT NULL,
  `issued` int(11) NOT NULL,
  `requested` int(11) NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `generator_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuels`
--

INSERT INTO `fuels` (`id`, `previous_odometer`, `current_odometer`, `issued`, `requested`, `activity`, `date`, `generator_id`, `vehicle_id`, `created_at`, `updated_at`) VALUES
(1, 4, 33, 4, 44, 'dfsfd', '2021-02-17', NULL, 1, '2021-02-22 04:08:48', '2021-02-22 04:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `generators`
--

CREATE TABLE `generators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `manufacturing_date` date NOT NULL,
  `first_used_date` date NOT NULL,
  `first_odometer` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generators`
--

INSERT INTO `generators` (`id`, `model`, `capacity`, `manufacturing_date`, `first_used_date`, `first_odometer`, `status`, `asset_id`, `created_at`, `updated_at`) VALUES
(1, 'siugh', 300, '2021-02-17', '2021-02-24', 33, 0, 2, '2021-02-22 04:06:00', '2021-02-22 04:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `generator_maintenance`
--

CREATE TABLE `generator_maintenance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `generator_id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generator_service`
--

CREATE TABLE `generator_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `generator_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_text`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Add new accident', 2, '2021-02-23 04:30:06', '2021-02-23 04:30:06'),
(2, 'Add new accident', 2, '2021-02-23 04:30:26', '2021-02-23 04:30:26'),
(3, 'Add new accident', 2, '2021-02-23 05:02:51', '2021-02-23 05:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `previous_odometer` int(11) NOT NULL,
  `current_odometer` int(11) NOT NULL,
  `garage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(19,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `generator_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_vehicle`
--

CREATE TABLE `maintenance_vehicle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_02_084933_create_vehicles_table', 1),
(5, '2021_02_02_085228_create_fuels_table', 1),
(6, '2021_02_02_085527_create_maintenances_table', 1),
(7, '2021_02_02_085549_create_services_table', 1),
(8, '2021_02_02_085614_create_generators_table', 1),
(9, '2021_02_02_085750_create_receivings_table', 1),
(10, '2021_02_02_085942_create_roles_table', 1),
(11, '2021_02_02_090001_create_logs_table', 1),
(12, '2021_02_02_090026_create_disposals_table', 1),
(13, '2021_02_02_090055_create_accidents_table', 1),
(14, '2021_02_02_090225_create_assets_table', 1),
(15, '2021_02_02_091649_create_service_vehicle_table', 1),
(16, '2021_02_02_091904_create_accident_vehicle_table', 1),
(17, '2021_02_02_091948_create_maintenance_vehicle_table', 1),
(18, '2021_02_02_092108_create_generator_service_table', 1),
(19, '2021_02_02_092146_create_generator_maintenance_table', 1),
(20, '2021_02_03_060745_create_drivers_table', 1),
(21, '2021_02_03_091021_add_role_id_as_foreingnkey_to_users', 1),
(22, '2021_02_03_093641_add_foreingnkey_to_table_vehicles', 1),
(23, '2021_02_03_094223_add_foreingnkey_to_table_fuels', 1),
(24, '2021_02_03_094502_add_foreingnkey_to_table_generators', 1),
(25, '2021_02_05_064435_create_sessions_table', 1),
(26, '2021_02_09_131512_add_asset_foregn_to_disposal_column', 1),
(27, '2021_02_10_071658_update_error_message_user_id_for_asset_table', 1),
(28, '2021_02_10_142633_edit_status_field_to_reason_on_disposa_', 1),
(29, '2021_02_14_112316_add_vehicle_and_generator_to_maintenances_', 1),
(30, '2021_02_15_085317_add_vehicle_and_generator_to_services_', 1),
(31, '2021_02_15_115233_add_driverid_to_accidents_table', 1),
(32, '2021_02_16_064754_add_vehicleid_to_accidents_table', 1),
(33, '2021_02_19_075916_create_activity_log_table', 2),
(34, '2021_02_23_081708_add_total_cost_to_receivings_', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dbyabatov@gmail.com', '$2y$10$1jj1kfvC.BJRauz8o8wjxeYPDHV1Ih9IIWQPFRpzbN.vnTVZRMzDq', '2021-02-22 09:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `receivings`
--

CREATE TABLE `receivings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ledger_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_cost` decimal(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receivings`
--

INSERT INTO `receivings` (`id`, `ledger_number`, `item`, `quantity`, `supplier`, `condition`, `cost`, `created_at`, `updated_at`, `total_cost`) VALUES
(1, 'sdf89', 'ksjdn', 1, 'ksdnj', 'Used', '3000.00', '2021-02-22 01:55:57', '2021-02-23 05:29:58', '10.00'),
(2, 'T001', 'Laptop', 2, 'Microsoft', 'New', '1000000.00', '2021-02-23 04:40:58', '2021-02-23 04:41:55', '0.00'),
(3, 'khkn', 'khui', 39, 'kjhoik', 'Used', '3.00', '2021-02-23 05:28:59', '2021-02-23 05:28:59', '90.00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `name_abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Admin', '2021-02-19 04:35:34', '2021-02-19 04:35:34'),
(2, 'Transport Officer', 'TO', '2021-02-19 04:35:34', '2021-02-19 04:35:34'),
(3, 'Procurement Unit', 'PMU', '2021-02-19 04:35:34', '2021-02-19 04:35:34'),
(4, 'Manager', 'MA', '2021-02-19 04:35:34', '2021-02-19 04:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `garage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_odometer` int(11) NOT NULL,
  `next_odometer` int(11) NOT NULL,
  `material` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(19,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `generator_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `garage`, `current_odometer`, `next_odometer`, `material`, `supervisor`, `cost`, `description`, `date`, `created_at`, `updated_at`, `vehicle_id`, `generator_id`) VALUES
(1, 'Manala', 1000, 1600, 'oil break, filter, air creaner and coolant', 'Bwamwojo', '200000.00', 'Oil change and break', '2021-02-22', '2021-02-23 04:27:33', '2021-02-23 04:28:17', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_vehicle`
--

CREATE TABLE `service_vehicle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Joshua', 'Frank', 'Njau', 'josh@gmail.com', NULL, '$2y$10$MrOmafWx0rcaL1oZtbNXgOJC6DQICBBJqMVxrF739roWMhPUGX80.', NULL, 0, 1, '2021-02-19 04:35:35', '2021-02-19 04:35:35'),
(2, 'Tumaini', 'Octavian', 'Timo', 'timo@gmail.com', NULL, '$2y$10$LlOBNZF/kuipvR4zk65BVu9OaEyANswI1n0CXNUr63LSAGhH.gBV.', NULL, 0, 2, '2021-02-19 04:35:35', '2021-02-19 04:35:35'),
(3, 'Deusdedit', 'Mw', 'Byaba', 'dbyabatov@gmail.com', NULL, '$2y$10$nrqgtFsNJGPZY6UAboapQu1bTXnEL/h.hefbOB9oJ38U4p.G/B/Nm', 'XflnpDxhpJm14516z7Sp5B6SGD8ki7vyfMR4XalNzUIeyaSSsYoAUQmxKCTR', 0, 3, '2021-02-19 04:35:35', '2021-02-22 08:13:17'),
(4, 'Mathayo', 'M', 'Mat surname', 'mat@gmail.com', NULL, '$2y$10$zzcTSLWrlPkXubKXNto2ne4prZCFZonuGjks8.YsCOWwI9nlbkuU.', NULL, 0, 4, '2021-02-19 04:35:35', '2021-02-21 23:35:06'),
(5, 'Lusubilo', 'Douglas', 'Mwakyusa', 'lusubilo.mwakyusa@gst.go.tz', NULL, '$2y$10$pcJKoxq5vMNDbaaUjHK/JOG/sUCSN/oEtBSpItzVLPWkGcJGk5BXq', NULL, 0, 4, '2021-02-23 04:12:30', '2021-02-23 04:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reg_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `engine_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chassis_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacturing_date` date NOT NULL,
  `first_used_date` date NOT NULL,
  `first_odometer` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `driver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `reg_number`, `model`, `capacity`, `engine_number`, `chassis_number`, `manufacturing_date`, `first_used_date`, `first_odometer`, `status`, `driver_id`, `asset_id`, `created_at`, `updated_at`) VALUES
(1, 'dfhnj', 'rte1', 33, 'rtre', 'ere', '2021-02-09', '2021-02-17', 55, 0, NULL, 6, '2021-02-22 04:08:17', '2021-02-22 04:08:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accidents`
--
ALTER TABLE `accidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accidents_driver_id_foreign` (`driver_id`),
  ADD KEY `accidents_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `accident_vehicle`
--
ALTER TABLE `accident_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accident_vehicle_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `accident_vehicle_accident_id_foreign` (`accident_id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assets_serial_number_unique` (`serial_number`),
  ADD UNIQUE KEY `assets_product_number_unique` (`product_number`),
  ADD KEY `assets_receiving_id_foreign` (`receiving_id`),
  ADD KEY `assets_user_id_foreign` (`user_id`);

--
-- Indexes for table `disposals`
--
ALTER TABLE `disposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposals_asset_id_foreign` (`asset_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fuels`
--
ALTER TABLE `fuels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuels_generator_id_foreign` (`generator_id`),
  ADD KEY `fuels_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `generators`
--
ALTER TABLE `generators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generators_asset_id_foreign` (`asset_id`);

--
-- Indexes for table `generator_maintenance`
--
ALTER TABLE `generator_maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generator_maintenance_generator_id_foreign` (`generator_id`),
  ADD KEY `generator_maintenance_maintenance_id_foreign` (`maintenance_id`);

--
-- Indexes for table `generator_service`
--
ALTER TABLE `generator_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generator_service_service_id_foreign` (`service_id`),
  ADD KEY `generator_service_generator_id_foreign` (`generator_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenances_generator_id_foreign` (`generator_id`),
  ADD KEY `maintenances_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_vehicle_maintenance_id_foreign` (`maintenance_id`),
  ADD KEY `maintenance_vehicle_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `receivings`
--
ALTER TABLE `receivings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receivings_ledger_number_unique` (`ledger_number`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_abbreviation_unique` (`name_abbreviation`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_generator_id_foreign` (`generator_id`),
  ADD KEY `services_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `service_vehicle`
--
ALTER TABLE `service_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_vehicle_service_id_foreign` (`service_id`),
  ADD KEY `service_vehicle_vehicle_id_foreign` (`vehicle_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_reg_number_unique` (`reg_number`),
  ADD KEY `vehicles_driver_id_foreign` (`driver_id`),
  ADD KEY `vehicles_asset_id_foreign` (`asset_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accidents`
--
ALTER TABLE `accidents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `accident_vehicle`
--
ALTER TABLE `accident_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `disposals`
--
ALTER TABLE `disposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `generators`
--
ALTER TABLE `generators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `generator_maintenance`
--
ALTER TABLE `generator_maintenance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generator_service`
--
ALTER TABLE `generator_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `receivings`
--
ALTER TABLE `receivings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_vehicle`
--
ALTER TABLE `service_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accidents`
--
ALTER TABLE `accidents`
  ADD CONSTRAINT `accidents_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accidents_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `accident_vehicle`
--
ALTER TABLE `accident_vehicle`
  ADD CONSTRAINT `accident_vehicle_accident_id_foreign` FOREIGN KEY (`accident_id`) REFERENCES `accidents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accident_vehicle_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_receiving_id_foreign` FOREIGN KEY (`receiving_id`) REFERENCES `receivings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `disposals`
--
ALTER TABLE `disposals`
  ADD CONSTRAINT `disposals_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fuels`
--
ALTER TABLE `fuels`
  ADD CONSTRAINT `fuels_generator_id_foreign` FOREIGN KEY (`generator_id`) REFERENCES `generators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fuels_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `generators`
--
ALTER TABLE `generators`
  ADD CONSTRAINT `generators_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `generator_maintenance`
--
ALTER TABLE `generator_maintenance`
  ADD CONSTRAINT `generator_maintenance_generator_id_foreign` FOREIGN KEY (`generator_id`) REFERENCES `generators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `generator_maintenance_maintenance_id_foreign` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `generator_service`
--
ALTER TABLE `generator_service`
  ADD CONSTRAINT `generator_service_generator_id_foreign` FOREIGN KEY (`generator_id`) REFERENCES `generators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `generator_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_generator_id_foreign` FOREIGN KEY (`generator_id`) REFERENCES `generators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenances_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maintenance_vehicle`
--
ALTER TABLE `maintenance_vehicle`
  ADD CONSTRAINT `maintenance_vehicle_maintenance_id_foreign` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenances` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_vehicle_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_generator_id_foreign` FOREIGN KEY (`generator_id`) REFERENCES `generators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_vehicle`
--
ALTER TABLE `service_vehicle`
  ADD CONSTRAINT `service_vehicle_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_vehicle_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
