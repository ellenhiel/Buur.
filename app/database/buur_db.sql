-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 08, 2021 at 12:29 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buur_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `listing_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `receiver_id`, `sender_id`, `listing_id`) VALUES
(4, 5, 2, 2),
(7, 2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(255) NOT NULL,
  `chat_id_sender` int(255) NOT NULL,
  `chat_id_receiver` int(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `chat_id_sender`, `chat_id_receiver`, `message`, `time`) VALUES
(1, 1, 2, 'hey heb je die wortelen nog?', '2021-06-01 09:24:13'),
(2, 2, 1, 'Nee ik heb ze zelf opgegeten haha', '2021-06-02 09:24:13'),
(4, 1, 2, 'Alee waarom heb je dit dan niet verwijderd!!', '2021-06-03 09:24:13'),
(5, 2, 1, 'Nog geen tijd gehad trut', '2021-06-03 10:00:00'),
(6, 7, 4, 'hey Thomas heb je die tomaten nog?', '2021-06-02 03:15:13'),
(7, 4, 7, 'Yess zeker! Wanneer kom je erachter?', '2021-06-02 11:00:00'),
(10, 2, 5, 'hey :)', '2021-06-08 12:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `listing_image` varchar(255) NOT NULL,
  `freshness` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `category` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `user_id`, `title`, `listing_image`, `freshness`, `date`, `category`, `longitude`, `latitude`) VALUES
(6, 4, 'vegetables', '2_post_20210601114233.jpg', 59, '2021-06-01 11:42:33', 'groenten', '4.4811461', '51.0376046'),
(8, 4, 'vegetables', '2_post_20210601114233.jpg', 59, '2021-06-01 11:42:33', 'groenten', '4.4811461', '51.0376046'),
(9, 4, 'vegetables', '2_post_20210601114233.jpg', 59, '2021-06-01 11:42:33', 'groenten', '4.4811461', '51.0376046'),
(10, 2, 'nice fruit yes', '2_post_20210531194040.jpg', 74, '2021-05-31 19:40:40', 'fruit', '4.4811461', '51.0376046'),
(12, 2, 'appel cider', '2_post_20210607133535.jpg', 100, '2021-06-07 13:35:35', 'andere', '4.4811461', '51.0376046'),
(15, 2, 'Ananas :)', '2_post_20210607133628.jpg', 31, '2021-06-07 13:36:28', 'fruit', '4.4811461', '51.0376046'),
(16, 2, 'worteltjes', '2_post_20210607133643.jpg', 72, '2021-06-07 13:36:43', 'groenten', '4.4811461', '51.0376046'),
(18, 2, 'Bailey 4 sale', '2_post_20210607142136.jpg', 100, '2021-06-07 14:21:36', 'andere', '4.5151643', '51.0093617'),
(20, 2, 'wortels met loc', '2_post_20210608112555.jpg', 50, '2021-06-08 11:25:55', 'groenten', '4.4738033', '51.0221707');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `premium` int(255) NOT NULL DEFAULT '0',
  `reactions` int(11) NOT NULL DEFAULT '2',
  `products_saved` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profile_picture`, `premium`, `reactions`, `products_saved`) VALUES
(1, 'root', 'root', 'root', 'default.jpg', 0, 0, 0),
(2, 'ellen', '$2y$12$ZgHR/QaqzcruCktLjzhaB.cfSeLKSEiHjNLkM1rlOf63itxWq2YDi', 'ellen', '2_picture_20210602150641.jpg', 0, 1, 6),
(4, 'Eva', '$2y$12$z6v2ayiwS42Jbvln9obdSeSXQHLRxVrxC/JKmzRDnvRHCFpz3lDyy', 'buur@gmail.com', 'default.jpg', 0, 1, 1),
(5, 'Thomas', '$2y$12$Cab8QlTNH4cdI.bZoCb/d.af/lpbz9v4cy3Ei9qWSBtcSV3TFraR6', 'thomas@gmail.com', 'default.jpg', 0, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
