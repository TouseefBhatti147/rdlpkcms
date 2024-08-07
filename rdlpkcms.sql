-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 02:42 PM
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
-- Database: `rdlpkcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `job_title` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `job_title`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'admin@fdhlpk.com', 'IT manager', '$2y$10$X4Fp7wSUkGwhu4E7gJ2gk.hjp6//axrsQZ2pCT.Itg2eXC4NZaDQS', 'WgEwf0IexjanDZOrMA1xJlsFfI65VbSypFHZa7qRmLRm0PAnRQELO3X38l5e', '2019-09-24 23:03:00', '2019-10-23 00:38:56'),
(5, 'Touseef Ahmed', 'tochee147@gmail.com', 'Developer', '$2y$12$3//2/kROS9zJraQTRu1al.X7nuTHfg1rwH31.Kejg/FX/DlVEVyR.', 'WgEwf0IexjanDZOrMA1xJlsFfI65VbSypFHZa7qRmLRm0PAnRQELO3X38l5e', '2024-06-14 03:06:07', '2024-06-14 03:06:07'),
(6, 'admin', 'bhatti_147@hotmail.com', 'asd', '$2y$12$S.wl/joyf1ewZ5h68J2QFOQYw9aijGoWRZyDucavwCtBiqEZbeA4y', 'WgEwf0IexjanDZOrMA1xJlsFfI65VbSypFHZa7qRmLRm0PAnRQELO3X38l5e', '2024-06-14 03:19:53', '2024-06-14 03:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `short_description` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `alias` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `event_date` mediumtext NOT NULL DEFAULT current_timestamp(),
  `ordering` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `short_description`, `image`, `alias`, `description`, `status`, `event_date`, `ordering`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(5, 'Flower Show & Family Gala at Royal Orchard Sahiwal', 'Flower Show & Family Gala', '1722253723_2691.jpeg', 'flower-show-and-family-gala-at-royal-orchard-sahiwal', '<p>Flower Show &amp; Family Gala at Royal Orchard Sahiwal</p>', 1, '2024-07-29 16:48:43', 1, '2024-07-29 06:48:43', '2024-07-29 06:48:43', 'Flower Show & Family Gala', 'Flower Show & Family Gala', 'Flower Show & Family Gala'),
(6, 'Flower Exhibition at Royal Orchard Multan', 'Flower Exhibition at Royal Orchard Multan', '1722253815_6296.jpg', 'flower-exhibition-at-royal-orchard-multan', '<p>Flower Exhibition at Royal Orchard Multan</p>', 1, '2024-07-29 16:50:15', 1, '2024-07-29 06:50:15', '2024-07-29 06:50:52', 'Flower Exhibition at Royal Orchard Multan', 'Flower Exhibition at Royal Orchard Multan', 'Flower Exhibition at Royal Orchard Multan');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `title_first_line` varchar(255) DEFAULT NULL,
  `title_second_line` varchar(255) DEFAULT NULL,
  `image` mediumtext NOT NULL,
  `file` varchar(150) DEFAULT NULL,
  `category` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `link_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `title`, `title_first_line`, `title_second_line`, `image`, `file`, `category`, `created_at`, `updated_at`, `status`, `alias`, `link`, `link_status`) VALUES
(44, 'FDHL logo', NULL, NULL, '1721651536.jpg', '', 'logo', '2019-09-14 00:49:07', '2024-07-22 07:32:16', 1, 'fdhl-logo', NULL, NULL),
(45, 'OPAA1', NULL, NULL, '1572605757_5326.png', '', 'partnersandassociates', '2019-09-14 02:29:02', '2019-11-02 00:34:44', 1, 'opaa-1', 'http://edlpk.com/home.php', NULL),
(46, 'OPAA2', '', '', '1572605777_1578.png', '', 'partnersandassociates', '2019-09-14 02:30:08', '2020-11-01 19:31:39', 0, 'opaa-2', 'http://www.cccme.org.cn/shop/cccme9107/index.aspx', 0),
(47, 'OPAA3', NULL, NULL, '1572605789_3821.png', '', 'partnersandassociates', '2019-09-14 02:31:14', '2019-11-02 00:35:24', 1, 'opaa-3', 'http://www.habibrafiq.com/index.php?lang=en', NULL),
(53, 'ISO Certificate 1', NULL, NULL, '1572605985_3621.jpeg', '', 'isocertificates', '2019-09-23 18:51:13', '2019-11-01 00:59:45', 1, 'iso-certificate-1', '/uploads/flipbooks/iso-certificate-1/index.html', NULL),
(54, 'ISO Certificate 2', NULL, NULL, '1572605996_5738.jpeg', '', 'isocertificates', '2019-09-23 18:51:40', '2019-11-01 00:59:56', 1, 'iso-certificate-2', '/uploads/flipbooks/iso-certificate-2/index.html', NULL),
(55, 'ISO Certificate 3', NULL, NULL, '1572606007_1272.jpeg', '', 'isocertificates', '2019-09-23 18:51:59', '2019-11-01 01:00:07', 1, 'iso-certificate-3', '/uploads/flipbooks/iso-certificate-3/index.html', NULL),
(56, 'Certificate logo', NULL, NULL, '1572606246_7285.png', '', 'logo', '2019-09-23 20:07:17', '2019-11-01 01:04:06', 1, 'iso-certificate-logo', '/uploads/flipbooks/iso-certificate-logo/index.html', NULL),
(58, 'Slider zero', 'Capital Smart City', 'Smart is the way to live today...', '1721888949.jpg', '', 'slider', '2019-09-25 00:28:33', '2024-07-25 01:29:09', 1, 'slider-zero', NULL, NULL),
(60, 'Slider Second', 'Creating Smart Investment', 'Opportunities', '1721888992.jpg', '', 'slider', '2019-09-25 00:34:48', '2024-07-25 01:29:52', 1, 'slider-second', NULL, NULL),
(61, 'Slider Third', 'Seamless Green Space', 'Connectivity', '1721889010.jpg', '', 'slider', '2019-09-25 00:35:22', '2024-07-25 01:30:10', 1, 'slider-third', NULL, NULL),
(65, 'Brochure', NULL, NULL, '1572605448_2366.pdf', '', 'broucher', '2019-10-22 02:38:35', '2019-11-01 00:50:48', 1, 'brochure', '/uploads/flipbooks/brochure/index.html', NULL),
(66, 'Smart Cares', NULL, NULL, '1572938206_7304.png', '', 'ourgroup', '2019-11-02 00:29:34', '2019-11-10 23:42:32', 1, 'smart-cares', 'http://www.smartcarespk.com/', NULL),
(67, 'Smart Future Techologies', NULL, NULL, '1573647538_3596.jpg', '', 'ourgroup', '2019-11-02 00:30:22', '2019-11-13 02:24:11', 1, 'smart-future-technologies', '#', NULL),
(68, 'Smart Properties', NULL, NULL, '1573647554_3164.jpg', '', 'ourgroup', '2019-11-02 00:30:57', '2020-01-20 22:28:46', 1, 'smart-properties', 'http://smartpropertiespk.com/', NULL),
(69, 'slider first', 'Specialize in world class', 'Housing & Industrial projects', '1721889644.jpg', '', 'slider', '2021-03-19 19:02:24', '2024-07-25 01:40:44', 1, 'slider-first', NULL, NULL),
(70, 'test logo', 'test logo', 'test logo', 'C:\\xampp\\tmp\\php4E70.tmp', NULL, 'logo', '2024-07-11 06:06:05', '2024-07-11 06:06:05', 1, 'test-logo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `flash_news`
--

CREATE TABLE `flash_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `link` mediumtext DEFAULT NULL,
  `image` mediumtext DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `ordering` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flash_news`
--

INSERT INTO `flash_news` (`id`, `title`, `description`, `link`, `image`, `start_date`, `end_date`, `status`, `ordering`, `created_at`, `updated_at`) VALUES
(5, 'Payment Plan Revised with new Prices of 3.5 Marla Residential Plots', NULL, NULL, '1588231154_6906.jpg', '2020-04-30', '2020-05-10', 1, 4, '2020-04-29 21:19:14', '2020-04-29 21:19:14'),
(4, 'New Launch \"The Harmony Park\" affordable Housing Block in CSC', '<p>We are now in a phase to create a cohesive culture. Capital Smart City has so much to offer whether its lush green farm houses or golf course community to already practiced neighborhood homes or diversity of exclusive living locations to balanced lifestyle.<br />\r\nWe have pooled in all our resources, opportunities and experiences to bring balanced chance to you to experience the true Urban lifestyle by availing the opportunity to be a part of newly conceived and designed affordable housing block in Capital Smart City, <strong>The Harmony Park</strong>.</p>\r\n\r\n<p>A beautiful yet affordable living area, once again designed by our international team of world class professionals, brings you your dream home, <strong>The Villas, at a price you can&rsquo;t believe</strong>. Build your dreams with us, at capital smart city. Call us now, your home awaits.</p>', NULL, '1588231291_3637.jpg', '2020-04-21', '2020-04-30', 1, 3, '2020-04-21 22:38:45', '2020-04-29 21:21:31'),
(6, '** Discount Policy Extends till 10th May, 2020 **', '<p>Ref. #: FDHL/MISC/004/29/216&nbsp; |&nbsp; Date: April 30, 2020</p>\r\n\r\n<p>Please refer to this office letter number FDHL/MISC/004/29/207 dated April 06, 2020 and its amendments thereof.</p>\r\n\r\n<p><strong>Discount policy</strong> on booking and installments of residential plots (ranging from 05 Marla to 40 Marla), Commercial plots and Villas (ranging from 05 Marla to 40 Marla) <strong>has been extended till 10th May 2020</strong><strong>.</strong><br />\r\n<br />\r\nAll members/ clients are requested to please do not miss the opportunity this time.<br />\r\n<br />\r\n<strong>Sales &amp; Marketing Department</strong><br />\r\nCapital Smart City</p>', '-----', '1720078166.jpg', '2020-04-30', '2020-05-10', 1, 5, '2020-04-29 21:20:34', '2024-07-04 02:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_28_065313_create_admins_table', 1),
(4, '2019_08_31_102719_create_files_table', 1),
(5, '2019_09_04_110756_create_widgets_table', 2),
(6, '2019_09_04_112541_create_pages_table', 3),
(7, '2019_09_05_082253_create_projects_table', 4),
(8, '2019_09_05_082840_create_news_table', 4),
(9, '2019_09_05_083051_create_events_table', 4),
(11, '2019_09_05_094810_create_videos_table', 4),
(12, '2019_09_05_094916_create_settings_table', 4),
(13, '2019_09_05_101914_create_newsletter_table', 5),
(14, '2019_09_05_102320_create_settings_table', 6),
(15, '2019_09_05_102412_create_videos_table', 7),
(16, '2019_10_15_105538_create_newsletters_table', 8),
(17, '2019_10_16_050221_ceate_newsletters_table', 9),
(18, '2019_10_16_054322_create_newsletters_table', 10),
(19, '2020_04_17_081305_create_flash_news_table', 11),
(20, '2019_09_05_094259_create_offices_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `short_description` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `alias` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ordering` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `short_description`, `image`, `alias`, `description`, `status`, `ordering`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(4, 'Group COO Malik Muhammad Aslam’s visit to Royal Orchard Multan', 'Group COO Malik Muhammad Aslam visited Royal Orchard Multan', '1722249616_8135.jpg', 'group-coo-malik-muhammad-aslams-visit-to-royal-orchard-multan', '<p><strong>Group COO Malik Muhammad Aslam</strong>&nbsp;visited Royal Orchard Multan on Saturday&nbsp;<strong>18th March 2023</strong>. During the visit, he inaugurated Silicon Heights, 8 Marla Smart Homes, Dome Enclave, Royal Medicare/Maintenance Office, and Family Park Overseas Block. Royal Orchard Multan is dedicated to provide you with a quality lifestyle of International Standard Amenities and Smart Facilities.</p>', 1, 1, '2024-07-29 05:40:03', '2024-07-29 05:40:16', 'Royal Orchard Multan', 'Royal Orchard Multan', 'Royal Orchard Multan'),
(5, 'Family Festival, inauguration Ceremony for Smart Care Services & Opening of parks', 'Family Festival, inauguration Ceremony for SmartCare Service', '1722250366_1606.jpg', 'family-festival-inauguration-ceremony-for-smart-care-services-and-opening-of-parks', '<p>ROYAL ORCHARD SARGODHA</p>\r\n\r\n<p>Family Festival<br />\r\nEnjoy the family festival, Inauguration ceremony for smart care &amp; opening of parks.</p>', 1, 1, '2024-07-29 05:52:46', '2024-07-30 06:52:22', 'Family Festival', 'Family Festival', 'Family Festival');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` mediumtext NOT NULL,
  `link` mediumtext DEFAULT NULL,
  `file` mediumtext DEFAULT NULL,
  `pdf_file` varchar(250) DEFAULT NULL,
  `image` mediumtext DEFAULT NULL,
  `alias` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_keywords` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `title`, `link`, `file`, `pdf_file`, `image`, `alias`, `status`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(31, 'Year Book 2018', '/uploads/flipbooks/year-book-2018/index.html', '', '1571741853_9259.pdf', '1572605947_3156.jpg', 'year-book-2018', 1, NULL, NULL, NULL, '2018-09-22 00:57:38', '2019-11-02 00:32:53'),
(32, 'Smart life', '/uploads/flipbooks/smart-life/index.html', '', '1571742016_4095.pdf', '1572605947_3156.jpg', 'smart-life', 1, NULL, NULL, NULL, '2019-09-22 01:00:18', '2019-11-02 00:32:12'),
(33, 'Smart Life II', '/uploads/flipbooks/smart-life-ii/index.html', '', '1602156899_8356.pdf', '1602156899_9250.png', 'smart-life-ii', 1, NULL, NULL, NULL, '2020-09-08 01:34:59', '2020-10-08 01:56:33'),
(37, 'ttttt', NULL, NULL, '1721733401_3629.pdf', '1721733401_7188.png', 'ttttt', 1, 'tt', 'tt', 'ttt', '2024-07-23 06:16:41', '2024-07-23 06:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(10) UNSIGNED NOT NULL,
  `office_title` mediumtext NOT NULL,
  `address` longtext NOT NULL,
  `alias` mediumtext NOT NULL,
  `category` text NOT NULL,
  `city` text NOT NULL,
  `telephone_1` mediumtext DEFAULT NULL,
  `telephone_2` mediumtext DEFAULT NULL,
  `telephone_3` mediumtext DEFAULT NULL,
  `telephone_4` mediumtext DEFAULT NULL,
  `email_1` mediumtext DEFAULT NULL,
  `email_2` mediumtext DEFAULT NULL,
  `fax_number` mediumtext DEFAULT NULL,
  `uan_number` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_title`, `address`, `alias`, `category`, `city`, `telephone_1`, `telephone_2`, `telephone_3`, `telephone_4`, `email_1`, `email_2`, `fax_number`, `uan_number`, `status`, `created_at`, `updated_at`) VALUES
(2, 'SALES & MARKETING OFFICE', 'Plaza #11, Jinnah Boulevard (East) Sector-A Near Gate #1, DHA Phase II, G.T.Road, Islamabad', 'sales-and-marketing-office', 'sales_and_marketing', 'Islamabad', 'Tel: +92 51 5419180,81,82', 'Toll Free: 0800 SMART (76278)', NULL, NULL, 'saless@smartcitypk.com', NULL, 'Fax: +92 51 5419183', 'UAN: +92 51 111 444 475', 1, '2020-09-06 21:44:28', '2020-09-06 21:44:28'),
(3, 'Multan Office', 'Gate # 1, Multan Public School Road, Multan', 'multan-office', 'sales_and_marketing', 'Multan', 'Tel: +92 61 6740201 - 8', NULL, NULL, NULL, NULL, NULL, NULL, 'UAN: +92 61 111 444 475', 1, '2020-09-06 21:45:34', '2020-09-06 21:45:34'),
(4, 'HEAD OFFICE', 'Silver Square Plaza, Plot # 15, Street # 73, Mehr Ali Road, F-11 Markaz, Islamabad.', 'head-office', 'head_office', 'islamabad', '00800-SMART (76278)', 'Tel :+92 51 2224301 - 04', NULL, NULL, NULL, NULL, NULL, 'UAN : +92 51 111 444 475', 1, '2020-09-06 21:46:43', '2020-09-06 21:46:43'),
(5, 'Royal Orchard Sahiwal', 'Royal Orchard Sahiwal, Near COMSATS University , Campus Sahiwal Pakistan', 'corporate-office', 'sales_and_marketing', 'Sahiwal', '+92 040_4305111', '+92 300 0502721', '+92 300 0502716', '+92 300 0502717', 'sales@royalorchard.pk', NULL, NULL, '+92 48 111 444 475', 1, '2020-09-06 21:47:59', '2024-07-29 03:00:20'),
(6, 'Sargodha Office', 'Lahore-Khushab Bypass Road, Sargodha', 'ilford-office-uk', 'sales_and_marketing', 'Sargodha', '+92-301-8650446', '+92-320-8650446', NULL, NULL, 'sales@royalorchard.pk', 'sales@royalorchard.pk', NULL, '+92 48 111 444 475', 1, '2020-09-06 21:50:30', '2024-07-29 02:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `alias` mediumtext NOT NULL,
  `website` mediumtext DEFAULT NULL,
  `image` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ordering` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `alias`, `website`, `image`, `description`, `status`, `ordering`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'TERMS OF SERVICE', 'terms-of-service', NULL, '', '<p><strong>Terms of Service</strong></p>\r\n\r\n<p>Last updated: Oct 3, 2019</p>\r\n\r\n<p>Please read these Terms and Conditions carefully before using the http://www.fdhlpk.com website because this website is operated by FDH Technologies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Your access to and use of the website is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the website.</p>\r\n\r\n<p>By accessing or using our website you agree to be bound by these Terms. If you disagree with any part of the terms then you may not use our website.</p>\r\n\r\n<p><strong>Content</strong></p>\r\n\r\n<p>We reserve the copyright for the content shared on Future Development Holdings Website, so we dont allow copying the content from our website.</p>\r\n\r\n<p>You further acknowledge and agree that Future Development Holdings shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>\r\n\r\n<p><strong>Changes</strong></p>\r\n\r\n<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 10 days&rsquo; notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>\r\n\r\n<p><strong>Contact Us</strong></p>\r\n\r\n<p>If you have any questions about these Terms, please contact us on following email address</p>\r\n\r\n<p>sales@fdhlpk.com &nbsp;</p>', 1, 1, '2019-10-02 19:11:14', '2024-07-05 06:59:20', 'TERMS OF SERVICE', 'This page includes the terms of service page of FDHL', 'Keyword'),
(4, 'PRIVACY POLICY', 'privacy-policy', '#', '', '<p>This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Site.</p>\r\n\r\n<p>We use your Personal Information only for providing and improving the Site. By using the Site, you agree to the collection and use of information in accordance with this policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Information Collection And Use</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We can ask you to provide us with necessary personally information that can be used to contact or identify you in order to do a shake hand for further processing. Personally information may include, but is not limited to Full Name, Email Address, Cell Number but also any required information needed for our provided services.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Logging Data</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We collect information from your browser whenever you visit our Site for logging data as explained below.</p>\r\n\r\n<p>This Log Data may include information such as your IP address, browser version, browser type, the pages of our Site that you visit, the time and date of your visit, the time spent on those pages and other statistics.</p>\r\n\r\n<p>In addition, we may use third party services such as Google Analytics that collect, monitor and analyze this.</p>\r\n\r\n<p>The Log Data section is for businesses that use analytics or tracking services in websites or apps, like Google Analytics.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Communications</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We may use your Personal Information to contact you for newsletters marketing or promotional materials and other information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<strong>Cookies</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cookies are files with small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your browser.</p>\r\n\r\n<p>Like many sites, we use cookies to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Site.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Security</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage can be reliable completely. We are working on our full effort to provide you fool proof security from unidentified threats but we cannot guarantee its absolute security.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Changes To This Privacy Policy</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This Privacy Policy is effective as of Published Date and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.</p>\r\n\r\n<p>We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy.</p>\r\n\r\n<p>If we make any material changes to this Privacy Policy, we will notify you either through the email address you have provided us, or by placing a prominent notice on our website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Contact Us</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If you have any questions about this Privacy Policy, please contact us on sales@fdhlpk.com &nbsp;&nbsp;</p>', 1, 1, '2019-10-02 21:28:14', '2019-10-17 01:45:39', 'PRIVACY POLICY', 'This page includes the privacy policy of FDHL website', '#'),
(5, 'SITE MAP', 'site-map', '#', '', '<p>SITE MAP</p>', 1, 1, '2019-10-03 21:46:55', '2019-11-13 02:36:26', 'SITE MAP', 'This page includes the sitemap of FDHL website', '#');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `broucher_link` mediumtext DEFAULT NULL,
  `website` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `alias` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `project_status` varchar(150) DEFAULT 'current',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `broucher_link`, `website`, `image`, `alias`, `description`, `short_description`, `status`, `project_status`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(13, 'Royal Orchard Multan', NULL, 'https://multan.royalorchard.pk/portfolio/royal-orchard-multan/', '1722258685.jpg', 'royal-orchard-multan', '<p><strong>The housing scheme is unique in many ways it is located on three main roads of Multan i.e. Multan Public School Road, Mattital Road, and Shakh-e-Madina Road near the Northern bypass, opposite to Woman University, Gymkhana &amp; Sports Complex. It is located in a splendid environment with an ideal landscape, rich fertility, and subsoil water in abundance.</strong></p>', 'The housing scheme is unique in many ways it is located on three main roads of Multan i.e. Multan Public School Road, Mattital Road, and Shakh-e-Madina Road near the Northern bypass, opposite to Woman University, Gymkhana & Sports Complex', 1, 'current', '2019-09-19 01:16:33', '2024-07-29 08:11:25', 'Royal Orchard Multan', 'The housing scheme is unique in many ways which is located on three main roads of Multan i.e. Multan Public School Road, Mattital Road and Shakh-e-Madina Road near to Northern bypass, opposite to Woman University, Gymkhana & Sports Complex. It is located in a splendid environment with an ideal landscapes, rich fertility and sub soil water in abundance.', '#'),
(18, 'Royal Orchard Sahiwal', NULL, 'https://sahiwal.royalorchard.pk/portfolio/royal-orchard-sahiwal/', '1722268331_1188.jpg', 'royal-orchard-sahiwal', '<p>Royal Orchard Sahiwal is Located a few minutes&#39; drive from G.T. Road and near COMSATS University Sahiwal, away from the pollution of rice mills at a scenic natural and airy landscape.</p>', 'Royal Orchard Sahiwal is Located a few minutes\' drive from G.T. Road and near COMSATS University Sahiwal, away from the pollution of rice mills at a scenic natural and airy landscape.', 1, 'current', '2024-07-29 10:52:11', '2024-07-29 10:52:11', 'Royal Orchard Sahiwal', 'Royal Orchard Sahiwal', 'Royal Orchard Sahiwal'),
(19, 'Royal Orchard Sargodha', NULL, 'https://sargodha.royalorchard.pk/portfolio/royal-orchard-sargodha/', '1722269206_1026.jpg', 'royal-orchard-sargodha', '<p><strong>this grand housing project aims to uplift the existing living standards and promote a lifestyle which was hard to be imagined before. This housing scheme is planned and designed to meet the ever-growing demands of modern living and promises facilities comparable to any high-calibre housing scheme in Pakistan.</strong></p>', 'Royal Orchard Sargodha Now bringing the royal experience of luxury living to Sargodha. Ideally located at Lahore - Khushab bypass and just 5 minute drive away from Sargodha city', 1, 'current', '2024-07-29 11:06:46', '2024-07-29 11:06:46', 'Royal Orchard Sargodha', 'Royal Orchard Sargodha', 'Royal Orchard Sargodha');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` mediumtext NOT NULL,
  `alias` varchar(150) DEFAULT NULL,
  `value` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `alias`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Toll Free Number', 'toll-free-number', 'Toll Free: 0800 SMART (76278)', 1, '2019-09-17 23:24:23', '2019-09-17 23:24:23'),
(2, 'UAN number', 'uan-number', 'UAN: 111-444-475', 1, '2019-09-17 23:25:20', '2019-09-17 23:25:20'),
(3, 'Email', 'rdlpk-email', 'sales@rdlpk.com', 1, '2019-09-17 23:25:52', '2024-07-26 02:51:11'),
(4, 'Facebook link', 'facebook-link', 'https://www.facebook.com/rdlpk', 1, '2019-09-17 23:26:21', '2024-07-26 02:52:05'),
(5, 'YouTube Link', 'youtube-link', 'https://www.youtube.com/channel/UCNPoa74LguQ_B68bugKW-pA', 1, '2019-09-17 23:26:49', '2024-07-26 02:53:37'),
(6, 'Twitter Link', 'twitter-link', 'https://www.twitter.com/rdblpk', 1, '2019-09-17 23:30:17', '2024-07-26 02:52:17'),
(7, 'Telephone Number', 'telephone-number', 'Tel : +92 51 2224301 - 04', 1, '2019-09-17 23:30:54', '2019-09-17 23:30:54'),
(8, 'Qualified Staff', 'qualified-staff', '400', 1, '2019-09-17 23:31:29', '2019-09-17 23:31:37'),
(9, 'Happy Clients', 'happy-clients', '75', 1, '2019-09-17 23:32:07', '2019-09-17 23:32:07'),
(10, 'Awards Won', 'awards-won', '25', 1, '2019-09-17 23:32:37', '2019-09-18 00:05:02'),
(11, 'Copy right', 'copy-right', '© Copyright 2021 - RDLPK.com    |   Designed by HRL eSolutions', 1, '2019-09-17 23:32:59', '2024-07-26 02:56:07'),
(12, 'Instagram link', 'instagram-link', 'https://www.instagram.com/royalorchardpk/', 1, '2019-09-30 00:13:54', '2024-07-26 02:54:51'),
(13, 'Email sender', 'email-sender', 'noreply@rdlpk.com', 1, '2019-10-08 21:01:05', '2024-07-26 02:55:09'),
(14, 'Contact us Email', 'contact-us-email', 'sales@rdlpk.com', 1, '2019-10-08 22:05:03', '2024-07-26 02:55:22'),
(15, 'member portal link', 'member-portal-link', 'https://www.rdlpk.com/index.php/member/member', 1, '2021-08-12 21:48:28', '2024-07-26 02:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'DEO', 'user@fdhlpk.com', '$2y$10$xz7STaKdhjbNM90z1pUP2ehPm2RsB.Y7VPX4xIhMmb4wu012ummG6', 'a7Vu2yukojuyyMd2K6lN7Ve4WtzAHOo5sBuMICDkknsEXuBkACdv4yaRH7dt', '2019-08-31 00:49:48', '2019-10-29 21:20:15'),
(2, 'Touseef Ahmed', 'tochee147@gmail.com', '$2y$12$PCBEpzfVBZX9.IboeYtCL.xHKS3/13zMvmRJgFbYlfucCdpQB8Sam', NULL, '2024-07-04 03:51:37', '2024-07-04 03:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` mediumtext NOT NULL,
  `alias` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `alias`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Royal Orchard Multan: Where Excellence Meets Elegance!', 'OtiJh7KZ0RM', 1, '2024-07-29 07:15:57', '2024-07-29 07:16:15'),
(10, 'Royal Orchard Multan Development', 'wCpsZUtnpPY', 1, '2024-07-29 07:23:20', '2024-07-29 07:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `link` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `alias` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_description` varchar(1000) DEFAULT NULL,
  `meta_keywords` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `title`, `link`, `image`, `alias`, `status`, `description`, `created_at`, `updated_at`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(3, 'OUR GOAL', 'na', '', 'our-goal', 1, '<p>Our Projects should be the center of Entertainment, Hospitality and Tourism.</p>', '2019-09-18 02:40:20', '2024-07-30 02:57:55', NULL, NULL, NULL),
(4, 'OUR VISION', 'na', '', 'our-vision', 1, '<p>RDLPK vision focuses on providing exclusive Living, and quality Education to the entire, equipped with the latest health facilities.</p>', '2019-09-18 02:41:11', '2024-07-30 02:58:20', NULL, NULL, NULL),
(5, 'OUR MISSION', 'na', '', 'our-mission', 1, '<p>We strive to deliver the best in the real estate sector by developing state-of-the-art residential and modern industrial zones.</p>', '2019-09-18 02:41:47', '2024-07-30 02:58:41', NULL, NULL, NULL),
(6, 'WHAT WE OFFER', 'na', '', 'what-we-offer', 1, '<p>We are dedicated to providing a state-of-the-art modern living environment in residential zones and futuristic facilities in its mega industrial zone</p>', '2019-09-18 02:44:48', '2024-07-30 02:59:11', NULL, NULL, NULL),
(7, 'WHO WE ARE', 'na', '', 'who-we-are', 1, '<p>RDLPK is a partner&rsquo;s consortium registered under the Companies Ordinance 1984. National and international companies have joined hands to form the world&#39;s next leading organization.</p>', '2019-09-18 02:45:20', '2024-07-30 02:59:41', NULL, NULL, NULL),
(8, 'MD\'S MESSAGE', 'na', '', 'about-us', 1, '<p>I believe that integrity, honor, and commitment should be the fundamental beliefs of any society that wants to succeed in life! Here at Royal Orchard Housing&nbsp; &nbsp;(RDLPK) we ensure that our team follows these codes of ethics strictly, making sure we honor our commitments and live by our words. At Royal Orchard Housing we have made a promise to our nation that is striving to deliver the best in the real estate sector</p>', '2019-09-18 02:45:56', '2024-07-30 03:06:06', 'About us', 'RDLPK is a partner’s consortium registered under the Companies Ordinance 1984. National and international companies have joined hands to form the world\'s next leading organization.', '#'),
(9, 'Modern Living Enviroment', 'na', '1572606370_9238.jpg', 'modern-living-enviroment', 1, '<p>We are dedicated to providing state of the art modern living environment in residential zones and futuristic facilities in its mega industrial zone. These zones are all linked through the vital routes, with distinctive but exclusive interchanges for easy access.</p>', '2019-09-18 02:46:48', '2019-11-01 01:06:10', NULL, NULL, NULL),
(10, 'Innovative Ideas', 'na', '1719991450.jpg', 'innovative-ideas', 1, '<p>The successful exploitation of new ideas is crucial to a business being able to improve its processes, bring new and improved products and services to market, increase its efficiency and, most importantly, improve its profitability, Encourage innovation in the business.</p>', '2019-09-18 02:47:27', '2024-07-03 02:24:10', NULL, NULL, NULL),
(12, 'About CLIC', 'http://www.cccme.org.cn/shop/cccme9107/index.aspx', '1572605847_5584.jpg', 'about-clicwidget', 0, '<p>CLIC (China Liaoning International Economic and Technical Cooperation Group Corporation Ltd) is a state-owned enterprise registered in People&#39;s Republic of China. Experienced in multifarious sectors including engineering procurement, civil construction, electro-mechanical projects, etc.</p>', '2019-09-18 02:49:12', '2024-07-30 03:06:51', NULL, NULL, NULL),
(13, 'About EDL', 'http://edlpk.com/', '1572605833_4092.jpg', 'about-edlwidget', 0, '<p>Engineering Dimensions (Pvt) Limited has come a long way to symbolize commitment, distinction and professional exellence by meeting the stringent, demanding and extra ordinary work requirements of high engineering, national and international importance involving civil, electrical and mechanical works for the last few years.</p>', '2019-09-18 02:49:43', '2024-07-26 06:09:14', NULL, NULL, NULL),
(14, 'Royal Developers & Builders (Pvt.) Ltd', '/about-us', '1572605818_1376.gif', 'about-uswidget', 1, '<p><strong>Royal Developers &amp; Builders (Pvt) Limited</strong>&nbsp;is specialized in constructing world-class housing facilities and gated communities. This new phenomenon of excellence started from relatively low-key markets, before storming the mainstream Real Estate regions. In record time, the rise of&nbsp;<strong>Royal Developers &amp; Builders</strong>&nbsp;as a Real Estate developer is only because of ALLAH ALMIGHTY&rsquo;s blessings.&nbsp;<strong>Royal Developers &amp; Builders</strong>&nbsp;also thank the partners, associates, investors, and friends for their continued support &amp; trust.&nbsp;<a href=\"http://www.rdlpk.com/index.php/web/pages?id=38\"><strong>HRL</strong>&nbsp;Group</a>&nbsp;through its subsidiary Royal Developers &amp; Builders reiterates working together to set newer higher standards of living and development &ndash; contributing towards a better, progressive &amp; prosperous Pakistan &ndash;<strong>&nbsp;</strong>INSHA&#39;ALLAH.</p>', '2019-09-18 02:50:21', '2024-07-26 06:08:51', 'Home', 'Royal Developers & Builders (Pvt) Limited is specialized in constructing world-class housing facilities and gated communities. This new phenomenon of excellence has started from relatively low-key markets, before storming the mainstream Real Estate regions.', 'RDLPK'),
(16, 'Current Projects', 'current-projects', '', 'current-projects', 1, '<p>seo-widget</p>', '2019-10-17 00:57:55', '2019-10-17 00:58:15', 'Current Projects', 'This page includes all of our current projects', '#'),
(17, 'Upcoming Projects', 'upcoming-projects', '', 'upcoming-projects', 1, '<p>#</p>', '2019-10-17 01:04:25', '2019-10-17 01:04:25', 'Upcoming Projects', 'This page includes all of our upcoming projects', '#'),
(18, 'Contact Us', 'contact-us', '', 'contact-us', 1, '<p>#</p>', '2019-10-17 01:07:13', '2019-10-17 01:07:13', 'Contact Us', 'This page includes all the contact information which users can use to contact us', '#'),
(19, 'News', 'news-widget', '', 'news-widget', 1, '<p>#</p>', '2019-10-17 01:10:58', '2019-10-17 01:12:18', 'News', 'This page includes all the news which was is published from our website', '#'),
(20, 'Events', 'events-widget', '', 'events-widget', 1, '<p>#</p>', '2019-10-17 01:14:26', '2019-10-17 01:14:26', 'Events', 'This page includes all the information about the events which took place in FDHL', '#'),
(21, 'Videos', 'videos-widget', '', 'videos-widget', 1, '<p>#</p>', '2019-10-17 01:16:14', '2019-10-17 01:16:14', 'Videos', 'This page includes all the videos of FDHL', '#'),
(22, 'Newsletters', 'newsletter-widget', '', 'newsletter-widget', 1, '<p>#</p>', '2019-10-17 01:17:53', '2019-10-17 01:17:53', 'Newsletters', 'This page includes all the newsletters of FDHL', '#'),
(26, 'OUR MISSION', 'test page', '1720176078_5331.jpg', 'test-page', 1, '<p>Our Smart Cities should be the centre of Entertainment, Hospitality and Tourism.</p>', '2024-07-05 05:41:18', '2024-07-05 05:41:18', 'test page', 'test page', 'test page');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_news`
--
ALTER TABLE `flash_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `flash_news`
--
ALTER TABLE `flash_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
