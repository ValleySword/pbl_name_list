FROM php:8.3.17-apache

# mod_rewrite を有効化（HTTPS用）
RUN a2enmod rewrite

# mod_ssl を有効化（HTTPS用）
RUN a2enmod ssl

# MySQLに接続するためのパッケージをインストールする
RUN apt update \
  && docker-php-ext-install pdo_mysql

COPY php.ini /usr/local/etc/php/
