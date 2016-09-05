FROM alpine:3.3

ENV code_root /var/www/localhost/htdocs/site

# Setup apache and php
RUN apk --update add apache2 php-apache2 php-mysql php-mcrypt php-pdo_mysql php-json \
    && rm -f /var/cache/apk/* \
    && mkdir /run/apache2 \
    && sed -i 's/#LoadModule\ rewrite_module/LoadModule\ rewrite_module/' /etc/apache2/httpd.conf \
    && mkdir -p /opt/utils
    
EXPOSE 80

ADD . $code_root

ADD dockerconfigs/start.sh /opt/utils/
RUN chmod +x /opt/utils/start.sh

ENTRYPOINT ["/opt/utils/start.sh"]