FROM php:7.3.0-apache
SHELL ["/bin/bash", "-c"]

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl
RUN apt-get install -y libmcrypt-dev && \
    pecl install mcrypt-1.0.2 && \
    docker-php-ext-enable mcrypt

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN rm -rf /etc/apt/preferences.d/no-debian-php \
  && apt-get update -y \
  && apt-get install -y \
    libxml2-dev \
    php-soap \
  && apt-get clean -y \
  && docker-php-ext-install soap	

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install bcmath

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www

RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod expires
RUN a2enmod filter
RUN a2enmod deflate

# Copy existing application directory contents
COPY . /var/www/html
COPY apache.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# copy php.ini
RUN mv php.ini "$PHP_INI_DIR/php.ini"
RUN mv .env.cop .env

# Change current user to www
# Expose port 9000 and start php-fpm server

#RUN php -d memory_limit=-1 /usr/local/bin/composer install --no-scripts
RUN mv vendoring vendor
#RUN php artisan key:generate
#RUN php artisan migrate

# Copy existing application directory permissions
#RUN chown -R www-data:www-data /var/www/html
RUN ./deploy-docker.sh

# Change current user to www
# Expose port 9000 and start php-fpm server
COPY ports.conf /etc/apache2/ports.conf
RUN chown -R www-data www-data ./public/assets
EXPOSE 8080
#CMD [ "apache2-foreground" ]
ENTRYPOINT ["./entrypoint.sh"]
