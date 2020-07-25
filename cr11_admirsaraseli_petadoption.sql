-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 07:18 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_admirsaraseli_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_admirsaraseli_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_admirsaraseli_petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(200) NOT NULL,
  `age` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `hobbies` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `image`, `description`, `location`, `age`, `type`, `hobbies`) VALUES
(2, 'Arizona', 'https://dgicdplf3pvka.cloudfront.net/2544257/thumbnails/dachshund-mini-puppy-picture-05def6d2-3e64-4b7e-bc64-4c3f074fffa8.jpg', 'Arizona is a English cream Dachshund. She will follow you around everywhere and enjoys her baths.  Arizona has a great temperament and gets along with all pups.', 'Baltimore, Maryland', '10 weeks', 'Small', 'She loves all pups and her baths :)'),
(5, 'Baby', 'https://dgicdplf3pvka.cloudfront.net/2084143/thumbnails/bich-poo-bichpoo-puppy-picture-8bf583f8-a50b-4973-b285-b8f8219c5bde.jpg', 'Baby is way too cute for words! She is super playful and loves attention!  She will be ready for her new home July 20th.', 'Springfield, Missouri', '8 weeks', 'Small', 'Loves words, playful and attention!'),
(6, 'Charlie', 'https://dgicdplf3pvka.cloudfront.net/927108/thumbnails/saint-bernard-st-bernard-puppy-picture-cfe25fa0-b45e-4f27-b94c-49302fe596d5.jpg', 'Charlie\'s looks and gentle low key temperament will be a perfect fit for you. Reserve him now, its first come- first choice.', 'Harrisburg, Pennsylvania', 'Male, 8 weeks', 'Small', 'Love to eat and play!'),
(7, 'Cruz', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTwxQJwnMHRrCC74OefOxlQkXceLSqOqt5QwQ&usqp=CAU', 'Say hello to Cruz! He is so strong and beautiful.  You can tell he\'s a winner just by looking at him! Cruz will be a wonderful addition for any family.', 'Springfield, Missouri', '4', 'Large', 'He love to smile :)'),
(8, 'Charlotte', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSskrt15Idtr28ZJrqhRT-brH2St0l4LdJq7g&usqp=CAU', 'She is one the most beautiful large dogs and love to find the new home and friends.', 'Atlanta, Georgia', '6', 'Large', 'Making photo and smile :)'),
(9, 'Jake', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/bernese-mountain-dog-royalty-free-image-1581013857.jpg?crop=0.87845xw:1xh;center,top&resize=980:*', 'These dogs may be one of the largest dog breeds, but they\'re truly gentle giants with a sweet, calm, and affectionate nature.', 'Bernese Mountain Dog', '5', 'Large', 'He is eager to please and make friends!'),
(11, 'Chinook', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/the-138th-annual-westminster-kennel-club-dog-show-pictured-news-photo-1581012384.jpg?crop=0.331xw:0.746xh;0.440xw,0.254xh&resize=980:*', 'Among the rarest of dog breeds, Chinooks were first bred to be all-purpose sled dogs. ', 'New Hampshire', '6', 'Large', 'He loves family and games!'),
(12, 'Rex', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/american-pit-bull-terrier-walking-on-sea-shore-royalty-free-image-1581007987.jpg?crop=0.309xw:0.781xh;0.228xw,0.219xh&resize=980:*', 'These super-athletic dogs are fun, loyal companions that are surprisingly gentle and patient with all of their family members.', 'Orlando, Florida', '9', 'Senior', 'Love to run, play and smile :)'),
(13, 'Sammy', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/samoyed-royalty-free-image-1581005065.jpg?crop=0.452xw:1.00xh;0.0897xw,0&resize=980:*', 'Known for their famous \"Sammy smile\" due to their perpetually upturned mouths, this highly energetic breed also needs vigorous exercise. ', 'Baltimore, Maryland', '10', 'Senior', 'Love sports and smile :)'),
(14, 'Jack', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/alaskan-malamute-on-snow-royalty-free-image-1581009069.jpg?crop=0.800xw:0.801xh;0.124xw,0.199xh&resize=980:*', 'By nature, Malamutes are friendly toward humans. They need a pack leader to set the standard, so stick to a training regimen early on.', 'Orlando, Florida', '8', 'Senior', 'Love people and training!'),
(15, 'Micro', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sad-sack-royalty-free-image-1581009268.jpg?crop=0.441xw:0.997xh;0.255xw,0&resize=980:*', 'As total couch potatoes, Basset Hounds love to lounge around — when they\'re not on a scent that is. Bonus: They\'re extremely patient with young children, making them a great family pick.', 'Dallas / Fort Worth, Texas', '11', 'Senior', 'Love to lounge around and children!'),
(16, 'Jackson', 'https://dgicdplf3pvka.cloudfront.net/2583892/thumbnails/french-bulldog-puppy-picture-bd03da04-55b7-44ec-9e3f-0282bb39f495.jpg', 'Jackson is a gorgeous Fawn French Bulldog puppy. He loves to play, kiss and cuddle too! ', 'Fort Wayne, Indiana', '6 weeks', 'Small', 'He loves to play, kiss and cuddle!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `status` enum('user','admin','superadmin') NOT NULL DEFAULT 'user',
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `userName`, `userEmail`, `userPass`, `status`, `image`) VALUES
(1, 'admir', 'admir@gmail.com', '2689582899dc26924a320d7200cdc0aadc7409c3e41ab9600963a0e4bc7ffb34', 'admin', 'https://image.flaticon.com/icons/svg/2206/2206368.svg'),
(2, 'test', 'test@gmail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYMoVNJxlZjwp4pBNrBGEwU60beGkoK8chyA&usqp=CAU'),
(3, 'superadmin', 'admin@gmail.com', '1718c24b10aeb8099e3fc44960ab6949ab76a267352459f203ea1036bec382c2', 'superadmin', 'https://image.flaticon.com/icons/svg/2206/2206368.svg'),
(4, 'test two', 'test2@gmail.com', '701fd6f18a46f7c72397c91b9cb1a6353744b9cca3aa329af5e5e1124b6b8c5a', 'user', 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQYMoVNJxlZjwp4pBNrBGEwU60beGkoK8chyA&usqp=CAU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
