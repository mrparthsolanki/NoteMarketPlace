-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2021 at 01:59 PM
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
(17, 49, 42, 42, b'1', '../Uploads/Members/42/49/Attachments/Attachment_1620997756.pdf', b'1', '2021-05-15 17:19:54', b'1', NULL, 'The Diwali Party ', 'Fiction', '2021-05-15 17:19:54', 42, '2021-05-15 17:19:54', 42),
(18, 43, 41, 42, b'1', '../Uploads/Members/41/43/Attachments/Attachment_1620995790.pdf', b'0', '2021-05-15 17:20:31', b'1', '110.00', 'Science - 500 Facts', 'Science', '2021-05-15 17:20:31', 42, '2021-05-15 17:21:44', 41),
(19, 49, 42, 41, b'1', '../Uploads/Members/42/49/Attachments/Attachment_1620997756.pdf', b'0', '2021-05-15 17:22:05', b'1', '25.00', 'The Diwali Party ', 'Fiction', '2021-05-15 17:22:05', 41, '2021-05-15 17:26:47', 42),
(20, 46, 41, 42, b'0', NULL, b'0', '2021-05-15 17:27:31', b'1', '60.00', 'Business Economics ', 'Business & Economics', '2021-05-15 17:27:31', 42, '2021-05-15 17:27:31', 42);

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
(1, 'Science', 'This is Science Category', '2021-05-14 14:19:24', 39, '2021-05-14 14:19:24', 39, b'1'),
(2, 'IT', 'This is IT Category', '2021-05-14 14:20:19', 39, '2021-05-14 14:20:19', 39, b'1'),
(3, 'Business & Economics', 'This is Business & Economics', '2021-05-14 14:21:02', 39, '2021-05-14 14:21:02', 39, b'1'),
(4, 'Action & Adventure', 'This is Action & Adventure Category', '2021-05-14 14:21:46', 39, '2021-05-14 14:21:46', 39, b'1'),
(5, 'Maths', 'This is a Maths Category', '2021-05-14 14:22:10', 39, '2021-05-14 14:22:10', 39, b'1'),
(6, 'History', 'This is History Category', '2021-05-14 14:22:44', 39, '2021-05-14 14:22:44', 39, b'1'),
(7, 'Fiction', 'This is a Fiction Category', '2021-05-14 14:23:04', 39, '2021-05-14 14:23:04', 39, b'1'),
(8, 'Comic Book Or Graphic Novel', 'This is Comic Book or Graphic Novel', '2021-05-14 14:24:17', 39, '2021-05-14 14:24:17', 39, b'1');

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
(1, 'India', '+91', '2021-05-14 14:32:07', 39, '2021-05-14 14:32:07', 39, b'1'),
(2, 'Australia', '+61', '2021-05-14 14:32:31', 39, '2021-05-14 14:32:31', 39, b'1'),
(3, 'China', '+86', '2021-05-14 14:32:56', 39, '2021-05-14 14:32:56', 39, b'1'),
(4, 'Canada', '+1', '2021-05-14 14:33:26', 39, '2021-05-14 14:33:26', 39, b'1'),
(5, 'Nepal', '+997', '2021-05-14 14:33:53', 39, '2021-05-14 14:34:05', 39, b'1');

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

--
-- Dumping data for table `note_reviews`
--

INSERT INTO `note_reviews` (`review_id`, `review_note_id`, `reviewer_id`, `against_downloads_id`, `review_rating`, `review_comment`, `created_date`, `created_by`, `modified_date`, `modified_by`, `is_review_active`) VALUES
(6, 43, 42, 18, '4.00', 'Good Books', '2021-05-15 17:22:56', 42, '2021-05-15 17:22:56', 42, b'1');

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
(1, 'Handwritten Type', 'This is Note or book which is Handwritten Books/Notes.....', '2021-05-14 14:27:15', 39, '2021-05-14 14:29:58', 39, b'1'),
(2, 'University Books/Notes', 'This is Note or book which is University Books/Notes.....', '2021-05-14 14:28:31', 39, '2021-05-14 14:28:31', 39, b'1'),
(3, 'Story Books/Notes', 'This is Note or book which is Story Books/Notes.....', '2021-05-14 14:29:06', 39, '2021-05-14 14:29:06', 39, b'1'),
(4, 'Novel', 'This is Note or book which is Novel Books/Notes.....', '2021-05-14 14:29:41', 39, '2021-05-14 14:29:41', 39, b'1');

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

--
-- Dumping data for table `reported_note`
--

INSERT INTO `reported_note` (`report_id`, `reported_note_id`, `reported_by_id`, `against_download_id`, `report_remarks`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(2, 49, 42, 17, 'This Content is not good for me', '2021-05-15 17:23:27', 42, '2021-05-15 17:23:27', 42);

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
(41, 41, 9, 39, NULL, '2021-05-14 23:03:39', 'Mathematics ', 5, '../Uploads/Members/41/41/DP_1620994784.jpg', 1, 12, 'RD Sharma Class 11 textbooks are based on on the latest syllabus of Central Board of Secondary Education according to the CCE guidelines.', 'Dhirubhai Ambani Institute of Information and Communication Technology', 1, 'BBA- Bachelor of Business Administration', '3CA1451', 'Motila Sir', b'1', '125.00', '../Uploads/Members/41/41/Preview_1620994784.pdf', '2021-05-14 17:49:42', 41, '2021-05-14 23:03:39', 39, b'1'),
(43, 41, 9, 39, NULL, '2021-05-14 23:06:05', 'Science - 500 Facts', 1, '../Uploads/Members/41/43/DP_1620995790.jpg', 2, 10, '500 Facts -Science brings these curious and fascinating facts from science in one book. With interesting, mind-boggling facts, beautiful and relevant images linked to the information, ', 'Gujarat Technological University', 1, 'Computer Science and Engineering', '3CA1452', 'VD Sir', b'1', '110.00', '../Uploads/Members/41/43/Preview_1620995790.pdf', '2021-05-14 18:06:30', 41, '2021-05-14 23:06:05', 39, b'1'),
(44, 41, 9, 39, NULL, '2021-05-14 23:03:50', 'History -- 500 Facts', 6, '../Uploads/Members/41/44/DP_1620996452.jpg', 1, 15, 'History is the study of the past as it is described in written documents. Events occurring before written record are considered prehistory. It is an umbrella term that relates to past events as well as the memory, discovery, collection, organization, pres', 'The Maharaja Sayajirao University ', 1, 'BSW- Bachelor of Social Work', '3CA1453', 'Surin Parikh', b'1', '60.00', '../Uploads/Members/41/44/Preview_1620996452.pdf', '2021-05-14 18:17:31', 41, '2021-05-14 23:03:50', 39, b'1'),
(45, 41, 10, 39, 'The Content is not good....', NULL, 'C Programming', 2, '../Uploads/Members/41/45/DP_1620996671.jpg', 1, 12, 'This book teaches some basic concept of C language with clear and easy steps. The book explains the method to organize programs and work with variables, operators, I/O, pointers, functions, etc.', '	Nirma University', 1, 'MCA', '3CA1454', 'Bhavin Shah', b'1', '80.00', '../Uploads/Members/41/45/Preview_1620996671.pdf', '2021-05-14 18:21:11', 41, '2021-05-15 17:25:55', 39, b'1'),
(46, 41, 9, 39, NULL, '2021-05-14 23:06:03', 'Business Economics ', 3, '../Uploads/Members/41/46/DP_1620996945.jpg', 2, 50, 'The book has been primarily designed for the students of C.A. Foundation course for the subject Business Economics. It has been revised and remodeled according to the newly introduced C.A. Foundation course', 'Indian Institute of Technology Gandhinagar', 1, 'BBA- Bachelor of Business Administration', '3CA1455', 'Rushabh Shah', b'1', '60.00', '../Uploads/Members/41/46/Preview_1620996945.pdf', '2021-05-14 18:25:45', 41, '2021-05-14 23:06:03', 39, b'1'),
(47, 42, 10, 39, 'The Content Is not Good', NULL, 'The Maths Book: Big Ideas Simply Explained', 5, '../Uploads/Members/42/47/DP_1620997362.jpg', 1, 50, 'Discover more than 85 of the most important mathematical ideas, theorems, and proofs ever devised with this beautifully illustrated book. Get to know the great minds whose revolutionary discoveries changed our world today.', 'Sardar Patel University', 1, 'B.Sc. Mathematics', '3CA1456', 'Motila Sir', b'1', '50.00', '../Uploads/Members/42/47/Preview_1620997362.pdf', '2021-05-14 18:32:42', 42, '2021-05-14 23:05:54', 39, b'1'),
(48, 42, 10, 39, 'The Content is not Proper....', NULL, 'Secret of the Red Arrow', 4, '../Uploads/Members/42/48/DP_1620997520.jpg', 3, 90, 'Teenagers Frank and Joe Hardy are supposedly “retired” from their detective work. But there is a new mystery in Bayport that needs their investigative expertise—and fast!', 'Gujarat University', 1, 'BFA- Bachelor of Fine Arts', '3CA1457', 'Sonia Mittal', b'1', '120.00', '../Uploads/Members/42/48/Preview_1620997520.pdf', '2021-05-14 18:35:20', 42, '2021-05-15 17:25:22', 39, b'1'),
(49, 42, 9, 39, 'The Content is not Good', '2021-05-14 23:11:59', 'The Diwali Party ', 7, '../Uploads/Members/42/49/DP_1620997757.jpg', 4, 100, 'It all started with one photograph. They all looked so young and thin. And they wanted to rewind the clock to once again become the people they had been in that photo. It might have been about losing weight, to start off with, but the journey quickly beca', 'Sardar Vallabhbhai National Institute of Technology', 1, 'Animation, Graphics and Multimedia', '3CA1457', 'Rajan Datt', b'1', '25.00', '../Uploads/Members/42/49/Preview_1620997757.pdf', '2021-05-14 18:39:14', 42, '2021-05-14 23:11:59', 39, b'1'),
(50, 42, 7, 39, 'The Content is not good', NULL, 'Superman: Action Comics', 8, '../Uploads/Members/42/50/DP_1620997944.jpg', 4, 60, 'A lavish hardcover collects the first two volume of legendary SUPERMAN writer Dan Jurgens and superstar artists Patch Zircher & Tyler Kirkham’s bold reimagining of the greatest superhero of all time!', 'Ahmedabad University', 1, 'Animation, Graphics and Multimedia', '3CA1459', 'Surin Parikh', b'1', '30.00', '../Uploads/Members/42/50/Preview_1620997944.pdf', '2021-05-14 18:42:23', 42, '2021-05-14 23:09:22', 42, b'1'),
(51, 42, 7, NULL, NULL, NULL, 'Java Programming', 2, '../Uploads/Members/42/51/DP_1620998080.jpg', 2, 55, ' The book takes you in the direction of mastering the entire spectrum of Java 8-from generics to security enhancements, from new applet deployment enhancements to networking, from multiple threads to JavaBeans, from JDBC to file handling and much more. De', '	Nirma University', 1, 'MCA', '3CA1460', 'Rushabh Shah', b'1', '180.00', '../Uploads/Members/42/51/Preview_1620998080.pdf', '2021-05-14 18:44:40', 42, '2021-05-14 18:44:55', 42, b'1');

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
(39, 41, 'Attachment_1620994783.pdf', '../Uploads/Members/41/41/Attachments/Attachment_1620994783.pdf', '2021-05-14 17:49:43', 41, '2021-05-14 17:49:43', 41, b'1'),
(41, 43, 'Attachment_1620995790.pdf', '../Uploads/Members/41/43/Attachments/Attachment_1620995790.pdf', '2021-05-14 18:06:30', 41, '2021-05-14 18:06:30', 41, b'1'),
(42, 44, 'Attachment_1620996452.pdf', '../Uploads/Members/41/44/Attachments/Attachment_1620996452.pdf', '2021-05-14 18:17:32', 41, '2021-05-14 18:17:32', 41, b'1'),
(43, 45, 'Attachment_1620996671.pdf', '../Uploads/Members/41/45/Attachments/Attachment_1620996671.pdf', '2021-05-14 18:21:11', 41, '2021-05-14 18:21:11', 41, b'1'),
(44, 46, 'Attachment_1620996945.pdf', '../Uploads/Members/41/46/Attachments/Attachment_1620996945.pdf', '2021-05-14 18:25:45', 41, '2021-05-14 18:25:45', 41, b'1'),
(45, 47, 'Attachment_1620997362.pdf', '../Uploads/Members/42/47/Attachments/Attachment_1620997362.pdf', '2021-05-14 18:32:42', 42, '2021-05-14 18:32:42', 42, b'1'),
(46, 48, 'Attachment_1620997520.pdf', '../Uploads/Members/42/48/Attachments/Attachment_1620997520.pdf', '2021-05-14 18:35:20', 42, '2021-05-14 18:35:20', 42, b'1'),
(47, 49, 'Attachment_1620997756.pdf', '../Uploads/Members/42/49/Attachments/Attachment_1620997756.pdf', '2021-05-14 18:39:16', 42, '2021-05-14 18:39:16', 42, b'1'),
(48, 50, 'Attachment_1620997944.pdf', '../Uploads/Members/42/50/Attachments/Attachment_1620997944.pdf', '2021-05-14 18:42:24', 42, '2021-05-14 18:42:24', 42, b'1'),
(49, 51, 'Attachment_1620998080.pdf', '../Uploads/Members/42/51/Attachments/Attachment_1620998080.pdf', '2021-05-14 18:44:40', 42, '2021-05-14 18:44:40', 42, b'1');

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
(36, 2, 'Aditi', 'Padsala', 'aditipadsala2000@gmail.com', 'Aditi@123', b'1', '2021-05-13 18:30:09', 1, '2021-05-13 18:30:09', 1, b'1'),
(37, 2, 'Hardik', 'Solanki', 'hardiksolanki200224@gmail.com', 'Hardik@123', b'1', '2021-05-13 18:35:24', 1, '2021-05-13 18:37:55', 37, b'1'),
(38, 3, 'Neha', 'Padsala', 'nehapadsala98@gmail.com', 'Neha@123', b'1', '2021-05-14 12:41:53', 1, '2021-05-14 12:44:53', 38, b'1'),
(39, 3, 'Parth', 'Solanki', 'parthsolanki1295@gmail.com', 'Parth@123', b'1', '2021-05-14 12:44:07', 38, '2021-05-14 12:44:07', 38, b'1'),
(41, 1, 'Vishal', 'Patel', 'vishupatel96246@gmail.com', 'Vishu@123', b'1', '2021-05-14 14:04:04', NULL, '2021-05-14 14:04:23', 41, b'1'),
(42, 1, 'Akash', 'Solanki', 'sparth361998@gmail.com', 'Akash@123', b'1', '2021-05-14 18:28:31', NULL, '2021-05-14 18:28:50', 42, b'1');

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
(24, 36, NULL, NULL, NULL, '+81', '9624693589', NULL, '', '', '', '', '', '', NULL, NULL, '2021-05-13 18:30:09', 1, '2021-05-13 18:30:09', 1),
(25, 37, NULL, NULL, NULL, '93', '9624693588', NULL, '', '', '', '', '', '', NULL, NULL, '2021-05-13 18:35:24', 1, '2021-05-13 18:35:24', 1),
(26, 38, NULL, NULL, '', '91', '9624578945', '../Uploads/Members/38/DP_1620976493.png', '', '', '', '', '', '', NULL, NULL, '2021-05-14 12:41:53', 1, '2021-05-14 12:44:53', 38),
(27, 39, NULL, NULL, NULL, '91', '9624578948', NULL, '', '', '', '', '', '', NULL, NULL, '2021-05-14 12:44:07', 38, '2021-05-14 12:44:07', 38),
(28, 41, '2021-05-14', 1, '', '91', '9624693578', '../Uploads/Members/41/DP_1620981612.jpg', 'f-1203', 'carmel cluster', 'Ahmedabad', 'Gujarat', '360006', 'india', 'Gujarat University', 'GLS Institute of Teacher Education', '2021-05-14 14:10:13', 41, '2021-05-14 14:10:13', 41),
(29, 42, '0000-00-00', 1, '', '91', '9624693556', '../Uploads/Members/42/DP_1620997226.jpg', 'G-1501', 'carmel cluster', 'Ahmedabad', 'Gujarat', '360006', 'india', 'Gujarat University', 'Dharmaj College of Education', '2021-05-14 18:30:27', 42, '2021-05-14 18:30:27', 42);

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
(1, 'member', 'This Role is define Members of Notes-Marketplace.', '2021-04-09 06:00:00', 1, '2021-04-09 00:00:23', 1, b'1'),
(2, 'admin', 'Super Admin Can  define admin of Notes-Marketplace.', '2021-04-09 00:17:00', 1, '2021-04-09 00:00:00', 1, b'1'),
(3, 'Super Admin', 'This is a Super Admin Role', '2021-05-06 00:00:00', 1, '2021-05-06 00:00:00', 1, b'1');

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
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `note_category`
--
ALTER TABLE `note_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `note_country`
--
ALTER TABLE `note_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `note_reviews`
--
ALTER TABLE `note_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `note_type`
--
ALTER TABLE `note_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reference_data`
--
ALTER TABLE `reference_data`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reported_note`
--
ALTER TABLE `reported_note`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seller_notes`
--
ALTER TABLE `seller_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `seller_notes_attachment`
--
ALTER TABLE `seller_notes_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `sys_config_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
