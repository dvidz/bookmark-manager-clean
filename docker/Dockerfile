FROM php:8.1-alpine3.14
WORKDIR /app

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install -j$(nproc) pdo_mysql


#EXPOSE 8000

CMD ["./entrypoint.sh"]
