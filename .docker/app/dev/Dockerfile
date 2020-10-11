FROM php:7.4.11-cli-alpine3.12

RUN apk add --update composer bash mysql-client
RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --no-cache shadow

WORKDIR /var/www
RUN chown -R www-data:www-data /var/www
RUN usermod -u 1000 www-data
USER www-data

EXPOSE 8081

ENTRYPOINT ["php", "-S", "0.0.0.0:8081", "public/index.php"]