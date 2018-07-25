FROM mysql:5.7

MAINTAINER "Hokuto Asari" <hokuto.as@gmail.com>

COPY docker/mysql57/etc/mysql/conf.d/my.cnf /etc/mysql/conf.d/my.cnf

ADD "docker/mysql57/docker-entrypoint-initdb.d/001_create_testing_db.sql" "/docker-entrypoint-initdb.d"

RUN apt-get update -y
