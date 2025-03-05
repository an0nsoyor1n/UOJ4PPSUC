#!/bin/bash

# 颜色定义
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 日志函数
log_info() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

log_warn() {
    echo -e "${YELLOW}[WARN]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# 检查数据库连接
check_db_connection() {
    log_info "检查数据库连接..."
    local max_attempts=30
    local attempt=1

    while ! docker exec uoj-db mysql -u root -proot app_uoj233 -e "SELECT 1" >/dev/null 2>&1; do
        if [ $attempt -ge $max_attempts ]; then
            log_error "数据库连接失败，请检查数据库服务是否正常运行"
            exit 1
        fi
        log_warn "等待数据库连接... (${attempt}/${max_attempts})"
        attempt=$((attempt + 1))
        sleep 2
    done
    log_info "数据库连接成功"
}

# 备份数据库
backup_database() {
    local backup_file="backup_$(date +%Y%m%d_%H%M%S).sql"
    log_info "开始备份数据库到 ${backup_file}"
    
    if docker exec uoj-db mysqldump -u root -proot app_uoj233 > "backups/${backup_file}"; then
        log_info "数据库备份成功"
        echo "${backup_file}"
    else
        log_error "数据库备份失败"
        exit 1
    fi
}

# 初始化迁移表
init_migration_table() {
    log_info "初始化迁移表..."
    docker exec -i uoj-db mysql -u root -proot app_uoj233 <<EOF
    CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_migration (migration)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
EOF
}

# 检查迁移是否已执行
is_migration_executed() {
    local migration_file=$1
    local result=$(docker exec uoj-db mysql -u root -proot app_uoj233 -N -e "SELECT COUNT(*) FROM migrations WHERE migration='$migration_file'" 2>/dev/null)
    [ "$result" = "1" ]
}

# 执行迁移
run_migration() {
    local migration_file=$1
    log_info "执行迁移: $migration_file"
    
    if docker exec -i uoj-db mysql -u root -proot app_uoj233 < "migrations/$migration_file"; then
        docker exec -i uoj-db mysql -u root -proot app_uoj233 -e "INSERT INTO migrations (migration) VALUES ('$migration_file')"
        log_info "迁移成功: $migration_file"
        return 0
    else
        log_error "迁移失败: $migration_file"
        return 1
    fi
}

# 回滚数据库
rollback_database() {
    local backup_file=$1
    log_warn "开始回滚数据库到备份: ${backup_file}"
    
    if docker exec -i uoj-db mysql -u root -proot app_uoj233 < "backups/${backup_file}"; then
        log_info "数据库回滚成功"
    else
        log_error "数据库回滚失败"
        exit 1
    fi
}

# 主函数
main() {
    # 检查migrations目录是否存在
    if [ ! -d "migrations" ]; then
        log_error "migrations目录不存在"
        exit 1
    fi

    # 创建backups目录
    mkdir -p backups

    # 检查是否有.sql文件需要执行
    if ! ls migrations/*.sql >/dev/null 2>&1; then
        log_warn "没有找到需要执行的迁移文件"
        exit 0
    fi

    # 检查数据库连接
    check_db_connection
    
    # 初始化迁移表
    init_migration_table
    
    # 创建备份
    backup_file=$(backup_database)
    
    # 遍历所有迁移文件
    for migration in migrations/*.sql; do
        migration_file=$(basename "$migration")
        
        # 检查迁移是否已执行
        if ! is_migration_executed "$migration_file"; then
            if ! run_migration "$migration_file"; then
                log_error "迁移失败,开始回滚"
                rollback_database "$backup_file"
                exit 1
            fi
        else
            log_info "迁移已执行: $migration_file"
        fi
    done
    
    log_info "所有迁移执行完成"
}

# 执行主函数
main 