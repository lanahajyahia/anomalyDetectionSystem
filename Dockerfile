FROM php:7.4-apache
RUN docker-php-ext-install mysql mysqli pdo pdo_mysql


RUN apt-get update && \
    apt-get install -y \
    sendmail

# And clean up the image

RUN rm -rf /var/lib/apt/lists/*

