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