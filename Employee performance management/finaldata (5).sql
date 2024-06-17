-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 02:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finaldata`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(50) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'IT'),
(2, 'Finance'),
(3, 'Sales'),
(4, 'HR and Admin'),
(5, 'Operation');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `monthly_pay` int(50) NOT NULL,
  `salary` int(11) DEFAULT NULL,
  `department_id` int(50) DEFAULT NULL,
  `feedback_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `fullname`, `job_title`, `monthly_pay`, `salary`, `department_id`, `feedback_id`) VALUES
(18, 'Jasper', 'Manager', 50000, 21010, 1, 3),
(19, 'Drobert Palces', 'Officer', 20000, 20606, 1, 2),
(20, 'Dennis Rey', 'Officer', 20000, 20202, 4, 1),
(22, 'Kim Gomez', 'Executive', 80000, 84040, 1, 3),
(23, 'Jay Ar ALcoran', 'Manager', 50000, 51515, 5, 2),
(24, 'Drobert', 'Officer', 20000, 21010, 5, 3),
(26, 'Desceree Ferl Comeling', 'Executive', 80000, 84040, 1, 3),
(29, 'The Gwapo Ko', 'Officer', 20000, NULL, 1, NULL),
(30, 'Elson Lim', 'Officer', 20000, 21010, 3, 3),
(31, 'Elton James', 'Officer', 20000, 20606, 3, 2),
(32, 'Arwein Valencia', 'Officer', 20000, 20202, 2, 1);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `adjust_monthly_pay` BEFORE INSERT ON `employee` FOR EACH ROW BEGIN
    IF NEW.feedback_id = 1 THEN
        SET NEW.salary = NEW.monthly_pay * 1.0101;
    ELSEIF NEW.feedback_id = 2 THEN
        SET NEW.salary = NEW.monthly_pay * 1.0303;
    ELSEIF NEW.feedback_id = 3 THEN
        SET NEW.salary = NEW.monthly_pay * 1.0505;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `adjust_monthly_pay_update` BEFORE UPDATE ON `employee` FOR EACH ROW BEGIN
    IF NEW.feedback_id = 1 THEN
        SET NEW.salary = NEW.monthly_pay * 1.0101;
    ELSEIF NEW.feedback_id = 2 THEN
        SET NEW.salary = NEW.monthly_pay * 1.0303;
    ELSEIF NEW.feedback_id = 3 THEN
        SET NEW.salary = NEW.monthly_pay * 1.0505;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_salary_before_insert` BEFORE INSERT ON `employee` FOR EACH ROW BEGIN
    IF NEW.job_title = 'Officer' THEN
        SET NEW.monthly_pay = 20000;
    ELSEIF NEW.job_title = 'Manager' THEN
        SET NEW.monthly_pay = 50000;
    ELSEIF NEW.job_title = 'Executive' THEN
        SET NEW.monthly_pay = 80000;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_salary_before_update` BEFORE UPDATE ON `employee` FOR EACH ROW BEGIN
    IF NEW.job_title != OLD.job_title THEN
        IF NEW.job_title = 'Officer' THEN
            SET NEW.monthly_pay = 20000;
        ELSEIF NEW.job_title = 'Manager' THEN
            SET NEW.monthly_pay = 50000;
        ELSEIF NEW.job_title = 'Executive' THEN
            SET NEW.monthly_pay = 80000;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `employees_without_feedback`
-- (See below for the actual view)
--
CREATE TABLE `employees_without_feedback` (
`employee_id` int(50)
,`employee_name` varchar(50)
,`job_title` varchar(50)
,`salary` varchar(21)
,`monthly_pay` int(50)
,`department_name` varchar(50)
,`criteria` varchar(50)
,`score` varchar(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `employees_with_feedback_count`
-- (See below for the actual view)
--
CREATE TABLE `employees_with_feedback_count` (
`employees_with_feedback` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `employee_overview`
-- (See below for the actual view)
--
CREATE TABLE `employee_overview` (
`employee_id` int(50)
,`employee_name` varchar(50)
,`job_title` varchar(50)
,`monthly_pay` int(50)
,`salary` int(11)
,`department_name` varchar(50)
,`criteria` varchar(50)
,`score` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(50) NOT NULL,
  `criteria` varchar(50) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `criteria`, `score`) VALUES
(1, 'Poor', 1),
(2, 'Average', 2),
(3, ' Excellent', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `feedback_employee_count`
-- (See below for the actual view)
--
CREATE TABLE `feedback_employee_count` (
`criteria` varchar(50)
,`employee_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `total_employees_per_department`
-- (See below for the actual view)
--
CREATE TABLE `total_employees_per_department` (
`department_id` int(50)
,`department_name` varchar(50)
,`total_employees` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `employees_without_feedback`
--
DROP TABLE IF EXISTS `employees_without_feedback`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employees_without_feedback`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`fullname` AS `employee_name`, `e`.`job_title` AS `job_title`, coalesce(`e`.`salary`,'Feedback not provided') AS `salary`, `e`.`monthly_pay` AS `monthly_pay`, `d`.`department_name` AS `department_name`, coalesce(`f`.`criteria`,'Feedback not provided') AS `criteria`, coalesce(`f`.`score`,'Feedback not provided') AS `score` FROM ((`employee` `e` join `department` `d` on(`e`.`department_id` = `d`.`department_id`)) left join `feedback` `f` on(`e`.`feedback_id` = `f`.`feedback_id`)) WHERE `f`.`feedback_id` is null ;

-- --------------------------------------------------------

--
-- Structure for view `employees_with_feedback_count`
--
DROP TABLE IF EXISTS `employees_with_feedback_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employees_with_feedback_count`  AS SELECT count(`e`.`employee_id`) AS `employees_with_feedback` FROM `employee` AS `e` WHERE `e`.`feedback_id` is not null ;

-- --------------------------------------------------------

--
-- Structure for view `employee_overview`
--
DROP TABLE IF EXISTS `employee_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employee_overview`  AS SELECT `e`.`employee_id` AS `employee_id`, `e`.`fullname` AS `employee_name`, `e`.`job_title` AS `job_title`, `e`.`monthly_pay` AS `monthly_pay`, `e`.`salary` AS `salary`, `d`.`department_name` AS `department_name`, `f`.`criteria` AS `criteria`, `f`.`score` AS `score` FROM ((`employee` `e` join `department` `d` on(`e`.`department_id` = `d`.`department_id`)) join `feedback` `f` on(`e`.`feedback_id` = `f`.`feedback_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `feedback_employee_count`
--
DROP TABLE IF EXISTS `feedback_employee_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `feedback_employee_count`  AS SELECT `f`.`criteria` AS `criteria`, count(`e`.`employee_id`) AS `employee_count` FROM (`employee` `e` join `feedback` `f` on(`e`.`feedback_id` = `f`.`feedback_id`)) GROUP BY `f`.`criteria` ;

-- --------------------------------------------------------

--
-- Structure for view `total_employees_per_department`
--
DROP TABLE IF EXISTS `total_employees_per_department`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_employees_per_department`  AS SELECT `d`.`department_id` AS `department_id`, `d`.`department_name` AS `department_name`, count(`e`.`employee_id`) AS `total_employees` FROM (`department` `d` left join `employee` `e` on(`d`.`department_id` = `e`.`department_id`)) GROUP BY `d`.`department_id`, `d`.`department_name` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `fk_department` (`department_id`),
  ADD KEY `fk_feedback` (`feedback_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `fk_feedback` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
