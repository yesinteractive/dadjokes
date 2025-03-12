FROM alpine:3.16
LABEL maintainer="YesInteractive- http://yes-interactive.com"

# Install modules and updates
RUN apk update \
    && apk --no-cache add \
        openssl \
        apache2 \
        apache2-ssl \
        unzip \
    # Install PHP from community
    && apk --no-cache add \
        php7 \
        php7-apache2 \
        php7-common \
        php7-ctype \
        php7-curl \
        php7-json \
        php7-mbstring \
        php7-session \
        php7-sockets \
        php7-opcache \
        php7-openssl \
    && rm /var/cache/apk/* \
    # Run required config / setup for apache
    && mkdir -p /run/apache2 \
    # Fix group
    && sed -i -e 's/Group apache/Group www-data/g' /etc/apache2/httpd.conf \
    # Enable modules
    && sed -i -e 's/#LoadModule rewrite_module modules\/mod_rewrite.so/LoadModule rewrite_module modules\/mod_rewrite.so/g' /etc/apache2/httpd.conf \
    # Change document root to /app
    && mkdir /app && chown -R apache:apache /app \
    && sed -i -e 's/\/var\/www\/localhost\/htdocs/\/app/g' /etc/apache2/httpd.conf \
    && sed -i -e 's/\/var\/www\/localhost\/htdocs/\/app/g' /etc/apache2/conf.d/ssl.conf \
    # Change default ports
    && sed -i -e 's/Listen 80/Listen 8100/g' /etc/apache2/httpd.conf \
    && sed -i -e 's/443/8143/g' /etc/apache2/conf.d/ssl.conf \
    # Allow for custom apache configs
    && mkdir /etc/apache2/conf.d/custom \
    && echo '' >> /etc/apache2/httpd.conf \
    && echo 'IncludeOptional /etc/apache2/conf.d/custom/*.conf' >> /etc/apache2/httpd.conf \
    # Fix modules
    && sed -i 's#AllowOverride None#AllowOverride All#' /etc/apache2/httpd.conf \
    # Empty /var/www and add an index.php to show phpinfo()
    && rm -rf /var/www/* \
    && echo '<?php phpinfo(); ?>' > /app/phpinfo.php \
    && wget https://github.com/yesinteractive/dad-jokes_microservice/archive/master.zip -P /app \
    && unzip /app/master.zip -d /app \
    && rm -rf /app/master.zip \
    && cp -r /app/dad-jokes_microservice-master/. /app \
    && rm -rf /app/dad-jokes_microservice-master

WORKDIR /app

# Export http and https
EXPOSE 8100 8143

# Run apache in foreground
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]