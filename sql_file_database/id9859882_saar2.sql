-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2020 at 06:47 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `alumnus`
--

CREATE TABLE `alumnus` (
  `id` int(11) NOT NULL,
  `rollno` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fb_link` varchar(250) NOT NULL,
  `linkedin_link` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `graduation_year` year(4) NOT NULL,
  `degree` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `employment_type` varchar(100) NOT NULL,
  `present_employer` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `achievements` text NOT NULL,
  `verification_code` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `img_url` varchar(250) NOT NULL DEFAULT 'https://saar-server.000webhostapp.com/images/profile_images/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnus`
--

INSERT INTO `alumnus` (`id`, `rollno`, `first_name`, `last_name`, `email`, `phone`, `fb_link`, `linkedin_link`, `password`, `dob`, `graduation_year`, `degree`, `department`, `employment_type`, `present_employer`, `designation`, `address`, `country`, `state`, `city`, `achievements`, `verification_code`, `active`, `img_url`) VALUES
(6, '1801me07', 'Amartya', 'Mondal', 'qwerty@gmail.com', '8967570983', '', '', 'f181c50384d8adc56a0ff990d33568f686059c87', '4/1/2000', 2012, 'B.Tech.', 'Mechanical Engineering', 'Entrepreneur', 'DSC', 'Lead', 'Durgapur', 'India', 'West Bengal', 'Durgapur', 'GSOC', '34379', 1, 'https://saar-server.000webhostapp.com/images/profile_images/1801me07.jpg'),
(18, '1801cs50', 'Somenath ', 'Sarkar ', 'somenath1435@gmail.com', '8013054710', '', '', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', '14/9/1998', 2018, 'B.Tech.', 'Computer Science and Engineering', 'Entrepreneur', '', '', '', '', '', '', '', '12157', 1, 'https://saar-server.000webhostapp.com/images/profile_images/1801cs50.jpg'),
(19, '1801cs34', 'Oindrila', 'Bhadra', 'oindrilabhadra78@gmail.com', '9903465850', '', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7/8/1999', 2012, 'B.Tech.', 'Computer Science and Engineering', 'Salaried', '', '', '', '', '', '', '', '20886', 1, 'https://saar-server.000webhostapp.com/images/profile_images/default.png'),
(20, '1801cs38', 'Pranay', 'Gupta', 'pranaykgupta21@gmail.com', '9354008441', '', '', '27ef3de6bdd6ec7dff3a5e67ae23fbe17a5cc7fe', '2001-08-21', 2022, 'B.Tech', 'CSE', 'job', 'Kuch hbhi man lo', 'ceo', 'P-2 / 3 , Budh Vihar, Phase-1 , Delhi 110086', 'India', 'Delhi', 'New Delhi', 'none', '43018', 1, 'https://saar-server.000webhostapp.com/images/profile_images/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `weight` int(11) NOT NULL,
  `cat_posts` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `images` varchar(250) NOT NULL,
  `thread_ids` varchar(250) DEFAULT NULL,
  `upvotes_ids` varchar(250) DEFAULT NULL,
  `downvotes_ids` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `cat_id`, `post_time`, `title`, `body`, `images`, `thread_ids`, `upvotes_ids`, `downvotes_ids`) VALUES
(3, 1, 2, '2019-12-17 12:50:18', 'HOw are you', 'hi', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(4, 1, 2, '2019-12-24 15:52:31', 'this is title', 'this is body', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(5, 1, 2, '2019-12-24 15:52:31', 'this is title', 'this is body', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(6, 1, 2, '2019-12-24 15:52:31', 'this is title', 'this is body', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(10, 4, 2, '2019-12-24 16:19:21', 'Last Block', 'last content', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(11, 2, 23, '2019-12-25 17:31:35', 'fdls', 'jlfksj', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(12, 2, 3, '2019-12-25 17:32:06', 'rats in the house', 'a lots of rats have breaked into my house', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(13, 2, 23, '2019-12-25 17:33:04', 'cat ', 'cat in the house', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(14, 2, 12, '2019-12-25 17:37:04', 'qwerty', 'qwerty', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(19, 2, 2, '2019-12-25 17:43:46', 'hilake', 'milake', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(20, 2, 3, '2019-12-25 17:44:01', 'heat', 'cold', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(22, 2, 3, '2019-12-25 17:45:31', 'New post', 'body', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(24, 2, 3, '2019-12-25 17:47:57', 'happy', 'merry christmas', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(30, 2, 56, '2019-12-26 14:47:50', 'New post', 'new des', 'a:1:{i:0;s:71:&quot;http://localhost/Saar-IITP/uploads/3586c09d8e253d98de30c7b6bdcb382b.jpg&quot;;}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(31, 2, 4567, '2019-12-26 14:48:33', 'fljwe', 'letk', 'a:2:{i:0;s:71:&quot;http://localhost/Saar-IITP/uploads/10b41b5c061a310ae7fee74b52219ba7.jpg&quot;;i:1;s:107:&quot;http://localhost/Saar-IITP/uploads/10b41b5c061a310ae7fee74b52219ba7.jpg1572c3782ea197cbcfcd9362cca34571.jpg&quot;;}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(32, 2, 654, '2019-12-26 15:01:04', 'Another', 'should end now', 'a:2:{i:0;s:36:&quot;e98248f9ade2947e7e0cfdf6d381a561.jpg&quot;;i:1;s:36:&quot;37f64616685fe441a0db141bf3e0d574.jpg&quot;;}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(33, 2, 456, '2019-12-26 15:21:06', 'qwerty', 'qwerty', 'a:2:{i:0;s:36:\"ddcdf570cbe23628140eeac74f5f7bf4.jpg\";i:1;s:36:\"0e81a9f08698c408d5d76017c11ea348.jpg\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(34, 2, 567, '2019-12-26 15:28:01', 'werty', 'werty', 'a:2:{i:0;s:36:\"5ada8a702965c04351fb2806055af4b5.jpg\";i:1;s:36:\"e3331eef1775f56f978083026bb8590f.jpg\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(35, 2, 56, '2019-12-26 17:58:42', 'qwerty', 'qwerty', 'a:1:{i:0;s:36:\"b536a1a322a4eda6d50cd939693645ea.jpg\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(36, 2, 567, '2019-12-26 18:00:23', 'Lorem Ipsum', 'Lorum Ipsum', 'a:1:{i:0;s:36:\"bca4d29bcdb33ef1ef34c118df9dca16.jpg\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}'),
(38, 2, 567, '2019-12-26 18:14:23', 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'a:1:{i:0;s:36:\"05da2a005028a2e8f8a685b58debafb1.jpg\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}');

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
  `thread_upvotes` varchar(250) NOT NULL,
  `thread_downvotes` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `post_id`, `thread_time`, `thread_body`, `thread_imgs`, `thread_upvotes`, `thread_downvotes`, `user_id`) VALUES
(1, 2, '2019-12-17 15:59:55', 'h', 'a:0:{}', 'a:0:{}', 'a:0:{}', 1),
(2, 3, '2019-12-24 09:00:31', 'Some', 'a:0:{}', 'a:0:{}', 'a:0:{}', 2),
(3, 3, '2019-12-24 09:00:31', 'Some', 'a:0:{}', 'a:0:{}', 'a:0:{}', 2),
(4, 3, '2019-12-24 09:00:31', 'Some', 'a:0:{}', 'a:0:{}', 'a:0:{}', 2),
(5, 3, '2019-12-25 15:04:16', 'hill', 'a:0:{}', 'a:0:{}', 'a:0:{}', 3),
(6, 3, '2019-12-25 15:08:33', 'mill', 'a:0:{}', 'a:0:{}', 'a:0:{}', 3),
(7, 3, '2019-12-25 16:56:11', 'people should focus on it', 'a:0:{}', 'a:0:{}', 'a:0:{}', 3),
(8, 25, '2019-12-25 17:49:54', 'same to you', 'a:0:{}', 'a:0:{}', 'a:0:{}', 3),
(9, 34, '2019-12-26 15:28:22', 'we', 'a:0:{}', 'a:0:{}', 'a:0:{}', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus`
--
ALTER TABLE `alumnus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll_no` (`rollno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ids` (`user_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnus`
--
ALTER TABLE `alumnus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
