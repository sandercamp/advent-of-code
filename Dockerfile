FROM php:8.3-cli

RUN apt-get update -qq && apt-get install -y libgmp-dev && docker-php-ext-install gmp