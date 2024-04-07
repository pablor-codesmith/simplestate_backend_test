FROM alpine:3.18 as libfaketime
RUN set -eux ; \
    apk -U add build-base git ; \
    git clone https://github.com/wolfcw/libfaketime /libfaketime ; \
    cd /libfaketime ; \
    git checkout v0.9.10
WORKDIR /libfaketime
RUN set -eux ; \
    make ; \
    make install

# Library is in
# - /usr/local/lib/faketime/libfaketimeMT.so.1
# - /usr/local/lib/faketime/libfaketime.so.1

FROM php:8.2-fpm-alpine as builder
ENV COMPOSER_HOME=/tmp/composer \
    COMPOSER_NO_INTERACTION=1 \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HTACCESS_PROTECT=0

RUN set -eux ; \
  apk --update --no-cache add \
    curl \
    fcgi \
    git ; \
  apk add --no-cache --virtual .build-dependencies \
        autoconf cmake file g++ gcc libc-dev pcre-dev make pkgconf re2c dpkg-dev dpkg \
        freetype-dev libpng-dev libjpeg-turbo-dev icu-dev libxslt-dev libzip-dev ; \
  apk add --no-cache \
    mysql-client \
    msmtp \
    tzdata \
    procps \
    shadow \
    libzip \
    libpng \
    libxslt \
    libjpeg-turbo \
    libwebp \
    freetype \
    icu-libs \
    zip \
    icu ; \
  docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ ; \
  docker-php-ext-install \
    pdo_mysql \
    mysqli \
    gd \
    bcmath \
    zip \
    exif ; \
  curl -sSLf -o /usr/local/bin/php-fpm-healthcheck https://raw.githubusercontent.com/renatomefi/php-fpm-healthcheck/master/php-fpm-healthcheck ; \
  chmod +x /usr/local/bin/php-fpm-healthcheck ; \
  apk del .build-dependencies

COPY --from=libfaketime /usr/local/lib/faketime/libfaketimeMT.so.1 /faketime.so
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ENV APP_HOME /var/www/html
WORKDIR $APP_HOME
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --no-progress
COPY --chown=www-data:www-data . $APP_HOME
RUN set -eux ; \
    mv docker/prod/php-custom.ini /usr/local/etc/php/conf.d/99-php-custom.ini ; \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini ; \
    mv docker/prod/php-fpm.conf /usr/local/etc/php-fpm.d/zz-fpm.conf ; \
    echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/zz-docker.conf ; \
    rm -rf docker ; \
    composer dump-autoload --optimize ; \
    composer run-script post-root-package-install ; \
    composer run-script post-update-cmd ; \
    chown -R root:root $APP_HOME ; \
    rm $APP_HOME/.env

ARG GIT_COMMIT
ENV GIT_COMMIT=$GIT_COMMIT

FROM builder as backend
RUN chown -R www-data:www-data $APP_HOME

FROM nginx:alpine AS nginx
WORKDIR /var/www/html
COPY --chown=root:root docker/prod/nginx.conf /etc/nginx/nginx.conf
COPY --from=builder --chown=nginx:nginx /var/www/html/public /var/www/html/public
