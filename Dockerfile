FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
        librabbitmq-dev autoconf pkg-config libssl-dev libzip-dev git gcc make autoconf libc-dev vim unzip libpq-dev libicu-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure zip && \
    docker-php-ext-install -j$(nproc) zip pdo_pgsql intl bcmath sockets

# Install and enable the amqp extension
RUN pecl install amqp && \
    docker-php-ext-enable amqp

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug


RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
RUN git config --global user.email "davidcova88@gmail.com" \
    && git config --global user.name "DavidCova"

WORKDIR /app

COPY . .

ENTRYPOINT ["/app/docker-entrypoint.sh"]