-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2025 at 09:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matrilab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@site.com', 'admin', NULL, '68ca8350c4ee61758102352.png', '$2y$12$1Vj0.NDKbMYfRNWpbBPI.ugQV9eOOA8iV535CCYZE15q1M6se.LvK', 'nxOukpTD5dpiSfPHvUHul9c1CalgOYVqUzl0vaQGrF7KlmP3hb2IjvIOx0Ly', NULL, '2025-09-17 03:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basic_infos`
--

CREATE TABLE `basic_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `gender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial_condition` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking_status` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `drinking_status` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `birth_date` date DEFAULT NULL,
  `language` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]',
  `marital_status` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `permanent_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_infos`
--

CREATE TABLE `career_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` year DEFAULT NULL,
  `end` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_views`
--

CREATE TABLE `contact_views` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `contact_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `interest_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender_id` int UNSIGNED NOT NULL DEFAULT '0',
  `receiver_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `purchase_id` int UNSIGNED NOT NULL DEFAULT '0',
  `method_code` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `is_web` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'This will be 1 if the request is from NextJs application',
  `admin_feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `success_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `is_app` tinyint(1) NOT NULL DEFAULT '0',
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education_infos`
--

CREATE TABLE `education_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT '0',
  `degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_of_study` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_no` int DEFAULT '0',
  `roll_no` int DEFAULT '0',
  `out_of` decimal(8,2) DEFAULT '0.00',
  `result` decimal(8,2) DEFAULT '0.00',
  `start` year DEFAULT NULL,
  `end` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-03-22 05:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"------------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"-----------------\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2025-09-17 03:35:37'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2024-06-29 23:23:37'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{measurement_id}}\"></script>\n <script>\n window.dataLayer = window.dataLayer || [];\n function gtag(){dataLayer.push(arguments);}\n gtag(\"js\", new Date());\n \n gtag(\"config\", \"{{measurement_id}}\");\n </script>', '{\"measurement_id\":{\"title\":\"Measurement ID\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.png', 0, NULL, '2022-03-22 05:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `family_infos`
--

CREATE TABLE `family_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_profession` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_contact` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_profession` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_contact` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_brother` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `total_sister` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"matrimony\",\"matrilab\",\"viserlab\",\"platform\",\"ultimate\",\"marketplace\",\"social\",\"post\",\"bride\",\"bridegroom\",\"marriage\",\"plans\",\"package\",\"smart\",\"image\",\"gallery\",\"profile\",\"people\",\"option\",\"member\",\"partner\",\"life partner\",\"script\",\"php\",\"laravel\"],\"description\":\"No need to search thousands of providers to manage your business. Concept to design-development, domain-hosting to marketing, we provide all.\",\"social_title\":\"MatriLab - The Ultimate Matchmaking Matrimony Platform\",\"social_description\":\"No need to search thousands of providers to manage your business. Concept to design-development, domain-hosting to marketing, we provide all.\",\"image\":\"66826c27566601719823399.png\"}', NULL, 'basic', '', '2020-07-04 23:42:52', '2024-07-01 02:51:27'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"About Us\",\"description\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. posuere cubilia Curae In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor suscipit eget imperdiet nec imperdiet ialisn ipsum. Sed aliquam ultrices mauris. Integer ante arcu consectetuer.\",\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=WOb4cj7izpE\",\"button_text\":\"See More\",\"button_url\":\"\\/packages\",\"image\":\"63956c786a7b41670737016.png\"}', NULL, 'basic', NULL, '2020-10-28 00:51:20', '2022-12-11 05:36:56'),
(25, 'stories.content', '{\"heading\":\"Success Stories\",\"subheading\":\"Our successfull stories are too verse. These are awesome, romantic, like a dream.\"}', NULL, 'basic', NULL, '2020-10-28 00:51:34', '2022-12-11 06:08:59'),
(27, 'contact_us.content', '{\"has_image\":\"1\",\"title\":\"Get In Touch With Us\",\"office_address_title\":\"Office Address\",\"office\":\"4517 Washington Ave. Kentucky\",\"email_address_title\":\"Email Address\",\"email\":\"democompany@gmail.com\",\"contact_number_title\":\"Contact Number\",\"contact_number\":\"7890 - 5678 - 2345\",\"button_text\":\"Send Message\",\"image\":\"62a02eaa8f2841654664874.png\"}', NULL, 'basic', NULL, '2020-10-28 00:59:19', '2023-01-04 03:52:44'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', NULL, 'basic', NULL, '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(39, 'banner.content', '{\"subheading\":\"Find Your Perfect Life partner With Us\",\"button_text\":\"Success Stories\",\"button_url\":\"\\/stories\"}', NULL, 'basic', NULL, '2021-05-02 06:09:30', '2022-12-22 13:49:13'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; color: rgb(54, 54, 54); text-align: center; font-family: Exo, sans-serif;\\\"><font size=\\\"6\\\">Cookie Policy<\\/font><\\/h3><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', NULL, 'basic', NULL, '2020-07-04 23:42:52', '2022-12-25 10:07:49'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div>\\r\\n    <h3 style=\\\"text-align:center;\\\">\\r\\n        <font size=\\\"6\\\">Privacy Policy<\\/font>\\r\\n    <\\/h3>\\r\\n    <h3>What\\r\\n        Information do we collect?<\\/h3>\\r\\n    <p>We gather data from you when you\\r\\n        register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the\\r\\n        point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter\\r\\n        your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>How do\\r\\n        we protect your information?<\\/h3>\\r\\n    <p>All provided delicate\\/credit data is\\r\\n        sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials,\\r\\n        and so on) won\'t be put away on our workers.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Do we\\r\\n        disclose any information to outside parties?<\\/h3>\\r\\n    <p>We don\'t sell, exchange, or in any case\\r\\n        move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in\\r\\n        working our site, leading our business, or adjusting you, since those gatherings consent to keep this data\\r\\n        private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our\\r\\n        site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Children\'s Online Privacy Protection Act Compliance<\\/h3>\\r\\n    <p>We are consistent with the prerequisites\\r\\n        of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old.\\r\\n        Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of\\r\\n        age or more established.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Changes\\r\\n        to our Privacy Policy<\\/h3>\\r\\n    <p>If we decide to change our privacy\\r\\n        policy, we will post those changes on this page.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>How long\\r\\n        we retain your information?<\\/h3>\\r\\n    <p>At the point when you register for our\\r\\n        site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw\\r\\n        yourself (subject to laws and guidelines).<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>What we\\r\\n        don\\u2019t do with your data<\\/h3>\\r\\n    <p>We don\'t and will never share, unveil,\\r\\n        sell, or in any case give your information to different organizations for the promoting of their items or\\r\\n        administrations.<\\/p>\\r\\n<\\/div>\"}', NULL, 'basic', 'privacy-policy', '2021-06-09 08:50:42', '2024-07-01 02:56:50'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<blockquote>\\r\\n    <div>\\r\\n        <h1 style=\\\"text-align:center;\\\">\\r\\n            <font size=\\\"5\\\">Terms Of Service<\\/font>\\r\\n        <\\/h1>\\r\\n    <\\/div>\\r\\n<\\/blockquote>\\r\\n<div>\\r\\n    <p><span>We claim all authority to dismiss,\\r\\n            end, or handicap any help with or without cause per administrator discretion. This is a Complete independent\\r\\n            facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by\\r\\n            submitting solicitations or protests we will impair your record. The solitary time you should reach us about\\r\\n            the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and\\r\\n            everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything\\r\\n            contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your\\r\\n            time by joining on the off chance that you figure you will have the option to sneak by us and break the\\r\\n            terms.<\\/span><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Configuration requests - If you have a fully\\r\\n            managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs,\\r\\n            DNS, and httpd configurations.<\\/li>\\r\\n        <li>Software requests - Cpanel Extension Installation\\r\\n            will be granted as long as it does not interfere with the security, stability, and performance of other\\r\\n            users on the server.<\\/li>\\r\\n        <li>Emergency Support - We do not provide emergency\\r\\n            support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li>\\r\\n        <li>Webmaster help - We do not offer any support for\\r\\n            webmaster related issues and difficulty including coding, & installs, Error solving. if there is an\\r\\n            issue where a library or configuration of the server then we can help you if it\'s possible from our end.\\r\\n        <\\/li>\\r\\n        <li>Backups - We keep backups but we are not\\r\\n            responsible for data loss, you are fully responsible for all backups.<\\/li>\\r\\n        <li>We Don\'t support any child porn or such material.\\r\\n        <\\/li>\\r\\n        <li>No spam-related sites or material, such as email\\r\\n            lists, mass mail programs, and scripts, etc.<\\/li>\\r\\n        <li>No harassing material that may cause people to\\r\\n            retaliate against you.<\\/li>\\r\\n        <li>No phishing pages.<\\/li>\\r\\n        <li>You may not run any exploitation script from the\\r\\n            server. reason can be terminated immediately.<\\/li>\\r\\n        <li>If Anyone attempting to hack or exploit the server\\r\\n            by using your script or hosting, we will terminate your account to keep safe other users.<\\/li>\\r\\n        <li>Malicious Botnets are strictly forbidden.<\\/li>\\r\\n        <li>Spam, mass mailing, or email marketing in any way\\r\\n            are strictly forbidden here.<\\/li>\\r\\n        <li>Malicious hacking materials, trojans, viruses,\\r\\n            & malicious bots running or for download are forbidden.<\\/li>\\r\\n        <li>Resource and cronjob abuse is forbidden and will\\r\\n            result in suspension or termination.<\\/li>\\r\\n        <li>Php\\/CGI proxies are strictly forbidden.<\\/li>\\r\\n        <li>CGI-IRC is strictly forbidden.<\\/li>\\r\\n        <li>No fake or disposal mailers, mass mailing, mail\\r\\n            bombers, SMS bombers, etc.<\\/li>\\r\\n        <li>NO CREDIT OR REFUND will be granted for\\r\\n            interruptions of service, due to User Agreement violations.<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Terms\\r\\n        & Conditions for Users<\\/h3>\\r\\n    <p>Before getting to this site, you are\\r\\n        consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and\\r\\n        guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you\\r\\n        disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Support\\r\\n    <\\/h3>\\r\\n    <p>Whenever you have downloaded our item,\\r\\n        you may get in touch with us for help through email and we will give a valiant effort to determine your issue.\\r\\n        We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center\\r\\n        bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and\\r\\n        Livechat.<\\/p>\\r\\n    <p>On the off chance\\r\\n        that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p>\\r\\n    <ul>\\r\\n        <li>Hang tight for additional update discharge.<\\/li>\\r\\n        <li>Or on the other hand, enlist a specialist (We offer\\r\\n            customization for extra charges).<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Ownership<\\/h3>\\r\\n    <p>You may not guarantee scholarly or\\r\\n        selective possession of any of our items, altered or unmodified. All items are property, we created them. Our\\r\\n        items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no\\r\\n        occasion will our juridical individual be subject to any harms including, however not restricted to, immediate,\\r\\n        roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the\\r\\n        utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Warranty\\r\\n    <\\/h3>\\r\\n    <p>We don\'t offer any guarantee or\\r\\n        assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with\\r\\n        all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show\\r\\n        formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component,\\r\\n        as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Unauthorized\\/Illegal Usage<\\/h3>\\r\\n    <p>You may not utilize our things for any\\r\\n        illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale\\r\\n        (counting yet not restricted to copyright laws) just as the laws of your nation and International law.\\r\\n        Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality,\\r\\n        illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming\\r\\n        joins.<\\/p><p><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of\\r\\n        the offered on our things, or admittance to the administration without the express composed consent by us or\\r\\n        item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement\\r\\n        that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we\\r\\n        will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for\\r\\n        keeping up the security of your record, and you are completely answerable for all exercises that happen under\\r\\n        the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved\\r\\n        employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Fiverr,\\r\\n        Seoclerks Sellers Or Affiliates<\\/h3>\\r\\n    <p>We do NOT ensure full SEO campaign\\r\\n        conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment\\r\\n        to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of\\r\\n        assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires\\r\\n        time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Payment\\/Refund Policy<\\/h3>\\r\\n    <p>No refund or cash back will be made.\\r\\n        After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on\\r\\n        requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t\\r\\n        document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or\\r\\n        chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you\\r\\n        from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your\\r\\n        record. There are no special cases.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Free\\r\\n        Balance \\/ Coupon Policy<\\/h3>\\r\\n    <p>We offer numerous approaches to get FREE\\r\\n        Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your\\r\\n        record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free\\r\\n        Balance from your record balance, and your record balance becomes negative, at that point the record will\\r\\n        naturally be suspended. If your record is suspended because of a negative Balance you can request to make a\\r\\n        custom payment to settle your equilibrium to actuate your record.<\\/p>\\r\\n<\\/div>\"}', NULL, 'basic', 'terms-of-service', '2021-06-09 08:51:18', '2024-07-01 02:55:41'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div>\",\"image\":\"66826bfd250061719823357.png\"}', NULL, 'basic', NULL, '2020-07-04 23:42:52', '2024-07-01 02:42:37'),
(52, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, 'basic', NULL, '2022-06-06 09:26:22', '2022-06-06 09:39:35'),
(53, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\\/\"}', NULL, 'basic', NULL, '2022-06-06 09:26:52', '2022-06-06 09:40:30'),
(54, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 'basic', NULL, '2022-06-06 09:27:18', '2022-06-06 09:40:19'),
(55, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"fab fa-linkedin\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', NULL, 'basic', NULL, '2022-06-06 09:27:44', '2022-06-06 09:40:03'),
(56, 'about.element', '{\"item\":\"Contact genuine profiles\",\"icon\":\"<i class=\\\"fas fa-id-card-alt\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-06 10:28:26', '2022-12-11 05:38:20'),
(57, 'about.element', '{\"item\":\"Find perfect match quite easily\",\"icon\":\"<i class=\\\"fas fa-comments\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-06 10:29:48', '2022-12-11 05:38:42'),
(58, 'about.element', '{\"item\":\"100% security for data and Profile\",\"icon\":\"<i class=\\\"fas fa-box-open\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-06 10:30:14', '2022-12-11 05:39:03'),
(59, 'about.element', '{\"item\":\"Trusted Matrimonial agency in the world\",\"icon\":\"<i class=\\\"fas fa-shield-alt\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-06 10:30:42', '2022-12-11 05:39:19'),
(60, 'package.content', '{\"heading\":\"Matrimonial Package\",\"subheading\":\"Every user have their own package. Anyone can upgrade package or buy package through online payment system.\"}', NULL, 'basic', NULL, '2022-06-06 10:56:05', '2022-06-07 02:22:33'),
(65, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"63a6901b3b07c1671860251.png\"}', NULL, 'basic', NULL, '2022-06-06 11:38:46', '2022-12-24 05:37:32'),
(66, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"63a69026304041671860262.png\"}', NULL, 'basic', NULL, '2022-06-06 11:39:00', '2022-12-24 05:37:43'),
(67, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"63a6908a201171671860362.png\"}', NULL, 'basic', NULL, '2022-06-06 11:39:24', '2022-12-24 05:39:24'),
(68, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"63a69073ad0371671860339.png\"}', NULL, 'basic', NULL, '2022-06-06 11:39:41', '2022-12-24 05:39:01'),
(69, 'how_it_work.content', '{\"has_image\":\"1\",\"heading\":\"How It Work\",\"subheading\":\"This site facilitate to find your dream partner.  There are some step to finding your best partner. If you wanna be a partner, or want to find your best partner, please follow the process as we suggested here.\",\"background_image\":\"63a690c6f24c61671860422.png\"}', NULL, 'basic', NULL, '2022-06-07 03:22:39', '2022-12-24 05:40:23'),
(70, 'how_it_work.element', '{\"title\":\"Create Account\",\"description\":\"Curabitur ligula sapien tincidunod vitae, posuere imperdiet leonas malesuada Praesent congue.\",\"icon\":\"<i class=\\\"fas fa-user\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 03:23:13', '2022-06-07 03:23:13'),
(71, 'how_it_work.element', '{\"title\":\"Search Your Partner\",\"description\":\"Curabitur ligula sapien tincidunod vitae, posuere imperdiet leonas malesuada Praesent congue.\",\"icon\":\"<i class=\\\"fas fa-search\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 03:23:54', '2022-06-07 03:23:54'),
(72, 'how_it_work.element', '{\"title\":\"Start Communication\",\"description\":\"Start communication with your partner. These option are available here.\",\"icon\":\"<i class=\\\"fas fa-comments\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 03:25:22', '2022-06-07 03:25:22'),
(73, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Odette Talley\",\"designation\":\"Et aliquid deleniti\",\"speech\":\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"star\":\"5\",\"profile_picture\":\"629eea35a0ebd1654581813.jpg\"}', NULL, 'basic', NULL, '2022-06-07 04:05:04', '2022-06-07 04:33:33'),
(74, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Jackson Guerrero\",\"designation\":\"Business Man\",\"speech\":\"Here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.\",\"star\":\"5\",\"profile_picture\":\"629eea45948561654581829.jpg\"}', NULL, 'basic', NULL, '2022-06-07 04:05:40', '2022-06-07 04:33:49'),
(75, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Ursula Crane\",\"designation\":\"Software Engineer\",\"speech\":\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.\",\"star\":\"4\",\"profile_picture\":\"629eea57d1e2d1654581847.png\"}', NULL, 'basic', NULL, '2022-06-07 04:06:16', '2022-06-07 04:34:07'),
(76, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Caleb Delaney\",\"designation\":\"Scientist\",\"speech\":\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms.\",\"star\":\"5\",\"profile_picture\":\"629eea654f1861654581861.png\"}', NULL, 'basic', NULL, '2022-06-07 04:07:38', '2022-06-07 04:34:21'),
(77, 'testimonial.content', '{\"heading\":\"Testimonials\",\"subheading\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since.\"}', NULL, 'basic', NULL, '2022-06-07 04:11:41', '2022-06-07 04:11:41'),
(78, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"Ken and Berbie\",\"total_view\":296,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa80fb28da1672128527.png\"}', NULL, 'basic', 'ken-and-berbie', '2022-06-07 04:44:13', '2024-06-30 22:50:47'),
(79, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"Libero consequuntur\",\"total_view\":402,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa8197b1941672128537.png\"}', NULL, 'basic', 'libero-consequuntur', '2022-06-07 04:46:02', '2024-06-30 22:50:46'),
(80, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"Doloribus debitis\",\"total_view\":370,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa821432b01672128545.png\"}', NULL, 'basic', 'doloribus-debitis', '2022-06-07 04:46:35', '2024-07-01 05:32:14'),
(81, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"Exercitation in id m\",\"total_view\":270,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa82929e9d1672128553.png\"}', NULL, 'basic', 'exercitation-in-id-m', '2022-06-07 05:17:43', '2024-06-30 22:50:44'),
(82, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"Esse laboriosam fu\",\"total_view\":342,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa835eaa581672128565.png\"}', NULL, 'basic', 'esse-laboriosam-fu', '2022-06-07 05:18:27', '2024-07-01 05:32:14'),
(83, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"David and Jonnas\",\"total_view\":499,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa8491258e1672128585.png\"}', NULL, 'basic', 'david-and-jonnas', '2022-06-07 05:19:01', '2024-07-01 04:51:53'),
(84, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"William and Sofia\",\"total_view\":516,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa852703aa1672128594.png\"}', NULL, 'basic', 'william-and-sofia', '2022-06-07 05:19:49', '2024-07-01 00:46:39'),
(85, 'stories.element', '{\"has_image\":[\"1\"],\"title\":\"Elina and Torrens\",\"total_view\":649,\"description\":\"<div><span style=\\\"font-size:1rem;\\\">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, cupiditate earum expedita odio libero recusandae officiis vitae, nam qui similique cum placeat enim facilis excepturi! Atque beatae repudiandae, eligendi soluta sequi corrupti ullam culpa facilis iure quae? Perferendis excepturi provident itaque asperiores molestias tempora, ipsam magnam quo est eum eius dolores nisi suscipit sapiente voluptas dicta, quos illum deleniti iste. Laudantium enim deserunt illum sint veritatis iusto dolorum suscipit fuga magnam labore,<\\/span><br \\/><\\/div><div><br \\/><\\/div><div>alias eius ab quidem ad quibusdam placeat blanditiis rem quo vero illo debitis soluta reiciendis inventore excepturi. Error velit suscipit accusamus mollitia odit perferendis iusto quisquam in, deserunt veritatis, at sequi cumque eveniet dolorem iure perspiciatis libero ad reiciendis veniam repellendus,<\\/div><div>nihil adipisci laboriosam dolor provident. Consectetur numquam cum, at dolores et recusandae fuga quos distinctio accusantium itaque facere, magnam deserunt illo. Aspernatur minus obcaecati ab voluptates error laboriosam animi deserunt omnis consectetur pariatur, magnam fugit quos esse, reiciendis at veniam expedita impedit. Rem dolor incidunt, repudiandae velit officiis dolore voluptate error enim facilis debitis obcaecati quod eum minima quae culpa eius explicabo animi esse. Dolore harum dolores, cupiditate, voluptatum suscipit magni eligendi nobis non consectetur, adipisci in ratione culpa similique assumenda laborum quasi sed! Quam, saepe temporibus.<\\/div><div><br \\/><\\/div>\",\"image\":\"63aaa8be6ab9a1672128702.png\"}', NULL, 'basic', 'elina-and-torrens', '2022-06-07 05:20:50', '2025-09-17 03:24:38'),
(86, 'footer.content', '{\"title\":\"About Us\",\"description\":\"Our site is flexible for both men and women. In this modern era, it is very possible to choose your partner and fill comfortable.\"}', NULL, 'basic', NULL, '2022-06-07 06:58:11', '2022-12-24 05:58:40'),
(87, 'mobile_app.content', '{\"has_image\":\"1\",\"heading\":\"Download Mobile App\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante.\",\"description\":\"posuere cubilia Curae In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor suscipit eget imperdiet nec imperdiet ialisn ipsum. Sed aliquam ultrices mauris. Integer ante arcu consectetuer.\",\"right_side_image\":\"63aacbff2bc9d1672137727.png\"}', NULL, 'basic', NULL, '2022-06-07 09:36:25', '2022-12-27 10:42:07'),
(88, 'counter.element', '{\"title\":\"Latest Profile\",\"digits\":\"5870\",\"icon\":\"<i class=\\\"fas fa-user-alt\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 09:54:30', '2022-12-11 07:14:44'),
(89, 'counter.element', '{\"title\":\"Successful Stories\",\"digits\":\"3069\",\"icon\":\"<i class=\\\"fas fa-check\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 09:55:47', '2022-12-11 07:14:51'),
(90, 'counter.element', '{\"title\":\"Happy Users\",\"digits\":\"3945\",\"icon\":\"<i class=\\\"fas fa-smile-beam\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 09:56:39', '2022-12-11 07:14:58'),
(91, 'counter.element', '{\"title\":\"Our Achievement\",\"digits\":\"4890\",\"icon\":\"<i class=\\\"fas fa-user-friends\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-06-07 09:57:17', '2022-12-11 07:15:05'),
(92, 'faq.element', '{\"question\":\"What is Matrimonial site?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:02:13', '2022-12-11 08:35:05'),
(93, 'faq.element', '{\"question\":\"How it works?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:02:22', '2022-12-11 08:35:54'),
(94, 'faq.element', '{\"question\":\"What is our stories?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:02:30', '2022-12-11 08:36:08'),
(95, 'faq.element', '{\"question\":\"How will have make partner ?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:02:39', '2022-12-11 08:36:34'),
(96, 'faq.element', '{\"question\":\"What\'s about package ?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:02:46', '2022-12-11 08:37:51'),
(98, 'faq.element', '{\"question\":\"How to purchase package?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:03:06', '2022-12-11 08:38:04'),
(100, 'faq.element', '{\"question\":\"Is it age restricted?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:03:22', '2022-12-11 08:38:18');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(101, 'faq.element', '{\"question\":\"What about our services?\",\"answer\":\"This is the first item\'s accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.\"}', NULL, 'basic', NULL, '2022-06-08 05:03:29', '2022-12-11 08:38:56'),
(114, 'login.content', '{\"heading\":\"Login to your account\",\"subheading\":\"Please input your username and password and login to your account to get access to your dashboard.\"}', NULL, 'basic', NULL, '2022-06-08 05:41:09', '2022-12-11 08:46:43'),
(115, 'register.content', '{\"heading\":\"Create an account\",\"subheading\":\"Please Provide your valid informations to register!\"}', NULL, 'basic', NULL, '2022-06-08 05:58:39', '2022-12-11 08:49:28'),
(120, 'mobile_app.element', '{\"has_image\":\"1\",\"link\":\"https:\\/\\/play.google.com\\/store\\/games\",\"link_image\":\"639580215695c1670742049.png\"}', NULL, 'basic', NULL, '2022-12-11 07:00:49', '2022-12-11 07:00:49'),
(121, 'mobile_app.element', '{\"has_image\":\"1\",\"link\":\"https:\\/\\/www.apple.com\\/store\",\"link_image\":\"63958040e43a31670742080.png\"}', NULL, 'basic', NULL, '2022-12-11 07:01:20', '2022-12-11 07:01:20'),
(122, 'faq.content', '{\"heading\":\"Frequently Asked Question\",\"subheading\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\"}', NULL, 'basic', NULL, '2022-12-11 08:28:15', '2022-12-11 08:32:48'),
(123, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"63a690381ba811671860280.png\"}', NULL, 'basic', NULL, '2022-12-22 13:45:31', '2022-12-24 05:38:01'),
(127, 'policy_pages.element', '{\"title\":\"Purchase Policy\",\"details\":\"<div>\\r\\n    <h3 style=\\\"text-align:center;\\\">\\r\\n        <font size=\\\"6\\\">Package Purchase Policy<\\/font>\\r\\n    <\\/h3>\\r\\n    <h3>What\\r\\n        Information do we collect?<\\/h3>\\r\\n    <p>We gather data from you when you\\r\\n        register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the\\r\\n        point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter\\r\\n        your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>How do\\r\\n        we protect your information?<\\/h3>\\r\\n    <p>All provided delicate\\/credit data is\\r\\n        sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials,\\r\\n        and so on) won\'t be put away on our workers.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Do we\\r\\n        disclose any information to outside parties?<\\/h3>\\r\\n    <p>We don\'t sell, exchange, or in any case\\r\\n        move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in\\r\\n        working our site, leading our business, or adjusting you, since those gatherings consent to keep this data\\r\\n        private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our\\r\\n        site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Children\'s Online Privacy Protection Act Compliance<\\/h3>\\r\\n    <p>We are consistent with the prerequisites\\r\\n        of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old.\\r\\n        Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of\\r\\n        age or more established.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Changes\\r\\n        to our Privacy Policy<\\/h3>\\r\\n    <p>If we decide to change our privacy\\r\\n        policy, we will post those changes on this page.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>How long\\r\\n        we retain your information?<\\/h3>\\r\\n    <p>At the point when you register for our\\r\\n        site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw\\r\\n        yourself (subject to laws and guidelines).<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>What we\\r\\n        don\\u2019t do with your data<\\/h3>\\r\\n    <p>We don\'t and will never share, unveil,\\r\\n        sell, or in any case give your information to different organizations for the promoting of their items or\\r\\n        administrations.<\\/p>\\r\\n<\\/div>\"}', NULL, 'basic', 'purchase-policy', '2022-12-24 05:54:16', '2024-07-01 02:53:45'),
(159, 'kyc_instruction.content', '{\"verification_instruction\":\"KYC is a mandatory process for identifying and verifying the identity of the client when viewing partner contact using our site. After providing all of the information requested by the administrator, one of our administrators will verify it and declare you as KYC verified.\",\"pending_instruction\":\"Please be patient. Your KYC data has been accepted, one of our administrators will verify the authenticity and declare you as KYC verified.\"}', NULL, 'basic', NULL, '2022-11-12 21:28:03', '2022-12-26 15:35:00'),
(160, 'kyc.content', '{\"required\":\"Complete KYC to unlock the full potential of our platform! KYC helps us verify your identity and keep things secure. It is quick and easy just follow the on-screen instructions. Get started with KYC verification now!\",\"pending\":\"Your KYC verification is being reviewed. We might need some additional information. You will get an email update soon. In the meantime, explore our platform with limited features.\",\"reject\":\"We regret to inform you that the Know Your Customer (KYC) information provided has been reviewed and unfortunately, it has not met our verification standards.\"}', NULL, 'basic', '', '2024-07-01 01:34:50', '2024-07-01 01:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '663a38d7b455d1715091671.png', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"----------------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:47'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '663a3920e30a31715091744.png', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"----------------\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:08'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '663a39861cb9d1715091846.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:23'),
(4, 0, 104, 'Skrill', 'Skrill', '663a39494c4a91715091785.png', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:16'),
(5, 0, 105, 'PayTM', 'Paytm', '663a390f601191715091727.png', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"----------------\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"----------------\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"----------------\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"----------------\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"----------------\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"----------------\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:05'),
(6, 0, 106, 'Payeer', 'Payeer', '663a38c9e2e931715091657.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:45'),
(7, 0, 107, 'PayStack', 'Paystack', '663a38fc814e91715091708.png', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\",\"GHS\":\"GHS\",\"KES\":\"KES\",\"ZAR\":\"ZAR\",\"XOF\":\"XOF\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:56'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '663a36c2c34d61715091138.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:12:18'),
(10, 0, 110, 'RazorPay', 'Razorpay', '663a393a527831715091770.png', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"----------------\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"----------------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:11'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '663a3995417171715091861.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:26'),
(12, 0, 112, 'Instamojo', 'Instamojo', '663a384d54a111715091533.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"----------------\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"----------------\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"----------------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:26'),
(13, 0, 501, 'Blockchain', 'Blockchain', '663a35efd0c311715090927.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"----------------\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:46:54'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '663a36a8d8e1d1715091112.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2024-05-07 08:11:52'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '663a36b7b841a1715091127.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:19'),
(17, 0, 505, 'Coingate', 'Coingate', '663a368e753381715091086.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:13'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '663a367e46ae51715091070.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:09'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '663a38ed101a61715091693.png', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"----------------\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:52'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '663a39afb519f1715091887.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"----------------\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2024-07-01 02:48:35'),
(27, 0, 115, 'Mollie', 'Mollie', '663a387ec69371715091582.png', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"----------------\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"----------------\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-07-01 02:47:35'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '663a361b16bd11715090971.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"----------------\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2024-07-01 02:47:01'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '663a386c714a91715091564.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\",\"ARS\":\"ARS\",\"BRL\":\"BRL\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"MXN\":\"MXN\",\"PEN\":\"PEN\",\"UYU\":\"UYU\",\"VEF\":\"VEF\",\"BOB\":\"BOB\"}', 0, NULL, NULL, NULL, '2024-07-01 02:47:30'),
(37, 0, 120, 'Authorize.net', 'Authorize', '663a35b9ca5991715090873.png', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"-------\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"----------\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-07-01 02:45:49'),
(46, 0, 121, 'NMI', 'NMI', '663a3897754cf1715091607.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2024-07-01 02:47:38'),
(50, 0, 507, 'BTCPay', 'BTCPay', '663a35cd25a8d1715090893.png', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"------------\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"-----------\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"-----------\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"-----------\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2024-07-01 02:46:39'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', '663a38b8d57a81715091640.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2024-05-07 08:20:40'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', '663a38a59d2541715091621.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 1, '', NULL, NULL, '2024-05-07 08:20:21'),
(53, 0, 122, '2Checkout', 'TwoCheckout', '663a39b8e64b91715091896.png', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 0, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2024-07-01 02:48:39'),
(54, 0, 123, 'Checkout', 'Checkout', '663a3628733351715090984.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 08:09:44'),
(56, 0, 510, 'Binance', 'Binance', '663a35db4fd621715090907.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"}}', '{\"BTC\":\"Bitcoin\",\"USD\":\"USD\",\"BNB\":\"BNB\"}', 1, '{\"cron\":{\"title\": \"Cron Job URL\",\"value\":\"ipn.Binance\"}}', NULL, NULL, '2024-07-01 02:46:48'),
(57, 0, 124, 'SslCommerz', 'SslCommerz', '663a397a70c571715091834.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"store_password\":{\"title\":\"Store Password\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"SGD\":\"SGD\",\"INR\":\"INR\",\"MYR\":\"MYR\"}', 0, NULL, NULL, NULL, '2024-05-07 08:23:54'),
(58, 0, 125, 'Aamarpay', 'Aamarpay', '663a34d5d1dfc1715090645.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"signature_key\":{\"title\":\"Signature Key\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2024-05-07 08:04:05'),
(60, 0, 126, 'bKash', 'BKash', '67e1432683b5a1742816038.png', 1, '{\"username\":{\"title\":\"Username\",\"global\":true,\"value\":\"01770618567\"},\"password\":{\"title\":\"Password\",\"global\":true,\"value\":\"D7DaC<*E*eG\"},\"app_key\":{\"title\":\"App Key\",\"global\":true,\"value\":\"0vWQuCRGiUX7EPVjQDr0EUAYtc\"},\"app_secret\":{\"title\":\"App Secret\",\"global\":true,\"value\":\"jcUNPBgbcqEDedNKdvE4G1cAK7D3hCjmJccNPZZBq96QIxxwAMEx\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2025-03-15 21:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `socialite_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `pn` tinyint(1) NOT NULL DEFAULT '1',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT '0',
  `language_status` tinyint(1) NOT NULL DEFAULT '1',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `multi_language` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `available_version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `paginate_number` int NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>Both\r\n2=>Text Only\r\n3=>Symbol Only',
  `config_progress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `default_package_id` int NOT NULL DEFAULT '0',
  `chat_attachment` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_from_name`, `email_template`, `sms_template`, `sms_from`, `push_title`, `push_template`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `firebase_config`, `global_shortcodes`, `socialite_credentials`, `kv`, `ev`, `en`, `sv`, `sn`, `pn`, `force_ssl`, `maintenance_mode`, `language_status`, `secure_password`, `agree`, `multi_language`, `registration`, `active_template`, `last_cron`, `available_version`, `system_customized`, `paginate_number`, `currency_format`, `config_progress`, `default_package_id`, `chat_attachment`, `created_at`, `updated_at`) VALUES
(1, 'MatriLab', 'USD', '$', 'info@viserlab.com', '{{site_name}}', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2024 <a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'ViserAdmin', NULL, NULL, 'fd2c79', 'ed0cbd', '{\"name\":\"php\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', NULL, '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', '{\"google\":{\"client_id\":\"------------------\",\"client_secret\":\"------------------\",\"status\":0},\"facebook\":{\"client_id\":\"-----------------\",\"client_secret\":\"-----------------\",\"status\":0},\"linkedin\":{\"client_id\":\"-------------------\",\"client_secret\":\"-------------------\",\"status\":0}}', 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 'basic', '2024-05-23 10:30:20', '2.2', 0, 20, 1, '[]', 1, 1, NULL, '2025-09-17 03:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `ignored_profiles`
--

CREATE TABLE `ignored_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `ignored_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '66826bdf0b7c11719823327.png', '2020-07-06 03:47:55', '2024-07-01 02:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `marital_statuses`
--

CREATE TABLE `marital_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `conversation_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender_id` int UNSIGNED NOT NULL DEFAULT '0',
  `receiver_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_read` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `push_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `email_sent_from_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent_from_address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subject`, `push_title`, `email_body`, `sms_body`, `push_body`, `shortcodes`, `email_status`, `email_sent_from_name`, `email_sent_from_address`, `sms_status`, `sms_sent_from`, `push_status`, `created_at`, `updated_at`) VALUES
(1, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', NULL, '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 14:47:05'),
(2, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', NULL, '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', NULL, '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-04-04 21:46:35'),
(3, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', NULL, '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', NULL, '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 14:47:51'),
(4, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', NULL, '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', NULL, '{\"code\":\"Email verification code\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-04-02 20:32:07'),
(5, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', NULL, '---', 'Your phone verification code is: {{code}}', NULL, '{\"code\":\"SMS Verification Code\"}', 0, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-03-20 13:24:37'),
(6, 'DEFAULT', 'Default Template', '{{subject}}', NULL, '{{message}}', '{{message}}', NULL, '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, NULL, NULL, 1, NULL, 0, '2019-09-14 07:14:22', '2021-11-04 03:38:55'),
(7, 'KYC_APPROVE', 'KYC Approved', 'KYC has been approved', NULL, NULL, NULL, NULL, '[]', 1, NULL, NULL, 1, NULL, 0, NULL, NULL),
(8, 'KYC_REJECT', 'KYC Rejected', 'KYC has been rejected', NULL, NULL, NULL, NULL, '{\"reason\":\"Rejection Reason\"}', 1, NULL, NULL, 1, NULL, 0, NULL, NULL),
(9, 'PAYMENT_COMPLETE', 'Payment Complete', 'Your payment has been completed', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your payment has been completed.</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Package : {{package}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Your payment has been completed.\r\n\r\nDetails of your payment:\r\n\r\nAmount : {{amount}} {{site_currency}}\r\nCharge: {{charge}} {{site_currency}}\r\n\r\nPaid via :  {{method_name}}\r\nPackage : {{package}}', NULL, '{\r\n    \"method_name\":\"Name of the deposit method\",\r\n    \"package\":\"package name\",\r\n    \"method_currency\":\"Currency of the deposit method\",\r\n    \"method_amount\":\"Amount after conversion between base currency and method currency\",\r\n    \"amount\":\"Amount inserted by the user\",\r\n    \"charge\":\"Gateway charge set by the admin\"\r\n}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-12-26 09:34:30'),
(10, 'PAYMENT_REQUEST', 'Payment- Manual - Requested', 'Payment Request Submitted Successfully', NULL, '<div>Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Package : {{package}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} payment requested by {{method_name}}. Charge: {{charge}} . package: {{package}}', NULL, '{\"package\":\"package name\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:00:00', '2022-08-24 06:39:58'),
(11, 'PAYMENT_REJECT', 'Payment- Manual - Rejected', 'Your Payment Request is Rejected', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Package was : {{pacage}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', NULL, '{\"package\":\"package\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-08-24 07:09:18'),
(12, 'PAYMENT_APPROVE', 'Payment Approve', 'Your payment has been approve', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your payment has been approved.</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Package : {{package}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Your payment has been approved.\r\n\r\nDetails of your payment:\r\n\r\nAmount : {{amount}} {{site_currency}}\r\nCharge: {{charge}} {{site_currency}}\r\n\r\nPaid via :  {{method_name}}\r\nPackage : {{package}}', NULL, '{\r\n    \"method_name\":\"Name of the deposit method\",\r\n    \"package\":\"package name\",\r\n    \"method_currency\":\"Currency of the deposit method\",\r\n    \"method_amount\":\"Amount after conversion between base currency and method currency\",\r\n    \"amount\":\"Amount inserted by the user\",\r\n    \"charge\":\"Gateway charge set by the admin\"\r\n}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 06:00:00', '2022-12-26 09:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest_express_limit` int NOT NULL DEFAULT '0',
  `contact_view_limit` int NOT NULL DEFAULT '0',
  `image_upload_limit` int NOT NULL DEFAULT '0',
  `validity_period` int NOT NULL DEFAULT '0',
  `price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `seo_content`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"about\",\"package\",\"how_it_work\",\"stories\",\"testimonial\",\"mobile_app\",\"faq\",\"counter\"]', NULL, 1, '2020-07-11 06:23:58', '2022-12-11 08:24:26'),
(4, 'Story', 'stories', 'templates.basic.', '[\"about\",\"how_it_work\",\"mobile_app\",\"counter\"]', NULL, 1, '2020-10-22 01:14:43', '2024-05-25 05:58:19'),
(5, 'Contact', 'contact', 'templates.basic.', '[\"faq\",\"testimonial\"]', NULL, 1, '2020-10-22 01:14:53', '2024-05-28 05:32:51'),
(19, 'Packages', 'packages', 'templates.basic.', '[\"faq\",\"counter\",\"testimonial\"]', NULL, 1, '2022-06-08 10:53:44', '2024-05-25 05:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `partner_expectations`
--

CREATE TABLE `partner_expectations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `general_requirement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_age` int UNSIGNED DEFAULT '0',
  `max_age` int UNSIGNED DEFAULT '0',
  `min_height` decimal(8,2) DEFAULT '0.00',
  `max_height` decimal(8,2) DEFAULT '0.00',
  `max_weight` decimal(8,2) DEFAULT '0.00',
  `marital_status` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complexion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking_status` tinyint UNSIGNED DEFAULT '0' COMMENT '3 = doesn''t matter, 1= smoker, 2= non-smoker',
  `drinking_status` tinyint UNSIGNED DEFAULT '0' COMMENT '3=doesn''t matter, 1=drunker, 2=restrained/non-drunker',
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]',
  `min_degree` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personality` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial_condition` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_position` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_attributes`
--

CREATE TABLE `physical_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `height` decimal(8,2) NOT NULL DEFAULT '0.00',
  `weight` decimal(8,2) NOT NULL DEFAULT '0.00',
  `blood_group` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eye_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hair_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complexion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disability` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_histories`
--

CREATE TABLE `purchase_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `package_id` int UNSIGNED NOT NULL DEFAULT '0',
  `package_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = payment initiate; 1 = purchased ; 2 = payment pending 3 = payment rejected\r\n\r\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `religion_infos`
--

CREATE TABLE `religion_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `complaint_id` int UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `short_listed_profiles`
--

CREATE TABLE `short_listed_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `profile_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` int UNSIGNED NOT NULL DEFAULT '0',
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `looking_for` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = Bridegroom; 2 = Bride\r\n',
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `kyc_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kyc_rejection_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: KYC Unverified, 2: KYC pending, 1: KYC verified',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT '0',
  `skipped_step` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]',
  `completed_step` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]',
  `total_step` int NOT NULL DEFAULT '6' COMMENT '1 = basic info, 2 = family info; 3 = education info; 4 = career info; 5 = physical attributes; 6 = partner expectation ',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_by` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `contact_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

CREATE TABLE `user_interests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `interesting_id` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_limitations`
--

CREATE TABLE `user_limitations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `package_id` int UNSIGNED NOT NULL DEFAULT '0',
  `interest_express_limit` int NOT NULL DEFAULT '0' COMMENT '-1 = unlimited',
  `contact_view_limit` int NOT NULL DEFAULT '0' COMMENT '-1 = unlimited',
  `image_upload_limit` int NOT NULL DEFAULT '0' COMMENT '-1= unlimited',
  `validity_period` int NOT NULL DEFAULT '0' COMMENT '-1 = unlimited',
  `expire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_infos`
--
ALTER TABLE `basic_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_infos`
--
ALTER TABLE `career_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_views`
--
ALTER TABLE `contact_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_infos`
--
ALTER TABLE `education_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_infos`
--
ALTER TABLE `family_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ignored_profiles`
--
ALTER TABLE `ignored_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_expectations`
--
ALTER TABLE `partner_expectations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `physical_attributes`
--
ALTER TABLE `physical_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religion_infos`
--
ALTER TABLE `religion_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_listed_profiles`
--
ALTER TABLE `short_listed_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_limitations`
--
ALTER TABLE `user_limitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basic_infos`
--
ALTER TABLE `basic_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `career_infos`
--
ALTER TABLE `career_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_views`
--
ALTER TABLE `contact_views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education_infos`
--
ALTER TABLE `education_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `family_infos`
--
ALTER TABLE `family_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ignored_profiles`
--
ALTER TABLE `ignored_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `marital_statuses`
--
ALTER TABLE `marital_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `partner_expectations`
--
ALTER TABLE `partner_expectations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `physical_attributes`
--
ALTER TABLE `physical_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_histories`
--
ALTER TABLE `purchase_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `religion_infos`
--
ALTER TABLE `religion_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `short_listed_profiles`
--
ALTER TABLE `short_listed_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_interests`
--
ALTER TABLE `user_interests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_limitations`
--
ALTER TABLE `user_limitations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
