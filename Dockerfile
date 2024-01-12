FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
        librabbitmq-dev autoconf pkg-config libssl-dev libzip-dev git gcc make autoconf libc-dev vim unzip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath sockets zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
RUN git config --global user.email "davidcova88@gmail.com" \
    && git config --global user.name "DavidCova"

WORKDIR /app

CMD ["symfony", "server:start", "--port=8000"]