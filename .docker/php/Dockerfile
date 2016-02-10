FROM alpine:3.3

MAINTAINER Toni Uebernickel <tuebernickel@gmail.com>

# Install nginx & cleanup afterwards
RUN apk add --update \
    php-apcu \
    php-bcmath \
    php-bz2 \
    php-cli \
    php-ctype \
    php-curl \
    php-dom \
    php-fpm \
    php-gettext \
    php-iconv \
    php-intl \
    php-json \
    php-mcrypt \
    php-memcache \
    # php-memcached \
    php-mysql \
    php-openssl \
    php-pcntl \
    php-pdo \
    php-pdo_mysql \
    php-pdo_sqlite \
    php-phar \
    php-phpdbg \
    php-posix \
    php-soap \
    php-zlib \
    php-zip \
    && rm -rf /var/cache/apk/* \
    && rm /etc/php/php.ini

COPY php.ini /etc/php/php.ini
COPY php-fpm.conf /etc/php/php-fpm.conf

EXPOSE 9000

CMD ["php-fpm"]
