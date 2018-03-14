-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 14 mars 2018 kl 09:41
-- Serverversion: 10.1.13-MariaDB
-- PHP-version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `meme`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `date`, `comment`, `avatar`) VALUES
(1, 9, 'admin', '2017-12-18 10:28:28', 'yee', '5a36c9331918b.jpg'),
(2, 9, 'admin', '2017-12-18 10:29:34', 'fml', '5a36c9331918b.jpg'),
(3, 9, 'admin', '2017-12-18 10:38:37', 'flat earth<br />\r\n', '5a36c9331918b.jpg'),
(4, 4, 'admin', '2018-03-07 08:17:34', 'shit meme', '5a36c9331918b.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `inbox`
--

INSERT INTO `inbox` (`id`, `from_user`, `to_user`, `subject`, `message`, `date`, `image`, `seen`) VALUES
(17, 'diana', 'admin', 'admin', 'aa', '2017-12-17', '5a368bedcb1a2.png', 1),
(18, 'diana', 'admin', 'this is u', 'LOL u fucking fag', '2017-12-17', '5a368def7d345.jpg', 1),
(19, 'admin', 'admin', 'admin', 'aa', '2017-12-17', '5a368e602703c.jpg', 1),
(20, 'admin', 'dankman123', 'Regarding your misbehavior', 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to permanently ban your account. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.', '2017-12-17', '', 1),
(21, 'dankman123', 'admin', 'i am banned', 'Hello dear admin, i think that this is a mistake made by you and the administrative team. Could you please unban me?', '2017-12-17', '', 1),
(22, 'admin', 'diana', 'Regarding your misbehavior', 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to warn you. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.', '2017-12-17', '', 1),
(23, 'dankman123', 'admin', 'naa', 'ur a faggot', '2017-12-17', '', 1),
(24, 'admin', 'floke', 'faggot', 'nigger', '2017-12-18', '', 1),
(25, 'Floke', 'admin', 'niger', 'du luktar invandrar bö', '2017-12-18', '', 1),
(26, 'admin', 'FolkeBylund', 'Regarding your misbehavior', 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to permanently ban your account. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.', '2017-12-18', '', 0),
(27, 'admin', 'kushlon', 'faggot', 'xxddddd', '2017-12-18', '5a3788d0393a9.jpg', 1),
(28, 'admin', 'taco', 'Regarding your misbehavior', 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to warn you. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.', '2017-12-18', '', 0),
(29, 'admin', 'taco', 'Regarding your misbehavior', 'You have been violating the terms of service on this website and therefore the administrative team has made a decision to warn you. If you think this is a mistake, you can write your complaint to the user "admin". Thank you for stay and enjoy the website.', '2017-12-18', '', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `memes`
--

CREATE TABLE `memes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `memes`
--

INSERT INTO `memes` (`id`, `title`, `author`, `date`, `image`, `section`, `points`) VALUES
(3, 'Gustav''s favorite smell', 'Jeag1488', '2017-12-18 15:23:36', '5a37959228c5d.jpg', '', 3),
(4, 'Fuck u bish', 'pepe', '2017-12-18 15:23:40', '5a3795986700c.jpg', '', 3),
(5, 'WOKE', 'pepe', '2017-12-18 14:52:58', '5a3795d7a27b7.jpg', '', 0),
(6, 'When in Tensta', 'pepe', '2017-12-18 14:52:54', '5a3796080fe08.jpg', '', 0),
(7, 'Stay W O K E', 'pepe', '2017-12-18 15:00:28', '5a37967fd2c8d.jpg', '', 1),
(9, 'Y''all ain''t woke', 'pepe', '2017-12-18 14:53:46', '5a3796dec14b1.jpg', '', 1),
(10, 'eh...', 'admin', '2018-01-20 19:01:50', '5a37d33bcb66a.png', '', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `stored_images`
--

CREATE TABLE `stored_images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `md5` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `width` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `stored_images`
--

INSERT INTO `stored_images` (`id`, `file_name`, `extension`, `mime`, `size`, `md5`, `height`, `width`) VALUES
(1, '592b272f80588.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(2, '592b27ad5d7a7.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(3, '592b296f9925f.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(4, '592b319827433.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(5, '592b31bfc2c42.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(6, '592b31ee3f75d.gif', 'gif', 'image/gif', '98661', '7c9e1e73a2245d0a2a7c8f6b997eca6f', '320', '320'),
(7, '592be245d2a24.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(8, '592be24d31199.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(9, '592be26591de3.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(10, '592be27b6473d.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(11, '592be29cceec2.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(12, '592be2c4f07d4.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(13, '592be2d5edc1d.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(14, '592be30c58328.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(15, '592be313c4660.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(16, '592bef6ce1008.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(17, '592befe5b8102.gif', 'gif', 'image/gif', '98661', '7c9e1e73a2245d0a2a7c8f6b997eca6f', '320', '320'),
(18, '592bf102c2a96.png', 'png', 'image/png', '290', '76496ed84130f0bb052600a5a3cb8ee4', '16', '16'),
(19, '592bf2a3741a9.png', 'png', 'image/png', '200379', '0370a9f2e345a0424938f392a3268a22', '768', '1366'),
(20, '592bf2aa8f1ae.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(21, '592bf2f3614b7.png', 'png', 'image/png', '3209', 'fa4295518024aba3936124d872a5d6ca', '134', '256'),
(22, '592bf472d59aa.jpg', 'jpg', 'image/jpeg', '2305781', '4d747e674c85b6e9916bacee4fddb639', '1280', '1920'),
(23, '592bf51fa6361.gif', 'gif', 'image/gif', '98661', '7c9e1e73a2245d0a2a7c8f6b997eca6f', '320', '320'),
(24, '592bf5dfdaa8e.gif', 'gif', 'image/gif', '1281236', '91292be28704e4e41a665bfce8e5f8ba', '289', '320'),
(25, '592bf6342de81.jpg', 'jpg', 'image/jpeg', '21410', '4e45ec07fae2629836c80250dbc5d18c', '417', '604'),
(26, '592bf70130613.jpg', 'jpg', 'image/jpeg', '145778', 'e401f0caaf2a62ff23385793f2292ab4', '992', '700'),
(27, '592bf788e0947.png', 'png', 'image/png', '6764', '5e5b2b7ffae280974bef3c55e4135ff4', '147', '432'),
(28, '592bf78bd4274.jpg', 'jpg', 'image/jpeg', '118969', '943493a1fb4412d9b2232222a47819ff', '1510', '700'),
(29, '592bf840f1c37.jpg', 'jpg', 'image/jpeg', '297188', 'b2160fad5419e56c6630bb5fd9e902d8', '960', '1280'),
(30, '592bf8aa36c68.jpg', 'jpg', 'image/jpeg', '2178688', '93b4257966aa3674dc26b10f4e9224ea', '2208', '3920'),
(31, '592bf8fc807d0.mp4', 'mp4', 'video/mp4', '1047432', 'c9bcba3c1f3bca944e33cb9065eddf9f', '0', '0'),
(32, '592c0109e5f1d.jpg', 'jpg', 'image/jpeg', '84892', '5a3788c473f33231a0f8512bcba66d22', '694', '700'),
(33, '592c097ed5db6.png', 'png', 'image/png', '105891', '00cbd08b9228feb9739d6f0d22bf8f80', '474', '476'),
(34, '592c0a205a0e8.jpeg', 'jpeg', 'image/jpeg', '56644', 'a0a98665a094c05d61a33d9755b95e84', '1136', '640'),
(35, '592c0b002368d.jpeg', 'jpeg', 'image/jpeg', '35582', 'b7a880a8afd596a95994bf2e34d62aab', '1136', '640'),
(36, '592c0b969c2f9.jpg', 'jpg', 'image/jpeg', '42216', '0d5897d3be4f0368c83a1f0007451f7c', '392', '375'),
(37, '592c0bfaa4e4f.png', 'png', 'image/png', '192808', 'f891c0d0957b8735ae36931df1edfb15', '860', '500'),
(38, '592c0c5c37151.png', 'png', 'image/png', '314839', '26ccbae300ac156bb6b96a30a2f1dc14', '480', '640'),
(39, '592c0c8289d13.jpg', 'jpg', 'image/jpeg', '28763', '4bc6bf63c31311c18a6f9c64a344253d', '492', '640'),
(40, '592c0ca41c432.jpg', 'jpg', 'image/jpeg', '69141', '5dc7b84a793b0ca3fa77d8f250bcc028', '581', '600'),
(41, '592c0cea57bdb.jpg', 'jpg', 'image/jpeg', '17073', 'd97c338eb1225964a47f483d6580a8bc', '392', '465'),
(42, '592c0d14d4ee3.jpg', 'jpg', 'image/jpeg', '69141', '5dc7b84a793b0ca3fa77d8f250bcc028', '581', '600'),
(43, '592c11c157808.jpg', 'jpg', 'image/jpeg', '147851', '3dad6e6e4f92a7da10a62aa87882edcb', '1461', '460'),
(44, '592c153c993ab.jpg', 'jpg', 'image/jpeg', '7549', 'a15343489b620e5a3088d1a32fe8b02d', '225', '225'),
(45, '592c15d36d255.png', 'png', 'image/png', '17899', 'c01619169c0903a8d671785583a9ae55', '687', '575'),
(46, '592c16a975c4d.jpg', 'jpg', 'image/jpeg', '73237', '963c8c3a3a7667b24906aa7c89441947', '700', '700'),
(47, '592c16b2ed8f3.gif', 'gif', 'image/gif', '1967219', '44ff5306c0ae1356b1cabd5610576d5e', '200', '277'),
(48, '592c16d5cf28b.jpg', 'jpg', 'image/jpeg', '21532', 'b0dccbe4349cd04350fea771793cec25', '384', '512'),
(49, '592c175715bdc.jpg', 'jpg', 'image/jpeg', '56896', '21534d2eca8c476e5299618ec250fa77', '576', '1024'),
(50, '592c1758ece0f.jpg', 'jpg', 'image/jpeg', '58109', '2472c4c4795ab37aa2bf4c00553cfbeb', '547', '700'),
(51, '592c17d34becb.mp4', 'mp4', 'video/mp4', '250930', '41c508fca5b6599828bd59fa9d6287fa', '0', '0'),
(52, '592c17dc11e45.jpg', 'jpg', 'image/jpeg', '178199', 'c3c62274705c9ede595d924fe119a70e', '1623', '700'),
(53, '592c189ad8365.png', 'png', 'image/png', '1061426', '6f781ec1d7d8a29e2b8e1e74ce4fc2af', '1920', '1080'),
(54, '592c194450048.png', 'png', 'image/png', '250503', 'a2c435d0c46c3291bb25437b07b87c72', '2500', '2500'),
(55, '592c19f4accf1.png', 'png', 'image/png', '278922', '75fb6127d51670c3d5546f8af2e9a2c8', '586', '480'),
(56, '592c1aae134b8.jpg', 'jpg', 'image/jpeg', '40974', '687acc790f6558527b8984e9d80dd8c6', '340', '489'),
(57, '592c1b0c1fc04.jpg', 'jpg', 'image/jpeg', '42294', 'd0ff57fa3cc330543c21075c2a290d4d', '635', '640'),
(58, '592c1b56e581a.jpg', 'jpg', 'image/jpeg', '51241', '999840bd40b362e3aea287462e770007', '812', '700'),
(59, '592c1c045b5ea.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(60, '592c2049280c2.mp4', 'mp4', 'video/mp4', '2910009', '460bd393c5e4284c52a130cf7f1f8040', '0', '0'),
(61, '592c20c0d4c9e.jpg', 'jpg', 'image/jpeg', '147142', 'dc3eaaecbb18fd97f2a2460515baeeca', '1460', '600'),
(62, '592c43732f5f6.png', 'png', 'image/png', '486634', 'ab1e1dba25c71069afc1dabab84ff66a', '866', '644'),
(63, '592c44d88a7c6.png', 'png', 'image/png', '105891', '00cbd08b9228feb9739d6f0d22bf8f80', '474', '476'),
(64, '592c6605a633d.gif', 'gif', 'image/gif', '1750554', 'bdc3847d465e93043386ec3952e291b0', '216', '330'),
(65, '592c6d163b81e.png', 'png', 'image/png', '105891', '00cbd08b9228feb9739d6f0d22bf8f80', '474', '476'),
(66, '592c6d594ff77.gif', 'gif', 'image/gif', '1750554', 'bdc3847d465e93043386ec3952e291b0', '216', '330'),
(67, '592c6d904ab8f.png', 'png', 'image/png', '179559', '15515f82a9586928fd9c2c4e8b22490f', '600', '800'),
(68, '592c6da8c7fe4.png', 'png', 'image/png', '486634', 'ab1e1dba25c71069afc1dabab84ff66a', '866', '644'),
(69, '592c6dbf5d29c.jpg', 'jpg', 'image/jpeg', '56896', '21534d2eca8c476e5299618ec250fa77', '576', '1024'),
(70, '592c70226c2f3.gif', 'gif', 'image/gif', '1967219', '44ff5306c0ae1356b1cabd5610576d5e', '200', '277'),
(71, '592d445a9d028.jpg', 'jpg', 'image/jpeg', '58366', '5d4330fc2bb74f5d36f2c4cf1cb41d40', '390', '600'),
(72, '592d44c9aa520.jpg', 'jpg', 'image/jpeg', '79825', 'b749a36c37f06413b76eeacb6e0c24c0', '960', '960'),
(73, '592d4558715aa.jpg', 'jpg', 'image/jpeg', '46403', '0e882b9fbfe7c36baef97f8bcc2e65d3', '500', '392'),
(74, '592d4573d15d6.jpg', 'jpg', 'image/jpeg', '3560', '42273b3287bb5a723b1b40874b9ab627', '125', '125'),
(75, '592d4da571eb7.gif', 'gif', 'image/gif', '1570824', 'ce7ce347f1734d388146b0ce2a278c01', '600', '800'),
(76, '592d4de84eae7.jpg', 'jpg', 'image/jpeg', '34743', '42ba085a08f9c2ec192000de6935640b', '380', '500'),
(77, '592d5589bb638.png', 'png', 'image/png', '184564', '46ae6b82fc90075925fb63b4d256f885', '1483', '680'),
(78, '592d5dec8840c.png', 'png', 'image/png', '681068', 'bd3f718e365c95f21dbd7ccdf386d5be', '909', '903'),
(79, '592d5ea088a4e.gif', 'gif', 'image/gif', '1570824', 'ce7ce347f1734d388146b0ce2a278c01', '600', '800'),
(80, '592db44b0e40f.png', 'png', 'image/png', '290', '76496ed84130f0bb052600a5a3cb8ee4', '16', '16'),
(81, '592dcc50d26f4.mp4', 'mp4', 'video/mp4', '371096', '5987086c80f19138d47c720860f3bce6', '0', '0'),
(82, '592dcd5f2c6c2.png', 'png', 'image/png', '219318', 'f17a0ba9443bebde1c0ab1df179771e9', '549', '430'),
(83, '592dce59b3979.png', 'png', 'image/png', '109772', '9ca8288da89abe06e5f3b480a281768a', '610', '500'),
(84, '592e88ae5a8c4.gif', 'gif', 'image/gif', '1570824', 'ce7ce347f1734d388146b0ce2a278c01', '600', '800'),
(85, '592e8963155c7.gif', 'gif', 'image/gif', '452000', '0473b01aa1d751cebe999223a5ba5f14', '600', '800'),
(86, '592e89eb6398d.gif', 'gif', 'image/gif', '777520', '0a657d348dd774ec7be58f9dfce3bff6', '450', '600'),
(87, '592e95ca15f6a.', '', 'image/jpeg', '52844', '583cb84c5b9d147f8a8d9021a5794192', '580', '574'),
(88, '592e99a8199dc.jpg', 'jpg', 'image/jpeg', '59485', '1667cfd232bdc4173fa4d507cd2c3843', '518', '540'),
(89, '592e9a1a5f9df.gif', 'gif', 'image/gif', '1808703', 'd654d19e4bea489a15a9c94eba803aa0', '200', '200'),
(90, '592e9a4dde461.png', 'png', 'image/png', '3023', 'e60f9bd363186e0e5f825e0163b04db3', '54', '54'),
(91, '592e9a69c75fd.mp4', 'mp4', 'video/mp4', '250930', '41c508fca5b6599828bd59fa9d6287fa', '0', '0'),
(92, '592e9a9ce4e80.jpg', 'jpg', 'image/jpeg', '4119', 'b32513fbf84e3ef0d9fbe44d39c20dc1', '84', '150'),
(93, '592e9b643b3c5.jpg', 'jpg', 'image/jpeg', '50853', '239e2eb887325136e50fcf4dac396e09', '638', '599'),
(94, '592e9b7d8a201.jpg', 'jpg', 'image/jpeg', '262280', 'd73ef9e92670494a002480bc74008c83', '1776', '1080'),
(95, '592e9b830875f.jpg', 'jpg', 'image/jpeg', '142215', 'b600953f28b6b48eefc1534b7e178048', '325', '983'),
(96, '592e9bc431769.jpg', 'jpg', 'image/jpeg', '15353', 'b0ac81cb494f7c47c0e19371a41b366f', '292', '236'),
(97, '592e9be4b825c.jpg', 'jpg', 'image/jpeg', '25010', 'b56ddc01c04fed2fca7a0fc9693d5432', '342', '500'),
(98, '592e9c85703b7.png', 'png', 'image/png', '63047', 'f354998b607d5aff9aa39f38e08e806b', '300', '149'),
(99, '592e9d12a2b0e.png', 'png', 'image/png', '557671', 'ff0fc977b8ac2b9132f6c4fb29e88188', '516', '553'),
(100, '592e9d1ca6f36.png', 'png', 'image/png', '1904570', 'f92357e4fff80995d5e69ffed30760bf', '900', '1200'),
(101, '592e9d4578c0a.jpg', 'jpg', 'image/jpeg', '24875', '4390c9baf96f829ecb98f98a5c54d7b7', '407', '407'),
(102, '592e9d66c72cf.jpg', 'jpg', 'image/jpeg', '62328', '7136243b0b4204ebb1890c88701582d5', '720', '720'),
(103, '592e9d797cdb3.png', 'png', 'image/png', '20173', 'c6a4a282ca9d03fa45267cb66306888b', '256', '256'),
(104, '592e9e1ef3e46.jpg', 'jpg', 'image/jpeg', '31526', '195190d9d3561356ef53bb744c402505', '453', '604'),
(105, '592e9e79c30c1.jpg', 'jpg', 'image/jpeg', '43280', 'e61fa4c6a35e3e8c0fd0e4823063c18c', '424', '542'),
(106, '592e9e8667084.jpg', 'jpg', 'image/jpeg', '95032', '09ff8ba175ce527395968984fd893118', '540', '720'),
(107, '592e9f440f8e6.jpg', 'jpg', 'image/jpeg', '208132', '2cf19ec5deb3efc5a7954d3919c680d2', '1080', '1080'),
(108, '592e9f903fa34.jpg', 'jpg', 'image/jpeg', '55673', '700566eaece31e907615aa4b419526ce', '540', '720'),
(109, '592ea03acbf4f.jpg', 'jpg', 'image/jpeg', '6574', 'bb431f1e7a8a8e2de4c88d4274fa94ef', '269', '220'),
(110, '592ea05731dcc.png', 'png', 'image/png', '948201', 'a10e1fc29c30398fca33fc8995282e09', '720', '960'),
(111, '592ea119aaa62.jpg', 'jpg', 'image/jpeg', '75649', '4c8ae652ca594babe1251d84ac4015d0', '684', '960'),
(112, '592ea14e35585.jpg', 'jpg', 'image/jpeg', '151633', 'd25ad9fb055b92eb37d50284bc902f14', '1600', '900'),
(113, '592ea19917a55.jpg', 'jpg', 'image/jpeg', '257907', '164b00d72f4c26385ef4b9896b537fb7', '960', '1280'),
(114, '592ea2a83f28f.jpg', 'jpg', 'image/jpeg', '848034', '385a1751289093b63455c769578153f7', '2448', '3264'),
(115, '592ea2f8b4a2c.png', 'png', 'image/png', '1547816', '2ebfc677996157e0ce83362bbfd5ee09', '1334', '750'),
(116, '592ea32d395e6.jpg', 'jpg', 'image/jpeg', '161613', 'f9c1b1bf8884c5a228c48ef70c48757d', '1334', '750'),
(117, '592ea3be03bab.png', 'png', 'image/png', '44476', 'ab21ae832dd2b77d5f8465c710a1bbf3', '710', '379'),
(118, '592ea63a1cab4.jpg', 'jpg', 'image/jpeg', '134781', 'f24779512d58d5da899ef0f0a6417a1a', '1334', '750'),
(119, '592ea86e401ae.jpg', 'jpg', 'image/jpeg', '718897', 'cc44c89403c461a073e1891928797518', '779', '1200'),
(120, '592ea928a2928.jpg', 'jpg', 'image/jpeg', '188969', 'd76fe9283c7107990f9f37be4d2f791b', '1334', '750'),
(121, '592fc2fec172f.png', 'png', 'image/png', '273513', '291966b4a52422a47386d2ac0b1f8cdb', '269', '421'),
(122, '592fc2ff108b7.png', 'png', 'image/png', '273513', '291966b4a52422a47386d2ac0b1f8cdb', '269', '421'),
(123, '592fc499ba2d9.png', 'png', 'image/jpeg', '81741', 'e681bda2cf00987bc2f6881e8cde1b19', '521', '750'),
(124, '592fc50f467f8.png', 'png', 'image/jpeg', '91408', '72067960168acc69f43c4fd98ba2efd8', '691', '750'),
(125, '592fd7a00112c.png', 'png', 'image/png', '9550', 'd7981069574919dd4fae7d58855424b2', '460', '819'),
(126, '592fd7c0e2951.png', 'png', 'image/png', '539845', '4487f4e6f65e91de960fd6ad882d44bc', '555', '819'),
(127, '592fd856caff2.png', 'png', 'image/png', '9550', 'd7981069574919dd4fae7d58855424b2', '460', '819'),
(128, '592fd8af71ebd.jpg', 'jpg', 'image/jpeg', '109360', '769a705fc72faa79e16da38da46cd51a', '540', '720'),
(129, '59311b51952c9.jpg', 'jpg', 'image/jpeg', '129851', 'b89496288a590201f06fc5c2a89b6eb2', '877', '700');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `ban` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `post_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `code`, `activated`, `ban`, `admin`, `avatar`, `post_count`) VALUES
(1, 'admin', 'ebc5b17ffed3e223b6924b53cbcfc232260af28ac1c579b979beeb4c29da2eaa7f884cfb5d29fd41de47dcec01e5c4f39a1e684f89c614f949a5d38f0773db29', 'c@c.com', '75187', 0, 0, 1, '5a36c9331918b.jpg', 13),
(2, 'Snabel', 'aad068abbc7b93e4121ca86c1d45a621d6ab8f5bc9cd9cb0f2fc819ebaf9e323145493190b85eb1baa36f84c9f87b62e5d9b0e0b70afb0ddfea591ac041ebc21', 'jag@gillarsnabel.se', '89903', 0, 0, 0, '', 0),
(3, 'Floke', '01442cf81567dfd0712527a38abf40b85a10c287983eab9da23cb5f029c0642b1cb2eb8d03b40e5e0591a4aa237c1927349466fac321203cc00484b943c7bb0f', 'jag@snabel.se', '72347', 0, 0, 0, '', 3),
(5, 'Jeag1488', 'f83a3b298cfa086226db1fc12611268089e0b59a9d9a139761b406368355759e3c3f74d5ea75c95f9b879c4bbac7a9bbb5cdcb2ab1a7c78457d11f668e60eb62', '16alju@stockholmscience.se', '17770', 0, 0, 0, '', 5),
(6, 'taco', '6e5ed1ca7d8400fea26c269ea6482dc3143ac9592068fbc195b5bc5819249c7f0a4e4e5323e3e0a82ffc2ae14a4db61b0f49bb93c478c1109adb41d1319da826', '16wibe@stockholmscience.se', '82312', 0, 0, 0, '', 2),
(7, 'kushlon', '916b211466043ce43a3453ac4903a2fab6aaebc989011d222b39aa06e8cb6d47d0b6e2122db764f95bd543a6c4fb3f10b524e8ede46fabd1a3bc4249313a5ef3', 'anuspounder999@gmail.com', '34667', 0, 0, 0, '', 1),
(8, 'pepe', 'e38b6da2fdfe015b8ebca26cbdef67373fbf90a5f4341183f24004a257ee010aee12593c479bcd87e5b9edab2f4803130d441a3b133643a4ee33b935ebd41a5f', '16olsa@stockholmscience.se', '23872', 0, 0, 0, '5a379623537d8.jpg', 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `users_attempts`
--

CREATE TABLE `users_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_expiry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `session_registered` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users_attempts`
--

INSERT INTO `users_attempts` (`id`, `user_id`, `session_expiry`, `session_registered`) VALUES
(5, 4, '2017-06-05 09:58:02', '2017-05-29 09:58:02'),
(10, 5, '2017-05-30 10:29:47', '2017-05-29 10:29:47'),
(11, 6, '2017-06-05 10:32:19', '2017-05-29 10:32:19'),
(12, 6, '2017-06-05 11:07:36', '2017-05-29 11:07:36'),
(13, 5, '2017-05-30 12:32:42', '2017-05-29 12:32:42'),
(15, 3, '2017-06-05 13:07:32', '2017-05-29 13:07:32'),
(32, 7, '2017-06-06 10:40:48', '2017-05-30 10:40:48'),
(41, 8, '2017-06-07 07:22:30', '2017-05-31 07:22:30'),
(43, 9, '2017-06-07 10:25:01', '2017-05-31 10:25:01'),
(45, 11, '2017-06-01 10:29:59', '2017-05-31 10:29:59'),
(49, 12, '2017-06-07 10:32:11', '2017-05-31 10:32:11'),
(50, 13, '2017-06-01 10:37:49', '2017-05-31 10:37:49'),
(54, 14, '2017-06-07 10:42:22', '2017-05-31 10:42:22'),
(55, 15, '2017-06-07 10:46:06', '2017-05-31 10:46:06'),
(56, 5, '2017-06-01 10:49:39', '2017-05-31 10:49:39'),
(57, 5, '2017-06-07 11:00:37', '2017-05-31 11:00:37'),
(59, 11, '2017-06-01 11:16:04', '2017-05-31 11:16:04'),
(60, 18, '2017-06-07 11:23:06', '2017-05-31 11:23:06'),
(61, 17, '2017-06-01 14:40:33', '2017-05-31 14:40:33'),
(62, 6, '2017-06-08 09:03:42', '2017-06-01 09:03:42'),
(63, 2, '2017-06-03 06:53:42', '2017-06-02 06:53:42'),
(64, 6, '2017-06-09 08:00:53', '2017-06-02 08:00:53');

-- --------------------------------------------------------

--
-- Tabellstruktur `users_forgotten`
--

CREATE TABLE `users_forgotten` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users_forgotten`
--

INSERT INTO `users_forgotten` (`id`, `user_email`, `token`, `active`, `date`) VALUES
(1, '16jesu@stockholmscience.se', '38777c142019c8405d57', 1, '2017-05-29 09:50:44'),
(2, '16jesu@stockholmscience.se', '167b47fa69ea433f4ddb', 1, '2017-05-31 10:28:58'),
(3, '16jesu@stockholmscience.se', '94172bebc60d579ab42d', 1, '2017-05-31 10:41:36'),
(4, '16rasa@stockholmscience.se', '324285f20abebe1aff10', 1, '2017-05-31 11:21:42');

-- --------------------------------------------------------

--
-- Tabellstruktur `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `voted_by` varchar(255) NOT NULL,
  `upvote` int(11) NOT NULL,
  `downvote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `votes`
--

INSERT INTO `votes` (`id`, `post_id`, `voted_by`, `upvote`, `downvote`) VALUES
(1, 9, 'admin', 0, 1),
(2, 7, 'admin', 1, 0),
(3, 6, 'admin', 0, 1),
(4, 5, 'admin', 0, 1),
(5, 3, 'admin', 1, 0),
(6, 4, 'admin', 1, 0),
(7, 10, 'admin', 0, 1);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `memes`
--
ALTER TABLE `memes`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `stored_images`
--
ALTER TABLE `stored_images`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users_attempts`
--
ALTER TABLE `users_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users_forgotten`
--
ALTER TABLE `users_forgotten`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT för tabell `memes`
--
ALTER TABLE `memes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT för tabell `stored_images`
--
ALTER TABLE `stored_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT för tabell `users_attempts`
--
ALTER TABLE `users_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT för tabell `users_forgotten`
--
ALTER TABLE `users_forgotten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
