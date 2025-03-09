-- 设置SQL模式以确保兼容性
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET FOREIGN_KEY_CHECKS = 0;

-- 开始事务
START TRANSACTION;

-- 先检查并删除已存在的表（如果需要重新创建）
DROP TABLE IF EXISTS `problem_list_problems`;
DROP TABLE IF EXISTS `problem_list_registrants`;
DROP TABLE IF EXISTS `problem_lists`;

-- 题单表
CREATE TABLE IF NOT EXISTS `problem_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `tags` varchar(255),
  `creator_username` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `creator_username` (`creator_username`),
  KEY `create_time` (`create_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- 题单-题目关联表
CREATE TABLE IF NOT EXISTS `problem_list_problems` (
  `list_id` int(11) NOT NULL,
  `problem_id` int(10) unsigned NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`list_id`, `problem_id`),
  KEY `problem_id` (`problem_id`),
  KEY `list_id` (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- 题单报名表
CREATE TABLE IF NOT EXISTS `problem_list_registrants` (
  `list_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`list_id`, `username`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- 添加外键约束（如果需要的话）
-- ALTER TABLE `problem_list_problems` 
--   ADD CONSTRAINT `fk_list_id` FOREIGN KEY (`list_id`) REFERENCES `problem_lists` (`id`) ON DELETE CASCADE,
--   ADD CONSTRAINT `fk_problem_id` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`) ON DELETE CASCADE;

-- 如果需要删除表的SQL（用于回滚）
-- DROP TABLE IF EXISTS `problem_list_problems`;
-- DROP TABLE IF EXISTS `problem_list_registrants`;
-- DROP TABLE IF EXISTS `problem_lists`;

-- 提交事务
COMMIT;

SET FOREIGN_KEY_CHECKS = 1; 