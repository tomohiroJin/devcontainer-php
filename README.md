# PHP 開発環境 (DevContainer)

このリポジトリは、Visual Studio Code の DevContainer 機能を使用して、PHP の開発環境を迅速にセットアップするための設定を提供します。

## 特徴

- **PHP 8.2 環境**: 最新の PHP バージョンを使用。
- **Xdebug**: デバッグツールとして Xdebug を組み込み。
- **Composer**: PHP の依存関係管理ツールをプリインストール。
- **VS Code 拡張機能**: PHP 開発を支援する複数の拡張機能を自動的にインストール。

## 前提条件

- [Docker](https://www.docker.com/) がインストールされていること。
- [Visual Studio Code](https://code.visualstudio.com/) と [Dev Containers 拡張機能](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) がインストールされていること。

## 使用方法

1. **リポジトリのクローン**:

   ```bash
   git clone https://github.com/tomohiroJin/devcontainer-php.git
   cd devcontainer-php
   ```

2. **DevContainer の起動**:

   Visual Studio Code でこのフォルダを開き、コマンドパレット（`Ctrl+Shift+P` または `Cmd+Shift+P`）で `Dev Containers: Reopen in Container` を選択します。

3. **依存関係のインストール**:

   コンテナ内のターミナルで以下のコマンドを実行し、必要な PHP パッケージをインストールします。

   ```bash
   composer install
   ```

4. **サンプルコードの実行**:

   `src/Sample.php` にサンプルコードが含まれています。これを編集・実行して動作を確認できます。

5. **テストの実行**:

   `tests/SampleTest.php` に PHPUnit を使用したテストコードが含まれています。以下のコマンドでテストを実行できます。

   ```bash
   ./vendor/bin/phpunit
   ```

## ディレクトリ構成

```
devcontainer-php/
├── .devcontainer/
│   ├── devcontainer.json
│   └── Dockerfile
├── src/
│   └── Sample.php
├── tests/
│   └── SampleTest.php
├── composer.json
├── composer.lock
└── phpunit.xml
```

## カスタマイズ

- **PHP バージョンの変更**: `.devcontainer/Dockerfile` 内のベースイメージを変更することで、異なる PHP バージョンを使用できます。
- **追加の拡張機能**: `.devcontainer/devcontainer.json` の `customizations.vscode.extensions` セクションに拡張機能の ID を追加することで、他の VS Code 拡張機能をインストールできます。

## 参考資料

- [Visual Studio Code Remote - Containers](https://code.visualstudio.com/docs/remote/containers)
- [PHP: Hypertext Preprocessor](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [PHPUnit](https://phpunit.de/)

---

この設定により、迅速に PHP の開発とテストを開始できます。必要に応じて設定を調整し、最適な開発環境を構築してください。 