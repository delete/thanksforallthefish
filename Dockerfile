FROM alpine:3.3

Maintainer Geshan Manandhar <geshan@gmail.com>

RUN apk --update add curl php php-curl php-openssl php-json php-phar php-dom php-mysqli && rm /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

# Goto temporary directory.
WORKDIR /tmp

# Run composer and phpunit installation.
RUN composer selfupdate && \
  composer require "phpunit/phpunit:~5.5.0" && \
  ln -s /tmp/vendor/bin/phpunit /usr/local/bin/phpunit

# Set up the application directory.
VOLUME ["/app"]
WORKDIR /app

# Set up the command arguments.
ENTRYPOINT ["/usr/local/bin/phpunit"]
CMD ["--help"]