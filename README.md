# PHP 開発環境 (DevContainer)

このリポジトリは、Visual Studio Code の DevContainer 機能を使用して、PHP の開発環境を迅速にセットアップするための設定を提供します。

## 特徴

- **PHP 8.4 環境**: 最新の PHP バージョンを使用。
- **Xdebug**: デバッグツールとして Xdebug を組み込み。
- **Composer**: PHP の依存関係管理ツールをプリインストール (公式 Composer イメージから取得)。
- **非 root ユーザ (`vscode`)**: VS Code DevContainer 標準の非 root ユーザで動作。
- **コード品質ツール**: PHPUnit 11 / PHPStan / PHP-CS-Fixer をプリインストール。
- **VS Code 拡張機能**: PHP 開発を支援する拡張機能を自動的にインストール。
- **`reference/` ディレクトリ**: PHP の基本構文・デザインパターンの実装を含むサンプルコードを収録。

## 前提条件

- [Docker](https://www.docker.com/) がインストールされていること。
- [Visual Studio Code](https://code.visualstudio.com/) と [Dev Containers 拡張機能](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) がインストールされていること。

## 使用方法

### **1. リポジトリのクローン**

```bash
git clone https://github.com/tomohiroJin/devcontainer-php.git
cd devcontainer-php
```

### **2. DevContainer の起動**

Visual Studio Code でこのフォルダを開き、コマンドパレット（`Ctrl+Shift+P` または `Cmd+Shift+P`）で `Dev Containers: Reopen in Container` を選択します。

### **3. 依存関係のインストール**

コンテナ内のターミナルで以下のコマンドを実行し、必要な PHP パッケージをインストールします。

```bash
composer install
```

### **4. テストと静的解析の実行**

`composer.json` の scripts からまとめて実行できます。

```bash
composer test       # PHPUnit
composer analyse    # PHPStan
composer fix        # PHP-CS-Fixer で自動整形
composer fix:check  # フォーマット差分を確認するだけ (CI 向け)
composer check      # fix:check + analyse + test を一括実行
```

### **5. 特定ディレクトリ/ファイルのテストのみ実行**

```bash
./vendor/bin/phpunit tests/Reference/Basic
./vendor/bin/phpunit tests/Reference/Examples/FizzBuzzTest.php
./vendor/bin/phpunit tests/Reference/Patterns
```

---

## ディレクトリ構成

```text
devcontainer-php/
├── .devcontainer/
│   ├── devcontainer.json
│   └── Dockerfile
├── src/
│   ├── Reference/
│   │   ├── Basic/        # PHPの基本構文に関するサンプル
│   │   ├── Patterns/     # デザインパターンの実装
│   │   │   ├── Strategy/
│   │   │   ├── Decorator/
│   │   │   ├── Factory/
│   │   │   ├── Observer/
│   │   │   ├── TemplateMethod/
│   │   └── Example/      # 参考例
├── tests/
│   ├── Reference/
│   │   ├── Basic/
│   │   ├── Patterns/
│   │   │   ├── Strategy/
│   │   │   ├── Decorator/
│   │   │   ├── Factory/
│   │   │   ├── Observer/
│   │   │   ├── TemplateMethod/
├── composer.json
├── phpunit.xml
├── phpstan.neon
├── .php-cs-fixer.dist.php
└── .editorconfig
```

---

## **追加機能**

### **1. `reference/basic/` - PHP の基本構文**

PHP の基本的な構文を学ぶためのサンプルコードを収録。

| 項目 | 説明 |
|------|------|
| **変数・定数・データ型・配列** | PHP の基本的なデータ構造と型の使い方 |
| **制御構文（条件分岐・ループ・三項演算子）** | if/else, switch, for, while, foreach など |
| **クラス・オブジェクト指向（継承・抽象化・オーバーライド・インターフェース）** | OOP の基本概念 |
| **関数型プログラミング（高階関数・クロージャ・無名関数）** | PHP の関数型プログラミングの基礎 |

---

### **2. `reference/patterns/` - デザインパターン**

PHP でのデザインパターンの実装例。

| デザインパターン | 説明 |
|------|------|
| **Strategy** | 動的にアルゴリズムを変更できる |
| **Decorator** | オブジェクトに動的に機能を追加 |
| **Factory** | インスタンス生成を専用のファクトリクラスに委ねる |
| **Observer** | あるオブジェクトの変更を監視し、通知を受け取る |
| **Template Method** | アルゴリズムの骨格を定義し、一部をサブクラスに委譲 |

---

## **コード品質ツール**

| ツール | 役割 | 設定ファイル |
|------|------|------|
| **PHPUnit 11** | ユニットテスト | `phpunit.xml` |
| **PHPStan (level 6)** | 静的解析 | `phpstan.neon` |
| **PHP-CS-Fixer** | コード整形 (PSR-12 + PHP 8.4 準拠) | `.php-cs-fixer.dist.php` |

---

## **カスタマイズ**

- **PHP バージョンの変更**: `.devcontainer/Dockerfile` 内のベースイメージを変更することで、異なる PHP バージョンを使用できます。
- **追加の拡張機能**: `.devcontainer/devcontainer.json` の `customizations.vscode.extensions` セクションに拡張機能の ID を追加することで、他の VS Code 拡張機能をインストールできます。
- **PHPStan のレベル変更**: `phpstan.neon` の `level` を `0`〜`10` で調整できます (高いほど厳格)。

---

## **参考資料**

- [Visual Studio Code Remote - Containers](https://code.visualstudio.com/docs/remote/containers)
- [PHP: Hypertext Preprocessor](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [PHPUnit](https://phpunit.de/)
- [デザインパターン - Wikipedia](https://ja.wikipedia.org/wiki/デザインパターン_(ソフトウェア))

---

この設定により、**迅速に PHP の開発とテストを開始できます**。  
デザインパターンや基本構文のサンプルを活用し、**より理解を深めてください** 🚀
