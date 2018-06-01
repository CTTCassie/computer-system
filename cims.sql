-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-01 12:40:42
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
  `pigeonhole` tinyint(15) DEFAULT '0',
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

INSERT INTO `graduate` (`name`, `year`, `pigeonhole`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time`, `id`) VALUES
('小赵', '2018', 0, '2016全国优秀教材', '2016-4-5', 1, '中国电子教育学会', '国家级', '2018-04-26-23-15-13', 1),
('王明明', '2018', 0, '算法大赛', '2017-5-12', 1, '其他', '国家级', '2018-05-31-15-18-21', 5),
('***', '2017', 1, '其他', '2017-12-5', 2, '其他', '省级', '2018-05-31-12-37-24', 4);

-- --------------------------------------------------------

--
-- 表的结构 `postgraduate`
--

CREATE TABLE `postgraduate` (
  `name` varchar(10) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `pigeonhole` tinyint(15) DEFAULT '0',
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

INSERT INTO `postgraduate` (`name`, `year`, `pigeonhole`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time`, `id`) VALUES
('李晓', '2018', 0, 'ACM', '2017-12-4', 1, '中国电子教育学会', '国家级', '2018-05-01-18-58-25', 1),
('王明明', '2017', 0, '算法大赛', '2016-5-12', 1, '中国电子教育学会', '国家级', '2018-05-01-19-19-42', 2),
('王明明', '2018', 0, 'ACM', '2017-9-15', 1, '其他', '省级', '2018-05-01-19-20-13', 3),
('卓万万', '2017', 1, '计算机设计大赛', '2016-12-5', 3, 'other', '省级', '2018-05-31-12-16-7', 5);

-- --------------------------------------------------------

--
-- 表的结构 `teacherinfo`
--

CREATE TABLE `teacherinfo` (
  `name` varchar(10) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `pigeonhole` tinyint(15) DEFAULT '0',
  `science_name` varchar(100) DEFAULT NULL,
  `science_class` varchar(100) DEFAULT NULL,
  `science_time` varchar(20) DEFAULT NULL,
  `science_rank` int(20) DEFAULT '0',
  `teach_name` varchar(100) DEFAULT NULL,
  `teach_class` varchar(100) DEFAULT NULL,
  `teach_time` varchar(20) DEFAULT NULL,
  `teach_rank` int(20) DEFAULT '0',
  `other_name` varchar(100) DEFAULT NULL,
  `other_class` varchar(100) DEFAULT NULL,
  `other_time` varchar(20) DEFAULT NULL,
  `other_rank` int(20) DEFAULT '0',
  `famous_name` varchar(100) DEFAULT NULL,
  `famous_class` varchar(100) DEFAULT NULL,
  `famous_time` varchar(20) DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `teacherinfo`
--

INSERT INTO `teacherinfo` (`name`, `year`, `pigeonhole`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time`, `time`, `id`) VALUES
('王老师', '2017', 1, '腾讯算法大赛', '国家级', '2016-5-4', 1, '', '', '', 0, '', '', '', 0, '', '', '', '2018-05-31-15-1-43', 15),
('赵大白', '2018', 1, '', '', '', 0, '', '', '', 0, '百度之星', '省级', '2016-12-4', 1, '', '', '', '2018-05-31-11-15-11', 10),
('张氰', '2016', 1, '滴滴算法大赛', '省级', '2016-5-4', 1, '', '', '', 0, '', '', '', 0, '', '', '', '2018-05-31-11-17-31', 12),
('赵明', '2018', 1, '第四届算法设计大赛', '国家级', '2018-3-20', 2, '', '', '', 0, '', '', '', 0, '', '', '', '2018-05-31-11-51-48', 13),
('葶葶', '2018', 1, '', '', '', 0, 'ACM算法大赛', '国家级', '2017-4-21', 1, '', '', '', 0, '', '', '', '2018-05-31-11-13-19', 8),
('王明明', '2017', 1, '全国计算机设计大赛', '国家级', '2017-5-20', 1, '', '', '', 0, '', '', '', 0, '', '', '', '2018-05-31-11-14-15', 9);

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
(65, '001', 'MDAx');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `postgraduate`
--
ALTER TABLE `postgraduate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `teacherinfo`
--
ALTER TABLE `teacherinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
