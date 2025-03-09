-- 设置SQL模式以确保兼容性
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET FOREIGN_KEY_CHECKS = 0;

-- 开始事务
START TRANSACTION;

-- 更新 blogs 表的 type 字段
ALTER TABLE blogs MODIFY COLUMN type CHAR(1) NOT NULL DEFAULT 'E' COMMENT 'S: solution, E: experience';

-- 创建博客-题目关联表(如果不存在)
CREATE TABLE IF NOT EXISTS blog_problems (
    blog_id INT NOT NULL,
    problem_id INT NOT NULL,
    PRIMARY KEY (blog_id, problem_id),
    KEY blog_id (blog_id),
    KEY problem_id (problem_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- 提交事务
COMMIT;

SET FOREIGN_KEY_CHECKS = 1; 