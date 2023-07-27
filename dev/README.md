# Use Docker Compose to develop lineblocs

## Structure of directory
```shell
.
├── app
├── bitbucket-pipelines.yml
├── composer.json
├── composer.lock
├── dev
│   ├── docker-compose.yaml
│   ├── mysql
│   └── README.md
└── docs


```

## Simple running
```shell
$ git clone git@github.com:Lineblocs/site.git
$ cd site/app/
$ cp .env.docker .env
$ cp -R vendoring vendor
$ cd ..
$ cd dev
$ cp .env.example .env
$ docker compose build --no-cache
$ docker compose --profile enable_mysql --profile enable_proxy up -d
```
 Open web browser 
`http://127.0.0.1:22023`   -> `site lineblocs`
`http://127.0.0.1:22024`   -> `phpmyadmin`


## Advance running

### Clone lineblocs site project
Clone  lineblocs site project from repository.
```shell
$ git clone git@github.com:Lineblocs/site.git
```

### Confige Lineblocs site project
Go to site/app directory. Create `.env` file. Create `vendor` directory with copy `vendoring` directory.

```shell
$ cd site/app/
$ cp .env.docker .env
$ cp -R vendoring vendor
```

### Move to docker compose
Clone docker compose and move to directory.
```shell
$ cd ..
$ cd dev
```

### Make .env file and confige
```shell
$ cp .env.example .env
```

`DB_HOST` -> is host of database. While using mysql on container. Set this value to name of container service.
`DB_USERNAME` -> username of database
`DB_PASSWORD` -> password of database user.
`DB_ROOT_PASSWORD` -> password of root user
`DB_DATABASE` -> database name
`DB_PORT` -> database port on mysql container
`DB_OPENSIPS_DATABASE` -> opensips database name
`DEPLOYMENT_DOMAIN` -> base domain 

While want to access website with `DEPLOYMENT_DOMAIN`, after set `DEPLOYMENT_DOMAIN`. Don't forget tp change hosts file local machine. On linux file exists at /etc/hosts. On windows file exist at c:\Windows\System32\Drivers\etc\hosts. Add `127.0.0.1` -> `DEPLOYMENT_DOMAIN`  ;  `127.0.0.1` -> `dbeditor.DEPLOYMENT_DOMAIN`

`MYSQL_PORT_HOST` -> Port of host mapping to mysql container on 3306
`SITE_PORT_HOST` -> Port of host mapping to site container on 8080
`PHPMYADMIN_PORT_HOST` -> Port of host mapping to phpmyadmin container on 80


### Build docker image and create container
Build docker image with this command
```shell
$ docker compose build --no-cache
```

Create and run container with this command below. 
`--profile enable_mysql` use for create mysql container. Remove `--profile enable_mysql` while using mysqldb outside container. 
`--profile enable_proxy` use for create nginx as proxy. Remove `--profile enable_proxy` while won't create nginx as proxy. While use nginx as proxy, must confige local hosts with DEPLOYMENT_DOMAIN. 

```shell
$ docker compose --profile enable_mysql --profile enable_proxy up -d
```

### Access lineblocs
Lineblocs-site -> http://127.0.0.1:{MYSQL_PORT_HOST} or http://{DEPLOYMENT_DOMAIN} `--enable_proxy` must use
Lineblocs-phpmyadmin -> -> http://127.0.0.1:{PHPMYADMIN_PORT_HOST} or http://{DEPLOYMENT_DOMAIN} `--enable_proxy` must use
Please remember use http, because on docker compose confige disable https.

### Useful command
Running `composer`  -> `docker exec -it lineblocs-site composer update -vvv`
Running `artisan` -> `docker exec -it lineblocs-site php artisan`
Log in to terminal of container  -> `docker exec -it lineblocs-site bash`
Modify lineblocs-site project under `site/app`


