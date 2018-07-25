# docker/mysql57/README.md

レプリケーション(master)のため、 [my.cnf](./etc/mysql/conf.d/my.cnf) にて、以下の値を設定している。

```smartyconfig
log-bin=/var/log/mysql/bin-log
server-id=10
```

ただし、今回のプロジェクトでは使ってない。

## 環境変数

環境変数は [.env.example](.env.example) を参考に、 `.env` として配置する。
