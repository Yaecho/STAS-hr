-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-03-08 16:41:11
-- 服务器版本： 5.7.18-1
-- PHP Version: 7.1.6-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `STASdata`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1493451513);

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT '',
  `data` blob,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, '超级管理员', NULL, NULL, 1493206260, 1493363372),
('guide', 1, '签到人员', NULL, NULL, 1493207171, 1493207171),
('guide/*', 2, '签到功能', NULL, NULL, 1495010253, 1495010253),
('interviewer', 1, '面试人员', NULL, NULL, 1493207285, 1493207285),
('interviewer/*', 2, '面试功能', NULL, NULL, 1494578746, 1494578973),
('minister', 1, '部长', NULL, NULL, 1493207118, 1493207118),
('recycle/*', 2, '回收站功能', NULL, NULL, 1493475553, 1494822040),
('resume/*', 2, '管理本部门简历', NULL, NULL, 1493209259, 1494822224),
('[EditAllResume]', 2, '管理所有简历', NULL, NULL, 1493519349, 1494822241);

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'guide'),
('guide', 'guide/*'),
('admin', 'interviewer'),
('interviewer', 'interviewer/*'),
('admin', 'minister'),
('admin', 'recycle/*'),
('admin', 'resume/*'),
('minister', 'resume/*'),
('admin', '[EditAllResume]');

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `hire`
--

CREATE TABLE `hire` (
  `id` int(15) NOT NULL,
  `rid` int(15) NOT NULL DEFAULT '0',
  `iid` int(15) NOT NULL DEFAULT '0',
  `iname` varchar(25) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `resume`
--

CREATE TABLE `resume` (
  `id` int(20) NOT NULL,
  `name` varchar(25) NOT NULL DEFAULT '',
  `sex` varchar(1) NOT NULL DEFAULT '',
  `birthday` varchar(8) NOT NULL DEFAULT '',
  `place` varchar(30) NOT NULL DEFAULT '',
  `identity` varchar(10) NOT NULL DEFAULT '',
  `college` varchar(30) NOT NULL DEFAULT '',
  `class` varchar(30) NOT NULL DEFAULT '',
  `dorm` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `first_wish` varchar(10) NOT NULL DEFAULT '',
  `second_wish` varchar(10) NOT NULL DEFAULT '',
  `myself` varchar(535) NOT NULL DEFAULT '',
  `hope` varchar(535) NOT NULL DEFAULT '',
  `created_time` int(10) NOT NULL DEFAULT '0',
  `hobbies` varchar(535) NOT NULL DEFAULT '',
  `sid` varchar(10) NOT NULL DEFAULT '' COMMENT '学号',
  `is_send` int(1) NOT NULL DEFAULT '0' COMMENT '0未发生，1已发送，2发送失败',
  `code` varchar(6) NOT NULL DEFAULT '0' COMMENT '短信确认码',
  `res` int(1) NOT NULL DEFAULT '0' COMMENT '短信确认',
  `not_recycling` int(1) NOT NULL DEFAULT '1' COMMENT '不在回收站内'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `review`
--

CREATE TABLE `review` (
  `id` int(15) NOT NULL,
  `rid` int(15) NOT NULL DEFAULT '0',
  `star_1` int(1) NOT NULL DEFAULT '0',
  `star_2` int(1) NOT NULL DEFAULT '0',
  `star_3` int(1) NOT NULL DEFAULT '0',
  `star_4` int(1) NOT NULL DEFAULT '0',
  `star_5` int(1) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL DEFAULT '',
  `iid` int(15) NOT NULL DEFAULT '0',
  `iname` varchar(25) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `room_assignment`
--

CREATE TABLE `room_assignment` (
  `id` int(10) NOT NULL,
  `department` varchar(25) NOT NULL DEFAULT '',
  `classroom` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `session`
--

CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(10) NOT NULL DEFAULT '0',
  `data` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的结构 `setting`
--

CREATE TABLE `setting` (
  `name` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`name`, `value`) VALUES
('i_url', 'http://mp.weixin.qq.com/s?__biz=MzA5Njk1NDYzOA==&mid=502309363&idx=1&sn=ded2e96251d8dc71fbc82c8e668228fc&scene=1&srcid=0904zMFFaTnRdUAJrwNFTr1J#rd'),
('rescode', 'true'),
('resume', 'true'),
('send_sms', 'false'),
('sms_templete', '【南工学生科协】亲爱的学弟学妹们，首先感谢你选择了南工学生科协，我们的一面将在29号、30号举行，签到教室是明德507、明德508，你的短信确认码是$code$，请及时在系统确认并且参与一面，友情提醒，军训不能因此请假哦。(测试)'),
('yunpian', '');

-- --------------------------------------------------------

--
-- 表的结构 `sign_table`
--

CREATE TABLE `sign_table` (
  `id` int(15) NOT NULL,
  `rid` int(15) NOT NULL,
  `department` varchar(25) NOT NULL DEFAULT '',
  `is_sign` smallint(1) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL COMMENT '自增ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `truename` varchar(50) NOT NULL DEFAULT '',
  `department` varchar(30) NOT NULL DEFAULT '',
  `class` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `qq` varchar(25) NOT NULL DEFAULT '',
  `duty` varchar(50) NOT NULL DEFAULT '' COMMENT '职务',
  `birthday` varchar(7) NOT NULL DEFAULT '',
  `appearance` varchar(20) NOT NULL DEFAULT '' COMMENT '政治面貌',
  `dorm` varchar(30) NOT NULL DEFAULT '' COMMENT '宿舍区',
  `auth_key` varchar(32) NOT NULL DEFAULT '' COMMENT '自动登录key',
  `password_hash` varchar(255) NOT NULL DEFAULT '' COMMENT '加密密码',
  `password_reset_token` varchar(255) DEFAULT '' COMMENT '重置密码token',
  `email_validate_token` varchar(255) DEFAULT '' COMMENT '邮箱验证token',
  `email` varchar(255) DEFAULT '' COMMENT '邮箱',
  `role` smallint(6) NOT NULL DEFAULT '10' COMMENT '角色等级',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `avatar` varchar(255) DEFAULT '' COMMENT '头像',
  `vip_lv` int(11) DEFAULT '0' COMMENT 'vip等级',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `truename`, `department`, `class`, `phone`, `qq`, `duty`, `birthday`, `appearance`, `dorm`, `auth_key`, `password_hash`, `password_reset_token`, `email_validate_token`, `email`, `role`, `status`, `avatar`, `vip_lv`, `created_at`, `updated_at`) VALUES
(1, 'root', '管理员', '主席团', '科协一班', '110', '110', '主席团', '1995-11', '科协', '明德楼', 'zyuxYAK3CjlTPbJ5IEW2QZa28lmvcIji', '$2y$13$C4vyrL725nlwLtJe/2UrsuFmrCTRzk96En5Ru01VhwOvWtDntiTeK', NULL, NULL, '123@qq.com', 10, 10, NULL, 0, 1492770946, 1520413350);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `hire`
--
ALTER TABLE `hire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_assignment`
--
ALTER TABLE `room_assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `sign_table`
--
ALTER TABLE `sign_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rid` (`rid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `hire`
--
ALTER TABLE `hire`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `room_assignment`
--
ALTER TABLE `room_assignment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sign_table`
--
ALTER TABLE `sign_table`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
