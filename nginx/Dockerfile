FROM nginx:1.12.2

COPY ./nginx/default.conf.template /etc/nginx/conf.d/default.conf
COPY ./nginx/entrypoint.sh /sbin/entrypoint.sh
RUN chmod 755 /sbin/entrypoint.sh

COPY ./public /var/www/html/public

ENTRYPOINT ["/sbin/entrypoint.sh"]
CMD ["/usr/sbin/nginx"]
