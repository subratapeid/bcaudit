-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 07:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bc_audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_bc_details`
--

CREATE TABLE `all_bc_details` (
  `id` int(11) NOT NULL,
  `bca_id` varchar(255) DEFAULT NULL,
  `bca_full_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `bca_contact_no` varchar(20) DEFAULT NULL,
  `bca_email_id` varchar(250) NOT NULL,
  `bc_point_name` varchar(255) DEFAULT NULL,
  `transaction_module` varchar(50) NOT NULL,
  `village` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `bca_bank` varchar(100) NOT NULL,
  `bca_bank_branch` varchar(100) NOT NULL,
  `bc_point_address` varchar(250) NOT NULL,
  `abe_name` varchar(250) NOT NULL,
  `abm_name` varchar(250) NOT NULL,
  `rm_name` varchar(250) NOT NULL,
  `zm_name` varchar(250) NOT NULL,
  `last_update_by_id` varchar(20) NOT NULL,
  `last_update_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `created_by_id` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_bc_details`
--

INSERT INTO `all_bc_details` (`id`, `bca_id`, `bca_full_name`, `first_name`, `middle_name`, `last_name`, `bca_contact_no`, `bca_email_id`, `bc_point_name`, `transaction_module`, `village`, `location`, `district`, `state`, `pin`, `landmark`, `bca_bank`, `bca_bank_branch`, `bc_point_address`, `abe_name`, `abm_name`, `rm_name`, `zm_name`, `last_update_by_id`, `last_update_date`, `status`, `created_by_id`, `created_date`) VALUES
(1, 'BC1234', 'Akash Rj', 'Akash', 'Kumar', 'Paul', '9876545678', 'akash@gmail.com', 'BcPoint Name-1', 'terminal', 'agra', 'delhi', 'Delhi North', 'Delhi', '754632', 'tajmahal', 'SBI', 'Nirtali', 'my addres with full details', 'ABE Name', 'ABM Name', 'RM Name', 'ZM Name', '', '2024-07-19 08:32:33', 'active', '1', '2024-07-19 08:32:33'),
(2, 'BC23456', 'Suresh K', 'Suresh', 'kumar', 'K', '9876787689', '', 'BC Point Name-2', '', '', 'Location', '', 'ste bc', '', '', '', '', '', 'ABE Name', '', '', '', '', '2024-07-19 08:32:33', 'active', '1', '2024-07-19 08:32:33'),
(68, 'BC001', NULL, 'John', 'KH', 'Doe', '9857646445', 'john.doe@example.com', 'Point A', 'android', 'Village1', 'Location1', 'District1', 'State1', '123456', 'Near School', 'ABC Bank', 'Branch A', 'Address 1', 'Alice', 'Bob', 'Charlie', 'David', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(69, 'BC002', NULL, 'Jane', 'JG', 'Smith', '9584756483', 'jane.smith@example.com', 'Point B', 'kiosk', 'Village2', 'Location2', 'District2', 'State2', '654321', 'Near Park', 'XYZ Bank', 'Branch B', 'Address 2', 'Emma', 'Frank', 'Grace', 'Hannah', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(70, 'BC003', NULL, 'Michael', '', 'Johnson', '9409589849', 'michael.johnson@example.com', 'Point C', 'terminal', 'Village3', 'Location3', 'District3', 'State3', '789012', 'Near Mall', 'LMN Bank', 'Branch C', 'Address 3', 'Oliver', 'Paul', 'Quinn', 'Rachel', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(71, 'BC004', NULL, 'Emily', '', 'Davis', '7846748475', 'emily.davis@example.com', 'Point D', 'ios', 'Village4', 'Location4', 'District4', 'State4', '345678', 'Near Hospital', 'DEF Bank', 'Branch D', 'Address 4', 'Sophia', 'Tom', 'Uma', 'Victor', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(72, 'BC005', NULL, 'Daniel', 'GH', 'Brown', '9857646445', 'daniel.brown@example.com', 'Point E', 'android', 'Village5', 'Location5', 'District5', 'State5', '876543', 'Near Library', 'GHI Bank', 'Branch E', 'Address 5', 'William', 'Xander', 'Yara', 'Zoe', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(73, 'BC006', NULL, 'Olivia', '', 'Wilson', '9584756483', 'olivia.wilson@example.com', 'Point F', 'kiosk', 'Village6', 'Location6', 'District6', 'State6', '543210', 'Near Cinema', 'JKL Bank', 'Branch F', 'Address 6', 'Abigail', 'Benjamin', 'Chloe', 'Dylan', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(74, 'BC007', NULL, 'James', 'RT', 'Moore', '9409589849', 'james.moore@example.com', 'Point G', 'terminal', 'Village7', 'Location7', 'District7', 'State7', '210987', 'Near Bridge', 'MNO Bank', 'Branch G', 'Address 7', 'Ethan', 'Fiona', 'Gabriel', 'Hannah', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(75, 'BC008', NULL, 'Isabella', '', 'Taylor', '7846748475', 'isabella.taylor@example.com', 'Point H', 'ios', 'Village8', 'Location8', 'District8', 'State8', '98765', 'Near Stadium', 'PQR Bank', 'Branch H', 'Address 8', 'Jacob', 'Kate', 'Liam', 'Monica', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(76, 'BC009', NULL, 'Lucas', '', 'Anderson', '9857646445', 'lucas.anderson@example.com', 'Point I', 'android', 'Village9', 'Location9', 'District9', 'State9', '456789', 'Near Temple', 'STU Bank', 'Branch I', 'Address 9', 'Noah', 'Olivia', 'Patrick', 'Quinn', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(77, 'BC010', NULL, 'Charlotte', 'VG', 'Martinez', '9584756483', 'charlotte.martinez@example.com', 'Point J', 'kiosk', 'Village10', 'Location10', 'District10', 'State10', '567890', 'Near Lake', 'VWX Bank', 'Branch J', 'Address 10', 'Ryan', 'Stella', 'Tyler', 'Uma', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(78, 'BC011', NULL, 'Henry', 'FR', 'Thomas', '9409589849', 'henry.thomas@example.com', 'Point K', 'terminal', 'Village11', 'Location11', 'District11', 'State11', '678901', 'Near Factory', 'YZA Bank', 'Branch K', 'Address 11', 'Victoria', 'William', 'Xander', 'Yara', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(79, 'BC012', NULL, 'Amelia', '', 'Harris', '7846748475', 'amelia.harris@example.com', 'Point L', 'ios', 'Village12', 'Location12', 'District12', 'State12', '789012', 'Near Church', 'BCD Bank', 'Branch L', 'Address 12', 'Zachary', 'Anna', 'Brandon', 'Chris', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(80, 'BC013', NULL, 'Benjamin', '', 'Clark', '9857646445', 'benjamin.clark@example.com', 'Point M', 'android', 'Village13', 'Location13', 'District13', 'State13', '890123', 'Near Post Office', 'EFG Bank', 'Branch M', 'Address 13', 'Diana', 'Eric', 'Freya', 'George', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(81, 'BC014', NULL, 'Sophia', 'RE', 'Lewis', '9584756483', 'sophia.lewis@example.com', 'Point N', 'kiosk', 'Village14', 'Location14', 'District14', 'State14', '901234', 'Near School', 'HJI Bank', 'Branch N', 'Address 14', 'Henry', 'Isabella', 'Jack', 'Karen', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(82, 'BC015', NULL, 'Alexander', 'DE', 'Walker', '9409589849', 'alexander.walker@example.com', 'Point O', 'terminal', 'Village15', 'Location15', 'District15', 'State15', '12345', 'Near Market', 'JKL Bank', 'Branch O', 'Address 15', 'Liam', 'Mia', 'Noah', 'Olivia', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(83, 'BC016', NULL, 'Evelyn', '', 'Young', '7846748475', 'evelyn.young@example.com', 'Point P', 'ios', 'Village16', 'Location16', 'District16', 'State16', '123456', 'Near University', 'LMN Bank', 'Branch P', 'Address 16', 'Paul', 'Quinn', 'Rachel', 'Sam', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(84, 'BC017', NULL, 'Jack', 'SE', 'Robinson', '9857646445', 'jack.robinson@example.com', 'Point Q', 'android', 'Village17', 'Location17', 'District17', 'State17', '234567', 'Near Hotel', 'NOP Bank', 'Branch Q', 'Address 17', 'Tina', 'Uma', 'Victor', 'Will', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(85, 'BC018', NULL, 'Harper', '', 'Walker', '9584756483', 'harper.walker@example.com', 'Point R', 'kiosk', 'Village18', 'Location18', 'District18', 'State18', '345678', 'Near Bus Stop', 'OPQ Bank', 'Branch R', 'Address 18', 'Xander', 'Yara', 'Zoe', 'Adam', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(86, 'BC019', NULL, 'Jackson', 'SO', 'Lewis', '9409589849', 'jackson.lewis@example.com', 'Point S', 'terminal', 'Village19', 'Location19', 'District19', 'State19', '456789', 'Near Park', 'RST Bank', 'Branch S', 'Address 19', 'Bella', 'Chloe', 'Dylan', 'Emily', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16'),
(87, 'BC020', NULL, 'Grace', 'YP', 'White', '7846748475', 'grace.white@example.com', 'Point T', 'ios', 'Village20', 'Location20', 'District20', 'State20', '567890', 'Near Gas Station', 'UVW Bank', 'Branch T', 'Address 20', 'Fiona', 'Gabriel', 'Hannah', 'Jack', '', '2024-07-22 14:22:16', 'active', '1', '2024-07-22 14:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `all_user_data`
--

CREATE TABLE `all_user_data` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `user_first_name` varchar(255) DEFAULT NULL,
  `user_last_name` varchar(255) DEFAULT NULL,
  `user_role` varchar(50) NOT NULL,
  `is_approved` int(11) NOT NULL,
  `password_status` varchar(20) NOT NULL DEFAULT 'default',
  `status` varchar(50) DEFAULT NULL,
  `created_by_id` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_user_data`
--

INSERT INTO `all_user_data` (`user_id`, `username`, `emp_id`, `email_id`, `password`, `mobile_no`, `user_first_name`, `user_last_name`, `user_role`, `is_approved`, `password_status`, `status`, `created_by_id`, `created_date`) VALUES
(1, 'admin', 'A001', 'admin@gmail.com', '$2y$10$3//i7l2bY/e8DNt1koc/A.VboKTv2vhjpxP2RUL3HkWvdM0PA7SdW', '876545673', 'Admin', 'User', 'auditor', 1, 'default', 'Active', '', '2024-07-22 17:54:36'),
(2, 'user2', 'A002', 'user2@mail.com', '$2y$10$SE17JipojI75BABWjvajuO5pQqAfmti7u0P6qKSWlU41seLPljXeK', '854656844', 'user2', 'test', 'admin', 1, 'default', 'Active', '', '2024-07-22 17:54:36'),
(3, 'user3', 'A003', 'user3@gmail.com', '$2y$10$SE17JipojI75BABWjvajuO5pQqAfmti7u0P6qKSWlU41seLPljXeK', '', 'User3', 'Test', 'auditor', 1, 'default', 'Active', '', '2024-07-22 17:54:36'),
(4, 'maheshs', 'INT101010', 'maheshs@integramicro.co.in', '$2y$10$SE17JipojI75BABWjvajuO5pQqAfmti7u0P6qKSWlU41seLPljXeK', '', 'Mahesh', 'S', 'auditor', 1, 'default', 'Active', '', '2024-07-22 17:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `auditor_and_signature`
--

CREATE TABLE `auditor_and_signature` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `signature_data_url` text NOT NULL,
  `audit_number` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditor_and_signature`
--

INSERT INTO `auditor_and_signature` (`id`, `emp_id`, `name`, `signature_data_url`, `audit_number`, `date`) VALUES
(118, 'A001', '', '/bcaudit/codes/uploads/signatures/A001_AUD345742_66a8d474b8809.png', 'AUD345742', '2024-07-30 11:47:00'),
(120, 'INT101010', '', '/bcaudit/codes/uploads/signatures/INT101010_AUD345742_66a8d49341646.png', 'AUD345742', '2024-07-30 11:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `auditor_observation`
--

CREATE TABLE `auditor_observation` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(255) DEFAULT NULL,
  `conclusion` text NOT NULL,
  `recommendations` text NOT NULL,
  `created_by_id` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditor_observation`
--

INSERT INTO `auditor_observation` (`id`, `audit_number`, `conclusion`, `recommendations`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(128, 'AUD345736', 'jshfgjh', 'sdhjsdjh', '1', '2024-07-21 21:07:41', '', '2024-07-21 21:07:41'),
(129, 'AUD345742', 'Conclusion ool', 'Recommended i', '4', '2024-07-22 19:31:01', '', '2024-07-22 19:31:01'),
(130, 'AUD345743', 'Jskskksbs shsjsnbw suzbbssshjsjs sjsjjs', 'Hsjksks suskks  sisns sujs', '1', '2024-07-22 20:23:05', '', '2024-07-22 20:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `audit_list`
--

CREATE TABLE `audit_list` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `progress` varchar(50) DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_list`
--

INSERT INTO `audit_list` (`id`, `audit_number`, `status`, `progress`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(72, 'AUD345736', 'submited', '9', 1, '2024-07-20 06:59:39', '1', '2024-07-21 21:07:41'),
(74, 'AUD345737', 'inprogress', '1', 1, '2024-07-20 20:35:46', '1', '2024-07-21 12:52:13'),
(75, 'AUD345738', 'inprogress', '1', 1, '2024-07-20 20:50:52', '', '2024-07-20 20:50:52'),
(76, 'AUD345739', 'inprogress', '1', 1, '2024-07-21 07:44:42', '1', '2024-07-21 12:42:41'),
(78, 'AUD345740', 'inprogress', '2', 1, '2024-07-21 12:05:01', '1', '2024-07-23 12:42:47'),
(79, 'AUD345741', 'inprogress', '1', 1, '2024-07-21 12:55:07', '1', '2024-07-21 12:55:47'),
(80, 'AUD345742', 'submited', '9', 4, '2024-07-22 19:27:15', '4', '2024-07-22 19:31:01'),
(81, 'AUD345743', 'submited', '9', 1, '2024-07-22 20:20:25', '1', '2024-07-22 20:23:05'),
(82, 'AUD345744', 'inprogress', '3', 1, '2024-07-23 12:26:30', '', '2024-07-23 13:10:35'),
(83, 'INT345745', 'inprogress', '1', 1, '2024-07-27 19:15:12', '', '2024-07-27 19:15:12'),
(84, 'INT345746', 'inprogress', '1', 1, '2024-07-29 16:02:05', '', '2024-07-29 16:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `bca_and_bcpoint_details`
--

CREATE TABLE `bca_and_bcpoint_details` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(255) DEFAULT NULL,
  `bca_id` varchar(255) DEFAULT NULL,
  `bca_name` varchar(250) NOT NULL,
  `bca_contact_no` varchar(50) NOT NULL,
  `bca_email_id` varchar(250) NOT NULL,
  `bc_point_name` varchar(250) NOT NULL,
  `transaction_module` varchar(20) NOT NULL,
  `village` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `bca_bank` varchar(100) NOT NULL,
  `bca_bank_branch` varchar(70) NOT NULL,
  `bc_point_address` text NOT NULL,
  `bca_photo_url` varchar(255) DEFAULT NULL,
  `bc_point_photo_url` varchar(250) NOT NULL,
  `bca_signature_url` varchar(250) DEFAULT NULL,
  `bc_stamp_url` varchar(250) DEFAULT NULL,
  `created_by_id` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bca_and_bcpoint_details`
--

INSERT INTO `bca_and_bcpoint_details` (`id`, `audit_number`, `bca_id`, `bca_name`, `bca_contact_no`, `bca_email_id`, `bc_point_name`, `transaction_module`, `village`, `location`, `district`, `state`, `pin`, `landmark`, `bca_bank`, `bca_bank_branch`, `bc_point_address`, `bca_photo_url`, `bc_point_photo_url`, `bca_signature_url`, `bc_stamp_url`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(72, 'AUD345736', 'K060200072', 'DRONACHARYA RABHA', '7002966103', 'noemail@gmail.com', 'no bc point name', 'android', 'NAMATI KA', 'NAMATI KA', 'UDALGURI', 'Asam', '90909', 'No landmark', 'AGVB', 'MAZBAT', 'Bc point Address', 'uploads/BcaPhoto_K060200072_AUD345736_20-Jul-2024_06-53-11.png', 'uploads/BcPointPhoto_K060200072_AUD345736_20-Jul-2024_06-53-11.png', 'uploads/BcSignaturePhoto_DRONACHARYA RABHA_AUD345736_20-Jul-2024_07-30-41.png', 'uploads/BcStampPhoto_DRONACHARYA RABHA_AUD345736_20-Jul-2024_07-23-13.png', '1', '2024-07-20 06:53:11', '1', '2024-07-20 07:30:41'),
(76, 'AUD345737', 'BC23456', 'Suresh kumar K', '9876787689', 'subrataporel65@gmail.com', 'BC Point Name-2', 'kiosk', 'NAMATI KA', 'NAMATI KA', 'UDALGURI', 'West Bengal', '712614', 'No landmark l', 'AGVB', 'Branch', 'Bc point Address', 'uploads/BcaPhoto_Suresh kumar K_AUD345737_23-Jul-2024_08-07-49.png', 'uploads/BcPointPhoto_Suresh kumar K_AUD345737_23-Jul-2024_08-07-49.png', 'uploads/BcSignaturePhoto_Suresh kumar K_AUD345737_23-Jul-2024_08-07-49.png', '', '1', '2024-07-20 20:35:46', '1', '2024-07-23 08:07:49'),
(77, 'AUD345738', 'K060200072', 'DRONACHARYA lk RABHA', '7002966103', 'noemail@gmail.com', 'no bc point name', 'android', 'NAMATI KA', 'NAMATI KA', 'UDALGURI', 'Asam', '90909', 'No landmark', 'AGVB', 'MAZBAT', 'Bc point Address', 'uploads/BcaPhoto_DRONACHARYA lk RABHA_AUD345738_23-Jul-2024_12-23-51.png', 'uploads/BcPointPhoto_DRONACHARYA lk RABHA_AUD345738_23-Jul-2024_12-23-51.png', 'uploads/BcSignaturePhoto_DRONACHARYA lk RABHA_AUD345738_23-Jul-2024_12-23-51.png', '', '1', '2024-07-20 20:50:52', '1', '2024-07-23 12:23:51'),
(78, 'AUD345739', 'K060200072', 'DRONACHARYA lk RABHA', '7002966103', 'noemail@gmail.com', 'no bc point name', 'android', 'NAMATI KA', 'NAMATI KA', 'UDALGURI', 'Asam', '90909', 'No landmark', 'AGVB', 'MAZBAT', 'Bc point Address', 'uploads/BcaPhoto_K060200072_AUD345739_21-Jul-2024_07-44-42.png', 'uploads/BcPointPhoto_K060200072_AUD345739_21-Jul-2024_07-44-42.png', 'uploads/BcaSignature_K060200072_AUD345739_21-Jul-2024_07-44-42.png', '', '1', '2024-07-21 07:44:42', '', '2024-07-21 07:44:42'),
(79, 'AUD345740', 'BC23456', 'subrata p', '9876787689', 'subrataporel65@gmail.com', 'BC Point Name-2', 'android', 'Mogaru', 'Bejai', 'UDALGURI', 'West Bengal', '712614', 'No landmark l', 'State Bank of India', 'branch', 'Bc point Address', 'uploads/BcaPhoto_subrata p_AUD345740_23-Jul-2024_12-37-45.png', 'uploads/BcPointPhoto_subrata p_AUD345740_23-Jul-2024_12-37-45.png', 'uploads/BcSignaturePhoto_subrata p_AUD345740_23-Jul-2024_12-37-45.png', '', '1', '2024-07-21 08:03:42', '1', '2024-07-23 12:37:45'),
(80, 'AUD345741', 'BC23456', 'subrata p', '9876787689', 'subrataporel65@gmail.com', 'BC Point Name-2', 'terminal', 'Mogaru', 'Bejai', 'Mangalore', 'West Bengal', '560064', 'Landmark', 'bfbdb', 'bfdffbd', 'Bc point Address', 'uploads/BcaPhoto_BC23456_AUD345741_21-Jul-2024_12-55-07.png', 'uploads/BcPointPhoto_BC23456_AUD345741_21-Jul-2024_12-55-07.png', 'uploads/BcaSignature_BC23456_AUD345741_21-Jul-2024_12-55-07.png', '', '1', '2024-07-21 12:55:07', '', '2024-07-21 12:55:07'),
(81, 'AUD345742', 'Bc1234', 'Akash Kumar Paul', '9876545678', 'akash@gmail.com', 'BcPoint Name-1', 'terminal', 'agra', 'delhi', 'Delhi North', 'Delhi', '754632', 'tajmahal', 'SBI', 'Nirtali', 'Bc point Address', 'uploads/BcaPhoto_Akash Kumar Paul_AUD345742_30-Jul-2024_17-17-11.png', 'uploads/BcPointPhoto_Akash Kumar Paul_AUD345742_30-Jul-2024_17-17-11.png', 'uploads/BcSignaturePhoto_Akash Kumar Paul_AUD345742_30-Jul-2024_17-17-11.png', 'uploads/BcStampPhoto_Akash Kumar Paul_AUD345742_28-Jul-2024_07-43-06.png', '4', '2024-07-22 19:27:15', '1', '2024-07-30 17:17:11'),
(82, 'AUD345743', 'BC003', 'Michael Johnson', '9409589849', 'michael.johnson@example.com', 'Point C', 'terminal', 'Village3', 'Location3', 'District3', 'State3', '789012', 'Near Mall', 'LMN Bank', 'Branch C', 'Bc point Address', 'uploads/BcaPhoto_Michael Johnson_AUD345743_29-Jul-2024_16-01-16.png', 'uploads/BcPointPhoto_Michael Johnson_AUD345743_29-Jul-2024_16-01-16.png', 'uploads/BcSignaturePhoto_Michael Johnson_AUD345743_29-Jul-2024_16-01-16.png', '', '1', '2024-07-22 20:20:25', '1', '2024-07-29 16:01:16'),
(83, 'AUD345744', 'BC1234', 'Akash Kumar Paul', '9876545678', 'akash@gmail.com', 'BcPoint Name-1', 'terminal', 'agra', 'delhi', 'Delhi North', 'Delhi', '754632', 'tajmahal', 'SBI', 'Nirtali', 'Bc point Address', 'uploads/BcaPhoto_BC1234_AUD345744_23-Jul-2024_12-26-30.png', 'uploads/BcPointPhoto_BC1234_AUD345744_23-Jul-2024_12-26-30.png', 'uploads/BcSignaturePhoto_Akash Kumar Paul_AUD345744_23-Jul-2024_12-32-47.png', '', '1', '2024-07-23 12:26:30', '1', '2024-07-23 12:32:47'),
(84, 'INT345745', 'BC23456', 'subrata p', '9876787689', 'subrataporel65@gmail.com', 'BC Point Name-2', 'android', 'NAMATI KA', 'Location', 'UDALGURI', 'West Bengal', '560064', 'tajmahal', 'bfbdb', 'Mulki', 'Bc point Address', 'uploads/BcaPhoto_BC23456_INT345745_27-Jul-2024_19-15-12.png', 'uploads/BcPointPhoto_BC23456_INT345745_27-Jul-2024_19-15-12.png', 'uploads/BcaSignature_BC23456_INT345745_27-Jul-2024_19-15-12.png', '', '1', '2024-07-27 19:15:12', '', '2024-07-27 19:15:12'),
(85, 'INT345746', 'BC1234', 'Akash Kumar Paul', '9876545678', 'akash@gmail.com', 'BcPoint Name-1', 'terminal', 'agra', 'delhi', 'Delhi North', 'Delhi', '754632', 'tajmahal', 'SBI', 'Nirtali', 'Bc point Address', 'uploads/BcaPhoto_BC1234_INT345746_29-Jul-2024_16-02-05.png', 'uploads/BcPointPhoto_BC1234_INT345746_29-Jul-2024_16-02-05.png', 'uploads/BcaSignature_BC1234_INT345746_29-Jul-2024_16-02-05.png', '', '1', '2024-07-29 16:02:05', '', '2024-07-29 16:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `compliance_verification`
--

CREATE TABLE `compliance_verification` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(20) NOT NULL,
  `bc_point_place` enum('Yes','No') NOT NULL,
  `bc_point_place_remarks` text DEFAULT NULL,
  `bc_point_clean` enum('Yes','No') NOT NULL,
  `bc_point_clean_remarks` text DEFAULT NULL,
  `posters_displayed` enum('Yes','No') NOT NULL,
  `outdated_posters` enum('Yes','No') NOT NULL,
  `posters_remarks` text DEFAULT NULL,
  `customer_alert_dos_donts` enum('Yes','No') NOT NULL,
  `customer_alert_dos_donts_remarks` text DEFAULT NULL,
  `verification_certificate` enum('Yes','No') NOT NULL,
  `verification_certificate_remarks` text DEFAULT NULL,
  `unauthorized_individuals` enum('Yes','No') NOT NULL,
  `unauthorized_individuals_remarks` text DEFAULT NULL,
  `id_card_usage` enum('Yes','No') NOT NULL,
  `id_card_usage_remarks` text DEFAULT NULL,
  `clone_fingerprint` enum('Yes','No') NOT NULL,
  `clone_fingerprint_remarks` text DEFAULT NULL,
  `manual_receipts` enum('Yes','No') NOT NULL,
  `system_generated_receipts` enum('Yes','No') NOT NULL,
  `customer_passbooks` enum('Yes','No') NOT NULL,
  `transaction_slips` enum('Yes','No') NOT NULL,
  `manual_receipts_remarks` text DEFAULT NULL,
  `non_relevant_applications` enum('Yes','No') NOT NULL,
  `non_relevant_applications_remarks` text DEFAULT NULL,
  `blocked_accounts` enum('Yes','No') NOT NULL,
  `blocked_accounts_remarks` text DEFAULT NULL,
  `created_by_id` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compliance_verification`
--

INSERT INTO `compliance_verification` (`id`, `audit_number`, `bc_point_place`, `bc_point_place_remarks`, `bc_point_clean`, `bc_point_clean_remarks`, `posters_displayed`, `outdated_posters`, `posters_remarks`, `customer_alert_dos_donts`, `customer_alert_dos_donts_remarks`, `verification_certificate`, `verification_certificate_remarks`, `unauthorized_individuals`, `unauthorized_individuals_remarks`, `id_card_usage`, `id_card_usage_remarks`, `clone_fingerprint`, `clone_fingerprint_remarks`, `manual_receipts`, `system_generated_receipts`, `customer_passbooks`, `transaction_slips`, `manual_receipts_remarks`, `non_relevant_applications`, `non_relevant_applications_remarks`, `blocked_accounts`, `blocked_accounts_remarks`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(7, 'AUD345736', 'Yes', 'Located at the entrance, very prominent.', 'No', 'Needs cleaning, a lot of dust and dirt.', 'Yes', 'No', 'All posters are up-to-date and properly displayed.', 'Yes', 'Clear and visible to customers.', 'No', 'Certificate is missing, needs to be updated.', 'Yes', 'Observed one unauthorized person handling transactions.', 'Yes', 'Valid ID card is being used by the BCA.', 'No', 'No evidence of clone fingerprint usage found.', 'Yes', 'No', 'Yes', 'No', 'Some manual receipts were issued due to system issues.', 'Yes', 'Observed some non-relevant applications being used.', 'No', 'No blocked accounts were found.changd', '1', '2024-07-21 20:03:05', '1', '2024-07-21 20:05:02'),
(9, 'AUD345742', 'Yes', '', 'No', '', 'Yes', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', 'Yes', 'No', 'No', '', 'Yes', '', 'Yes', '', '4', '2024-07-22 19:28:57', '', '2024-07-22 19:28:57'),
(10, 'AUD345743', 'Yes', '', 'Yes', '', 'No', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', 'No', 'Yes', 'No', '', 'No', '', 'Yes', '', '1', '2024-07-22 20:22:22', '', '2024-07-22 20:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `customer_interaction_data`
--

CREATE TABLE `customer_interaction_data` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_email` varchar(250) DEFAULT NULL,
  `csp_opening_hours` varchar(5) NOT NULL,
  `csp_opening_hours_remarks` text DEFAULT NULL,
  `bca_sits_regularly` varchar(5) NOT NULL,
  `bca_sits_regularly_remarks` text DEFAULT NULL,
  `system_generated_slip` varchar(5) NOT NULL,
  `system_generated_slip_remarks` text DEFAULT NULL,
  `signature_register` varchar(5) NOT NULL,
  `signature_register_remarks` text DEFAULT NULL,
  `passbook_entry` varchar(5) NOT NULL,
  `passbook_entry_remarks` text DEFAULT NULL,
  `balance_confirmation` text DEFAULT NULL,
  `passbook_check` varchar(5) NOT NULL,
  `passbook_check_remarks` text DEFAULT NULL,
  `fee_demand` varchar(5) NOT NULL,
  `fee_demand_remarks` text DEFAULT NULL,
  `satisfaction` varchar(5) NOT NULL,
  `satisfaction_remarks` text DEFAULT NULL,
  `additional_comments` text DEFAULT NULL,
  `cash_withdrawal_delay` varchar(5) NOT NULL,
  `cash_withdrawal_delay_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_interaction_data`
--

INSERT INTO `customer_interaction_data` (`id`, `audit_number`, `customer_name`, `customer_phone`, `customer_email`, `csp_opening_hours`, `csp_opening_hours_remarks`, `bca_sits_regularly`, `bca_sits_regularly_remarks`, `system_generated_slip`, `system_generated_slip_remarks`, `signature_register`, `signature_register_remarks`, `passbook_entry`, `passbook_entry_remarks`, `balance_confirmation`, `passbook_check`, `passbook_check_remarks`, `fee_demand`, `fee_demand_remarks`, `satisfaction`, `satisfaction_remarks`, `additional_comments`, `cash_withdrawal_delay`, `cash_withdrawal_delay_remarks`) VALUES
(1, 'AUD345700', 'subrata p', '09547415324', NULL, 'Yes', '', 'Yes', '', 'No', '', 'No', '', 'No', '', 'o you confirm your balance, whether you visit the branch to update your p', 'Yes', '', 'Yes', '', 'Yes', '', '', 'Yes', ''),
(2, 'AUD345700', 'subrata p', '09547415324', NULL, 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', '', 'No', '', 'Yes', '', 'No', '', '', 'Yes', ''),
(3, 'AUD345700', 'subrata p', '09547415324', NULL, 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'o you confirm your balance, whether you visit the branch to update your p', 'Yes', '', 'No', '', 'No', '', '', 'Yes', ''),
(4, 'AUD345700', 'my name', '09547415324', NULL, 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'o you confirm your balance, whether you visit the branch to update your p', 'Yes', '', 'Yes', '', 'Yes', '', '', 'Yes', ''),
(5, 'AUD345700', 'subrata p', '9547415324', NULL, 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'o you confirm your balance, whether you visit the branch to update your p', 'Yes', '', 'Yes', '', 'Yes', '', '', 'Yes', ''),
(6, 'AUD345691', 'subrata p', '09547415324', NULL, 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'No', '', '', 'Yes', '', 'Yes', '', 'Yes', '', '', 'No', ''),
(7, 'AUD345701', 'Hhdd', 'Bzjz', NULL, 'Yes', 'Babsb', 'Yes', 'BzbhJ', 'Yes', 'Hansna', 'Yes', 'Bzhjka ahsus', 'Yes', 'BNaj susuha', 'Gajka ahahba', 'Yes', 'BBba abahja', 'Yes', 'Bajajja sjsjjss sh', 'Yes', '', 'BBajia ahahah', 'Yes', 'Bsnsjs shauns'),
(8, 'AUD345701', 'VsI shuabs', 'Jsjsjbs shaj', NULL, 'Yes', 'Bzbzns', 'No', '', 'No', '', 'Yes', '', 'Yes', '', '', 'Yes', '', 'Yes', 'Bbye', 'Yes', '', '', 'Yes', ''),
(9, 'AUD345703', 'subrata p', '09547415324', NULL, 'Yes', 'jhhf jhjf uy', 'Yes', 'jtuy', 'Yes', '', 'No', '', 'Yes', '', 'uyytvu yg ', 'Yes', '', 'No', 'kg uyg', 'Yes', '', 'jyuy ', 'No', ''),
(10, 'AUD345703', 'my name', '09547415324', NULL, 'Yes', 'dthdtht', 'Yes', 'drhhdrh', 'Yes', 'dhdh', 'Yes', 'dhdhd', 'Yes', 'drhrdhrd', '', 'Yes', 'dhrrh', 'Yes', '', 'No', '', 'drhdrhrdh', 'No', ''),
(11, 'AUD345705', 'subrata p', '9547415324', NULL, 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'fgftr', 'Yes', '', 'Yes', '', 'Yes', '', 'trhtrh', 'Yes', ''),
(13, 'AUD345678', 'my name', '9547415324', NULL, 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', '', 'Yes', '', 'Yes', '', 'Yes', '', '', 'Yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `hardware_infrastructure`
--

CREATE TABLE `hardware_infrastructure` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(250) NOT NULL,
  `laptop_desktop` varchar(10) DEFAULT NULL,
  `laptop_desktop_remarks` text DEFAULT NULL,
  `printer` varchar(10) DEFAULT NULL,
  `printer_remarks` text DEFAULT NULL,
  `scanner` varchar(10) DEFAULT NULL,
  `scanner_remarks` text DEFAULT NULL,
  `biometric` varchar(10) DEFAULT NULL,
  `biometric_remarks` text DEFAULT NULL,
  `pos_terminal` varchar(10) DEFAULT NULL,
  `pos_terminal_remarks` text DEFAULT NULL,
  `internet_router` varchar(10) DEFAULT NULL,
  `internet_router_remarks` text DEFAULT NULL,
  `ups` varchar(10) DEFAULT NULL,
  `ups_remarks` text DEFAULT NULL,
  `cctv_camera` varchar(10) DEFAULT NULL,
  `cctv_camera_remarks` text DEFAULT NULL,
  `mobile_tablet` varchar(10) DEFAULT NULL,
  `mobile_tablet_remarks` text DEFAULT NULL,
  `counting_machine` varchar(10) DEFAULT NULL,
  `counting_machine_remarks` text DEFAULT NULL,
  `card_reader` varchar(10) DEFAULT NULL,
  `card_reader_remarks` text DEFAULT NULL,
  `external_hdd` varchar(10) DEFAULT NULL,
  `external_hdd_remarks` text DEFAULT NULL,
  `photocopier` varchar(10) DEFAULT NULL,
  `photocopier_remarks` text DEFAULT NULL,
  `other_devices` text DEFAULT NULL,
  `hardware_photo_path` text DEFAULT NULL,
  `hardware_remarks` text DEFAULT NULL,
  `created_by_id` varchar(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) DEFAULT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hardware_infrastructure`
--

INSERT INTO `hardware_infrastructure` (`id`, `audit_number`, `laptop_desktop`, `laptop_desktop_remarks`, `printer`, `printer_remarks`, `scanner`, `scanner_remarks`, `biometric`, `biometric_remarks`, `pos_terminal`, `pos_terminal_remarks`, `internet_router`, `internet_router_remarks`, `ups`, `ups_remarks`, `cctv_camera`, `cctv_camera_remarks`, `mobile_tablet`, `mobile_tablet_remarks`, `counting_machine`, `counting_machine_remarks`, `card_reader`, `card_reader_remarks`, `external_hdd`, `external_hdd_remarks`, `photocopier`, `photocopier_remarks`, `other_devices`, `hardware_photo_path`, `hardware_remarks`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(6, 'AUD345736', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'uploads/HardwarePhoto_AUD345736_21-Jul-2024_16-28-43.png', '', '1', '2024-07-21 15:45:23', '1', '2024-07-21 17:26:06'),
(7, 'AUD345742', 'No', 'aptop or Desktop Computer is Present', 'No', 'Printer device is Present', 'No', 'Scanner is Present', 'No', ' Biometric Device (Fingerprint Scanner) is Present', 'No', ' POS (Point of Sale) Terminal is Present', 'No', ' Internet Router/Modem is Present', 'No', 'UPS (Uninterruptible Power Supply) is Present', 'No', 'CCTV Camera is Present', 'No', ' Mobile Phone or Tablet is Present', 'No', 'Cash Counting Machine is Present', 'No', ' Card Reader is Present', 'No', 'External Hard Drive or USB Drive is Present', 'No', ' Photocopier is Present', 'No Other Devices ', 'uploads/HardwarePhoto_AUD345742_25-Jul-2024_19-09-29.png', 'Remarks for Hardware\'s ', '4', '2024-07-22 19:28:18', '1', '2024-07-25 19:24:25'),
(8, 'AUD345743', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', '', 'uploads/HardwarePhoto_AUD345743_22-Jul-2024_20-21-43.png', '', '1', '2024-07-22 20:21:43', NULL, '2024-07-22 20:21:43'),
(9, 'AUD345744', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', '', 'uploads/HardwarePhoto_AUD345744_23-Jul-2024_13-10-35.png', '', '1', '2024-07-23 13:10:35', '1', '2024-07-23 13:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(50) NOT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'failed',
  `is_blocked` tinyint(1) DEFAULT 0,
  `block_expiry` datetime DEFAULT NULL,
  `is_permanently_blocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `username`, `attempt_time`, `status`, `is_blocked`, `block_expiry`, `is_permanently_blocked`) VALUES
(1, '::1', '', '2024-08-04 02:25:03', 'Failed', 0, NULL, 0),
(2, '::1', '', '2024-08-04 02:25:36', 'Failed', 0, NULL, 0),
(3, '::1', '', '2024-08-04 02:25:50', 'Failed', 0, NULL, 0),
(4, '::1', '', '2024-08-04 02:26:03', 'Failed', 0, NULL, 0),
(5, '::1', '', '2024-08-04 02:26:16', 'Failed', 0, NULL, 0),
(6, '192.168.213.169', '', '2024-08-04 02:29:04', 'Failed', 0, NULL, 0),
(7, '192.168.213.169', '', '2024-08-04 02:29:15', 'Failed', 0, NULL, 0),
(8, '192.168.213.169', '', '2024-08-04 02:29:40', 'Failed', 0, NULL, 0),
(9, '192.168.213.169', '', '2024-08-04 02:29:47', 'Failed', 0, NULL, 0),
(10, '192.168.213.169', '', '2024-08-04 02:29:54', 'Failed', 0, NULL, 0),
(11, '::1', '', '2024-08-04 02:48:20', 'Failed', 0, NULL, 0),
(13, '::1', 'admin@gmail.com', '2024-08-04 03:30:34', 'failed', 0, NULL, 0),
(14, '::1', 'admin@gmail.com', '2024-08-04 03:30:42', 'failed', 0, NULL, 0),
(15, '::1', 'admin@gmail.com', '2024-08-04 03:30:49', 'failed', 0, NULL, 0),
(16, '::1', 'admin@gmail.com', '2024-08-04 03:31:15', 'failed', 0, NULL, 0),
(17, '::1', 'admin@gmail.com', '2024-08-04 03:34:48', 'success', 0, NULL, 0),
(18, '::1', 'admin@gmail.comj', '2024-08-04 03:35:16', 'failed', 0, NULL, 0),
(19, '::1', 'admin@gmail.comj', '2024-08-04 03:35:47', 'failed', 0, NULL, 0),
(20, '::1', 'admin@gmail.com', '2024-08-04 03:36:12', 'failed', 0, NULL, 0),
(21, '::1', 'admin@gmail.com', '2024-08-04 03:36:30', 'failed', 0, NULL, 0),
(22, '::1', 'admin@gmail.com', '2024-08-04 03:37:05', 'failed', 0, NULL, 0),
(23, '::1', 'admin@gmail.com', '2024-08-04 03:37:29', 'success', 0, NULL, 0),
(24, '::1', 'admin@gmail.com', '2024-08-04 03:38:46', 'failed', 0, NULL, 0),
(25, '::1', 'admin@gmail.com', '2024-08-04 03:39:04', 'failed', 0, NULL, 0),
(26, '::1', 'admin@gmail.com', '2024-08-04 08:03:36', 'failed', 0, NULL, 0),
(27, '::1', 'admin@gmail.com', '2024-08-04 08:03:55', 'failed', 0, NULL, 0),
(28, '::1', 'admin@gmail.com', '2024-08-04 08:29:11', 'success', 1, NULL, 0),
(29, '::1', 'admin@gmail.com', '2024-08-04 08:30:30', 'failed', 0, NULL, 0),
(30, '::1', 'admin@gmail.com', '2024-08-04 08:30:49', 'failed', 0, NULL, 0),
(31, '::1', 'admin@gmail.com', '2024-08-04 08:32:32', 'failed', 0, NULL, 0),
(32, '::1', 'admin@gmail.com', '2024-08-04 08:34:37', 'success', 1, NULL, 0),
(33, '::1', 'admin@gmail.com', '2024-08-04 08:35:28', 'failed', 0, NULL, 0),
(34, '::1', 'admin@gmail.com', '2024-08-04 08:35:36', 'failed', 0, NULL, 0),
(35, '::1', 'admin@gmail.com', '2024-08-04 08:37:46', 'success', 0, NULL, 0),
(36, '::1', 'admin@gmail.com', '2024-08-04 08:59:04', 'failed', 0, NULL, 0),
(37, '::1', 'admin@gmail.com', '2024-08-04 08:59:18', 'failed', 0, NULL, 0),
(38, '::1', 'admin@gmail.com', '2024-08-04 09:03:07', 'failed', 0, NULL, 0),
(39, '::1', 'admin@gmail.com', '2024-08-04 09:03:23', 'failed', 0, NULL, 0),
(40, '::1', 'admin@gmail.com', '2024-08-04 09:03:32', 'failed', 0, NULL, 0),
(41, '::1', 'admin@gmail.com', '2024-08-04 09:04:07', 'failed', 0, NULL, 0),
(42, '::1', 'admin@gmail.com', '2024-08-04 09:08:09', 'failed', 0, NULL, 0),
(43, '::1', 'admin@gmail.com', '2024-08-04 09:08:32', 'failed', 0, NULL, 0),
(44, '::1', 'admin@gmail.com', '2024-08-04 09:08:38', 'failed', 0, NULL, 0),
(45, '::1', 'admin@gmail.com', '2024-08-04 09:08:46', 'failed', 0, NULL, 0),
(46, '::1', 'admin@gmail.com', '2024-08-04 09:18:22', 'failed', 0, NULL, 0),
(47, '::1', 'admin@gmail.como', '2024-08-04 09:18:35', 'failed', 0, NULL, 0),
(48, '::1', 'admin@gmail.com', '2024-08-04 15:48:25', 'failed', 0, NULL, 0),
(49, '::1', 'admin@gmail.com', '2024-08-04 15:49:15', 'failed', 0, NULL, 0),
(50, '::1', 'admin@gmail.com', '2024-08-04 15:53:57', 'failed', 1, '2024-08-04 18:00:02', 0),
(51, '::1', 'admin@gmail.com', '2024-08-04 15:54:09', 'failed', 1, '2024-08-04 18:00:02', 0),
(52, '::1', 'admin@gmail.com', '2024-08-04 15:54:17', 'failed', 1, '2024-08-04 18:00:02', 0),
(53, '::1', 'admin@gmail.com', '2024-08-04 15:54:37', 'failed', 1, '2024-08-04 18:00:02', 0),
(54, '::1', 'admin@gmail.com', '2024-08-04 15:54:49', 'failed', 1, '2024-08-04 18:00:02', 0),
(55, '::1', 'admin@gmail.com', '2024-08-04 16:02:27', 'failed', 1, '2024-08-04 18:12:07', 0),
(56, '::1', 'admin@gmail.com', '2024-08-04 16:02:56', 'failed', 1, '2024-08-04 18:12:07', 0),
(57, '::1', 'admin@gmail.com', '2024-08-04 16:03:03', 'failed', 1, '2024-08-04 18:12:07', 0),
(58, '::1', 'admin@gmail.com', '2024-08-04 16:03:21', 'success', 1, '2024-08-04 18:12:07', 0),
(59, '::1', 'admin@gmail.coml', '2024-08-04 16:03:54', 'failed', 0, NULL, 0),
(60, '::1', 'admin@gmail.comi', '2024-08-04 16:04:28', 'failed', 0, NULL, 0),
(61, '::1', 'admin@gmail.com', '2024-08-04 16:04:54', 'failed', 1, '2024-08-04 18:12:07', 0),
(62, '::1', 'admin@gmail.com', '2024-08-04 16:05:55', 'failed', 1, '2024-08-04 18:12:07', 0),
(63, '::1', 'admin@gmail.coml', '2024-08-04 16:16:46', 'failed', 0, NULL, 0),
(64, '::1', 'admin@gmail.com', '2024-08-04 16:20:15', 'success', 1, '2024-08-04 18:26:10', 0),
(65, '::1', 'admin@gmail.com', '2024-08-04 16:20:32', 'failed', 1, '2024-08-04 18:26:10', 0),
(66, '::1', 'admin@gmail.com', '2024-08-04 16:20:43', 'failed', 1, '2024-08-04 18:26:10', 0),
(67, '::1', 'admin@gmail.com', '2024-08-04 16:20:54', 'failed', 1, '2024-08-04 18:26:10', 0),
(68, '::1', 'admin@gmail.com', '2024-08-04 16:21:01', 'failed', 1, '2024-08-04 18:26:10', 0),
(69, '::1', 'admin@gmail.com', '2024-08-04 16:21:06', 'failed', 1, '2024-08-04 18:26:10', 0),
(70, '::1', 'admin@gmail.com', '2024-08-04 16:42:03', 'success', 0, NULL, 0),
(71, '::1', 'admin@gmail.com', '2024-08-04 16:45:59', 'success', 0, NULL, 0),
(72, '::1', 'admin@gmail.com', '2024-08-04 16:47:11', 'success', 0, NULL, 0),
(73, '::1', 'admin@gmail.com', '2024-08-04 16:49:37', 'success', 0, NULL, 0),
(74, '::1', 'admin@gmail.com', '2024-08-04 16:52:37', 'success', 0, NULL, 0),
(75, '::1', 'admin@gmail.com', '2024-08-04 16:57:38', 'failed', 0, NULL, 0),
(76, '::1', 'admin@gmail.com', '2024-08-04 17:00:08', 'failed', 0, NULL, 0),
(77, '::1', 'admin@gmail.com', '2024-08-04 17:00:26', 'success', 0, NULL, 0),
(78, '::1', 'admin@gmail.com', '2024-08-04 17:08:57', 'failed', 0, NULL, 0),
(79, '::1', 'admin@gmail.com', '2024-08-04 17:09:22', 'failed', 0, NULL, 0),
(80, '::1', 'admin@gmail.com', '2024-08-04 17:09:42', 'success', 0, NULL, 0),
(81, '::1', 'admin@gmail.com', '2024-08-04 17:10:33', 'failed', 0, NULL, 0),
(82, '::1', 'admin@gmail.com', '2024-08-05 07:25:53', 'failed', 0, NULL, 0),
(83, '::1', 'admin@gmail.com', '2024-08-05 07:26:06', 'failed', 0, NULL, 0),
(84, '::1', 'admin@gmail.com', '2024-08-05 07:52:00', 'failed', 0, NULL, 0),
(85, '::1', 'admin@gmail.com', '2024-08-05 09:14:58', 'failed', 0, NULL, 0),
(86, '::1', 'admin@gmail.com', '2024-08-05 09:18:52', 'failed', 0, NULL, 0),
(87, '::1', 'admin@gmail.com', '2024-08-05 09:20:57', 'success', 0, NULL, 0),
(88, '::1', 'admin@gmail.com', '2024-08-05 09:50:29', 'success', 0, NULL, 0),
(89, '::1', 'admin@gmail.com', '2024-08-05 12:38:41', 'success', 0, NULL, 0),
(90, '::1', 'admin@gmail.com', '2024-08-05 12:50:01', 'success', 0, NULL, 0),
(91, '::1', 'admin@gmail.com', '2024-08-05 14:27:15', 'success', 0, NULL, 0),
(92, '::1', 'admin@gmail.com', '2024-08-06 10:08:32', 'success', 0, NULL, 0),
(93, '::1', 'admin@gmail.com', '2024-08-06 11:06:10', 'success', 0, NULL, 0),
(94, '::1', 'admin@gmail.com', '2024-08-06 12:25:24', 'success', 0, NULL, 0),
(95, '::1', 'admin@gmail.com', '2024-08-06 12:53:19', 'success', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `operational_details`
--

CREATE TABLE `operational_details` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(255) DEFAULT NULL,
  `abe_name` varchar(100) NOT NULL,
  `abm_name` varchar(100) NOT NULL,
  `rm_name` varchar(100) NOT NULL,
  `zm_name` varchar(100) NOT NULL,
  `operating_hours` varchar(250) NOT NULL,
  `designated_location` varchar(10) NOT NULL,
  `designated_location_remarks` varchar(250) NOT NULL,
  `training_given` varchar(10) NOT NULL,
  `training_remarks` varchar(250) NOT NULL,
  `business_explore` varchar(10) NOT NULL,
  `business_explore_remarks` varchar(250) NOT NULL,
  `target_set` varchar(10) NOT NULL,
  `target_clear` varchar(10) NOT NULL,
  `target_documented` varchar(10) NOT NULL,
  `abe_support` varchar(10) NOT NULL,
  `bank_support` varchar(10) NOT NULL,
  `target_remarks` varchar(250) NOT NULL,
  `onboarding_fee_paid` varchar(10) NOT NULL,
  `fee_unclear` varchar(10) NOT NULL,
  `fees_documented` varchar(10) NOT NULL,
  `fee_payment_mode` varchar(20) NOT NULL,
  `onboarding_remarks` varchar(250) NOT NULL,
  `rm_visit` varchar(10) NOT NULL,
  `rm_visit_remarks` varchar(250) NOT NULL,
  `abm_visit` varchar(10) NOT NULL,
  `abm_visit_remarks` varchar(250) NOT NULL,
  `abe_visit` varchar(10) NOT NULL,
  `abe_visit_remarks` varchar(250) NOT NULL,
  `bank_official_visit` varchar(10) NOT NULL,
  `bank_official_visit_remarks` varchar(250) NOT NULL,
  `bc_visit` varchar(10) NOT NULL,
  `bc_visit_remarks` varchar(250) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operational_details`
--

INSERT INTO `operational_details` (`id`, `audit_number`, `abe_name`, `abm_name`, `rm_name`, `zm_name`, `operating_hours`, `designated_location`, `designated_location_remarks`, `training_given`, `training_remarks`, `business_explore`, `business_explore_remarks`, `target_set`, `target_clear`, `target_documented`, `abe_support`, `bank_support`, `target_remarks`, `onboarding_fee_paid`, `fee_unclear`, `fees_documented`, `fee_payment_mode`, `onboarding_remarks`, `rm_visit`, `rm_visit_remarks`, `abm_visit`, `abm_visit_remarks`, `abe_visit`, `abe_visit_remarks`, `bank_official_visit`, `bank_official_visit_remarks`, `bc_visit`, `bc_visit_remarks`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(92, 'AUD345736', 'ABE Name', 'ABM Name', 'RM Name', 'ZM Name', '10 to 6', 'No', '', 'Yes', '', 'Yes', '', 'Yes', 'Yes', 'No', 'Yes', 'Yes', '', 'No', 'Yes', 'No', 'Direct Deposit', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 1, '2024-07-20 08:34:41', '1', '2024-07-27 08:16:06'),
(94, 'AUD345742', 'ABE Name', 'ABM Name', 'RM Name', 'ZM Name', 'Operating hours from 9 am to 5 pm', 'Yes', '', 'No', 'Training given by the ABE ', 'Yes', ' Business Explore (IBKART', 'No', 'No', 'No', 'No', 'No', 'Support & Target Set By ABE on BCA Activities Remarks', 'No', 'No', 'No', 'Cheque', 'fees payments made by cheque', 'No', 'RM visited twice in the last month', 'No', 'ABM visited twice in the last month', 'No', 'ABE visited twice in the last month', 'No', 'Bank officials visited twice in the last month', 'No', 'bc visited twice in the last month', 4, '2024-07-22 19:27:52', '1', '2024-07-29 07:07:40'),
(95, 'AUD345743', 'Oliver', 'Paul', 'Quinn', 'Rachel', '6 30 Am to 5 ]m', 'Yes', '', 'No', '', 'Yes', '', 'Yes', 'Yes', 'Yes', 'No', 'No', '', 'Yes', 'No', 'Yes', 'Cheque', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 1, '2024-07-22 20:21:23', '', '2024-07-22 20:21:23'),
(96, 'AUD345744', 'ABE Name', 'ABM Name', 'RM Name', 'ZM Name', 'shfvs hsshc', 'Yes', '', 'Yes', ' ', 'Yes', '', 'Yes', 'No', 'Yes', 'Yes', 'Yes', '', 'No', 'Yes', 'Yes', 'Direct Deposit', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 1, '2024-07-23 12:27:26', '1', '2024-07-23 12:27:48'),
(97, 'AUD345740', 'ABE Name', 'ABM Name', 'RM Name', 'ZM Name', 'jhf dshdsv js', 'Yes', '', 'No', '', 'Yes', '', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '', 'Yes', 'Yes', 'Yes', 'Direct Deposit', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 1, '2024-07-23 12:42:47', '', '2024-07-23 12:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `register_maintain`
--

CREATE TABLE `register_maintain` (
  `id` int(11) NOT NULL,
  `audit_number` varchar(250) NOT NULL,
  `transaction_register` enum('Yes','No') NOT NULL,
  `transaction_register_remarks` text DEFAULT NULL,
  `account_opening_register` enum('Yes','No') NOT NULL,
  `account_opening_register_remarks` text DEFAULT NULL,
  `complaint_register` enum('Yes','No') NOT NULL,
  `complaint_register_remarks` text DEFAULT NULL,
  `visitor_register` enum('Yes','No') NOT NULL,
  `visitor_register_remarks` text DEFAULT NULL,
  `cash_register` enum('Yes','No') NOT NULL,
  `cash_register_remarks` text DEFAULT NULL,
  `audit_register` enum('Yes','No') NOT NULL,
  `audit_register_remarks` text DEFAULT NULL,
  `service_register` enum('Yes','No') NOT NULL,
  `service_register_remarks` text DEFAULT NULL,
  `inventory_register` enum('Yes','No') NOT NULL,
  `inventory_register_remarks` text DEFAULT NULL,
  `loan_register` enum('Yes','No') NOT NULL,
  `loan_register_remarks` text DEFAULT NULL,
  `customer_feedback_register` enum('Yes','No') NOT NULL,
  `customer_feedback_register_remarks` text DEFAULT NULL,
  `compliance_register` enum('Yes','No') NOT NULL,
  `compliance_register_remarks` text DEFAULT NULL,
  `staff_attendance_register` enum('Yes','No') NOT NULL,
  `staff_attendance_register_remarks` text DEFAULT NULL,
  `training_register` enum('Yes','No') NOT NULL,
  `training_register_remarks` text DEFAULT NULL,
  `shg_register` enum('Yes','No') NOT NULL,
  `shg_register_remarks` text DEFAULT NULL,
  `settlement_register` enum('Yes','No') NOT NULL,
  `settlement_register_remarks` text DEFAULT NULL,
  `target_achievement_register` enum('Yes','No') NOT NULL,
  `target_achievement_register_remarks` text DEFAULT NULL,
  `entries_accuracy` enum('Yes','No') NOT NULL,
  `entries_accuracy_remarks` text DEFAULT NULL,
  `transaction_entries_reliability` enum('Yes','No') NOT NULL,
  `transaction_entries_reliability_remarks` text DEFAULT NULL,
  `txn_count_matching` enum('Yes','No') NOT NULL,
  `txn_count_matching_remarks` text DEFAULT NULL,
  `additional_remarks_registers` text DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL,
  `last_updated_by_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_maintain`
--

INSERT INTO `register_maintain` (`id`, `audit_number`, `transaction_register`, `transaction_register_remarks`, `account_opening_register`, `account_opening_register_remarks`, `complaint_register`, `complaint_register_remarks`, `visitor_register`, `visitor_register_remarks`, `cash_register`, `cash_register_remarks`, `audit_register`, `audit_register_remarks`, `service_register`, `service_register_remarks`, `inventory_register`, `inventory_register_remarks`, `loan_register`, `loan_register_remarks`, `customer_feedback_register`, `customer_feedback_register_remarks`, `compliance_register`, `compliance_register_remarks`, `staff_attendance_register`, `staff_attendance_register_remarks`, `training_register`, `training_register_remarks`, `shg_register`, `shg_register_remarks`, `settlement_register`, `settlement_register_remarks`, `target_achievement_register`, `target_achievement_register_remarks`, `entries_accuracy`, `entries_accuracy_remarks`, `transaction_entries_reliability`, `transaction_entries_reliability_remarks`, `txn_count_matching`, `txn_count_matching_remarks`, `additional_remarks_registers`, `created_date`, `created_by_id`, `last_updated_date`, `last_updated_by_id`) VALUES
(6, 'AUD345736', 'Yes', 'jhhj', 'Yes', 'jhhh', 'Yes', 'jhhhj', 'No', ' bhjjhhj', 'Yes', 'jhvhjvhj', 'No', 'hjvhjvhjv', 'Yes', 'jhvhjjh', 'Yes', 'jhbjhhj', 'Yes', 'hjvhjvhjv', 'Yes', 'jhvhjv jj', 'Yes', ' jhvhjvjhjhjv', 'Yes', 'jhvhjvhjv ok', 'Yes', 'jhvhjvhj', 'Yes', 'v jhvhjvjhv', 'Yes', 'vjhvhjv', 'Yes', 'vjhvhjv', 'Yes', 'hjvjhvjhv', 'Yes', 'hjvhjvhjv', 'Yes', 'hjvhjvhjv user', ' jhjhjvhjvj update', '2024-07-21 17:21:10', '1', '2024-07-21 17:30:43', '1'),
(7, 'AUD345742', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', '', '2024-07-22 19:28:40', '4', '2024-07-22 19:28:40', ''),
(8, 'AUD345743', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'Yes', '', '', '2024-07-22 20:22:04', '1', '2024-07-22 20:22:04', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_verification`
--

CREATE TABLE `transaction_verification` (
  `id` int(10) NOT NULL,
  `audit_number` varchar(250) NOT NULL,
  `proc_trans` enum('Yes','No') NOT NULL,
  `remarks_proc_trans` varchar(255) DEFAULT NULL,
  `proc_dep_with` enum('Yes','No') NOT NULL,
  `remarks_proc_dep_with` varchar(255) DEFAULT NULL,
  `delay_trans` enum('Yes','No') NOT NULL,
  `remarks_delay_trans` varchar(255) DEFAULT NULL,
  `acc_trans` enum('Yes','No') NOT NULL,
  `remarks_acc_trans` varchar(255) DEFAULT NULL,
  `time_match` enum('Yes','No') NOT NULL,
  `remarks_time_match` varchar(255) DEFAULT NULL,
  `cust_ver` enum('Yes','No') NOT NULL,
  `remarks_cust_ver` varchar(255) DEFAULT NULL,
  `bc_verify` enum('Yes','No') NOT NULL,
  `remarks_bc_verify` varchar(255) DEFAULT NULL,
  `sys_receipts` enum('Yes','No') NOT NULL,
  `remarks_sys_receipts` varchar(255) DEFAULT NULL,
  `cust_copy` enum('Yes','No') NOT NULL,
  `remarks_cust_copy` varchar(255) DEFAULT NULL,
  `presc_limits` enum('Yes','No') NOT NULL,
  `remarks_presc_limits` varchar(255) DEFAULT NULL,
  `auth_trans` enum('Yes','No') NOT NULL,
  `remarks_auth_trans` varchar(255) DEFAULT NULL,
  `cash_handling` enum('Yes','No') NOT NULL,
  `remarks_cash_handling` varchar(255) DEFAULT NULL,
  `cash_discrep` enum('Yes','No') NOT NULL,
  `remarks_cash_discrep` varchar(255) DEFAULT NULL,
  `complaints` enum('Yes','No') NOT NULL,
  `remarks_complaints` varchar(255) DEFAULT NULL,
  `comp_policies` enum('Yes','No') NOT NULL,
  `remarks_comp_policies` varchar(255) DEFAULT NULL,
  `reg_req` enum('Yes','No') NOT NULL,
  `remarks_reg_req` varchar(255) DEFAULT NULL,
  `audit_trail` enum('Yes','No') NOT NULL,
  `remarks_audit_trail` varchar(255) DEFAULT NULL,
  `comm_trans` enum('Yes','No') NOT NULL,
  `remarks_comm_trans` varchar(255) DEFAULT NULL,
  `tech_issues` enum('Yes','No') NOT NULL,
  `remarks_tech_issues` varchar(255) DEFAULT NULL,
  `created_by_id` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_by_id` varchar(20) NOT NULL,
  `last_updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_verification`
--

INSERT INTO `transaction_verification` (`id`, `audit_number`, `proc_trans`, `remarks_proc_trans`, `proc_dep_with`, `remarks_proc_dep_with`, `delay_trans`, `remarks_delay_trans`, `acc_trans`, `remarks_acc_trans`, `time_match`, `remarks_time_match`, `cust_ver`, `remarks_cust_ver`, `bc_verify`, `remarks_bc_verify`, `sys_receipts`, `remarks_sys_receipts`, `cust_copy`, `remarks_cust_copy`, `presc_limits`, `remarks_presc_limits`, `auth_trans`, `remarks_auth_trans`, `cash_handling`, `remarks_cash_handling`, `cash_discrep`, `remarks_cash_discrep`, `complaints`, `remarks_complaints`, `comp_policies`, `remarks_comp_policies`, `reg_req`, `remarks_reg_req`, `audit_trail`, `remarks_audit_trail`, `comm_trans`, `remarks_comm_trans`, `tech_issues`, `remarks_tech_issues`, `created_by_id`, `created_date`, `last_updated_by_id`, `last_updated_date`) VALUES
(5, 'AUD345736', 'Yes', 'hjhj', 'Yes', 'ghjh', 'Yes', 'hjhjh', 'Yes', 'jhhj', 'Yes', 'jhhj ', 'Yes', 'hjjh', 'Yes', 'hgfhj', 'Yes', 'hgfhj', 'Yes', 'hghg', 'Yes', 'hvhj', 'Yes', 'hvch', 'Yes', 'hcgh', 'Yes', 'hcghc', 'Yes', 'chcch', 'Yes', 'hgcghc', 'Yes', 'ghgh', 'Yes', 'hggh', 'Yes', 'ch', 'No', 'jghjfy', '1', '2024-07-21 20:58:04', '1', '2024-07-21 21:02:03'),
(6, 'AUD345742', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'No', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', '4', '2024-07-22 19:29:16', '', '2024-07-22 19:29:16'),
(7, 'AUD345743', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', '1', '2024-07-22 20:22:42', '', '2024-07-22 20:22:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_bc_details`
--
ALTER TABLE `all_bc_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_user_data`
--
ALTER TABLE `all_user_data`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `auditor_and_signature`
--
ALTER TABLE `auditor_and_signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auditor_observation`
--
ALTER TABLE `auditor_observation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_number` (`audit_number`);

--
-- Indexes for table `audit_list`
--
ALTER TABLE `audit_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_number` (`audit_number`);

--
-- Indexes for table `bca_and_bcpoint_details`
--
ALTER TABLE `bca_and_bcpoint_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compliance_verification`
--
ALTER TABLE `compliance_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_number` (`audit_number`);

--
-- Indexes for table `customer_interaction_data`
--
ALTER TABLE `customer_interaction_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hardware_infrastructure`
--
ALTER TABLE `hardware_infrastructure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operational_details`
--
ALTER TABLE `operational_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_number` (`audit_number`);

--
-- Indexes for table `register_maintain`
--
ALTER TABLE `register_maintain`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_number` (`audit_number`);

--
-- Indexes for table `transaction_verification`
--
ALTER TABLE `transaction_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audit_number` (`audit_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_bc_details`
--
ALTER TABLE `all_bc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20967;

--
-- AUTO_INCREMENT for table `all_user_data`
--
ALTER TABLE `all_user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auditor_and_signature`
--
ALTER TABLE `auditor_and_signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `auditor_observation`
--
ALTER TABLE `auditor_observation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `audit_list`
--
ALTER TABLE `audit_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `bca_and_bcpoint_details`
--
ALTER TABLE `bca_and_bcpoint_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `compliance_verification`
--
ALTER TABLE `compliance_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer_interaction_data`
--
ALTER TABLE `customer_interaction_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hardware_infrastructure`
--
ALTER TABLE `hardware_infrastructure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `operational_details`
--
ALTER TABLE `operational_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `register_maintain`
--
ALTER TABLE `register_maintain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction_verification`
--
ALTER TABLE `transaction_verification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
