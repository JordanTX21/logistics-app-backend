FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first (better layer caching)
COPY composer.json composer.lock ./

# Install dependencies with timeout disabled and platform requirements ignored
RUN composer install \
    --no-interaction \
    --no-scripts \
    --no-autoloader \
    --no-progress \
    --ignore-platform-reqs \
    --optimize-autoloader

# Copy entire application
COPY . .

# Recreate autoloader
RUN composer dump-autoload --no-scripts --optimize

# Set permissions
RUN chmod +x docker/scripts/*.sh 2>/dev/null || true

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
