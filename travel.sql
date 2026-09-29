-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 01:59 PM
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
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_ID` int(11) NOT NULL,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_ID`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'ad.min@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL,
  `type` enum('province','place','country','budget','food','relation') NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `value`, `type`, `valid`) VALUES
(2, 'Abra', 'province', 1),
(3, 'Agusan del Norte', 'province', 1),
(4, 'Agusan del Sur', 'province', 1),
(5, 'Aklan', 'province', 1),
(6, 'Albay', 'province', 1),
(7, 'Antique', 'province', 1),
(8, 'Apayao', 'province', 1),
(9, 'Aurora', 'province', 1),
(10, 'Basilan', 'province', 1),
(11, 'Bataan', 'province', 1),
(12, 'Batanes', 'province', 1),
(13, 'Batangas', 'province', 1),
(14, 'Benguet', 'province', 1),
(15, 'Biliran', 'province', 1),
(16, 'Bohol', 'province', 1),
(17, 'Bukidnon', 'province', 1),
(18, 'Bulacan', 'province', 1),
(19, 'Cagayan', 'province', 1),
(20, 'Camarines Norte', 'province', 1),
(21, 'Camarines Sur', 'province', 1),
(22, 'Camiguin', 'province', 1),
(23, 'Capiz', 'province', 1),
(24, 'Catanduanes', 'province', 1),
(25, 'Cavite', 'province', 1),
(26, 'Cebu', 'province', 1),
(27, 'Cotabato (North Cotabato)', 'province', 1),
(28, 'Davao de Oro (formerly Compostela Valley)', 'province', 1),
(29, 'Davao del Norte', 'province', 1),
(30, 'Davao del Sur', 'province', 1),
(31, 'Davao Occidental', 'province', 1),
(32, 'Davao Oriental', 'province', 1),
(33, 'Dinagat Islands', 'province', 1),
(34, 'Eastern Samar', 'province', 1),
(35, 'Guimaras', 'province', 1),
(36, 'Ifugao', 'province', 1),
(37, 'Ilocos Norte', 'province', 1),
(38, 'Ilocos Sur', 'province', 1),
(39, 'Iloilo', 'province', 1),
(40, 'Isabela', 'province', 1),
(41, 'Kalinga', 'province', 1),
(42, 'La Union', 'province', 1),
(43, 'Laguna', 'province', 1),
(44, 'Lanao del Norte', 'province', 1),
(45, 'Lanao del Sur', 'province', 1),
(46, 'Leyte', 'province', 1),
(47, 'Maguindanao del Norte', 'province', 1),
(48, 'Maguindanao del Sur', 'province', 1),
(49, 'Marinduque', 'province', 1),
(50, 'Masbate', 'province', 1),
(51, 'Misamis Occidental', 'province', 1),
(52, 'Misamis Oriental', 'province', 1),
(53, 'Mountain Province', 'province', 1),
(54, 'Negros Occidental', 'province', 1),
(55, 'Negros Oriental', 'province', 1),
(56, 'Northern Samar', 'province', 1),
(57, 'Nueva Ecija', 'province', 1),
(58, 'Nueva Vizcaya', 'province', 1),
(59, 'Occidental Mindoro', 'province', 1),
(60, 'Oriental Mindoro', 'province', 1),
(61, 'Palawan', 'province', 1),
(62, 'Pampanga', 'province', 1),
(63, 'Pangasinan', 'province', 1),
(64, 'Quezon', 'province', 1),
(65, 'Quirino', 'province', 1),
(66, 'Rizal', 'province', 1),
(67, 'Romblon', 'province', 1),
(68, 'Samar (Western Samar)', 'province', 1),
(69, 'Sarangani', 'province', 1),
(70, 'Siquijor', 'province', 1),
(71, 'Sorsogon', 'province', 1),
(72, 'South Cotabato', 'province', 1),
(73, 'Southern Leyte', 'province', 1),
(74, 'Sultan Kudarat', 'province', 1),
(75, 'Sulu', 'province', 1),
(76, 'Surigao del Norte', 'province', 1),
(77, 'Surigao del Sur', 'province', 1),
(78, 'Tarlac', 'province', 1),
(79, 'Tawi-Tawi', 'province', 1),
(80, 'Zambales', 'province', 1),
(81, 'Zamboanga del Norte', 'province', 1),
(82, 'Zamboanga del Sur', 'province', 1),
(83, 'Zamboanga Sibugay', 'province', 1),
(84, 'Abra', 'province', 1),
(85, 'Agusan del Norte', 'province', 1),
(86, 'Agusan del Sur', 'province', 1),
(87, 'Aklan', 'province', 1),
(88, 'Albay', 'province', 1),
(89, 'Antique', 'province', 1),
(90, 'Apayao', 'province', 1),
(91, 'Aurora', 'province', 1),
(92, 'Basilan', 'province', 1),
(93, 'Bataan', 'province', 1),
(94, 'Batanes', 'province', 1),
(95, 'Batangas', 'province', 1),
(96, 'Benguet', 'province', 1),
(97, 'Biliran', 'province', 1),
(98, 'Bohol', 'province', 1),
(99, 'Bukidnon', 'province', 1),
(100, 'Bulacan', 'province', 1),
(101, 'Cagayan', 'province', 1),
(102, 'Camarines Norte', 'province', 1),
(103, 'Camarines Sur', 'province', 1),
(104, 'Camiguin', 'province', 1),
(105, 'Capiz', 'province', 1),
(106, 'Catanduanes', 'province', 1),
(107, 'Cavite', 'province', 1),
(108, 'Cebu', 'province', 1),
(109, 'Cotabato (North Cotabato)', 'province', 1),
(110, 'Davao de Oro (formerly Compostela Valley)', 'province', 1),
(111, 'Davao del Norte', 'province', 1),
(112, 'Davao del Sur', 'province', 1),
(113, 'Davao Occidental', 'province', 1),
(114, 'Davao Oriental', 'province', 1),
(115, 'Dinagat Islands', 'province', 1),
(116, 'Eastern Samar', 'province', 1),
(117, 'Guimaras', 'province', 1),
(118, 'Ifugao', 'province', 1),
(119, 'Ilocos Norte', 'province', 1),
(120, 'Ilocos Sur', 'province', 1),
(121, 'Iloilo', 'province', 1),
(122, 'Isabela', 'province', 1),
(123, 'Kalinga', 'province', 1),
(124, 'La Union', 'province', 1),
(125, 'Laguna', 'province', 1),
(126, 'Lanao del Norte', 'province', 1),
(127, 'Lanao del Sur', 'province', 1),
(128, 'Leyte', 'province', 1),
(129, 'Maguindanao del Norte', 'province', 1),
(130, 'Maguindanao del Sur', 'province', 1),
(131, 'Marinduque', 'province', 1),
(132, 'Masbate', 'province', 1),
(133, 'Misamis Occidental', 'province', 1),
(134, 'Misamis Oriental', 'province', 1),
(135, 'Mountain Province', 'province', 1),
(136, 'Negros Occidental', 'province', 1),
(137, 'Negros Oriental', 'province', 1),
(138, 'Northern Samar', 'province', 1),
(139, 'Nueva Ecija', 'province', 1),
(140, 'Nueva Vizcaya', 'province', 1),
(141, 'Occidental Mindoro', 'province', 1),
(142, 'Oriental Mindoro', 'province', 1),
(143, 'Palawan', 'province', 1),
(144, 'Pampanga', 'province', 1),
(145, 'Pangasinan', 'province', 1),
(146, 'Quezon', 'province', 1),
(147, 'Quirino', 'province', 1),
(148, 'Rizal', 'province', 1),
(149, 'Romblon', 'province', 1),
(150, 'Samar (Western Samar)', 'province', 1),
(151, 'Sarangani', 'province', 1),
(152, 'Siquijor', 'province', 1),
(153, 'Sorsogon', 'province', 1),
(154, 'South Cotabato', 'province', 1),
(155, 'Southern Leyte', 'province', 1),
(156, 'Sultan Kudarat', 'province', 1),
(157, 'Sulu', 'province', 1),
(158, 'Surigao del Norte', 'province', 1),
(159, 'Surigao del Sur', 'province', 1),
(160, 'Tarlac', 'province', 1),
(161, 'Tawi-Tawi', 'province', 1),
(162, 'Zambales', 'province', 1),
(163, 'Zamboanga del Norte', 'province', 1),
(164, 'Zamboanga del Sur', 'province', 1),
(165, 'Zamboanga Sibugay', 'province', 1),
(166, 'Resort', 'place', 1),
(167, 'Pool', 'place', 1),
(168, 'Private Pool', 'place', 1),
(169, 'Waterfall', 'place', 1),
(170, 'Museum', 'place', 1),
(171, 'Beach', 'place', 1),
(172, 'Park', 'place', 1),
(173, 'Mountain', 'place', 1),
(174, 'Zoo', 'place', 1),
(175, 'Amusement Park', 'place', 1),
(176, 'Botanical Garden', 'place', 1),
(177, 'Historical Site', 'place', 1),
(178, 'Cultural Center', 'place', 1),
(179, 'Wildlife Sanctuary', 'place', 1),
(180, 'Aquarium', 'place', 1),
(181, 'Camping Site', 'place', 1),
(182, 'Hiking Trail', 'place', 1),
(183, 'Adventure Park', 'place', 1),
(184, 'Lake', 'place', 1),
(185, 'Island', 'place', 1),
(186, 'Spa', 'place', 1),
(187, 'Hot Spring', 'place', 1),
(188, 'Casino', 'place', 1),
(189, 'Golf Course', 'place', 1),
(190, 'Theater', 'place', 1),
(191, 'Art Gallery', 'place', 1),
(192, 'Shopping Mall', 'place', 1),
(193, 'Night Market', 'place', 1),
(194, 'Farm', 'place', 1),
(195, 'Vineyard', 'place', 1),
(196, 'Food Park', 'place', 1),
(197, 'Festival Grounds', 'place', 1),
(198, 'Philippines', 'country', 1),
(199, '0', 'budget', 1);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `user_id`, `name`, `type`, `location`, `description`, `date`, `created_at`) VALUES
(1, 1, 'Baluarte Zoo', 'Zoo', 'Located in Vigan, Ilocos Sur, near the Vigan City Heritage Village.', 'Baluarte Zoo is a popular destination known for its free admission and animal interactions. Owned by local politician Chavit Singson, the zoo features a variety of animals, botanical gardens, and live shows. Its proximity to the historic Vigan makes it a convenient and enjoyable stop for visitors.', '2025-01-30', '2025-01-06 20:54:35'),
(6, 1, 'Five Fingers Cove (Lusong Beach)', 'Beach and Camping Site', 'Located in Mariveles, Bataan, known for its rugged coastline and scenic landscapes.', 'Five Fingers Cove is a hidden paradise ideal for adventure seekers and nature lovers. Its distinct rock formations and clear waters are perfect for snorkeling, while the surrounding lushness invites hikers. With camping spots available, it accommodates around 100 guests. The budget-friendly camping experience is approximately 1000 PHP for two, offering simple and beautiful connections with nature.', '2025-02-20', '2025-01-06 22:53:44'),
(8, 1, 'Caunayan Falls', 'Nature Park', 'Located in San Luis, Aurora, surrounded by lush forests and near Aurora’s famous water systems.', 'Caunayan Falls offers a refreshing nature escape with its cascading waterfalls and natural swimming pools. Visitors can enjoy a relaxing day amidst vibrant flora and fauna, making it ideal for relaxation and exploration. The park comfortably accommodates up to a dozen visitors, with a budget range of 1,500 to 3,000 PHP for entrance and transport.', '2025-02-11', '2025-01-06 23:44:42'),
(9, 1, 'Bataan World War II Museum', 'Museum', 'Located in Balanga City, near the Bataan Peninsula State University, and close to Balanga Cathedral.', 'The Bataan World War II Museum offers a poignant remembrance of history, showcasing artifacts, photographs, and memorabilia from the war period. Visitors can explore interactive exhibits and hear stories of bravery and sacrifice. It is able to accommodate a medium-sized group of around 30 people. Visitors can expect to spend approximately 100 PHP per person.', '2025-01-20', '2025-01-06 23:54:05'),
(10, 1, 'Thunderbird Resort Poro Point', 'Resort', 'San Fernando, La Union, near the historic Poro Point Lighthouse and scenic beaches.', 'Thunderbird Resort Poro Point offers a luxurious Mediterranean-inspired setting with private pool villas and breathtaking views of the South China Sea. Perfect for a serene getaway, the resort provides exclusive amenities including a golf course and access to a private beach. It can accommodate up to 100 guests, but smaller villas perfect for groups of 3 start at approximately 5,000 PHP per night.', '2025-01-10', '2025-01-07 04:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `valid`) VALUES
(1, 'user', 'user', 'us.er@gmail.com', 1),
(2, 'test', 'test', 'test@test.com', 1),
(3, 'testing', 'testing', 'testing@testing.com', 1),
(4, 'testing', 'testing', 'testing@testing.com', 1),
(5, 'dan', 'dan', 'dan@dan.com', 1),
(6, 'calapit', 'calapit1234', 'calapitb@yahoo.com', 1),
(7, 'marlumbre', 'MarlonGALA.AI1474', 'marlonki8l@gmail.com', 1),
(8, 'rence', 'user', 'clarence.victorio.5@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_ID`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
