#!/bin/sh
sed -i "s/NGINX_LISTEN/${NGINX_LISTEN}/" /etc/nginx/conf.d/default.conf
sed -i "s/FCGI_SERVER/${FCGI_SERVER}/" /etc/nginx/conf.d/default.conf
sed -i "s/FCGI_PORT/${FCGI_PORT}/" /etc/nginx/conf.d/default.conf
nginx -g 'daemon off;'
