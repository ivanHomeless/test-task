FROM nginx:latest
COPY nginx.conf /etc/nginx/nginx.conf

WORKDIR /usr/share/nginx/test

RUN apt-get update && apt-get install -y \
    && groupadd dev -g 1001 \
    && usermod -aG dev www-data \
    && usermod -aG dev nginx
