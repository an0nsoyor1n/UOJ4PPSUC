# PPSUC 在线评测系统

<p align="center">
  <img src="./CyberSwat.png" alt="CyberSwat" style="display: block; margin: auto; width: 50%;">
</p>

| [中文简体](./readme-zh.md) | [English](./readme-en.md)|

**PPSUC 在线评测系统的源代码，专注于编程技能的培训。**

- 支持多种编程语言，包括 **C/C++**、**Java**、**Python**。
- 支持不仅仅是 **中文** 和 **英文**，还包括其他语言，如 **俄语**、**西班牙语**、**法语**、**德语** 和 **葡萄牙语**。
- 使用 [Universal Online Judge](https://universaloj.github.io/) 作为核心。
- 通过 [Docker](https://www.docker.com/) 和 [Docker Compose](https://docs.docker.com/compose/) 进行组织。
- 使用 PHP、Python、C/C++、MySQL 等技术进行开发。
- 由 PPSUC Cyber SWAT Team 提供技术支持。

## 使用方法

### 从源代码构建项目：

首先，从 Docker Hub 拉取 Ubuntu 和 MySQL 的基础镜像。

我们推荐使用 ``ubuntu:20.04`` 和 ``mysql:5.7``。

之后，使用以下命令重命名镜像：

```bash
docker tag ubuntu:20.04 base_ubuntu:latest
docker tag mysql:8.0.23 base_mysql:latest
```

然后，使用以下命令构建整个项目：

```bash
bash prepare.sh
sudo docker compose build # 简洁模式
# 或
sudo docker compose build --progress=plain # 详细模式
```

如果网络条件不符合要求，项目构建可能会失败。

### 使用现有镜像轻松构建项目：

使用以下命令：

```bash
cd UOJ4PPSUC # 进入项目根目录
bash prepare.sh # 做一些准备工作
sudo docker-compose up -d # MacOS: 通过从 Docker Hub 下载镜像来构建项目
sudo docker compose up -d # Ubuntu: 通过从 Docker Hub 下载镜像来构建项目
```

我们使用挂载卷来存储项目数据，因此你可以在主机上修改配置文件和前端代码。

#### 通过加载本地镜像加速构建过程

如果 Docker Hub 的网络连接较慢导致``docker pull``速度较慢，建议加载本地镜像。

首先，在网络连接良好的计算机上下载以下三个镜像：

```text
ghcr.io/universaloj/uoj-db:latest
ghcr.io/universaloj/uoj-web:latest
ghcr.io/universaloj/uoj-judger:latest
```

例如，你可以使用以下 docker 命令下载镜像：

```Bash
docker pull ghcr.io/universaloj/uoj-db:latest
docker pull ghcr.io/universaloj/uoj-web:latest
docker pull ghcr.io/universaloj/uoj-judger:latest
```

然后，使用以下命令将镜像压缩成 .tar 文件：

```Bash
docker save -o ./uoj-db.tar ghcr.io/universaloj/uoj-db:latest
docker save -o ./uoj-web.tar ghcr.io/universaloj/uoj-web:latest
docker save -o ./uoj-judger.tar ghcr.io/universaloj/uoj-judger:latest
```

将 .tar 文件传输到网络连接较慢的计算机上。可以使用 scp、ftp 或其他方法。

之后，使用以下命令加载镜像：

```Bash
docker load -i ./uoj-db.tar
docker load -i ./uoj-web.tar
docker load -i ./uoj-judger.tar
```

然后运行 ``docker compose`` 命令。由于镜像是从本地磁盘加载的，构建过程会很快。

# 开发

前端开发的详细信息请参见 [frontend readme](web/readme.md)。

其他详细信息请参见 [官方文档](https://universaloj.github.io/)。
