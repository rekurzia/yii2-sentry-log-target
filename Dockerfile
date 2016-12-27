FROM php:7.0

RUN apt-get update -q \
  && apt-get install unzip git libmcrypt-dev --no-install-recommends -y

RUN docker-php-ext-install mcrypt

WORKDIR /root

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer

RUN mkdir -p /code
WORKDIR /code
