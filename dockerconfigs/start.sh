#!/bin/sh
WEBAPP_ROOT="public/"

sed -i "s#^DocumentRoot \".*#DocumentRoot \"/site/$WEBAPP_ROOT\"#g" /etc/apache2/httpd.conf
sed -i "s#/var/www/localhost/htdocs#/site/$WEBAPP_ROOT#" /etc/apache2/httpd.conf
printf "\n<Directory \"/site/$WEBAPP_ROOT\">\n\tAllowOverride All\n</Directory>\n" >> /etc/apache2/httpd.conf
printf "\nServerName localhost:80\n" >> /etc/apache2/httpd.conf
chown -R apache:apache /var/www/localhost/htdocs/site

httpd -D FOREGROUND