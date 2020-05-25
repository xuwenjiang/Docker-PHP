FROM php:7.1-fpm
USER root
WORKDIR /var/www
# install vim and git
RUN apt-get upgrade -y \
    && apt-get update \
    && apt-get install -y vim git zlib1g-dev

#install other tools 
RUN apt-get install libzip-dev -y

# install composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# install php extension
RUN docker-php-ext-install zip

# XDebug
RUN pecl install -f xdebug-2.5.5
RUN docker-php-ext-enable xdebug
ADD debug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
