-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2024 at 12:10 PM
-- Server version: 5.7.33
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adcategories`
--

CREATE TABLE `adcategories` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adcategories`
--

INSERT INTO `adcategories` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Front Banner', 1, '2024-06-11 21:40:30', '2024-06-11 21:40:30'),
(2, 'Success Banner', 1, '2024-06-11 21:44:06', '2024-06-11 21:44:06'),
(4, 'App Banner', 1, '2024-06-12 04:08:48', '2024-06-12 22:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `name`, `phone`, `email`, `password`, `image`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', '01844590333', 'dev@gmail.com', '$2y$10$54NkthtSHuZ7JuH5nUO12e5P4YjGEvPIcZLWLYHXc.Fd2MQYKGfPe', 'image', 'address', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `adcategory_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `adcategory_id`, `title`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Premium course', 'images/ads/1801632425784081.png', '#', 1, '2024-06-11 22:59:09', '2024-06-11 23:36:12'),
(2, 1, 'Free course', 'images/ads/1801632447269656.png', '#', 1, '2024-06-11 23:36:32', '2024-06-11 23:36:32'),
(3, 2, 'Success 1', 'images/ads/1801633123499541.png', '#', 1, '2024-06-11 23:47:17', '2024-06-11 23:47:17'),
(4, 2, 'Success 2', 'images/ads/1801633126965987.png', '#', 1, '2024-06-11 23:47:20', '2024-06-11 23:47:20'),
(5, 2, 'Success 3', 'images/ads/1801633130500713.png', '#', 1, '2024-06-11 23:47:24', '2024-06-11 23:47:24'),
(6, 4, 'App banenr', 'images/ads/1801649603138461.png', '#', 1, '2024-06-12 04:09:13', '2024-06-12 04:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_banking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `percentage` int(10) UNSIGNED DEFAULT NULL,
  `validity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `name`, `email`, `password`, `phone`, `mobile_banking`, `gender`, `dob`, `profession`, `institution`, `department`, `address`, `image`, `status`, `percentage`, `validity`, `created_at`, `updated_at`) VALUES
(1, 'aff 1', 'fsd.ramjan@gmail.com', '$2y$10$PfxSk61e76AgtQt279sbjO1F/X6Wul6IqR7KLDCh50d3zjMPRhR0u', '321654987', '3698745', 'Male', '2002-12-30', 'Teacher', 'School name', 'Math', 'address', 'images/affiliate/1752396740625398.png', 1, NULL, NULL, '2022-12-13 11:36:25', '2022-12-16 12:49:18'),
(4, 'gg', 'ggg@gmail.com', '$2y$10$PfxSk61e76AgtQt279sbjO1F/X6Wul6IqR7KLDCh50d3zjMPRhR0u', '0177128210444', '1', '1', '2023-01-05', 'gg', 'gg', 'gg', 'gg', NULL, 1, 2, 17, '2023-01-04 23:36:36', '2023-01-25 12:53:55'),
(7, 'Ash1', 'ashraf@gmail.com', '$2y$10$sQDOuUydWc3r826vNbDD6uYKUEuZU4bJo4/hlYKxrzX0vUPijXf7q', '01555555555', '3698745', 'Male', '2002-12-30', 'Teacher', 'School name', 'Math', 'address', 'images/affiliate/1757712060341023.jpg', 1, 4, 17, '2023-02-13 17:37:08', '2023-02-13 17:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_click_counts`
--

CREATE TABLE `affiliate_click_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED NOT NULL,
  `click` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliate_click_counts`
--

INSERT INTO `affiliate_click_counts` (`id`, `affiliate_id`, `click`, `created_at`, `updated_at`) VALUES
(1, 4, 5, '2023-01-25 14:25:46', '2023-01-25 14:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `instructor_id`, `course_id`, `name`, `institution`, `designation`, `image`, `created_at`, `updated_at`) VALUES
(272, 3, 29, 'gg', 'gg', 'gg', '', '2023-01-19 04:53:12', '2023-01-19 04:53:12'),
(289, 10, 62, 'author 51', 'an51', 'ad51', '/images/author/1677300253.png', '2023-02-25 11:44:13', '2023-02-25 11:44:13'),
(290, 10, 62, 'author 512', 'an512', 'ad512', '/images/author/1677300253.png', '2023-02-25 11:44:13', '2023-02-25 11:44:13'),
(309, 10, 78, 'gg', 'gg', 'gg', 'images/author/1758865948014109.jpg', '2023-02-26 11:21:20', '2023-02-26 11:21:20'),
(310, 10, 78, 'gg', 'gg', 'gg', 'images/author/1758869044793559.jpg', '2023-02-26 12:10:33', '2023-02-26 12:10:33'),
(311, 10, 78, 'gg', 'gg', 'gg', 'images/author/1758871432608611.jpg', '2023-02-26 12:13:28', '2023-02-26 12:48:31'),
(312, 10, 78, 'c', 'c', 'c', 'images/author/1758869543048551.jpg', '2023-02-26 12:18:29', '2023-02-26 12:18:29'),
(313, 10, 78, 'gg', 'gg', 'gg', 'images/author/1758869872426352.jpg', '2023-02-26 12:23:43', '2023-02-26 12:23:43'),
(314, 10, 78, 'gg', 'gg', 'gg', 'images/author/1758870816254054.jpg', '2023-02-26 12:38:43', '2023-02-26 12:38:43'),
(315, 10, 78, 'gg', 'gg', 'gg', 'images/author/1758871417435308.jpg', '2023-02-26 12:38:59', '2023-02-26 12:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `image1` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `image2` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `additional_text` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `image1`, `image2`, `additional_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 'নিজেকে গড়ুন, নতুন কিছু সৃষ্টি করুন', 'আইটি সেক্টরে নিজের ক্যারিয়ার তৈরিতে আমাদের কোর্সসমূহই যথেষ্ট, আজই যুক্ত হন।', 'frontend/img/uploads/1801554219548293.jpg', 'frontend/img/uploads/edu2.jpg', 'আমাদের ভবিষ্যৎ, “নিজেকে গড়ার মাধ্যমেই তৈরি করতে হবে।', 1, '2024-06-11 06:53:40', '2024-06-11 03:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8,
  `image` varchar(100) NOT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `image`, `banner`, `status`, `created_at`, `updated_at`) VALUES
(1, 'পাবলিক এডুকেশনে গ্লোবাল লার্নিং এর চ্যালেঞ্জ', '<div class=\"blog__text mb-40\" style=\"margin: 0px 0px 40px; padding: 0px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif;\"><p class=\"bn-normal\" style=\"margin-right: 0px; margin-bottom: 27px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; font-size: 18px; color: rgb(83, 84, 91); line-height: 28px;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে। মানুষকে দেখতে হল খুব ছোটো, কিন্তু সেটা একটা কৌশল মাত্র। এবারকার জীবযাত্রার পালায় বিপুলতাকে করা হল বহুলতায় পরিণত। মহাকায় জন্তু ছিল প্রকাণ্ড একলা, মানুষ হল দূরপ্রসারিত অনেক।</p></div><div class=\"blog__quote grey-bg mb-45 p-relative fix\" style=\"margin: 0px 0px 45px; padding: 40px 50px; overflow: hidden; position: relative; background: rgb(243, 244, 248); border-radius: 4px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif;\"><img class=\"quote\" src=\"http://127.0.0.1:8000/assets/frontend/img/blog/quote-1.png\" alt=\"\" style=\"margin: 0px; padding: 0px; transition: all 0.3s ease-out 0s; position: absolute; bottom: -34px; right: 50px;\"><blockquote style=\"margin: 0px; padding: 0px;\"><p class=\"bn-normal\" style=\"margin-right: 0px; margin-bottom: 25px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; font-size: 24px; color: rgb(14, 17, 51); line-height: 1.3;\">মানুষকে দেখতে হল খুব ছোটো, কিন্তু সেটা একটা কৌশল মাত্র। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য।</p><h4 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 30px; font-size: 20px; transition: all 0.3s ease-out 0s; font-family: Hind, sans-serif; color: rgb(14, 17, 51); position: relative;\">চেরিস কলিন্স</h4></blockquote></div><p class=\"bn-normal\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; font-family: Bangla, Arial, sans-serif; font-size: 20px; color: rgb(109, 110, 117); line-height: 26px;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে। মানুষকে দেখতে হল খুব ছোটো, কিন্তু সেটা একটা কৌশল মাত্র। এবারকার জীবযাত্রার পালায় বিপুলতাকে করা হল বহুলতায় পরিণত। মহাকায় জন্তু ছিল প্রকাণ্ড একলা, মানুষ হল দূরপ্রসারিত অনেক।</p><div class=\"blog__link mb-35\" style=\"margin: 0px 0px 35px; padding: 0px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif;\"><p class=\"bn-normal\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; font-size: 26px; color: rgb(14, 17, 51); line-height: 1.4;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে। মানুষকে দেখতে হল খুব ছোটো, কিন্তু সেটা একটা কৌশল মাত্র। এবারকার জীবযাত্রার পালায় বিপুলতাকে করা হল বহুলতায় পরিণত। মহাকায় জন্তু ছিল প্রকাণ্ড একলা, মানুষ হল দূরপ্রসারিত অনেক।</p></div><div class=\"blog__img w-img mb-45\" style=\"margin: 0px 0px 45px; padding: 0px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif;\"><img src=\"http://127.0.0.1:8000/assets/frontend/img/blog/big/blog-big-1.jpg\" alt=\"\" style=\"margin: 0px; padding: 0px; transition: all 0.3s ease-out 0s; width: 736px; border-radius: 6px;\"></div><div class=\"blog__text mb-40\" style=\"margin: 0px 0px 40px; padding: 0px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif;\"><h3 style=\"margin-right: 0px; margin-bottom: 12px; margin-left: 0px; padding: 0px; font-weight: 700; font-size: 30px; transition: all 0.3s ease-out 0s; font-family: Hind, sans-serif; color: rgb(14, 17, 51);\">নিজেকে এমন ভাবে তৈরি কর যেন কোন খারাপ পরিস্থিতিতে ও মাথা নিচু করতে না হয়</h3><p class=\"bn-normal\" style=\"margin-right: 0px; margin-bottom: 27px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; font-size: 18px; color: rgb(83, 84, 91); line-height: 28px;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে। মানুষকে দেখতে হল খুব ছোটো, কিন্তু সেটা একটা কৌশল মাত্র। এবারকার জীবযাত্রার পালায় বিপুলতাকে করা হল বহুলতায় পরিণত। মহাকায় জন্তু ছিল প্রকাণ্ড একলা, মানুষ হল দূরপ্রসারিত অনেক।</p><div><br></div></div>', 'images/blogs/1797644501709300.jpg', 'images/blogs/1797644501782579.jpg', 1, '2024-04-28 23:05:36', '2024-04-28 23:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `description`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(0, 'Live Courses', 'images/category/1801448205003937.jpg', 'Find & Download Live Class.', 'fas fa-signal-stream', 1, '2024-06-09 22:48:05', '2024-06-09 22:58:49'),
(1, 'Class 12', 'images/category/1757966874730453.png', 'সকল কিছুই ডেটার উপর নির্ভরশীল', 'fa fa-school', 1, '2022-11-27 10:17:41', '2023-02-16 13:10:57'),
(2, 'New class', 'images/category/1797553689748215.jpg', 'You know what!!', 'fa fa-school', 1, '2024-04-27 23:06:26', '2024-06-09 22:59:18'),
(3, 'HSC', 'images/category/1801727211768931.jpg', 'অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।', 'fa fa-circle-o', 1, '2024-06-13 00:42:47', '2024-06-13 00:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `childcategories`
--

CREATE TABLE `childcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `childcategories`
--

INSERT INTO `childcategories` (`id`, `subcategory_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'science', 'images/category/1757966903600083.png', 1, '2022-11-27 10:40:58', '2023-02-16 13:11:25'),
(2, 5, 'Physics', 'images/childcategory/1801727498984587.jpg', 1, '2024-06-13 00:47:21', '2024-06-13 00:47:21'),
(3, 5, 'Chemistry', 'images/childcategory/1801727507193006.jpg', 1, '2024-06-13 00:47:28', '2024-06-13 00:47:28'),
(4, 5, 'Biology', 'images/childcategory/1801727518111966.jpg', 1, '2024-06-13 00:47:39', '2024-06-13 00:47:39'),
(5, 5, 'Higher math', 'images/childcategory/1801727527834794.jpg', 1, '2024-06-13 00:47:48', '2024-06-13 00:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `childsubcategories`
--

CREATE TABLE `childsubcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `childcategory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `childsubcategories`
--

INSERT INTO `childsubcategories` (`id`, `childcategory_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'dsd', 'images/childsubcategory/1750669262554867.png', 1, '2022-11-27 10:58:32', '2022-11-27 11:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE `company_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_link` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_infos`
--

INSERT INTO `company_infos` (`id`, `name`, `about`, `address`, `email`, `phone_one`, `phone_two`, `phone_three`, `logo`, `favicon`, `app_logo`, `app_link`, `facebook`, `youtube`, `linkedin`, `pinterest`, `twitter`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'Easy learning', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 'easy.learning@gmail.com', '11111111', '22222222', '33333333', 'images/site/1800192431772423.png', 'images/site/1800192432217773.png', 'images/site/1800192432247533.png', 'fd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-27 02:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_date` date NOT NULL,
  `coupon_type` int(10) UNSIGNED NOT NULL,
  `coupon_discount` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_date`, `coupon_type`, `coupon_discount`, `created_at`, `updated_at`) VALUES
(1, 'asdfg', '2023-01-07', 1, 3, '2022-12-16 09:42:12', '2022-12-16 09:42:12'),
(2, 'ALIF50', '2024-05-10', 1, 50, '2024-05-05 00:08:43', '2024-05-05 00:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `childcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `childsubcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `enrolled` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `discount` int(10) UNSIGNED DEFAULT NULL,
  `old_price` int(10) UNSIGNED DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `revenue` int(11) NOT NULL DEFAULT '0',
  `instructor_commision` int(11) NOT NULL DEFAULT '0' COMMENT 'percentage',
  `commision_amount` int(11) NOT NULL DEFAULT '0',
  `commision_due` int(11) NOT NULL DEFAULT '0',
  `commision_paid` int(11) NOT NULL DEFAULT '0',
  `commision_paystatus` int(11) DEFAULT NULL COMMENT 'null=unpaid,\r\n0=requested,\r\n1=paid',
  `thumbnil_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `details_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_text` text COLLATE utf8mb4_unicode_ci,
  `zoom_link` text COLLATE utf8mb4_unicode_ci,
  `zoom_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zoom_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `embed_video` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `trending` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `favorite` tinyint(1) NOT NULL DEFAULT '0',
  `common` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `instructor_id`, `category_id`, `subcategory_id`, `childcategory_id`, `childsubcategory_id`, `enrolled`, `name`, `price`, `discount`, `old_price`, `discount_price`, `revenue`, `instructor_commision`, `commision_amount`, `commision_due`, `commision_paid`, `commision_paystatus`, `thumbnil_image`, `details`, `details_file`, `certificate_image`, `certificate_text`, `zoom_link`, `zoom_password`, `zoom_video`, `embed_video`, `status`, `trending`, `featured`, `favorite`, `common`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, 1, 1, 0, 'course 13', 1234, 2, 24, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-1.jpg', '<p><span style=\"color: rgb(68, 68, 68); font-family: Roboto, sans-serif; font-size: 14px;\">Laugh and cry. Having a good sob is reputed to be good for you. So is laughter, which has been shown to help heal bodies, as well as broken hearts. Studies in Japan indicate that laughter boosts the immune system and helps the body shake off allergic reactions.</span><br></p>', 'images/courses/1751743313561151.pdf', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, '2022-12-09 07:30:07', '2023-01-16 03:33:18'),
(11, 2, 1, 1, 1, 1, 0, 'Course name is here', 5656, 100, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-1.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2022-12-19 03:17:13', '2022-12-19 03:17:13'),
(12, 2, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-4.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2022-12-25 21:14:00', '2022-12-25 21:14:00'),
(13, 2, 1, 1, 1, NULL, 0, 'Lorem Ipsum Course', 1200, 5, NULL, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-3.jpg', 'Lorem Ipsum dolor sumit', 'images/courses/1753249173967889.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2022-12-25 22:25:07', '2022-12-25 22:25:07'),
(14, 2, 1, 1, 1, 1, 0, 'Course name is here', 5656, 100, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-5.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2022-12-26 05:15:38', '2022-12-26 05:15:38'),
(15, 2, 1, 1, 1, NULL, 0, 'Lorem Ipsum Course', 1200, NULL, 0, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-6.jpg', 'Lorem Ipsum dolor sumit', 'images/courses/1753335813308462.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2022-12-26 21:22:13', '2022-12-26 21:22:13'),
(16, 2, 1, 1, 1, NULL, 0, 'gg', 55, 5, NULL, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-7.jpg', 'gg', 'images/courses/1753540799817335.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2022-12-29 03:40:23', '2022-12-29 03:40:23'),
(20, 3, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-8.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2023-01-16 05:26:26', '2023-01-16 05:26:26'),
(22, 3, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-9.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2023-01-16 22:07:58', '2023-01-16 22:07:58'),
(27, 3, 1, 1, 1, NULL, 0, 'gg', 555, 5, NULL, NULL, 0, 0, 0, 0, 0, NULL, 'images/course/1755242160815486.jpg', 'rr', 'images/courses/1755242160816363.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2023-01-16 22:22:47', '2023-01-16 22:22:47'),
(28, 3, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-3.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2023-01-18 00:40:36', '2023-01-18 00:40:36'),
(29, 3, 1, 1, 1, NULL, 0, 'gg', 44, 5, NULL, NULL, 0, 0, 0, 0, 0, NULL, 'images/course/1755423200536893.jpg', 'gg', 'images/courses/1755423200540945.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2023-01-18 22:20:20', '2023-01-18 22:20:20'),
(31, 1, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-2.jpg', 'course details as u want u can write', 'file', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2023-01-21 14:47:16', '2023-01-21 14:47:16'),
(32, 1, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-7.jpg', 'course details as u want u can write', '/images/course/1674402649.pdf', NULL, NULL, NULL, NULL, '/images/course/1674402649.mp4', NULL, 1, 0, 0, 0, 0, '2023-01-22 09:50:49', '2023-01-22 09:50:49'),
(33, 1, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-6.jpg', 'course details as u want u can write', '/images/course/1674402671.pdf', NULL, NULL, NULL, NULL, '/images/course/1674402671.mp4', NULL, 1, 0, 0, 0, 0, '2023-01-22 09:51:11', '2023-01-22 09:51:11'),
(34, 1, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-4.jpg', 'course details as u want u can write', '/images/course/1674402904.pdf', NULL, NULL, NULL, NULL, '/images/course/1674402904.mp4', NULL, 1, 0, 0, 0, 0, '2023-01-22 09:55:04', '2023-01-22 09:55:04'),
(35, 1, 1, 1, 1, 1, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-8.jpg', 'course details as u want u can write', '/images/course/1674403115.pdf', NULL, NULL, NULL, NULL, '/images/course/1674403115.mp4', NULL, 1, 0, 0, 0, 0, '2023-01-22 09:58:35', '2023-01-22 09:58:35'),
(50, 3, 1, 1, 1, NULL, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-2.jpg', 'course details as u want u can write', '/images/course/1675761381.pdf', NULL, NULL, NULL, NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-07 16:16:21', '2023-02-07 16:16:21'),
(53, 3, 1, 1, 1, NULL, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-3.jpg', 'course details as u want u can write', '/images/course/1675761428.pdf', NULL, NULL, NULL, NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-07 16:17:08', '2023-02-07 16:17:08'),
(54, 3, 1, 1, 1, NULL, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-9.jpg', 'course details as u want u can write', '/images/course/1675764773.pdf', NULL, NULL, NULL, NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-07 17:12:53', '2023-02-07 17:12:53'),
(55, 3, 1, 1, 1, NULL, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, 'frontend/img/course/course-3.jpg', 'course details as u want u can write', '/images/course/1675767001.pdf', NULL, NULL, NULL, NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-07 17:50:01', '2023-02-07 17:50:01'),
(56, 3, 1, 1, 1, NULL, 0, 'Course name is here', 5656, 2, 123, NULL, 0, 0, 0, 0, 0, NULL, '/images/course/1675771542.png', 'course details as u want u can write', '/images/course/1675771542.pdf', NULL, NULL, NULL, NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-07 19:05:42', '2023-02-07 19:05:42'),
(62, 9, 1, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-13 12:25:07', '2023-02-13 12:25:07'),
(65, 9, 1, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 12:47:58', '2023-02-15 12:47:58'),
(66, 9, 1, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, '/images/course/1676440207.png', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 12:50:07', '2023-02-15 12:50:07'),
(67, 9, 1, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, '/images/course/1676452886.png', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 16:21:26', '2023-02-15 16:21:26'),
(69, 9, 1, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 16:54:34', '2023-02-15 16:54:34'),
(70, 9, 1, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 16:56:41', '2023-02-15 16:56:41'),
(71, 9, 2, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 16:58:26', '2023-02-15 16:58:26'),
(72, 9, 2, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 16:58:33', '2023-02-15 16:58:33'),
(73, 9, 2, 1, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, 'image', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 17:00:01', '2023-02-15 17:00:01'),
(74, 9, 2, 2, 1, 1, 0, 'abcdefgh', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, NULL, 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-15 17:55:22', '2023-02-15 17:55:22'),
(77, 9, 1, 1, 1, 1, 0, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam', 100, 10, 90, NULL, 0, 0, 0, 0, 0, NULL, '/images/course/1676518361.png', 'asdasdfsafsggfdgdgs', 'file', NULL, NULL, 'zdsfcdzsfcszdfsfd', NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-16 10:32:41', '2023-02-16 10:32:41'),
(78, 10, 1, 1, 1, NULL, 4, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam', 100, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'images/courses/1757967255801060.jpg', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Where does it come from?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'images/courses/1757985996510568.pdf', NULL, NULL, NULL, NULL, 'zoom_video', NULL, 1, 0, 0, 0, 0, '2023-02-16 10:33:00', '2023-02-16 18:14:53'),
(79, 2, 2, 2, NULL, NULL, 0, 'New course', 1000, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'images/course/1797558303471224.jpg', '<p><span style=\"font-weight: 700;\">New Course details</span><br></p>', NULL, 'images/courses/certificate/1800995649765558.jpg', '<h3 class=\"mb-4\" style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; padding: 0px; font-weight: inherit; line-height: 1.25; font-size: inherit; transition: all 0.3s ease-out 0s; font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif; color: rgb(17, 24, 39); border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ;\">কোর্সটি সফলভাবে শেষ করলে আপনার জন্য আছে সার্টিফিকেট যা আপনি-</h3><ul class=\"mb-6\" style=\"margin-right: 0px; margin-bottom: 1.5rem; margin-left: 0px; padding: 0px; list-style: none; font-size: medium; border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif;\"><li class=\"mb-2 flex items-start gap-2\" style=\"margin-top: 0px; margin-right: 0px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; list-style: none; font-size: 18px; gap: 0.5rem; border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-weight: inherit; line-height: 1.25; font-size: inherit; transition: all 0.3s ease-out 0s; font-family: Hind, sans-serif; color: rgb(14, 17, 51); border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ;\">আপনার সিভিতে যোগ করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"margin-top: var(--space); margin-right: 0px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; list-style: none; font-size: 18px; gap: 0.5rem; border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-weight: inherit; line-height: 1.25; font-size: inherit; transition: all 0.3s ease-out 0s; font-family: Hind, sans-serif; color: rgb(14, 17, 51); border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ;\">লিংকডইন প্রোফাইলে সরাসরি শেয়ার করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"margin-top: var(--space); margin-right: 0px; margin-left: 0px; padding: 0px; transition: all 0.3s ease-out 0s; list-style: none; font-size: 18px; gap: 0.5rem; border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-weight: inherit; line-height: 1.25; font-size: inherit; transition: all 0.3s ease-out 0s; font-family: Hind, sans-serif; color: rgb(14, 17, 51); border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ;\">ফেসবুকে এক ক্লিকেই শেয়ার করতে পারবেন</h3></li></ul>', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, '2024-04-28 00:19:46', '2024-06-13 03:05:36'),
(80, 11, 2, 2, NULL, NULL, 0, 'Instructor Course', 1000, NULL, NULL, 0, 0, 0, 0, 0, 0, 1, 'images/course/1797656152973006.jpg', '--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-04-29 02:15:02', '2024-06-25 05:51:45'),
(81, 1, 2, 2, NULL, NULL, 0, 'Certificate course', 15000, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'images/course/1800993531873767.jpg', '<p>course details</p>', NULL, 'images/course/1800993531948844.jpg', '<h3 class=\"mb-4\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif;\">কোর্সটি সফলভাবে শেষ করলে আপনার জন্য আছে সার্টিফিকেট যা আপনি-</h3><ul class=\"mb-6\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style: none; margin-right: 0px; margin-bottom: 1.5rem; margin-left: 0px; padding: 0px; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif; font-size: medium;\"><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">আপনার সিভিতে যোগ করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">লিংকডইন প্রোফাইলে সরাসরি শেয়ার করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">ফেসবুকে এক ক্লিকেই শেয়ার করতে পারবেন</h3></li></ul>', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-06-04 22:21:15', '2024-06-04 22:21:15'),
(82, 1, 2, 2, NULL, NULL, 0, 'Certificate course', 15000, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'images/course/1800993585436764.jpg', '<p>course details</p>', NULL, 'images/course/1800993585470684.jpg', '<h3 class=\"mb-4\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif;\">কোর্সটি সফলভাবে শেষ করলে আপনার জন্য আছে সার্টিফিকেট যা আপনি-</h3><ul class=\"mb-6\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style: none; margin-right: 0px; margin-bottom: 1.5rem; margin-left: 0px; padding: 0px; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif; font-size: medium;\"><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">আপনার সিভিতে যোগ করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">লিংকডইন প্রোফাইলে সরাসরি শেয়ার করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">ফেসবুকে এক ক্লিকেই শেয়ার করতে পারবেন</h3></li></ul>', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-06-04 22:22:06', '2024-06-04 22:22:06');
INSERT INTO `courses` (`id`, `instructor_id`, `category_id`, `subcategory_id`, `childcategory_id`, `childsubcategory_id`, `enrolled`, `name`, `price`, `discount`, `old_price`, `discount_price`, `revenue`, `instructor_commision`, `commision_amount`, `commision_due`, `commision_paid`, `commision_paystatus`, `thumbnil_image`, `details`, `details_file`, `certificate_image`, `certificate_text`, `zoom_link`, `zoom_password`, `zoom_video`, `embed_video`, `status`, `trending`, `featured`, `favorite`, `common`, `created_at`, `updated_at`) VALUES
(83, 1, 2, 2, NULL, NULL, 0, 'Certificate course 2', 15000, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'images/course/1800993739487440.jpg', '<p>course details</p>', NULL, 'images/courses/certificate/1800993739531555.jpg', '<h3 class=\"mb-4\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif;\">কোর্সটি সফলভাবে শেষ করলে আপনার জন্য আছে সার্টিফিকেট যা আপনি-</h3><ul class=\"mb-6\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; list-style: none; margin-right: 0px; margin-bottom: 1.5rem; margin-left: 0px; padding: 0px; color: rgb(17, 24, 39); font-family: __Inter_aaf875, __Inter_Fallback_aaf875, __Noto_Sans_Bengali_08132e, __Noto_Sans_Bengali_Fallback_08132e, sans-serif; font-size: medium;\"><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">আপনার সিভিতে যোগ করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">লিংকডইন প্রোফাইলে সরাসরি শেয়ার করতে পারবেন</h3></li><li class=\"mb-2 flex items-start gap-2\" style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; display: flex; align-items: flex-start; gap: 0.5rem;\"><svg stroke=\"currentColor\" fill=\"currentColor\" stroke-width=\"0\" viewBox=\"0 0 20 20\" aria-hidden=\"true\" class=\"text-[#6294F8]\" height=\"24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path fill-rule=\"evenodd\" d=\"M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z\" clip-rule=\"evenodd\"></path></svg><h3 style=\"border: 0px solid rgb(219, 225, 235); --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(59,130,246,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; font-size: inherit; font-weight: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;\">ফেসবুকে এক ক্লিকেই শেয়ার করতে পারবেন</h3></li></ul>', NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-06-04 22:24:33', '2024-06-04 22:24:33'),
(84, 2, 0, 3, NULL, NULL, 0, 'Live Course (Online)', 22500, 10, 25000, 2500, 0, 0, 0, 0, 0, NULL, 'images/course/1801451107158662.jpg', '<p>live course starting at this point</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-06-09 23:34:13', '2024-06-23 23:05:54'),
(85, 2, 0, 3, NULL, NULL, 0, 'Math 101', 1000, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 'images/course/1801540600127923.jpg', '<p>Course details</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-06-10 23:16:40', '2024-06-10 23:16:40'),
(86, 11, 0, 3, NULL, NULL, 0, 'Instructor Live Course', 15000, NULL, NULL, 0, 0, 0, 0, 0, 0, 1, 'images/course/1801542892657068.jpg', '<p>details</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, 0, '2024-06-10 23:53:06', '2024-06-25 05:51:45'),
(87, 2, 3, 5, 4, NULL, 0, 'Biology Crush Course', 20000, 0, 20000, 0, 0, 0, 0, 0, 0, NULL, 'images/course/1801736374854295.jpg', '<p>details</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, '2024-06-13 03:08:25', '2024-06-24 03:47:18'),
(88, 11, 3, 5, NULL, NULL, 7, 'shishir science', 450, 10, 500, 50, 2835, 10, 315, 0, 315, 1, 'images/course/1802743902669775.jpg', '<p>gbdsg</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, 1, '2024-06-24 06:02:39', '2024-06-25 06:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `cv_achievements`
--

CREATE TABLE `cv_achievements` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_achievements`
--

INSERT INTO `cv_achievements` (`id`, `resume_id`, `name`, `details`, `link`, `created_at`, `updated_at`) VALUES
(2, 1, 'New Project', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', '#', '2024-06-08 21:44:54', '2024-06-08 21:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `cv_education`
--

CREATE TABLE `cv_education` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `institute` varchar(250) NOT NULL,
  `degree` varchar(150) NOT NULL,
  `study` varchar(100) NOT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_education`
--

INSERT INTO `cv_education` (`id`, `resume_id`, `institute`, `degree`, `study`, `grade`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Haragach M/L High School', 'SSC', 'Science', '5.00', '2009-01-01', '2015-12-31', '2024-06-05 21:50:26', '2024-06-05 22:20:37'),
(2, 1, 'Collectorate School & College, Rangpur', 'HSC', 'Science', '5.00', '2015-06-01', '2017-04-30', '2024-06-05 22:02:58', '2024-06-05 22:02:58'),
(4, 1, 'American International University-Bangladesh', 'BSc.', 'CSE', '3.75', '2018-05-20', '2022-12-20', '2024-06-05 23:54:08', '2024-06-08 22:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `cv_interests`
--

CREATE TABLE `cv_interests` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_interests`
--

INSERT INTO `cv_interests` (`id`, `resume_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Photography', '2024-06-06 00:05:07', '2024-06-06 00:05:07'),
(2, 1, 'Travelling', '2024-06-06 00:05:20', '2024-06-06 00:05:20'),
(3, 1, 'Bike Riding', '2024-06-06 00:05:30', '2024-06-06 00:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `cv_languages`
--

CREATE TABLE `cv_languages` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` tinytext NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_languages`
--

INSERT INTO `cv_languages` (`id`, `resume_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangla', '2024-06-06 06:46:56', '2024-06-06 00:46:56'),
(2, 1, 'English', '2024-06-06 06:47:53', '2024-06-06 00:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `cv_references`
--

CREATE TABLE `cv_references` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_references`
--

INSERT INTO `cv_references` (`id`, `resume_id`, `name`, `designation`, `phone`, `email`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tanveer Ahmed', 'Proffessor', NULL, 'tanvir@aiub.edu', NULL, '2024-06-08 23:22:33', '2024-06-08 23:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `cv_skills`
--

CREATE TABLE `cv_skills` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `details` varchar(250) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_skills`
--

INSERT INTO `cv_skills` (`id`, `resume_id`, `name`, `details`, `level`, `created_at`, `updated_at`) VALUES
(1, 1, 'C#', NULL, 70, '2024-06-05 22:55:17', '2024-06-06 03:47:42'),
(2, 1, 'HTML', NULL, 90, '2024-06-05 22:56:14', '2024-06-06 00:55:07'),
(3, 1, 'PHP', NULL, 75, '2024-06-05 22:56:27', '2024-06-06 00:55:35'),
(4, 1, 'Laravel', NULL, 88, '2024-06-05 22:56:40', '2024-06-06 00:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `cv_socials`
--

CREATE TABLE `cv_socials` (
  `id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `link` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cv_socials`
--

INSERT INTO `cv_socials` (`id`, `resume_id`, `name`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Facebook', 'fab fa-facebook-square', 'stephen@facebook', '2024-06-08 22:29:40', '2024-06-08 22:39:27'),
(2, 1, 'Twitter', 'fab fa-twitter-square', 'stephen@twitter', '2024-06-08 22:30:18', '2024-06-08 22:39:38'),
(3, 1, 'YouTube', 'fab fa-youtube', 'stephen@youtube', '2024-06-08 22:31:01', '2024-06-08 22:39:45'),
(4, 1, 'LinkedIn', 'fab fa-linkedin', 'stephen@linkedin', '2024-06-08 22:31:44', '2024-06-08 22:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `current_video` int(11) DEFAULT NULL,
  `module_completed` int(11) NOT NULL DEFAULT '1',
  `certification` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`id`, `student_id`, `course_id`, `current_video`, `module_completed`, `certification`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 13, NULL, 1, 0, 1, '2024-05-06 22:54:53', '2024-05-21 03:28:30'),
(2, 1, 79, 115, 2, 0, 1, '2024-05-06 22:54:53', '2024-06-23 03:27:24'),
(3, 1, 15, NULL, 1, 0, 1, '2024-05-06 23:07:30', '2024-05-06 23:07:30'),
(4, 1, 20, NULL, 1, 0, 1, '2024-05-06 23:12:27', '2024-05-06 23:12:27'),
(5, 1, 80, 119, 3, 1, 1, '2024-05-26 00:01:34', '2024-06-23 04:36:43'),
(6, 1, 84, NULL, 1, 0, 1, '2024-06-10 00:25:17', '2024-06-10 00:25:17'),
(7, 3, 80, NULL, 1, 0, 1, '2024-06-23 23:42:12', '2024-06-23 23:42:12'),
(8, 1, 88, NULL, 1, 0, 1, '2024-06-24 22:00:52', '2024-06-24 22:00:52'),
(9, 1, 88, NULL, 1, 0, 1, '2024-06-24 22:05:41', '2024-06-24 22:05:41'),
(10, 1, 88, NULL, 1, 0, 1, '2024-06-24 22:06:23', '2024-06-24 22:06:23'),
(11, 1, 88, NULL, 1, 0, 1, '2024-06-24 22:09:27', '2024-06-24 22:09:27'),
(12, 1, 88, NULL, 1, 0, 1, '2024-06-25 02:37:48', '2024-06-25 02:37:48'),
(13, 1, 88, NULL, 1, 0, 1, '2024-06-25 05:39:49', '2024-06-25 05:39:49'),
(14, 1, 88, NULL, 1, 0, 1, '2024-06-25 05:42:49', '2024-06-25 05:42:49'),
(15, 1, 88, NULL, 1, 0, 1, '2024-06-25 05:59:18', '2024-06-25 05:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `image` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `location` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `image`, `date`, `time`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ডিজিটাল ট্রান্সফর্ম কনফারেন্স', '<p><span style=\"color: rgb(83, 84, 91); font-family: Bangla, Arial, sans-serif; font-size: 20px;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে।</span><br></p>', 'images/events/1797568209890015.jpg', '2024-05-01', '12:00 am - 2:30 pm', 'নিউ ইয়ার্ক', 1, '2024-04-28 02:57:13', '2024-04-28 03:11:55'),
(2, 'আপনি কিভাবে একজন সফল ওয়েব ডেভেলপার হতে পারেন', '<p><div class=\"events__allow mb-40\" style=\"box-sizing: border-box; margin: 0px 0px 40px; padding: 0px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"></div></p><div class=\"events__details mb-35\" style=\"box-sizing: border-box; margin: 0px 0px 35px; padding: 0px; color: rgb(109, 110, 117); font-family: Bangla, Arial, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><p class=\"bn-normal\" style=\"box-sizing: border-box; margin: 0px 0px 15px; padding: 0px; transition: all 0.3s ease-out 0s; font-family: Bangla, Arial, sans-serif !important; font-size: 20px; font-weight: normal; color: rgb(83, 84, 91); line-height: 28px;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে।</p></div>', 'images/events/1797569206743091.jpg', '2024-05-02', '12:00 am - 2:30 pm', 'নিউ ইয়ার্ক', 1, '2024-04-28 03:13:04', '2024-04-28 03:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `timer` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `course_id`, `instructor_id`, `name`, `slug`, `timer`, `status`, `created_at`, `updated_at`) VALUES
(1, 80, 11, 'First test', 'first-test', '60', 1, '2024-04-29 02:17:00', '2024-04-29 02:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_banking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `email`, `bio`, `password`, `phone`, `mobile_banking`, `gender`, `dob`, `image`, `profession`, `institution`, `department`, `address`, `youtube_link`, `about`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Md Hafiz Al Foisal', 'quicktech.foisal@gmail.com', 'জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে।', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '01798032828', '0147896325', 'Male', '2022-11-01', 'frontend/img/teacher/teacher-1.jpg', 'Software Engineer', 'Quicktech IT', 'Web', 'Mirpur 10, Dhaka - 1216', 'Sent your demo class (Youtube video link)', '', 1, '2022-11-28 11:52:48', '2022-11-28 11:52:48'),
(2, 'inst 1', 'ins1@gmail.com', 'জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে। প্রমাণ হল আতিশয্যের পরাভব অনিবার্য। পরীক্ষায় এটাও স্থির হয়ে গেল যে, প্রশ্রয়ের পরিমাণ যত বেশি হয় দুর্বলতার বোঝাও তত দুর্বহ হয়ে ওঠে। নূতন পর্বে প্রকৃতি যথাসম্ভব মানুষের বরাদ্দ কম করে দিয়ে নিজে রইল নেপথ্যে।', '$2y$10$S7IpAKXSMNVmkBQ6SQ4YXuSXweh0nr013nOM6Kuy6.E/3cBw22jQi', '321654987', '3698745', 'Male', '2002-12-30', 'frontend/img/teacher/teacher-2.jpg', 'Teacher', 'School name', 'Math', 'address', 'link', '', 1, '2022-12-13 11:03:25', '2022-12-29 04:17:21'),
(3, 'Fsd', 'fsd.ramjan@gmail.com', NULL, '$2y$10$UUJPxdpDXY8JmH5uorBdg.Q/vEI4GSGYNuaPVmgJ/R1btBf.FLnfS', '01771282104', '01771282104', 'Male', '2002-12-30', 'frontend/img/teacher/teacher-3.jpg', 'Teacher', 'School name', 'Math', 'address', 'link', '', 1, '2022-12-19 03:15:32', '2023-01-18 00:50:37'),
(5, 'gg', 'ggggggg@gmail.com', NULL, '$2y$10$L1Yr6VUaUpOrvGiC5FVN.ugQ9XCDFCBB/psNBtG54yF3D4NBh57oW', '123456', '1', '1', '2023-01-05', 'frontend/img/teacher/teacher-4.jpg', 'gg', 'gg', 'gg', 'gg', 'gg', '', 1, '2023-01-04 23:37:18', '2023-01-04 23:37:18'),
(6, 'gggg', 'gggg@gmail.com', NULL, '$2y$10$3X1Gs0T8iFFh6OXyQ5ibSeojPy.cmJfNazODv8jGTTqgSGraAfGFS', '43434', '34324324', '1', '2023-01-05', 'frontend/img/teacher/teacher-5.jpg', 'gg', 'gg', 'ggg', 'ggg', 'ggg', '', 1, '2023-01-04 23:39:49', '2023-01-04 23:39:49'),
(7, 'ggg', 'gg', NULL, '$2y$10$LUkVT2saGWWI6KFRVRNScexxLzMUPtaKBf4R79I0nNd152wiTmZDm', '5435435', '545454', '1', '2023-01-05', 'frontend/img/teacher/teacher-6.jpg', '545f', 'fgfgg', 'gfgf', 'gg', 'gg', '', 1, '2023-01-04 23:40:54', '2023-01-04 23:40:54'),
(8, 'ggg', 'ggggg', NULL, '$2y$10$ZPY3pSQ1/9jk48xB0ZCuZ.rso7ph8kJXysCrx9DJH.7Uz/K33oYW.', '54', '54', '1', '2023-01-05', 'frontend/img/teacher/teacher-8.jpg', 'gfgfgf', 'gfgfgf', 'gffgfg', 'fgfg', 'gfgf', '', 1, '2023-01-04 23:41:19', '2023-01-04 23:41:19'),
(9, 'inst 1', 'ins111q@gmail.com', NULL, '$2y$10$ORCrODX.zH94fqQOsZOOoeiPi3PVoKlLL..rSKuQmua7V.igiMxiC', '32165498711', '3698745', 'Male', '2002-12-30', 'frontend/img/teacher/teacher-7.jpg', 'Teacher', 'School name', 'Math', 'address', 'link', NULL, 0, '2023-02-12 17:50:19', '2023-02-20 11:28:54'),
(10, 'inst 1', 'ashraf@gmail.com', NULL, '$2y$10$QiKVro.uyHrKGBFH8Z2xMe5kY/9Zs5APDRXkdM7ReG6AL2DFtEqL2', '01521411111', '3698745', 'Male', '2002-12-30', NULL, 'Teacher', 'School name', 'Math', 'address', 'link', NULL, 1, '2023-02-13 11:12:45', '2023-02-13 11:12:45'),
(11, 'Rana Bepari', 'dev@gmail.com', NULL, '$2y$10$54NkthtSHuZ7JuH5nUO12e5P4YjGEvPIcZLWLYHXc.Fd2MQYKGfPe', '01844590333', 'bKash', 'male', '2024-03-05', NULL, 'Developer', 'QuickTech IT', 'Web', 'Mirpur 10', '', 'This is Rana', 1, '2024-03-31 04:58:00', '2024-03-31 04:58:00'),
(14, 'Test', 'test2@gmail.com', NULL, '$2y$12$4oRak9Qx2K9Ss5QXMB6jZehfD.PV734eQxRbioKDOpfiy.muYRs7y', '01770900471', NULL, 'Male', '1997-12-01', 'images/instructor/1802740258190529.jpg', 'SE', 'test institute', 'CSE', 'Khilkhet, Dhaka', NULL, NULL, 1, '2024-06-24 04:42:51', '2024-06-24 05:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `module_id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'First lesson', NULL, NULL, 1, '2024-05-08 23:34:57', '2024-05-08 23:42:16'),
(2, 2, 'Second lesson', NULL, NULL, 1, '2024-05-08 23:36:36', '2024-05-08 23:36:36'),
(3, 3, 'First lesson', NULL, NULL, 1, '2024-05-08 23:44:08', '2024-05-08 23:44:08'),
(4, 3, 'Second lesson', NULL, NULL, 1, '2024-05-08 23:44:25', '2024-05-08 23:44:25'),
(6, 3, 'Third lesson', NULL, NULL, 1, '2024-05-08 23:45:34', '2024-05-08 23:45:34'),
(7, 3, 'Fourth lesson', NULL, NULL, 1, '2024-05-08 23:48:44', '2024-05-08 23:48:44'),
(8, 1, 'First lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(9, 1, 'Second lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(10, 1, 'Third lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(11, 1, 'Fourth lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(12, 1, 'Fifth lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(13, 1, 'Sixth lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(14, 1, 'Seventh lesson', NULL, NULL, 1, '2024-05-09 00:09:09', '2024-05-09 00:09:09'),
(15, 4, 'First lesson', NULL, NULL, 1, '2024-05-09 00:09:52', '2024-05-09 00:09:52'),
(16, 4, 'Second lesson', NULL, NULL, 1, '2024-05-09 00:09:52', '2024-05-09 00:09:52'),
(17, 4, 'Third lesson', NULL, NULL, 1, '2024-05-09 00:09:52', '2024-05-09 00:09:52'),
(18, 4, 'Fourth lesson', NULL, NULL, 1, '2024-05-09 00:09:52', '2024-05-09 00:09:52'),
(19, 4, 'fifth lesson', NULL, NULL, 1, '2024-05-09 00:09:52', '2024-05-09 00:09:52'),
(20, 4, 'Sixth lesson', NULL, NULL, 1, '2024-05-09 00:09:52', '2024-05-09 00:09:52'),
(21, 11, 'First Lesson', 'description', NULL, 1, '2024-05-26 00:53:03', '2024-05-26 02:17:46'),
(22, 11, 'Second lesson', 'description II', NULL, 1, '2024-05-26 02:16:36', '2024-05-26 02:16:36'),
(23, 11, 'Third lesson', 'description III', NULL, 1, '2024-05-26 02:17:20', '2024-05-26 02:17:20'),
(24, 12, 'First lesson', NULL, NULL, 1, '2024-06-23 04:35:39', '2024-06-23 04:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `liveclasses`
--

CREATE TABLE `liveclasses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `link` varchar(250) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liveclasses`
--

INSERT INTO `liveclasses` (`id`, `name`, `description`, `link`, `instructor_id`, `course_id`, `scheduled_at`, `duration`, `created_at`, `updated_at`) VALUES
(1, 'Class 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eos in\r\n                                    incidunt\r\n                                    laudantium ratione, sed veritatis?', '#', 2, 79, '2024-05-27 10:03:45', '2 Hours', '2024-05-26 04:05:57', '2024-05-26 00:10:05'),
(2, 'Class 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eos in\r\n                                    incidunt\r\n                                    laudantium ratione, sed veritatis?', '#', 2, 79, '2024-05-28 10:03:45', '2 Hours', '2024-05-26 04:05:57', '2024-05-26 00:10:25'),
(3, 'Live class 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eos in incidunt laudantium ratione, sed veritatis?', 'https://www.instagram.com/trendy_kraftz_/', 2, 79, '2024-05-30 01:54:00', '1 Hour', '2024-05-25 23:54:49', '2024-05-25 23:54:49'),
(4, 'Sudden Class', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eos in incidunt laudantium ratione, sed veritatis?', '#', 11, 80, '2024-05-26 17:00:00', '1 Hour', '2024-05-26 00:00:21', '2024-05-26 02:56:41'),
(5, 'New Class', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eos in\r\n                                    incidunt\r\n                                    laudantium ratione, sed veritatis?', '#', 11, 80, '2024-05-30 14:57:00', NULL, '2024-05-26 02:58:14', '2024-05-26 02:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `mcq`
--

CREATE TABLE `mcq` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `childcategory_id` int(11) NOT NULL,
  `childsubcategory_id` int(11) NOT NULL,
  `syllabus` varchar(255) NOT NULL,
  `enrolled` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_price` int(11) NOT NULL,
  `thumbnil_image` varchar(255) DEFAULT NULL,
  `details` text NOT NULL,
  `details_file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated-at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mcq_options`
--

CREATE TABLE `mcq_options` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `mcq_ques_id` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `isAnswer` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_options`
--

INSERT INTO `mcq_options` (`id`, `quiz_id`, `mcq_ques_id`, `option`, `isAnswer`, `created_at`, `updated_at`) VALUES
(5, 66, 4, 'Option 1', 0, '2024-05-15 03:58:02', '2024-05-15 05:00:24'),
(6, 66, 4, 'Option 2', 0, '2024-05-15 03:58:02', '2024-05-15 05:00:24'),
(7, 66, 4, 'Option 3', 1, '2024-05-15 03:58:02', '2024-05-15 05:00:24'),
(8, 66, 4, 'Option 4', 0, '2024-05-15 03:58:02', '2024-05-15 05:00:24'),
(9, 66, 5, 'SpiderMan 1', 0, '2024-05-15 04:07:56', '2024-05-15 05:01:16'),
(10, 66, 5, 'SpiderMan 2', 0, '2024-05-15 04:07:56', '2024-05-15 05:01:16'),
(11, 66, 5, 'Spiderman far from Home', 1, '2024-05-15 04:07:56', '2024-05-15 05:01:16'),
(12, 66, 5, 'Spiderman Homecoming', 0, '2024-05-15 04:07:56', '2024-05-15 05:01:16'),
(13, 67, 6, 'Option 1', 0, '2024-05-26 08:27:47', '2024-05-26 08:29:04'),
(14, 67, 6, 'Option 2', 1, '2024-05-26 08:27:47', '2024-05-26 08:29:04'),
(15, 67, 6, 'Option 3', 0, '2024-05-26 08:27:47', '2024-05-26 08:29:04'),
(16, 67, 6, 'Option 4', 0, '2024-05-26 08:27:47', '2024-05-26 08:29:04'),
(17, 66, 7, 'First option', 0, '2024-05-27 08:41:40', '2024-05-27 08:41:40'),
(18, 66, 7, 'Second option', 0, '2024-05-27 08:41:40', '2024-05-27 08:41:40'),
(19, 66, 7, 'Third option', 0, '2024-05-27 08:41:40', '2024-05-27 08:41:40'),
(20, 66, 7, 'Last option', 1, '2024-05-27 08:41:40', '2024-05-27 08:41:40'),
(21, 68, 8, 'Option 1', 1, '2024-06-23 10:36:28', '2024-06-23 10:36:28'),
(22, 68, 8, 'Option 2', 0, '2024-06-23 10:36:28', '2024-06-23 10:36:28'),
(23, 68, 8, 'Option 3', 0, '2024-06-23 10:36:28', '2024-06-23 10:36:28'),
(24, 68, 8, 'Option 4', 0, '2024-06-23 10:36:28', '2024-06-23 10:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_questions`
--

CREATE TABLE `mcq_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_questions`
--

INSERT INTO `mcq_questions` (`id`, `quiz_id`, `question`, `image`, `answer`, `created_at`, `updated_at`) VALUES
(4, 66, 'This is new question??', NULL, 3, '2024-05-15 03:58:02', '2024-05-15 05:00:24'),
(5, 66, 'What Spiderman do you like??', 'images/questions/1799090157163514.jpg', 3, '2024-05-15 04:07:55', '2024-05-15 05:01:16'),
(6, 67, 'This is new question??', NULL, 2, '2024-05-26 08:27:46', '2024-05-26 08:29:04'),
(7, 66, 'New Question', NULL, 4, '2024-05-27 08:41:40', '2024-05-27 08:41:40'),
(8, 68, 'This is new question??', NULL, 1, '2024-06-23 10:36:28', '2024-06-23 10:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_10_091106_create_roles_table', 1),
(6, '2022_11_10_091341_create_admins_table', 1),
(7, '2022_11_10_093938_create_company_infos_table', 1),
(8, '2022_11_10_094117_create_pages_table', 1),
(9, '2022_11_13_092427_create_categories_table', 1),
(10, '2022_11_13_092941_create_subcategories_table', 1),
(11, '2022_11_13_093222_create_childcategories_table', 1),
(12, '2022_11_13_093629_create_childsubcategories_table', 1),
(13, '2022_11_28_162459_create_instructors_table', 2),
(14, '2022_12_04_162515_create_courses_table', 3),
(15, '2022_12_04_162605_create_quizzes_table', 3),
(16, '2022_12_04_162606_create_quiz_options_table', 3),
(17, '2022_12_04_162624_create_writtens_table', 3),
(18, '2022_12_04_163626_create_videos_table', 3),
(19, '2022_12_04_163652_create_authors_table', 3),
(20, '2022_12_13_172833_create_affiliates_table', 4),
(21, '2014_10_12_000000_create_users_table', 5),
(24, '2022_12_16_140325_create_orders_table', 6),
(25, '2022_12_16_140351_create_order_details_table', 6),
(26, '2022_12_16_153747_create_coupons_table', 7),
(27, '2022_12_16_155046_create_wishlists_table', 8),
(28, '2023_01_21_201318_create_rating_reviews_table', 9),
(29, '2023_01_25_191427_create_share_links_table', 10),
(30, '2023_01_25_201703_create_affiliate_click_counts_table', 11),
(31, '2014_10_12_100000_create_password_reset_tokens_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,\r\n0=inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `course_id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 79, 'Module 1', 'description', NULL, 1, '2024-05-08 22:21:24', '2024-05-08 23:00:56'),
(3, 79, 'Module 3', NULL, NULL, 1, '2024-05-08 22:24:07', '2024-05-08 22:24:07'),
(4, 79, 'Module 4', NULL, NULL, 1, '2024-05-08 22:24:07', '2024-05-08 22:24:07'),
(6, 79, 'Module 5', NULL, NULL, 1, '2024-05-09 00:08:05', '2024-05-09 00:08:05'),
(7, 79, 'Module 6', NULL, NULL, 1, '2024-05-09 00:08:25', '2024-05-09 00:08:25'),
(8, 79, 'Module 7', NULL, NULL, 1, '2024-05-09 00:08:25', '2024-05-09 00:08:25'),
(9, 79, 'Module 8', NULL, NULL, 1, '2024-05-09 00:08:25', '2024-05-09 00:08:25'),
(10, 79, 'Module 9', NULL, NULL, 1, '2024-05-09 00:08:25', '2024-05-09 00:08:25'),
(11, 80, 'First lesson', 'description', NULL, 1, '2024-05-26 00:39:58', '2024-05-26 00:39:58'),
(12, 80, 'Second lesson', 'description II', NULL, 1, '2024-05-26 00:39:58', '2024-05-26 00:39:58'),
(13, 80, 'Third lesson', 'description III', NULL, 1, '2024-05-26 00:40:31', '2024-05-26 00:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `total` bigint(20) UNSIGNED NOT NULL,
  `discount` bigint(20) UNSIGNED DEFAULT '0',
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `student_id`, `total`, `discount`, `coupon_code`, `subtotal`, `note`, `payment_method`, `created_at`, `updated_at`) VALUES
(43, 1, 90, 10, '0', 100, NULL, 'Bkash', '2023-02-16 11:42:09', '2023-02-16 11:42:09'),
(44, 1, 1100, 1100, 'ALIF50', 2200, NULL, NULL, '2024-05-06 22:54:53', '2024-05-06 22:54:53'),
(45, 1, 100, 1100, 'ALIF50', 1200, NULL, NULL, '2024-05-06 23:07:30', '2024-05-06 23:07:30'),
(46, 1, 5656, NULL, NULL, 5656, NULL, NULL, '2024-05-06 23:12:27', '2024-05-06 23:12:27'),
(47, 1, 1000, NULL, NULL, 1000, NULL, NULL, '2024-05-26 00:01:33', '2024-05-26 00:01:33'),
(48, 1, 25000, NULL, NULL, 25000, NULL, NULL, '2024-06-10 00:25:17', '2024-06-10 00:25:17'),
(51, 3, 1000, NULL, NULL, 1000, NULL, NULL, '2024-06-23 23:42:12', '2024-06-23 23:42:12'),
(52, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-24 22:00:52', '2024-06-24 22:00:52'),
(53, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-24 22:05:41', '2024-06-24 22:05:41'),
(54, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-24 22:06:23', '2024-06-24 22:06:23'),
(55, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-24 22:09:27', '2024-06-24 22:09:27'),
(56, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-25 02:37:48', '2024-06-25 02:37:48'),
(57, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-25 05:39:49', '2024-06-25 05:39:49'),
(58, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-25 05:42:49', '2024-06-25 05:42:49'),
(59, 1, 450, NULL, NULL, 450, NULL, NULL, '2024-06-25 05:59:18', '2024-06-25 05:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `affiliate_percentage` int(10) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `affiliate_id`, `affiliate_percentage`, `course_id`, `price`, `created_at`, `updated_at`) VALUES
(21, 43, NULL, NULL, 78, 100, '2023-02-16 11:42:09', '2023-02-16 11:42:09'),
(22, 44, NULL, NULL, 13, 1200, '2024-05-06 22:54:53', '2024-05-06 22:54:53'),
(23, 44, NULL, NULL, 79, 1000, '2024-05-06 22:54:53', '2024-05-06 22:54:53'),
(24, 45, NULL, NULL, 15, 1200, '2024-05-06 23:07:30', '2024-05-06 23:07:30'),
(25, 46, NULL, NULL, 20, 5656, '2024-05-06 23:12:27', '2024-05-06 23:12:27'),
(26, 47, NULL, NULL, 80, 1000, '2024-05-26 00:01:34', '2024-05-26 00:01:34'),
(27, 48, NULL, NULL, 84, 25000, '2024-06-10 00:25:17', '2024-06-10 00:25:17'),
(28, 51, NULL, NULL, 80, 1000, '2024-06-23 23:42:12', '2024-06-23 23:42:12'),
(29, 52, NULL, NULL, 88, 450, '2024-06-24 22:00:52', '2024-06-24 22:00:52'),
(30, 53, NULL, NULL, 88, 450, '2024-06-24 22:05:41', '2024-06-24 22:05:41'),
(31, 54, NULL, NULL, 88, 450, '2024-06-24 22:06:23', '2024-06-24 22:06:23'),
(32, 55, NULL, NULL, 88, 450, '2024-06-24 22:09:27', '2024-06-24 22:09:27'),
(33, 56, NULL, NULL, 88, 450, '2024-06-25 02:37:48', '2024-06-25 02:37:48'),
(34, 57, NULL, NULL, 88, 450, '2024-06-25 05:39:49', '2024-06-25 05:39:49'),
(35, 58, NULL, NULL, 88, 450, '2024-06-25 05:42:49', '2024-06-25 05:42:49'),
(36, 59, NULL, NULL, 88, 450, '2024-06-25 05:59:18', '2024-06-25 05:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(44, 'App\\Models\\User', 1, 'userAuthToken', '99aa91ca616fa7543530d97496a5a4ac72249c1b9942a36f8e05bc6f5e0911cf', '[\"*\"]', '2023-01-04 23:51:13', NULL, '2022-12-19 03:58:38', '2023-01-04 23:51:13'),
(45, 'App\\Models\\Instructor', 2, 'authToken', '2e0ad71a339f9b2f5d0f62fa78ebd7dd2e8a3ef3d21f9a0a5fd7f6d01d5d7b39', '[\"*\"]', '2022-12-20 01:09:32', NULL, '2022-12-19 04:13:27', '2022-12-20 01:09:32'),
(47, 'App\\Models\\User', 1, 'userAuthToken', '07ec2638ea7d5bababb35f84b79e2faf2df507c8711b14f1cc606729014d0458', '[\"*\"]', NULL, NULL, '2022-12-19 21:20:05', '2022-12-19 21:20:05'),
(50, 'App\\Models\\User', 1, 'userAuthToken', '991b3e0ab44bbe55d81473df1c8459f9c95a3b137a539455b9c38863decb0852', '[\"*\"]', '2022-12-20 04:23:54', NULL, '2022-12-20 04:23:28', '2022-12-20 04:23:54'),
(51, 'App\\Models\\User', 1, 'userAuthToken', '14a499e99ecb73b00c7ce6b20b28f6321cdac78f39df2ec49810f8e7587c4a46', '[\"*\"]', NULL, NULL, '2022-12-21 22:20:13', '2022-12-21 22:20:13'),
(52, 'App\\Models\\Instructor', 2, 'authToken', 'e85521f2523be4cee6c5966a11cc59623487b4b3829a04daac1e065e3b9b0729', '[\"*\"]', NULL, NULL, '2022-12-21 23:46:31', '2022-12-21 23:46:31'),
(54, 'App\\Models\\Instructor', 2, 'authToken', 'b5f94dd1074a18da2e60e0e3fbb2f5c91ef088baa2a5d784d6145d52aa0ccaf5', '[\"*\"]', '2022-12-26 05:15:38', NULL, '2022-12-25 21:13:47', '2022-12-26 05:15:38'),
(55, 'App\\Models\\Instructor', 2, 'authToken', '2883f1abd50694ca9a2fb6fba0b50d9f5e49852a0de47f43d1937c8dba3c3656', '[\"*\"]', '2022-12-29 05:56:38', NULL, '2022-12-25 21:41:45', '2022-12-29 05:56:38'),
(59, 'App\\Models\\User', 1, 'userAuthToken', 'e86ce9fad59fa2f30c6074ad0d298d48405606e279cd68c6b34b032af86db7b2', '[\"*\"]', '2023-01-04 23:18:04', NULL, '2023-01-04 04:31:23', '2023-01-04 23:18:04'),
(60, 'App\\Models\\User', 2, 'userAuthToken', '317a653dbcf9a92fd99041bcf2e9a1a2eb65ec584ab0c71b8729ded639466f5c', '[\"*\"]', '2023-01-15 00:17:17', NULL, '2023-01-04 23:49:50', '2023-01-15 00:17:17'),
(62, 'App\\Models\\User', 1, 'userAuthToken', 'a445a518f94efd054c4e673188a55e761c19f157d33fdaa8ce1d0dc7bee9e6a8', '[\"*\"]', '2023-01-15 05:43:41', NULL, '2023-01-15 03:22:43', '2023-01-15 05:43:41'),
(64, 'App\\Models\\User', 1, 'userAuthToken', 'afdb47ceaeca5ac185dda6dfd7e0d7c50ba7df2fc215cab518dc58e4536c795a', '[\"*\"]', '2023-01-16 03:38:54', NULL, '2023-01-15 06:00:43', '2023-01-16 03:38:54'),
(68, 'App\\Models\\User', 1, 'userAuthToken', '10b68a4b401b69766a039ec1d8763e6e59ed2b5ffdcab58564c5f06e38273912', '[\"*\"]', '2023-01-18 00:27:29', NULL, '2023-01-18 00:27:26', '2023-01-18 00:27:29'),
(79, 'App\\Models\\Instructor', 1, 'authToken', 'befe2bdf4131f65138006a4499751e9eabd1d598eef8137dd530019298b7b5b7', '[\"*\"]', '2023-01-22 09:58:35', NULL, '2023-01-22 09:18:47', '2023-01-22 09:58:35'),
(83, 'App\\Models\\User', 1, 'userAuthToken', '2cf54ea81b4a4aa7e8b39cf5480dacee9bde350dc91eef0d2618ec75790ad7e7', '[\"*\"]', '2023-01-25 13:53:30', NULL, '2023-01-25 13:52:03', '2023-01-25 13:53:30'),
(84, 'App\\Models\\User', 1, 'userAuthToken', '074846458f85b68c3a9b23b6c02b08b3b462b6a01da4c9da1914783e8d8cc368', '[\"*\"]', '2023-01-25 13:55:05', NULL, '2023-01-25 13:54:47', '2023-01-25 13:55:05'),
(85, 'App\\Models\\Affiliate', 4, 'affAuthToken', '96706f9e4183ecefc3aa0e7955cd333491a5c0bfa6f6d64091922c9df9566d00', '[\"*\"]', '2023-01-25 14:42:09', NULL, '2023-01-25 14:41:15', '2023-01-25 14:42:09'),
(86, 'App\\Models\\User', 1, 'userAuthToken', '36185a0dd1c738b43f13bd4c805febcf2b82c7ab2be646ce0a68a78fd692c312', '[\"*\"]', '2023-02-16 11:09:58', NULL, '2023-02-05 12:42:37', '2023-02-16 11:09:58'),
(90, 'App\\Models\\User', 1, 'userAuthToken', '41289785c21b5f0837df3dc36a0f92b88b78b4740ddddf177f684acd25f3e7f4', '[\"*\"]', '2023-02-08 13:38:11', NULL, '2023-02-08 12:12:30', '2023-02-08 13:38:11'),
(91, 'App\\Models\\Instructor', 9, 'authToken', '4f726850c377f85b0a1e57324788bab17ac7e4325a284c99168cbb7724828e77', '[\"*\"]', '2023-02-26 13:09:27', NULL, '2023-02-12 17:52:23', '2023-02-26 13:09:27'),
(94, 'App\\Models\\User', 1, 'userAuthToken', 'cf358cc806c384acbe356de2f5916131bd58599ebeb33b2c0340ccb8b4f3efc5', '[\"*\"]', '2023-02-18 18:16:16', NULL, '2023-02-13 13:08:16', '2023-02-18 18:16:16'),
(95, 'App\\Models\\User', 1, 'userAuthToken', 'e71ae517e2950b9016c155d2bc378c8b247036c368a75e271e73dc8157224e5e', '[\"*\"]', NULL, NULL, '2023-02-13 16:10:40', '2023-02-13 16:10:40'),
(100, 'App\\Models\\Affiliate', 1, 'affAuthToken', '17a06272790b15773fd49191ba5526ec3bebf9c6ff01f1ff4bb87f1826dcc205', '[\"*\"]', NULL, NULL, '2023-02-13 17:41:29', '2023-02-13 17:41:29'),
(105, 'App\\Models\\User', 1, 'userAuthToken', '828c160388b6af9ea6e06122da76422f0d7158b0b7e93e466966c3f86b7f03c9', '[\"*\"]', NULL, NULL, '2023-02-13 18:51:00', '2023-02-13 18:51:00'),
(106, 'App\\Models\\User', 1, 'userAuthToken', '40f47614badb88c100962777f2beffb08377a5b3cc891c5964168a68b708a736', '[\"*\"]', '2023-02-14 12:02:28', NULL, '2023-02-14 11:56:00', '2023-02-14 12:02:28'),
(107, 'App\\Models\\User', 1, 'userAuthToken', 'dca229b8aec14d053d522f652a3837afb4ce0739423c7018917aab7105dade4c', '[\"*\"]', '2023-02-14 11:59:36', NULL, '2023-02-14 11:59:34', '2023-02-14 11:59:36'),
(108, 'App\\Models\\User', 1, 'userAuthToken', 'dca59ebcc71719e1c70bd0365bef1fa76409b9684473700d086a5d40708efd55', '[\"*\"]', '2023-02-16 10:44:54', NULL, '2023-02-14 12:00:17', '2023-02-16 10:44:54'),
(110, 'App\\Models\\User', 1, 'userAuthToken', 'ad4e8c7d58a8cca148f4f06fddfda5e8d1276d85c5e05ac5c69e4f721a97a7a2', '[\"*\"]', '2023-02-14 17:47:41', NULL, '2023-02-14 15:59:56', '2023-02-14 17:47:41'),
(111, 'App\\Models\\User', 1, 'userAuthToken', '0e23f1762bf60578d81238db2f967bcd05a164ca8b3d01552970087324024b8a', '[\"*\"]', '2023-02-16 11:16:28', NULL, '2023-02-14 16:24:44', '2023-02-16 11:16:28'),
(114, 'App\\Models\\Instructor', 3, 'authToken', 'da2e5fa982db2fd333c1fd6850ebd4736950bb98273a3856f7698a72cfcefc4c', '[\"*\"]', '2023-02-14 18:58:58', NULL, '2023-02-14 18:55:31', '2023-02-14 18:58:58'),
(121, 'App\\Models\\User', 1, 'userAuthToken', '28b2ed1c7ae687ef04a3068eca7a3b7c9e70981b2d4682877f183b739e9f1a33', '[\"*\"]', '2023-02-15 16:57:04', NULL, '2023-02-15 11:40:24', '2023-02-15 16:57:04'),
(125, 'App\\Models\\User', 1, 'userAuthToken', 'fbb66a8bc6d4c1edb7381b864a9550f489a39c1a047b3cb2ba492d3622fbd888', '[\"*\"]', NULL, NULL, '2023-02-15 14:03:52', '2023-02-15 14:03:52'),
(127, 'App\\Models\\User', 1, 'userAuthToken', '3f3780e8c8dcebf98e8b0b75da4031f14cf3305db2251e3d1435d2e80ce77d1c', '[\"*\"]', NULL, NULL, '2023-02-15 14:05:55', '2023-02-15 14:05:55'),
(128, 'App\\Models\\User', 1, 'userAuthToken', '81860542abda3c7a69a35013750a6f031884ecd44d2ec6e1a0132253a24df680', '[\"*\"]', NULL, NULL, '2023-02-15 14:06:03', '2023-02-15 14:06:03'),
(131, 'App\\Models\\Affiliate', 7, 'affAuthToken', '023ca3eb6acf79546ffc71fcf62bf1b5ccc49430f1f61ddb1a7e214606e215dc', '[\"*\"]', NULL, NULL, '2023-02-15 14:06:16', '2023-02-15 14:06:16'),
(132, 'App\\Models\\User', 1, 'userAuthToken', '812ec2052db2e489e0faf53bddee4a695a62a608d01cdfbab498021dbc21b8f7', '[\"*\"]', NULL, NULL, '2023-02-15 16:21:55', '2023-02-15 16:21:55'),
(133, 'App\\Models\\User', 1, 'userAuthToken', '909a9e5a4f9bce74a62c404217a5c1ff3344cb6670fcd6f161cc095cda275e4c', '[\"*\"]', NULL, NULL, '2023-02-15 16:22:01', '2023-02-15 16:22:01'),
(134, 'App\\Models\\User', 1, 'userAuthToken', '7f4c447381a9b5e64c97c8e08b2af16e299231c7b74593308339bfa358189f2a', '[\"*\"]', NULL, NULL, '2023-02-15 16:22:06', '2023-02-15 16:22:06'),
(135, 'App\\Models\\User', 1, 'userAuthToken', '344b2e7d3203692ad91faa2856ce6ea0b4c066f44092beb39ff793b75a29f78b', '[\"*\"]', '2023-02-16 14:06:35', NULL, '2023-02-15 16:22:41', '2023-02-16 14:06:35'),
(138, 'App\\Models\\User', 1, 'userAuthToken', '6618722083e75ce0917b8be1158b0ca75d1fcb66311246fde915b3f0feb52f22', '[\"*\"]', '2023-02-16 11:19:42', NULL, '2023-02-16 11:14:30', '2023-02-16 11:19:42'),
(140, 'App\\Models\\User', 1, 'userAuthToken', '01964e45cd4300cd0ff97761854920c730c11968fedb34f2e7fc47ae1874bfe0', '[\"*\"]', '2023-02-16 14:06:54', NULL, '2023-02-16 14:03:54', '2023-02-16 14:06:54'),
(141, 'App\\Models\\User', 1, 'userAuthToken', 'e6f6cf100bc10ee448137e8f4b9d0a16a67f8d068b4537da1ec72e6005e75978', '[\"*\"]', '2023-02-19 11:16:10', NULL, '2023-02-16 14:07:57', '2023-02-19 11:16:10'),
(143, 'App\\Models\\User', 1, 'userAuthToken', 'e7e8ad7df3e091f14ac1c4f8edfc0536e0910f550701bcc196c0ba26fc3df633', '[\"*\"]', '2023-02-19 18:40:08', NULL, '2023-02-19 11:44:35', '2023-02-19 18:40:08'),
(144, 'App\\Models\\User', 1, 'userAuthToken', 'b4b71b0fd22aaccbd0180e11d1233e56036e8880fd16300e9129540365217be2', '[\"*\"]', '2023-02-23 17:51:47', NULL, '2023-02-20 10:44:01', '2023-02-23 17:51:47'),
(152, 'App\\Models\\Instructor', 10, 'authToken', '889b666d80a8099d0d53649e74580271e715022e8c951ee8b1102687f3ebb24c', '[\"*\"]', '2023-02-26 19:11:40', NULL, '2023-02-25 12:13:45', '2023-02-26 19:11:40'),
(153, 'App\\Models\\User', 32, 'userAuthToken', '289588be4110c9222c76140d181b1139d1076cc597b6e367fa28de5b83ed23c6', '[\"*\"]', '2023-03-16 22:38:39', NULL, '2023-03-07 17:11:01', '2023-03-16 22:38:39'),
(154, 'App\\Models\\User', 32, 'userAuthToken', '155371d169637df3d2a5b6e00b5296518514dce783c08c51f312b3c5904134b3', '[\"*\"]', '2023-04-08 12:02:16', NULL, '2023-04-08 11:58:11', '2023-04-08 12:02:16'),
(155, 'App\\Models\\User', 32, 'userAuthToken', '66e0fbd43c1d99b4f5b2740584960a0520155bc897fc8da00760e235c9a97828', '[\"*\"]', '2023-04-08 12:04:47', NULL, '2023-04-08 12:04:45', '2023-04-08 12:04:47'),
(156, 'App\\Models\\User', 34, 'userAuthToken', '4bc91c5456cf810fb0f64dd31245a816f8f9c40b45c1e9c8a5f1b0425aecfd8c', '[\"*\"]', '2023-05-06 16:36:50', NULL, '2023-05-06 14:05:17', '2023-05-06 16:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `user_id`, `course_id`, `video_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 1, 2, NULL, NULL),
(3, 1, 1, 3, '2023-02-14 09:14:16', '2023-02-14 09:14:16'),
(4, 1, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 1, 1, NULL, NULL),
(7, 1, 1, 4, '2023-02-14 09:17:23', '2023-02-14 09:17:23'),
(9, 1, 1, 5, '2023-02-14 09:18:10', '2023-02-14 09:18:10'),
(10, 1, 64, 1, '2023-02-14 09:59:47', '2023-02-14 09:59:47'),
(11, 1, 64, 2, '2023-02-14 10:21:53', '2023-02-14 10:21:53'),
(12, 1, 64, 3, '2023-02-14 10:22:09', '2023-02-14 10:22:09'),
(17, 1, 64, 4, '2023-02-14 10:37:26', '2023-02-14 10:37:26'),
(19, 1, 64, 5, '2023-02-14 10:38:02', '2023-02-14 10:38:02'),
(21, 1, 64, 6, '2023-02-14 10:55:46', '2023-02-14 10:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `promovideos`
--

CREATE TABLE `promovideos` (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 NOT NULL,
  `video` text CHARACTER SET utf8 NOT NULL,
  `link` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promovideos`
--

INSERT INTO `promovideos` (`id`, `title`, `description`, `video`, `link`, `status`, `created_at`, `updated_at`) VALUES
(6, 'অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।', '<p>অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।<br></p>', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/TZA43F-vTe8?si=trhmhZwqMKg4otyD\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '#', 1, '2024-06-12 03:51:01', '2024-06-12 04:05:22'),
(7, 'অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।', '<p>অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।<br></p>', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/TZA43F-vTe8?si=trhmhZwqMKg4otyD\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '#', 1, '2024-06-12 03:51:02', '2024-06-12 04:05:16'),
(8, 'অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।', '<p>অনলাইন ব্যাচের লাইব্রেরীতে থাকছে সব বিষয়ের অধ্যায়-ভিত্তিক প্রশ্ন অনুশীলনের সুযোগ।<br></p>', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/TZA43F-vTe8?si=trhmhZwqMKg4otyD\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '#', 1, '2024-06-12 03:58:26', '2024-06-12 04:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `quizsubmits`
--

CREATE TABLE `quizsubmits` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `totalquestion` int(11) NOT NULL,
  `rightanswer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizsubmits`
--

INSERT INTO `quizsubmits` (`id`, `student_id`, `quiz_id`, `totalquestion`, `rightanswer`, `created_at`, `updated_at`) VALUES
(72, 1, 66, 3, 1, '2024-06-23 03:27:24', '2024-06-23 03:27:24'),
(73, 1, 67, 1, 0, '2024-06-23 04:34:14', '2024-06-23 04:34:14'),
(74, 1, 68, 1, 1, '2024-06-23 04:36:43', '2024-06-23 04:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `quizsubmit_answers`
--

CREATE TABLE `quizsubmit_answers` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `right_option` int(11) NOT NULL,
  `isRight` tinyint(1) NOT NULL,
  `submit_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizsubmit_answers`
--

INSERT INTO `quizsubmit_answers` (`id`, `student_id`, `quiz_id`, `question_id`, `option_id`, `right_option`, `isRight`, `submit_id`, `created_at`, `updated_at`) VALUES
(194, 1, 66, 4, 7, 7, 1, 72, '2024-06-23 03:27:24', '2024-06-23 03:27:24'),
(195, 1, 66, 7, 19, 20, 0, 72, '2024-06-23 03:27:24', '2024-06-23 03:27:24'),
(196, 1, 67, 6, 15, 14, 0, 73, '2024-06-23 04:34:14', '2024-06-23 04:34:14'),
(197, 1, 68, 8, 21, 21, 1, 74, '2024-06-23 04:36:43', '2024-06-23 04:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timer` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  `points` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `lesson_id`, `name`, `slug`, `timer`, `answered`, `points`, `created_at`, `updated_at`) VALUES
(1, 4, 'First Quiz', NULL, NULL, 0, 1, '2022-12-10 03:11:34', '2022-12-10 03:11:34'),
(2, 4, 'First Quiz', NULL, NULL, 0, 1, '2022-12-10 03:12:51', '2022-12-10 03:12:51'),
(3, 4, 'First Quiz', NULL, NULL, 0, 1, '2022-12-10 03:13:09', '2022-12-10 03:13:09'),
(4, 4, 'First Quiz', NULL, NULL, 0, 1, '2022-12-10 03:13:38', '2022-12-10 03:13:38'),
(5, 4, 'First Quiz', NULL, NULL, 0, 1, '2022-12-10 03:14:41', '2022-12-10 03:14:41'),
(6, 5, 'Q5155', NULL, NULL, 0, 2, '2022-12-14 12:24:47', '2022-12-15 12:51:09'),
(7, 5, 'Q51', NULL, NULL, 0, 1, '2022-12-19 03:18:21', '2022-12-19 03:18:21'),
(8, 5, 'Q51', NULL, NULL, 0, 1, '2022-12-30 21:43:14', '2022-12-30 21:43:14'),
(9, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2022-12-30 21:43:23', '2023-01-17 23:06:59'),
(10, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2022-12-30 21:43:27', '2023-01-18 21:32:58'),
(11, 27, 'Q51', NULL, NULL, 0, 1, '2023-01-16 23:25:08', '2023-01-16 23:25:08'),
(12, 0, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 03:53:26', '2023-01-17 03:53:26'),
(13, 17, 'Lorem 1', NULL, NULL, 0, 1, '2023-01-17 03:59:56', '2023-02-08 11:47:35'),
(14, 17, 'Lorem 1', NULL, NULL, 0, 1, '2023-01-17 04:00:56', '2023-02-08 11:47:31'),
(15, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:01:39', '2023-01-17 04:01:39'),
(16, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:02:29', '2023-01-17 04:02:29'),
(17, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:02:36', '2023-01-17 04:02:36'),
(18, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:09:30', '2023-01-17 04:09:30'),
(19, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:13:46', '2023-01-17 04:13:46'),
(20, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:36:29', '2023-01-17 04:36:29'),
(21, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:50:34', '2023-01-17 04:50:34'),
(22, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 04:55:57', '2023-01-17 04:55:57'),
(23, 17, 'Q5155', NULL, NULL, 0, 2, '2023-01-17 04:58:52', '2023-01-17 06:00:12'),
(24, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 05:03:39', '2023-01-17 05:03:39'),
(26, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 05:41:53', '2023-01-17 05:41:53'),
(27, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 05:59:05', '2023-01-17 05:59:05'),
(28, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 21:49:44', '2023-01-17 21:49:44'),
(29, 17, 'ABCD', NULL, NULL, 0, 1, '2023-01-17 21:53:34', '2023-01-17 21:53:34'),
(30, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-01-17 21:54:16', '2023-01-17 21:54:16'),
(31, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-01-17 22:25:19', '2023-01-17 22:25:19'),
(32, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-01-17 22:25:27', '2023-01-17 22:25:27'),
(33, 29, 'gg', NULL, NULL, 0, 1, '2023-01-18 22:20:45', '2023-01-18 22:20:45'),
(34, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-02-08 11:21:59', '2023-02-08 11:21:59'),
(35, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-02-08 11:22:06', '2023-02-08 11:22:06'),
(36, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-02-08 11:22:11', '2023-02-08 11:22:11'),
(37, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-02-08 11:22:18', '2023-02-08 11:22:18'),
(38, 17, 'vn vnv nvn vn 1113', NULL, NULL, 0, 1, '2023-02-08 11:22:49', '2023-02-08 11:22:49'),
(39, 17, 'g', NULL, NULL, 0, 1, '2023-02-08 11:46:54', '2023-02-08 11:46:54'),
(40, 17, 'gg', NULL, NULL, 0, 1, '2023-02-08 11:50:18', '2023-02-08 11:50:18'),
(41, 17, 'gg', NULL, NULL, 0, 1, '2023-02-08 11:50:44', '2023-02-08 11:50:44'),
(42, 5, 'Q51', NULL, NULL, 0, 1, '2023-02-13 16:31:39', '2023-02-13 16:31:39'),
(52, 78, 'Flutter', 'Dart', 'C', 0, 1, '2023-02-20 11:29:44', '2023-02-26 19:11:40'),
(58, 78, 'Flutter ?', 'AA', 'A', 0, 1, '2023-02-26 18:28:58', '2023-02-26 18:35:44'),
(59, 78, 'What is Flutter?', 'AAA', 'B', 0, 1, '2023-02-26 18:37:47', '2023-02-26 18:37:47'),
(61, NULL, 'First quiz', NULL, NULL, 0, 1, '2024-04-29 03:00:34', '2024-04-29 03:00:34'),
(62, NULL, 'First quiz', NULL, NULL, 0, 1, '2024-04-29 03:02:23', '2024-04-29 03:02:23'),
(63, NULL, 'Second quiz', NULL, NULL, 0, 1, '2024-04-29 03:24:24', '2024-04-29 03:24:24'),
(64, NULL, 'Another quiz', NULL, NULL, 0, 1, '2024-04-29 03:37:19', '2024-04-29 03:37:19'),
(66, 8, 'Quiz', NULL, '60', 0, 1, '2024-05-14 02:49:54', '2024-05-14 02:49:54'),
(67, 21, 'First quiz', NULL, '2 hour', 0, 1, '2024-05-26 02:25:46', '2024-05-26 02:26:00'),
(68, 24, 'Q1', NULL, '1 hour', 0, 1, '2024-06-23 04:35:56', '2024-06-23 04:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_options`
--

CREATE TABLE `quiz_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAnswer` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_options`
--

INSERT INTO `quiz_options` (`id`, `quiz_id`, `option`, `isAnswer`, `created_at`, `updated_at`) VALUES
(1, 4, 'option 1', NULL, '2022-12-10 03:13:38', '2022-12-10 03:13:38'),
(2, 4, 'option 2', NULL, '2022-12-10 03:13:38', '2022-12-10 03:13:38'),
(3, 4, 'option 3', NULL, '2022-12-10 03:13:38', '2022-12-10 03:13:38'),
(4, 4, 'option 4', 1, '2022-12-10 03:13:38', '2022-12-10 03:13:38'),
(5, 5, 'option 1', NULL, '2022-12-10 03:14:41', '2022-12-10 03:14:41'),
(6, 5, 'option 2', NULL, '2022-12-10 03:14:41', '2022-12-10 03:14:41'),
(7, 5, 'option 3', NULL, '2022-12-10 03:14:41', '2022-12-10 03:14:41'),
(8, 5, 'option 4', 1, '2022-12-10 03:14:41', '2022-12-10 03:14:41'),
(9, 6, 'vn vnv nvn vn 111355', 0, '2022-12-14 12:24:47', '2022-12-15 12:51:09'),
(10, 6, 'vn vnv 123113555555', 0, '2022-12-14 12:24:47', '2022-12-15 12:51:09'),
(11, 6, 'v vn 1113555555', 0, '2022-12-14 12:24:47', '2022-12-15 12:51:09'),
(12, 6, 'vn vnv n5555555', 1, '2022-12-14 12:24:47', '2022-12-15 12:51:09'),
(13, 7, 'vn vnv nvn vn 1113', 1, '2022-12-19 03:18:21', '2022-12-19 03:18:21'),
(14, 7, 'vn vnv 123113', 0, '2022-12-19 03:18:21', '2022-12-19 03:18:21'),
(15, 7, 'v vn 1113', 0, '2022-12-19 03:18:21', '2022-12-19 03:18:21'),
(16, 7, 'vn vnv n', 0, '2022-12-19 03:18:21', '2022-12-19 03:18:21'),
(17, 8, 'vn vnv nvn vn 1113', 1, '2022-12-30 21:43:14', '2022-12-30 21:43:14'),
(18, 8, 'vn vnv 123113', 0, '2022-12-30 21:43:14', '2022-12-30 21:43:14'),
(19, 8, 'v vn 1113', 0, '2022-12-30 21:43:14', '2022-12-30 21:43:14'),
(20, 8, 'vn vnv n', 0, '2022-12-30 21:43:14', '2022-12-30 21:43:14'),
(21, 9, 'vn vnv nvn vn 1113', 0, '2022-12-30 21:43:23', '2023-01-17 22:31:59'),
(22, 9, 'vn vnv 123113', 0, '2022-12-30 21:43:23', '2022-12-30 21:43:23'),
(23, 9, 'v vn 1113', 0, '2022-12-30 21:43:23', '2022-12-30 21:43:23'),
(24, 9, 'vn vnv n', 1, '2022-12-30 21:43:23', '2023-01-17 22:31:59'),
(25, 10, 'vn vnv nvn vn 1113', 0, '2022-12-30 21:43:27', '2023-01-17 22:25:03'),
(26, 10, 'vn vnv 123113', 0, '2022-12-30 21:43:27', '2022-12-30 21:43:27'),
(27, 10, 'v vn 1113', 0, '2022-12-30 21:43:27', '2022-12-30 21:43:27'),
(28, 10, 'vn vnv n', 1, '2022-12-30 21:43:27', '2023-01-17 22:25:03'),
(29, 11, 'vn vnv nvn vn 1113', 1, '2023-01-16 23:25:08', '2023-01-16 23:25:08'),
(30, 11, 'vn vnv 123113', 0, '2023-01-16 23:25:08', '2023-01-16 23:25:08'),
(31, 11, 'v vn 1113', 0, '2023-01-16 23:25:08', '2023-01-16 23:25:08'),
(32, 11, 'vn vnv n', 0, '2023-01-16 23:25:08', '2023-01-16 23:25:08'),
(33, 12, 'Lorem 1', 1, '2023-01-17 03:53:26', '2023-01-17 03:53:26'),
(34, 12, 'Lorem 2', 0, '2023-01-17 03:53:26', '2023-01-17 03:53:26'),
(35, 12, 'Lorem 3', 0, '2023-01-17 03:53:26', '2023-01-17 03:53:26'),
(36, 12, 'Lorem 4', 0, '2023-01-17 03:53:26', '2023-01-17 03:53:26'),
(37, 13, 'Lorem 1', 0, '2023-01-17 03:59:56', '2023-02-08 11:47:35'),
(38, 13, 'Lorem 2', 0, '2023-01-17 03:59:56', '2023-01-17 03:59:56'),
(39, 13, 'Lorem 3', 0, '2023-01-17 03:59:56', '2023-01-17 03:59:56'),
(40, 13, 'Lorem 4', 1, '2023-01-17 03:59:56', '2023-02-08 11:47:35'),
(41, 14, 'Lorem 1', 0, '2023-01-17 04:00:56', '2023-01-17 22:46:05'),
(42, 14, 'Lorem 2', 0, '2023-01-17 04:00:56', '2023-01-17 04:00:56'),
(43, 14, 'Lorem 3', 0, '2023-01-17 04:00:56', '2023-01-17 04:00:56'),
(44, 14, 'Lorem 4', 1, '2023-01-17 04:00:56', '2023-01-17 22:46:05'),
(45, 15, 'Lorem 1', 1, '2023-01-17 04:01:39', '2023-01-17 04:01:39'),
(46, 15, 'Lorem 2', 0, '2023-01-17 04:01:39', '2023-01-17 04:01:39'),
(47, 15, 'Lorem 3', 0, '2023-01-17 04:01:39', '2023-01-17 04:01:39'),
(48, 15, 'Lorem 4', 0, '2023-01-17 04:01:39', '2023-01-17 04:01:39'),
(49, 16, 'Lorem 1', 1, '2023-01-17 04:02:29', '2023-01-17 04:02:29'),
(50, 16, 'Lorem 2', 0, '2023-01-17 04:02:29', '2023-01-17 04:02:29'),
(51, 16, 'Lorem 3', 0, '2023-01-17 04:02:29', '2023-01-17 04:02:29'),
(52, 16, 'Lorem 4', 0, '2023-01-17 04:02:29', '2023-01-17 04:02:29'),
(53, 17, 'Lorem 1', 1, '2023-01-17 04:02:36', '2023-01-17 04:02:36'),
(54, 17, 'Lorem 2', 0, '2023-01-17 04:02:36', '2023-01-17 04:02:36'),
(55, 17, 'Lorem 3', 0, '2023-01-17 04:02:36', '2023-01-17 04:02:36'),
(56, 17, 'Lorem 4', 0, '2023-01-17 04:02:36', '2023-01-17 04:02:36'),
(57, 18, 'Lorem 1', 1, '2023-01-17 04:09:30', '2023-01-17 04:09:30'),
(58, 18, 'Lorem 2', 0, '2023-01-17 04:09:30', '2023-01-17 04:09:30'),
(59, 18, 'Lorem 3', 0, '2023-01-17 04:09:30', '2023-01-17 04:09:30'),
(60, 18, 'Lorem 4', 0, '2023-01-17 04:09:30', '2023-01-17 04:09:30'),
(61, 19, 'Lorem 1', 1, '2023-01-17 04:13:46', '2023-01-17 04:13:46'),
(62, 19, 'Lorem 2', 0, '2023-01-17 04:13:46', '2023-01-17 04:13:46'),
(63, 19, 'Lorem 3', 0, '2023-01-17 04:13:46', '2023-01-17 04:13:46'),
(64, 19, 'Lorem 4', 0, '2023-01-17 04:13:46', '2023-01-17 04:13:46'),
(65, 20, 'Lorem 1', 1, '2023-01-17 04:36:29', '2023-01-17 04:36:29'),
(66, 20, 'Lorem 2', 0, '2023-01-17 04:36:29', '2023-01-17 04:36:29'),
(67, 20, 'Lorem 3', 0, '2023-01-17 04:36:29', '2023-01-17 04:36:29'),
(68, 20, 'Lorem 4', 0, '2023-01-17 04:36:29', '2023-01-17 04:36:29'),
(69, 21, 'Lorem 1', 1, '2023-01-17 04:50:34', '2023-01-17 04:50:34'),
(70, 21, 'Lorem 2', 0, '2023-01-17 04:50:34', '2023-01-17 04:50:34'),
(71, 21, 'Lorem 3', 0, '2023-01-17 04:50:34', '2023-01-17 04:50:34'),
(72, 21, 'Lorem 4', 0, '2023-01-17 04:50:34', '2023-01-17 04:50:34'),
(73, 22, 'Lorem 1', 1, '2023-01-17 04:55:57', '2023-01-17 04:55:57'),
(74, 22, 'Lorem 2', 0, '2023-01-17 04:55:57', '2023-01-17 04:55:57'),
(75, 22, 'Lorem 3', 0, '2023-01-17 04:55:57', '2023-01-17 04:55:57'),
(76, 22, 'Lorem 4', 0, '2023-01-17 04:55:57', '2023-01-17 04:55:57'),
(77, 23, 'Lorem 1', 1, '2023-01-17 04:58:52', '2023-01-17 04:58:52'),
(78, 23, 'Lorem 2', 0, '2023-01-17 04:58:52', '2023-01-17 04:58:52'),
(79, 23, 'Lorem 3', 0, '2023-01-17 04:58:52', '2023-01-17 04:58:52'),
(80, 23, 'Lorem 4', 0, '2023-01-17 04:58:52', '2023-01-17 04:58:52'),
(81, 24, 'Lorem 1', 1, '2023-01-17 05:03:39', '2023-01-17 05:03:39'),
(82, 24, 'Lorem 2', 0, '2023-01-17 05:03:39', '2023-01-17 05:03:39'),
(83, 24, 'Lorem 3', 0, '2023-01-17 05:03:39', '2023-01-17 05:03:39'),
(84, 24, 'Lorem 4', 0, '2023-01-17 05:03:39', '2023-01-17 05:03:39'),
(89, 26, 'Lorem 1', 1, '2023-01-17 05:41:53', '2023-01-17 05:41:53'),
(90, 26, 'Lorem 2', 0, '2023-01-17 05:41:53', '2023-01-17 05:41:53'),
(91, 26, 'Lorem 3', 0, '2023-01-17 05:41:53', '2023-01-17 05:41:53'),
(92, 26, 'Lorem 4', 0, '2023-01-17 05:41:53', '2023-01-17 05:41:53'),
(93, 27, 'Lorem 1', 1, '2023-01-17 05:59:05', '2023-01-17 05:59:05'),
(94, 27, 'Lorem 2', 0, '2023-01-17 05:59:05', '2023-01-17 05:59:05'),
(95, 27, 'Lorem 3', 0, '2023-01-17 05:59:05', '2023-01-17 05:59:05'),
(96, 27, 'Lorem 4', 0, '2023-01-17 05:59:05', '2023-01-17 05:59:05'),
(97, 28, 'Lorem 1', 1, '2023-01-17 21:49:44', '2023-01-17 21:49:44'),
(98, 28, 'Lorem 2', 0, '2023-01-17 21:49:44', '2023-01-17 21:49:44'),
(99, 28, 'Lorem 3', 0, '2023-01-17 21:49:44', '2023-01-17 21:49:44'),
(100, 28, 'Lorem 4', 0, '2023-01-17 21:49:44', '2023-01-17 21:49:44'),
(101, 29, 'Lorem 1', 1, '2023-01-17 21:53:34', '2023-01-17 21:53:34'),
(102, 29, 'Lorem 2', 0, '2023-01-17 21:53:34', '2023-01-17 21:53:34'),
(103, 29, 'Lorem 3', 0, '2023-01-17 21:53:34', '2023-01-17 21:53:34'),
(104, 29, 'Lorem 4', 0, '2023-01-17 21:53:34', '2023-01-17 21:53:34'),
(105, 30, 'vn vnv nvn vn 1113', 1, '2023-01-17 21:54:16', '2023-01-17 21:54:16'),
(106, 30, 'vn vnv 123113', 0, '2023-01-17 21:54:16', '2023-01-17 21:54:16'),
(107, 30, 'v vn 1113', 0, '2023-01-17 21:54:16', '2023-01-17 21:54:16'),
(108, 30, 'vn vnv n', 0, '2023-01-17 21:54:16', '2023-01-17 21:54:16'),
(109, 31, 'vn vnv nvn vn 1113', 1, '2023-01-17 22:25:19', '2023-01-17 22:25:19'),
(110, 31, 'vn vnv 123113', 0, '2023-01-17 22:25:19', '2023-01-17 22:25:19'),
(111, 31, 'v vn 1113', 0, '2023-01-17 22:25:19', '2023-01-17 22:25:19'),
(112, 31, 'vn vnv n', 0, '2023-01-17 22:25:19', '2023-01-17 22:25:19'),
(113, 32, 'vn vnv nvn vn 1113', 1, '2023-01-17 22:25:27', '2023-01-17 22:25:27'),
(114, 32, 'vn vnv 123113', 0, '2023-01-17 22:25:27', '2023-01-17 22:25:27'),
(115, 32, 'v vn 1113', 0, '2023-01-17 22:25:27', '2023-01-17 22:25:27'),
(116, 32, 'vn vnv n', 0, '2023-01-17 22:25:27', '2023-01-17 22:25:27'),
(117, 33, 'gg', 0, '2023-01-18 22:20:45', '2023-01-18 22:20:56'),
(118, 33, 'gg', 0, '2023-01-18 22:20:45', '2023-01-18 22:20:45'),
(119, 33, 'gg', 0, '2023-01-18 22:20:45', '2023-01-18 22:20:45'),
(120, 33, 'gg', 1, '2023-01-18 22:20:45', '2023-01-18 22:20:56'),
(121, 34, 'vn vnv nvn vn 1113', 1, '2023-02-08 11:21:59', '2023-02-08 11:21:59'),
(122, 34, 'vn vnv 123113', 0, '2023-02-08 11:21:59', '2023-02-08 11:21:59'),
(123, 34, 'v vn 1113', 0, '2023-02-08 11:21:59', '2023-02-08 11:21:59'),
(124, 34, 'vn vnv n', 0, '2023-02-08 11:21:59', '2023-02-08 11:21:59'),
(125, 35, 'vn vnv nvn vn 1113', 1, '2023-02-08 11:22:06', '2023-02-08 11:22:06'),
(126, 35, 'vn vnv 123113', 0, '2023-02-08 11:22:06', '2023-02-08 11:22:06'),
(127, 35, 'v vn 1113', 0, '2023-02-08 11:22:06', '2023-02-08 11:22:06'),
(128, 35, 'vn vnv n', 0, '2023-02-08 11:22:06', '2023-02-08 11:22:06'),
(129, 36, 'vn vnv nvn vn 1113', 1, '2023-02-08 11:22:11', '2023-02-08 11:22:11'),
(130, 36, 'vn vnv 123113', 0, '2023-02-08 11:22:11', '2023-02-08 11:22:11'),
(131, 36, 'v vn 1113', 0, '2023-02-08 11:22:11', '2023-02-08 11:22:11'),
(132, 36, 'vn vnv n', 0, '2023-02-08 11:22:11', '2023-02-08 11:22:11'),
(133, 37, 'vn vnv nvn vn 1113', 1, '2023-02-08 11:22:18', '2023-02-08 11:22:18'),
(134, 37, 'vn vnv 123113', 0, '2023-02-08 11:22:18', '2023-02-08 11:22:18'),
(135, 37, 'v vn 1113', 0, '2023-02-08 11:22:18', '2023-02-08 11:22:18'),
(136, 37, 'vn vnv n', 0, '2023-02-08 11:22:18', '2023-02-08 11:22:18'),
(137, 38, 'vn vnv nvn vn 1113', 1, '2023-02-08 11:22:49', '2023-02-08 11:22:49'),
(138, 38, 'vn vnv 123113', 0, '2023-02-08 11:22:49', '2023-02-08 11:22:49'),
(139, 38, 'v vn 1113', 0, '2023-02-08 11:22:49', '2023-02-08 11:22:49'),
(140, 38, 'vn vnv n', 0, '2023-02-08 11:22:49', '2023-02-08 11:22:49'),
(141, 39, 'g', 1, '2023-02-08 11:46:54', '2023-02-08 11:46:54'),
(142, 39, 'g', 0, '2023-02-08 11:46:54', '2023-02-08 11:46:54'),
(143, 39, 'g', 0, '2023-02-08 11:46:54', '2023-02-08 11:46:54'),
(144, 39, 'gg', 0, '2023-02-08 11:46:54', '2023-02-08 11:46:54'),
(145, 40, 'gg', 1, '2023-02-08 11:50:18', '2023-02-08 11:50:18'),
(146, 40, 'gg', 0, '2023-02-08 11:50:18', '2023-02-08 11:50:18'),
(147, 40, 'gg', 0, '2023-02-08 11:50:18', '2023-02-08 11:50:18'),
(148, 40, 'gg', 0, '2023-02-08 11:50:18', '2023-02-08 11:50:18'),
(149, 41, 'gg', 1, '2023-02-08 11:50:44', '2023-02-08 11:50:44'),
(150, 41, 'gg', 0, '2023-02-08 11:50:44', '2023-02-08 11:50:44'),
(151, 41, 'gg', 0, '2023-02-08 11:50:44', '2023-02-08 11:50:44'),
(152, 41, 'gg', 0, '2023-02-08 11:50:44', '2023-02-08 11:50:44'),
(153, 42, 'vn vnv nvn vn 1113', 1, '2023-02-13 16:31:39', '2023-02-13 16:31:39'),
(154, 42, 'vn vnv 123113', 0, '2023-02-13 16:31:39', '2023-02-13 16:31:39'),
(155, 42, 'v vn 1113', 0, '2023-02-13 16:31:39', '2023-02-13 16:31:39'),
(156, 42, 'vn vnv n', 0, '2023-02-13 16:31:39', '2023-02-13 16:31:39'),
(193, 52, 'Go', 0, '2023-02-20 11:29:44', '2023-02-26 17:41:47'),
(194, 52, 'Java', 0, '2023-02-20 11:29:44', '2023-02-26 17:41:47'),
(195, 52, 'Dart', 0, '2023-02-20 11:29:44', '2023-02-26 17:41:07'),
(196, 52, 'React', 0, '2023-02-20 11:29:44', '2023-02-26 18:26:11'),
(217, 58, 'AA', 0, '2023-02-26 18:28:58', '2023-02-26 18:34:50'),
(218, 58, 'AAAA', 0, '2023-02-26 18:28:58', '2023-02-26 18:28:58'),
(219, 58, 'AAAAA', 0, '2023-02-26 18:28:58', '2023-02-26 18:28:58'),
(220, 58, 'AAAAAA', 0, '2023-02-26 18:28:58', '2023-02-26 18:28:58'),
(221, 59, 'AA', 1, '2023-02-26 18:37:47', '2023-02-26 18:37:47'),
(222, 59, 'AAA', 0, '2023-02-26 18:37:48', '2023-02-26 18:37:48'),
(223, 59, 'AAAAA', 0, '2023-02-26 18:37:48', '2023-02-26 18:37:48'),
(224, 59, 'A', 0, '2023-02-26 18:37:48', '2023-02-26 18:37:48'),
(225, 61, 'Item 2', 0, '2024-04-29 03:00:34', '2024-04-29 03:00:34'),
(226, 61, 'Item 1', 1, '2024-04-29 03:00:34', '2024-04-29 03:00:34'),
(227, 62, 'item 1', 0, '2024-04-29 03:02:23', '2024-04-29 03:02:23'),
(228, 62, 'Item 2', 1, '2024-04-29 03:02:23', '2024-04-29 03:02:23'),
(229, 63, 'Item 1', 0, '2024-04-29 03:24:24', '2024-04-29 03:24:24'),
(230, 63, 'Item 2', 1, '2024-04-29 03:24:24', '2024-04-29 03:24:24'),
(231, 64, 'Item 1', 0, '2024-04-29 03:37:19', '2024-04-29 03:37:19'),
(232, 64, 'Item 2', 1, '2024-04-29 03:37:19', '2024-04-29 03:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `rating_reviews`
--

CREATE TABLE `rating_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_reviews`
--

INSERT INTO `rating_reviews` (`id`, `user_id`, `course_id`, `rating`, `review`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 4, 'Average course', 1, '2023-02-13 13:09:46', '2023-02-13 13:55:44'),
(5, 2, 78, 5, 'abc', 1, NULL, NULL),
(6, 10, 78, 4, 'def', 1, NULL, NULL),
(16, 1, 78, 3, 'gg', 0, '2023-02-19 11:15:56', '2023-02-19 11:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  `summary` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `student_id`, `title`, `designation`, `summary`, `created_at`, `updated_at`) VALUES
(1, 1, 'Spider Man', 'Avenger Superhero', 'Name is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2024-06-05 03:06:23', '2024-06-06 03:52:15'),
(2, 3, NULL, NULL, NULL, '2024-06-23 05:43:44', '2024-06-23 05:43:44'),
(3, 4, NULL, NULL, NULL, '2024-06-24 00:44:59', '2024-06-24 00:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Editior', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `share_links`
--

CREATE TABLE `share_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `shareable_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `share_links`
--

INSERT INTO `share_links` (`id`, `affiliate_id`, `course_id`, `shareable_link`, `validity`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Y045E173BC', '2023-01-30', '2023-01-25 13:34:34', '2023-01-25 13:34:34'),
(2, 7, 1, 'N86J3UTCHZ', '2023-02-20', '2023-02-15 11:14:45', '2023-02-15 11:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `studentbenefits`
--

CREATE TABLE `studentbenefits` (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `link` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentbenefits`
--

INSERT INTO `studentbenefits` (`id`, `title`, `description`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ইন্ডাস্ট্রি এক্সপার্টদের কন্টেন্ট', 'আমাদের প্রতিটা কন্টেন্ট ইন্ডাস্ট্রির টপ এক্সপার্টদের সরাসরি সাপোর্ট, গাইডেন্স ও ফিডব্যাক দিয়ে বানানো।', 'images/promotions/1801724101510946.jpg', NULL, 1, '2024-06-12 23:53:20', '2024-06-12 23:53:20'),
(3, 'ইন্ডাস্ট্রি এক্সপার্টদের কন্টেন্ট', 'আমাদের প্রতিটা কন্টেন্ট ইন্ডাস্ট্রির টপ এক্সপার্টদের সরাসরি সাপোর্ট, গাইডেন্স ও ফিডব্যাক দিয়ে বানানো।', 'images/promotions/1801724131335558.jpg', NULL, 1, '2024-06-12 23:53:49', '2024-06-12 23:53:49'),
(4, 'ইন্ডাস্ট্রি এক্সপার্টদের কন্টেন্ট', 'আমাদের প্রতিটা কন্টেন্ট ইন্ডাস্ট্রির টপ এক্সপার্টদের সরাসরি সাপোর্ট, গাইডেন্স ও ফিডব্যাক দিয়ে বানানো।', 'images/promotions/1801724132420988.jpg', NULL, 1, '2024-06-12 23:53:50', '2024-06-12 23:53:50'),
(5, 'ইন্ডাস্ট্রি এক্সপার্টদের কন্টেন্ট', 'আমাদের প্রতিটা কন্টেন্ট ইন্ডাস্ট্রির টপ এক্সপার্টদের সরাসরি সাপোর্ট, গাইডেন্স ও ফিডব্যাক দিয়ে বানানো।', 'images/promotions/1801724132883566.jpg', NULL, 1, '2024-06-12 23:53:50', '2024-06-12 23:53:50'),
(6, 'ইন্ডাস্ট্রি এক্সপার্টদের কন্টেন্ট', 'আমাদের প্রতিটা কন্টেন্ট ইন্ডাস্ট্রির টপ এক্সপার্টদের সরাসরি সাপোর্ট, গাইডেন্স ও ফিডব্যাক দিয়ে বানানো।', 'images/promotions/1801724134905925.jpg', NULL, 1, '2024-06-12 23:53:52', '2024-06-12 23:53:52'),
(7, 'ইন্ডাস্ট্রি এক্সপার্টদের কন্টেন্ট', 'আমাদের প্রতিটা কন্টেন্ট ইন্ডাস্ট্রির টপ এক্সপার্টদের সরাসরি সাপোর্ট, গাইডেন্স ও ফিডব্যাক দিয়ে বানানো।', 'images/promotions/1801724136024049.jpg', NULL, 1, '2024-06-12 23:53:53', '2024-06-12 23:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` text,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `verifyToken` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `blood` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `address`, `image`, `password`, `verifyToken`, `gender`, `religion`, `blood`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ALif', '01770900478', 'alif@gmail.com', 'H#39, R#16\r\nNikunjo-2, Dhaka', 'images/student/1798466675066340.jpg', '$2y$12$30oIVlbAUnRr0eURQtfXM.3skrfd18MVcQ5kWhNheVcRQohfWdTyi', '1', 'Male', 'Islam', 'A+', 1, '2024-05-05 02:39:35', '2024-06-24 02:48:47'),
(3, 'Utsho', NULL, 'utsho@gmail.com', NULL, 'images/student/1802652169348770.jpg', '$2y$12$WPTfvr6Cozkoy.4xv6rK6.KGrkZe7NBDDAOMXBlZL87aSj/Mglft.', NULL, NULL, NULL, NULL, 1, '2024-06-23 05:43:44', '2024-06-23 05:44:35'),
(4, 'ALif1', '01770900471', 'alif1@gmail.com', NULL, NULL, '$2y$12$6Ql9y9SrwM24ZfD7LNMTZ.nnJcaGsHuz7dFRRxxkE7VZWFzAahXn6', '1', NULL, NULL, NULL, 1, '2024-06-24 00:44:57', '2024-06-24 02:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'sub calss 123', 'images/category/1757966886192048.png', 1, '2022-11-27 10:34:13', '2023-02-16 13:11:08'),
(2, 2, 'New subcat', 'images/subcategory/1797557649142233.jpg', 1, '2024-04-28 00:09:22', '2024-04-28 00:09:22'),
(3, 0, 'Online', 'images/subcategory/1801448753402435.jpg', 1, '2024-06-09 22:56:48', '2024-06-09 22:56:48'),
(4, 0, 'Offline', 'images/subcategory/1801448767545392.jpg', 1, '2024-06-09 22:57:01', '2024-06-09 22:57:01'),
(5, 3, 'HSC Science', 'images/subcategory/1801727300532261.jpg', 1, '2024-06-13 00:44:11', '2024-06-13 00:44:11'),
(6, 3, 'HSC Arts', 'images/subcategory/1801727306990373.jpg', 1, '2024-06-13 00:44:17', '2024-06-13 00:44:17'),
(7, 3, 'HSC Commerce', 'images/subcategory/1801727315669582.jpg', 1, '2024-06-13 00:44:26', '2024-06-13 00:44:26'),
(8, 3, 'HSC ICT', 'images/subcategory/1801727342050917.jpg', 1, '2024-06-13 00:44:51', '2024-06-13 00:44:51'),
(9, 3, 'HSC English', 'images/subcategory/1801727345230817.jpg', 1, '2024-06-13 00:44:54', '2024-06-13 00:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `certificate_name`, `email`, `password`, `district`, `institute`, `mobile`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Foisal A', 'Md Hafiz Al Foisal', 'user1@gmail.com', '$2y$10$PfxSk61e76AgtQt279sbjO1F/X6Wul6IqR7KLDCh50d3zjMPRhR0u', 'Satkhira', 'ABC', '0147896325', 'images/user/1752389351427354.png', NULL, NULL, '2022-12-16 09:31:32', '2022-12-19 04:07:02'),
(2, 'Fsd Ramjan', 'Fsd Ramjan', 'abcd@gmail.com', '$2y$10$QoNoVoPAacoeBCKvLmw49.9uFGV83l0/Bm48iad/7/s.kgxmqu0Zm', 'Your district name', 'Your institute name', '+8801789123456', 'images/user/1754972513869622.jpg', NULL, NULL, '2022-12-19 00:58:38', '2023-01-13 22:56:52'),
(4, 'aff 1', NULL, 'fsd.ramjans@gmail.com', '$2y$10$b5OFkYoCux8tLPQnSPvXb.qfJRyP4dPefA25D76qIGNzmXTxT5q3S', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 01:00:04', '2022-12-19 01:00:04'),
(7, 'aff 1', NULL, 'fsd.ramjanss@gmail.com', '$2y$10$nb.LxYLf6sBBS.6OwGtuyuD1wgM/ykvU9Ld4Jc3T5xPY0o10S9qjm', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 01:01:02', '2022-12-19 01:01:02'),
(8, 'aff 1', NULL, 'fsd.ramjsanss@gmail.com', '$2y$10$3wFmgZMF.XTFMlMTpGcEauU3LdEyFVGqvYxrjUSQvY3jLwmL4mIG6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 01:01:09', '2022-12-19 01:01:09'),
(10, 'aff 1', NULL, 'fsd.ramjsangss@gmail.com', '$2y$10$VAIB4JBTdacFSw7uSoOWNONkyjyBof.9JRQxGcR8/Dtim3zyewNfK', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 03:03:57', '2022-12-19 03:03:57'),
(19, 'Fsd', NULL, 'fsd.ramjaaaan@gmail.com', '$2y$10$JLdyfHHVK3N1HRqrviv17ediD1TClBHHamq587uUeBLgwzmjICXCW', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 04:58:11', '2022-12-19 04:58:11'),
(21, 'Fsd', NULL, 'fsd.ramjaaaana@gmail.com', '$2y$10$znLNlBHqHm75WvDzXyCOk.cJz9hc/2BNDg66DR/zsUeGjATpWkacO', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 04:59:51', '2022-12-19 04:59:51'),
(22, 'Fsddd', NULL, 'sdsfdsffdd@gmail.com', '$2y$10$qruGi7WEtLG/BrXyWGA9GuP1dAzJU9RQqukqJ1o6RQp7U8LGiG8K.', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 05:02:23', '2022-12-19 05:02:23'),
(26, 'Fsddd', NULL, 'sdsfdsffssdd@gmail.com', '$2y$10$JyyV3DvQ6KYOz8H0iAYsVOUpgeNNfcIxbjvbnSp5UBj/CeSDB9Qry', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 05:04:40', '2022-12-19 05:04:40'),
(27, 'ggggg', NULL, 'gggg', '$2y$10$9EJwRzUUirSUbc6iBhaqj.RSrzgRfNClE14idkxZDGeCuwVbzw6g6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 05:10:28', '2022-12-19 05:10:28'),
(28, 'ggg', NULL, 'ggggg', '$2y$10$gDYhm/XyrQRh/b80SNHe9OekokbL.RaD5117OePZt/Tkpo9zNYTIy', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 05:11:37', '2022-12-19 05:11:37'),
(29, 'gg', NULL, 'ggg', '$2y$10$cTIyz.jkU7AaLVx3gFb9HeVvb.i0rSiu3KWQKEJyFDInR942h3gBe', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-19 05:29:07', '2022-12-19 05:29:07'),
(31, 'user1', NULL, 'user3@gmail.com', '$2y$10$qJ697kEoy9vqATHxDkJqiuzwWm3aybtdDO6qx70X3TdQBJWHUrV02', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-15 14:04:35', '2023-02-15 14:04:35'),
(32, 'James Rana', NULL, 'quicktech10rana@gmail.com', '$2y$10$KuDckXZUGG4QZDFrCWkPFecLms1/Lp31KA/nJDrVqsOHa4RTSQGJq', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-07 17:10:40', '2023-03-07 17:10:40'),
(33, 'Md Didarul', NULL, 'didarulalampapel@gmail', '$2y$10$VL.S5XbcXY6SlcfYZXN.D.N3lNMYF58jI9r/1GuDYSfGwvB8pwfMG', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-04 12:24:07', '2023-04-04 12:24:07'),
(34, 'Amin', NULL, 'saifmahmud727@gmail.com', '$2y$10$ARSxyih0LG6/BKPse1HgieFWthupcPHadeOFeXfRu17UOTYcjoFum', NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-06 14:05:06', '2023-05-06 14:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `lesson_id`, `name`, `link`, `duration`, `image`, `free`, `status`, `created_at`, `updated_at`) VALUES
(3, 8, 'ভ্রমণে কক্সবাজার: অভিযোগ পথে পথে', '<iframe width=\"560\" height=\"315\"\r\n                                    src=\"https://www.youtube.com/embed/JFNUVJtlQDU?si=dRtuQkcvB74qau5Q\"\r\n                                    title=\"YouTube video player\" frameborder=\"0\"\r\n                                    allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\"\r\n                                    referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2.36 Hours', NULL, 1, 1, '2022-12-09 07:30:07', '2024-05-21 03:04:21'),
(4, 8, 'ভ্রমণে কক্সবাজার: অভিযোগ পথে পথে1', 'https://youtu.be/VsN7vLCWMzk', '3.36 Hours', '', 0, 1, '2022-12-09 07:30:07', '2022-12-09 07:30:07'),
(16, 11, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2022-12-19 03:17:13', '2022-12-19 03:17:13'),
(19, 12, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2022-12-25 21:14:00', '2022-12-25 21:14:00'),
(20, 12, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2022-12-25 21:14:00', '2022-12-25 21:14:00'),
(21, 13, 'Lorem Videos', 'https://youtube.com/fsd', '0', '', 0, 1, '2022-12-25 22:25:07', '2022-12-25 22:25:07'),
(22, 14, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2022-12-26 05:15:38', '2022-12-26 05:15:38'),
(23, 14, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2022-12-26 05:15:38', '2022-12-26 05:15:38'),
(24, 15, 'Lorem Videos', 'https://www.youtube.com/watch?v=s_ZzHEOqxQI', '0', '', 0, 1, '2022-12-26 21:22:13', '2022-12-26 21:22:13'),
(25, 16, 'gg', 'https://www.youtube.com/watch?v=s_ZzHEOqxQI', '0', '', 0, 1, '2022-12-29 03:40:23', '2022-12-29 03:40:23'),
(29, 20, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2023-01-16 05:26:26', '2023-01-16 05:26:26'),
(30, 20, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2023-01-16 05:26:26', '2023-01-16 05:26:26'),
(31, 22, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2023-01-16 22:07:58', '2023-01-16 22:07:58'),
(32, 22, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2023-01-16 22:07:58', '2023-01-16 22:07:58'),
(33, 27, 'gg', 'https://www.youtube.com/watch?v=s_ZzHEOqxQI', '0', '', 0, 1, '2023-01-16 22:22:47', '2023-01-16 22:22:47'),
(34, 28, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2023-01-18 00:40:36', '2023-01-18 00:40:36'),
(35, 28, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '', 0, 1, '2023-01-18 00:40:36', '2023-01-18 00:40:36'),
(36, 29, 'gg', 'gg', NULL, '', 0, 1, '2023-01-18 22:20:20', '2023-01-18 22:20:20'),
(37, 31, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/video/perfil-1674334036.png', 0, 1, '2023-01-21 14:47:16', '2023-01-21 14:47:16'),
(38, 31, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/video/perfil-1674334036.png', 0, 1, '2023-01-21 14:47:16', '2023-01-21 14:47:16'),
(39, 32, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674402649.mp4', 0, 1, '2023-01-22 09:50:49', '2023-01-22 09:50:49'),
(40, 32, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674402649.mp4', 0, 1, '2023-01-22 09:50:49', '2023-01-22 09:50:49'),
(41, 33, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674402671.mp4', 0, 1, '2023-01-22 09:51:11', '2023-01-22 09:51:11'),
(42, 33, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674402671.mp4', 0, 1, '2023-01-22 09:51:11', '2023-01-22 09:51:11'),
(43, 34, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674402904.mp4', 0, 1, '2023-01-22 09:55:04', '2023-01-22 09:55:04'),
(44, 34, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674402904.mp4', 0, 1, '2023-01-22 09:55:04', '2023-01-22 09:55:04'),
(45, 35, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674403115.png', 0, 1, '2023-01-22 09:58:35', '2023-01-22 09:58:35'),
(46, 35, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/video/1674403115.png', 0, 1, '2023-01-22 09:58:35', '2023-01-22 09:58:35'),
(47, 50, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675761381.png', 0, 1, '2023-02-07 16:16:21', '2023-02-07 16:16:21'),
(48, 50, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675761381.png', 0, 1, '2023-02-07 16:16:21', '2023-02-07 16:16:21'),
(49, 53, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675761428.png', 0, 1, '2023-02-07 16:17:08', '2023-02-07 16:17:08'),
(50, 53, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675761428.png', 0, 1, '2023-02-07 16:17:08', '2023-02-07 16:17:08'),
(52, 54, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675764773.png', 0, 1, '2023-02-07 17:12:53', '2023-02-07 17:12:53'),
(53, 55, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675767001.png', 0, 1, '2023-02-07 17:50:01', '2023-02-07 17:50:01'),
(54, 55, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675767001.png', 0, 1, '2023-02-07 17:50:01', '2023-02-07 17:50:01'),
(55, 56, 'vn vnv nvn vn 111', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675771542.png', 0, 1, '2023-02-07 19:05:42', '2023-02-07 19:05:42'),
(56, 56, 'vn vnv nvn vn 222', 'http://son.example/ffd', '2.3 Hours', '/images/course/1675771542.png', 0, 1, '2023-02-07 19:05:42', '2023-02-07 19:05:42'),
(57, 62, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676265907.png', 0, 1, '2023-02-13 12:25:07', '2023-02-13 12:25:07'),
(58, 62, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676265907.png', 0, 1, '2023-02-13 12:25:07', '2023-02-13 12:25:07'),
(59, 62, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676265907.png', 0, 1, '2023-02-13 12:25:07', '2023-02-13 12:25:07'),
(71, 65, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676440078.png', 0, 1, '2023-02-15 12:47:58', '2023-02-15 12:47:58'),
(72, 65, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676440078.png', 0, 1, '2023-02-15 12:47:58', '2023-02-15 12:47:58'),
(73, 65, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676440078.png', 0, 1, '2023-02-15 12:47:58', '2023-02-15 12:47:58'),
(74, 66, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676440207.png', 0, 1, '2023-02-15 12:50:07', '2023-02-15 12:50:07'),
(75, 66, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676440207.png', 0, 1, '2023-02-15 12:50:07', '2023-02-15 12:50:07'),
(76, 66, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676440207.png', 0, 1, '2023-02-15 12:50:07', '2023-02-15 12:50:07'),
(77, 67, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676452886.png', 0, 1, '2023-02-15 16:21:26', '2023-02-15 16:21:26'),
(78, 67, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676452886.png', 0, 1, '2023-02-15 16:21:26', '2023-02-15 16:21:26'),
(79, 67, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676452886.png', 0, 1, '2023-02-15 16:21:26', '2023-02-15 16:21:26'),
(83, 69, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676454874.png', 0, 1, '2023-02-15 16:54:34', '2023-02-15 16:54:34'),
(84, 69, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676454874.png', 0, 1, '2023-02-15 16:54:34', '2023-02-15 16:54:34'),
(85, 69, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676454874.png', 0, 1, '2023-02-15 16:54:34', '2023-02-15 16:54:34'),
(86, 70, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676455001.png', 0, 1, '2023-02-15 16:56:41', '2023-02-15 16:56:41'),
(87, 70, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676455001.png', 0, 1, '2023-02-15 16:56:41', '2023-02-15 16:56:41'),
(88, 70, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676455001.png', 0, 1, '2023-02-15 16:56:41', '2023-02-15 16:56:41'),
(89, 71, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676455106.png', 0, 1, '2023-02-15 16:58:26', '2023-02-15 16:58:26'),
(90, 71, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676455106.png', 0, 1, '2023-02-15 16:58:26', '2023-02-15 16:58:26'),
(91, 71, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676455106.png', 0, 1, '2023-02-15 16:58:26', '2023-02-15 16:58:26'),
(92, 72, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676455113.png', 0, 1, '2023-02-15 16:58:33', '2023-02-15 16:58:33'),
(93, 72, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676455113.png', 0, 1, '2023-02-15 16:58:33', '2023-02-15 16:58:33'),
(94, 72, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676455113.png', 0, 1, '2023-02-15 16:58:33', '2023-02-15 16:58:33'),
(95, 73, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676455201.png', 0, 1, '2023-02-15 17:00:01', '2023-02-15 17:00:01'),
(96, 73, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676455201.png', 0, 1, '2023-02-15 17:00:01', '2023-02-15 17:00:01'),
(97, 73, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676455201.png', 0, 1, '2023-02-15 17:00:01', '2023-02-15 17:00:01'),
(98, 74, 'Video 1', 'https://www.example.com/video1', '00:03:45', '/images/video/1676458522.png', 0, 1, '2023-02-15 17:55:22', '2023-02-15 17:55:22'),
(99, 74, 'Video 2', 'https://www.example.com/video2', '00:04:15', '/images/video/1676458522.png', 0, 1, '2023-02-15 17:55:22', '2023-02-15 17:55:22'),
(100, 74, 'Video 3', 'https://www.example.com/video3', '00:05:30', '/images/video/1676458522.png', 0, 1, '2023-02-15 17:55:22', '2023-02-15 17:55:22'),
(103, 77, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 1', 'https://www.youtube.com/watch?v=Ao-6N8AHbu4&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8', '00:03:45', '/images/video/1676518361.png', 0, 1, '2023-02-16 10:32:41', '2023-02-16 10:32:41'),
(104, 77, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 2', 'https://www.youtube.com/watch?v=UhwZ_H0wAC0&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8&index=2', '00:04:15', '/images/video/1676518361.png', 0, 1, '2023-02-16 10:32:41', '2023-02-16 10:32:41'),
(105, 77, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 3', 'https://www.youtube.com/watch?v=4XQtX5UcfbM&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8&index=3', '00:05:30', '/images/video/1676518361.png', 0, 1, '2023-02-16 10:32:41', '2023-02-16 10:32:41'),
(106, 78, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 1', 'https://www.youtube.com/watch?v=Ao-6N8AHbu4&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8', '00:03:45', '/images/video/1676518380.png', 0, 1, '2023-02-16 10:33:00', '2023-02-16 10:33:00'),
(107, 78, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 2', 'https://www.youtube.com/watch?v=UhwZ_H0wAC0&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8&index=2', '00:04:15', '/images/video/1676518380.png', 0, 1, '2023-02-16 10:33:00', '2023-02-16 10:33:00'),
(108, 78, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 3', 'https://www.youtube.com/watch?v=4XQtX5UcfbM&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8&index=3', '00:05:30', '/images/video/1676518380.png', 0, 1, '2023-02-16 10:33:00', '2023-02-16 10:33:00'),
(109, 78, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 1', 'https://www.youtube.com/watch?v=Ao-6N8AHbu4&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8', '00:54:45', '/images/video/1676529926.png', 0, 1, '2023-02-16 13:45:26', '2023-02-16 13:45:26'),
(110, 78, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 2', 'https://www.youtube.com/watch?v=UhwZ_H0wAC0&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8&index=2', '00:44:15', '/images/video/1676529926.png', 0, 1, '2023-02-16 13:45:26', '2023-02-16 13:45:26'),
(111, 78, '৫ম শ্রেণি বাংলা | প্রাথমিক বৃত্তি পরীক্ষা সাজেশন ২০২২ | Primary Scholarship Exam 3', 'https://www.youtube.com/watch?v=4XQtX5UcfbM&list=PLuaHF6yUT-72PCi9tRT7Q7Pml_RQwaHJ8&index=3', '00:30:30', '/images/video/1676529926.png', 0, 1, '2023-02-16 13:45:26', '2023-02-16 13:45:26'),
(112, 78, 'HSC\'22 ফাইনাল রিভিশন LIVE | Bangla 1st Paper', 'https://www.youtube.com/watch?v=8vTM8-7LtMg&list=PLuaHF6yUT-72Hh-w8FAFCFyFZ5gts3oUy', '03:05:35', '/images/video/1676540225.png', 0, 1, '2023-02-16 16:37:05', '2023-02-16 16:37:05'),
(113, 79, 'new video', 'https://www.youtube.com/watch?v=8vTM8-7LtMg&list=PLuaHF6yUT-72Hh-w8FAFCFyFZ5gts3oUy', '10', 'frontend/img/course/course-1.jpg', 0, 1, '2024-04-28 00:19:46', '2024-04-28 00:19:46'),
(114, 80, 'new video', '#', '10', NULL, 0, 1, '2024-04-29 02:15:03', '2024-04-29 02:15:03'),
(115, 8, 'Video 1', '#', NULL, NULL, 1, 1, '2024-05-12 02:33:17', '2024-05-12 02:45:14'),
(116, 8, 'Video 2', '#', NULL, NULL, 1, 1, '2024-05-12 02:33:17', '2024-05-12 02:44:41'),
(117, 8, 'Video 3', '#', NULL, NULL, 0, 1, '2024-05-12 02:33:17', '2024-05-12 02:33:17'),
(118, 21, 'First video', '#', NULL, NULL, 0, 1, '2024-05-26 02:23:21', '2024-05-26 02:23:44'),
(119, 21, 'Second video', '#', NULL, NULL, 0, 1, '2024-05-26 02:23:21', '2024-05-26 02:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `weekschedules`
--

CREATE TABLE `weekschedules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `weekday` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weekschedules`
--

INSERT INTO `weekschedules` (`id`, `course_id`, `title`, `weekday`, `start_time`, `end_time`, `location`, `created_at`, `updated_at`) VALUES
(1, 84, 'Theory', 'SUN', '11:00:00', '13:00:00', '#', '2024-06-10 06:16:37', '2024-06-10 22:26:58'),
(2, 84, 'Lab', 'TUE', '14:00:00', '17:00:00', NULL, '2024-06-10 06:16:37', '2024-06-10 06:16:37'),
(3, 84, 'Theory', 'MON', '14:00:00', '16:00:00', '#', '2024-06-10 22:43:33', '2024-06-10 22:44:49'),
(4, 85, 'Theory', 'MON', '02:00:00', '04:00:00', NULL, '2024-06-10 23:18:41', '2024-06-10 23:18:41'),
(5, 85, 'Lab', 'WED', '02:00:00', '05:00:00', '#', '2024-06-10 23:18:59', '2024-06-10 23:18:59'),
(6, 86, 'Throry', 'MON', '14:00:00', '16:00:00', '#', '2024-06-10 23:54:22', '2024-06-10 23:55:25'),
(7, 86, 'Lab', 'WED', '14:00:00', '17:00:00', NULL, '2024-06-10 23:54:43', '2024-06-10 23:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '2023-01-14 00:05:13', '2023-01-14 00:05:13'),
(4, 2, 1, '2023-01-14 00:40:45', '2023-01-14 00:40:45'),
(5, 2, 1, '2023-01-14 00:40:46', '2023-01-14 00:40:46'),
(6, 2, 1, '2023-01-14 00:40:48', '2023-01-14 00:40:48'),
(7, 2, 1999, '2023-01-14 00:40:53', '2023-01-14 00:40:53'),
(8, 2, 1999, '2023-01-14 00:40:55', '2023-01-14 00:40:55'),
(9, 2, 1999999, '2023-01-14 00:40:57', '2023-01-14 00:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `writtens`
--

CREATE TABLE `writtens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `writtens`
--

INSERT INTO `writtens` (`id`, `instructor_id`, `course_id`, `name`, `answer`, `points`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'q 51555555', 'qn51555555', 11, NULL, '2022-12-10 03:46:06', '2023-02-07 17:45:42'),
(2, 1, 4, 'qwe', 'sdadsads', 2, NULL, '2022-12-10 03:46:06', '2022-12-10 03:46:06'),
(3, 2, 5, 'q 51555555', 'qn51555555', 11, NULL, '2022-12-14 12:14:07', '2022-12-15 12:39:49'),
(4, 2, 5, 'q 512', 'qn512', 1, NULL, '2022-12-14 12:14:07', '2022-12-14 12:14:07'),
(5, 2, 5, 'q 51555555', 'qn51555555', 11, NULL, '2022-12-19 03:17:33', '2023-01-18 05:16:55'),
(6, 2, 5, 'q 512', 'qn512', 1, NULL, '2022-12-19 03:17:33', '2022-12-19 03:17:33'),
(14, 3, 17, 'gg', 'gggg', 1, NULL, '2023-01-18 21:37:33', '2023-01-18 21:37:33'),
(15, 3, 17, 'gg', 'gggg', 1, NULL, '2023-01-18 21:37:36', '2023-01-18 21:37:36'),
(16, 3, 17, 'gg', 'gggg', 1, NULL, '2023-01-18 21:37:37', '2023-01-18 21:37:37'),
(17, 3, 17, 'gg', 'gggg', 1, NULL, '2023-01-18 21:37:38', '2023-01-18 21:37:38'),
(18, 3, 17, 'gg', 'gggg', 1, NULL, '2023-01-18 21:37:43', '2023-01-18 21:37:43'),
(22, 3, 17, 'g', 'g', 1, NULL, '2023-01-18 21:38:35', '2023-01-18 21:38:35'),
(24, 3, 29, 'gg', 'gg', 1, NULL, '2023-01-18 22:21:04', '2023-01-18 22:21:04'),
(25, 3, 29, 'gg', 'gg', 1, NULL, '2023-01-18 22:21:13', '2023-01-18 22:21:13'),
(28, 9, 5, 'q 51', 'qn51', 1, NULL, '2023-02-18 12:35:43', '2023-02-18 12:35:43'),
(29, 9, 5, 'q 512', 'qn512', 1, NULL, '2023-02-18 12:35:43', '2023-02-18 12:35:43'),
(30, 9, 78, 'q 51gg', 'g', 1, NULL, '2023-02-18 12:35:55', '2023-02-26 13:57:40'),
(31, 9, 78, 'q 512', 'gg', 1, NULL, '2023-02-18 12:35:55', '2023-02-26 13:53:20'),
(33, 9, 78, 'What is Bangladeshi currency name?', 'Taka', 1, 'images/written/1758872750181433.png', '2023-02-26 13:09:27', '2023-02-26 14:11:49'),
(36, 10, 78, 'gg', 'gg', 1, 'images/written/1758875913086418.jpg', '2023-02-26 13:59:44', '2023-02-26 13:59:44'),
(37, 10, 78, 'gg', 'gg', 1, 'images/written/1758877168839604.pdf', '2023-02-26 14:19:41', '2023-02-26 14:19:41'),
(38, 10, 78, 'g', 'g', 1, 'images/written/1758882532632287.pdf', '2023-02-26 15:44:56', '2023-02-26 15:44:56'),
(39, 10, 78, 'gg', 'gg', 1, 'images/written/1758882614337825.pdf', '2023-02-26 15:46:14', '2023-02-26 15:46:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adcategories`
--
ALTER TABLE `adcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_role_id_foreign` (`role_id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affiliates_email_unique` (`email`),
  ADD UNIQUE KEY `affiliates_phone_unique` (`phone`);

--
-- Indexes for table `affiliate_click_counts`
--
ALTER TABLE `affiliate_click_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authors_instructor_id_foreign` (`instructor_id`),
  ADD KEY `authors_course_id_foreign` (`course_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `childcategories`
--
ALTER TABLE `childcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `childcategories_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `childsubcategories`
--
ALTER TABLE `childsubcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `childsubcategories_childcategory_id_foreign` (`childcategory_id`);

--
-- Indexes for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `cv_achievements`
--
ALTER TABLE `cv_achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_education`
--
ALTER TABLE `cv_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_interests`
--
ALTER TABLE `cv_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_languages`
--
ALTER TABLE `cv_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_references`
--
ALTER TABLE `cv_references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_skills`
--
ALTER TABLE `cv_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv_socials`
--
ALTER TABLE `cv_socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructors_email_unique` (`email`),
  ADD UNIQUE KEY `instructors_phone_unique` (`phone`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liveclasses`
--
ALTER TABLE `liveclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq`
--
ALTER TABLE `mcq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_options`
--
ALTER TABLE `mcq_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`student_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`course_id`,`video_id`);

--
-- Indexes for table `promovideos`
--
ALTER TABLE `promovideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizsubmits`
--
ALTER TABLE `quizsubmits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizsubmit_answers`
--
ALTER TABLE `quizsubmit_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_options`
--
ALTER TABLE `quiz_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_options_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `rating_reviews`
--
ALTER TABLE `rating_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_course` (`user_id`,`course_id`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_links`
--
ALTER TABLE `share_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentbenefits`
--
ALTER TABLE `studentbenefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekschedules`
--
ALTER TABLE `weekschedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `writtens`
--
ALTER TABLE `writtens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `writtens_instructor_id_foreign` (`instructor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adcategories`
--
ALTER TABLE `adcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `affiliate_click_counts`
--
ALTER TABLE `affiliate_click_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `childcategories`
--
ALTER TABLE `childcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `childsubcategories`
--
ALTER TABLE `childsubcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `cv_achievements`
--
ALTER TABLE `cv_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cv_education`
--
ALTER TABLE `cv_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv_interests`
--
ALTER TABLE `cv_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cv_languages`
--
ALTER TABLE `cv_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cv_references`
--
ALTER TABLE `cv_references`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cv_skills`
--
ALTER TABLE `cv_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv_socials`
--
ALTER TABLE `cv_socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `liveclasses`
--
ALTER TABLE `liveclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mcq`
--
ALTER TABLE `mcq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcq_options`
--
ALTER TABLE `mcq_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `promovideos`
--
ALTER TABLE `promovideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quizsubmits`
--
ALTER TABLE `quizsubmits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `quizsubmit_answers`
--
ALTER TABLE `quizsubmit_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `quiz_options`
--
ALTER TABLE `quiz_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `rating_reviews`
--
ALTER TABLE `rating_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `share_links`
--
ALTER TABLE `share_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentbenefits`
--
ALTER TABLE `studentbenefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `weekschedules`
--
ALTER TABLE `weekschedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `writtens`
--
ALTER TABLE `writtens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `authors_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `authors_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`);

--
-- Constraints for table `childcategories`
--
ALTER TABLE `childcategories`
  ADD CONSTRAINT `childcategories_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `childsubcategories`
--
ALTER TABLE `childsubcategories`
  ADD CONSTRAINT `childsubcategories_childcategory_id_foreign` FOREIGN KEY (`childcategory_id`) REFERENCES `childcategories` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `quiz_options`
--
ALTER TABLE `quiz_options`
  ADD CONSTRAINT `quiz_options_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `writtens`
--
ALTER TABLE `writtens`
  ADD CONSTRAINT `writtens_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
