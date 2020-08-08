-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2020 at 05:29 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keralkartbackup1`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` mediumtext,
  `ePassword` mediumtext,
  `nPassword` mediumtext,
  `lastLogin` varchar(30) DEFAULT NULL,
  `lastLoginIP` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `email`, `username`, `ePassword`, `nPassword`, `lastLogin`, `lastLoginIP`, `role`, `added_at`, `updated_at`, `status`) VALUES
(1, 'ajeet.hubrootsolutios@gmail.com', 'admin', '13492583e718b76aff0a769b7c996ad4', 'hubr00t', NULL, NULL, 1, '2020-01-08 15:25:40', NULL, 1),
(2, 'gautam@gmail.com', 'Kumar gautam', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, NULL, 1, '2020-07-22 12:03:50', '2020-07-22 12:04:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brandName` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `typeId` int(11) DEFAULT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryThumbnail` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `url_slug` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `typeId`, `categoryName`, `categoryThumbnail`, `status`, `added_at`, `updated_at`, `url_slug`) VALUES
(1, 1, 'Rakshabandhan', 'rakhi-festival-1.jpg', 1, '2020-07-22 07:37:48', '2020-07-22 20:05:31', 'rakshabandhan'),
(2, 2, 'Personal Protection', 'IMG_20200615_181139-removebg-preview.png', 1, '2020-07-26 17:19:06', NULL, 'personal-protection');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` text,
  `message` text,
  `status` enum('0','1') DEFAULT NULL,
  `is_activated` enum('0','1') DEFAULT NULL,
  `added_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `firstname`, `lastname`, `email`, `subject`, `message`, `status`, `is_activated`, `added_at`) VALUES
(1, 'Eric', 'Jones', 'eric@talkwithwebvisitor.com', 'how to turn eyeballs into phone calls', 'Hi, Eric here with a quick thought about your website keralkart.com...\r\n\r\nI’m on the internet a lot and I look at a lot of business websites.\r\n\r\nLike yours, many of them have great content. \r\n\r\nBut all too often, they come up short when it comes to engaging and connecting with anyone who visits.\r\n\r\nI get it – it’s hard.  Studies show 7 out of 10 people who land on a site, abandon it in moments without leaving even a trace.  You got the eyeball, but nothing else.\r\n\r\nHere’s a solution for you…\r\n\r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  You’ll know immediately they’re interested and you can call them directly to talk with them literally while they’re still on the web looking at your site.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nIt could be huge for your business – and because you’ve got that phone number, with our new SMS Text With Lead feature, you can automatically start a text (SMS) conversation – immediately… and contacting someone in that 5 minute window is 100 times more powerful than reaching out 30 minutes or more later.\r\n\r\nPlus, with text messaging you can follow up later with new offers, content links, even just follow up notes to keep the conversation going.\r\n\r\nEverything I’ve just described is extremely simple to implement, cost-effective, and profitable. \r\n \r\nCLICK HERE http://www.talkwithwebvisitor.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more eyeballs into leads today!\r\n\r\nEric\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE http://www.talkwithwebvisitor.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitor.com/unsubscribe.aspx?d=keralkart.com\r\n', '1', '1', '2020-07-25 13:06:46'),
(2, 'Eric', 'Jones', 'eric@talkwithwebvisitor.com', 'Cool website!', 'Cool website!\r\n\r\nMy name’s Eric, and I just found your site - keralkart.com - while surfing the net. You showed up at the top of the search results, so I checked you out. Looks like what you’re doing is pretty cool.\r\n \r\nBut if you don’t mind me asking – after someone like me stumbles across keralkart.com, what usually happens?\r\n\r\nIs your site generating leads for your business? \r\n \r\nI’m guessing some, but I also bet you’d like more… studies show that 7 out 10 who land on a site wind up leaving without a trace.\r\n\r\nNot good.\r\n\r\nHere’s a thought – what if there was an easy way for every visitor to “raise their hand” to get a phone call from you INSTANTLY… the second they hit your site and said, “call me now.”\r\n\r\nYou can –\r\n  \r\nTalk With Web Visitor is a software widget that’s works on your site, ready to capture any visitor’s Name, Email address and Phone Number.  It lets you know IMMEDIATELY – so that you can talk to that lead while they’re literally looking over your site.\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to try out a Live Demo with Talk With Web Visitor now to see exactly how it works.\r\n\r\nTime is money when it comes to connecting with leads – the difference between contacting someone within 5 minutes versus 30 minutes later can be huge – like 100 times better!\r\n\r\nThat’s why we built out our new SMS Text With Lead feature… because once you’ve captured the visitor’s phone number, you can automatically start a text message (SMS) conversation.\r\n  \r\nThink about the possibilities – even if you don’t close a deal then and there, you can follow up with text messages for new offers, content links, even just “how you doing?” notes to build a relationship.\r\n\r\nWouldn’t that be cool?\r\n\r\nCLICK HERE http://www.talkwithwebvisitor.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nYou could be converting up to 100X more leads today!\r\nEric\r\n\r\nPS: Talk With Web Visitor offers a FREE 14 days trial – and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right now… don’t keep them waiting. \r\nCLICK HERE http://www.talkwithwebvisitor.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitor.com/unsubscribe.aspx?d=keralkart.com\r\n', '1', '1', '2020-07-27 16:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `coupondetail`
--

CREATE TABLE `coupondetail` (
  `id` int(11) NOT NULL,
  `couponCode` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `usageLimit` int(11) DEFAULT NULL,
  `validFromDate` date DEFAULT NULL,
  `validToDate` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` int(11) NOT NULL,
  `customerId` bigint(20) DEFAULT NULL,
  `ContactNo` varchar(20) DEFAULT NULL,
  `alternateContact` varchar(20) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `myAddress` mediumtext,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `landmark` text,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `statu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `id` int(11) NOT NULL,
  `customerName` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `CustomerAddress` mediumtext,
  `alternateContact` varchar(20) DEFAULT NULL,
  `postalCode` varchar(10) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `landmark` text,
  `password` text,
  `added_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_activated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`id`, `customerName`, `mobile`, `email`, `profileImage`, `CustomerAddress`, `alternateContact`, `postalCode`, `country`, `state`, `city`, `landmark`, `password`, `added_at`, `modified_at`, `status`, `is_activated`) VALUES
(1, 'Gautam', '9304401664', 'gautam@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '202cb962ac59075b964b07152d234b70', '2020-07-22 11:29:54', NULL, 1, 1),
(2, 'Jaya', '9757455195', 'rupa.satya091@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fcea920f7412b5da7be0cf42b8c93759', '2020-07-23 05:51:11', NULL, 1, 1),
(3, 'Ajeet', '7903292220', 'ajeet.hubrootsolutions@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13492583e718b76aff0a769b7c996ad4', '2020-07-28 09:38:19', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'ajeet@123', 0, 0, 0, NULL, 9900909);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notificationText` mediumtext,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_items`
--

CREATE TABLE `ordered_items` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `orderedOn` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `deliveryCharge` int(11) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `shippingAddress` text,
  `customerId` int(11) DEFAULT NULL,
  `paymentMode` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `satus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetail`
--

CREATE TABLE `paymentdetail` (
  `id` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `paymentId` varchar(255) DEFAULT NULL,
  `OrderId` varchar(255) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `paymentType` varchar(255) DEFAULT NULL,
  `added_at` varchar(33) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(44) DEFAULT NULL,
  `hash_generate` text NOT NULL,
  `hash_receive` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productrating`
--

CREATE TABLE `productrating` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `ratings` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productreview`
--

CREATE TABLE `productreview` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `ratings` varchar(255) DEFAULT NULL,
  `reviews` varchar(500) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `slug` text,
  `categoryId` int(11) DEFAULT NULL,
  `subcategoryId` int(11) DEFAULT NULL,
  `productCode` varchar(255) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `strikePrice` varchar(11) DEFAULT NULL,
  `price` varchar(11) DEFAULT NULL,
  `mrp` varchar(11) DEFAULT NULL,
  `delivery_charge` int(11) DEFAULT NULL,
  `cgst_percentage` int(11) DEFAULT NULL,
  `quantity` varchar(11) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `smallDiscription` text,
  `features` text,
  `productDescription` text,
  `hotdeal` varchar(11) DEFAULT NULL,
  `premium` varchar(11) DEFAULT NULL,
  `inStock` varchar(11) DEFAULT NULL,
  `latestCollection` varchar(11) DEFAULT NULL,
  `thumbnail1` varchar(255) DEFAULT NULL,
  `thumbnail2` varchar(255) DEFAULT NULL,
  `thumbnail3` varchar(255) DEFAULT NULL,
  `thumbnail4` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `slug`, `categoryId`, `subcategoryId`, `productCode`, `productName`, `strikePrice`, `price`, `mrp`, `delivery_charge`, `cgst_percentage`, `quantity`, `discount`, `color`, `size`, `weight`, `brand`, `smallDiscription`, `features`, `productDescription`, `hotdeal`, `premium`, `inStock`, `latestCollection`, `thumbnail1`, `thumbnail2`, `thumbnail3`, `thumbnail4`, `added_at`, `updated_at`, `added_by`, `updated_by`, `status`) VALUES
(1, 'rakhi_kumkum_thali', 1, 1, 'KUM01', 'RAKHI KUMKUM THALI', '108.00', '108.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Kumkum is essential product used on Rakhi for Tilak.', '<p>Product include kukum plus decorative flowers looks beatiful and presentable.</p>\r\n', '<p>Small decorative kumkum , Rakhi Product.</p>\r\n', '1', '1', '1', '1', 'KUM011.png', 'KUM012.png', 'KUM013.png', 'KUM014.png', '2020-07-22 20:13:40', '2020-07-26 19:44:18', '', '', '1'),
(2, 'rakhi_kumkum_thali-1', 1, 1, 'KUM05', 'RAKHI KUMKUM THALI', '108.00', '108.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Beautifully decorated KumKum Thali', '<p>Decorative Kumkum &amp; Chawal</p>\r\n', '<p>Decorative Rose with Kumkum &amp; Chawal</p>\r\n', '1', '1', '1', '1', 'KUM05.png', 'KUM051.png', 'KUM052.png', 'KUM053.png', '2020-07-22 20:21:46', '2020-07-26 19:46:33', '', '', '1'),
(3, 'rakhi_kumkum_thali-2', 1, 1, 'KUM02', 'RAKHI KUMKUM THALI', '108.00', '108.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Decorative Kumkum Chawal use in Rakhi', '<p>Decorative Kumkum Chawal</p>\r\n', '<p>Decorative Kumkum Chawal</p>\r\n', '1', '1', '1', '1', 'KUM02.png', 'KUM021.png', 'KUM022.png', 'KUM023.png', '2020-07-22 20:29:14', '2020-07-26 19:44:42', '', '', '1'),
(4, 'rakhi_kumkum_thali-3', 1, 1, 'KUM03', 'RAKHI KUMKUM THALI', '108.00', '108.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Decorative Rakhi Thali for Rakshabandhan.', '<p>Decorative Rakhi Thali for Rakshabandhan.</p>\r\n', '<p>Decorative Rakhi Thali for Rakshabandhan.</p>\r\n', '1', '1', '1', '1', 'KUM03.png', 'KUM031.png', 'KUM032.png', 'KUM033.png', '2020-07-22 20:36:20', '2020-07-26 19:45:15', '', '', '1'),
(6, 'rakhi_kumkum_thali-4', 1, 1, 'KUM04 _4', 'RAKHI KUMKUM THALI', '108.00', '108.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Beautiful Rakhi Kumkum Thali', '<p>Beautiful Rakhi Kumkum Thali</p>\r\n', '<p>Beautiful Rakhi Kumkum Thali</p>\r\n', '1', '1', '1', '1', 'KUM041.png', 'KUM044.png', 'KUM045.png', 'KUM046.png', '2020-07-26 07:47:16', '2020-07-26 19:46:08', '', '', '1'),
(7, 'rakhi_kids_micky_k001', 1, 1, 'K001', 'Rakhi Kids Micky K001', '102.00', '102.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Beautiful Kids Rakhi', '<p>Beautiful Kids Rakhi</p>\r\n', '<p>Beautiful Kids Rakhi</p>\r\n', '1', '1', '1', '1', 'K01.png', 'K011.png', 'K012.png', 'K013.png', '2020-07-26 07:52:49', '2020-07-26 19:41:25', '', '', '1'),
(8, 'rakhi_kids_glitter_k002', 1, 1, 'K002', 'RAKHI KIDS GLITTER K002', '102.00', '102.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Beautiful glitter Rakhi', '<p>Beautiful glitter Rakhi</p>\r\n', '<p>Beautiful glitter Rakhi</p>\r\n', '1', '1', '1', '1', 'K02.png', 'K021.png', 'K022.png', 'K023.png', '2020-07-26 07:57:02', '2020-07-26 19:41:55', '', '', '1'),
(9, 'rakhi_kids_simple_rounded', 1, 1, 'K003', 'RAKHI KIDS SIMPLE ROUNDED', '102.00', '102.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Simple rounded Rakhi', '<p>Simple rounded Rakhi</p>\r\n', '<p>Simple rounded Rakhi</p>\r\n', '1', '1', '1', '1', 'K03.png', 'K031.png', 'K032.png', 'K033.png', '2020-07-26 08:06:51', '2020-07-26 19:42:26', '', '', '1'),
(10, 'rakhi_kids_simple_rounded-1', 1, 1, 'K004', 'RAKHI KIDS SIMPLE ROUNDED', '102.00', '102.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Kids simple Rakhi ', '<p>Kids simple Rakhi&nbsp;</p>\r\n', '<p>Kids simple Rakhi&nbsp;</p>\r\n', '1', '1', '1', '1', 'K04.png', 'K041.png', 'K042.png', 'K043.png', '2020-07-26 08:09:33', '2020-07-26 19:42:54', '', '', '1'),
(11, 'rakhi_kids_smily_k05', 1, 1, 'K05', 'RAKHI KIDS SMILY K05', '96.00', '96.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'Kids smiley Rakhi', '<p>Kids smiley Rakhi</p>\r\n', '<p>Kids smiley Rakhi</p>\r\n', '1', '1', '1', '1', 'K05.png', 'K051.png', 'K052.png', 'K053.png', '2020-07-26 08:20:15', '2020-07-26 19:43:21', '', '', '1'),
(12, 'rakhi_kids_car', 1, 1, 'K06', 'RAKHI KIDS CAR', '102.00', '102.00', '120', NULL, NULL, '5', NULL, NULL, NULL, '', NULL, 'KIDS CAR RAKHI', '<p>KIDS CAR RAKHI</p>\r\n', '<p>KIDS CAR RAKHI</p>\r\n', '1', '1', '1', '1', 'K06.png', 'K061.png', 'K062.png', 'K063.png', '2020-07-26 08:24:34', '2020-07-26 19:43:52', '', '', '1'),
(13, 'rakhi_rose_design_pa11', 1, 1, 'PA11', 'RAKHI ROSE DESIGN PA11', '108.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'DECORATIVE ROSE FLOWER IS USED TO DECORATE RAKHI', '<p>DECORATIVE ROSE FLOWER IS USED TO DECORATE RAKHI</p>\r\n', '<p>DECORATIVE ROSE FLOWER IS USED TO DECORATE RAKHI</p>\r\n', '1', '1', '1', '1', '11.png', '11.png', '12.png', '13.png', '2020-07-26 15:57:28', '2020-07-27 13:08:52', '', '', '1'),
(14, 'rakhi_beautifully_design_bracelet_rakhi_pa12', 1, 1, 'PA12', 'RAKHI BEAUTIFULLY DESIGN BRACELET RAKHI PA12', '112.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'BEAUTIFUL BRACELET RAKHI', '<p>BEAUTIFUL BRACELET RAKHI</p>\r\n', '<p>BEAUTIFUL BRACELET RAKHI</p>\r\n', '1', '1', '1', '1', '21.png', '21.png', '22.png', '23.png', '2020-07-26 16:01:15', '2020-07-27 13:09:33', '', '', '1'),
(15, 'rakhi_simple_square_shaped_pa1', 1, 1, 'PA1', 'RAKHI SIMPLE SQUARE SHAPED PA1', '75.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'SIMPLE YELLOW COLOR SQUARE SHAPED RAKHI', '<p>SIMPLE YELLOW COLOR SQUARE SHAPED RAKHI</p>\r\n', '<p>SIMPLE YELLOW COLOR SQUARE SHAPED RAKHI</p>\r\n', '1', '1', '1', '1', '31.png', '31.png', '32.png', '33.png', '2020-07-26 16:04:27', '2020-07-27 13:07:43', '', '', '1'),
(16, 'rakhi_simple_pa4', 1, 1, 'PA4', 'RAKHI SIMPLE PA4', '72.00', '72.00', '80', NULL, NULL, '6', NULL, NULL, NULL, '', NULL, 'SIMPLE RAKHI ', '<p>SIMPLE RAKHI&nbsp;</p>\r\n', '<p>SIMPLE RAKHI&nbsp;</p>\r\n', '1', '1', '1', '1', '4.png', '41.png', '42.png', '43.png', '2020-07-26 16:08:00', '2020-07-26 19:50:55', '', '', '1'),
(17, 'rakhi_multicolor_rakhi_pa3', 1, 1, 'PA3', 'RAKHI MULTICOLOR RAKHI PA3', '72.00', '72.00', '80', NULL, NULL, '6', NULL, NULL, NULL, '', NULL, 'MULTICOLOR DECORATIVE RAKHI MADE WITH DECORATIVE ROSE', '<p>MULTICOLOR DECORATIVE RAKHI MADE WITH DECORATIVE ROSE</p>\r\n', '<p>MULTICOLOR DECORATIVE RAKHI MADE WITH DECORATIVE ROSE</p>\r\n', '1', '1', '1', '1', '5.png', '51.png', '52.png', '53.png', '2020-07-26 16:10:53', '2020-07-26 19:50:28', '', '', '1'),
(18, 'rakhi_beautiful_blue_colored_couple_rakhi_pa21', 1, 1, 'PA21', 'RAKHI BEAUTIFUL BLUE COLORED COUPLE RAKHI PA21', '102.00', '102.00', '120', NULL, NULL, '6', NULL, NULL, NULL, '', NULL, 'ONLY RAKHI AVAILABLE ', '<p>ONLY RAKHI AVAILABLE&nbsp;</p>\r\n', '<p>ONLY RAKHI AVAILABLE&nbsp;</p>\r\n', '1', '1', '1', '1', '7.png', '71.png', '72.png', '73.png', '2020-07-26 16:17:06', '2020-07-26 19:50:02', '', '', '1'),
(19, 'rakhi_beautifully_decorated_rose_pa14', 1, 1, 'PA14', 'RAKHI BEAUTIFULLY DECORATED ROSE PA14', '108.00', '108.00', '120', NULL, NULL, '6', NULL, NULL, NULL, '', NULL, 'ONLY RAKHI AVAILABLE', '<p>ONLY RAKHI AVAILABLE</p>\r\n', '<p>ONLY RAKHI AVAILABLE</p>\r\n', '1', '1', '1', '1', '8.png', '81.png', '82.png', '83.png', '2020-07-26 16:22:53', '2020-07-26 19:48:57', '', '', '1'),
(20, 'rakhi_customised_pa17', 1, 1, 'PA17', 'RAKHI CUSTOMISED PA17', '110.50', '110.50', '130', NULL, NULL, '6', NULL, NULL, NULL, '', NULL, 'THE MOST ORDERED RAKHI', '<p>THE MOST ORDERED RAKHI</p>\r\n', '<p>THE MOST ORDERED RAKHI</p>\r\n', '1', '1', '1', '1', '9.png', '91.png', '92.png', '93.png', '2020-07-26 16:27:18', '2020-07-26 19:59:57', '', '', '1'),
(23, 'personal-protective-equipment', 2, 2, 'H001', 'Personal Protective Equipment', '1125.00', '1125.00', '1500', NULL, NULL, '10', NULL, NULL, NULL, '', NULL, 'The Protective equipment consists of garments placed to protect the health care workers or any other persons to get infected.', '', '', '1', '1', '1', '1', '35.png', '15.png', '25.png', '36.png', '2020-07-26 18:11:34', '2020-07-26 18:13:33', '', '', '1'),
(24, 'mask', 2, 3, 'H002', 'MASK', '316.80', '316.80', '360', NULL, NULL, '48', NULL, NULL, NULL, '200gm', NULL, 'DELIVERY CHARGES INCLUDED ', '<p>Feature is optional</p>\r\n', '<p>Description is optional</p>\r\n', '1', '1', '1', '1', '16.png', '26.png', '17.png', '27.png', '2020-07-26 18:23:35', '2020-07-28 09:59:51', '', '', '1'),
(25, 'rcpcr-kit', 2, 2, 'RCPCR', 'RCPCR KIT updated', '882.00', '882.00', '900', 40, NULL, '900', NULL, NULL, NULL, '300gm', NULL, 'This is the small description updated', '<p>this is the features of small description updated</p>\r\n', '<p>this is the features of small description updated</p>\r\n', '0', '0', '0', '0', 'final_keralkart.png', 'vest.png', '31.jpg', '411.jpg', '2020-07-28 11:04:14', '2020-07-28 13:48:22', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `refundorder`
--

CREATE TABLE `refundorder` (
  `id` int(11) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `orderId` varchar(50) DEFAULT NULL,
  `refundAmount` varchar(50) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `productCode` varchar(250) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `stockPrice` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `productID` varchar(11) NOT NULL,
  `sellingPrice` varchar(11) NOT NULL,
  `discount` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `productCode`, `brand`, `color`, `size`, `stockPrice`, `quantity`, `added_at`, `updated_at`, `status`, `productID`, `sellingPrice`, `discount`) VALUES
(1, 'KUM01', NULL, '#f72626', 'General ', '108', 1, '2020-07-23 03:15:24.000000', '2020-07-26 21:49:38', 0, '1', '120', ''),
(2, 'KUM05', NULL, '#eb2d2d', 'General ', '120', 1, '2020-07-23 03:23:12.000000', '2020-07-26 21:49:53', 0, '2', '108.00', '10'),
(3, 'KUM02', NULL, '#eb0a0a', 'General ', '100', 1, '2020-07-23 03:32:37.000000', '2020-07-26 21:49:55', 0, '3', '85.00', '15'),
(4, 'KUM03', NULL, '#ed1212', 'General ', '120', 1, '2020-07-23 03:38:27.000000', '2020-07-26 21:50:03', 0, '4', '108.00', '10'),
(5, 'KUM04', NULL, '#d53030', 'General ', '105', 1, '2020-07-23 03:48:23.000000', '2020-07-26 21:50:10', 0, '5', '88.40', '15'),
(6, 'PA11', NULL, '#e0cf10', 'General ', '100', 1, '2020-07-23 03:57:58.000000', '2020-07-26 21:58:59', 0, '6', '85.00', '15'),
(7, 'PA10', NULL, '#ec659b', 'General ', '100', 1, '2020-07-23 04:10:14.000000', '2020-07-26 21:59:05', 0, '8', '85.00', '15'),
(8, 'KUM04_4', NULL, '#f80d0d', '', '120', 3, '2020-07-26 14:49:00.000000', '2020-07-26 21:50:34', 0, '6', '102.00', '15'),
(9, 'K001', NULL, '#e01010', 'General ', '120', 5, '2020-07-26 14:54:19.000000', '2020-07-26 21:54:03', 0, '7', '108.00', '10'),
(10, 'K002', NULL, '#eddb0c', 'General ', '120', 5, '2020-07-26 14:58:42.000000', '2020-07-26 21:54:10', 0, '8', '108.00', '10'),
(11, 'K003', NULL, '#f01919', 'General ', '90', 5, '2020-07-26 15:07:44.000000', '2020-07-26 21:54:29', 0, '9', '81.00', '10'),
(12, 'K004', NULL, '#f21c1c', 'General ', '90', 5, '2020-07-26 15:14:33.000000', '2020-07-26 21:54:31', 0, '10', '80.00', '20'),
(13, 'K05', NULL, '#d71919', 'General ', '100', 5, '2020-07-26 15:22:25.000000', '2020-07-26 21:54:33', 0, '11', '80.00', '20'),
(14, 'K06', NULL, '#d3e73c', 'General ', '100', 5, '2020-07-26 15:28:01.000000', '2020-07-26 21:54:54', 0, '12', '90.00', '10'),
(15, 'PA11', NULL, '#eee71b', 'General ', '100', 5, '2020-07-26 22:58:22.000000', '2020-07-26 21:58:53', 0, '13', '90.00', '10'),
(16, 'PA12', NULL, '#e4d52f', 'General ', '130', 5, '2020-07-26 23:02:32.000000', NULL, 1, '14', '110.50', '15'),
(17, 'PA1', NULL, '#cdb932', 'General ', '80', 5, '2020-07-26 23:05:43.000000', NULL, 1, '15', '72.00', '10'),
(18, 'PA4', NULL, '#30d110', 'General ', '80', 5, '2020-07-26 23:09:03.000000', NULL, 1, '16', '72.00', '10'),
(19, 'PA3', NULL, '#e01a1a', 'General ', '80', 5, '2020-07-26 23:12:04.000000', NULL, 1, '17', '72.00', '10'),
(20, 'PA21', NULL, '#000000', 'General ', '120', 5, '2020-07-26 23:19:51.000000', NULL, 1, '18', '102.00', '15'),
(21, 'PA14', NULL, '#f47f1f', 'General ', '120', 5, '2020-07-26 23:24:00.000000', NULL, 1, '19', '108.00', '10'),
(22, 'PA17', NULL, '#28cacc', 'General ', '130', 5, '2020-07-26 23:30:00.000000', '2020-07-26 20:04:11', 1, '20', '110.50', '15'),
(23, 'H01', NULL, '#dbdef5', 'General ', '1400', 10, '2020-07-27 00:29:51.000000', '2020-07-26 17:33:20', 0, '21', '1190.00', '15'),
(24, 'H01', NULL, '#dbe8eb', '', '1500', 10, '2020-07-27 00:34:25.000000', '2020-07-26 18:04:05', 0, '21', '1125.00', '25'),
(25, 'H01', NULL, '#b0dcf2', 'General ', '1500', 10, '2020-07-27 01:07:31.000000', '2020-07-26 18:08:48', 0, '22', '1125.00', '25'),
(26, 'H001', NULL, '#3ebad0', 'General ', '1500', 10, '2020-07-27 01:12:57.000000', NULL, 1, '23', '1125.00', '25'),
(27, 'H002', NULL, '#000000', 'General ', '360', 48, '2020-07-27 01:26:08.000000', NULL, 1, '24', '316.80', '12'),
(28, 'PA17', NULL, '#28cacc', 'General ', '130', 6, '2020-07-27 03:11:13.000000', NULL, 1, '20', '110.50', '15'),
(29, 'PA14', NULL, '#f47f1f', 'General ', '120', 6, '2020-07-27 03:15:25.000000', NULL, 1, '19', '108.00', '10'),
(30, 'PA21', NULL, '#000000', 'General ', '120', 6, '2020-07-27 03:18:03.000000', NULL, 1, '18', '102.00', '15'),
(31, 'PA3', NULL, '#e01919', 'General ', '80', 6, '2020-07-27 03:20:32.000000', NULL, 1, '17', '72.00', '10'),
(32, 'PA4', NULL, '#30d110', 'General ', '80', 6, '2020-07-27 03:22:49.000000', NULL, 1, '16', '72.00', '10'),
(33, 'KUM01', NULL, '#f90101', 'General ', '120', 5, '2020-07-27 04:51:22.000000', NULL, 1, '1', '108.00', '10'),
(34, 'KUM05', NULL, '#ed0c0c', 'General ', '120', 5, '2020-07-27 04:51:49.000000', NULL, 1, '2', '108.00', '10'),
(35, 'KUM02', NULL, '#e20808', 'General ', '120', 5, '2020-07-27 04:52:28.000000', NULL, 1, '3', '108.00', '10'),
(36, 'KUM03', NULL, '#ea1a1a', 'General ', '120', 5, '2020-07-27 04:52:58.000000', NULL, 1, '4', '108.00', '10'),
(37, 'KUM04 _4', NULL, '#e51f1f', 'General ', '120', 5, '2020-07-27 04:53:29.000000', NULL, 1, '6', '108.00', '10'),
(38, 'K001', NULL, '#ea3e3e', 'General ', '120', 5, '2020-07-27 04:55:51.000000', NULL, 1, '7', '102.00', '15'),
(39, 'K002', NULL, '#f22626', 'General ', '120', 5, '2020-07-27 04:56:19.000000', NULL, 1, '8', '102.00', '15'),
(40, 'K003', NULL, '#d33c3c', 'General ', '120', 5, '2020-07-27 04:56:41.000000', NULL, 1, '9', '102.00', '15'),
(41, 'K004', NULL, '#ed2c2c', 'General ', '120', 5, '2020-07-27 04:57:06.000000', '2020-07-28 11:37:44', 0, '10', '102.00', '15'),
(42, 'K05', NULL, '#cf3030', 'General ', '120', 5, '2020-07-27 04:57:35.000000', NULL, 1, '11', '96.00', '20'),
(43, 'K06', NULL, '#f23a3a', 'General ', '120', 5, '2020-07-27 04:58:02.000000', NULL, 1, '12', '102.00', '15'),
(44, 'PA11', NULL, '#d51a1a', 'General ', '120', 5, '2020-07-27 04:59:56.000000', NULL, 1, '13', '108.00', '10'),
(45, 'PA12', NULL, '#c92626', 'General ', '125', 5, '2020-07-27 05:00:24.000000', NULL, 1, '14', '112.50', '10'),
(46, 'PA1', NULL, '#ce0909', 'General ', '100', 5, '2020-07-27 05:01:10.000000', NULL, 1, '15', '75.00', '25'),
(47, 'RCPCR', NULL, '#bde433', 'freesize', '900', 900, '2020-07-28 05:45:54.000000', NULL, 1, '25', '882.00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `stockreport`
--

CREATE TABLE `stockreport` (
  `id` int(11) NOT NULL,
  `productCode` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `stockPrice` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `productID` varchar(11) NOT NULL,
  `sellingPrice` varchar(11) NOT NULL,
  `discount` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockreport`
--

INSERT INTO `stockreport` (`id`, `productCode`, `brand`, `color`, `size`, `stockPrice`, `quantity`, `added_at`, `updated_at`, `status`, `productID`, `sellingPrice`, `discount`) VALUES
(1, 'KUM01', NULL, '#f72626', 'General ', '120', 1, '2020-07-22 20:15:24', NULL, 1, '1', '120', ''),
(2, 'KUM05', NULL, '#eb2d2d', 'General ', '120', 1, '2020-07-22 20:23:12', NULL, 1, '2', '108.00', '10'),
(3, 'KUM02', NULL, '#eb0a0a', 'General ', '100', 1, '2020-07-22 20:32:37', NULL, 1, '3', '85.00', '15'),
(4, 'KUM03', NULL, '#ed1212', 'General ', '120', 1, '2020-07-22 20:38:27', NULL, 1, '4', '108.00', '10'),
(5, 'KUM04', NULL, '#d53030', 'General ', '104', 1, '2020-07-22 20:48:23', NULL, 1, '5', '88.40', '15'),
(6, 'PA11', NULL, '#e0cf10', 'General ', '100', 1, '2020-07-22 20:57:58', NULL, 1, '6', '85.00', '15'),
(7, 'PA10', NULL, '#ec659b', 'General ', '100', 1, '2020-07-22 21:10:14', NULL, 1, '8', '85.00', '15'),
(8, 'KUM04_4', NULL, '#f80d0d', '', '120', 3, '2020-07-26 07:49:00', NULL, 1, '6', '102.00', '15'),
(9, 'K001', NULL, '#e01010', 'General ', '120', 5, '2020-07-26 07:54:19', NULL, 1, '7', '108.00', '10'),
(10, 'K002', NULL, '#eddb0c', 'General ', '120', 5, '2020-07-26 07:58:42', NULL, 1, '8', '108.00', '10'),
(11, 'K003', NULL, '#f01919', 'General ', '90', 5, '2020-07-26 08:07:44', NULL, 1, '9', '81.00', '10'),
(12, 'K004', NULL, '#f21c1c', 'General ', '100', 5, '2020-07-26 08:14:33', NULL, 1, '10', '80.00', '20'),
(13, 'K05', NULL, '#d71919', 'General ', '100', 5, '2020-07-26 08:22:25', NULL, 1, '11', '80.00', '20'),
(14, 'K06', NULL, '#d3e73c', 'General ', '100', 5, '2020-07-26 08:28:01', NULL, 1, '12', '90.00', '10'),
(15, 'PA11', NULL, '#eee71b', 'General ', '100', 5, '2020-07-26 15:58:22', NULL, 1, '13', '90.00', '10'),
(16, 'PA12', NULL, '#e4d52f', 'General ', '130', 5, '2020-07-26 16:02:32', NULL, 1, '14', '110.50', '15'),
(17, 'PA1', NULL, '#cdb932', 'General ', '80', 5, '2020-07-26 16:05:43', NULL, 1, '15', '72.00', '10'),
(18, 'PA4', NULL, '#30d110', 'General ', '80', 5, '2020-07-26 16:09:03', NULL, 1, '16', '72.00', '10'),
(19, 'PA3', NULL, '#e01a1a', 'General ', '80', 5, '2020-07-26 16:12:04', NULL, 1, '17', '72.00', '10'),
(20, 'PA21', NULL, '#000000', 'General ', '120', 5, '2020-07-26 16:19:51', NULL, 1, '18', '102.00', '15'),
(21, 'PA14', NULL, '#f47f1f', 'General ', '120', 5, '2020-07-26 16:24:00', NULL, 1, '19', '108.00', '10'),
(22, 'PA17', NULL, '#28cacc', 'General ', '130', 5, '2020-07-26 16:30:00', NULL, 1, '20', '110.50', '15'),
(23, 'H01', NULL, '#dbdef5', 'General ', '1400', 10, '2020-07-26 17:29:51', NULL, 1, '21', '1190.00', '15'),
(24, 'H01', NULL, '#dbe8eb', '', '1500', 10, '2020-07-26 17:34:25', NULL, 1, '21', '1125.00', '25'),
(25, 'H01', NULL, '#b0dcf2', 'General ', '1500', 10, '2020-07-26 18:07:31', NULL, 1, '22', '1125.00', '25'),
(26, 'H001', NULL, '#3ebad0', 'General ', '1500', 10, '2020-07-26 18:12:57', NULL, 1, '23', '1125.00', '25'),
(27, 'H002', NULL, '#000000', 'General ', '360', 48, '2020-07-26 18:26:08', NULL, 1, '24', '316.80', '12'),
(28, 'PA17', NULL, '#28cacc', 'General ', '130', 6, '2020-07-26 20:11:13', NULL, 1, '20', '110.50', '15'),
(29, 'PA14', NULL, '#f47f1f', 'General ', '120', 6, '2020-07-26 20:15:25', NULL, 1, '19', '108.00', '10'),
(30, 'PA21', NULL, '#000000', 'General ', '120', 6, '2020-07-26 20:18:03', NULL, 1, '18', '102.00', '15'),
(31, 'PA3', NULL, '#e01919', 'General ', '80', 6, '2020-07-26 20:20:32', NULL, 1, '17', '72.00', '10'),
(32, 'PA4', NULL, '#30d110', 'General ', '80', 6, '2020-07-26 20:22:49', NULL, 1, '16', '72.00', '10'),
(33, 'KUM01', NULL, '#f90101', 'General ', '120', 5, '2020-07-26 21:51:22', NULL, 1, '1', '108.00', '10'),
(34, 'KUM05', NULL, '#ed0c0c', 'General ', '120', 5, '2020-07-26 21:51:49', NULL, 1, '2', '108.00', '10'),
(35, 'KUM02', NULL, '#e20808', 'General ', '120', 5, '2020-07-26 21:52:28', NULL, 1, '3', '108.00', '10'),
(36, 'KUM03', NULL, '#ea1a1a', 'General ', '120', 5, '2020-07-26 21:52:58', NULL, 1, '4', '108.00', '10'),
(37, 'KUM04 _4', NULL, '#e51f1f', 'General ', '120', 5, '2020-07-26 21:53:29', NULL, 1, '6', '108.00', '10'),
(38, 'K001', NULL, '#ea3e3e', 'General ', '120', 5, '2020-07-26 21:55:51', NULL, 1, '7', '102.00', '15'),
(39, 'K002', NULL, '#f22626', 'General ', '120', 5, '2020-07-26 21:56:19', NULL, 1, '8', '102.00', '15'),
(40, 'K003', NULL, '#d33c3c', 'General ', '120', 5, '2020-07-26 21:56:41', NULL, 1, '9', '102.00', '15'),
(41, 'K004', NULL, '#ed2c2c', 'General ', '120', 5, '2020-07-26 21:57:06', NULL, 1, '10', '102.00', '15'),
(42, 'K05', NULL, '#cf3030', 'General ', '120', 5, '2020-07-26 21:57:35', NULL, 1, '11', '96.00', '20'),
(43, 'K06', NULL, '#f23a3a', 'General ', '120', 5, '2020-07-26 21:58:02', NULL, 1, '12', '102.00', '15'),
(44, 'PA11', NULL, '#d51a1a', 'General ', '120', 5, '2020-07-26 21:59:56', NULL, 1, '13', '108.00', '10'),
(45, 'PA12', NULL, '#c92626', 'General ', '125', 5, '2020-07-26 22:00:24', NULL, 1, '14', '112.50', '10'),
(46, 'PA1', NULL, '#ce0909', 'General ', '100', 5, '2020-07-26 22:01:10', NULL, 1, '15', '75.00', '25'),
(47, 'RCPCR', NULL, '#bde433', 'freesize', '900', 900, '2020-07-28 11:15:54', NULL, 1, '25', '882.00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `subCategoryName` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `url_slug` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryId`, `subCategoryName`, `added_at`, `updated_at`, `status`, `url_slug`) VALUES
(1, 1, 'Rakhi', '2020-07-22 20:05:49', NULL, 1, 'rakhi'),
(2, 2, 'PPE KIT', '2020-07-26 17:20:15', NULL, 1, 'ppe-kit'),
(3, 2, 'Mask', '2020-07-26 17:20:36', NULL, 1, 'mask');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blogId` int(11) NOT NULL,
  `blogHeading` text,
  `url_slug` text,
  `blogContent` text,
  `blog_image` varchar(255) DEFAULT NULL,
  `createdBy` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blogId`, `blogHeading`, `url_slug`, `blogContent`, `blog_image`, `createdBy`, `added_at`, `modified_at`, `status`) VALUES
(1, 'Air borne COVID 19', 'air-borne-covid-19', '&lt;p dir=&quot;ltr&quot; style=&quot;text-align:justify&quot;&gt;Covid 19 has left the entire world to come to a standstill. Ever since it has emerged, it has taken a toll on the human kind drastically. The damages it has caused over a period of time, the world&amp;#39;s still trying to come in terms with. People are trying the best they can to fight on the face of it with these unprecedented times. Covid is now a household name which is known across the globe now. In the direction of its progression now we have discovered that it can now spread through airborne transmission.&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:justify&quot;&gt;Airborne covid is a recent development in the behaviour of transmission of infection. Airborne Covid transmission can happen in medical facilities and in close crowded places like restaurants, fitness centres and others. Especially in Medical facilities PPE kits should be provided without fail. People indulged in the jobs where they are bound to come in contact with different people should use PPE kits for their own safety and the safety of the other people.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:justify&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p dir=&quot;ltr&quot; style=&quot;text-align:justify&quot;&gt;It happens when a diseased person coughs or sneezes out without covering his mouth. Airborne droplets can travel upto 6-9 feets and remain on the surface from a few minutes to a few hours. Now it has become ever more important to cover our faces with masks as the disease is spreading like a wildfire. Wearing Mask in public should be followed religiously besides social distancing and other protective measures.&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align:justify&quot;&gt;&lt;a href=&quot;https://keralkart.com/&quot;&gt;Keralkart&lt;/a&gt; offers PPE Kits at very affordable prices. Do check out the website for more information.&amp;nbsp;&amp;nbsp;&lt;/p&gt;', 'coronavirus-4914028_1920.jpg', 'admin', '2020-07-26 22:52:34', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gst`
--

CREATE TABLE `tbl_gst` (
  `gst_id` int(11) NOT NULL,
  `gst_name` varchar(255) DEFAULT NULL,
  `gst_rate` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider_mstr`
--

CREATE TABLE `tbl_slider_mstr` (
  `slider_id` int(11) NOT NULL,
  `slider1` varchar(255) DEFAULT NULL,
  `slider2` varchar(255) DEFAULT NULL,
  `slider3` varchar(255) DEFAULT NULL,
  `slider4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider_mstr`
--

INSERT INTO `tbl_slider_mstr` (`slider_id`, `slider1`, `slider2`, `slider3`, `slider4`) VALUES
(1, '_wE8OLZ_top-banner1.png', '_h1oOXo_1.jpg', '_eyoCrQ_top-banner1.png', '_63qzj4_top-banner2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribed_email`
--

CREATE TABLE `tbl_subscribed_email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `typeName` varchar(255) DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `typeName`, `added_at`, `updated_at`, `status`) VALUES
(1, 'Festive Products', '2020-07-22 07:35:38', NULL, 1),
(2, 'Health Care', '2020-07-26 17:17:58', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userseennotification`
--

CREATE TABLE `userseennotification` (
  `id` int(11) NOT NULL,
  `notificaionId` int(11) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `seen_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `coupondetail`
--
ALTER TABLE `coupondetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_items`
--
ALTER TABLE `ordered_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentdetail`
--
ALTER TABLE `paymentdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productrating`
--
ALTER TABLE `productrating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreview`
--
ALTER TABLE `productreview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refundorder`
--
ALTER TABLE `refundorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockreport`
--
ALTER TABLE `stockreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `tbl_gst`
--
ALTER TABLE `tbl_gst`
  ADD PRIMARY KEY (`gst_id`) USING BTREE;

--
-- Indexes for table `tbl_slider_mstr`
--
ALTER TABLE `tbl_slider_mstr`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_subscribed_email`
--
ALTER TABLE `tbl_subscribed_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userseennotification`
--
ALTER TABLE `userseennotification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupondetail`
--
ALTER TABLE `coupondetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordered_items`
--
ALTER TABLE `ordered_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentdetail`
--
ALTER TABLE `paymentdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productrating`
--
ALTER TABLE `productrating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productreview`
--
ALTER TABLE `productreview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `refundorder`
--
ALTER TABLE `refundorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `stockreport`
--
ALTER TABLE `stockreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_gst`
--
ALTER TABLE `tbl_gst`
  MODIFY `gst_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subscribed_email`
--
ALTER TABLE `tbl_subscribed_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userseennotification`
--
ALTER TABLE `userseennotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
