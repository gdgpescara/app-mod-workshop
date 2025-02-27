
# Use the official PHP image: https://hub.docker.com/_/php
FROM php:5.6-apache

# Configure PHP for Cloud Run.
# Precompile PHP code with opcache.
# Install PHP's extension for MySQL
RUN docker-php-ext-install -j "$(nproc)" opcache mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN set -ex; \
  { \
    echo "; Cloud Run enforces memory & timeouts"; \
    echo "memory_limit = -1"; \
    echo "max_execution_time = 0"; \
    echo "; File upload at Cloud Run network limit"; \
    echo "upload_max_filesize = 32M"; \
    echo "post_max_size = 32M"; \
    echo "; Configure Opcache for Containers"; \
    echo "opcache.enable = On"; \
    echo "opcache.validate_timestamps = Off"; \
    echo "; Configure Opcache Memory (Application-specific)"; \
    echo "opcache.memory_consumption = 32"; \
  } > "$PHP_INI_DIR/conf.d/cloud-run.ini"

# Copy in custom code from the host machine.
WORKDIR /var/www/html

COPY . .

# Setup the PORT environment variable in Apache configuration files: https://cloud.google.com/run/docs/reference/container-contract#port
ENV PORT=8080

# Tell Apache to use 8080 instead of 80.
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Note: This is quite insecure and opens security breaches. See last chapter for hardening ideas.
# Uncomment at your own risk:
#RUN chmod 777 /var/www/html/uploads/

# Configure PHP for development.
# Switch to the production php.ini for production operations.
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# https://github.com/docker-library/docs/blob/master/php/README.md#configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Expose the port
EXPOSE 8080