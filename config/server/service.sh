#!/bin/bash
sudo yum install certbot
sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
sudo mkdir -p /var/lib/letsencrypt/.well-known
sudo chgrp nginx /var/lib/letsencrypt
sudo chmod g+s /var/lib/letsencrypt
sudo mkdir /usr/local/nginx/snippets
sudo cp files/snippets/letsencrypt.conf /usr/local/nginx/snippets
sudo cp files/snippets/ssl.conf /usr/local/nginx/snippets
sudo cp -fr files/usr/local/nginx/conf/nginx.conf /usr/local/nginx/conf
sudo cp -fr files/usr/local/nginx/conf/conf.d/virtual.conf /usr/local/nginx/conf/conf.d
sudo curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer