FROM nginx:alpine

MAINTAINER "Hokuto Asari" <hokuto.as@gmail.com>

COPY docker/nginx/etc/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

COPY docker/nginx/etc/nginx/server.key /etc/nginx/server.key
COPY docker/nginx/etc/nginx/server.csr /etc/nginx/server.csr
COPY docker/nginx/etc/nginx/server.crt /etc/nginx/server.crt
