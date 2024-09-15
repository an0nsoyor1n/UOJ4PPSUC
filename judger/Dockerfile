# 使用名为base_ubuntu的Docker镜像作为基础镜像，并使用最新版本
FROM base_ubuntu:latest


# 指定维护者信息，这里是Baoshuo，邮箱为i@baoshuo.ren
MAINTAINER Baoshuo <i@baoshuo.ren>

# 根据Open Containers Initiative (OCI)标准，为镜像添加源代码仓库地址
LABEL org.opencontainers.image.source=https://github.com/UniversalOJ/UOJ-System
# 为镜像添加描述，描述此镜像用于UOJ Judger
LABEL org.opencontainers.image.description="UOJ Judger"
# 指定镜像使用的许可证类型为MIT，以明确开源代码的使用和分发条件
LABEL org.opencontainers.image.licenses=MIT

# 指定shell类型，这里使用的是bash，并在执行命令时默认进入交互模式
SHELL ["/bin/bash", "-c"]

# 设置环境变量DEBIAN_FRONTEND，用于非交互模式安装，避免在安装过程中出现提示
ENV DEBIAN_FRONTEND=noninteractive
# 定义CLONE_ADDFLAG参数，用于在构建过程中传递额外的克隆标志
ARG CLONE_ADDFLAG


# 更新apt-get并安装必要的软件包以支持后续操作
RUN apt-get update && \
    # 安装GNUPG、CA证书及HTTPS传输支持
    apt-get install -y --no-install-recommends gnupg ca-certificates apt-transport-https && \
    # 再次更新apt-get以确保软件包列表最新
    apt-get update && \
    # 循环安装一系列指定的软件包，增加重试逻辑以提高安装成功率
    for pkg in python3 python3-requests git vim ntp zip unzip curl wget build-essential fp-compiler openjdk-8-jdk openjdk-11-jdk tzdata; do \
        # 设置重试次数为10次
        cnt=10 && \
        # 尝试安装软件包，若失败则重试，直到重试次数用尽
        while ! apt-get install -y "$pkg"; do \
            # 若重试次数已用尽，输出错误信息并跳出循环
            if [ $cnt -le 0 ]; then \
              echo "Failed to install $pkg" && \
              break ; \
            fi; \
            # 重试次数减一
            cnt=$((cnt - 1)); \
        done; \
    done


# 将当前目录下的所有内容添加到容器的/opt/uoj_judger目录中
ADD . /opt/uoj_judger
# 设置工作目录为/opt/uoj_judger
WORKDIR /opt/uoj_judger

# 安装环境并设置启动脚本
# 使用install.sh脚本进行环境安装和设置，-p参数用于安装，-d参数用于设置
RUN sh install.sh -p && sh install.sh -d

# 设置语言环境和时区
# 设置容器内的默认语言和时区，以便应用程序在正确的区域设置下运行
ENV LANG=C.UTF-8 TZ=Asia/Shanghai
# 暴露端口2333，使得容器外可以访问该端口
EXPOSE 2333
# 启动容器时运行的命令
# 启动时执行/opt/up脚本，此脚本通常包含实际的应用程序启动逻辑
CMD /opt/up

