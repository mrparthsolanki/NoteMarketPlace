-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 03:36 PM
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
(2, 'IT', 'This is IT Category', '2021-03-03 17:55:27', 1, '2021-03-03 17:55:27', 1, b'1');

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
(1, 'India', '+91', '2021-04-12 00:00:00', 1, '2021-04-12 00:00:00', 1, b'1'),
(3, 'Australia', '+61', '2021-03-03 19:08:55', 11, '2021-03-03 19:08:55', 1, b'1');

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
(1, 'handwritten', 'This is Handwritten Books.', '2021-03-03 19:12:18', 1, '2021-03-03 19:12:18', 1, b'1'),
(3, 'story books', 'This is Story Books.', '2021-03-03 19:12:45', 1, '2021-03-03 19:12:45', 1, b'1');

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
(4, 'paid', 'p', 'selling mode', '2021-02-13 19:07:41', 1, '2021-02-13 19:07:41', 1, b'1'),
(5, 'free', 'f', 'selling mode', '2021-02-13 19:07:41', 1, '2021-02-13 19:07:41', 1, b'1'),
(6, 'draft', 'draft', 'note status', '2021-02-13 19:09:00', 1, '2021-02-13 19:09:00', 1, b'1'),
(8, 'in review', 'in review', 'note status', '2021-02-13 19:10:07', 1, '2021-02-13 19:10:07', 1, b'1'),
(9, 'published', 'published', 'note status', '2021-02-13 19:10:07', 1, '2021-02-13 19:10:07', 1, b'1'),
(10, 'rejected', 'rejected', 'note status', '2021-02-13 19:11:54', 1, '2021-02-13 19:11:54', 1, b'1'),
(11, 'removed', 'removed', 'note status', '2021-02-13 19:11:54', 1, '2021-02-13 19:11:54', 1, b'1'),
(13, 'submitted for review', 'submitted for review', 'note status', '2021-04-10 00:00:10', 1, '2021-04-10 00:00:18', 1, b'1');

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
(2, 2, 'neha', 'padsala', '18mca019@nirmauni.ac.in', 'Neha@123', b'1', '2021-04-12 00:00:00', 1, '2021-04-12 10:00:00', 1, b'1'),
(14, 1, 'parth', 'Solanki', '18mca046@nirmauni.ac.in', '$2y$12$vQsibirsuyg4hkdeTd2n7..7AglpH9lKNptZjWL3zZIx0uEa.9Hli', b'1', '2021-04-12 18:58:03', NULL, '2021-04-12 18:58:57', 14, b'1');

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
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note_category`
--
ALTER TABLE `note_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `note_country`
--
ALTER TABLE `note_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `note_reviews`
--
ALTER TABLE `note_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note_type`
--
ALTER TABLE `note_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seller_notes_attachment`
--
ALTER TABLE `seller_notes_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `sys_config_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
