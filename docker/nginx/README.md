# docker/nginx/README.md

`nginx:alpine` からの変更点など。

取り敢えず以下の diff を参照のこと。

SSL 化したので、細かいところは適宜読み替えて。

## /etc/nginx/nginx.conf の diff

```diff

user nginx;
+ # worker_processes  1;
+ worker_processes 4;

+ # error_log  /var/log/nginx/error.log warn;
+ error_log /dev/stdout warn;
pid /run/nginx.pid;

events {
    worker_connections 1024;
}

http {
+    upstream phpfpm_backend {
+        server fpm:9000;
+    }

    include       /etc/nginx/mime.types;
    default_type  application/octet-stream;

    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';

+     # access_log  /var/log/nginx/access.log  main;
+     access_log /dev/stdout main;

+     server_tokens off;

    sendfile on;
+     #tcp_nopush     on;
+     tcp_nopush on;
+     tcp_nodelay on;
+     keepalive_timeout 65;

    #gzip  on;
+     gzip on;
+     gzip_disable "msie6";
+     gzip_types  text/css text/javascript image/jpeg image/png image/gif image/x-icon image/x-ms-bmp image/svg+xml image/webp application/font-woff application/json application/javascript;

    include /etc/nginx/conf.d/*.conf;
}
```

## /etc/nginx/conf.d/default.conf の diff

```diff
server {
+    client_max_body_size 20M;
    listen       80;
    server_name  localhost;

    #charset koi8-r;
    #access_log  /var/log/nginx/log/host.access.log  main;

+    root   /myapp/public;
+    index index.php index.html index.htm;

    location / {
+        # root   /usr/share/nginx/html;
+        # index  index.html index.htm;
+        try_files $uri $uri/ /index.html /index.php?$query_string;
    }

    #error_page  404              /404.html;

    # redirect server error pages to the static page /50x.html
    #
    error_page   500 502 503 504  /50x.html;
    location = /50x.html {
        root   /usr/share/nginx/html;
    }

    # proxy the PHP scripts to Apache listening on 127.0.0.1:80
    #
    #location ~ \.php$ {
    #    proxy_pass   http://127.0.0.1;
    #}

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    #location ~ \.php$ {
    #    root           html;
    #    fastcgi_pass   127.0.0.1:9000;
    #    fastcgi_index  index.php;
    #    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
    #    include        fastcgi_params;
    #}
+    location ~ \.php$ {
+        include fastcgi_params;
+        fastcgi_pass phpfpm_backend;
+        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
+    }

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    #location ~ /\.ht {
    #    deny  all;
    #}
+    location ~ /\.ht {
+        deny  all;
+    }
+
+    location /favicon {
+        empty_gif;
+        access_log    off;
+        log_not_found off;
+    }
}
```
