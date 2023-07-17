-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: יולי 15, 2023 בזמן 10:04 AM
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
  `name` varchar(255) DEFAULT NULL,
  `s_type` varchar(255) DEFAULT NULL
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
(5, 3, 1);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_contact_test`
--

CREATE TABLE `tbl_210_contact_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `emergency_phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_details_test`
--

CREATE TABLE `tbl_210_details_test` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `potential` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_goals_test`
--

CREATE TABLE `tbl_210_goals_test` (
  `id` int(11) NOT NULL,
  `trainee_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Failed','In progress','Success') DEFAULT 'In progress',
  `progress` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_goals_test`
--

INSERT INTO `tbl_210_goals_test` (`id`, `trainee_id`, `coach_id`, `title`, `start_date`, `end_date`, `status`, `progress`) VALUES
(2, 1, 3, 'Test test testing', '2023-04-02', '2024-06-05', 'In progress', 0),
(3, 1, 3, 'Speed Improvement', '2023-06-24', '2024-06-24', 'In progress', 0);

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
(1, 1, 1, 1, 65),
(2, 1, 1, 2, 62),
(3, 1, 2, 1, 68),
(4, 1, 2, 2, 73);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_subcategories_def_test`
--

CREATE TABLE `tbl_210_subcategories_def_test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
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
  `current` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `tbl_210_subcategories_test`
--

INSERT INTO `tbl_210_subcategories_test` (`id`, `goal_id`, `user_id`, `category_id`, `subcategory_id`, `current`, `target`) VALUES
(1, 2, 1, 1, 1, '65', '76'),
(2, 2, 1, 1, 2, '62', '69'),
(3, 2, 1, 2, 1, '68', '74'),
(4, 2, 1, 2, 2, '73', '78'),
(5, 3, 1, 1, 1, '62', '85');

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
  `team` varchar(255) DEFAULT NULL,
  `registered_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `tbl_210_users_test`
--

CREATE TABLE `tbl_210_users_test` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_210_contact_test`
--
ALTER TABLE `tbl_210_contact_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_210_details_test`
--
ALTER TABLE `tbl_210_details_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_210_goals_test`
--
ALTER TABLE `tbl_210_goals_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_210_skills_test`
--
ALTER TABLE `tbl_210_skills_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_210_subcategories_def_test`
--
ALTER TABLE `tbl_210_subcategories_def_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_210_subcategories_test`
--
ALTER TABLE `tbl_210_subcategories_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_210_trainee_coach_test`
--
ALTER TABLE `tbl_210_trainee_coach_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_210_union_test`
--
ALTER TABLE `tbl_210_union_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
