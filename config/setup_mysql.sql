-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2019 at 02:01 PM
-- Server version: 5.6.42
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Database: `camagru`
-- --------------------------------------------------------
--
-- Table structure for table `comment`
--
CREATE TABLE `camagru`.`comment` (
  `comment_ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_ID` int UNSIGNED NOT NULL,
  `img_ID` int UNSIGNED NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_comment` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `liked`
--
CREATE TABLE `camagru`.`liked` (
  `liked_ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_ID` int UNSIGNED NOT NULL,
  `img_ID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `img`
--
CREATE TABLE `camagru`.`img` (
  `img_ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_ID` int UNSIGNED NOT NULL,
  `img_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `user`
--
CREATE TABLE `camagru`.`user` (
  `user_ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pseudo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/user/default_image.jpg',
  `user_cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/user_cover/default_cover.jpg',
  `user_description` varchar(1000) DEFAULT 'je suis super cool',
  `user_validated` tinyint(1) DEFAULT '0',
  `user_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_preferences` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `recuperation`
--
CREATE TABLE `camagru`.`recuperation` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code`  int UNSIGNED NOT NULL,
  `confirme` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;
