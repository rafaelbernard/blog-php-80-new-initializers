FROM php:8.1

RUN apt-get update \
    && apt-get install -y \
        wget unzip \
    && rm -rf /var/lib/apt/lists/*

RUN wget https://getcomposer.org/installer \
    && php ./installer \
    && rm installer \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /app

COPY composer.json composer.lock /app

COPY . .

CMD ["/bin/bash"]
