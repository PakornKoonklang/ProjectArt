-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 07:22 PM
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
-- Database: `projectart`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches_subjectm6`
--

CREATE TABLE `branches_subjectm6` (
  `id` int(11) NOT NULL,
  `branches_Id` int(11) NOT NULL,
  `subjectM6_id` int(11) NOT NULL,
  `subject_Multiplier` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `branches_subjectm6`
--

INSERT INTO `branches_subjectm6` (`id`, `branches_Id`, `subjectM6_id`, `subject_Multiplier`) VALUES
(1, 1001, 1, 3),
(2, 1001, 2, 3),
(3, 1001, 3, 4),
(4, 1001, 4, 4),
(5, 1001, 5, 3),
(6, 1001, 6, 4),
(7, 1001, 7, 1),
(8, 1001, 8, 3),
(9, 1001, 9, 1),
(10, 1001, 10, 1),
(11, 1002, 1, 3),
(12, 1002, 2, 3),
(13, 1002, 3, 4),
(14, 1002, 4, 4),
(15, 1002, 5, 1),
(16, 1002, 6, 4),
(17, 1002, 7, 1),
(18, 1002, 8, 3),
(19, 1002, 9, 1),
(20, 1002, 10, 2),
(21, 1003, 1, 2),
(22, 1003, 2, 3),
(23, 1003, 3, 4),
(24, 1003, 4, 4),
(25, 1003, 5, 1.5),
(26, 1003, 6, 4),
(27, 1003, 7, 1.5),
(28, 1003, 8, 3),
(29, 1003, 9, 2.5),
(30, 1003, 10, 1.5),
(31, 1004, 1, 3),
(32, 1004, 2, 3),
(33, 1004, 3, 4),
(34, 1004, 4, 4),
(35, 1004, 5, 4),
(36, 1004, 6, 4),
(37, 1004, 7, 2),
(38, 1004, 8, 3),
(39, 1004, 9, 3),
(40, 1004, 10, 1),
(41, 1005, 1, 4),
(42, 1005, 2, 3),
(43, 1005, 3, 4),
(44, 1005, 4, 4),
(45, 1005, 5, 2),
(46, 1005, 6, 4),
(47, 1005, 7, 2),
(48, 1005, 8, 4),
(49, 1005, 9, 2),
(50, 1005, 10, 2),
(51, 1006, 1, 4),
(52, 1006, 2, 3),
(53, 1006, 3, 4),
(54, 1006, 4, 4),
(55, 1006, 5, 2),
(56, 1006, 6, 4),
(57, 1006, 7, 2),
(58, 1006, 8, 4),
(59, 1006, 9, 3),
(60, 1006, 10, 1),
(61, 1007, 1, 3),
(62, 1007, 2, 3),
(63, 1007, 3, 4),
(64, 1007, 4, 4),
(65, 1007, 5, 2),
(66, 1007, 6, 4),
(67, 1007, 7, 1.5),
(68, 1007, 8, 3),
(69, 1007, 9, 2),
(70, 1007, 10, 2),
(71, 1008, 1, 3),
(72, 1008, 2, 4),
(73, 1008, 3, 4),
(74, 1008, 4, 4),
(75, 1008, 5, 1),
(76, 1008, 6, 4),
(77, 1008, 7, 2),
(78, 1008, 8, 2),
(79, 1008, 9, 2),
(80, 1008, 10, 2),
(81, 1009, 1, 2),
(82, 1009, 2, 2),
(83, 1009, 3, 4),
(84, 1009, 4, 4),
(85, 1009, 5, 4),
(86, 1009, 6, 4),
(87, 1009, 7, 1),
(88, 1009, 8, 3),
(89, 1009, 9, 4),
(90, 1009, 10, 2),
(91, 1010, 1, 2),
(92, 1010, 2, 3),
(93, 1010, 3, 4),
(94, 1010, 4, 4),
(95, 1010, 5, 2),
(96, 1010, 6, 4),
(97, 1010, 7, 1),
(98, 1010, 8, 3),
(99, 1010, 9, 2),
(100, 1010, 10, 1),
(101, 1011, 1, 3),
(102, 1011, 2, 2),
(103, 1011, 3, 4),
(104, 1011, 4, 4),
(105, 1011, 5, 3),
(106, 1011, 6, 4),
(107, 1011, 7, 2),
(108, 1011, 8, 4),
(109, 1011, 9, 2),
(110, 1011, 10, 2),
(111, 1012, 1, 4),
(112, 1012, 2, 3),
(113, 1012, 3, 3),
(114, 1012, 4, 3),
(115, 1012, 5, 2),
(116, 1012, 6, 3),
(117, 1012, 7, 2),
(118, 1012, 8, 4),
(119, 1012, 9, 3),
(120, 1012, 10, 3),
(121, 1013, 1, 2),
(122, 1013, 2, 3),
(123, 1013, 3, 4),
(124, 1013, 4, 4),
(125, 1013, 5, 2),
(126, 1013, 6, 4),
(127, 1013, 7, 1),
(128, 1013, 8, 3),
(129, 1013, 9, 2),
(130, 1013, 10, 2),
(131, 1014, 1, 3),
(132, 1014, 2, 2.5),
(133, 1014, 3, 4),
(134, 1014, 4, 4),
(135, 1014, 5, 4),
(136, 1014, 6, 4),
(137, 1014, 7, 1),
(138, 1014, 8, 3),
(139, 1014, 9, 2.5),
(140, 1014, 10, 1),
(141, 1015, 1, 3),
(142, 1015, 2, 3),
(143, 1015, 3, 4),
(144, 1015, 4, 4),
(145, 1015, 5, 4),
(146, 1015, 6, 4),
(147, 1015, 7, 3),
(148, 1015, 8, 3),
(149, 1015, 9, 3),
(150, 1015, 10, 1),
(151, 1016, 1, 3),
(152, 1016, 2, 2),
(153, 1016, 3, 4),
(154, 1016, 4, 4),
(155, 1016, 5, 3.5),
(156, 1016, 6, 4),
(157, 1016, 7, 2),
(158, 1016, 8, 3),
(159, 1016, 9, 4),
(160, 1016, 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches_subjectm6`
--
ALTER TABLE `branches_subjectm6`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches_subjectm6`
--
ALTER TABLE `branches_subjectm6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
