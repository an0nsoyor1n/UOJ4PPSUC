USE `app_uoj233`;

/* 检查 sid 列是否存在 */
SELECT COUNT(*) INTO @column_exists
FROM information_schema.COLUMNS
WHERE TABLE_NAME = 'user_info'
  AND COLUMN_NAME = 'sid'
  AND TABLE_SCHEMA = 'app_uoj233';

/* 如果列不存在，添加 sid 列并赋予默认值 */
SET @sql = IF(@column_exists = 0,
              'ALTER TABLE `user_info` ADD COLUMN sid VARCHAR(12) DEFAULT ''000000000000'';',
              'SELECT "Column sid already exists";');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

/* 检查 jid 列是否存在 */
SELECT COUNT(*) INTO @column_exists
FROM information_schema.COLUMNS
WHERE TABLE_NAME = 'user_info'
  AND COLUMN_NAME = 'jid'
  AND TABLE_SCHEMA = 'app_uoj233';

SET @sql = IF(@column_exists = 0,
              'ALTER TABLE `user_info` ADD COLUMN jid VARCHAR(6) DEFAULT ''000000'';',
              'SELECT "Column jid already exists";');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

/* 检查 class 列是否存在 */
SELECT COUNT(*) INTO @column_exists
FROM information_schema.COLUMNS
WHERE TABLE_NAME = 'user_info'
  AND COLUMN_NAME = 'class'
  AND TABLE_SCHEMA = 'app_uoj233';

SET @sql = IF(@column_exists = 0,
              'ALTER TABLE `user_info` ADD COLUMN class VARCHAR(100) DEFAULT ''000000'';',
              'SELECT "Column class already exists";');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 题单表
CREATE TABLE IF NOT EXISTS `problem_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `tags` varchar(255),
  `creator_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`),
  FOREIGN KEY (`creator_id`) REFERENCES `user_info` (`usergroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 题单-题目关联表
CREATE TABLE IF NOT EXISTS `problem_list_problems` (
  `list_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`list_id`, `problem_id`),
  FOREIGN KEY (`list_id`) REFERENCES `problem_lists` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;