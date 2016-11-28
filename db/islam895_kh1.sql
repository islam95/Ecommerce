-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2015 at 11:14 AM
-- Server version: 5.6.23
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `islam895_kh1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Islam', 'Dudaev', 'islam89uk@gmail.com', 'islam895');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Accessories'),
(2, 'Dresses'),
(3, 'Hoodies'),
(4, 'Jackets & Coats'),
(5, 'Jeans'),
(6, 'Jumpers & Cardigans'),
(7, 'Leather Jackets'),
(8, 'Shirts'),
(9, 'Shoes & Boots'),
(10, 'Suits & Blazers'),
(11, 'T-Shirts'),
(12, 'Underwear & Socks');

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

CREATE TABLE IF NOT EXISTS `colours` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `colour` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`id`, `colour`) VALUES
(1, 'White'),
(2, 'Black'),
(3, 'Navy'),
(4, 'Blue'),
(5, 'Grey'),
(6, 'Green'),
(7, 'Red'),
(8, 'Brown'),
(9, 'Pink'),
(10, 'Yellow'),
(11, 'Indigo'),
(12, 'Lead'),
(13, 'Chocolate');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `phone`, `email`, `website`) VALUES
(1, 'Khizir Store', '123 Bastwick Street<br />London<br />EC1V 3AQ', '01434 454 345', 'info@khizir.com', 'Khizir.com');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `value` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `value`) VALUES
(1, 'DIS10', '0.10'),
(2, 'DIS15', '0.15'),
(3, 'DIS20', '0.20'),
(4, 'DIS25', '0.25'),
(5, 'DIS50', '0.50');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` int(10) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `paypal_status` tinyint(1) NOT NULL DEFAULT '0',
  `txn_id` varchar(100) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `ipn` text,
  `response` varchar(100) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user`, `total`, `date`, `status`, `paypal_status`, `txn_id`, `payment_status`, `ipn`, `response`, `notes`) VALUES
(1, 1, '80.00', '2015-11-01 16:32:00', 1, 0, NULL, NULL, NULL, NULL, NULL),
(2, 1, '25.00', '2015-11-01 18:49:01', 1, 0, NULL, NULL, NULL, NULL, NULL),
(3, 1, '18.00', '2015-11-01 19:00:36', 1, 0, NULL, NULL, NULL, NULL, NULL),
(4, 1, '18.00', '2015-11-01 20:28:55', 1, 0, NULL, NULL, NULL, NULL, NULL),
(5, 2, '18.00', '2015-11-01 20:34:55', 1, 0, NULL, NULL, NULL, NULL, NULL),
(6, 2, '18.00', '2015-11-01 22:01:27', 1, 0, NULL, NULL, NULL, NULL, NULL),
(7, 2, '25.00', '2015-11-01 22:17:08', 1, 0, NULL, NULL, NULL, NULL, NULL),
(8, 2, '18.00', '2015-11-01 22:24:29', 1, 1, '40P32712R8153722C', 'Completed', 'mc_gross : 18.00\nprotection_eligibility : Eligible\naddress_status : confirmed\nitem_number1 : 5\npayer_id : WBMAT5GBGJ74Y\ntax : 0.00\naddress_street : sdfdsk\r\ndsf;lk\npayment_date : 14:24:43 Nov 01, 2015 PST\npayment_status : Completed\ncharset : windows-1252\naddress_zip : sdf;kl\nmc_shipping : 0.00\nmc_handling : 0.00\nfirst_name : Islam\nmc_fee : 0.81\naddress_country_code : GB\naddress_name : islam dudaeb\nnotify_version : 3.8\ncustom : 8\npayer_status : verified\nbusiness : acjx557-merchant@gmail.com\naddress_country : United Kingdom\nnum_cart_items : 1\nmc_handling1 : 0.00\naddress_city : dsfds\nverify_sign : AAqF1Yl.5zCXDVuyEillgHdJMwtSALLJt8yioHBr-B8VKMDqdXCcBJ2Y\npayer_email : acjx557-customer1@gmail.com\nmc_shipping1 : 0.00\ntax1 : 0.00\ntxn_id : 40P32712R8153722C\npayment_type : instant\nlast_name : Customer\naddress_state : sdpioepwo\nitem_name1 : Crew T-shirt\nreceiver_email : acjx557-merchant@gmail.com\npayment_fee : \nquantity1 : 1\nreceiver_id : 57MAV7KHDUDY6\ntxn_type : cart\nmc_gross_1 : 18.00\nmc_currency : GBP\nresidence_country : GB\ntest_ipn : 1\ntransaction_subject : 8\npayment_gross : \nipn_track_id : faba79ba908bc', 'VERIFIED', NULL),
(9, 3, '76.00', '2015-11-01 22:32:23', 1, 0, NULL, NULL, NULL, NULL, NULL),
(10, 2, '25.00', '2015-11-02 15:51:50', 1, 1, '7YG46812BY370390G', 'Completed', 'mc_gross : 25.00\nprotection_eligibility : Eligible\naddress_status : confirmed\nitem_number1 : 4\npayer_id : WBMAT5GBGJ74Y\ntax : 0.00\naddress_street : sdfdsk\r\ndsf;lk\npayment_date : 07:52:04 Nov 02, 2015 PST\npayment_status : Completed\ncharset : windows-1252\naddress_zip : sdf;kl\nmc_shipping : 0.00\nmc_handling : 0.00\nfirst_name : Islam\nmc_fee : 1.05\naddress_country_code : GB\naddress_name : islam dudaeb\nnotify_version : 3.8\ncustom : 10\npayer_status : verified\nbusiness : acjx557-merchant@gmail.com\naddress_country : United Kingdom\nnum_cart_items : 1\nmc_handling1 : 0.00\naddress_city : dsfds\nverify_sign : ACACPbgKSl.42IeOt.XH2hhD6fNaAUFVonUJluDIm4UMEstJfwR6NbWv\npayer_email : acjx557-customer1@gmail.com\nmc_shipping1 : 0.00\ntax1 : 0.00\ntxn_id : 7YG46812BY370390G\npayment_type : instant\nlast_name : Customer\naddress_state : sdpioepwo\nitem_name1 : Ella Skinny Jeans\nreceiver_email : acjx557-merchant@gmail.com\npayment_fee : \nquantity1 : 1\nreceiver_id : 57MAV7KHDUDY6\ntxn_type : cart\nmc_gross_1 : 25.00\nmc_currency : GBP\nresidence_country : GB\ntest_ipn : 1\ntransaction_subject : 10\npayment_gross : \nipn_track_id : d7b5f508ae39b', 'VERIFIED', NULL),
(11, 2, '25.00', '2015-11-02 17:37:23', 1, 1, '1D364613HD022600L', 'Completed', 'mc_gross : 25.00\nprotection_eligibility : Eligible\naddress_status : confirmed\nitem_number1 : 4\npayer_id : WBMAT5GBGJ74Y\ntax : 0.00\naddress_street : sdfdsk\r\ndsf;lk\npayment_date : 09:37:38 Nov 02, 2015 PST\npayment_status : Completed\ncharset : windows-1252\naddress_zip : sdf;kl\nmc_shipping : 0.00\nmc_handling : 0.00\nfirst_name : Islam\nmc_fee : 1.05\naddress_country_code : GB\naddress_name : islam dudaeb\nnotify_version : 3.8\ncustom : 11\npayer_status : verified\nbusiness : acjx557-merchant@gmail.com\naddress_country : United Kingdom\nnum_cart_items : 1\nmc_handling1 : 0.00\naddress_city : dsfds\nverify_sign : ApBHX6qbpxJW-Ll3oP22LSbo0WeuAJDhHNv1VyyAZ.NS.fGd5j2igiea\npayer_email : acjx557-customer1@gmail.com\nmc_shipping1 : 0.00\ntax1 : 0.00\ntxn_id : 1D364613HD022600L\npayment_type : instant\nlast_name : Customer\naddress_state : sdpioepwo\nitem_name1 : Ella Skinny Jeans\nreceiver_email : acjx557-merchant@gmail.com\npayment_fee : \nquantity1 : 1\nreceiver_id : 57MAV7KHDUDY6\ntxn_type : cart\nmc_gross_1 : 25.00\nmc_currency : GBP\nresidence_country : GB\ntest_ipn : 1\ntransaction_subject : 11\npayment_gross : \nipn_track_id : bdd4ee86f12fe', 'VERIFIED', NULL),
(12, 2, '18.00', '2015-11-02 17:39:20', 1, 1, '21C8183576407554Y', 'Completed', 'mc_gross : 18.00\nprotection_eligibility : Eligible\naddress_status : confirmed\nitem_number1 : 5\npayer_id : WBMAT5GBGJ74Y\ntax : 0.00\naddress_street : sdfdsk\r\ndsf;lk\npayment_date : 09:39:36 Nov 02, 2015 PST\npayment_status : Completed\ncharset : windows-1252\naddress_zip : sdf;kl\nmc_shipping : 0.00\nmc_handling : 0.00\nfirst_name : Islam\nmc_fee : 0.81\naddress_country_code : GB\naddress_name : islam dudaeb\nnotify_version : 3.8\ncustom : 12\npayer_status : verified\nbusiness : acjx557-merchant@gmail.com\naddress_country : United Kingdom\nnum_cart_items : 1\nmc_handling1 : 0.00\naddress_city : dsfds\nverify_sign : A--8MSCLabuvN8L.-MHjxC9uypBtAn2ctNFVsJ1VIKS1sfn2UIdYcwD4\npayer_email : acjx557-customer1@gmail.com\nmc_shipping1 : 0.00\ntax1 : 0.00\ntxn_id : 21C8183576407554Y\npayment_type : instant\nlast_name : Customer\naddress_state : sdpioepwo\nitem_name1 : Crew T-shirt\nreceiver_email : acjx557-merchant@gmail.com\npayment_fee : \nquantity1 : 1\nreceiver_id : 57MAV7KHDUDY6\ntxn_type : cart\nmc_gross_1 : 18.00\nmc_currency : GBP\nresidence_country : GB\ntest_ipn : 1\ntransaction_subject : 12\npayment_gross : \nipn_track_id : 237bf1b4ae876', 'VERIFIED', NULL),
(13, 2, '18.00', '2015-11-02 17:57:32', 1, 1, '24V10122PN239350E', 'Completed', 'mc_gross : 18.00\nprotection_eligibility : Eligible\naddress_status : confirmed\nitem_number1 : 5\npayer_id : WBMAT5GBGJ74Y\ntax : 0.00\naddress_street : sdfdsk\r\ndsf;lk\npayment_date : 09:57:52 Nov 02, 2015 PST\npayment_status : Completed\ncharset : windows-1252\naddress_zip : sdf;kl\nmc_shipping : 0.00\nmc_handling : 0.00\nfirst_name : Islam\nmc_fee : 0.81\naddress_country_code : GB\naddress_name : islam dudaeb\nnotify_version : 3.8\ncustom : 13\npayer_status : verified\nbusiness : acjx557-merchant@gmail.com\naddress_country : United Kingdom\nnum_cart_items : 1\nmc_handling1 : 0.00\naddress_city : dsfds\nverify_sign : ALrJLuOnAEp6ftkyfh0BYieCW4xyA2qux2vFQrliuRU1Cp4l.AB23YjE\npayer_email : acjx557-customer1@gmail.com\nmc_shipping1 : 0.00\ntax1 : 0.00\ntxn_id : 24V10122PN239350E\npayment_type : instant\nlast_name : Customer\naddress_state : sdpioepwo\nitem_name1 : Crew T-shirt\nreceiver_email : acjx557-merchant@gmail.com\npayment_fee : \nquantity1 : 1\nreceiver_id : 57MAV7KHDUDY6\ntxn_type : cart\nmc_gross_1 : 18.00\nmc_currency : GBP\nresidence_country : GB\ntest_ipn : 1\ntransaction_subject : 13\npayment_gross : \nipn_track_id : f64af9702678', 'VERIFIED', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(10) NOT NULL,
  `product` int(10) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `product` (`product`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order`, `product`, `price`, `qty`) VALUES
(1, 1, 2, '40.00', 2),
(2, 2, 4, '25.00', 1),
(3, 3, 5, '18.00', 1),
(4, 4, 5, '18.00', 1),
(5, 5, 5, '18.00', 1),
(6, 6, 5, '18.00', 1),
(7, 7, 4, '25.00', 1),
(8, 8, 5, '18.00', 1),
(9, 9, 5, '18.00', 2),
(10, 9, 2, '40.00', 1),
(11, 10, 4, '25.00', 1),
(12, 11, 4, '25.00', 1),
(13, 12, 5, '18.00', 1),
(14, 13, 5, '18.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `date` datetime NOT NULL,
  `category` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `colour` int(10) DEFAULT NULL,
  `size_number` int(10) DEFAULT NULL,
  `size_letter` int(10) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `colour` (`colour`),
  KEY `size_number` (`size_number`),
  KEY `size_letter` (`size_letter`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `date`, `category`, `image`, `colour`, `size_number`, `size_letter`, `brand`) VALUES
(1, 'Highwayman Bridge Coat', '<p>Layering is king when temperatures drop, and a chunky coat is integral to the winter assemble. The single-breasted overcoat provides a broad silhouette that’s long been a favourite of those who want premium protection from the elements.</p>\r\n<p>The Highwayman Bridge coat from Superdry is fitted with a one button fastening and twin side pockets that are the perfect place to keep your hands away out the cold. The centre vent provides a tailored silhouette, whilst the inner lining buzzes with flashes of blue.</p>\r\n<p>Whether you’re using it to protect your suit from the morning commute or wearing it at the weekends to upgrade your off-duty attire, this Superdry coat is a solid investment for the cold that won’t ever go out of fashion.</p>\r\n<p>Details:</p>\r\n<ul>\r\n	<li>Mens coat by Superdry</li>\r\n	<li>Highwayman Bridge</li>\r\n	<li>Slim fit</li>\r\n	<li>Single breasted with 1 button fastening</li>\r\n	<li>Dual side pockets</li>\r\n	<li>Centre vent</li>\r\n</ul>\r\n<p>60% wool, 40% other fibres. Dry clean only.</p>', '100.00', '2015-04-24 23:34:23', 4, 'HighwaymanBridgeCoat.jpg', 5, NULL, 4, 'Superdry'),
(2, 'Hi-Tec Waterproof Jacket', '<p>ONLINE EXCLUSIVE</p><p>Get set for this year’s outdoor adventures in this waterproof jacket from Hi-Tec. With a zipped pockets on the hip and a Hi-Tec logo on the chest, the jacket is made with TECPROOF technology with taped seams, a funnel neckline, covered placket and pack-away hood for warmth.</p>\r\n<p>Zip-through fastening with a riptape fastened placket</p>\r\n<p>Sits on the hip</p>', '40.00', '2015-04-24 12:34:23', 4, 'WaterproofJacket.png', 4, NULL, 5, 'Hi-Tec'),
(3, 'Petite Tea Dress', '<p>With a choice of two staple colours – this petite fit tea dress by South effortlessly takes you from week-to-weekend in classic style.</p>\r\n<p>This petite tea dress is a blend of sassy and sweet making it the perfect pick to see you from the office to the dance floor. The wrap style top makes the most of your feminine curves for a sleek silhouette, while the short-sleeved cut keeps you cool in the sunshine. Its cinched waist defines your shape and the flippy skirt is a flirty twist that stays classy in length!</p>\r\n<p>Wear this petite fit tea dress with block heeled sandals for a cute look on your next hot date.</p>\r\n<p>Useful info:</p>\r\n<ul>\r\n	<li>Tea dress by South</li>\r\n	<li>Designed for the petite figure</li>\r\n	<li>Cinched waist</li>\r\n	<li>V-neckline</li>\r\n	<li>Short-sleeved</li>\r\n	<li>33 inch length</li>\r\n</ul>\r\n<p>95% viscose, 5% elastane. Machine washable.</p>', '8.20', '2015-04-24 13:34:12', 2, 'SouthPetiteTeaDress.png', 3, 1, NULL, 'South'),
(4, 'Ella Skinny Jeans', '<p>Super-skinny in a choice of two washes, these Ella high rise skinny jeans from South perfectly complement your off-duty style.</p>\r\n<p>Skinny jeans are a style staple in every women’s wardrobe. These skinnies, with their high rise design, lend your legs supermodel length! In a super-soft fabric with a slight stretch they’re so comfy you won’t want to take them off - perfect for round the clock dressing. The statement washes sleeken the silhouette and bring versatility day-to-night.</p>\r\n<p>Pair these super soft skinny jeans with crop top, heels and accessories with a clutch for effortless chic.</p>\r\n</p>Useful info:</p>\r\n<ul>\r\n	<li>Skinny jeans by South</li>\r\n	<li>High rise design</li>\r\n	<li>Button and fly fastening to front</li>\r\n	<li>5-pocket detail</li>\r\n	<li>Available in 2 sizes</li>\r\n</ul>\r\n<p>Colours: Black, Indigo. 70% cotton, 26% polyester, 4% elastane. Machine washable.</p>', '25.00', '2015-04-25 15:23:54', 5, 'SouthHighRiseEllaJeans.png', 11, 2, NULL, 'South'),
(5, 'Crew T-shirt', '<p>A big hitter in the world of menswear, this tee is given a denim pocket hit that works for a variety of occasions - from dinner on holiday to a night spent socialising.</p>\r\n<p>The round neck, short sleeve silhouette ensures essential comfort, whilst the patterned denim-style pocket is the statement focal point. Matching tipping to the cuffs complete a trendy style that anticipates the summer sunshine.</p>\r\n<p>Pair this T-shirt with denim shorts and boat shoes for smart-casual attire that makes an immediate impact.</p>\r\n<p>Useful info:</p>\r\n<ul>\r\n	<li>Mens T-shirt by Goodsouls</li>\r\n	<li>Contrast denim pocket</li>\r\n	<li>Short sleeve</li>\r\n	<li>Round neck</li>\r\n	<li>Tipping to cuffs</li>\r\n</ul>\r\n<p>Colour: Navy. Cotton. Machine washable.</p>', '18.00', '2015-04-24 16:23:31', 11, 'GoodsoulsMensCrew.png', 3, NULL, 4, 'Goodsouls'),
(6, 'Fill Zip Hoody', '<p>Long-sleeve, brush back full-zip hoody with transparent ripstop overlay on hood and back panel. Zip pull attachment with reflective flecks. Pop colour, full-zip and back bib binding. Centre front, high-density Nike Sportswear logo screen print. Cut-and-sew shoulder and back panels.</p>\r\n<p>Colour: Black/White. 80% cotton, 20% polyester. Machine washable.</p>', '60.00', '2015-04-24 12:34:12', 3, 'FillZipHoody.png', 2, NULL, 5, 'Nike'),
(7, 'Plaintiff Sunglasses', '<p>Oakley Sunglasses Plaintiff Squared Polished Gold/Dark Grey is designed for men and the frame is gold. This style has a xtra large - 63mm - lens diameter. The bridge size for this model is 14mm and the side length is standard. This adult designer sunglasses model is a metal, square shape with a full rimmed frame. The Oakley sunglasses come inclusive of soft bag & cleaning cloth. minmum 12 month warranty and authenticity guaranteed.</p>', '145.00', '2015-04-26 21:53:23', 1, 'PlaintiffSquared.png', 12, NULL, 6, 'Oakley'),
(8, 'Devie Mar Sandals', '<p>Giving the classic a little glam update, the Devie mar leather gladiator sandals by UGG® Australia are the perfect mix of function and style.</p>\r\n<p>Available in two classic colours, go for black for a wear-with-anything guarantee or chocolate to show off your summer tan. Thin criss-cross straps add to the gladiator appeal of these flats, while the double buckled fastenings create an antique look with their old school metal look. Cushioned under foot with a flexible moulded rubber outsole, they provide unparalleled comfort that’ll come in handy when spending days at a time sightseeing this summer.</p>\r\n<p>Wear them with denim shorts, maxi dresses and skirts this season to show off just how versatile they are.</p>\r\n<p>Useful info:</p>\r\n<ul>\r\n   <li>Devie Mar leather gladiator sandals by UGG® Australia</li>\r\n	<li>Thin criss-cross leather straps</li>\r\n	<li>Hidden hook closures for easy entry</li>\r\n	<li>Double metal buckled fastenings to ankle</li>\r\n	<li>Flexible moulded rubber outsole</li>\r\n	<li>Plush Poron® cushioned foot bed</li>\r\n</ul>\r\n<p>Colours: Black, Chocolate. Upper: Leather. Lining: Leather. Sole: Other materials.</p>', '99.00', '2015-04-24 18:24:45', 9, 'DevieMarGladiatorSandals.png', 13, 6, NULL, 'Ugg'),
(9, 'Stretch Shirt', '<p>Slim fit shirt with stretch for fashion fit. Single cuff.</p>\r\n<p>Colour: White. 97% cotton, 3% elastane. Machine washable.</p>', '13.50', '2015-04-24 14:23:43', 8, 'TaylorReeceMensStretch.png', 1, 1, NULL, 'Taylor & Reece'),
(10, 'Slim Fit PV Suit Jacket', '<p>Get suited and booted with this fine Taylor & Reece suit jacket.</p>\r\n<p>In a rich navy colourway it’s a luxurious offering for the contemporary gent. The slim fit ensures that you retain a suave silhouette, whilst the centre back vent allows for an elegant tapered fit.</p>\r\n<p>A minimal two-button fastening with flapover pockets and a single chest pocket provide the essential formal detailing, with a striped contrast lining offering a sharp finish.</p>\r\n<p>Paired with the matching trousers and waistcoat this Taylor & Reece jacket provides the perfect finish to your formal looks.</p>\r\n<p>Useful info:</p>\r\n<ul>\r\n	<li>Mens jacket by Taylor & Reece</li>\r\n	<li>Navy</li>\r\n	<li>Slim fit</li>\r\n	<li>2-button fastening</li>\r\n	<li>Centre back vent</li>\r\n	<li>Contrast lining</li>\r\n	<li>Flapover pockets</li>\r\n	<li>Button cuffs</li>\r\n</ul>\r\n<p>Colour: Navy. 80% polyester, 18% viscose, 2% linen. Dry clean only.</p>', '65.00', '2015-04-24 23:34:12', 4, 'SlimFitPVSuitJacket.png', 3, 11, NULL, 'Taylor & Reece');

-- --------------------------------------------------------

--
-- Table structure for table `size_letters`
--

CREATE TABLE IF NOT EXISTS `size_letters` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `size_letter` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `size_letters`
--

INSERT INTO `size_letters` (`id`, `size_letter`) VALUES
(1, 'XXS'),
(2, 'XS'),
(3, 'S'),
(4, 'M'),
(5, 'L'),
(6, 'XL'),
(7, 'XXL'),
(8, 'XXXL'),
(9, 'XXXXL');

-- --------------------------------------------------------

--
-- Table structure for table `size_numbers`
--

CREATE TABLE IF NOT EXISTS `size_numbers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `size_number` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `size_numbers`
--

INSERT INTO `size_numbers` (`id`, `size_number`) VALUES
(1, '30'),
(2, '31'),
(3, '32'),
(4, '33'),
(5, '34'),
(6, '35'),
(7, '36'),
(8, '37'),
(9, '38'),
(10, '39'),
(11, '40'),
(12, '41'),
(13, '42'),
(14, '43');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Dispatched');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `encode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `county`, `post_code`, `country`, `email`, `password`, `date`, `active`, `encode`) VALUES
(1, 'Islam', 'Wolf', '7w', 'Bron Gre', 'Newcastle upon Tyne', 'Tyne and Wear', 'NW3 5NS', 'UK', 'islamwolf@gmail.com', 'cec776d1d50be955a0cadb53a823122ea97ed2ee82416895ad18987872c7db65f72cdf883ceeefa11ed7779e05d64a57', '2015-11-01 16:29:48', 1, '502543886201511011629481420271146'),
(2, 'islam', 'wefdsfb', 'sdfdsk', 'dsf;lk', 'dsfds', 'sdpioepwo', 'sdf;kl', 'uk', 'islamuk@gmail.com', 'cec776d1d50be955a0cadb53a823122ea97ed2ee82416895ad18987872c7db65f72cdf883ceeefa11ed7779e05d64a57', '2015-11-01 20:34:20', 1, '78701053220151101203420729051514'),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
