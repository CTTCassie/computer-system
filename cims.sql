-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-05-30 07:17:27
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
-- 表的结构 `countworkload`
--

CREATE TABLE `countworkload` (
  `name` varchar(10) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `award_name` varchar(100) DEFAULT NULL,
  `award_points` int(10) NOT NULL DEFAULT '0',
  `time` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `countworkload`
--

INSERT INTO `countworkload` (`name`, `year`, `award_name`, `award_points`, `time`, `id`) VALUES
('王猛', '2018', '华为算法大赛', 32000, '2018-05-10 15:55:21', 3),
('赵大白', '2017', '百度算法大赛', 3600, '2018-05-23 14:24:08', 5);

-- --------------------------------------------------------

--
-- 表的结构 `graduate`
--

CREATE TABLE `graduate` (
  `name` varchar(10) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `award_name` varchar(100) DEFAULT NULL,
  `award_time` varchar(20) DEFAULT NULL,
  `rank` int(20) DEFAULT '0',
  `licenceauth` varchar(100) DEFAULT NULL,
  `awark_class` varchar(20) DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `graduate`
--

INSERT INTO `graduate` (`name`, `year`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time`, `id`) VALUES
('小赵', '2018', '2016全国优秀教材', '2016-4-5', 1, '中国电子教育学会', '国家级', '2018-04-26-23-15-13', 2),
('王明明', '2018', '算法大赛', '2017-5-12', 1, '其他', '国家级', '2018-05-01-18-9-22', 6),
('zww', '2018', 'ACM', '2018-3-12', 1, '北京大学', '国家级', '2018-04-27-22-5-42', 4);

-- --------------------------------------------------------

--
-- 表的结构 `postgraduate`
--

CREATE TABLE `postgraduate` (
  `name` varchar(10) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `award_name` varchar(100) DEFAULT NULL,
  `award_time` varchar(20) DEFAULT NULL,
  `rank` int(20) NOT NULL DEFAULT '0',
  `licenceauth` varchar(100) DEFAULT NULL,
  `awark_class` varchar(20) DEFAULT NULL,
  `time` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `postgraduate`
--

INSERT INTO `postgraduate` (`name`, `year`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time`, `id`) VALUES
('李晓', '2018', 'ACM', '2017-12-4', 1, '中国电子教育学会', '国家级', '2018-05-01-18-58-25', 1),
('王明明', '2017', '算法大赛', '2016-5-12', 1, '中国电子教育学会', '国家级', '2018-05-01-19-19-42', 3),
('王明明', '2018', 'ACM', '2017-9-15', 1, '其他', '省级', '2018-05-01-19-20-13', 4),
('小明', '2018', '华为算法设计大赛', '2018-3-12', 1, '其他', '省级', '2018-05-14-11-46-5', 6),
('1', '1', '1', '1', 1, '1', '省级', '2018-05-29-11-23-26', 7);

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
('张氰', '2018', '中兴算法大赛', '国家级', '2017-12-8', 0, '京东JData算法大赛', '省级', '2017-12-6', 2, '', '', '', 0, '', '', '', '2018-04-21-12-16-48', 194);

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `uid` int(10) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`uid`, `username`, `password`) VALUES
(59, 'root', 'cm9vdA=='),
(58, '14060509123', 'NDNtOXg4dGd3'),
(60, '001', 'MDAx'),
(62, '002', 'MDAy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countworkload`
--
ALTER TABLE `countworkload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graduate`
--
ALTER TABLE `graduate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postgraduate`
--
ALTER TABLE `postgraduate`
  ADD PRIMARY KEY (`id`);

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
-- 使用表AUTO_INCREMENT `countworkload`
--
ALTER TABLE `countworkload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `graduate`
--
ALTER TABLE `graduate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `postgraduate`
--
ALTER TABLE `postgraduate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `teacherinfo`
--
ALTER TABLE `teacherinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
