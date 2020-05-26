-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2020 at 06:24 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-12+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id9859882_saar`
--

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `thread_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thread_body` text NOT NULL,
  `thread_imgs` varchar(250) NOT NULL,
  `upvotes_ids` varchar(250) NOT NULL,
  `downvotes_ids` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL DEFAULT 'Shweta Gupta',
  `user_img` varchar(250) DEFAULT 'https://saar.iitp.ac.in/img/female.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `post_id`, `thread_time`, `thread_body`, `thread_imgs`, `upvotes_ids`, `downvotes_ids`, `user_id`, `user_name`, `user_img`) VALUES
(3, 3, '2019-12-24 09:00:31', 'Some', 'a:0:{}', 'a:0:{}', 'a:1:{i:0;s:2:\"20\";}', 2, 'Shweta Gupta', 'https://saar.iitp.ac.in/img/female.png'),
(32, 3, '2020-04-12 11:49:58', 'new comment', 'a:0:{}', 'a:0:{}', 'a:0:{}', 20, 'Pranay Gupta', 'https://saar-server.000webhostapp.com/images/profile_images/default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
