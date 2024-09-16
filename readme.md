# Online Judge of PPSUC

<p align="center">
  <img src="./CyberSwat.png" alt="CyberSwat" style="display: block; margin: auto; width: 50%;">
</p>


**The source code of Online Judge system of PPSUC, focusing on the training of programming skills.**

- Support mutiple languages, including **C/C++**, **Java**, **Python**.
- Support not only **Chinese** and **English**, but also other languages including **Russian**, **Spanish**, **French**, **German** and **Portuguese**.
- Using [Universal Online Judge](https://universaloj.github.io/) as the core.
- Organized with [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/).
- Developed with PHP, Python, C/C++, MySQL, and other technologies.
- Technical supported by Cyber SWAT Team of PPSUC.

## Usage

1. Build the project from the source code:

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

2. Build the project easily using exsiting images:

Using following commands:

```bash
cd UOJ-System # move to the root file of the project
bash prepare.sh # do some preparation
sudo docker-compose up -d # build the project by downloading the images from Docker Hub
```

We use mounted volumes to store the data of the project, so you can modify the configuration file and the frontend code in the host machine.

# Development

