-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 11:31 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(191) DEFAULT NULL,
  `gender` enum('F','M') NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `phone` varchar(16) NOT NULL,
  `decision_number` varchar(50) DEFAULT NULL,
  `employee_status` varchar(50) DEFAULT NULL,
  `position_id` int(5) NOT NULL,
  `last_diploma` varchar(50) NOT NULL,
  `last_diploma_year` year(4) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `state` enum('0','1') DEFAULT '1',
  `role_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `gender`, `birth_place`, `birth_date`, `photo`, `address`, `nip`, `nik`, `phone`, `decision_number`, `employee_status`, `position_id`, `last_diploma`, `last_diploma_year`, `description`, `state`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 'Lorem', 'Ipsum', 'lorem@gmail.com', '$2y$10$lSSSxOLfHwOh42ofUdHqke5t6v5RyyvgX7tyF4ug.PbVy6cWeENy.', 'e5F0l6gprjzNiITePsJDtAZSSGmkaI38f8GtV1WNH6VvzuxtFqyFpguQr6fb', 'M', 'Indonesia', '2000-01-01', '1603664532_5f95fa947d556.png', 'Cirebon', NULL, NULL, '09812312312', 'Test', 'GTT', 4, 'S1 Teknik Infomatika', 2020, NULL, '1', 2, '2020-10-21 13:34:06', '2020-10-25 15:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(5) NOT NULL,
  `menu_name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(50) DEFAULT NULL,
  `groupmenu` int(11) DEFAULT NULL,
  `ordinal` int(11) NOT NULL,
  `state` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `link`, `icon`, `groupmenu`, `ordinal`, `state`) VALUES
(2, 'Pengaturan', '#', 'fa fa-cogs', NULL, 99, '1'),
(3, 'Menu', 'menu', NULL, 2, 4, '1'),
(4, 'Permission', 'permission', NULL, 2, 5, '1'),
(5, 'Role', 'role', NULL, 2, 3, '1'),
(6, 'Opsi Tema', 'customize-theme', NULL, 2, 100, '1'),
(7, 'Identitas Situs', 'site-identity', NULL, 2, 99, '1'),
(8, 'Data', '#', 'fa fa-table', NULL, 7, '1'),
(9, 'Pegawai', 'employee', NULL, 8, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `menu_role_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`menu_role_id`, `role_id`, `menu_id`) VALUES
(32, 2, 8),
(33, 2, 9),
(34, 2, 2),
(35, 2, 5),
(36, 2, 3),
(37, 2, 4),
(38, 2, 7),
(39, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(10) NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `menu_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`, `menu_id`) VALUES
(1, 'create-menu', 3),
(3, 'edit-menu', 3),
(5, 'delete-menu', 3),
(6, 'create-permission', 4),
(7, 'edit-permission', 4),
(8, 'delete-permission', 4),
(9, 'create-role', 5),
(10, 'edit-role', 5),
(11, 'delete-role', 5);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_role_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `permission_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_role_id`, `role_id`, `permission_id`) VALUES
(61, 2, 9),
(62, 2, 11),
(63, 2, 10),
(64, 2, 1),
(65, 2, 5),
(66, 2, 3),
(67, 2, 6),
(68, 2, 8),
(69, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(10) NOT NULL,
  `position_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`) VALUES
(2, 'Guru'),
(3, 'Kepala Sekolah'),
(4, 'Administrasi'),
(5, 'Kepala Tata Usaha'),
(6, 'Kepala Tata Usaha'),
(7, 'Kearsipan'),
(8, 'Keuangan'),
(9, 'Kepala Perpustakaan'),
(10, 'Umum'),
(11, 'Pustakawan'),
(12, 'Kebersihan'),
(13, 'Security'),
(14, 'Supir');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(45) NOT NULL,
  `state` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `state`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', '1', '2020-10-20 11:26:59', '2020-10-20 11:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

CREATE TABLE `site_options` (
  `option_id` int(10) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_value` text NOT NULL,
  `autoload` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'sitename', 'Laravel Starter', 'yes'),
(4, 'customize_themes', '{\"body\":\"sidebar-mini layout-fixed layout-navbar-fixed\",\"brand_link\":\"brand-link navbar-light text-dark\",\"main-footer\":\"main-footer\",\"main-header\":\"main-header navbar navbar-expand navbar-white navbar-light\",\"main-sidebar\":\"main-sidebar sidebar-dark-primary elevation-4\",\"nav-sidebar\":\"nav nav-pills nav-sidebar flex-column text-sm\"}', 'yes'),
(5, 'sitelogo', '1603664678_5f95fb267cba4.png', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`menu_role_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_role_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `site_options`
--
ALTER TABLE `site_options`
  ADD PRIMARY KEY (`option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `menu_role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `permission_role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_options`
--
ALTER TABLE `site_options`
  MODIFY `option_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
