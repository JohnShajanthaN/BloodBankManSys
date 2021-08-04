-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2021 at 06:53 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_don`
--

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `user_id` int(11) NOT NULL,
  `image_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avatar`
--

INSERT INTO `avatar` (`user_id`, `image_name`) VALUES
(1, '1_image.jpg'),
(2, '2_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `name`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

CREATE TABLE `blood_request` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `req_date` varchar(50) NOT NULL,
  `req_location` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`id`, `blood_group`, `description`, `req_date`, `req_location`, `phone`, `created_by`, `created`, `modified`) VALUES
(1, 'A+', 'no need', '2021-6-9', 'vanni', '1236598745', 1, '2021-05-28 22:12:28', '2021-06-03 18:33:08'),
(2, 'AB-', 'i want to that blood grup', '2021-7-3', 'inuvil', '07756984235', 1, '2021-05-28 22:13:23', '2021-05-28 16:43:23'),
(3, 'O+', 'i want to that blood grup', '2021-7-3', 'inuvil', '07756984235', 1, '2021-05-31 20:25:29', '2021-05-31 14:55:29'),
(6, 'O+', 'my name ius anu', '2021/5/8', 'kandy', '01236985878', 1, '2021-05-31 22:16:38', '2021-06-03 18:33:13'),
(8, 'AB+', 'mani description', '05/04/2021', 'colombo', '01254789658', 1, '2021-05-31 23:29:45', '2021-06-03 18:33:18'),
(10, 'AB+', 'Then, we’ll loop through each item, splitting it into another array at the = symbol. The first item in our array is the key. The second is the value.', '2021-07-01', 'kalani', '0000000110', 1, '2021-06-01 00:12:43', '2021-06-01 15:44:51'),
(11, 'AB+', 'hi', '2021-06-11', 'koku', '0123655444', 1, '2021-06-01 15:17:20', '2021-06-03 18:33:22'),
(12, 'B+', 'gdfhgd', '2021-07-23', 'ko9kubil', '0124545580', 40, '2021-07-20 18:56:14', '2021-07-20 13:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(256) NOT NULL,
  `location` text NOT NULL,
  `organizer` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `title`, `description`, `image_name`, `location`, `organizer`, `created_by`, `created`, `modified`) VALUES
(1, 'Malar Blood campaign', 'description of the titan buli9ders. eeeeeeeeee', 'tb.jpg', 'Kondavil', 'Malar', 1, '2021-05-28 00:03:00', '2021-05-30 16:15:21'),
(2, 'Jarl Hospital ', 'fdghgh uyubbihiubiuiu 7y87y87 78y i9uyiu 8uy8 y9 8y9 y898y98y98y9y8 9888888887980popokjlk jhhkj kjhkjhjh lkjhlkjlkjlkjhlkj jlkjljl ', 'tb.jpg', 'jaffna', 'Yarl hospital', 1, '2021-05-28 18:33:21', '2021-05-30 16:15:27'),
(4, 'Blood dono\n', 'fdghgh uyubbihiubiuiu 7y87y87 78y i9uyiu 8uy8 y9 8y9 y898y98y98y9y8 9888888887980popokjlk jhhkj kjhkjhjh lkjhlkjlkjlkjhlkj jlkjljl ', 'tb.jpg', 'thirunelveli', 'SFS', 1, '2021-05-28 18:34:48', '2021-05-30 16:15:33'),
(5, 'I am Srilankan\n', 'Firstly, you will be asked to provide personal details such as your name, address, age, weight, ID number and/or date of birth. A medical history is taken by means of a written questionnaire. These questions are designed to ascertain that it is medically safe for you to donate blood and that the recipient of your blood will not', '2.jpg', 'Notern hospital', 'Kangatharan', 1, '2021-05-30 22:05:46', '2021-05-30 16:35:46'),
(10, 'camp 232', 'I a434324m obtaining files and their values in a non-normal way. There isn\'t an actual input in the form. Therefore, I am trying to append the files to the formData for ajax submission.\n\nAnytime I try to submit the form with the method below, my files aren\'t uploading. Therefore, the way I am appending the files must be incorrect.', 'background2.jpg', 'lonmdon423', 'sahajn432', 1, '2021-06-01 16:20:30', '2021-06-01 14:29:57'),
(11, 'Testing Campaing', 'It\'s easy to get started with Chart.js. All that\'s required is the script included in your page along with a single node to render the chart.\nIn this example, we create a bar chart for a single dataset and render that in our page. You can see all the ways to use Chart.js in the usage documentation.', '3.jpg', 'Kandy', 'General Hospital of kandy', 1, '2021-06-03 23:56:53', '2021-06-03 18:28:21'),
(12, 'Meem', 'hgfhgf', 'img1(1).jpg', 'kokuvil', 'NDH', 40, '2021-07-20 18:54:50', '2021-07-20 13:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(2567) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `address`, `gender`, `date_of_birth`, `blood_group`, `role`, `created`, `modified`) VALUES
(1, 'Anuthiran', 'Kovintharaja', 'an@gmail.com', '$2y$10$3rr1tFHqlnHRAwxJiV1P0ekZ7eZhn9ScIiWZn.7MQi.XKd0Y8uA6u', '1021552255', 'londqn', 'male', '2002-05-15', 'A+', 'admin', '2021-05-27 22:22:55', '2021-06-03 18:02:00'),
(2, 'ram', 'kovi', 'anuuu@gmail.com', '$2y$10$XTI7tNiET4SQXl91TXD.1uZRTEjoPe5BkOP/182CMHJmGu8gwCWf2', '0778118752', 'jaffna', 'male', '2012/5/31', 'O+', 'donor', '2021-05-27 22:23:25', '2021-06-01 16:11:28'),
(35, 'thaniya', 'sri', 'anuthiran@gmail.com', '$2y$10$Ou03Sg0ajTaRH33xJRYAb.A0//rzNLfMa/UmuGXeuUKENWEyh74yy', '0125478963', 'kokuvil', 'female', '14/06/2021', 'AB+', 'admin', '2021-06-01 11:07:42', '2021-06-01 16:11:34'),
(37, 'usha', 'raja', 'uasg@mail.com', '$2y$10$AOzJ5d57i3XRnwJ9AC0qS.Mlu5bG9nS1ZSIoDEjP7uSCmBSSBPmB6', '1021552255', 'thinndukal', 'male', '12/07/2020', 'B-', 'donor', '2021-06-01 11:41:18', '2021-06-01 16:11:40'),
(40, 'Shageepan', 'R', 'shageepan@gmail.com', '$2y$10$UcjZ2.iAiY003i34Z0NTi.7BljuQKwVm2sbRGwdyr3BWYMZO.kdP.', '0778987898', 'Jaffna', 'male', '2019-01-01', 'B+', 'donor', '2021-07-20 18:49:07', '2021-07-20 13:27:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
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
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_request`
--
ALTER TABLE `blood_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
