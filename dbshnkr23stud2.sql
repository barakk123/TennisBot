-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: יולי 18, 2023 בזמן 09:36 AM
-- גרסת שרת: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshnkr23stud2`
--
CREATE DATABASE IF NOT EXISTS `dbshnkr23stud2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbshnkr23stud2`;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_categories_def_test`
--

CREATE TABLE `tbl_210_categories_def_test` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `s_type` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_categories_def_test`
--

INSERT INTO `tbl_210_categories_def_test` (`id`, `name`, `s_type`) VALUES
(1, 'Forehand', 'Strikes'),
(2, 'Backhand', 'Strikes'),
(3, 'Volley', 'Strikes'),
(4, 'Slice', 'Strikes'),
(5, 'Drop-Shot', 'Strikes'),
(6, 'Flat', 'Serves'),
(7, 'Curved', 'Serves'),
(8, 'Spin', 'Serves'),
(9, 'Fitness', 'Physical'),
(10, 'Stamina', 'Physical'),
(11, 'Top Speed', 'Physical'),
(12, 'On-Hit', 'Position'),
(13, 'Ball Await', 'Position');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_categories_test`
--

CREATE TABLE `tbl_210_categories_test` (
  `id` int(11) NOT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_categories_test`
--

INSERT INTO `tbl_210_categories_test` (`id`, `goal_id`, `category_id`) VALUES
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 4, 1),
(7, 4, 2),
(8, NULL, 1),
(9, NULL, 2),
(10, NULL, 1),
(11, NULL, 2),
(12, NULL, 6),
(13, NULL, 6),
(14, NULL, 1),
(15, NULL, 2),
(16, NULL, 5),
(17, NULL, 1),
(18, NULL, 2),
(19, NULL, 5),
(20, NULL, 1),
(21, NULL, 2),
(22, NULL, 5),
(23, NULL, 6),
(24, NULL, 1),
(25, NULL, 2),
(26, NULL, 5),
(27, NULL, 1),
(28, NULL, 2),
(29, NULL, 5),
(36, 7, 1),
(37, 7, 2),
(38, 7, 5),
(39, NULL, 6),
(40, 8, 1),
(41, 8, 2),
(42, 8, 5),
(43, 9, 9),
(44, NULL, 9),
(45, NULL, 1),
(46, NULL, 2),
(47, NULL, 5),
(48, NULL, 1),
(49, NULL, 2),
(50, NULL, 5);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_contact_test`
--

CREATE TABLE `tbl_210_contact_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `emergency_phone` varchar(10) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_contact_test`
--

INSERT INTO `tbl_210_contact_test` (`id`, `user_id`, `phone`, `city`, `emergency_phone`, `email`) VALUES
(1, 1, '0509683331', 'Petah Tikva', '0502323467', 'barakk123@gmail.com');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_details_test`
--

CREATE TABLE `tbl_210_details_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(30) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `potential` enum('Low','Moderate','High','Top','Uncertain') DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_details_test`
--

INSERT INTO `tbl_210_details_test` (`id`, `user_id`, `full_name`, `birth_date`, `height`, `weight`, `gender`, `potential`, `profile_pic`) VALUES
(1, 1, 'Barak Daniel', '1995-06-26', 170, 65, 'Male', 'Moderate', NULL),
(2, 2, 'Gal Avital', '1995-03-27', 180, 75, 'Male', 'Top', NULL);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_goals_test`
--

CREATE TABLE `tbl_210_goals_test` (
  `id` int(11) NOT NULL,
  `trainee_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `title` varchar(60) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_goals_test`
--

INSERT INTO `tbl_210_goals_test` (`id`, `trainee_id`, `coach_id`, `title`, `start_date`, `end_date`) VALUES
(2, 1, 3, 'Test test testing', '2023-04-02', '2024-06-05'),
(3, 1, 3, 'Speed Improvement', '2023-06-24', '2024-06-24'),
(4, 1, 3, 'Omer BODEK', '2023-07-18', '2023-07-18'),
(7, 1, 3, 'OMER TASHIR', '2023-07-18', '2023-07-19'),
(8, 1, 3, 'OMER08021993', '2023-07-18', '2023-07-29'),
(9, 1, 3, 'bla bla', '2023-07-17', '2023-07-17');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_skills_test`
--

CREATE TABLE `tbl_210_skills_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_skills_test`
--

INSERT INTO `tbl_210_skills_test` (`id`, `user_id`, `category_id`, `subcategory_id`, `value`) VALUES
(1, 1, 1, 1, 95),
(2, 1, 1, 2, 70),
(3, 1, 2, 1, 90),
(4, 1, 2, 2, 73),
(5, 1, 6, 1, 90),
(6, 1, 6, 2, 102),
(7, 1, 5, 2, 80),
(8, 1, 9, 3, 100),
(9, 1, 12, 4, 85);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_subcategories_def_test`
--

CREATE TABLE `tbl_210_subcategories_def_test` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_subcategories_def_test`
--

INSERT INTO `tbl_210_subcategories_def_test` (`id`, `name`) VALUES
(1, 'Accuracy'),
(2, 'Avg. Speed'),
(4, 'Grade'),
(3, 'Status');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_subcategories_test`
--

CREATE TABLE `tbl_210_subcategories_test` (
  `id` int(11) NOT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `current` varchar(30) DEFAULT NULL,
  `target` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_subcategories_test`
--

INSERT INTO `tbl_210_subcategories_test` (`id`, `goal_id`, `user_id`, `category_id`, `subcategory_id`, `current`, `target`) VALUES
(1, 2, 1, 1, 1, '65', '76'),
(2, 2, 1, 1, 2, '62', '69'),
(3, 2, 1, 2, 1, '68', '74'),
(4, 2, 1, 2, 2, '73', '78'),
(5, 3, 1, 1, 1, '62', '85'),
(7, 4, 1, 1, 2, '62', '63'),
(9, 4, 1, 2, 2, '73', '74'),
(11, 4, 1, 2, 1, '68', '71'),
(12, 4, 1, 5, 2, '76', '77'),
(13, 4, 1, 6, 1, '78', '82'),
(14, 4, 1, 1, 1, '65', '66'),
(17, 7, 1, 1, 1, '65', '66'),
(18, 7, 1, 6, 1, '78', '79'),
(19, 8, 1, 1, 1, '65', '70'),
(20, 8, 1, 1, 2, '62', '70'),
(21, 8, 1, 2, 1, '68', '90'),
(22, 8, 1, 2, 2, '73', '80'),
(23, 8, 1, 5, 2, '76', '80'),
(24, 9, 1, 9, 3, '80', '100'),
(25, 9, 1, 1, 1, '90', '95');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_trainee_coach_test`
--

CREATE TABLE `tbl_210_trainee_coach_test` (
  `id` int(11) NOT NULL,
  `trainee_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_trainee_coach_test`
--

INSERT INTO `tbl_210_trainee_coach_test` (`id`, `trainee_id`, `coach_id`) VALUES
(1, 1, 3),
(2, 2, 3);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_union_test`
--

CREATE TABLE `tbl_210_union_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `team` varchar(30) DEFAULT NULL,
  `registered_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_union_test`
--

INSERT INTO `tbl_210_union_test` (`id`, `user_id`, `experience`, `rank`, `team`, `registered_date`) VALUES
(1, 1, 4, 7, 'Hapoel Jerusalem', '2023-11-20');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_users_test`
--

CREATE TABLE `tbl_210_users_test` (
  `id` int(11) NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `user_type` enum('Chief','Coach','Trainee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_users_test`
--

INSERT INTO `tbl_210_users_test` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'barak', '$2y$10$6RWCqWlASMf4f7oEslG2yush9xSWgGhdNeNy.i7buseOYDUvNuzsi', 'Trainee'),
(2, 'gal', '$2y$10$6RWCqWlASMf4f7oEslG2yush9xSWgGhdNeNy.i7buseOYDUvNuzsi', 'Trainee'),
(3, 'aviv', '$2y$10$6RWCqWlASMf4f7oEslG2yush9xSWgGhdNeNy.i7buseOYDUvNuzsi', 'Coach');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `tbl_210_categories_def_test`
--
ALTER TABLE `tbl_210_categories_def_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- אינדקסים לטבלה `tbl_210_categories_test`
--
ALTER TABLE `tbl_210_categories_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goal_id` (`goal_id`),
  ADD KEY `category_id` (`category_id`);

--
-- אינדקסים לטבלה `tbl_210_contact_test`
--
ALTER TABLE `tbl_210_contact_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- אינדקסים לטבלה `tbl_210_details_test`
--
ALTER TABLE `tbl_210_details_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- אינדקסים לטבלה `tbl_210_goals_test`
--
ALTER TABLE `tbl_210_goals_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`coach_id`),
  ADD KEY `trainee_id` (`trainee_id`);

--
-- אינדקסים לטבלה `tbl_210_skills_test`
--
ALTER TABLE `tbl_210_skills_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- אינדקסים לטבלה `tbl_210_subcategories_def_test`
--
ALTER TABLE `tbl_210_subcategories_def_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- אינדקסים לטבלה `tbl_210_subcategories_test`
--
ALTER TABLE `tbl_210_subcategories_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goal_id` (`goal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- אינדקסים לטבלה `tbl_210_trainee_coach_test`
--
ALTER TABLE `tbl_210_trainee_coach_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trainee_id` (`trainee_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- אינדקסים לטבלה `tbl_210_union_test`
--
ALTER TABLE `tbl_210_union_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- אינדקסים לטבלה `tbl_210_users_test`
--
ALTER TABLE `tbl_210_users_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_210_categories_def_test`
--
ALTER TABLE `tbl_210_categories_def_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_210_categories_test`
--
ALTER TABLE `tbl_210_categories_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_210_contact_test`
--
ALTER TABLE `tbl_210_contact_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_210_details_test`
--
ALTER TABLE `tbl_210_details_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_210_goals_test`
--
ALTER TABLE `tbl_210_goals_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_210_skills_test`
--
ALTER TABLE `tbl_210_skills_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_210_subcategories_def_test`
--
ALTER TABLE `tbl_210_subcategories_def_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_210_subcategories_test`
--
ALTER TABLE `tbl_210_subcategories_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_210_trainee_coach_test`
--
ALTER TABLE `tbl_210_trainee_coach_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_210_union_test`
--
ALTER TABLE `tbl_210_union_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_210_users_test`
--
ALTER TABLE `tbl_210_users_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- הגבלות לטבלאות שהוצאו
--

--
-- הגבלות לטבלה `tbl_210_categories_test`
--
ALTER TABLE `tbl_210_categories_test`
  ADD CONSTRAINT `tbl_210_categories_test_ibfk_1` FOREIGN KEY (`goal_id`) REFERENCES `tbl_210_goals_test` (`id`),
  ADD CONSTRAINT `tbl_210_categories_test_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_210_categories_def_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_contact_test`
--
ALTER TABLE `tbl_210_contact_test`
  ADD CONSTRAINT `tbl_210_contact_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_210_users_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_details_test`
--
ALTER TABLE `tbl_210_details_test`
  ADD CONSTRAINT `tbl_210_details_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_210_users_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_goals_test`
--
ALTER TABLE `tbl_210_goals_test`
  ADD CONSTRAINT `tbl_210_goals_test_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `tbl_210_users_test` (`id`),
  ADD CONSTRAINT `tbl_210_goals_test_ibfk_2` FOREIGN KEY (`trainee_id`) REFERENCES `tbl_210_users_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_skills_test`
--
ALTER TABLE `tbl_210_skills_test`
  ADD CONSTRAINT `tbl_210_skills_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_210_users_test` (`id`),
  ADD CONSTRAINT `tbl_210_skills_test_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_210_categories_def_test` (`id`),
  ADD CONSTRAINT `tbl_210_skills_test_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `tbl_210_subcategories_def_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_subcategories_test`
--
ALTER TABLE `tbl_210_subcategories_test`
  ADD CONSTRAINT `tbl_210_subcategories_test_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_210_categories_def_test` (`id`),
  ADD CONSTRAINT `tbl_210_subcategories_test_ibfk_2` FOREIGN KEY (`goal_id`) REFERENCES `tbl_210_goals_test` (`id`),
  ADD CONSTRAINT `tbl_210_subcategories_test_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `tbl_210_subcategories_def_test` (`id`),
  ADD CONSTRAINT `tbl_210_subcategories_test_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `tbl_210_users_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_trainee_coach_test`
--
ALTER TABLE `tbl_210_trainee_coach_test`
  ADD CONSTRAINT `tbl_210_trainee_coach_test_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `tbl_210_users_test` (`id`),
  ADD CONSTRAINT `tbl_210_trainee_coach_test_ibfk_2` FOREIGN KEY (`trainee_id`) REFERENCES `tbl_210_users_test` (`id`);

--
-- הגבלות לטבלה `tbl_210_union_test`
--
ALTER TABLE `tbl_210_union_test`
  ADD CONSTRAINT `tbl_210_union_test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_210_users_test` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
