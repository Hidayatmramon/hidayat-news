-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 05:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci3_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `identity` varchar(100) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `is_proxy` tinyint(1) NOT NULL DEFAULT 0,
  `asn` varchar(80) DEFAULT NULL,
  `as_name` varchar(200) DEFAULT NULL,
  `isp` varchar(200) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `country_code` varchar(2) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `status` enum('success','failed') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `identity`, `ip`, `user_agent`, `is_proxy`, `asn`, `as_name`, `isp`, `country`, `country_code`, `city`, `region`, `status`, `created_at`) VALUES
(1, NULL, 'sksksm', '::1', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', '2025-10-12 18:55:16'),
(2, 1, 'hidayatmramon', '::1', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'failed', '2025-10-12 18:55:27'),
(3, 1, 'hidayatmramon', '::1', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'success', '2025-10-12 18:55:35'),
(4, 1, 'hidayatmramon', '::1', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'success', '2025-10-12 19:07:54'),
(5, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-12 19:34:03'),
(6, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'failed', '2025-10-12 19:34:26'),
(7, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-12 19:34:34'),
(8, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-13 15:20:11'),
(9, 1, 'hidayatmramon', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'success', '2025-10-13 17:09:57'),
(10, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'failed', '2025-10-13 17:20:47'),
(11, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-13 17:20:57'),
(12, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-13 17:21:41'),
(13, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 01:29:38'),
(14, 2, 'editor', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 01:33:05'),
(15, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 01:33:48'),
(16, 2, 'editor', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'failed', '2025-10-14 01:34:40'),
(17, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 01:35:03'),
(18, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 06:16:59'),
(19, 2, 'editor', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'failed', '2025-10-14 06:25:28'),
(20, 2, 'editor', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'failed', '2025-10-14 06:25:40'),
(21, 2, 'editor', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'failed', '2025-10-14 06:25:50'),
(22, 2, 'editor', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 06:26:05'),
(23, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 06:26:36'),
(24, 1, 'hidayatmramon', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 07:02:12'),
(25, 1, 'hidayatmramon@gmail.com', '125.165.155.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 0, 'AS7713 PT Telekomunikasi Indonesia', 'telkomnet-as-ap', 'PT. TELKOM INDONESIA', 'Indonesia', 'ID', 'Jakarta', 'Jakarta', 'success', '2025-10-14 09:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `body` mediumtext NOT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image`, `body`, `status`, `published_at`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Fears of renewed US-China trade tensions send Asian stocks south', 'fears-of-renewed-us-china-trade-tensions-send-asian-stocks-south', 'uploads/covers/10497fa49eec68de93354d871d22ab8d.jpg', 'Major stock markets across Asia Pacific region sank Monday amid mounting fears of a renewed trade war between the world’s two largest economies, after US President Donald Trump threatened to impose new triple-digit tariffs on Chinese imports.\r\n\r\nTrump’s threat followed Beijing’s tightening of its control on rare earths, a group of critical minerals essential in the production of a wide range of electronics, automobiles and semiconductors. China dominates the global rare earth supply chain.\r\n\r\nThose restrictions came after the US introduced a slew of its own export controls targeting China in late September, despite the two sides seemingly making progress in trade talks over the summer.\r\n\r\nChina’s sweeping new restrictions, some of which﻿ won’t take effect until November, could deal a huge blow to East Asian economies, such as Japan, South Korea and Taiwan, which play critical roles in the global tech and artificial intelligence supply chain, as well as the auto industries.', 'published', '2025-10-13 15:43:30', 1, '2025-10-10 18:37:25', '2025-10-13 15:43:30'),
(2, 'These Are the 5 Big Tech Stories to Watch in 2017', 'these-are-the-5-big-tech-stories-to-watch-in-2017', 'uploads/covers/be09229dd343d348a6f47dcbb55f30dd.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word “and” and the Little Blind Text should turn around and return to its own, safe country.\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word “and” and the Little Blind Text should turn around and return to its own, safe country.', 'published', '2025-10-13 15:40:37', 1, '2025-10-13 15:40:37', '2025-10-13 15:40:37'),
(3, 'Trump says he may send Tomahawk missiles to Ukraine', 'trump-says-he-may-send-tomahawk-missiles-to-ukraine', 'uploads/covers/f12b8553f430a0a456c8fb5e602d82de.webp', 'US President Donald Trump is considering sending Tomahawk long-range cruise missiles to Ukraine, saying it would provide \"a new step of aggression\" in its war with Russia.\r\n\r\nWhen asked on Air Force One if he would send Tomahawks to Ukraine, Trump replied \"we\'ll see... I may\".\r\n\r\nIt follows a second phone call at the weekend between Trump and Ukrainian President Volodymyr Zelensky, who pushed for stronger military capabilities to launch counter-attacks against Russia.\r\n\r\nMoscow has previously warned Washington against providing long-range missiles to Kyiv, saying it would cause a major escalation in the conflict and strain US-Russian relations.\r\n\r\nTomahawk missiles have a range of 2,500 km (1,500 miles), which would put Moscow within reach for Ukraine.\r\n\r\nTrump spoke to reporters as he flew to Israel. He said he would possibly speak to Russia about the Tomahawks requested by Ukraine.\r\n\r\n\"I might tell them [Russia] that if the war is not settled, that we may very well, we may not, but we may do it.\"\r\n\r\n\"Do they [Russia] want Tomahawks going in their direction? I don\'t think so,\" the president said.\r\n\r\nKyiv has made multiple requests for long-range missiles, as it weighs up striking Russian cities far from the front lines of the grinding conflict.\r\n\r\nIn their phone calls Zelensky and Trump discussed Ukraine\'s bid to strengthen its military capabilities, including boosting its air defences and long-range arms.\r\n\r\nUkrainian cities including Kyiv have come under repeated heavy Russian bombardment with drones and missiles. Russia has particularly targeted Ukraine\'s energy infrastructure, causing power cuts.\r\n\r\nLast month, Trump\'s special envoy to Ukraine Keith Kellogg suggested the US president had authorised strikes deep into Russian territory, telling Fox News \"there are no such things as sanctuaries\" from attacks in the Russia-Ukraine war.\r\n\r\nRussia, which launched its full-scale invasion of Ukraine in February 2022, downplayed the chances of Tomahawks changing the course of the war.\r\n\r\nKremlin spokesperson Dmitry Peskov said last month: \"Whether it\'s Tomahawks or other missiles, they won\'t be able to change the dynamic.\"\r\n\r\n', 'published', '2025-10-13 16:13:19', 1, '2025-10-13 16:12:39', '2025-10-13 16:13:19'),
(4, 'jnnjnjkn', 'jnnjnjkn', 'uploads/covers/a942b8cf84e6d3a71e48357290b56b26.webp', 'njknjknkjnd', 'draft', NULL, 1, '2025-10-13 16:14:30', '2025-10-13 16:19:06'),
(5, 'US calls for China to release 30 leaders of influential underground church', 'us-calls-for-china-to-release-30-leaders-of-influential-underground-church', 'uploads/covers/8901d5ee5586efac0027d25083b76325.webp', 'The US has called for the release of 30 leaders of one of China\'s largest underground church network who were reportedly detained over the weekend in overnight raids in various cities.\r\n\r\nThe list includes several pastors and Zion Church founder Jin Mingri who was arrested in the early hours of Saturday after 10 officers searched his home, US-based non-profit ChinaAid said.\r\n\r\nThe Chinese Communist Party promotes atheism and tightly controls religion - still, some Christian groups are calling this the most extensive crackdown against the faith in decades.\r\n\r\nChristians have long been pressured to join only state-sanctioned churches that are led by government-approved pastors and toe the party line.\r\n\r\nIt is unclear if the detainees have been formally charged.\r\n\r\n\"Such systematic persecution is not only an affront to the Church of God but also a public challenge to the international community,\" Zion Church said in a statement.\r\n\r\nUrging China to release the church leaders, US Secretary of State Marco Rubio said in a statement on Sunday that \"this crackdown further demonstrates how the CCP exercises hostility towards Christians who reject Party interference in their faith and choose to worship at unregistered house churches\".\r\n\r\nFormer US vice-president Mike Pence and former secretary of state Mike Pompeo have also released statements on X condemning the arrests.\r\n\r\nWhen asked about the arrests at a press conference, Chinese foreign ministry spokesperson Lin Jian said he was not aware of the case.\r\n\r\nHe added: \"The Chinese government governs religious affairs in accordance with the law, and protects the religious freedom of citizens and normal religious activities. We firmly oppose the US interfering in China\'s internal affairs with so-called religious issues.\"\r\n\r\nThis could be yet another source of friction in the US-China relationship with trade tensions once again ramping up between the world\'s two biggest economies over tariffs and export controls.\r\n\r\nAlready, there is doubt over whether a summit between US President Donald Trump and his Chinese counterpart Xi Jinping, which was expected to happen in South Korea later this month, will proceed.\r\n\r\nUnder Xi, Beijing has cracked down even more on religious freedom, especially against Christians and Muslims.\r\n\r\nAt a national conference on religion in 2016, he called on the party to \"guide those [who are] religious to love their country, protect the unification of their motherland and serve the overall interests of the Chinese nation\".\r\n\r\nDespite this, there has been a growing movement of unregistered house churches in China.\r\n\r\nAmong them is Zion Church, which Mr Jin started in 2007 with just 20 people. Its network now includes some 10,000 people in 40 cities across the country, making it one of the largest underground churches in China.\r\n\r\nIn September 2018, the Party officially banned the church after it resisted government pressure to install security cameras at its property in Beijing. Mr Jin and several church leaders were detained briefly.\r\n\r\nMany of its branch congregations across the country have since been investigated and shut down. Mr Jin\'s family relocated to the US for safety, while he remained in China to pastor his flock. Authorities have barred him from leaving the country.\r\n\r\nStill the church continued to gather in small groups and shared its sermons online.\r\n\r\nChinaAid has called this roundup of Christian leaders - which involved police across several cities - unprecedented, and the \"most extensive and coordinated wave of persecution\" against Christians in over four decades.\r\n\r\n\"This new nationwide campaign echoes the darkest days of the 1980s, when urban churches first re-emerged from the Cultural Revolution,\" said ChinaAid\'s founder Bob Fu, referring to a period of mass purges in the 1960s and 1970s which triggered violence and huge upheaval across China.\r\n\r\nIn a letter seeking prayers, Mr Jin\'s wife Liu Chunli wrote that her heart is \"filled with a mix of shock, grief, sorrow, worry, and righteous anger\".\r\n\r\nMr Jin \"simply [did] what any faithful pastor would do... He is innocent!\" she wrote, adding that her family\'s hopes for a reunion after being separated for more than seven years have been dashed yet again.\r\n\r\nSeveral house churches in China have also issued statements calling for the release of those detained.\r\n\r\nSean Long, a Zion Church pastor based in the US, said Mr Jin had been prepared for a crackdown of this scale.\r\n\r\nIn a Zoom call weeks ago between the two pastors, Mr Long had asked what would happen if Mr Jin was put in prison and all the church\'s leaders detained.\r\n\r\nMr Jin had replied: \"Hallelujah! For a new wave of revival will follow then!\"', 'published', '2025-10-13 16:30:32', 1, '2025-10-13 16:30:32', '2025-10-13 16:30:32'),
(6, 'Dutch government takes control of China-owned chip firm', 'dutch-government-takes-control-of-china-owned-chip-firm', 'uploads/covers/b3e51f0c090743e96a00978532995214.webp', 'The Dutch government has taken control of Nexperia, a Chinese-owned chipmaker based in the Netherlands, in a bid to safeguard the European supply of semiconductors for cars and other electronic goods and protect Europe\'s economic security.\r\n\r\nThe Hague said it took the decision due to \"serious governance shortcomings\" and to prevent the chips from becoming unavailable in an emergency.\r\n\r\nNexperia\'s owner Wingtech said on Monday that it would take actions to protect its rights and would seek government support.\r\n\r\nThe development threatens to raise tensions between the European Union and China, which have increased in recent months over trade and Beijing\'s relationship with Russia.\r\n\r\nIn December 2024, the US government placed Wingtech on its so-called \"entity list\", identifying the company as a national security concern.\r\n\r\nUnder the regulations, US companies are barred from exporting American-made goods to businesses on the list unless they have special approval.\r\n\r\nIn the UK, Nexperia was forced to sell its silicon chip plant in Newport, after MPs and ministers expressed national security concerns. It currently owns a UK facility in Stockport.\r\n\r\nThe Dutch Economic Ministry said it made the \"highly exceptional\" decision to invoke the Goods Availability Act over \"acute signals of serious governance shortcomings\" within Nexperia.\r\n\r\n\"These signals posed a threat to the continuity and safeguarding on Dutch and European soil of crucial technological knowledge and capabilities,\" the ministry said in a statement.\r\n\r\n\"Losing these capabilities could pose a risk to Dutch and European economic security.\"\r\n\r\nThe statement did not detail why it thought the firm\'s operations were risky. A spokesperson for the minister of economic affairs told the BBC there was no further information to share.\r\n\r\n', 'draft', NULL, 1, '2025-10-13 16:31:33', '2025-10-13 16:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` enum('admin','editor') NOT NULL DEFAULT 'editor',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `email`, `avatar`, `password`, `fullname`, `role`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, '41009c93-a5c0-11f0-95d6-c0185090182d', 'hidayatmramon', 'hidayatmramon@gmail.com', 'public/uploads/avatars/41009c93-a5c0-11f0-95d6-c0185090182d-1760367944.jpg', '$2y$10$qif3JEWcwjstf44mgjsfau3avU1gZx1E/OPFcSRJB93pQ.O3JNA7G', 'Ramon Hidayat', 'admin', 'active', '2025-10-14 09:53:27', '2025-10-10 17:02:39', '2025-10-14 09:53:27'),
(2, '40e78bed-abad-4ac7-a164-cc6f0a27fd16', 'editor', 'info@hidayatmramon.com', NULL, '$2y$12$4tFMjcO3D5k6t3mbMuYizuZn.HEa.2tHcm0/F6Gbzmh.son2AimNe', 'editor hidayatnews', 'editor', 'active', '2025-10-14 06:26:05', '2025-10-14 01:32:25', '2025-10-14 06:26:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_isproxy` (`is_proxy`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_slug` (`slug`),
  ADD UNIQUE KEY `idx_posts_slug` (`slug`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_published_at` (`published_at`),
  ADD KEY `fk_posts_author` (`author_id`),
  ADD KEY `idx_posts_status_pubat` (`status`,`published_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`),
  ADD KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
