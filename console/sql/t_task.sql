-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-04-20 15:38:14
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
-- 表的结构 `t_task`
--

DROP TABLE IF EXISTS `t_task`;
CREATE TABLE `t_task` (
  `id` int(11) NOT NULL,
  `created_at` varchar(50) DEFAULT NULL COMMENT '创建时间',
  `created_by` varchar(100) DEFAULT NULL COMMENT '创建人',
  `updated_at` varchar(50) DEFAULT NULL COMMENT '修改时间',
  `updated_by` varchar(100) DEFAULT NULL COMMENT '修改人',
  `name` varchar(500) NOT NULL COMMENT '任务名称',
  `program` varchar(500) NOT NULL COMMENT '执行程序',
  `pid` varchar(20) DEFAULT NULL COMMENT 'pid',
  `timeOut` varchar(20) NOT NULL COMMENT '执行超时时间（单位秒）',
  `type` varchar(50) NOT NULL COMMENT '任务类型（1一次执行2间隔执行3指定时间执行单次执行4指定时间永久执行）',
  `start_time` varchar(50) NOT NULL COMMENT '任务开始时间',
  `info` varchar(500) DEFAULT NULL COMMENT '任务信息',
  `status` varchar(50) NOT NULL DEFAULT '0' COMMENT '任务状态(0未开始1正在执行2执行成功3执行失败)',
  `last_start_time` varchar(50) DEFAULT NULL COMMENT '上次开始执行时间',
  `last_finish_time` varchar(50) DEFAULT NULL COMMENT '上次结束执行时间',
  `next_start_time` varchar(50) DEFAULT NULL COMMENT '下次开始执行时间',
  `run_time` varchar(50) DEFAULT NULL COMMENT '任务运行时间',
  `is_kill` varchar(2) DEFAULT '0' COMMENT '进程是否杀死（0否1是）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `t_task`
--
ALTER TABLE `t_task`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_task`
--
ALTER TABLE `t_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
