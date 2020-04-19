#!/bin/bash
cp /var/www/html/_serverConfig/motosoft.conf /etc/apache2/sites-available/

# Start apache
/usr/sbin/apache2 -D FOREGROUND
