FROM php:8.3.0-fpm

# Install packages
RUN apt update && apt-get -y install curl autoconf bash libsmbclient-dev smbclient
RUN pecl install smbclient && docker-php-ext-enable smbclient

# Xdebug
#ARG INSTALL_XDEBUG=false
#RUN if [ ${INSTALL_XDEBUG} = true ]; \
#    then \
#      pecl install xdebug && docker-php-ext-enable xdebug; \
#    fi;

#COPY ./docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

## Kafka
#ARG INSTALL_KAFKA=false
#ARG LIBRDKAFKA_VERSION
#RUN if [ ${INSTALL_KAFKA} = true ]; \
#    then \
#      git clone --depth 1 --branch v$LIBRDKAFKA_VERSION https://github.com/edenhill/librdkafka.git \
#      && cd librdkafka \
#      && ./configure \
#      && make \
#      && make install \
#      && pecl install rdkafka && docker-php-ext-enable rdkafka \
#      && echo "extension=rdkafka.so" > /usr/local/etc/php/conf.d/rdkafka.ini; \
#    fi;

# Configure non-root user.
ARG PUID=1000
ARG PGID=1000
RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Source code
RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www
WORKDIR /var/www

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN #composer install --no-interaction

CMD php-fpm

EXPOSE 9000