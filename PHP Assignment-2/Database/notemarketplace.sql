-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 09:53 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notemarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `download_id` int(11) NOT NULL,
  `downloaded_note_id` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `downloader` int(11) NOT NULL,
  `is_allowed_download` bit(1) NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `is_attachment_downloaded` bit(1) NOT NULL,
  `attachment_downloaded_date` datetime DEFAULT NULL,
  `is_note_paid` bit(1) NOT NULL,
  `purchased_price` decimal(10,2) DEFAULT NULL,
  `note_title` varchar(100) NOT NULL,
  `note_category` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`download_id`, `downloaded_note_id`, `seller`, `downloader`, `is_allowed_download`, `attachment_path`, `is_attachment_downloaded`, `attachment_downloaded_date`, `is_note_paid`, `purchased_price`, `note_title`, `note_category`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(11, 33, 26, 27, b'1', '../Uploads/Members/26/33/Attachments/Attachment_1619877202.pdf', b'0', '2021-05-04 12:30:24', b'1', '500.00', 'Mathematics-2', 'Maths', '2021-05-04 12:30:24', 27, '2021-05-04 12:36:17', 26),
(12, 32, 26, 27, b'1', '../Uploads/Members/26/32/Attachments/Attachment_1619877022.pdf', b'0', '2021-05-04 12:36:46', b'1', '1000.00', '21 Lessons for the 21st Century', 'History', '2021-05-04 12:36:46', 27, '2021-05-04 12:37:02', 26);

-- --------------------------------------------------------

--
-- Table structure for table `note_category`
--

CREATE TABLE `note_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note_category`
--

INSERT INTO `note_category` (`category_id`, `category_name`, `category_description`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(1, 'Science', 'This is Science Category', '2021-04-12 00:15:00', 1, '2021-04-12 00:00:00', 1, b'1'),
(2, 'IT', 'This is IT Category', '2021-03-03 17:55:27', 1, '2021-03-03 17:55:27', 1, b'1'),
(3, 'Business & Economics', 'This is a Business & Economics', '2021-04-28 13:35:35', NULL, '2021-04-28 13:35:35', NULL, b'1'),
(4, 'Action and Adventure', 'this is Action and Adventure', '2021-04-28 13:35:59', NULL, '2021-04-28 13:35:59', NULL, b'1'),
(5, 'Maths', 'This is Maths', '2021-04-28 13:36:24', NULL, '2021-04-28 13:36:24', NULL, b'1'),
(6, 'History', 'This is History', '2021-04-28 13:36:48', NULL, '2021-04-28 13:36:48', NULL, b'1'),
(7, 'Fiction', 'This is Fiction', '2021-04-28 13:37:05', NULL, '2021-04-28 13:37:05', NULL, b'1'),
(8, 'Comic Book or Graphic Novel', 'This is Comic Book or Graphic Novel', '2021-04-28 13:37:36', NULL, '2021-04-28 13:37:36', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `note_country`
--

CREATE TABLE `note_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note_country`
--

INSERT INTO `note_country` (`country_id`, `country_name`, `country_code`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(1, 'Afghanistan', '93', '2021-04-28 13:53:02', NULL, '2021-04-28 13:53:02', NULL, b'1'),
(2, 'Australia', '61', '2021-04-28 13:53:32', NULL, '2021-04-28 13:53:32', NULL, b'1'),
(3, 'Bangladesh', '880', '2021-04-28 13:54:02', NULL, '2021-04-28 13:54:02', NULL, b'1'),
(4, 'Canada', '1', '2021-04-28 13:54:27', NULL, '2021-04-28 13:54:27', NULL, b'1'),
(5, 'China', '86', '2021-04-28 13:54:50', NULL, '2021-04-28 13:54:50', NULL, b'1'),
(6, 'France', '33', '2021-04-28 13:55:14', NULL, '2021-04-28 13:55:14', NULL, b'1'),
(7, 'India', '91', '2021-04-28 13:55:46', NULL, '2021-04-28 13:55:46', NULL, b'1'),
(8, 'Nepal', '977', '2021-04-28 13:56:13', NULL, '2021-04-28 13:56:13', NULL, b'1'),
(9, 'New Zealand', '64', '2021-04-28 13:57:22', NULL, '2021-04-28 13:57:22', NULL, b'1'),
(10, 'South Africa', '27', '2021-04-28 13:57:53', NULL, '2021-04-28 13:57:53', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `note_reviews`
--

CREATE TABLE `note_reviews` (
  `review_id` int(11) NOT NULL,
  `review_note_id` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `against_downloads_id` int(11) NOT NULL,
  `review_rating` decimal(10,2) NOT NULL,
  `review_comment` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_review_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note_type`
--

CREATE TABLE `note_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `type_description` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `note_type`
--

INSERT INTO `note_type` (`type_id`, `type_name`, `type_description`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(1, 'handwritten', 'This is Handwritten Books.', '2021-04-28 19:12:18', 1, '2021-04-28 14:01:34', 1, b'1'),
(2, 'university notes', 'This is University Notes.', '2021-04-28 19:12:18', 1, '2021-04-28 19:12:18', 1, b'1'),
(3, 'story books', 'This is Story Books.', '2021-04-28 19:12:45', 1, '2021-04-28 19:12:45', 1, b'1'),
(4, 'Novel', 'This is Novel Note Type', '2021-04-28 13:42:29', 1, '2021-04-28 13:42:29', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `reference_data`
--

CREATE TABLE `reference_data` (
  `reference_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `datavalue` varchar(100) NOT NULL,
  `ref_category` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reference_data`
--

INSERT INTO `reference_data` (`reference_id`, `value`, `datavalue`, `ref_category`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(1, 'male', 'm', 'gender', '2021-02-13 19:04:57', 1, '2021-02-13 19:04:57', 1, b'1'),
(2, 'female', 'fe', 'gender', '2021-02-13 19:05:49', 1, '2021-02-13 19:05:49', 1, b'1'),
(3, 'unknown', 'u', 'gender', '2021-02-13 19:06:42', 1, '2021-02-13 19:06:42', 1, b'0'),
(4, 'paid', 'p', 'selling mode', '2021-02-13 19:07:41', 1, '2021-02-13 19:07:41', 1, b'1'),
(5, 'free', 'f', 'selling mode', '2021-02-13 19:07:41', 1, '2021-02-13 19:07:41', 1, b'1'),
(6, 'draft', 'draft', 'note status', '2021-02-13 19:09:00', 1, '2021-02-13 19:09:00', 1, b'1'),
(7, 'submitted for review', 'submitted for review', 'note status', '2021-02-13 19:09:00', 1, '2021-02-13 19:09:00', 1, b'1'),
(8, 'in review', 'in review', 'note status', '2021-02-13 19:10:07', 1, '2021-02-13 19:10:07', 1, b'1'),
(9, 'published', 'published', 'note status', '2021-02-13 19:10:07', 1, '2021-02-13 19:10:07', 1, b'1'),
(10, 'rejected', 'rejected', 'note status', '2021-02-13 19:11:54', 1, '2021-02-13 19:11:54', 1, b'1'),
(11, 'removed', 'removed', 'note status', '2021-02-13 19:11:54', 1, '2021-02-13 19:11:54', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `reported_note`
--

CREATE TABLE `reported_note` (
  `report_id` int(11) NOT NULL,
  `reported_note_id` int(11) NOT NULL,
  `reported_by_id` int(11) NOT NULL,
  `against_download_id` int(11) NOT NULL,
  `report_remarks` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes`
--

CREATE TABLE `seller_notes` (
  `note_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `note_status` int(11) NOT NULL,
  `actioned_by` int(11) DEFAULT NULL,
  `admin_remarks` varchar(255) DEFAULT NULL,
  `note_published_date` datetime DEFAULT NULL,
  `note_title` varchar(100) NOT NULL,
  `note_category` int(11) NOT NULL,
  `note_display_picture` varchar(500) DEFAULT NULL,
  `note_type` int(11) NOT NULL,
  `note_number_of_pages` int(11) DEFAULT NULL,
  `note_description` varchar(255) NOT NULL,
  `note_university_name` varchar(200) DEFAULT NULL,
  `note_country` int(11) NOT NULL,
  `note_course` varchar(100) DEFAULT NULL,
  `note_course_code` varchar(100) DEFAULT NULL,
  `note_professor` varchar(100) DEFAULT NULL,
  `is_note_paid` bit(1) NOT NULL,
  `note_price` decimal(10,2) DEFAULT NULL,
  `note_preview` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_note_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_notes`
--

INSERT INTO `seller_notes` (`note_id`, `seller_id`, `note_status`, `actioned_by`, `admin_remarks`, `note_published_date`, `note_title`, `note_category`, `note_display_picture`, `note_type`, `note_number_of_pages`, `note_description`, `note_university_name`, `note_country`, `note_course`, `note_course_code`, `note_professor`, `is_note_paid`, `note_price`, `note_preview`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_note_active`) VALUES
(31, 26, 9, 20, NULL, '2021-05-01 19:03:49', 'Life of Pi', 4, '../Uploads/Members/26/31/DP_1619875968.jpg', 1, 20, 'NO', ' University of Delhi', 7, 'BA', '3ca1510', 'Lata Gohil', b'1', '1200.00', '../Uploads/Members/26/31/Preview_1619875968.pdf', '2021-05-01 19:02:48', 26, '2021-05-01 19:03:49', 20, b'1'),
(32, 26, 9, 20, NULL, '2021-05-01 19:20:47', '21 Lessons for the 21st Century', 6, '../Uploads/Members/26/32/DP_1619877022.jpg', 3, 25, 'NO', 'Nirma University', 7, 'BA in History', '3ca1512', 'VD SIR', b'1', '1000.00', '../Uploads/Members/26/32/Preview_1619877022.pdf', '2021-05-01 19:20:21', 26, '2021-05-01 19:20:47', 20, b'1'),
(33, 26, 9, 20, NULL, '2021-05-01 19:23:31', 'Mathematics-2', 5, '../Uploads/Members/26/33/DP_1619877202.jpg', 2, 10, 'NO', 'Indian Institute of Science', 7, 'B.Sc. Mathematics', '3ca1515', 'Rushbha Shah', b'1', '500.00', '../Uploads/Members/26/33/Preview_1619877202.pdf', '2021-05-01 19:23:22', 26, '2021-05-01 19:23:31', 20, b'1'),
(34, 27, 9, 20, NULL, '2021-05-04 12:41:03', 'Networking', 2, '../Uploads/Members/27/34/DP_1620112216.jpg', 1, 5, 'NO', 'Indian Institute of Science', 7, 'B.SC', '3ca1518', 'Sonia Mam', b'1', '1200.00', '../Uploads/Members/27/34/Preview_1620112216.pdf', '2021-05-04 12:40:16', 27, '2021-05-04 12:41:03', 20, b'1'),
(36, 27, 9, 20, NULL, '2021-05-04 13:14:54', 'Business & Economics', 3, '../Uploads/Members/27/36/DP_1620112982.jpg', 2, 5, 'no', 'Indian Institute of Science', 7, 'Integarted Law Program- BBA LL.B', '3ca1520', 'Surin Parikh', b'1', '1200.00', '../Uploads/Members/27/36/Preview_1620112936.pdf', '2021-05-04 12:52:16', 27, '2021-05-04 13:14:54', 20, b'1'),
(37, 27, 9, 20, NULL, '2021-05-04 13:17:02', 'Black Holes The Reith Lectures', 1, '../Uploads/Members/27/37/DP_1620114412.jpg', 2, 25, 'NO', 'Indian Institute of Science', 7, 'B.Sc.- Information Technology', '3ca1521', 'Surin Parikh', b'1', '1000.00', '../Uploads/Members/27/37/Preview_1620114412.pdf', '2021-05-04 13:16:52', 27, '2021-05-04 13:17:02', 20, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `seller_notes_attachment`
--

CREATE TABLE `seller_notes_attachment` (
  `attachment_id` int(11) NOT NULL,
  `attachment_note_id` int(11) NOT NULL,
  `attached_file_name` varchar(100) NOT NULL,
  `attached_file_path` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_notes_attachment`
--

INSERT INTO `seller_notes_attachment` (`attachment_id`, `attachment_note_id`, `attached_file_name`, `attached_file_path`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(29, 31, 'Attachment_1619875968.pdf', '../Uploads/Members/26/31/Attachments/Attachment_1619875968.pdf', '2021-05-01 19:02:48', 26, '2021-05-01 19:02:48', 26, b'1'),
(30, 32, 'Attachment_1619877022.pdf', '../Uploads/Members/26/32/Attachments/Attachment_1619877022.pdf', '2021-05-01 19:20:22', 26, '2021-05-01 19:20:22', 26, b'1'),
(31, 33, 'Attachment_1619877202.pdf', '../Uploads/Members/26/33/Attachments/Attachment_1619877202.pdf', '2021-05-01 19:23:22', 26, '2021-05-01 19:23:22', 26, b'1'),
(32, 34, 'Attachment_1620112216.pdf', '../Uploads/Members/27/34/Attachments/Attachment_1620112216.pdf', '2021-05-04 12:40:16', 27, '2021-05-04 12:40:16', 27, b'1'),
(34, 36, 'Attachment_1620112936.pdf', '../Uploads/Members/27/36/Attachments/Attachment_1620112936.pdf', '2021-05-04 12:52:16', 27, '2021-05-04 12:52:16', 27, b'1'),
(35, 37, 'Attachment_1620114412.pdf', '../Uploads/Members/27/37/Attachments/Attachment_1620114412.pdf', '2021-05-04 13:16:52', 27, '2021-05-04 13:16:52', 27, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `sys_config_id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_email_id` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `is_user_email_verified` bit(1) NOT NULL DEFAULT b'0',
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_role_id`, `user_first_name`, `user_last_name`, `user_email_id`, `user_password`, `is_user_email_verified`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(20, 2, 'parth ', 'solanki', 'parthsolanki1295@gmail.com', 'Parth@123', b'1', '2021-04-17 00:00:17', 1, '2021-04-26 18:16:23', 20, b'1'),
(26, 1, 'Vishal', 'Patel', 'vishupatel96246@gmail.com', 'Parth123@', b'1', '2021-05-01 19:00:32', NULL, '2021-05-01 19:00:32', NULL, b'1'),
(27, 1, 'Hardik', 'Padsala', 'sparth361998@gmail.com', 'Parth123@', b'1', '2021-05-04 12:28:28', NULL, '2021-05-04 12:28:28', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL,
  `profile_user_id` int(11) NOT NULL,
  `user_dob` date DEFAULT NULL,
  `user_gender` int(11) DEFAULT NULL,
  `user_second_email_id` varchar(100) DEFAULT NULL,
  `user_phone_country_code` varchar(5) NOT NULL,
  `user_phone_number` varchar(20) NOT NULL,
  `user_profile_picture` varchar(500) DEFAULT NULL,
  `user_address_line1` varchar(100) NOT NULL,
  `user_address_line2` varchar(100) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_state` varchar(50) NOT NULL,
  `user_zipcode` varchar(50) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_university` varchar(100) DEFAULT NULL,
  `user_college` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profile_id`, `profile_user_id`, `user_dob`, `user_gender`, `user_second_email_id`, `user_phone_country_code`, `user_phone_number`, `user_profile_picture`, `user_address_line1`, `user_address_line2`, `user_city`, `user_state`, `user_zipcode`, `user_country`, `user_university`, `user_college`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(15, 26, '2021-05-01', 1, '', '91', '7894561230', '../Uploads/Members/26/DP_1619875910.jpg', 'F-1203,carmel custer', 'near D-mart', 'Ahmedabad', 'Gujarat', '360009', 'australia', 'GTU-Ahmedabad', 'LM COLLEGE OF PHARMACY ', '2021-05-01 19:01:50', 26, '2021-05-01 19:01:50', 26),
(16, 27, '2021-05-04', 1, '', '91', '7894561230', '../Uploads/Members/27/DP_1620111611.jpg', 'F-1203,carmel custer', 'near D-mart', 'Ahmedabad', 'Gujarat', '360009', 'australia', 'GTU-Ahmedabad', 'LD COLLEGE OF PHARMACY ', '2021-05-04 12:30:11', 27, '2021-05-04 12:30:11', 27);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_description` varchar(255) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`, `role_description`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_active`) VALUES
(1, 'member', 'this is member role', '2021-04-09 06:00:00', 1, '2021-04-09 00:00:23', 1, b'1'),
(2, 'admin', 'this is a admin role', '2021-04-09 00:17:00', 1, '2021-04-09 00:00:00', 1, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`download_id`),
  ADD KEY `fk_to_downloaded_note_id` (`downloaded_note_id`),
  ADD KEY `fk_to_downloader` (`downloader`);

--
-- Indexes for table `note_category`
--
ALTER TABLE `note_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `note_country`
--
ALTER TABLE `note_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `note_reviews`
--
ALTER TABLE `note_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_to_review_note_id` (`review_note_id`),
  ADD KEY `fk_to_reviewer_id` (`reviewer_id`),
  ADD KEY `fk_to_against_downloads_id` (`against_downloads_id`);

--
-- Indexes for table `note_type`
--
ALTER TABLE `note_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `reference_data`
--
ALTER TABLE `reference_data`
  ADD PRIMARY KEY (`reference_id`);

--
-- Indexes for table `reported_note`
--
ALTER TABLE `reported_note`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `fk_to_reported_note_id` (`reported_note_id`),
  ADD KEY `fk_to_reported_by_id` (`reported_by_id`),
  ADD KEY `fk_to_against_download_id` (`against_download_id`);

--
-- Indexes for table `seller_notes`
--
ALTER TABLE `seller_notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `fk_to_note_status` (`note_status`),
  ADD KEY `fk_to_seller_id` (`seller_id`),
  ADD KEY `fk_to_note_category` (`note_category`),
  ADD KEY `fk_to_note_type` (`note_type`),
  ADD KEY `fk_to_note_country` (`note_country`);

--
-- Indexes for table `seller_notes_attachment`
--
ALTER TABLE `seller_notes_attachment`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `fk_to_attachment_note_id` (`attachment_note_id`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`sys_config_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_id` (`user_email_id`),
  ADD KEY `fk_to_user_role_id` (`user_role_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `fk_to_profile_user_id` (`profile_user_id`),
  ADD KEY `fk_to_user_gender` (`user_gender`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `note_category`
--
ALTER TABLE `note_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `note_country`
--
ALTER TABLE `note_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `note_reviews`
--
ALTER TABLE `note_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `note_type`
--
ALTER TABLE `note_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reference_data`
--
ALTER TABLE `reference_data`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reported_note`
--
ALTER TABLE `reported_note`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_notes`
--
ALTER TABLE `seller_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `seller_notes_attachment`
--
ALTER TABLE `seller_notes_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `sys_config_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `fk_to_downloaded_note_id` FOREIGN KEY (`downloaded_note_id`) REFERENCES `seller_notes` (`note_id`),
  ADD CONSTRAINT `fk_to_downloader` FOREIGN KEY (`downloader`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `note_reviews`
--
ALTER TABLE `note_reviews`
  ADD CONSTRAINT `fk_to_against_downloads_id` FOREIGN KEY (`against_downloads_id`) REFERENCES `downloads` (`download_id`),
  ADD CONSTRAINT `fk_to_review_note_id` FOREIGN KEY (`review_note_id`) REFERENCES `seller_notes` (`note_id`),
  ADD CONSTRAINT `fk_to_reviewer_id` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reported_note`
--
ALTER TABLE `reported_note`
  ADD CONSTRAINT `fk_to_against_download_id` FOREIGN KEY (`against_download_id`) REFERENCES `downloads` (`download_id`),
  ADD CONSTRAINT `fk_to_reported_by_id` FOREIGN KEY (`reported_by_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_to_reported_note_id` FOREIGN KEY (`reported_note_id`) REFERENCES `seller_notes` (`note_id`);

--
-- Constraints for table `seller_notes`
--
ALTER TABLE `seller_notes`
  ADD CONSTRAINT `fk_to_note_category` FOREIGN KEY (`note_category`) REFERENCES `note_category` (`category_id`),
  ADD CONSTRAINT `fk_to_note_country` FOREIGN KEY (`note_country`) REFERENCES `note_country` (`country_id`),
  ADD CONSTRAINT `fk_to_note_status` FOREIGN KEY (`note_status`) REFERENCES `reference_data` (`reference_id`),
  ADD CONSTRAINT `fk_to_note_type` FOREIGN KEY (`note_type`) REFERENCES `note_type` (`type_id`),
  ADD CONSTRAINT `fk_to_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `seller_notes_attachment`
--
ALTER TABLE `seller_notes_attachment`
  ADD CONSTRAINT `fk_to_attachment_note_id` FOREIGN KEY (`attachment_note_id`) REFERENCES `seller_notes` (`note_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_to_user_role_id` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`role_id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_to_profile_user_id` FOREIGN KEY (`profile_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_to_user_gender` FOREIGN KEY (`user_gender`) REFERENCES `reference_data` (`reference_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
