FROM php:8.1-fpm

# Set sebagai working directory
WORKDIR /var/www

# Copy composer.lock dan composer.json ke /var/www
COPY composer.lock composer.json /var/www/

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \  
    cron \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Hapus cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer using multi-stage build (reduces final image size)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . .

# Set correct permissions for Laravel
RUN mkdir -p storage/framework/sessions
RUN mkdir -p storage/framework/views
RUN mkdir -p storage/framework/cache
RUN chmod -R 777 storage
RUN chown -R www-data:www-data /var/www

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]