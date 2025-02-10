-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2025 at 12:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sc_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `category`, `subcategory`, `description`, `file_path`, `created_at`) VALUES
(5, 'file upload pdf terbaru tentang html', 'Tech', '', 'Descripti isi file upload pdf terbaru tentang html', '1739183314_24cce0a283cf46ebea6d.pdf', '2025-02-10 10:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `telp` varchar(225) NOT NULL,
  `city` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `link` varchar(225) NOT NULL,
  `forgot_password` varchar(225) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `img` varchar(225) NOT NULL,
  `commision` int(11) NOT NULL,
  `withdrawl` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `created_at` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `telp`, `city`, `password`, `link`, `forgot_password`, `role_id`, `is_active`, `img`, `commision`, `withdrawl`, `point`, `created_at`) VALUES
(2, 'Ravenero', 'ravenero94@gmail.com', '112', 'Jakarta', '$2y$10$SBRUlvlmb/8nIVwVdrdEFOaTE2.Tty9INDiVXORQscCYF/q2xLy7a', '', '', 1, 1, 'default.svg', 0, 0, 0, '2021-07-21'),
(3, 'bambang123', 'bambangrahmat@gmail.com', '082169419613', 'Bandung', '$2y$10$SBRUlvlmb/8nIVwVdrdEFOaTE2.Tty9INDiVXORQscCYF/q2xLy7a', '842053', '', 0, 1, '1730518877_047861fac0e80c7da320.jpg', 0, 0, 0, '2024-10-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
