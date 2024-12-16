FROM php:8.2-fpm

# Installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Nettoyage
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
