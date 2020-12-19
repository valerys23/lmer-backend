# La Madeleine en Route backend service

![La Madeleine en Route](./assets/logo.png "La Madeleine en Route")

---

> This repository contains the La Madeleine en Route backend service

## Prerequisites

This project requires a MacOS, Windows (including WSL) or Linux machine.

It requires [Docker](https://www.docker.com/) (at least version 20) and [docker-compose](https://docs.docker.com/compose/) (at least version 1.27)
Make sure you have it available on your machine by running the following commands:

```shell
$ docker --version
Docker version 20.10.0, build #######

$ docker-compose --version
docker-compose version 1.27.4, build #######
```

## Table of contents

- [La Madeleine en Route backend service](#la-madeleine-en-route-backend-service)
  - [Prerequisites](#prerequisites)
  - [Table of contents](#table-of-contents)
  - [Getting Started](#getting-started)
    - [Start the containers](#start-the-containers)
    - [PHPMyAdmin login](#phpmyadmin-login)
  - [Scripts](#scripts)
    - [Export a MySQL dump file](#export-a-mysql-dump-file)
  - [Contributing](#contributing)
  - [Built With](#built-with)
  - [Versioning](#versioning)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.


### Start the containers

La Madeleine en Route backend service consist of a Wordpress instance (used as a headless CMS), a MySQL database and a PHPMyAdmin instance running from docker containers.

To run all the containers type:

```shell
$ docker-compose up -d
```

Wordpress will run at: [http://localhost:8000](http://localhost:8000).

PHPMyAdmin will run at: [http://localhost:8080](http://localhost:8080).

### PHPMyAdmin login

The registered Wordpress credentials for the `la_madeleine` user are:

```
username: la_madeleine
password: password
```

## Scripts

### Export a MySQL dump file

To export a dump of the current database, run the `db-eject.sh` script:

```bash
$ ./scripts/db-eject.sh
```

it will create a new dump file, named as the current date and time, in the `mysql-dumps` folder.

## Contributing

1.  Create your feature branch: `git checkout -b feature/my-new-feature`
2.  Add your changes: `git add .`
3.  Commit your changes: `git commit -am 'Add some feature'`
4.  Push to the branch: `git push origin feature/my-new-feature`
5.  Submit a pull request

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct.

## Built With

* [Wordpress](https://wordpress.com/) - Open Source CMS
* [MySQL](https://www.mysql.com/) - The world's most popular open source database
* [PHPMyAdmin](https://www.phpmyadmin.net/) - handles the administration of MySQL over the Web

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags).
