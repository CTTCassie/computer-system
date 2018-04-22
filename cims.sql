-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-22 13:27:43
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cims`
--

-- --------------------------------------------------------

--
-- 表的结构 `teacherinfo`
--

CREATE TABLE `teacherinfo` (
  `name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `year` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `science_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `science_class` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `science_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `science_rank` int(20) NOT NULL DEFAULT '0',
  `teach_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `teach_class` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `teach_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `teach_rank` int(20) NOT NULL DEFAULT '0',
  `other_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `other_class` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `other_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `other_rank` int(20) NOT NULL DEFAULT '0',
  `famous_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `famous_class` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `famous_time` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `time` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `teacherinfo`
--

INSERT INTO `teacherinfo` (`name`, `year`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time`, `time`, `id`) VALUES
('王明明', '2017', '全国计算机设计大赛', '国家级', '2017-5-12', 1, '', '', '', 1, '', '', '', 1, '', '', '', '2018-04-15-22-9-22', 184),
('赵大白', '2018', '百度之星', '国家级', '2017-5-29', 1, '', '', '', 1, '', '', '', 1, '', '', '', '2018-04-15-22-33-57', 188),
('张氰', '2017', '滴滴算法大赛', '国家级', '2016-5-4', 0, '第四节算法设计大赛', '省级', '2017-3-21', 1, '', '', '', 0, '', '', '', '2018-04-15-22-35-28', 189),
('小悦悦', '2018', '科技之星', '省级', '2017-5-12', 1, '', '', '', 1, '', '', '', 1, '', '', '', '2018-04-20-20-16-19', 192),
('张氰', '2018', '中兴算法大赛', '国家级', '2017-12-8', 0, '京东JData算法大赛', '省级', '2017-12-6', 2, '', '', '', 0, '', '', '', '2018-04-21-12-16-48', 194),
('强哥', '2018', 'ACM', '国家级', '2017-5-12', 1, '', '', '', 1, '', '', '', 1, '', '', '', '2018-04-22-14-33-35', 197),
('张氰', '2017', '', '', '', 1, '华为算法设计大赛', '国家级', '2017-5-12', 1, '', '', '', 0, '', '', '', '2018-04-22-14-35-13', 198);

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `uid` int(10) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`uid`, `username`, `password`) VALUES
(45, '14060509123', 'NDNtOXg4dGd3'),
(43, 'root', 'cm9vdA==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacherinfo`
--
ALTER TABLE `teacherinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `teacherinfo`
--
ALTER TABLE `teacherinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
