FROM yiisoftware/yii2-php:8.1-fpm-nginx

RUN groupadd --gid 1000 yii2 && useradd --uid 1000 --gid 1000 --create-home yii2 && chown -R yii2:yii2 /home/yii2/

COPY web/nginx/localhost.conf /etc/nginx/conf.d/

COPY web/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html
