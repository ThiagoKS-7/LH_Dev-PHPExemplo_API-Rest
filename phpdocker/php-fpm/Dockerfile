FROM php:7.2.2-fpm
WORKDIR "/dva"

RUN apt-get update \
    && apt-get upgrade -y \
    && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -yy \
        curl \
        pkg-config \
        libssl-dev \
        libcurl4-gnutls-dev \
        libxml2-dev \
        libicu-dev \
        libmcrypt-dev \
    && apt-get clean -yy

RUN docker-php-ext-install \
        opcache \
        mbstring \
        pdo_mysql \
        pcntl \
        soap

# Stomp
#RUN curl https://pecl.php.net/get/stomp-2.0.2 -o /tmp/stomp-2.0.2.tar.gz \
#    && tar xzf /tmp/stomp-2.0.2.tar.gz -C /tmp \
#    && cd /tmp/stomp-2.0.2 \
#    && export PHP_OPENSSL=yes \
#    && phpize \
#    && ./configure --with-openssl \
#    && make \
#    && make install \
#    && docker-php-ext-enable stomp \
#    && rm -rf /tmp/stomp-2.0.2.tar.gz /tmp/stomp-2.0.2

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear

RUN docker-php-ext-enable redis

EXPOSE 9000