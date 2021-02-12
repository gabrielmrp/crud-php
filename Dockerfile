FROM php:7.4-apache

RUN docker-php-ext-install mysqli

COPY . /var/www/html

WORKDIR /var/www/html

RUN a2enmod rewrite \
	&& service apache2 restart \
	&& apt-get update -y  

EXPOSE 80

 
