-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 09 月 02 日 12:19
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `csueye`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `account` varchar(50) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `realName` varchar(50) DEFAULT NULL,
  `isRoot` int(11) DEFAULT NULL,
  `addTime` datetime DEFAULT NULL,
  `lastLoginTime` datetime DEFAULT NULL,
  `lastLoginIP` varchar(50) DEFAULT NULL,
  `loginCount` int(11) DEFAULT '0',
  `enable` int(11) DEFAULT '1',
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`account`, `password`, `realName`, `isRoot`, `addTime`, `lastLoginTime`, `lastLoginIP`, `loginCount`, `enable`) VALUES
('admin', '8TUgr+966J5V9p1BwYZaIshfXU9+jQ97v7hdIyp0T1lnB7YJabDUYf/bgXDxpUD/wbte1iobVB9izq7VoVsmMQ==', 'admin', 1, '2013-09-02 12:00:27', '2013-09-02 12:10:20', '127.0.0.1', 2, 1),
('csueye', 'KM/RLLrFIBF82+RSi2y6+P4uXJJnrrZUJBIyO1NxXNRjZmtNPZXiSStNesX8e4AWfVcm2OHOqM0BvUsvk3hquQ==', 'csueyeadmin', -1, '2013-09-02 11:33:59', '2013-09-02 12:15:07', '127.0.0.1', 6, 1),
('test', 'Gu1ECv0mT8wGVwgD1luKOgJoEHmbigd6gWlYt1CZD0Bm/Lu585PY/nBKoZRSf02NI0R3ET9qAfTMVMORtRkeNg==', 'test', 0, '2013-09-02 11:46:24', NULL, NULL, 0, 1),
('zp', 'WCWDC+1iIjJrVy+Nb97Fp48vH4vcVarvNfhPUTmsGb3Rjms4GxXDUsgv/FdynPpAutrdF6ZuZPmKMDqYQ5RwLw==', 'zp', 0, '2013-09-02 11:46:45', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectID` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `clickCount` bigint(20) DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_3` (`subjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subjectID` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `brief` varchar(200) NOT NULL,
  `path` varchar(500) DEFAULT NULL,
  `downloadCount` bigint(20) DEFAULT '0',
  `addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Reference_4` (`subjectID`),
  KEY `FK_Reference_5` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subjectID` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `source` varchar(100) DEFAULT NULL,
  `picPath` varchar(500) DEFAULT NULL,
  `clickCount` bigint(20) DEFAULT '0',
  `addTime` datetime DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  `flag` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_Reference_1` (`subjectID`),
  KEY `FK_Reference_2` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentID` int(11) DEFAULT '0',
  `rootID` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `brief` varchar(200) DEFAULT NULL,
  `flag` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `subject`
--

INSERT INTO `subject` (`id`, `parentID`, `rootID`, `name`, `brief`, `flag`) VALUES
(1, 0, 0, '学院概况', '', 0),
(2, 0, 0, '教育教学', '', 0),
(3, 0, 0, '科学研究', '', 0),
(4, 0, 0, '学生风采', '', 0),
(5, 0, 0, '招生就业', '', 0),
(6, 0, 0, '下载中心', '', 0),
(7, 1, 1, '学院介绍', NULL, 1),
(8, 1, 1, '学院新闻', NULL, 2),
(9, 1, 1, '学院公告', NULL, 2),
(10, 1, 1, '领导班子', NULL, 1),
(11, 1, 1, '院长致辞', NULL, 1),
(12, 1, 1, '支部介绍', NULL, 1),
(13, 1, 1, '综合办公室', NULL, 1),
(14, 1, 1, '院长信箱', NULL, 1),
(15, 2, 2, '研究生教育', NULL, 0),
(16, 2, 2, '继续教育', NULL, 0),
(17, 2, 2, '奖助信息', NULL, 1),
(18, 3, 3, '科研机构', NULL, 1),
(19, 3, 3, '科研项目', NULL, 1),
(20, 3, 3, '科研成果', NULL, 1),
(21, 3, 3, '激励政策', NULL, 1),
(22, 4, 4, '学生活动', NULL, 2),
(23, 4, 4, '学生会', NULL, 1),
(24, 4, 4, '校友会', NULL, 1),
(25, 5, 5, '招生信息', NULL, 2),
(26, 5, 5, '就业信息', NULL, 1),
(27, 5, 5, '就业指导', NULL, 1),
(28, 5, 5, '实习园地', NULL, 1),
(29, 6, 6, '电子文件', NULL, 3),
(30, 6, 6, '音频资料', NULL, 3),
(31, 6, 6, '视频资料', NULL, 3),
(32, 15, 2, '专业设置', NULL, 1),
(33, 15, 2, '培养方案', NULL, 1),
(34, 15, 2, '导师介绍', NULL, 1),
(35, 16, 2, '专业设置', NULL, 1),
(36, 16, 2, '培养方案', NULL, 1),
(37, 16, 2, '导师介绍', NULL, 1);

--
-- 限制导出的表
--

--
-- 限制表 `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_Reference_3` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`);

--
-- 限制表 `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_Reference_4` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reference_5` FOREIGN KEY (`author`) REFERENCES `admin` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_Reference_1` FOREIGN KEY (`subjectID`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reference_2` FOREIGN KEY (`author`) REFERENCES `admin` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
