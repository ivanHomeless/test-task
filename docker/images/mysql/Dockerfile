FROM mariadb:latest
RUN apt-get update && apt-get install -y \
    && groupadd dev -g 1001 \
    && usermod -aG dev mysql \
    && usermod -aG dev www-data
