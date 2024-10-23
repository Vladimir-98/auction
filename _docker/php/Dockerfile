FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      supervisor \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      libicu-dev \
      zip unzip \
      git \
      nano && \
      docker-php-ext-configure intl && \
      docker-php-ext-install intl && \
      docker-php-ext-install pdo_mysql bcmath gd zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN mkdir -p /var/log/supervisor

COPY php.ini /usr/local/etc/php/php.ini

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www/auction

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

