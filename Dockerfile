# Используем официальный образ PHP
FROM php:8.1-cli

# Устанавливаем необходимые расширения PHP (при необходимости)
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Указываем рабочую директорию
WORKDIR /var/www/html

# Копируем текущую директорию в контейнер
COPY . .

