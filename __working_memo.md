

# 簡易的なサーバーの起動方法

1. Docker Composer up する: docker-compose build && docker-compose up
2. up した Container に入る: docker-compose exec workspace sh
3. 入った Container で組み込みの php server を起動: php artisan serve --port=80 --host 0.0.0.0