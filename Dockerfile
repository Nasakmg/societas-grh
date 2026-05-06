FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    sqlite3 \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo_sqlite

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Créer le dossier database et le fichier SQLite s'ils n'existent pas
RUN mkdir -p /opt/render/project/src/database && \
    touch /opt/render/project/src/database/database.sqlite && \
    chmod 777 /opt/render/project/src/database /opt/render/project/src/database/database.sqlite

RUN composer install --no-dev --optimize-autoloader

# Copier le fichier .env.example si .env n'existe pas
RUN if [ ! -f .env ]; then cp .env.example .env; fi

RUN php artisan key:generate --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configuration Apache
RUN a2dissite 000-default.conf
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options -Indexes +FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]