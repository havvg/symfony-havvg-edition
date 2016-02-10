FROM alpine:3.3

MAINTAINER Toni Uebernickel <tuebernickel@gmail.com>

# Install nginx & cleanup afterwards
RUN \
    apk add --update nginx && \
    rm -rf /var/cache/apk/* && \
    mkdir -p /tmp/nginx/client-body

# Put configuration in place
COPY nginx.conf /etc/nginx/
COPY symfony.conf /etc/nginx/sites-enabled/

EXPOSE 80
EXPOSE 443

CMD ["nginx"]
