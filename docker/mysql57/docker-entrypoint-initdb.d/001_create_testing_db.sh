#!/bin/sh

## 以下のように、 sh の環境変数を用いて実行したい(特に $MYSQL_USER の場所)が、実現できていない, 原因は探査中。

# mysql -u root -p $MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS app_testing ;"
# mysql -u root -p $MYSQL_ROOT_PASSWORD -e "GRANT ALL ON \`app_testing\`.* TO "$MYSQL_USER"@'%' ;"
# mysql -u root -p $MYSQL_ROOT_PASSWORD -e 'FLUSH PRIVILEGES ;'
