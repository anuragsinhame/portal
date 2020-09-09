-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 23, 2017 at 06:35 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u635035186_porta`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE `additional` (
  `uid` int(4) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `pwd` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`uid`, `email_id`, `pwd`) VALUES
(1, 'admin@udaaan.org', 'Aa9528962535#'),
(2, 'agam01@udaaan.org', '8LQ&UQBE'),
(2, 'ceo@udaaan.org', '8LQ&UQBE'),
(3, 'anuragsinhame@udaaan.org', 'Aa9528962535#'),
(4, 'varchashva@udaaan.org', 'pXfugdkMWqF6'),
(5, 'san@udaaan.org', 'MalsnZu3xl7H'),
(6, 'manishprajapati@udaaan.org', 't8r9Onjymg9N'),
(7, 'prabha@udaaan.org', 'y1Kkr3cBaGla'),
(8, 'omarakshan@udaaan.org', '28I07b1w9BlH'),
(9, 'mekrishna94@udaaan.org', 'V13jFCmDyOOu'),
(10, 'ojasagrawal@udaaan.org', 'l4BDenuHgE9K'),
(11, 'manku@udaaan.org', 'Rrkq0MxIQUOp'),
(12, 'viveks449@udaaan.org', 'FFex6qnZm0vN'),
(13, 'amit_srivastav@udaaan.org', 'shCVDsJmJ0xi'),
(18, 'ashu@udaaan.org', 'VeeCHB05rlmv'),
(24, 'kmausam@udaaan.org', 'qf6mCu87tcJl');

-- --------------------------------------------------------

--
-- Table structure for table `daily_attendance`
--

CREATE TABLE `daily_attendance` (
  `uid` int(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deleted`
--

CREATE TABLE `deleted` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `deleted_by` int(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleted`
--

INSERT INTO `deleted` (`id`, `username`, `mobile`, `email`, `deleted_by`, `timestamp`) VALUES
(1, 'udit_saxena', '8265920098', 'saxenaudit56@gmail.com', 0, '0000-00-00 00:00:00'),
(2, 'radhe', '9170188344', 'guptasatyendra777@gmail.com', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE `department_master` (
  `dep_id` tinyint(1) NOT NULL COMMENT 'Department Id',
  `department_name` varchar(30) NOT NULL,
  `department_head` int(4) DEFAULT NULL,
  `department_head_alt` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`dep_id`, `department_name`, `department_head`, `department_head_alt`) VALUES
(1, 'Udaaan', NULL, NULL),
(2, 'Finance', NULL, NULL),
(3, 'Digital', NULL, NULL),
(4, 'HR', NULL, NULL),
(5, 'Events', NULL, NULL),
(6, 'Marketing', NULL, NULL),
(7, 'Advisory', NULL, NULL),
(8, 'Academics', NULL, NULL),
(9, 'Management', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designation_master`
--

CREATE TABLE `designation_master` (
  `designation_id` tinyint(1) NOT NULL,
  `designation` varchar(40) NOT NULL,
  `org_level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation_master`
--

INSERT INTO `designation_master` (`designation_id`, `designation`, `org_level`) VALUES
(1, 'New Member', 100),
(2, 'Convenor', 1),
(3, 'CEO', 1),
(4, 'COO', 2),
(5, 'CTO', 2),
(6, 'CFO', 3),
(7, 'HRO', 3),
(8, 'AO', 3),
(9, 'CPO', 4),
(10, 'Secretary', 4),
(11, 'Finance officer', 5),
(12, 'Executive officer', 5),
(13, 'Company Secretary', 5),
(14, 'Unit President', 3),
(15, 'Sr Member', 6),
(16, 'Member', 7),
(17, 'Vounteer', 8),
(18, 'Trainee Volunteer', 9),
(19, 'SuperUser', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_attendance`
--

CREATE TABLE `monthly_attendance` (
  `uid` int(4) NOT NULL,
  `date` date NOT NULL,
  `attendance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registered_members`
--

CREATE TABLE `registered_members` (
  `uid` int(4) NOT NULL COMMENT 'User Id for Members',
  `username` varchar(30) NOT NULL,
  `password` varchar(33) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `failed_attempts` char(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `join_date` datetime NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_members`
--

INSERT INTO `registered_members` (`uid`, `username`, `password`, `mobile`, `email`, `failed_attempts`, `active`, `join_date`, `last_login`, `approved_by`) VALUES
(1, 'admin', '75f9f223776b6b04d9e39ce12b05857f', '9458555409', 'admin@udaaan.org', '0', 1, '2017-08-17 00:00:00', '2017-09-13 07:35:09', ''),
(2, 'agam01', 'c0b1e8031713c4b4b9e37c9a9bcdceaa', '8923737016', 'atagamtyagi@gmail.com', '0', 1, '2017-08-18 00:00:00', '2017-09-21 05:03:09', 'admin'),
(3, 'anuragsinhame', '75f9f223776b6b04d9e39ce12b05857f', '8374812501', 'sinha.anurag101@gmail.com', '0', 1, '2017-08-18 00:00:00', '2017-08-27 09:23:37', 'admin'),
(4, 'varchashva', 'ca2385790b3ba7af4cfb6f66ea095c02', '7292038369', 'mishravarchashva20@gmail.com', '0', 1, '2017-08-18 00:00:00', '2017-08-21 05:32:58', 'agam01'),
(5, 'san', '50d10698c66aba0bf8d30895468dd54b', '7895199805', 'sanchitt3@gmail.com', '0', 1, '2017-08-19 00:00:00', '2017-09-11 05:05:17', 'anuragsinhame'),
(6, 'manishprajapati', '68f2277d3d36171df565c48df2d5683b', '8853461317', 'manish.prajapati_me14@gla.ac.in', '0', 1, '2017-08-20 00:00:00', '2017-08-27 06:01:22', 'agam01'),
(7, 'prabha', 'e04bd1a083eb4e92fa83633858b51ffe', '9900634387', 'prabha.tomar63@gmail.com', '0', 1, '2017-08-20 00:00:00', '2017-09-21 05:01:49', 'anuragsinhame'),
(8, 'omarakshan', 'ebd0f790ae41ef1d2ff91b33db8e431a', '9520019768', 'akshanshomar261095@gmail.com', '0', 1, '2017-08-20 00:00:00', '2017-08-21 08:47:54', 'anuragsinhame'),
(9, 'mekrishna94', '0ba77bc45398624423f87ffe0ff2bef9', '7500288605', 'mekrishna94@gmail.com', '0', 1, '2017-08-21 00:00:00', '2017-08-26 03:43:41', 'agam01'),
(10, 'ojasagrawal', 'db54b0affac8c629210d34af2670d43b', '9305019271', 'ojasagrawal1996@gmail.com', '0', 1, '2017-08-21 00:00:00', '2017-09-11 11:41:14', 'agam01'),
(11, 'manku', '3155052a8fa7994669a501a7539ba2f3', '9837306643', 'raimayanklps@gmail.com', '0', 1, '2017-08-21 00:00:00', '2017-09-11 05:07:27', 'agam01'),
(12, 'viveks449', 'eb6dd316db8ccab319eb56c10f6a9aff', '8569988037', 'vivekkumarsharma081@gmail.com', '0', 1, '2017-08-22 00:00:00', '2017-08-22 12:52:26', 'agam01'),
(13, 'amit_srivastav', '6f47d4aab7f57cb4b6a9f9393de6a1cd', '8004893018', 'aamitesh123@gmail.com', '0', 1, '2017-08-23 00:00:00', '2017-09-20 05:41:42', 'anuragsinhame'),
(14, 'dksingh', '61f79e6b881e749d861ab918d19384dc', '7890015878', 'singhdeepak@hotmail.co.in', '0', 1, '2017-08-23 00:00:00', '2017-08-24 05:28:38', 'agam01'),
(15, 'shubhigupta', '35008facc2f1179302fd2ea1ccd006ef', '9639648632', 'shubhigupta225@gmail.com', '0', 1, '2017-08-24 00:00:00', '2017-08-27 01:36:58', 'agam01'),
(16, 'etiagarwal', '3ed06de84a8c47b44b22d4391bb69c60', '9258551975', 'etiagarwal82@gmail.com', '0', 1, '2017-08-24 00:00:00', '2017-08-30 06:04:26', 'agam01'),
(17, 'madhuri15', 'c2c72cd7e9d5186c5b0383d22bee4683', '7518914689', 'madhuri.sharma_cs14@gla.ac.in', '2', 1, '2017-08-24 00:00:00', '2017-09-13 07:08:58', 'agam01'),
(18, 'ashu', 'c442e808532f2e5053cad0916edb9f45', '8755500297', 'ashuloves1000timesmum@gmail.com', '0', 1, '2017-08-25 00:00:00', '2017-09-01 12:10:41', 'anuragsinhame'),
(19, 'manoj415', 'a8a2aca7ee9f7dbf59938c3e0fc837e9', '7309116573', 'singhmanojkumar1715@gmail.com', '0', 1, '2017-08-27 00:00:00', '2017-09-02 04:06:00', 'agam01'),
(20, 'nitishnarayan', '71eeeeb01fdf0474affb27de8661712b', '7408117301', 'nitish941997@gmail.com', '0', 1, '2017-08-27 00:00:00', '2017-09-02 03:31:19', 'agam01'),
(21, 'shatakshi123', 'ead7961c8b95caccae68091fe66409b1', '9793261761', 'shatakshi.tripathi_cs14@gla.ac.in', '0', 1, '2017-08-27 00:00:00', '2017-09-10 12:44:52', 'agam01'),
(22, 'vincu12', 'b0051bc1f3d78e81eb3d169af478dc8e', '7055130767', 'vinci.gupta_cs14@gla.ac.in', '0', 1, '2017-08-27 00:00:00', '2017-09-10 01:36:07', 'agam01'),
(23, 'kshitizsinha', 'ebe5482aa31fdda806ca97ba9695343f', '7052668496', 'kshitiz.sinha_ee14@gla.ac.in', '0', 1, '2017-08-27 00:00:00', '2017-09-12 03:58:49', 'agam01'),
(24, 'kmausam', '5097a2b09d5c9f392921df1b5fca0d1d', '9410662052', 'kuwar.mausam@gla.ac.in', '0', 1, '2017-08-29 00:00:00', '2017-08-29 00:00:00', 'agam01'),
(25, 'himanshu', '9730c4aa309813ab3214a5486fe580a0', '9450131214', 'himanshuji0214@gmail.com', '0', 1, '2017-08-30 00:00:00', '2017-09-01 02:51:17', 'agam01'),
(26, 'satyamsinghal', '6ea2a577bb7dc788ebd78cc62665d70d', '7500736657', 'satyamsinghal.29@gmail.com', '0', 1, '2017-08-31 00:00:00', '2017-08-31 12:04:43', 'agam01'),
(27, 'nilesh', 'a3f52f6776b598e9fd488b13ad7e988a', '7500525268', 'nilesh.mishra_me14@gla.ac.in', '0', 1, '2017-09-09 00:00:00', '2017-09-11 03:09:35', 'agam01'),
(28, 'soumyavij', '4301a874f151854e5ccf844c729e0759', '9837356499', 'vijsoumya06@gmail.com', '0', 1, '2017-09-09 00:00:00', '2017-09-10 12:15:02', 'agam01'),
(29, 'radhe', '32c1eff5f524aa099660719db0dafaf0', '9170188344', 'guptasatyendra777@gmail.com', '0', 1, '2017-09-21 00:00:00', '2017-09-21 05:30:14', 'agam01');

-- --------------------------------------------------------

--
-- Table structure for table `temp_mem`
--

CREATE TABLE `temp_mem` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_mem`
--

INSERT INTO `temp_mem` (`id`, `name`) VALUES
(3, 'Satakshi Tripathi'),
(4, 'Stayam Singhal'),
(5, 'Vinci Gupta'),
(6, 'Kshitiz Agarwal'),
(7, 'Madhuri Sharma'),
(8, 'Shubhi Gupta'),
(9, 'Sanchit Kumar'),
(10, 'Ojash Agrawal'),
(11, 'Manoj Kumar'),
(12, 'Krishna Kumar'),
(13, 'Mayank Rai'),
(14, 'Himanshu Gupta'),
(15, 'Akshansh Omar'),
(16, 'Manish Parjapati'),
(17, 'Kriti Agarwal'),
(18, 'Nitish Narayan');

-- --------------------------------------------------------

--
-- Table structure for table `temp_members`
--

CREATE TABLE `temp_members` (
  `temp_id` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(33) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `activation` varchar(33) NOT NULL,
  `signup_date` date NOT NULL,
  `first_login` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for new and 0 for filled entries',
  `activated` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for not activated and 1 for activated',
  `fname` varchar(40) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `pic_name` varchar(38) NOT NULL DEFAULT 'user.jpg' COMMENT 'Default will be user.jpg and after that it will be updated when user will upload pic',
  `submitted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'By default 0 i.e. not submitted for approval'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_members`
--

INSERT INTO `temp_members` (`temp_id`, `username`, `password`, `mobile`, `email`, `activation`, `signup_date`, `first_login`, `activated`, `fname`, `mname`, `lname`, `pic_name`, `submitted`) VALUES
(2, 'harsh', 'bbb491759a71eacdd1b4fda38df23ede', '8171789586', 'harsh.gupta_cs16@gla.ac.in', '4939a9dd576969830480d61d82355a43', '2017-08-16', 1, 0, '', '', '', 'user.jpg', 0),
(3, 'paritosh', '74e1c8891e884d660b891c163f1b3dbd', '7275468315', 'paritosh.singh_en16@gla.ac.in', '012007220bca918eb096500b2e598b28', '2017-08-16', 1, 0, '', '', '', 'user.jpg', 0),
(28, 'manmohan', '2cf8199a010fd7735f508f360544fc90', '7454935315', 'manmohan.agrahari_cs16@gla.ac.in', 'ca9acfc6a3db1f02866d8096686816c4', '2017-08-24', 1, 0, '', '', '', 'user.jpg', 0),
(29, 'gaurav', 'c5129de87672f66ba0dd288970a500a3', '8191974507', 'gaurav1481995@gmail.com', '471092b15c2ccb7a83631a2e154d0a77', '2017-08-25', 1, 1, '', '', '', 'user.jpg', 0),
(30, 'yashika_maheshwari', '7e43fdb6fe19327d348cd7a215d39fce', '9627290733', 'yashika.m1996@gmail.com', 'e4cd68fa7363e8e10edcb04abb610ab0', '2017-08-25', 1, 0, '', '', '', 'user.jpg', 0),
(31, 'himanshu_nag', 'df44e4486ed388536c337a67db92097a', '9450434314', 'himanshu.naag165@gmail.com', '4e1db0d587778c6d86adbc55301d9a00', '2017-08-25', 1, 1, '', '', '', 'user.jpg', 0),
(34, 'vinci123', '01f59ee3557e2c1186851ce0fbf73119', '9917239738', 'vinci17gupta@gmail.com', '658a3e09dcab726700836a97cbebf38a', '2017-08-26', 1, 0, '', '', '', 'user.jpg', 0),
(35, 'vinci17gupta', 'c842e10f0da6af00edae03a11678297b', '8439848051', 'vinci.gupta_cs14@gmail.com', '0e698d989c2d5ef8d6df23e24c63c7c1', '2017-08-26', 1, 0, '', '', '', 'user.jpg', 0),
(36, 'manojkumar415', 'a8a2aca7ee9f7dbf59938c3e0fc837e9', '9084250557', 'manoj.kumar_ee14@gla.ac.in', '7a914637e979c39e311218e59b5f3866', '2017-08-26', 1, 0, '', '', '', 'user.jpg', 0),
(38, 'kshitiz', 'ebe5482aa31fdda806ca97ba9695343f', '9536759365', 'ksinha890@gmail.com', '8384c5846008bdc80182519a0a61364c', '2017-08-27', 1, 0, '', '', '', 'user.jpg', 0),
(41, 'aman1998', 'bf8d5eff2acf9cda1518fba251df4177', '7534976136', 'aman.srivastava_cs16@gla.ac.in', '695ee54e7ec4affee3942ca1840bf589', '2017-08-27', 1, 1, '', '', '', 'user.jpg', 0),
(43, 'abhisheksharma', '83da65d8da92c30b936188e163897004', '9808737422', 'abhishekyourb2@gmail.com', 'f658ea7c4f4102669f6381d898afba2a', '2017-08-29', 1, 1, '', '', '', 'user.jpg', 0),
(45, 'amit', 'e1fefda3055528db2cf379cee2c7a1e0', '9451841706', 'amit.singh_me17@gla.ac.in', '832328596e6132109f2cbee18b8f6f6f', '2017-08-30', 1, 1, '', '', '', 'user.jpg', 0),
(46, 'vishal', 'f51e88b7b81eae9b1d889c8416173618', '9099093158', 'vishal.yadav_me11@gla.ac.in', '44951018a3d4f58b1b1e27d312b07a2f', '2017-08-31', 1, 0, '', '', '', 'user.jpg', 0),
(48, 'vishaly', 'f51e88b7b81eae9b1d889c8416173618', '7055178488', 'vishalyadav@ghcl.co.in', '04984ddf9722f0615fcd743df74726d6', '2017-09-06', 1, 0, '', '', '', 'user.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `uid` int(4) NOT NULL,
  `monday` tinyint(1) NOT NULL DEFAULT '0',
  `tuesday` tinyint(1) NOT NULL DEFAULT '0',
  `wednesday` tinyint(1) NOT NULL DEFAULT '0',
  `thursday` tinyint(1) NOT NULL DEFAULT '0',
  `friday` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `username` varchar(30) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `mname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date NOT NULL,
  `father_name` varchar(100) NOT NULL DEFAULT 'Father''s Name',
  `mother_name` varchar(100) NOT NULL DEFAULT 'Mother''s Name',
  `department_id` tinyint(1) DEFAULT '1',
  `designation_id` tinyint(1) DEFAULT '1',
  `pic_name` varchar(38) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `fcheck` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'To check if user has entered profile details once or not. 0 for first time'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`username`, `fname`, `mname`, `lname`, `gender`, `dob`, `father_name`, `mother_name`, `department_id`, `designation_id`, `pic_name`, `address1`, `address2`, `city`, `state`, `pincode`, `country`, `fcheck`) VALUES
('admin', 'Udaaan', '', 'Admin', 'Other', '2012-07-01', 'NA', 'NA', 2, 19, '44f1b200fda4b9224f2b0843ce7428f5.jpg', 'GLA University', 'Mathura', 'Mathura', 'UP', '281001', 'INDIA', 1),
('agam01', 'Agam', '', 'Tyagi', 'Male', '1994-09-01', 'MANOJ KUMAR', 'RAMA RANI', 9, 3, '79e7235b20c1c22e11e99cb91c79f557.jpg', 'H.NO.229, VILL + POST BAHERI', '', 'MUZAFFARNAGAR', 'UTTAR PRADESH', '251202', 'INDIA', 1),
('amit_srivastav', 'Amit', '', 'Srivastav', 'Male', '0000-00-00', 'Pramod Kumar Srivastava', 'Sandhya Srivastava', 9, 6, '8d8451b746943b7b00235485fb9f5a8a.jpg', 'Aditya Nagar Colony,Raibareily Road', '', 'Faizabad', 'Uttar Pradesh', '224001', 'India', 1),
('anuragsinhame', 'Anurag', '', 'Sinha', 'Male', '1992-12-26', 'Sunil Kumar', 'Chanchala Sinha', 9, 5, 'd14e4077c5528f48935a0c22818d3695.jpg', '450/7', 'Jagriti Vihar', 'Meerut', 'Uttar Pradesh', '250004', 'India', 1),
('ashu', 'Ashu', '', 'Chaudhary', 'Female', '1993-03-06', 'Bhagat Singh', 'Kamlesh', 9, 10, '328eba3afed3e10b292e1ebd22fba952.jpg', 'Flat 205 pride homes 16th cross neeladri road electronic cit', '', 'Bangalore', 'India', '560100', 'India', 1),
('dksingh', 'Deepak', 'Kumar', 'singh', 'Male', '1991-10-27', 'Anil Kumar Singh', 'Nageena Singh', 9, 4, '7ab21ff6fa62d8d6d51fb890f52881e6.jpg', 'Vill and post- Bhupiamau', '', 'Pratapgarh', 'U.p.', '230001', 'India', 1),
('etiagarwal', 'ETI', '', 'AGARWAL', 'Female', '1997-02-07', 'Mr. Manoj Agarwal', 'Mrs. Neeru Agarwal', 8, 16, 'f798d04828e41c174c94588740a7f269.jpg', '7/191, Ganesh Market, Nanda Bajar', 'TajGanj', 'Agra', 'Uttar Pradesh', '282001', 'India', 1),
('himanshu', 'Himanshu', '', 'Gupta', 'Male', '1997-02-14', 'Vishnu Kumar Gupta', 'Anuradha Gupta', 8, 16, 'dfe052ada506ffab79360e8b2e33f0ed.jpg', 'Sanjay Nagar', 'Atarra District Banda - 210201', 'ATARRA', 'Uttar Pradesh', '210201', 'India', 1),
('kmausam', 'kuwar', '', 'mausam', 'Male', '1985-07-25', 'Ashwani Kumar Singh', 'Kamal Radha', 9, 14, 'f80b44edd1ef0924306aab86edee99d2.jpg', '35/633 Nawbasta', 'lohamandi', 'AGRA', 'Uttar Pradesh', '282002', 'India', 1),
('kshitizsinha', 'Kshitiz', 'Kumar', 'Sinha', 'Male', '0000-00-00', 'Ram Sharan Sinha', 'Poonam Sinha', 8, 16, '59cdfcd5854e746d51d712c9d11a0cf5.jpg', '43/7/8 ka dandia allapur allahabad', '', 'Allahabad', 'Uttar Pradesh', '211006', 'India', 1),
('madhuri15', 'Madhuri', '', 'Sharma', 'Female', '1995-12-15', 'Mr.Rakesh Sharma', 'Mrs.Satyawati Sharma', 8, 16, '7d74cc4b02f8d523f00accf6576c61c3.jpg', '529/539 ka Satsang Bhawan, Rahim Nagar LKO', '', 'Lucknow', 'Uttar Pradesh', '226006', 'India', 1),
('manishprajapati', 'Manish', '', 'Prajapati', 'Male', '1996-08-22', 'Sundar lal', 'Rani Devi', 8, 16, '1c45c4be3a3808ec78ade17736f30d44.jpg', 'Behind of medical college near ansal colony pichhor jhansi', '', 'Jhansi', 'Uttra Pradesh', '284128', 'India', 1),
('manku', 'Mayank', '', 'Rai', 'Male', '1996-02-14', 'Rajesh rai', 'Premlata rai', 8, 16, '47b9a1b09589e8c57897c70b66fd50d4.jpg', 'semari jamalpur', 'Manjhwara', 'Mau', 'Uttar pradesh', '275307', 'India', 1),
('manoj415', 'Manoj', '', 'Kumar', 'Male', '1995-07-02', 'Mohan Lal Singh', 'Raj Kumari', 8, 16, '7c38059f89496bfac7ec6c36cabfce03.jpg', '125-Dihi Khurd', 'Lendiyari, Koraon', 'Allahabad', 'Uttar Pradesh', '212106', 'India', 1),
('mekrishna94', 'Krishna', '', 'Kumar', 'Male', '1994-03-05', 'Parmeshwar Prasad', 'Bibha Devi', 8, 16, 'e913fa509b2343a9bb77a6cb07919bc7.jpg', 'C/O- PARMESHWAR PRASAD', 'AT-  BANMANKHI WRAD NO-10', 'Banmankhi', 'BIHAR', '854202', 'India', 1),
('nilesh', 'Nilesh', '', 'Mishra', 'Male', '0000-00-00', 'Mr Rajesh Kumar mishra', 'Miss Sangeeta mishra', 8, 16, '438d068f2a5e9edae940fe8e353e63b3.jpg', 'Sultanpur', 'Sultanpur', 'Sultanpur', 'Up', '228161', 'India', 1),
('nitishnarayan', 'Nitish', '', 'Narayan', 'Male', '1998-04-09', 'Mr. Sanjay Nigam', 'Mrs. Manjul Nigam', 8, 16, '2387d532c9c64743025fe916eb34e624.jpg', '119/659 Darshanpurwa, Kanpur', '', 'Kanpur', 'Uttar Pradesh', '208001', 'India', 1),
('ojasagrawal', 'OJAS', '', 'AGRAWAL', 'Male', '1996-08-08', 'RAKESH AGRAWAL', 'ALKA AGRAWAL', 8, 16, '4c4c40b45b8fe86ce17b279a8ca91824.jpg', '24, PUNJABI COLONY', 'SITAPUR ROAD', 'LAKHIMPUR-KHERI', 'UTTAR PRADESH', '262701', 'India', 1),
('omarakshan', 'Akshansh', '', 'Omar', 'Male', '1997-08-26', 'Mahesh Chandra Omar', 'Meena Omar', 8, 16, '5e0593a6a86f9016f60e460cba8cb187.jpg', 'ghatampur', '', 'kanpur', 'uttar pradesh', '209206', 'india', 1),
('prabha', 'Prabha', '', 'Tomar', 'Female', '1993-03-13', 'Onkar Singh Tomar', 'Saroj Tomar', 4, 7, 'ef7f15541c3a4493d071905186e084c6.jpg', '97, sarangood vihar colony', 'Balaji puram, aurangabad', 'Mathura', 'Uttar pradesh', '281001', 'India', 1),
('radhe', 'Satyendra', '', 'Gupta', 'Male', '1997-11-15', 'jay prakash gupta', 'yashoda devi', 8, 16, '45afec1202de71fe13714c8ade517c6d.jpg', 'z/350 police line prade ground golghar gorakhpur', 'H-83 vill- luxmipur, post mahuawa bujurg', 'kushinagar', 'u.p', '274149', 'india', 1),
('san', 'Sanchit', '', 'Kumar', 'Male', '1997-01-30', 'Mr. Ratneesh Kumar Saxena', 'Mrs. Neelam Saxena', 3, 16, '07cb51faf06fb38b4f4278d426e5d83b.jpg', 'H.No. 194', 'mega dream colony', 'Bareilly', 'Uttar Pradesh', '243122', 'India', 1),
('satyamsinghal', 'Satyam', '', 'Singhal', 'Male', '1995-03-29', 'Sunil Singhal', 'Sunita Singhal', 8, 16, '412030192f08ec9380af5c1e6662e7ae.jpg', '9a Veer Nagar', 'Dayal Bagh', 'Agra', 'Uttar Pradesh', '282005', 'India', 1),
('shatakshi123', 'Shatakshi', '', 'Tripathi', 'Female', '1996-03-04', 'Manish tripathi', 'Anju tripathi', 8, 16, '16b4dea8c8acc59851c7c91c2cc3e352.jpg', 'C-1/330 Indira Nagar kanpur', 'Near SBI', 'Kanpur', 'Uttar pradesh', '208026', 'India', 1),
('shubhigupta', 'Shubhi', '', 'Gupta', 'Female', '1996-07-26', 'Lt Mr Brijesh Kumar Gupta', 'Mrs Mamta Gupta', 8, 16, 'e857b4ef40a43992fd56f7b0911c3fc0.jpg', '67/b jain nagar', '', 'Firozabad', 'UP', '283203', 'India', 1),
('soumyavij', 'SOUMYA', '', 'VIJ', 'Female', '1995-10-06', 'Mr. Ravinder Kumar Vij', 'Mrs. Mukta Vij', 8, 16, 'dd7aa6fcf457467c3efcf53a78a13cb9.jpg', '6 shekhar residency paschimpuri', 'Agra', 'Agra', 'Utter Pradesh', '282007', 'India', 1),
('varchashva', 'Varchashva', '', 'Mishra', 'Male', '1994-04-01', 'Arvind kumar Mishra', 'Neeru Mishra', 9, 8, 'db23fd1901958ecc8e369de9e072252a.jpg', 'Hospital Road', 'Mitauli', 'Lakhimpur', 'Uttar Pradesh', '262727', 'India', 1),
('vincu12', 'Vinci', '', 'Gupta', 'Female', '1996-09-16', 'manoj gupta', 'radha gupta', 8, 16, 'cc2697c7d5ab44dbc9fbd6a8d8b8f6e8.jpg', '26/2 near Om apartment', 'suhag nagar', 'firozabad', 'Uttar pradesh', '283203', 'india', 1),
('viveks449', 'Vivek', 'Kumar', 'Sharma', 'Male', '1994-06-12', 'Prem Chandra Sharma', 'Madhu Sharma', 9, 9, '6417a711d1cc1e1f889f4d08b6ecf83e.jpeg', 'Gokul Bhawan, Vidyarathi Chauraha', 'Civil Lines', 'Fatehpur', 'Uttar Pradesh', '212601', 'India', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `username` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `verif_code` varchar(33) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`username`, `email`, `verif_code`, `creation_time`) VALUES
('HARSH', 'harsh.gupta_cs16@gla.ac.in', '441bb087a57caf36e40806625a4cc325', '2017-08-16 13:42:37'),
('Himanshu', 'himanshuji0214@gmail.com', '6180593faefc215d70b21d81ab61d42f', '2017-09-01 14:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `yearly_attendance`
--

CREATE TABLE `yearly_attendance` (
  `uid` int(4) NOT NULL,
  `year` char(4) NOT NULL,
  `attendance` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional`
--
ALTER TABLE `additional`
  ADD PRIMARY KEY (`uid`,`email_id`);

--
-- Indexes for table `daily_attendance`
--
ALTER TABLE `daily_attendance`
  ADD PRIMARY KEY (`uid`,`date`);

--
-- Indexes for table `deleted`
--
ALTER TABLE `deleted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_master`
--
ALTER TABLE `department_master`
  ADD PRIMARY KEY (`dep_id`),
  ADD KEY `department_head` (`department_head`,`department_head_alt`),
  ADD KEY `department_head_alt` (`department_head_alt`),
  ADD KEY `department_head_alt_2` (`department_head_alt`),
  ADD KEY `department_head_2` (`department_head`);

--
-- Indexes for table `designation_master`
--
ALTER TABLE `designation_master`
  ADD PRIMARY KEY (`designation_id`),
  ADD UNIQUE KEY `designation` (`designation`);

--
-- Indexes for table `monthly_attendance`
--
ALTER TABLE `monthly_attendance`
  ADD PRIMARY KEY (`uid`,`date`);

--
-- Indexes for table `registered_members`
--
ALTER TABLE `registered_members`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`,`mobile`,`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `temp_mem`
--
ALTER TABLE `temp_mem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_members`
--
ALTER TABLE `temp_members`
  ADD PRIMARY KEY (`temp_id`),
  ADD UNIQUE KEY `username` (`username`,`mobile`,`email`);
ALTER TABLE `temp_members` ADD FULLTEXT KEY `username_2` (`username`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`username`),
  ADD KEY `department` (`department_id`,`designation_id`),
  ADD KEY `designation` (`designation_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD UNIQUE KEY `uname` (`username`,`email`);

--
-- Indexes for table `yearly_attendance`
--
ALTER TABLE `yearly_attendance`
  ADD PRIMARY KEY (`uid`,`year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deleted`
--
ALTER TABLE `deleted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department_master`
--
ALTER TABLE `department_master`
  MODIFY `dep_id` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT 'Department Id', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `designation_master`
--
ALTER TABLE `designation_master`
  MODIFY `designation_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `registered_members`
--
ALTER TABLE `registered_members`
  MODIFY `uid` int(4) NOT NULL AUTO_INCREMENT COMMENT 'User Id for Members', AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `temp_mem`
--
ALTER TABLE `temp_mem`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `temp_members`
--
ALTER TABLE `temp_members`
  MODIFY `temp_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional`
--
ALTER TABLE `additional`
  ADD CONSTRAINT `uid_add_fk` FOREIGN KEY (`uid`) REFERENCES `registered_members` (`uid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `daily_attendance`
--
ALTER TABLE `daily_attendance`
  ADD CONSTRAINT `uid_daily_fk` FOREIGN KEY (`uid`) REFERENCES `registered_members` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `department_master`
--
ALTER TABLE `department_master`
  ADD CONSTRAINT `dep_head_alt_fk` FOREIGN KEY (`department_head_alt`) REFERENCES `registered_members` (`uid`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `dep_head_fk` FOREIGN KEY (`department_head`) REFERENCES `registered_members` (`uid`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `monthly_attendance`
--
ALTER TABLE `monthly_attendance`
  ADD CONSTRAINT `uid_moonthly_fk` FOREIGN KEY (`uid`) REFERENCES `registered_members` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `uid_att_fk` FOREIGN KEY (`uid`) REFERENCES `registered_members` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `dep_id_fk` FOREIGN KEY (`department_id`) REFERENCES `department_master` (`dep_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `des` FOREIGN KEY (`designation_id`) REFERENCES `designation_master` (`designation_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `username_fk` FOREIGN KEY (`username`) REFERENCES `registered_members` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yearly_attendance`
--
ALTER TABLE `yearly_attendance`
  ADD CONSTRAINT `uid_yearly_fk` FOREIGN KEY (`uid`) REFERENCES `registered_members` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
