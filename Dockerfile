FROM php:7.4-apache
LABEL maintainer="dev@chialab.io"

# Download script to install PHP extensions and dependencies
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

RUN DEBIAN_FRONTEND=noninteractive apt-get update -q \
    && DEBIAN_FRONTEND=noninteractive apt-get install -qq -y \
    curl \
    git \
    zip unzip \
    && install-php-extensions \
    bcmath \
    bz2 \
    calendar \
    exif \
    gd \
    intl \
    ldap \
    memcached \
    mysqli \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    redis \
    soap \
    xsl \
    zip \
    sockets \
    pdo_sqlsrv \
    sqlsrv \
    # already installed:
    #      iconv \
    #      mbstring \
    && a2enmod rewrite

# Install Composer.
ENV PATH=$PATH:/root/composer2/vendor/bin:/root/composer1/vendor/bin \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/root/composer2 \
    COMPOSER1_HOME=/root/composer1
RUN cd /opt \
    # Download installer and check for its integrity.
    && curl -sSL https://getcomposer.org/installer > composer-setup.php \
    && curl -sSL https://composer.github.io/installer.sha384sum > composer-setup.sha384sum \
    && sha384sum --check composer-setup.sha384sum \
    # Install Composer 2 and expose `composer` as a symlink to it.
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer2 --2 \
    && ln -s /usr/local/bin/composer2 /usr/local/bin/composer \
    # Install Composer 1, make it point to a different `$COMPOSER_HOME` directory than Composer 2, install `hirak/prestissimo` plugin.
    && php composer-setup.php --install-dir=/usr/local/bin --filename=.composer1 --1 \
    && printf "#!/bin/sh\nCOMPOSER_HOME=\$COMPOSER1_HOME\nexec /usr/local/bin/.composer1 \$@" > /usr/local/bin/composer1 \
    && chmod 755 /usr/local/bin/composer1 \
    && composer1 global require hirak/prestissimo \
    # Remove installer files.
    && rm /opt/composer-setup.php /opt/composer-setup.sha384sum

# RUN apt-get update && \
#     apt-get install -y ssmtp && \
#     apt-get clean && \
#     echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf && \
#     echo 'sendmail_path = "/usr/sbin/ssmtp -t"' > /usr/local/etc/php/conf.d/mail.ini

# RUN apt-get update && \
#     apt-get install -y \
#     zlib1g-dev libzip-dev sendmail



# RUN echo "sendmail_path=/usr/sbin/sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini 


# RUN docker-php-ext-install zip


# RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint

# RUN sed -i '/#!\/bin\/sh/aecho "$(hostname -i)\t$(hostname) $(hostname).localhost" >> /etc/hosts' /usr/local/bin/docker-php-entrypoint



# # And clean up the image

# RUN rm -rf /var/lib/apt/lists/*



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
