FROM php:8.1 as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

WORKDIR /var/www
COPY . .


COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000

# RUN chmod +x Docker/entrypoint.sh
# ENTRYPOINT [ "docker/entrypoint.sh" ]
# Copy wait-for-it.sh into the image
COPY Docker/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod +x /usr/local/bin/wait-for-it
# RUN chmod +x Docker/wait-for-it.sh
ENTRYPOINT ["wait-for-it", "database:3308", "--timeout=30", "--", "docker/entrypoint.sh"]
