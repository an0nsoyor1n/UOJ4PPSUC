
COMMIT;

SET FOREIGN_KEY_CHECKS = 1; 
CREATE TABLE IF NOT EXISTS `problem_list_registrants` (
  `list_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`list_id`, `username`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4; 

-- 题单报名表
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET FOREIGN_KEY_CHECKS = 0;

-- 开始事务
START TRANSACTION;

-- 为problem_list_registrants表添加class字段
ALTER TABLE problem_list_registrants 
ADD COLUMN class VARCHAR(20) DEFAULT NULL COMMENT '班级,如23数据警务技术1班';

