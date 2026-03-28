FROM php:8.3-apache

# Install PHP extensions WordPress requires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libexif-dev \
    libintl-perl \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        zip \
        exif \
        intl \
        opcache \
    && apt-get clean

# Enable Apache mod_rewrite (required for WordPress permalinks)
RUN a2enmod rewrite

# THIS is the critical part — point Apache at Bedrock's /web folder
# not the project root
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/web\n\
    <Directory /var/www/html/web>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html