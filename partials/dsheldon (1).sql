-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2019 at 02:54 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsheldon`
--
CREATE DATABASE IF NOT EXISTS `dsheldon` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dsheldon`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(32) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `img` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `bio`, `img`, `email`, `password`) VALUES
(26, 'first', 'last', '', 'images/uploads/profile/_1561394914_ggc.jpg', 'email@email.com', '601f1889667efaebb33b8c12572835da3f027f78'),
(27, 'first', 'last', '', 'images/uploads/profile/_1561394958_ggc.jpg', 'email2@email.com', '601f1889667efaebb33b8c12572835da3f027f78');

-- --------------------------------------------------------

--
-- Table structure for table `user_blocked_videos`
--

CREATE TABLE `user_blocked_videos` (
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_rating_videos`
--

CREATE TABLE `user_rating_videos` (
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `youtube_id` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2550) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `total_rating_count` int(11) NOT NULL DEFAULT '0',
  `total_rating` int(11) NOT NULL DEFAULT '0',
  `average_rating` float NOT NULL DEFAULT '0',
  `user_upload_id` int(11) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `youtube_id`, `title`, `description`, `img`, `category`, `total_rating_count`, `total_rating`, `average_rating`, `user_upload_id`, `video_link`) VALUES
(1, 'ddzU-rkzKF0', 'Lava flows in Pahoa - Eruption Update', 'This video was made to show at the Pahoa Transfer Station for schoolchildren visiting to see the new lava flows. It gives a brief history of what happened up ...', 'https://i.ytimg.com/vi/ddzU-rkzKF0/default.jpg', NULL, 3, 11, 3.2, NULL, NULL),
(2, 'ArCmxNkU4YA', 'Coke Can on HOT LAVA Test', 'This is what happens when you put a can of Coca Cola on Subscribe to TheHub http://goo.gl/87YJzG Sources: Coke Lava - lavapix: ...', 'https://i.ytimg.com/vi/ArCmxNkU4YA/default.jpg', NULL, 0, 0, 2.7, NULL, NULL),
(3, 'Zf4wKY8PJtg', 'Exploring Lava Flows in Hawaii', 'Jeri visits a live lava flow in Hawaii.', 'https://i.ytimg.com/vi/Zf4wKY8PJtg/default.jpg', NULL, 0, 0, 0.65, NULL, NULL),
(4, '6J6X9PsAR5w', 'Rivers of molten lava high up Pulama Pali - Kilauea Volcano Hawaii', 'A surge of lava spews out of a rupture in the lava tube system and is heading down steep cliffs, or pali in Hawaiian. This strong flow is being supplied lava from ...', 'https://i.ytimg.com/vi/6J6X9PsAR5w/default.jpg', NULL, 0, 0, 4.4, NULL, NULL),
(5, 'JG9UzR1gHT0', 'Cooking with Lava', 'Cooking with Lava Set-up as part of the Syracuse University Lava Project, this cook-off was a collaboration with experimental UK chef Sam Bompas and the ...', 'https://i.ytimg.com/vi/JG9UzR1gHT0/default.jpg', NULL, 0, 0, 4.45, NULL, NULL),
(6, 'mIETUy5N3x4', 'Pouring lava in my pool!', 'Go to https://wix.com/backyard to get started on your no cost Wix website today -- maybe it\'s for a science fair, resume, or portfolio! And check out my Wix website ...', 'https://i.ytimg.com/vi/mIETUy5N3x4/default.jpg', NULL, 0, 0, 2.45, NULL, NULL),
(7, '33Mtww-fogk', 'EXPERIMENT: LAVA vs DRY ICE!', 'EXPERIMENT LAVA vs DRY ICE ! In this video i\'m pouring lava on dry ice. The lava is 1400C° and the Dry Ice is -78C° Enjoy !! contact me ...', 'https://i.ytimg.com/vi/33Mtww-fogk/default.jpg', NULL, 0, 0, 4.45, NULL, NULL),
(8, 'K5vEYlafhk8', 'BOWLING BALL vs LAVA!', 'Hello everyone ! In this video i\'m pouring a BALL of LAVA on a BOWLING BALL. First i shredded the lava rocks in my shredding machine to be able to fit more of ...', 'https://i.ytimg.com/vi/K5vEYlafhk8/default.jpg', NULL, 0, 0, 0.25, NULL, NULL),
(9, 'jB9qwLWmaqg', 'EXPERIMENT: LAVA vs CHICKEN', 'SOME IDEAS, AND EXPERIMENTS CAN BE DANGEROUS. AND FOR THAT YOU DON\'T RISK AND DAMAGE YOURSELF AND THE ENVIRONMENT, I COME ...', 'https://i.ytimg.com/vi/jB9qwLWmaqg/default.jpg', NULL, 0, 0, 3.85, NULL, NULL),
(10, 'MgBPQbXqN6c', 'Raw: Lava Flows From Russian Volcano', 'A volcano is continuing to erupt in Russia\'s Far East, sending plumes of gas and ash into the sky. The Plosky Tolbachik volcano started erupting in November ...', 'https://i.ytimg.com/vi/MgBPQbXqN6c/default.jpg', NULL, 0, 0, 0.45, NULL, NULL),
(11, 'NIWlA7ndAlw', 'What is Lava? Hawaiian Volcanoes Molten Lava Flow', 'Video footage shows rivers of molten lava flowing to the sea. The difference between magma and lava is explained along with scenes showing geologist ...', 'https://i.ytimg.com/vi/NIWlA7ndAlw/default.jpg', NULL, 0, 0, 4.7, NULL, NULL),
(12, 'KEs-SKB9YFk', 'Lava - Piano Tutorial', 'How to play the song Lava, from the Pixar short film of the same name, on piano. The original song is performed by Kuana Torres Kahele, Napua Greig, James ...', 'https://i.ytimg.com/vi/KEs-SKB9YFk/default.jpg', NULL, 0, 0, 2, NULL, NULL),
(13, 'PNIVsix3Gxc', 'Lava Flowing Into Ocean Hawaii With Relax Sounds', 'lava flowing into ocean of Hawaii with relaxing and sooth sounds. The lava falling into the ocean is for visual purpose only. Share or Send This Video To 1 or 2 ...', 'https://i.ytimg.com/vi/PNIVsix3Gxc/default.jpg', NULL, 0, 0, 4.75, NULL, NULL),
(14, 'OahbPn7El7k', 'Lava iris 80 frp / google account bypass without pc,thegsm solve', 'Lava iris 88 / iris 65 / z90 frp / google account bypass without pc,thegsm solve By this process you can remove google account, FRP .For this process you can ...', 'https://i.ytimg.com/vi/OahbPn7El7k/default.jpg', NULL, 0, 0, 0.45, NULL, NULL),
(15, 'lAiIrKTWVKw', 'Archer Lava - Rich country | Stick War Legacy', 'Help me get 100000 SUBSCRIBE. Thanks! ♥ ➤ SUBSCRIBE: http://bit.ly/ShadowCH ➤ SUBSCRIBE: http://bit.ly/Game_Android ...', 'https://i.ytimg.com/vi/lAiIrKTWVKw/default.jpg', NULL, 0, 0, 3.45, NULL, NULL),
(16, 'XS-59dxplXo', 'Don&#39;t Drop Your iPhone 6S in Hot Lava!', 'Sign up at https://www.fanduel.com/techrax and use the promo code: TECHRAX for a deposit match up to $200. What happens if you drop your rose gold iPhone ...', 'https://i.ytimg.com/vi/XS-59dxplXo/default.jpg', NULL, 0, 0, 3.75, NULL, NULL),
(17, 'c2N-x847QYs', 'Lava Z81 vs Vivo Y91i Unboxing,Review,Compare + Faceunlock and Camera test in Hindi', 'hello friends today we unboxing lava z81 and vivo y91i smart phones and camera test selfie test and face unlock asha karta hu video aapke kuch kaam aayegi.', 'https://i.ytimg.com/vi/c2N-x847QYs/default.jpg', NULL, 0, 0, 4.15, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_blocked_videos`
--
ALTER TABLE `user_blocked_videos`
  ADD KEY `user_blocked_videos_ibfk_1` (`user_id`),
  ADD KEY `user_blocked_videos_ibfk_2` (`video_id`);

--
-- Indexes for table `user_rating_videos`
--
ALTER TABLE `user_rating_videos`
  ADD KEY `user_rating_videos_ibfk_1` (`user_id`),
  ADD KEY `user_rating_videos_ibfk_2` (`video_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_upload_id` (`user_upload_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_blocked_videos`
--
ALTER TABLE `user_blocked_videos`
  ADD CONSTRAINT `user_blocked_videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_blocked_videos_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_rating_videos`
--
ALTER TABLE `user_rating_videos`
  ADD CONSTRAINT `user_rating_videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rating_videos_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`user_upload_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
