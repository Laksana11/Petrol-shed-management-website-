-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2022 at 01:47 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrol_set`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_tbl`
--

DROP TABLE IF EXISTS `address_tbl`;
CREATE TABLE IF NOT EXISTS `address_tbl` (
  `add_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(25) NOT NULL,
  `ds_division` varchar(10) NOT NULL,
  `max_distance` float NOT NULL,
  `grouping` varchar(5) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `distribution_date` date DEFAULT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address_tbl`
--

INSERT INTO `address_tbl` (`add_id`, `address`, `ds_division`, `max_distance`, `grouping`, `start_time`, `end_time`, `distribution_date`) VALUES
(1, 'Chunnakam', 'J/199', 1.4, 'A', '08:00:00', '10:00:00', '2022-09-05'),
(2, 'Mallakam', 'J/208', 2, 'B', '11:00:00', '13:00:00', '2022-09-06'),
(3, 'Tellipalai', 'J/227', 4, 'B', '11:00:00', '13:00:00', '2022-09-02'),
(4, 'Kandarodai', 'J/200', 2.5, 'C', '14:00:00', '16:00:00', '2022-09-06'),
(5, 'Uduvil', 'J/196', 4.4, 'A', '08:00:00', '10:00:00', '2022-08-07'),
(6, 'Maruthanarmadam', 'J/197', 2.5, 'A', '08:00:00', '10:00:00', '2022-09-05'),
(7, 'Inuvil', 'J/195', 5, 'A', '08:00:00', '10:00:00', '2022-09-07'),
(8, 'Alaveddi', 'J/218', 6.5, 'B', '11:00:00', '13:00:00', '2022-08-16'),
(9, 'Maasiyapidi', 'J/205', 4.5, 'C', '14:00:00', '16:00:00', '2022-09-02'),
(10, 'Kupplan', 'J/215', 4.7, 'B', '11:00:00', '13:00:00', '2022-09-05'),
(11, 'Rottiyaladi', 'J/198', 1.8, 'A', '08:00:00', '10:00:00', '2022-08-20'),
(12, 'Earlalai', 'J/214', 3, 'B', '11:00:00', '13:00:00', '2022-08-16'),
(13, 'Punnalaikaduvan', 'J/206', 3, 'C', '14:00:00', '16:00:00', '2022-09-07'),
(14, 'Puttur', 'J/207', 3.5, 'C', '14:00:00', '16:00:00', '2022-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

DROP TABLE IF EXISTS `admin_tbl`;
CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL,
  `admin_psw` varchar(255) NOT NULL,
  `admin_phoneNo` varchar(12) NOT NULL,
  `admin_mail` varchar(200) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_name`, `admin_psw`, `admin_phoneNo`, `admin_mail`) VALUES
(1, 'Admin', 'a43c27c2babefd68df8a694900f30a1c', '0779865654', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `analyzing_tbl`
--

DROP TABLE IF EXISTS `analyzing_tbl`;
CREATE TABLE IF NOT EXISTS `analyzing_tbl` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_liter_p` float NOT NULL DEFAULT '0',
  `sold_p` float NOT NULL DEFAULT '0',
  `total_liter_d` float NOT NULL DEFAULT '0',
  `sold_d` float NOT NULL DEFAULT '0',
  `pending_liter_p` float DEFAULT '0',
  `pending_liter_d` float DEFAULT '0',
  `total_token` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `total_income` decimal(8,2) DEFAULT '0.00',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `analyzing_tbl`
--

INSERT INTO `analyzing_tbl` (`a_id`, `total_liter_p`, `sold_p`, `total_liter_d`, `sold_d`, `pending_liter_p`, `pending_liter_d`, `total_token`, `date`, `total_income`) VALUES
(1, 220, 60, 100, 30, 160, 70, 4, '2022-08-16', '39900.00'),
(3, 250, 60, 100, 30, 190, 70, 4, '2022-08-20', '39900.00'),
(4, 250, 0, 120, 0, 0, 0, 0, '2022-08-24', '0.00'),
(5, 220, 0, 120, 0, 0, 0, 0, '2022-09-04', '0.00'),
(6, 150, 66, 100, 55, 84, 65, 7, '2022-09-05', '53350.00'),
(14, 150, 66, 120, 55, 84, 65, 7, '2022-09-05', '53350.00'),
(15, 150, 0, 120, 0, 0, 0, 0, '2022-09-06', '0.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `book`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
`user_id` int(11)
,`date` date
,`liter` float
,`fuel_type` varchar(10)
,`v_code` varchar(10)
,`v_num` int(11)
,`valid_date` date
,`start_time` time
,`end_time` time
,`filling_status` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `booked`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `booked`;
CREATE TABLE IF NOT EXISTS `booked` (
`user_id` int(11)
,`b_id` int(11)
,`date` date
,`liter` float
,`fuel_type` varchar(10)
,`v_code` varchar(10)
,`token_no` int(11)
,`v_num` int(11)
,`start_time` time
,`end_time` time
,`filling_status` varchar(15)
,`valid_date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `address` varchar(40) NOT NULL,
  `date` date DEFAULT NULL,
  `valid_date` date DEFAULT NULL,
  `phone_no` varchar(10) NOT NULL,
  `nic_no` varchar(12) NOT NULL,
  `ds_division` varchar(10) NOT NULL,
  `group_value` varchar(2) NOT NULL,
  `work_type` varchar(100) NOT NULL,
  `selected_vehicle` varchar(20) NOT NULL,
  `v_code` varchar(10) NOT NULL,
  `v_num` int(11) NOT NULL,
  `chassis_No` varchar(50) NOT NULL,
  `fuel_type` varchar(10) NOT NULL,
  `liter` float NOT NULL,
  `nic_photo` varchar(200) NOT NULL,
  `electricity_bill_photo` varchar(200) NOT NULL,
  `filling_status` varchar(15) NOT NULL DEFAULT 'Not Filled',
  `token_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`b_id`, `user_id`, `user_name`, `address`, `date`, `valid_date`, `phone_no`, `nic_no`, `ds_division`, `group_value`, `work_type`, `selected_vehicle`, `v_code`, `v_num`, `chassis_No`, `fuel_type`, `liter`, `nic_photo`, `electricity_bill_photo`, `filling_status`, `token_no`) VALUES
(1, 10, 'Nithurjini', 'Maruthanarmadam', '2022-08-16', '2022-08-23', '0779865654', '988234567V', 'J/197', 'A', 'Government Staffs ', 'Car/Van ', 'BNM', 5436, 'ME4KC23AFJ8058840', 'Petrol', 25, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 1),
(2, 2, 'Navarathan', 'Mallakam', '2022-08-16', '2022-08-23', '0776943214', '988163193V', 'J/208', 'B', 'Government Staffs ', 'Bike ', 'BHD', 7648, 'ME4KC23AFJ8058841', 'Petrol', 6, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 1),
(3, 1, 'Laksana', 'Chunnakam', '2022-09-02', '2022-09-08', '0776543214', '988163163V', 'J/199', 'A', 'Others ', 'Car/Van ', 'BHT', 7645, 'ME4KC23AFJ8058842', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 2),
(4, 14, 'Thiviya', 'Inuvil', '2022-08-16', '2022-08-23', '0776543270', '988164183V', 'J/197', 'A', 'Heavy vehicle drivers ', 'Bike ', 'BHM', 7649, 'ME4KC23AFJ8058849', 'Petrol', 4, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 3),
(5, 16, 'Kayanan', 'Chunnakam', '2022-08-16', '2022-08-23', '0776534211', '958345672V', 'J/199', 'A', 'Heavy vehicle drivers ', 'Bike ', 'BMH', 7643, 'ME4KC23AFJ8058878', 'Petrol', 4, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 4),
(6, 12, 'Logini', 'Punnalaikaduvan', '2022-08-16', '2022-08-23', '0776654321', '958163193V', 'J/206', 'C', 'Others ', 'Auto ', 'DCM', 7640, 'ME4KC23AFJ8058848', 'Petrol', 5, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 1),
(7, 8, 'Kabiyanka', 'Alaveddi', '2022-08-16', '2022-08-23', '0776543218', '988163234V', 'J/218', 'B', 'Government Staffs ', 'Bike ', 'BAD', 7667, 'ME4KC23AFJ8058844', 'Petrol', 7, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 2),
(8, 20, 'Lokeetha', 'Maasiyapidi', '2022-08-16', '2022-08-23', '0776543207', '988163456V', 'J/206', 'C', 'Others ', 'Car/Van ', 'BIH', 7655, 'ME4KC23AFJ8058850', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 2),
(9, 25, 'Pirathayini', 'Maasiyapidi', '2022-08-16', '2022-08-23', '0776541235', '988675234V', 'J/206', 'C', 'Others ', 'Car/Van ', 'BE', 7621, 'ME4KC23AFJ8058823', 'Petrol', 7, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 3),
(10, 47, 'Kogulan', 'Chunnakam', '2022-08-16', '2022-08-23', '0787655634', '945678349V', 'J/199', 'A', 'Others ', 'Car/Van ', 'BM', 5678, 'ME4KC23AFJ8058856', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 5),
(11, 48, 'Rajkumar', 'Mallakam', '2022-08-16', '2022-08-23', '0785673567', '823456789V', 'J/208', 'B', 'Heavy vehicle drivers ', 'Heavy vehicles ', 'BN', 7634, 'ME4KC23AFJ8058867', 'Diesel', 25, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 3),
(12, 49, 'Paramasothy', 'Kupplan', '2022-08-16', '2022-08-23', '0788655423', '567890904V', 'J/215', 'B', 'Others ', 'Car/Van ', 'BV', 7612, 'ME4KC23AFJ8058854', 'Petrol', 16, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 4),
(13, 50, 'Niluxsan', 'Kupplan', '2022-08-16', '2022-08-23', '0788655467', '987898765V', 'J/215', 'B', 'Others ', 'Auto ', 'BK', 7615, 'ME4KC23AFJ8058865', 'Petrol', 5, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 5),
(14, 62, 'Aarani', 'Maruthanarmadam', '2022-08-16', '2022-08-23', '0764578761', '824568799V', 'J/197', 'A', 'Others ', 'Auto ', 'BJ', 7624, 'ME4KC23AFJ8058836', 'Petrol', 5, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 6),
(15, 67, 'Sooriya', 'Puttur', '2022-08-16', '2022-08-23', '0723562821', '765724823V', 'J/207', 'C', 'Heavy vehicle drivers ', 'Heavy vehicles ', 'BG', 7626, 'ME4KC23AFJ8058825', 'Diesel', 30, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 4),
(16, 68, 'Kownikan', 'Alaveddi', '2022-08-16', '2022-08-23', '0776543278', '987856966V', 'J/218', 'B', 'Others ', 'Car/Van ', 'CD', 7501, 'ME4KC23AFJ8058701', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 6),
(17, 69, 'Nitharsan', 'Alaveddi', '2022-08-16', '2022-08-23', '0776543221', '987657666V', 'J/218', 'B', 'Government Staffs ', 'Bike ', 'BL', 7502, 'ME4KC23AFJ8058802', 'Petrol', 7, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 7),
(18, 70, 'Thanusha', 'Alaveddi', '2022-08-16', '2022-08-23', '0776543224', '947816317V', 'J/218', 'B', 'Others ', 'Bike ', 'BC', 7503, 'ME4KC23AFJ8058803', 'Petrol', 4, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 8),
(19, 42, 'Piranavan', 'Chunnakam', '2022-08-16', '2022-08-23', '0778967541', '907856231V', 'J/199', 'A', 'Others ', 'Car/Van ', 'CB', 8012, 'ME4KC23AFJ8058012', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 7),
(20, 72, 'Aaruran', 'Puttur', '2022-08-16', '2022-08-23', '0776653287', '976875764V', 'J/207', 'C', 'Others ', 'Bike ', 'BX', 7504, 'ME4KC23AFJ8058705', 'Petrol', 4, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 5),
(21, 36, 'Sivakumaran', 'Tellipalai', '2022-08-20', '2022-08-27', '0776679463', '613430164V', 'J/227', 'B', 'Others ', 'Car/Van ', 'CA', 8014, 'ME4KC23AFJ8058014', 'Petrol', 15, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 1),
(22, 20, 'Lokeetha', 'Maasiyapidi', '2022-08-20', '2022-08-27', '0776543207', '988163456V', 'J/205', 'C', 'Government Staffs ', 'Car/Van ', 'CE', 8016, 'ME4KC23AFJ8058016', 'Petrol', 25, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 1),
(23, 13, 'Gayathiri', 'Kandarodai', '2022-08-20', '2022-08-27', '0777986542', '988675432V', 'J/200', 'C', 'Others ', 'Car/Van ', 'CF', 8018, 'ME4KC23AFJ8058018', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 2),
(26, 26, 'Kayalini', 'Kandarodai', '2022-08-20', '2022-08-27', '0775672341', '988345678V', 'J/200', 'C', 'Heavy vehicle drivers ', 'Heavy vehicles ', 'HAB', 6001, 'HT4KC23AFJ8058842', 'Diesel', 30, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 3),
(29, 10, 'Nithurjini', 'Maruthanarmadam', '2022-08-24', '2022-08-31', '0779865652', '988234567V', 'J/197', 'A', 'Government Staffs ', 'Car/Van ', 'VAC', 4011, 'ME4KC23AFJ804011', 'Petrol', 25, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 1),
(30, 62, 'Aarani', 'Maruthanarmadam', '2022-08-24', '2022-08-31', '0764578761', '824568799V', 'J/197', 'A', 'Others ', 'Auto ', 'ABT', 5022, 'ME4KC23AFJ85022', 'Petrol', 5, 'NIC-photo.jpg', 'Job-ID.jpg', 'Filled', 2),
(31, 74, 'Vinuja', 'Maruthanarmadam', '2022-08-24', '2022-08-31', '0764578911', '984681212V', 'J/197', 'A', 'Heavy vehicle drivers ', 'Bike ', 'BAJ', 7022, 'ME4KC23AFJ807022', 'Petrol', 4, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 3),
(32, 50, 'Niluxsan', 'Kupplan', '2022-08-24', '2022-08-31', '0788655467', '987898765V', 'J/215', 'B', 'Others ', 'Auto ', 'ATK', 5024, 'ME4KC23AFJ815024', 'Petrol', 5, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 1),
(33, 49, 'Paramasothy', 'Kupplan', '2022-08-24', '2022-08-31', '0788655423', '567890904V', 'J/215', 'B', 'Others  ', 'Car/Van  ', 'BV', 7612, 'ME4KC23AFJ8058854 ', 'Petrol', 20, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', NULL),
(34, 10, 'Nithurjini', 'Maruthanarmadam', '2022-09-05', '2022-09-12', '0779865652', '988234567V', 'J/197', 'A', 'Heavy vehicle drivers ', 'Bike ', 'BNV', 7111, 'ME4KC23AFJ8057111', 'Petrol', 4, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 1),
(35, 50, 'Niluxsan', 'Kupplan', '2022-09-05', '2022-09-12', '0788655467', '987898765V', 'J/215', 'B', 'Government Staffs ', 'Car/Van ', 'CDV', 6090, 'ME4KC23AFJ8056090', 'Petrol', 25, 'Job-ID.jpg', 'NIC-photo.jpg', 'Filled', 2),
(36, 47, 'Kogulan', 'Chunnakam', '2022-09-05', '2022-09-12', '0787655634', '945678349V', 'J/199', 'A', 'Government Staffs ', 'Car/Van ', 'CNO', 6098, 'ME4KC23AFJ8056098', 'Diesel', 25, 'Job-ID.jpg', 'NIC-photo.jpg', 'Filled', 2),
(37, 42, 'Piranavan', 'Chunnakam', '2022-09-05', '2022-09-12', '0778967541', '907856231V', 'J/199', 'A', 'Heavy vehicle drivers ', 'Heavy vehicles ', 'HNM', 4090, 'ME4KC23AFJ8054090', 'Diesel', 30, 'NIC-photo.jpg', 'Job-ID.jpg', 'Filled', 3),
(38, 41, 'Makima', 'Chunnakam', '2022-09-05', '2022-09-12', '0776656412', '976567890V', 'J/199', 'A', 'Government Staffs ', 'Bike ', 'BGP', 7654, 'ME4KC23AFJ8057654', 'Petrol', 7, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 4),
(49, 1, 'Laksana', 'Chunnakam', '2022-09-05', '2022-09-12', '0776543214', '988163163V', 'J/199', 'A', 'Government Staffs ', 'Car/Van ', 'CVT', 3456, 'ME4KC23AFJ8053455', 'Petrol', 25, 'Job-ID.jpg', 'GS-Letter.jpg', 'Filled', 5),
(50, 50, 'Niluxsan', 'Kupplan', '2022-09-05', '2022-09-12', '0788655467', '987898765V', 'J/215', 'B', 'Others  ', 'Auto  ', 'BK', 7615, 'ME4KC23AFJ8058865 ', 'Petrol', 5, 'NIC-photo.jpg', 'GS-Letter.jpg', 'Filled', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `current_booking`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `current_booking`;
CREATE TABLE IF NOT EXISTS `current_booking` (
`user_id` int(11)
,`token_no` int(11)
,`group_value` varchar(2)
,`start_time` time
,`end_time` time
,`date` date
,`liter` float
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cur_booking`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cur_booking`;
CREATE TABLE IF NOT EXISTS `cur_booking` (
`user_id` int(11)
,`date` date
,`liter` float
,`fuel_type` varchar(10)
,`price` decimal(6,2)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_tbl`
--

DROP TABLE IF EXISTS `fuel_tbl`;
CREATE TABLE IF NOT EXISTS `fuel_tbl` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `fuel_type` varchar(10) NOT NULL,
  `available_vehicle` varchar(100) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `availability` varchar(5) NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fuel_tbl`
--

INSERT INTO `fuel_tbl` (`f_id`, `fuel_type`, `available_vehicle`, `price`, `availability`) VALUES
(1, 'Petrol', '    Bike,Auto,Car/Van', '450.00', 'Yes'),
(2, 'Diesel', '   Heavy vehicles, Car/Van', '430.00', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `occupation_tbl`
--

DROP TABLE IF EXISTS `occupation_tbl`;
CREATE TABLE IF NOT EXISTS `occupation_tbl` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_work` varchar(25) NOT NULL,
  `vehicle` varchar(20) NOT NULL,
  `max_literPetrol` float NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `occupation_tbl`
--

INSERT INTO `occupation_tbl` (`o_id`, `category_work`, `vehicle`, `max_literPetrol`, `image`) VALUES
(1, 'Government Staffs', 'Bike', 7, 'bike4.jpg'),
(2, 'Government Staffs', 'Car/Van', 25, 'car1.jpg'),
(3, 'Heavy vehicle drivers', 'Bike', 4, 'bike2.jpg'),
(4, 'Heavy vehicle drivers', 'Heavy vehicles', 30, 'bus1.png'),
(5, 'Others', 'Bike', 4, 'bike4.jpg'),
(6, 'Others', 'Car/Van', 20, 'car3.jpg'),
(7, 'Others', 'Auto', 5, 'auto1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petrol_distribution`
--

DROP TABLE IF EXISTS `petrol_distribution`;
CREATE TABLE IF NOT EXISTS `petrol_distribution` (
  `distribution_date` date NOT NULL,
  `allowed_divisions` varchar(500) NOT NULL,
  `available_until` datetime DEFAULT NULL,
  UNIQUE KEY `distribution_date` (`distribution_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petrol_distribution`
--

INSERT INTO `petrol_distribution` (`distribution_date`, `allowed_divisions`, `available_until`) VALUES
('2022-08-16', '  J/199  J/208  J/197  J/195  J/218  J/215  J/214  J/206  J/207', '2022-08-16 06:00:00'),
('2022-08-20', '  J/199  J/227  J/200  J/196  J/205  J/198', '2022-08-21 06:00:00'),
('2022-08-24', '  J/197  J/215  J/206', '2022-08-24 08:00:00'),
('2022-09-04', '  J/199  J/197  J/215  J/206', '2022-09-04 08:00:00'),
('2022-09-05', '  J/199  J/197  J/215', '2022-09-05 23:48:00'),
('2022-09-06', '  J/208  J/200', '2022-09-05 22:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

DROP TABLE IF EXISTS `users_tbl`;
CREATE TABLE IF NOT EXISTS `users_tbl` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_No` varchar(12) NOT NULL,
  `nic_no` varchar(12) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `phone_No` (`phone_No`,`nic_no`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`user_id`, `user_name`, `address`, `phone_No`, `nic_no`, `email`, `password`) VALUES
(1, 'Laksana', 'Chunnakam', '0776543214', '988163163V', 'luxsasiva@gmail', '76efcfbc01250f03573a0240db7426fb'),
(2, 'Navarathan', 'Mallakam', '0776943214', '988163193V', 'navarathan026@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(3, 'Heseetha', 'Uduvil', '0776653421', '988163173V', 'hesee@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(4, 'Mathusha', 'Mallakam', '0776983214', '988162345V', 'mathu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(5, 'Ajinthan', 'Tellipalai', '0773456778', '988765432V', 'aji@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(6, 'Srishayu', 'Rottiyaladi', '0786545453', '988163175V', 'shayu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(8, 'Kabiyanka', 'Alaveddi', '0776543218', '988163234V', 'kabi@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(9, 'Mithursan', 'Earlalai', '0776676328', '978163193V', 'mithu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(10, 'Nithurjini', 'Maruthanarmadam', '0779865652', '988234567V', 'nithu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(11, 'Aarabi', 'Puttur', '0776653245', '987642523V', 'aara@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(12, 'Logini', 'Punnalaikaduvan', '0776654321', '958163193V', 'logi@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(13, 'Gayathiri', 'Kandarodai', '0777986542', '988675432V', 'gaya@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(14, 'Thiviya', 'Inuvil', '0776543270', '988164183V', 'thivi@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(15, 'Sribanu', 'Inuvil', '0776548763', '988163893V', 'banu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(16, 'Kayanan', 'Chunnakam', '0776534211', '958345672V', 'kaya@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(20, 'Lokeetha', 'Maasiyapidi', '0776543207', '988163456V', 'loki@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(21, 'Abirami', 'Kandarodai', '0777986345', '958163193V', 'abirami@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(22, 'Arunan', 'Puttur', '0776653278', '976546789V', 'arun@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(23, 'Thusepan', 'Puttur', '0776653567', '923456789V', 'thusi@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(24, 'Priyanka', 'Puttur', '0778654321', '976578905V', 'pri@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(25, 'Pirathayini', 'Maasiyapidi', '0776541235', '988675234V', 'pira@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(26, 'Kayalini', 'Kandarodai', '0775672341', '988345678V', 'kayal@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(27, 'Bavani', 'Punnalaikaduvan', '0778653459', '768956341V', 'bava@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(28, 'Sivaselvam', 'Punnalaikaduvan', '0778653234', '723456785V', 'siva@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(29, 'Priya', 'Maasiyapidi', '0776556789', '956789054V', 'priya@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(30, 'Viththakan', 'Maasiyapidi', '0776545431', '988160812V', 'vithu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(31, 'Inthuja', 'Kandarodai', '0777986432', '975467541V', 'inthu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(32, 'Sharangan', 'Puttur', '0774567891', '988765345V', 'sara@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(33, 'Gowri', 'Kandarodai', '0776654891', '786543216V', 'gowri@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(34, 'Haribavan', 'Kopay', '0775644789', '997856341V', 'hari@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(35, 'Yathursan', 'Earlalai', '0776677891', '956789234V', 'yathu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(36, 'Sivakumaran', 'Tellipalai', '0776679463', '613430164V', 'sivaguader@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(37, 'Thusiyanthi', 'Tellipalai', '0778626554', '674589690V', 'sutti@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(38, 'Srinirupan', 'Alaveddi', '0776543781', '981237890V', 'nirupan@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(39, 'Ranji', 'Earlalai', '0785642351', '667890234V', 'ranji@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(40, 'Sritha', 'Mallakam', '0763458910', '903455789V', 'sritha@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(41, 'Makima', 'Chunnakam', '0776656412', '976567890V', 'maki@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(42, 'Piranavan', 'Chunnakam', '0778967541', '907856231V', 'pirana@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(43, 'Sivamathy', 'Inuvil', '0776689762', '987345754V', 'sivamathy@mail.com', '76efcfbc01250f03573a0240db7426fb'),
(44, 'Kumaran', 'Mallakam', '0778956423', '896745349V', 'kumaran@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(45, 'Shanthan', 'Chunnakam', '0778654782V', '923498765V', 'shanth@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(46, 'Shampavi', 'Chunnakam', '0775648901', '976874679V', 'shampu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(47, 'Kogulan', 'Chunnakam', '0787655634', '945678349V', 'kokul@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(48, 'Rajkumar', 'Mallakam', '0785673567', '823456789V', 'raj@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(49, 'Paramasothy', 'Kupplan', '0788655423', '567890904V', 'sothy@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(50, 'Niluxsan', 'Kupplan', '0788655467', '987898765V', 'nilux@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(51, 'Kiribavan', 'Rottiyaladi', '0795645672', '986745234V', 'kiri@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(52, 'Sobana', 'Rottiyaladi', '07768541256', '834567892V', 'sobana@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(53, 'Mathanky', 'Rottiyaladi', '0776872451', '976534213V', 'matha@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(54, 'Lavanya', 'Rottiyaladi', '0776872450', '988163192V', 'lava@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(55, 'Diluxsi', 'Rottiyaladi', '0778654219', '982312322V', 'dila@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(56, 'Erasan', 'Rottiyaladi', '0712345868', '987123561V', 'erasan@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(57, 'Menan', 'Rottiyaladi', '0776872490', '712345674V', 'mena@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(58, 'Shamanthi', 'Rottiyaladi', '0778653489', '965435648V', 'shamanthi@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(59, 'Tharani', 'Uduvil', '0876557641', '734567890V', 'thara@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(60, 'Luxsan', 'Uduvil', '0765289175', '974625183V', 'lux@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(61, 'Rizalini', 'Uduvil', '0713478962', '703467123V', 'riza@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(62, 'Aarani', 'Maruthanarmadam', '0764578761', '824568799V', 'arani@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(63, 'Viththiya', 'Tellipalai', '0763528467', '645669879V', 'viththi@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(64, 'Kesini', 'Tellipalai', '0773456798', '985678459V', 'kesini@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(65, 'Rushankini', 'Tellipalai', '0762432678', '988436345V', 'rukku@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(66, 'Narththana', 'Tellipalai', '0762432612', '956748212V', 'narthu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(67, 'Sooriya', 'Puttur', '0723562821', '765724823V', 'soori@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(68, 'Kownikan', 'Alaveddi', '0776543278', '987856966V', 'kowni@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(69, 'Nitharsan', 'Alaveddi', '0776543221', '987657666V', 'nitharsan@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(70, 'Thanusha', 'Alaveddi', '0776543224', '947816317V', 'thanu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(71, 'Sokina', 'Kandarodai', '0777986452', '995635234V', 'sokina@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(72, 'Aaruran', 'Puttur', '0776653287', '976875764V', 'aaruran@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(73, 'Akilan', 'Tellippalai', '0763231234', '978163193V', 'akilan@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(74, 'Vinuja', 'Maruthanarmadam', '0764578911', '984681212V', 'vinu@gmail.com', '76efcfbc01250f03573a0240db7426fb'),
(88, 'Anutharaa', 'Chunnakam', '0776543808', '938163163V', 'anip@gmail.com', '76efcfbc01250f03573a0240db7426fb');

-- --------------------------------------------------------

--
-- Structure for view `book`
--
DROP TABLE IF EXISTS `book`;

DROP VIEW IF EXISTS `book`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book`  AS SELECT `b`.`user_id` AS `user_id`, `b`.`date` AS `date`, `b`.`liter` AS `liter`, `b`.`fuel_type` AS `fuel_type`, `b`.`v_code` AS `v_code`, `b`.`v_num` AS `v_num`, `b`.`valid_date` AS `valid_date`, `a`.`start_time` AS `start_time`, `a`.`end_time` AS `end_time`, `b`.`filling_status` AS `filling_status` FROM (`bookings` `b` join `address_tbl` `a` on((`a`.`ds_division` = `b`.`ds_division`))) ;

-- --------------------------------------------------------

--
-- Structure for view `booked`
--
DROP TABLE IF EXISTS `booked`;

DROP VIEW IF EXISTS `booked`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `booked`  AS SELECT `b`.`user_id` AS `user_id`, `b`.`b_id` AS `b_id`, `b`.`date` AS `date`, `b`.`liter` AS `liter`, `b`.`fuel_type` AS `fuel_type`, `b`.`v_code` AS `v_code`, `b`.`token_no` AS `token_no`, `b`.`v_num` AS `v_num`, `a`.`start_time` AS `start_time`, `a`.`end_time` AS `end_time`, `b`.`filling_status` AS `filling_status`, `b`.`valid_date` AS `valid_date` FROM (`bookings` `b` join `address_tbl` `a` on((`a`.`ds_division` = `b`.`ds_division`))) ;

-- --------------------------------------------------------

--
-- Structure for view `current_booking`
--
DROP TABLE IF EXISTS `current_booking`;

DROP VIEW IF EXISTS `current_booking`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `current_booking`  AS SELECT `b`.`user_id` AS `user_id`, `b`.`token_no` AS `token_no`, `b`.`group_value` AS `group_value`, `a`.`start_time` AS `start_time`, `a`.`end_time` AS `end_time`, `b`.`date` AS `date`, `b`.`liter` AS `liter` FROM (`bookings` `b` join `address_tbl` `a` on((`b`.`ds_division` = `a`.`ds_division`))) WHERE ((`b`.`filling_status` = 'Filled') AND (`b`.`date` = curdate())) ;

-- --------------------------------------------------------

--
-- Structure for view `cur_booking`
--
DROP TABLE IF EXISTS `cur_booking`;

DROP VIEW IF EXISTS `cur_booking`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cur_booking`  AS SELECT `b`.`user_id` AS `user_id`, `b`.`date` AS `date`, `b`.`liter` AS `liter`, `b`.`fuel_type` AS `fuel_type`, `f`.`price` AS `price`, (`f`.`price` * `b`.`liter`) AS `total` FROM (`bookings` `b` join `fuel_tbl` `f` on((`f`.`fuel_type` = `b`.`fuel_type`))) WHERE ((`b`.`date` = curdate()) AND (`b`.`filling_status` = 'Filled')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
