FROM php:8.2-cli

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
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy all application code
COPY . .

# Create storage directories and set permissions
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

# Create database directory and SQLite file
RUN mkdir -p database && touch database/database.sqlite && chmod 777 database/database.sqlite

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Test artisan works
RUN php artisan --version

# Cache configuration
RUN php artisan config:clear && php artisan config:cache

# Expose port
EXPOSE $PORT

# Use Railway's PORT environment variable
CMD php artisan serve --host=0.0.0.0 --port=$PORT