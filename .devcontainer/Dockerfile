# syntax=docker/dockerfile:1
FROM composer:2.11.1@sha256:8de2184c6de224f4689e8f80ed5f5edaf0030b6b8b7839a22a2bcb6722ac87d0 AS composer
FROM php:8.6-cli-alpine@sha256:19c9ad299d11db9b15a2198c1e5aa8345b1907f0ac48731f50cf024d2b64221e AS extensions

ARG XDEBUG_VERSION=3.5.3
# The optional CA secret supports managed HTTPS proxies without disabling TLS.
RUN --mount=type=secret,id=proxy_ca \
    set -eux; \
    if [ -f /run/secrets/proxy_ca ]; then export CURL_CA_BUNDLE=/run/secrets/proxy_ca SSL_CERT_FILE=/run/secrets/proxy_ca; fi; \
    apk upgrade --no-cache; \
    apk add --no-cache $PHPIZE_DEPS linux-headers; \
    curl -fsSL "https://xdebug.org/files/xdebug-${XDEBUG_VERSION}.tgz" -o /tmp/xdebug.tgz; \
    echo 'f073de91bea046106abf4d6071c963ea71e58571df6ce58948ceca89d121cb2d  /tmp/xdebug.tgz' | sha256sum -c -; \
    mkdir /tmp/xdebug; \
    tar -xzf /tmp/xdebug.tgz -C /tmp/xdebug --strip-components=1; \
    cd /tmp/xdebug; \
    phpize; \
    ./configure --enable-xdebug; \
    make -j2; \
    make install; \
    docker-php-ext-enable xdebug; \
    rm -rf /tmp/xdebug /tmp/xdebug.tgz /var/cache/apk/*

FROM php:8.6-cli-alpine@sha256:19c9ad299d11db9b15a2198c1e5aa8345b1907f0ac48731f50cf024d2b64221e
RUN --mount=type=secret,id=proxy_ca \
    set -eux; \
    if [ -f /run/secrets/proxy_ca ]; then export SSL_CERT_FILE=/run/secrets/proxy_ca; fi; \
    apk upgrade --no-cache; \
    apk add --no-cache git unzip bash shadow libstdc++; \
    addgroup -g 1000 vscode; \
    adduser -D -u 1000 -G vscode -s /bin/bash vscode; \
    mkdir -p /workspaces/devcontainer-php; \
    chown vscode:vscode /workspaces/devcontainer-php
COPY --from=extensions /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=extensions /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY --chmod=0644 .devcontainer/xdebug.ini /usr/local/etc/php/conf.d/zz-xdebug.ini
USER vscode
WORKDIR /workspaces/devcontainer-php
