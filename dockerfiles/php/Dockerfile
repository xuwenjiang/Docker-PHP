FROM php:7.4-fpm
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

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
