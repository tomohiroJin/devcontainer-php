# PHP 開発環境 (DevContainer)

このリポジトリは、Visual Studio Code の DevContainer 機能を使用して、PHP の開発環境を迅速にセットアップするための設定を提供します。

## 特徴

- **PHP 8.2 環境**: 最新の PHP バージョンを使用。
- **Xdebug**: デバッグツールとして Xdebug を組み込み。
- **Composer**: PHP の依存関係管理ツールをプリインストール。
- **VS Code 拡張機能**: PHP 開発を支援する複数の拡張機能を自動的にインストール。
- **`reference/` ディレクトリ追加**: PHP の基本構文・デザインパターンの実装を含むサンプルコードを収録。

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

### **4. Basic のテスト実行**

Basic の実装とテストは `Reference/Basic/` に含まれています。

```bash
phpunit --bootstrap vendor/autoload.php src/Reference/Basic
```


### **5. FizzBuzz のテスト実行**

FizzBuzz の実装とテストは `Reference/Examples/` に含まれています。

```bash
phpunit --bootstrap vendor/autoload.php tests/Reference/Examples/FizzBuzzTest.php
```

### **6. デザインパターンのサンプルコードの実行**

各デザインパターンのサンプルコードは `Reference/Patterns/` に格納されています。

```bash
phpunit --bootstrap vendor/autoload.php tests/Reference/Patterns
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
├── composer.lock
└── phpunit.xml
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

## **カスタマイズ**

- **PHP バージョンの変更**: `.devcontainer/Dockerfile` 内のベースイメージを変更することで、異なる PHP バージョンを使用できます。
- **追加の拡張機能**: `.devcontainer/devcontainer.json` の `customizations.vscode.extensions` セクションに拡張機能の ID を追加することで、他の VS Code 拡張機能をインストールできます。

---

## **テストの実行**

以下のコマンドで、すべてのテストを実行できます。

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

また、個別のデザインパターンのテストを実行することも可能です。

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/Reference/Patterns/Strategy/StrategyTest.php
```

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
