-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 07:33 AM
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
-- Database: `petcaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcementid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcementid`, `title`, `description`, `date`) VALUES
(1, 'Important Tips for Keeping Your Dog Healthy and Happy', 'As a pet owner, your dog\'s health and happiness is a top priority. However, knowing how to maintain your dog\'s wellbeing can be overwhelming. Join us for an informative session on essential tips for keeping your dog healthy and happy. Our experts will cover topics such as proper diet and exercise, grooming practices, and preventative care measures. Whether you\'re a seasoned dog owner or a new pet parent, you won\'t want to miss this valuable information.', '2023-04-27 09:49:00'),
(2, 'Protecting Your Feline Friend: The Benefits of Spaying and Neutering', 'Spaying and neutering your cat is one of the best decisions you can make for their health and wellbeing. Join us for a special event where our team of veterinarians will discuss the many benefits of spaying and neutering your feline friend. Not only does this procedure prevent unwanted litters, but it also reduces the risk of certain cancers and eliminates behavioral issues such as spraying and roaming. We\'ll also provide information on the spay/neuter process and answer any questions you may have. Give your cat the gift of health by attending this informative session.', '2023-04-27 09:51:00'),
(3, 'Summer Safety Tips for Your Furry Friends', 'As the temperature heats up, it\'s important to keep your pets safe in the summer sun. Make sure they have access to plenty of shade and water, avoid hot surfaces like asphalt, and be mindful of signs of heatstroke. Additionally, make sure your pets are protected from fleas, ticks, and other pests that are more active during the summer months.', '2023-04-27 09:52:00'),
(4, 'The Importance of Regular Vet Check-Ups for Your Pet', 'Just like humans, pets can benefit greatly from regular check-ups with their veterinarian. These visits can help catch health issues early on, before they become more serious and harder to treat. Additionally, your vet can offer advice on things like nutrition and behavior, as well as provide necessary vaccinations and preventative care.  Title: \"Preparing Your Pet for Natural Disasters', '2023-04-27 09:53:00'),
(5, 'Preparing Your Pet for Natural Disasters', 'Natural disasters like hurricanes, wildfires, and floods can be devastating for pets and their owners. To keep your furry friends safe, it\'s important to have a plan in place ahead of time. This may include creating an emergency kit with food, water, and medication, identifying pet-friendly shelters or hotels, and making sure your pets are microchipped or have other identification in case they become separated from you.', '2023-04-27 09:54:00'),
(6, 'National Pet Month: Tips for Keeping Your Furry Friend Healthy and Happy', 'The announcement highlights the importance of providing a nutritious diet, regular exercise, and proper grooming for pets, as well as the benefits of regular veterinary check-ups.', '2023-05-02 13:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `availableslots`
--

CREATE TABLE `availableslots` (
  `availableslotsid` int(11) NOT NULL,
  `date` date NOT NULL,
  `slots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availableslots`
--

INSERT INTO `availableslots` (`availableslotsid`, `date`, `slots`) VALUES
(1, '2023-05-03', 6),
(2, '2023-05-04', 6),
(3, '2023-05-11', 7),
(4, '2023-05-10', 0),
(5, '2023-05-09', 9),
(6, '2023-05-14', 3),
(7, '2023-05-20', 5),
(8, '2023-05-26', 5),
(9, '2023-05-12', 1),
(10, '2023-05-27', 4),
(11, '2023-05-28', 7),
(12, '2023-05-21', 1),
(13, '2023-05-13', 8),
(14, '2023-05-15', 8),
(15, '2023-05-16', 8),
(16, '2023-05-17', 7),
(17, '2023-05-18', 8),
(18, '2023-05-19', 8),
(19, '2023-05-22', 8),
(20, '2023-05-23', 8),
(21, '2023-05-24', 8),
(22, '2023-05-25', 9);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` int(5) NOT NULL,
  `content` text DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `reply_to` int(11) NOT NULL,
  `postid` int(5) DEFAULT NULL,
  `customerid` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `content`, `datetime`, `reply_to`, `postid`, `customerid`) VALUES
(5, 'dfdsfdsgfhgfhgfhgf', '2023-05-03 21:16:06', 0, 6, 1),
(7, 'fdsfdggrhgjhgdsgfdgfdhgfsh', '2023-05-03 21:24:36', 0, 6, 1),
(8, 'fddfgfhrfgggorekgoprtgkortjiojskldhlsakhdjjksahdf', '2023-05-03 21:24:57', 0, 6, 1),
(9, 'dsfdsfdfdsfdgthtyhythgfh', '2023-05-03 21:25:57', 0, 6, 1),
(10, 'gffdgfdgdfgsgfdsg', '2023-05-04 14:18:57', 0, 8, 1),
(11, 'testing', '2023-05-04 14:19:52', 0, 8, 1),
(12, 'dsfdsfdasfsafsfdsdsf', '2023-05-04 15:22:13', 0, 8, 1),
(13, 'tttttttttt', '2023-05-04 15:22:20', 0, 8, 1),
(15, 'test reply', '2023-05-04 16:03:13', 10, 8, 1),
(16, 'ghgfhgfhtruytuhfhdfhytrytryrtyhgfhgfhjhgjhjghjhfghgfhgfhgfhgfhghgfh', '2023-05-04 19:37:26', 11, 8, 1),
(21, 'hihihihihihihihhhi', '2023-05-05 22:22:27', 12, 8, 1),
(23, 'reply two', '2023-05-05 22:23:22', 10, 8, 1),
(24, 'testing comment', '2023-05-05 23:50:22', 0, 8, 1),
(27, 'testing reply comment', '2023-05-06 13:41:29', 24, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(5) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `noph` varchar(13) NOT NULL,
  `noic` varchar(14) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `fullname`, `email`, `noph`, `noic`, `password`, `status`) VALUES
(1, 'Testing', 'testing@gmail.com', '0123456789', '012345678987', '123', '1'),
(2, 'ttt', 'ttt@gmail.com', '0180180181', '010101100767', 'ian', '1'),
(3, 'Ian', 'ian@gmail.com', '0198889999', '019888999988', 'ian', '1'),
(4, '123123', '123@gmail.com', '0123123123', '031208100766', '123', '1');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `userid` int(5) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `noic` varchar(12) NOT NULL,
  `noph` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `usertype` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`userid`, `fullname`, `noic`, `noph`, `email`, `password`, `status`, `usertype`) VALUES
(1, 'Ian Gan', '030303100767', '0176883211', 'ianbian2@gmail.com', 'ian', '1', 'staff'),
(2, 'Admin', '031208100767', '0182133211', 'ianbian2@gmail.com', 'admin', NULL, 'owner'),
(3, 'Soon', '010101020101', '0123456789', 'soon@gmail.com', 'soon', '1', 'staff'),
(5, 'Jian', '020202030404', '01189237834', 'jian@gmail.com', 'jian', '1', 'staff'),
(9, 'ming', '050505050505', '01278963478', 'ming@gmail.com', 'ming', '1', 'staff'),
(14, 'letgo', '070707070707', '0162345678', 'letgo@gmail.com', 'letgo', '1', 'staff'),
(19, 'kl', '030303030303', '0125678899', 'kl@gmail.com', 'kl', '1', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiryid` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `noph` varchar(11) NOT NULL,
  `enquiry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiryid`, `fullname`, `email`, `noph`, `enquiry`) VALUES
(1, 'Ian Gan', 'ianbian2@gmail.com', '0123456789', 'How should i book the appointment?'),
(2, 'Ian Gan', 'ianbian2@gmail.com', '0123456789', 'How to check the schedule');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(5) NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `petid` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `title`, `datetime`, `petid`) VALUES
(1, 'testing event', '2023-05-07 05:04:00', NULL),
(2, 'eventttt', '2023-05-08 18:06:00', NULL),
(3, 'testing event', '2023-05-07 19:07:00', NULL),
(6, 'lanlan', '2023-05-16 19:00:00', NULL),
(7, 'lanlan', '2023-05-14 19:01:00', 7),
(16, 'testnextmonth', '2023-06-07 21:55:00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackid` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `noph` varchar(11) NOT NULL,
  `feedback` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackid`, `fullname`, `email`, `noph`, `feedback`) VALUES
(1, 'Jason', 'ianbian2@gmail.com', '0198889999', 'fresh water at all times.'),
(2, 'Ian Gan ', 'ianbian2@gmail.com', '0123456789', 'Good customer service, love it!'),
(3, 'Ian Gan', 'ianbian2@gmail.com', '0123456789', 'Price reasonable');

-- --------------------------------------------------------

--
-- Table structure for table `knowledge`
--

CREATE TABLE `knowledge` (
  `knowledgeid` int(5) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `type` varchar(13) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `knowledge`
--

INSERT INTO `knowledge` (`knowledgeid`, `title`, `type`, `content`) VALUES
(2, 'Test Update href to location', 'cat', 'test update from dog to cat. hiehiehie'),
(8, 'dsdsdsdsd', 'dog', 'sdsdsdsdsds');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentid` int(5) NOT NULL,
  `petid` int(5) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymentmethod` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `petid` int(5) NOT NULL,
  `petname` varchar(50) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `description` tinytext DEFAULT NULL,
  `noic` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`petid`, `petname`, `type`, `dob`, `gender`, `description`, `noic`) VALUES
(1, 'Kiki', 'dog', '2023-04-15', 'male', 'KiK KiK', '031208100767'),
(2, 'HaHa', 'Cat', '2023-04-14', 'Female', '123', '031208100767'),
(3, 'Lala', 'Cat', '2023-04-14', 'Female', '', '031208100767'),
(4, 'Jaja', 'Cat', '2023-04-14', 'Female', 'd', '031208100767'),
(5, 'GiGi', 'Dog', '2023-04-14', 'Male', '', '031208100767'),
(7, 'LanLan', 'Cat', '2023-04-01', 'Female', 'LanLan is a girl', '012345678987'),
(8, 'Mami', 'Cat', '2023-04-02', 'Female', 'Mami is a male cat', '012345678987'),
(9, 'Hapi', 'Dog', '2023-04-01', 'Female', 'testing', '012345678987'),
(10, 'DinDin', 'Dog', '2023-03-26', 'Female', '', '012345678987'),
(11, 'Mango', 'Dog', '2023-03-26', 'Female', '', '012345678987'),
(12, 'Pola', 'Cat', '2023-05-01', 'Female', '', '019888999988'),
(13, 'PolaBear', 'Cat', '2023-05-03', 'Female', '123', '019888999988');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(5) NOT NULL,
  `content` text DEFAULT NULL,
  `customerid` int(5) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `content`, `customerid`, `datetime`) VALUES
(1, 'Hello! testing', NULL, '2023-05-03 18:29:51'),
(2, 'ggggg testingtesting', NULL, '2023-05-03 18:32:20'),
(3, 'ggggggg testingggggggg', NULL, '2023-05-03 18:33:41'),
(4, 'ggggggggggg testtttttttt', 1, '2023-05-03 18:34:27'),
(5, 'dfdsfdfdsfdsfdsfd testing start', 1, '2023-05-03 18:54:45'),
(6, 'fddsfdsfdfdsfdsfdsf', 1, '2023-05-03 19:25:34'),
(7, 'dfsdfdsfdsgfghhgjhjhk', 1, '2023-05-04 01:51:39'),
(8, 'fdsfdsfdgfgfhghgh', 1, '2023-05-04 01:52:49'),
(9, '1', 1, '2023-05-06 11:31:50'),
(11, 'test post question', 1, '2023-05-06 12:34:26'),
(12, 'tetst', 1, '2023-05-06 13:43:18'),
(13, 'testing input', 1, '2023-05-17 18:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `progression`
--

CREATE TABLE `progression` (
  `progressionid` int(5) NOT NULL,
  `petid` int(5) NOT NULL,
  `petname` varchar(50) DEFAULT NULL,
  `date` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progression`
--

INSERT INTO `progression` (`progressionid`, `petid`, `petname`, `date`, `service`, `remarks`) VALUES
(1, 7, NULL, '2023-05-03 10:00 am - 11:00 am', 'Comprehensive physical exams', 'Anything is good!!'),
(2, 7, NULL, '2023-05-03 11:00 am - 12:00 pm', 'BATH PACKAGE', 'Insect are there but cleaned! No skin disease');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `S_Date` date DEFAULT NULL,
  `E_Date` date DEFAULT NULL,
  `Duration` int(5) DEFAULT NULL,
  `serviceid` int(5) NOT NULL,
  `subserviceid` int(5) NOT NULL,
  `petid` int(5) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `date`, `time`, `S_Date`, `E_Date`, `Duration`, `serviceid`, `subserviceid`, `petid`, `status`) VALUES
(2, '2023-05-03', '11:00 am - 12:00 pm', NULL, NULL, NULL, 1, 1, 7, '0'),
(3, NULL, NULL, '2023-05-03', '2023-05-04', 2, 2, 4, 8, '0'),
(4, '2023-05-03', '10:00 am - 11:00 am', NULL, NULL, NULL, 3, 9, 7, '0'),
(20, '2023-05-25', '1:00 pm - 2:00 pm', NULL, NULL, NULL, 3, 10, 4, '0'),
(22, NULL, NULL, '2023-05-21', '2023-05-27', 7, 2, 6, 4, '0'),
(23, '2023-05-10', '10:00 am - 11:00 am', NULL, NULL, NULL, 1, 1, 4, '0'),
(24, NULL, NULL, '2023-05-17', '2023-05-24', 8, 2, 6, 4, '0'),
(25, '2023-05-20', '12:00 pm - 1:00 pm', NULL, NULL, NULL, 3, 10, 7, '0'),
(26, '2023-05-20', '10:00 am - 11:00 am', NULL, NULL, NULL, 3, 10, 11, '0'),
(27, '2023-05-19', '12:00 pm - 1:00 pm', NULL, NULL, NULL, 1, 3, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceid` int(11) NOT NULL,
  `servicename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceid`, `servicename`) VALUES
(1, 'Grooming'),
(2, 'Pet Hotel'),
(3, 'Veterinary Clinic');

-- --------------------------------------------------------

--
-- Table structure for table `subservice`
--

CREATE TABLE `subservice` (
  `subserviceid` int(5) NOT NULL,
  `serviceid` int(5) NOT NULL,
  `subname` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subservice`
--

INSERT INTO `subservice` (`subserviceid`, `serviceid`, `subname`, `price`) VALUES
(1, 1, 'BATH PACKAGE', 140.00),
(2, 1, 'HAIRCUT PACKAGE', 200.00),
(3, 1, 'PUPPY 101 PACKAGE', 220.00),
(4, 2, 'Cozy Cottage', 35.00),
(5, 2, 'Purrfect Pad', 40.00),
(6, 2, 'Grand Suite', 55.00),
(7, 2, 'Royal Retreat', 75.00),
(8, 3, 'Comprehensive physical exams', 200.00),
(9, 3, 'Vaccinations', 80.00),
(10, 3, 'Dental care', 400.00),
(11, 3, 'Surgical procedures', 2000.00),
(12, 3, 'Diagnostic testing', 200.00),
(13, 3, 'Parasite prevention and treatment', 100.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcementid`);

--
-- Indexes for table `availableslots`
--
ALTER TABLE `availableslots`
  ADD PRIMARY KEY (`availableslotsid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `postid` (`postid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiryid`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `petid` (`petid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackid`);

--
-- Indexes for table `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`knowledgeid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentid`),
  ADD KEY `petid` (`petid`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`petid`),
  ADD KEY `noic` (`noic`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `progression`
--
ALTER TABLE `progression`
  ADD PRIMARY KEY (`progressionid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcementid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `availableslots`
--
ALTER TABLE `availableslots`
  MODIFY `availableslotsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `knowledgeid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `petid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `progression`
--
ALTER TABLE `progression`
  MODIFY `progressionid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`petid`) REFERENCES `pet` (`petid`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `petid` FOREIGN KEY (`petid`) REFERENCES `pet` (`petid`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
