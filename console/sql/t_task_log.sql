-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-04-20 15:38:26
-- 服务器版本： 5.7.25
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `dsj_wjjkq_show`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_task_log`
--

DROP TABLE IF EXISTS `t_task_log`;
CREATE TABLE `t_task_log` (
  `id` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL COMMENT '创建时间',
  `created_by` varchar(100) DEFAULT NULL COMMENT '创建人',
  `updated_at` varchar(50) DEFAULT NULL COMMENT '修改时间',
  `updated_by` varchar(100) DEFAULT NULL COMMENT '修改人',
  `task_id` varchar(50) NOT NULL COMMENT '任务ID',
  `start_time` varchar(50) DEFAULT NULL COMMENT '开始执行时间',
  `finish_time` varchar(50) DEFAULT NULL COMMENT '结束执行时间',
  `info` varchar(500) DEFAULT NULL COMMENT '日志信息'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `t_task_log`
--
ALTER TABLE `t_task_log`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_task_log`
--
ALTER TABLE `t_task_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
