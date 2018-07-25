# docker/phpfpm/README.md

`php:7.1.0-fpm-alpine` からの変更点など。

## /usr/local/etc/php/conf.d/php.ini の設定

`/usr/local/etc/php/conf.d/php.ini` に対して [php.ini](usr/local/etc/php/conf.d/php.ini) ファイルを設置。

## /usr/local/etc/php-fpm.d/ の各種ファイルを上書き

次の3ファイルを上書き。

- [docker.conf](usr/local/etc/php-fpm.d/docker.conf)
- [www.conf](usr/local/etc/php-fpm.d/www.conf)
- [zz-docker.conf](usr/local/etc/php-fpm.d/zz-docker.conf)

基本的には `php:7.1.0-fpm-alpine` 提供の状態と同じだが、 [www.conf](usr/local/etc/php-fpm.d/www.conf) の listen だけ socket を用いるように変更している。

```smartyconfig
; listen = 127.0.0.1:9000
listen = /var/run/php-fpm/php-fpm.sock
```

## /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini の設置

xdebug を用いたいので、 `/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini` にファイルを設置。

なお、 COPY ではなく、 echo を用いているのは、 COPY の場合 permission が root:root となってしまうため。

echo の場合は root:staff として実現される。

## /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini の設置

APC をインストールしたので、 `/usr/local/etc/php/conf.d/docker-php-ext-apcu.ini` に `apc.enable_cli = 1` を追記。

なお `extension=apcu.so` は APC インストール時に生成される `/usr/local/etc/php/conf.d/docker-php-ext-apcu.ini` に用意されている。

## 環境変数

環境変数は [.env.example](.env.example) を参考に、 `.env` として配置する。
