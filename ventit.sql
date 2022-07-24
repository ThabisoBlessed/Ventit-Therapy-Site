-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2022 at 08:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ventit`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `blocker` varchar(15) NOT NULL,
  `blockeduser` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `posts_body` text NOT NULL,
  `posted_by` varchar(50) NOT NULL,
  `posted_to` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `posts_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'yo', 'User43rk', 'User43rk', '2021-09-01 22:25:48', 'no', 7),
(2, 'hie', 'UserH19f', 'UserlqJr', '2021-09-03 15:43:47', 'no', 6),
(3, 'hie', 'UserH19f', 'UserlqJr', '2021-09-03 15:45:42', 'no', 7),
(4, 'hief', 'UserH19f', 'UserlqJr', '2021-09-03 15:47:19', 'no', 7),
(5, 'hie', 'UserH19f', 'UserH19f', '2021-09-03 15:51:33', 'no', 4),
(6, 'hie', 'UserH19f', 'UserlqJr', '2021-09-03 15:54:28', 'no', 6),
(7, 'hie', 'UserH19f', 'UserlqJr', '2021-09-03 15:54:46', 'no', 7),
(8, 'hie', 'UserH19f', 'UserlqJr', '2021-09-14 19:16:49', 'no', 7),
(9, 'echo', 'UserlqJr', 'UserH19f', '2021-09-28 02:12:07', 'no', 12),
(11, 'hie', 'UserlqJr', 'UserH19f', '2021-09-29 00:13:20', 'no', 12),
(14, 'ola', 'UserlqJr', 'UserH19f', '2021-09-29 10:42:04', 'no', 12),
(15, 'ola', 'UserlqJr', 'UserH19f', '2021-09-29 11:03:49', 'no', 12),
(16, 'hie', 'UserCWcm', 'UserH19f', '2021-09-29 13:19:26', 'no', 12),
(17, 'hie', 'UserH19f', 'UserlqJr', '2021-09-30 22:00:58', 'no', 22),
(18, 'i saw it', 'UserlqJr', 'UserlqJr', '2021-10-02 02:40:43', 'no', 21),
(19, 'i get it', 'UserH19f', 'UserlqJr', '2021-10-03 15:36:19', 'no', 22),
(20, 'how ', 'UserH19f', 'UserlqJr', '2021-10-04 15:37:32', 'no', 22),
(21, 'howr', 'UserH19f', 'UserH19f', '2021-10-04 16:09:07', 'no', 24),
(22, 'true', 'UserCWcm', 'UserH19f', '2021-10-06 21:31:45', 'no', 36),
(23, 'you good', 'UserCWcm', 'UserH19f', '2021-10-08 18:10:20', 'no', 61),
(24, 'ola', 'UserdoMU', 'UserH19f', '2021-10-08 18:10:49', 'no', 58),
(25, 'gooh', 'UserlqJr', 'UserH19f', '2021-10-08 18:11:13', 'no', 39),
(26, 'good for you', 'UserH19f', 'UserH19f', '2021-11-05 17:09:19', 'no', 98);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(17, 'UserlqJr', 12),
(20, 'UserH19f', 11),
(25, 'UserCWcm', 12),
(27, 'UserH19f', 22),
(28, 'UserH19f', 24),
(48, 'UserH19f', 91),
(53, 'UserH19f', 99),
(54, 'UserH19f', 100),
(55, 'UserH19f', 101);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'UserlqJr', 'UserH19f', 'heyy man', '2021-09-20 21:40:23', 'yes', 'yes', 'no'),
(2, 'UserH19f', 'UserlqJr', 'whats up you cool', '2021-09-20 22:49:13', 'yes', 'yes', 'no'),
(3, 'UserH19f', 'UserlqJr', 'whatup', '2021-09-20 23:00:06', 'yes', 'yes', 'no'),
(4, 'UserH19f', 'UserlqJr', 'whatup', '2021-09-20 23:03:38', 'yes', 'yes', 'no'),
(5, 'UserH19f', 'UserlqJr', 'whatup', '2021-09-20 23:03:46', 'yes', 'yes', 'no'),
(6, 'UserH19f', 'UserlqJr', 'ojkhefd', '2021-09-20 23:04:16', 'yes', 'yes', 'no'),
(7, 'UserH19f', 'UserlqJr', 'fdfdff', '2021-09-20 23:04:20', 'yes', 'yes', 'no'),
(8, 'UserH19f', 'UserlqJr', 'ffdfffd', '2021-09-20 23:04:26', 'yes', 'yes', 'no'),
(9, 'UserH19f', 'UserlqJr', 'fdfff', '2021-09-20 23:04:33', 'yes', 'yes', 'no'),
(10, 'UserH19f', 'UserlqJr', 'fdfff', '2021-09-20 23:05:57', 'yes', 'yes', 'no'),
(11, 'UserH19f', 'UserlqJr', 'fdfff', '2021-09-20 23:06:27', 'yes', 'yes', 'no'),
(12, 'UserH19f', 'UserlqJr', 'fdfff', '2021-09-20 23:10:31', 'yes', 'yes', 'no'),
(13, 'UserH19f', 'UserlqJr', 'fdfff', '2021-09-20 23:11:42', 'yes', 'yes', 'no'),
(14, 'UserH19f', 'UserlqJr', 'hie', '2021-09-22 19:28:56', 'yes', 'yes', 'no'),
(15, 'UserlqJr', 'UserH19f', 'howzit bro', '2021-09-22 19:40:09', 'yes', 'yes', 'no'),
(16, 'UserlqJr', 'UserH19f', 'hie', '2021-09-25 18:11:01', 'yes', 'yes', 'no'),
(17, 'UserH19f', 'UserlqJr', 'hie', '2021-10-04 15:35:46', 'yes', 'yes', 'no'),
(18, 'UserlqJr', 'UserH19f', 'wasapp', '2021-10-04 16:12:51', 'yes', 'yes', 'no'),
(19, 'UserlqJr', 'UserH19f', 'ola', '2021-10-06 08:40:59', 'yes', 'yes', 'no'),
(20, 'UserH19f', 'UserdoMU', 'hie man', '2021-10-08 09:09:40', 'yes', 'yes', 'no'),
(21, 'UserdoMU', 'UserH19f', 'im good bro ? how was your day!', '2021-10-08 09:10:21', 'yes', 'yes', 'no'),
(22, 'UserlqJr', 'UserH19f', 'hie', '2021-10-08 20:53:53', 'yes', 'yes', 'no'),
(23, 'UserlqJr', 'UserH19f', 'hie', '2021-10-08 20:54:10', 'yes', 'yes', 'no'),
(24, 'UserlqJr', 'UserH19f', 'hie', '2021-10-08 20:54:17', 'yes', 'yes', 'no'),
(25, 'UserH19f', 'UserlqJr', 'im good ', '2021-10-09 09:50:55', 'yes', 'yes', 'no'),
(26, 'UserlqJr', 'UserH19f', 'how was your trip', '2021-10-09 09:51:41', 'yes', 'yes', 'no'),
(27, 'UserH19f', 'UserlqJr', 'im well man', '2021-10-09 09:55:08', 'yes', 'yes', 'no'),
(28, 'UserH19f', 'UserlqJr', 'everything okay man?', '2021-10-09 10:24:54', 'yes', 'yes', 'no'),
(29, 'UserlqJr', 'UserH19f', 'its cool man', '2021-10-09 10:27:33', 'yes', 'yes', 'no'),
(30, 'UserH19f', 'UserlqJr', 'yohh bro', '2021-10-09 10:32:30', 'yes', 'yes', 'no'),
(31, 'UserH19f', 'UserlqJr', 'hie', '2021-10-09 10:38:44', 'yes', 'yes', 'no'),
(32, 'UserH19f', 'UserdoMU', 'Did you go to the park', '2021-10-10 17:14:40', 'yes', 'yes', 'no'),
(33, 'UserCWcm', 'UserH19f', 'hie', '2021-10-20 15:42:26', 'yes', 'yes', 'no'),
(34, 'UserH19f', 'UserCWcm', 'how are you', '2021-10-20 15:46:25', 'yes', 'yes', 'no'),
(35, 'UserdoMU', 'UserH19f', 'hey hows the covid treating you \r\n', '2021-12-07 13:56:08', 'no', 'no', 'no'),
(36, 'UserH19f', 'UserN1We', 'hi my name is namzy can we be friends i like your posts \r\n', '2021-12-29 15:45:51', 'yes', 'yes', 'no'),
(37, 'UserN1We', 'UserH19f', 'Hi namzy hope you are good! of course we can be friends why not\r\n', '2021-12-29 16:12:18', 'yes', 'yes', 'no'),
(38, 'UserH19f', 'UserN1We', 'thats lovely', '2021-12-29 16:18:59', 'yes', 'yes', 'no'),
(39, 'UserH19f', 'UserN1We', 'how are you doing ', '2021-12-29 16:25:24', 'yes', 'yes', 'no'),
(40, 'UserN1We', 'UserH19f', 'hi', '2021-12-29 16:27:02', 'yes', 'yes', 'no'),
(41, 'UserH19f', 'UserN1We', 'im tired man', '2021-12-29 18:26:57', 'yes', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(8, 'UserH19f', 'UserlqJr', 'UserlqJr commented on your post', 'display.php?id=12', '2021-09-29 10:42:04', 'yes', 'yes'),
(9, 'UserH19f', 'UserlqJr', 'UserlqJr commented on your post', 'display.php?id=12', '2021-09-29 11:03:49', 'yes', 'yes'),
(12, 'UserlqJr', 'UserH19f', 'UserH19f commented on your post', 'display.php?id=22', '2021-09-30 22:00:58', 'yes', 'yes'),
(13, 'UserlqJr', 'UserH19f', 'UserH19f commented on your post', 'display.php?id=22', '2021-10-03 15:36:20', 'yes', 'yes'),
(14, 'UserlqJr', 'UserH19f', 'UserH19f commented on your post', 'display.php?id=22', '2021-10-04 15:37:32', 'yes', 'yes'),
(15, 'UserH19f', 'UserCWcm', 'UserCWcm commented on your post', 'display.php?id=36', '2021-10-06 21:31:45', 'yes', 'yes'),
(16, 'UserH19f', 'UserCWcm', 'UserCWcm commented on your post', 'display.php?id=61', '2021-10-08 18:10:21', 'yes', 'yes'),
(17, 'UserH19f', 'UserdoMU', 'UserdoMU commented on your post', 'display.php?id=58', '2021-10-08 18:10:49', 'yes', 'yes'),
(18, 'UserH19f', 'UserlqJr', 'UserlqJr commented on your post', 'display.php?id=39', '2021-10-08 18:11:13', 'yes', 'yes'),
(19, 'UserCWcm', 'UserH19f', 'UserH19f posted on your profile', 'display.php?id=99', '2021-11-05 15:58:20', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `popularwords`
--

CREATE TABLE `popularwords` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `occurances` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `popularwords`
--

INSERT INTO `popularwords` (`id`, `name`, `occurances`) VALUES
(1, 'Venting', 12),
(2, 'Car', 1),
(3, 'Hijjack', 1),
(4, 'Cars', 1),
(5, 'Sessions', 1),
(7, 'Caring', 1),
(8, 'Trying', 1),
(12, 'DEll', 3),
(13, 'Therapy', 2),
(14, 'Marriage', 1),
(15, 'Difficult', 1),
(16, 'Feeling', 1),
(17, 'Happy', 1),
(18, 'Whats', 1),
(19, 'Stressful', 1),
(20, 'Day', 1),
(21, 'Projects', 1),
(22, 'Looking', 1),
(23, 'Computer', 1),
(24, 'Hourstired', 1),
(25, 'Understatement', 1),
(26, 'Programming', 1),
(27, 'Makes', 1),
(28, 'Sickkkkkkkk', 1),
(29, 'Hiii', 1),
(30, 'Call', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(3, 'how are you', 'UserH19f', 'none', '2021-09-02 20:49:31', 'no', 'yes', 6),
(4, 'jeyy', 'UserH19f', 'none', '2021-09-03 00:41:15', 'no', 'yes', 1),
(5, 'hi\r\n', 'UserH19f', 'none', '2021-09-03 00:44:39', 'no', 'yes', 0),
(6, 'hie', 'UserlqJr', 'UserH19f', '2021-09-03 00:53:37', 'no', 'no', 0),
(7, 'hie', 'UserlqJr', 'none', '2021-09-03 15:36:11', 'no', 'yes', 0),
(8, 'ola', 'UserH19f', 'none', '2021-09-06 00:50:08', 'no', 'yes', 0),
(9, 'testing', 'UserlqJr', 'none', '2021-09-17 21:33:05', 'no', 'yes', 0),
(10, 'testing', 'UserlqJr', 'none', '2021-09-17 21:40:45', 'no', 'yes', 0),
(11, 'hie', 'UserlqJr', 'none', '2021-09-18 03:12:08', 'no', 'yes', 2),
(12, 'ffff', 'UserH19f', 'UserlqJr', '2021-09-20 11:59:26', 'no', 'no', 5),
(13, 'weewr', 'UserH19f', 'UserlqJr', '2021-09-20 12:00:58', 'no', 'yes', 0),
(14, 'Its UserH19 hie  ', 'UserlqJr', 'UserH19f', '2021-09-29 10:31:09', 'no', 'yes', 0),
(15, 'you cool', 'UserlqJr', 'UserH19f', '2021-09-29 10:39:14', 'no', 'yes', 0),
(16, 'hie', 'UserlqJr', 'none', '2021-09-29 10:40:55', 'no', 'yes', 0),
(17, 'hie', 'UserlqJr', 'none', '2021-09-29 10:56:47', 'no', 'yes', 0),
(18, 'Hie Userlqjr here', 'UserlqJr', 'UserH19f', '2021-09-29 11:00:19', 'no', 'yes', 0),
(19, 'hie;jpeofe', 'UserlqJr', 'UserH19f', '2021-09-29 11:03:15', 'no', 'yes', 0),
(20, 'olaaa', 'UserlqJr', 'UserH19f', '2021-09-29 11:11:25', 'no', 'yes', 0),
(21, 'hie', 'UserlqJr', 'none', '2021-09-29 13:10:17', 'no', 'yes', 0),
(22, 'hie', 'UserlqJr', 'UserH19f', '2021-09-29 13:10:43', 'no', 'no', 1),
(23, 'i feel happy today', 'UserH19f', 'none', '2021-10-04 15:40:37', 'no', 'no', 0),
(24, 'chilling ', 'UserH19f', 'none', '2021-10-04 16:08:43', 'no', 'yes', 1),
(25, 'therapy', 'UserH19f', 'none', '2021-10-06 18:15:45', 'no', 'yes', 0),
(26, 'therapy was great', 'UserH19f', 'none', '2021-10-06 18:20:34', 'no', 'no', 0),
(27, 'therapy was great', 'UserH19f', 'none', '2021-10-06 18:24:46', 'no', 'yes', 0),
(28, 'therapy was great', 'UserH19f', 'none', '2021-10-06 18:25:01', 'no', 'yes', 0),
(29, 'therapy was great', 'UserH19f', 'none', '2021-10-06 18:26:57', 'no', 'yes', 0),
(30, '$sqlidata', 'UserH19f', 'none', '2021-10-06 18:28:27', 'no', 'yes', 0),
(31, 'cars', 'UserH19f', 'none', '2021-10-06 18:50:27', 'no', 'yes', 0),
(32, 'therapy', 'UserH19f', 'none', '2021-10-06 19:42:54', 'no', 'yes', 0),
(33, 'car', 'UserH19f', 'none', '2021-10-06 19:43:41', 'no', 'yes', 0),
(34, 'hijjack', 'UserH19f', 'none', '2021-10-06 19:43:58', 'no', 'yes', 0),
(35, 'cars', 'UserH19f', 'none', '2021-10-06 19:49:23', 'no', 'no', 0),
(36, 'therapy is the solution to all your troubles', 'UserH19f', 'none', '2021-10-06 21:15:59', 'no', 'no', 0),
(37, 'therapy is the solution to all your troubles', 'UserH19f', 'none', '2021-10-06 21:16:26', 'no', 'no', 0),
(38, 'hie', 'UserH19f', 'none', '2021-10-06 21:16:41', 'no', 'no', 0),
(39, 'therapy sessions', 'UserH19f', 'none', '2021-10-06 21:18:05', 'no', 'no', 0),
(40, 'venting', 'UserdoMU', 'none', '2021-10-07 16:09:35', 'no', 'no', 0),
(41, 'caring', 'UserdoMU', 'none', '2021-10-07 16:09:56', 'no', 'yes', 0),
(42, 'it was good reaching out😍🤩', 'UserdoMU', 'none', '2021-10-07 20:31:40', 'no', 'no', 0),
(43, 'hie', 'UserdoMU', 'none', '2021-10-07 20:34:01', 'no', 'no', 0),
(44, 'hie Man', 'UserH19f', 'none', '2021-10-07 20:38:22', 'no', 'yes', 0),
(45, 'hie Man', 'UserH19f', 'none', '2021-10-07 20:48:03', 'no', 'yes', 0),
(54, 'hie', 'UserH19f', 'none', '2021-10-07 21:06:14', 'no', 'no', 0),
(55, 'hie', 'UserH19f', 'none', '2021-10-07 21:10:25', 'no', 'no', 0),
(56, 'trying out icons😄🤝', 'UserH19f', 'none', '2021-10-07 21:12:12', 'no', 'no', 0),
(57, 'hi', 'UserH19f', 'none', '2021-10-07 21:12:44', 'no', 'no', 0),
(58, 'hi2', 'UserH19f', 'none', '2021-10-07 21:13:15', 'no', 'no', 0),
(59, 'hie😍', 'UserH19f', 'none', '2021-10-07 21:13:47', 'no', 'no', 0),
(60, 'hie 🤝', 'UserH19f', 'none', '2021-10-07 21:24:08', 'no', 'no', 0),
(61, '  hie🤩', 'UserH19f', 'none', '2021-10-07 21:25:46', 'no', 'no', 0),
(62, 'hie', 'UserH19f', 'none', '2021-10-07 21:31:22', 'no', 'yes', 0),
(63, 'God is  good🙏', 'UserdoMU', 'none', '2021-10-07 21:38:55', 'no', 'no', 0),
(64, 'hi', 'UserdoMU', 'none', '2021-10-07 21:44:56', 'no', 'yes', 0),
(65, 'hi', 'UserdoMU', 'none', '2021-10-07 21:45:19', 'no', 'yes', 0),
(66, 'hi😁', 'UserdoMU', 'none', '2021-10-07 21:47:24', 'no', 'no', 0),
(67, 'Therapy', 'UserdoMU', 'none', '2021-10-07 21:47:45', 'no', 'yes', 0),
(68, 'therapy🤩', 'UserdoMU', 'none', '2021-10-07 21:48:01', 'no', 'yes', 0),
(69, '🤝', 'UserdoMU', 'none', '2021-10-07 21:49:07', 'no', 'no', 0),
(70, 'hie 😄', 'UserdoMU', 'none', '2021-10-07 21:49:30', 'no', 'yes', 0),
(71, 'therapy', 'UserdoMU', 'none', '2021-10-08 09:11:14', 'no', 'yes', 0),
(72, 'therapy 😍', 'UserdoMU', 'none', '2021-10-08 09:11:47', 'no', 'no', 0),
(73, 'therapy', 'UserdoMU', 'none', '2021-10-08 09:43:41', 'no', 'yes', 0),
(74, 'therapy', 'UserdoMU', 'none', '2021-10-08 09:46:13', 'no', 'yes', 0),
(75, 'DEll', 'UserdoMU', 'none', '2021-10-08 09:47:42', 'no', 'no', 0),
(76, 'Dell 🤩', 'UserdoMU', 'none', '2021-10-08 09:48:11', 'no', 'no', 0),
(77, 'Dell    🙏', 'UserdoMU', 'none', '2021-10-08 09:49:46', 'no', 'yes', 0),
(78, 'therapy', 'UserH19f', 'none', '2021-10-08 18:26:57', 'no', 'yes', 0),
(79, 'therapy😁', 'UserH19f', 'none', '2021-10-08 18:27:36', 'no', 'yes', 0),
(80, 'Everyone doing well today😇', 'User9mxn', 'none', '2021-10-09 10:12:36', 'no', 'no', 0),
(81, 'hie', 'User9mxn', 'none', '2021-10-09 10:13:21', 'no', 'yes', 0),
(82, 'hie', 'User9mxn', 'none', '2021-10-09 10:13:21', 'no', 'yes', 0),
(83, 'therapy', 'User9mxn', 'none', '2021-10-09 10:15:23', 'no', 'yes', 0),
(84, 'therapy😍🤩', 'User9mxn', 'none', '2021-10-09 10:16:44', 'no', 'no', 0),
(85, 'hie', 'User9mxn', 'none', '2021-10-09 10:20:35', 'no', 'yes', 0),
(86, 'hie', 'User9mxn', 'none', '2021-10-09 10:21:44', 'no', 'yes', 0),
(87, 'hie', 'User9mxn', 'none', '2021-10-09 10:22:16', 'no', 'yes', 0),
(88, 'hie😁', 'User9mxn', 'none', '2021-10-09 10:22:32', 'no', 'no', 0),
(89, 'hie', 'UserCWcm', 'none', '2021-10-09 10:46:20', 'no', 'no', 0),
(90, '😍😇😆😁', 'UserdoMU', 'none', '2021-10-09 20:20:31', 'no', 'no', 0),
(91, 'my guy how are you doing\n', 'UserH19f', 'User9mxn', '2021-10-21 15:43:06', 'no', 'no', 1),
(92, 'marriage is a very difficult thing to do', 'User9mxn', 'none', '2021-10-21 19:20:42', 'no', 'yes', 0),
(93, 'you available👍', 'UserH19f', 'none', '2021-10-22 16:13:01', 'no', 'yes', 0),
(94, 'hi 🙁', 'UserH19f', 'none', '2021-10-22 16:13:53', 'no', 'yes', 0),
(95, 'venting', 'UserH19f', 'none', '2021-10-22 16:14:23', 'no', 'yes', 0),
(96, 'venting 😄🙁', 'UserH19f', 'none', '2021-10-22 16:14:35', 'no', 'yes', 0),
(97, 'usercwcm how are you', 'UserH19f', 'UserCWcm', '2021-10-29 16:19:08', 'no', 'no', 0),
(98, 'today i am feeling happy😃😃😃', 'UserH19f', 'none', '2021-10-29 21:36:10', 'no', 'no', 0),
(99, 'what\'s up man', 'UserH19f', 'UserCWcm', '2021-11-05 15:58:20', 'no', 'no', 1),
(100, 'today has been a stressful day working on projects and looking at the computer for hours.😓😓tired is an understatement. programming makes me sickkkkkkkk😤😤 ', 'UserH19f', 'none', '2021-12-08 02:52:49', 'no', 'no', 1),
(101, 'hiii i am on  call😄', 'UserH19f', 'none', '2021-12-08 16:10:16', 'no', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(2, 'Blue', 'Cow', 'UserH19f', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-02', 'Assets/images/profile_pics/defaults/6.png', 55, 2, 'no', ',UserlqJr,UserCWcm,UserN1We,'),
(3, 'Red', 'Cow', 'UserlqJr', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-03', 'Assets/images/profile_pics/defaults/4.png', 7, 1, 'no', ',UserH19f,UserCWcm,'),
(4, 'Cream', 'Dove', 'Userq4P8', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-03', 'Assets/images/profile_pics/defaults/6.png', 0, 0, 'no', ','),
(5, 'Black', 'Bird', 'UserTNel', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-08', 'Assets/images/profile_pics/defaults/4.png', 0, 0, 'no', ','),
(6, 'Black', 'Lion', 'UserCWcm', '827ccb0eea8a706c4c34a16891f84e7b', '2021-09-08', 'Assets/images/profile_pics/defaults/1.png', 1, 0, 'no', ',UserlqJr,UserH19f,'),
(8, 'Blue', 'Donkey', 'User68xz', '827ccb0eea8a706c4c34a16891f84e7b', '2021-10-07', 'Assets/images/profile_pics/defaults/4.png', 0, 0, 'no', ','),
(9, 'White', 'Cow', 'UserooFD', '827ccb0eea8a706c4c34a16891f84e7b', '2021-10-07', 'Assets/images/profile_pics/defaults/7.png', 0, 0, 'no', ','),
(10, 'Blue', 'Rhino', 'User4d0e', '827ccb0eea8a706c4c34a16891f84e7b', '2021-10-07', 'Assets/images/profile_pics/defaults/1.png', 0, 0, 'no', ','),
(11, 'Blue', 'Shark', 'User9mxn', '827ccb0eea8a706c4c34a16891f84e7b', '2021-10-07', 'Assets/images/profile_pics/defaults/2.png', 10, 0, 'no', ','),
(12, 'Black', 'Shark', 'UserdoMU', '827ccb0eea8a706c4c34a16891f84e7b', '2021-10-07', 'Assets/images/profile_pics/defaults/13.png', 20, 0, 'yes', ','),
(14, 'Purple', 'Parrot', 'UserN1We', 'e10adc3949ba59abbe56e057f20f883e', '2021-12-24', 'Assets/images/profile_pics/defaults/14.png', 0, 0, 'no', ',UserH19f,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popularwords`
--
ALTER TABLE `popularwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `popularwords`
--
ALTER TABLE `popularwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
