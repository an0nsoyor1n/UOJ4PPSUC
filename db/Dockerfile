# 使用名为base_mysql的自定义基础镜像的最新版本作为父镜像
FROM base_mysql:latest

# 指定镜像的维护者信息
MAINTAINER Baoshuo <i@baoshuo.ren>

# 为镜像添加标签，指定源代码仓库
LABEL org.opencontainers.image.source=https://github.com/UniversalOJ/UOJ-System
# 为镜像添加标签，描述镜像用途
LABEL org.opencontainers.image.description="UOJ Database"
# 为镜像添加标签，指定使用的许可证类型
LABEL org.opencontainers.image.licenses=MIT

# 将当前目录下的所有文件添加到容器的/opt/uoj_db目录
ADD . /opt/uoj_db
# 设置容器的工作目录为/opt/uoj_db
WORKDIR /opt/uoj_db

# ENTRYPOINT ["sh", "-c", "mysql-server & ${COMMAND}"]


# 运行安装脚本进行环境配置
RUN sh install.sh

# 设置环境变量，指定语言环境和时区
ENV LANG=C.UTF-8 TZ=Asia/Shanghai
