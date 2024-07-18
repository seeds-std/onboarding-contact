FROM php:8.1.11-apache
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql

# ベースイメージの指定
FROM ubuntu:latest

# パッケージリストの更新とgitのインストール
RUN apt-get update && apt-get install -y git

# その他の設定やアプリケーションのインストールや構成

# コンテナが起動した際のデフォルトの動作を定義
CMD ["bash"]

FROM docker pull mailhog/mailhog:v1.0.1