-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022 年 04 月 20 日 23:01
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `online_date_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `privatemessage`
--

CREATE TABLE `privatemessage` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `sender` varchar(30) NOT NULL,
  `receiver` varchar(30) NOT NULL,
  `msg` varchar(550) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `privatemessage`
--

INSERT INTO `privatemessage` (`id`, `uuid`, `sender`, `receiver`, `msg`, `created_on`) VALUES
(18, '9ec043c7-3b90-40d0-9080-6ac7bdfe6555', 'rindo27', 'jackyho', 'yooooo\n', '2022-04-18 10:20:49'),
(17, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'rindo27', 'yoo ', '2022-04-18 10:20:07'),
(16, '0386f484-8fe6-4ff8-8924-ef7e81ea88a1', 'chaklam', 'jackyho', 'ok', '2022-04-17 07:36:36'),
(15, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'im eating dinner', '2022-04-17 07:36:34'),
(40, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'ya', '2022-04-19 03:24:07'),
(9, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'wa', '2022-04-15 01:03:00'),
(13, '0386f484-8fe6-4ff8-8924-ef7e81ea88a1', 'chaklam', 'jackyho', 'yoooo', '2022-04-17 07:36:26'),
(11, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'wat', '2022-04-15 01:29:12'),
(12, '9ec043c7-3b90-40d0-9080-6ac7bdfe6555', 'rindo27', 'chaklam', 'eating dinner', '2022-04-15 01:38:42'),
(41, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'yoooo', '2022-04-19 03:27:52'),
(39, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'ya', '2022-04-19 03:23:58'),
(27, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'chaklam', 'jackyho', 'hihihihihihihi', '2022-04-19 03:09:57'),
(38, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'chaklam', 'jackyho', 'test', '2022-04-19 03:20:01'),
(42, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'yoooo', '2022-04-19 03:28:06'),
(43, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'ok', '2022-04-19 03:29:55'),
(44, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'test', '2022-04-19 03:33:04'),
(45, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'this is a test', '2022-04-19 03:43:25'),
(46, '0386f484-8fe6-4ff8-8924-ef7e81ea88a1', 'chaklam', 'jackyho', 'ok', '2022-04-19 03:44:16'),
(33, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'chaklam', 'jackyho', 'test', '2022-04-19 03:12:42'),
(47, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'chaklam', 'yoooooooo', '2022-04-19 04:38:22'),
(48, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'jackyho', 'testuser1', 'hi', '2022-04-19 04:42:55'),
(49, 'cd367911-b25f-43e2-b5f6-5d8ce32cc49e', 'testuser2', 'rindo27', 'yoo', '2022-04-21 04:44:17');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `cookies` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `uuid`, `firstname`, `lastname`, `gender`, `email`, `username`, `password`, `nickname`, `age`, `description`, `filename`, `cookies`, `status`) VALUES
(2, '06e7511b-b2d2-4d5f-8205-78c9fcda2194', 'Jacky', 'Ho', 'male', 'jackyho27@jackyho27.com', 'jackyho27', '$2y$10$/QljRYliMnGoNDBanRk41eqzrKv1zs4.qYXgiOeLARQgn7gOKK13i', 'jackyho', 23, 'hi', 'testicon6.png', 'jackyho27,$2y$10$hrasc5di8aS.o62BcQNE4OZG3ILbP1R.xkHKl1tPismfbcMaDte9.', 0),
(3, '0386f484-8fe6-4ff8-8924-ef7e81ea88a1', 'Chak', 'Lam', 'secret', 'chaklam27@chaklam27.com', 'chaklam27', '$2y$10$KuPj55gprXGFjBLByDQVj.qYIsyd8Zv9za017mPvEBYd16bBdEaoy', 'chaklam', 20, 'hi', 'defaulticon.png', 'chaklam27,$2y$10$wOox5uAeWcYji/quk536ven0EINX57kuUaPkFjcghVDpbmg8KFA1K', 0),
(5, '0b059a25-0fce-486d-83e1-736f9399f9df', 'user', 'one', 'secret', 'testuser1@testuser1.com', 'testuser1', '$2y$10$Cpwjn93HirlDDmE9.ntMdO2RER/CdegRbNXZtCgo0BSi1iiRwDRNa', 'testuser1', NULL, NULL, 'testicon5.png', 'testuser1,$2y$10$MT4XEfhUsn10KSadKjYHSeiki7m7x8lWqz46lQq4yC0td.sSp55li', 0),
(9, '9ec043c7-3b90-40d0-9080-6ac7bdfe6555', 'rindo', 'sakura', 'male', 'rindo2777@rindo2777.com', 'rindo2777', '$2y$10$loP1suJn2DCOrfqaHN0Cl.b.MumFMpLExF/4HypXkcDVxqOISU0nq', 'rindo27', NULL, NULL, NULL, '', 0),
(12, 'cd367911-b25f-43e2-b5f6-5d8ce32cc49e', 'user', 'two', 'male', 'testuser2@testuser2.com', 'testuser2', '$2y$10$wdZFNG84ssD8bMu3eVMFseABDlVMpoiGzval93zEqcLxmarhyyxse', 'testuser2', NULL, NULL, 'testicon7.png', 'testuser2,$2y$10$UTBT6gTbKJgqPg3DwC4sbeUzb/Yh4.L5mELJOnvymJQzZ7Pmd.EQS', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `privatemessage`
--
ALTER TABLE `privatemessage`
  ADD PRIMARY KEY (`id`,`uuid`),
  ADD UNIQUE KEY `id` (`id`,`uuid`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`uuid`),
  ADD UNIQUE KEY `unique` (`id`,`uuid`) USING BTREE;

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `privatemessage`
--
ALTER TABLE `privatemessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
