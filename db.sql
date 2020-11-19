-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 02:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cms`
--
CREATE DATABASE IF NOT EXISTS `db_cms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_cms`;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `thumbnail` varchar(500) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `banner_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(200) NOT NULL,
  `blog_title_slug` varchar(200) NOT NULL,
  `blog_post` longtext NOT NULL,
  `blog_category` varchar(100) NOT NULL,
  `blog_posted_by` varchar(100) NOT NULL,
  `blog_updated_by` varchar(100) NOT NULL,
  `blog_date_posted` varchar(50) NOT NULL,
  `blog_date_updated` varchar(50) NOT NULL,
  `blog_image` varchar(200) NOT NULL,
  `blog_image_thumb` varchar(1000) NOT NULL,
  `blog_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_title_slug`, `blog_post`, `blog_category`, `blog_posted_by`, `blog_updated_by`, `blog_date_posted`, `blog_date_updated`, `blog_image`, `blog_image_thumb`, `blog_status`) VALUES
(1, 'Why Listening to Music is the Key to Good Health', 'why-listening-to-music-is-the-key-to-good-health', '&lt;p&gt;It\'s the weekend and at some point you\'ll probably relax to your favourite music, watch a film with a catchy title track - or hit the dance floor.&lt;/p&gt;\r\n\r\n&lt;p&gt;There\'s no doubt that listening to your favourite music can instantly put you in a good mood. But scientists are now discovering that music can do more for you than just lift your spirits.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;em&gt;Research is showing it has a variety of health benefits.&lt;/em&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Fresh research from Austria has found that listening to music can help patients with chronic back pain.&lt;/p&gt;\r\n\r\n&lt;p&gt;And a recent survey by Mind - the mental health charity - found that after counselling, patients found group therapy such as art and music therapy, the most useful.&lt;/p&gt;\r\n', 'Music', 'Christopher Gerra', 'Christopher Gerra', 'Mar 09, 2017', 'Mar 11, 2018', 'why_listening_to_music_is_the_key_to_good_health_12_03102017.jpg', 'why_listening_to_music_is_the_key_to_good_health_12_03102017_thumb.jpg', 'Inactive'),
(16, 'Why Listening to Music is the Key to Good Health', 'why-listening-to-music-is-the-key-to-good-health-1', '&lt;p&gt;Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health&lt;/p&gt;\r\n', 'Music', 'Christopher Gerra', '', 'Dec 15, 2017', '', '12152017070622.jpg', '12152017070622_thumb.jpg', 'Active'),
(17, 'Why Listening to Music is the Key to Good Health', 'why-listening-to-music-is-the-key-to-good-health-2', '&lt;p&gt;Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health&lt;/p&gt;\r\n', 'Music', 'Christopher Gerra', '', 'Dec 15, 2017', '', '12152017070642.jpg', '12152017070642_thumb.jpg', 'Active'),
(19, 'Why Listening to Music is the Key to Good Health Life', 'why-listening-to-music-is-the-key-to-good-health-life', '&lt;p&gt;Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health Why Listening to Music is the Key to Good Health&lt;/p&gt;\r\n', 'Music', 'Christopher Gerra', 'Christopher Gerra', 'Dec 15, 2017', 'Dec 15, 2017', '12152017071033.jpg', '12152017071033_thumb.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `blog_cat_id` int(11) NOT NULL,
  `blog_category` varchar(100) NOT NULL,
  `blog_category_slug` varchar(200) NOT NULL,
  `blog_description` varchar(500) NOT NULL,
  `blog_cat_status` varchar(100) NOT NULL,
  `blog_cat_image` varchar(200) NOT NULL,
  `blog_cat_image_thumb` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`blog_cat_id`, `blog_category`, `blog_category_slug`, `blog_description`, `blog_cat_status`, `blog_cat_image`, `blog_cat_image_thumb`) VALUES
(1, 'Music', 'music', 'Music is an art form and cultural activity whose medium is sound and silence, which exist in time.', 'Active', '', ''),
(2, 'Fashion', 'fashion', 'Fashion is a popular style or practice, especially in clothing, footwear, accessories, makeup, body, or furniture. Fashion is a distinctive and often constant trend in the style in which a person dresses.', 'Active', '', ''),
(3, 'Car', 'car', 'A car is a wheeled, self-powered motor vehicle used for transportation and a product of the automotive industry.', 'Active', '', ''),
(4, 'Real State', 'real-state', 'Real estate is \"property consisting of land and the buildings on it, along with its natural resources such as crops, minerals or water; immovable property of this nature; an interest vested in this (also) an item of real property, (more generally) buildings or housing in general.', 'Active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `comment_id` int(11) NOT NULL,
  `commentator` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date_posted` varchar(50) NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `content_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `menu` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `parent_menu` varchar(100) NOT NULL,
  `menu_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module` char(100) NOT NULL,
  `module_description` varchar(500) NOT NULL,
  `module_status` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news` varchar(1000) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `news_status` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `news_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `newsletter_id` int(11) NOT NULL,
  `newsletter` varchar(500) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_categ`
--

CREATE TABLE `newsletter_categ` (
  `categ_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `category_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `bdate` varchar(50) NOT NULL,
  `last_login` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `avatar_color` varchar(20) NOT NULL,
  `special_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `address`, `state`, `country`, `zip_code`, `bdate`, `last_login`, `status`, `type`, `ipaddress`, `avatar`, `avatar_color`, `special_code`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Christopher', 'Gerra', 'cngerra@gmail.com', 'Balocawe Abuyog, Leyte', 'Madre de Dios', 'Peru', '6510', '--', 'May 23, 2020 - 11:18 am', 'Active', 'Super User', '', '', 'green', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'chopper', '21232f297a57a5a743894a0e4a801fc3', 'Angel Annie', 'Gerra', 'angelannief@gmail.com', 'Abuyog, Leyte', 'Isabela', 'Philippines', '6510', '--', 'May 14, 2020 - 06:52 am', '', 'Chopper', '', '', 'pink', '37e4dd20c310142564fc483db1132f36'),
(14, 'angelannie', '149afd631693c895f81e508eb5aaef37', 'Angel Annie', 'Gerra', 'angelannieef@gmail.com', 'Balocawe', 'Leyte', 'Philippines', '6510', '01/02/2017', 'Jan 25, 2017 - 10:03 am', 'Active', 'Filler', '', '', 'orange', 'b020b8e3e7c9f6a4664f3aabfb59b275'),
(19, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'Tope', 'Angel', 'test@gmail.com', 'la', 'Leyte', 'Philippines', '2423', '11/16/1990', 'May 14, 2020 - 07:48 am', 'Active', 'Filler', '', '', 'black', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `users_priviledges`
--

CREATE TABLE `users_priviledges` (
  `priv_id` int(11) NOT NULL,
  `priv_details` varchar(200) NOT NULL,
  `priv_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_privs_type`
--

CREATE TABLE `users_privs_type` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `priv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`type_id`, `type`, `description`) VALUES
(1, 'Super User', 'All accessable'),
(2, 'Administrator', 'Website Administrator'),
(3, 'Chopper', 'Limited Access'),
(4, 'Filler', 'Content filler');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE `widget` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `widget_category` int(11) NOT NULL,
  `widget_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `widget_category`
--

CREATE TABLE `widget_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`blog_cat_id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletter_id`);

--
-- Indexes for table `newsletter_categ`
--
ALTER TABLE `newsletter_categ`
  ADD PRIMARY KEY (`categ_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_priviledges`
--
ALTER TABLE `users_priviledges`
  ADD PRIMARY KEY (`priv_id`);

--
-- Indexes for table `users_privs_type`
--
ALTER TABLE `users_privs_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widget_category`
--
ALTER TABLE `widget_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `blog_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter_categ`
--
ALTER TABLE `newsletter_categ`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users_priviledges`
--
ALTER TABLE `users_priviledges`
  MODIFY `priv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_privs_type`
--
ALTER TABLE `users_privs_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `widget_category`
--
ALTER TABLE `widget_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
