FROM php:7.4-apache
RUN docker-php-ext-install mysqli



RUN apt-get update && \
    apt-get install -y \
    zlib1g-dev libzip-dev sendmail



RUN echo "sendmail_path=/usr/sbin/sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini 


RUN docker-php-ext-install zip


RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint

RUN sed -i '/#!\/bin\/sh/aecho "$(hostname -i)\t$(hostname) $(hostname).localhost" >> /etc/hosts' /usr/local/bin/docker-php-entrypoint



# And clean up the image

RUN rm -rf /var/lib/apt/lists/*



# # Load extra Apache modules
# RUN a2enmod rewrite

# # Installs sendmail
# RUN apt-get update && apt-get install -q -y ssmtp mailutils && rm -rf /var/lib/apt/lists/*

# # Installs php modules
# RUN docker-php-ext-install mysql mysqli pdo pdo_mysql

# # set up sendmail config, see http://linux.die.net/man/5/ssmtp.conf for options
# RUN echo "hostname=localhost.localdomain" > /etc/ssmtp/ssmtp.conf
# RUN echo "root=c.maessen@realskeptic.com" >> /etc/ssmtp/ssmtp.conf
# RUN echo "mailhub=maildev" >> /etc/ssmtp/ssmtp.conf
# # The above 'maildev' is the name you used for the link command
# # in your docker-compose file or docker link command.
# # Docker automatically adds that name in the hosts file
# # of the container you're linking MailDev to.

# # Set up php sendmail config
# RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

# # Fully qualified domain name configuration for sendmail on localhost.
# # Without this sendmail will not work.
# # This must match the value for 'hostname' field that you set in ssmtp.conf.
# RUN echo "localhost localhost.localdomain" >> /etc/hosts
