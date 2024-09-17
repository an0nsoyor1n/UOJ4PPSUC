# Online Judge of PPSUC

<p align="center">
  <img src="./CyberSwat.png" alt="CyberSwat" style="display: block; margin: auto; width: 50%;">
</p>

| [中文简体](./readme-zh.md) | [English](./readme-en.md)|

**The source code of Online Judge system of PPSUC, focusing on the training of programming skills.**

- Support mutiple languages, including **C/C++**, **Java**, **Python**.
- Support not only **Chinese** and **English**, but also other languages including **Russian**, **Spanish**, **French**, **German** and **Portuguese**.
- Using [Universal Online Judge](https://universaloj.github.io/) as the core.
- Organized with [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/).
- Developed with PHP, Python, C/C++, MySQL, and other technologies.
- Technical supported by Cyber SWAT Team of PPSUC.

## Usage

### Build the project from the source code:

First, pull the basic images of Ubuntu and MySQL from Docker Hub.

We recommend ``ubuntu:20.04`` and ``mysql:5.7``.

After that, rename the images using the following command:

```bash
docker tag ubuntu:20.04 base_ubuntu:latest
docker tag mysql:8.0.23 base_mysql:latest
```

Then, build the whole project using the following command:

```bash
bash prepare.sh
sudo docker compose build # less verbose
# or
sudo docker compose build --progress=plain # verbose
```

The project will be built if the network reach the demand.(That means the building process will fail in most cases.)

### Build the project easily using exsiting images:

Using following commands:

```bash
cd UOJ4PPSUC # move to the root file of the project
bash prepare.sh # do some preparation
sudo docker-compose up -d # MacOS: build the project by downloading the images from Docker Hub
sudo docker compose up -d # Ubuntu: build the project by downloading the images from Docker Hub
```

We use mounted volumes to store the data of the project, so you can modify the configuration file and the frontend code in the host machine.

#### Accelerate the building process by loading the images locally

If the web connection of dockerhub is slow, loading the local images is recommended.

Firstly, download the following three images on computers with good web connection:

```text
ghcr.io/universaloj/uoj-db:latest
ghcr.io/universaloj/uoj-web:latest
ghcr.io/universaloj/uoj-judger:latest
```

For instance, you can download the images using the following docker commands:

```Bash
docker pull ghcr.io/universaloj/uoj-db:latest
docker pull ghcr.io/universaloj/uoj-web:latest
docker pull ghcr.io/universaloj/uoj-judger:latest
```

Then compress the images into a .tar file using the following commands:

```Bash
docker save -o ./uoj-db.tar ghcr.io/universaloj/uoj-db:latest
docker save -o ./uoj-web.tar ghcr.io/universaloj/uoj-web:latest
docker save -o ./uoj-judger.tar ghcr.io/universaloj/uoj-judger:latest
```

Then transfer the .tar files to the computer with slow web connection.You can use scp, ftp, or other methods.

After that, load the images using the following commands:
```Bash
docker load -i ./uoj-db.tar
docker load -i ./uoj-web.tar
docker load -i ./uoj-judger.tar
```

Then run the command of ``docker compose``.The process will be fast because the images are loaded from the local disk instead of the network.

# Management

The management configuration of PPSUC OJ (including administrator configuration, question addition and modification configuration, competition configuration, etc.) is the same as UOJ. For details, please refer to the [UOJ document](https://universaloj.github.io/post/%E9%A2%98%E7%9B%AE%E7%AE%A1%E7%90%86%E6%A6%82%E8%BF%B0.html)


# Development

Details of development of the frontend can be found in [frontend readme](web/readme.md).

Other details can be found in [Official Documentation](https://universaloj.github.io/).