FROM mysql:latest

MAINTAINER me

ENV MYSQL_DATABASE=demo \
    MYSQL_ROOT_PASSWORD=root \
    MYSQL_USER=root \
    MYSQL_PASSWORD=root

ADD demo_user.sql /docker-entrypoint-initdb.d

EXPOSE 3306