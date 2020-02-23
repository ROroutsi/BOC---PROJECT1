-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 23 Φεβ 2020 στις 01:25:51
-- Έκδοση διακομιστή: 10.4.11-MariaDB
-- Έκδοση PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `project`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `grades`
--

CREATE TABLE `grades` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `subjectone` decimal(10,0) NOT NULL,
  `subjecttwo` decimal(10,0) NOT NULL,
  `subjectthree` decimal(10,0) NOT NULL,
  `subjectfour` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `professors`
--

CREATE TABLE `professors` (
  `id` int(10) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `plastname` varchar(30) NOT NULL,
  `ppassword` varchar(255) NOT NULL,
  `pemail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `slastname` varchar(30) NOT NULL,
  `spassword` varchar(255) NOT NULL,
  `semail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forid` (`student_id`);

--
-- Ευρετήρια για πίνακα `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT για πίνακα `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1104;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `forid` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
