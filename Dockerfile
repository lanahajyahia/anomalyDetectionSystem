FROM php:7.4-apache
RUN docker-php-ext-install mysqli
# RUN docker-php-ext-install zip

# RUN apt-get install -q -y ssmtp mailutils

# # root is the person who gets all mail for userids < 1000
# RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf

# # Here is the gmail configuration (or change it to your private smtp server)
# RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
# RUN echo "AuthUser=anomalydetectionregister@gmail.com" >> /etc/ssmtp/ssmtp.conf
# RUN echo "AuthPass='Lana230212!'" >> /etc/ssmtp/ssmtp.conf

# RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
# RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf
# RUN echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf


# # Set up php sendmail config
# RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
# RUN echo "localhost localhost.localdomain" >> /etc/hosts

