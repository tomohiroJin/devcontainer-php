# ベースイメージとして PHP 8.4 CLI を使用
FROM php:8.4-cli

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    curl \
    git \
    rlwrap \
    unzip \
    zip \
    sudo \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer のインストール (公式イメージから取得)
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Xdebug のインストールと設定
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN { \
        echo 'xdebug.mode=debug,develop'; \
        echo 'xdebug.start_with_request=trigger'; \
        echo 'xdebug.client_host=host.docker.internal'; \
        echo 'xdebug.client_port=9003'; \
    } > /usr/local/etc/php/conf.d/xdebug.ini

# 非 root ユーザの作成 (VS Code DevContainer 標準の vscode ユーザ)
ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=${USER_UID}
RUN groupadd --gid ${USER_GID} ${USERNAME} \
    && useradd --uid ${USER_UID} --gid ${USER_GID} -m ${USERNAME} -s /bin/bash \
    && echo "${USERNAME} ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/${USERNAME} \
    && chmod 0440 /etc/sudoers.d/${USERNAME}

# 作業ディレクトリ
WORKDIR /workspace

# ポート公開 (ビルトインサーバ用)
EXPOSE 8080

USER ${USERNAME}
