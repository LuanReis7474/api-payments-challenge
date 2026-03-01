# ---------------------------------------------------
# Definição de configuração para ambiente docker de execução do projeto
# ---------------------------------------------------

FROM php:8.2-apache 

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql zip


RUN a2enmod rewrite


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY . /var/www/html
WORKDIR /var/www/html


ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs


RUN npm install
RUN npm run build


ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN chown -R www-data:www-data storage bootstrap/cache public/build

EXPOSE 80