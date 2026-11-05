# PHP 開発環境

PHP の基本構文・FizzBuzz・デザインパターンを学ぶための DevContainer です。
PHP 8.5 / Composer 2 / PHPUnit 13 / PHPStan 2 / PHP CS Fixer 3 / Xdebug 3 を使用します。
採用バージョンと検証結果は [環境更新・セキュリティ記録](docs/maintenance.md) を参照してください。

## セットアップ

ホストに Docker と VS Code、Microsoft の [Dev Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) をインストールします。

```bash
git clone https://github.com/tomohiroJin/devcontainer-php.git
cd devcontainer-php
code .
```

コマンドパレットから **Dev Containers: Reopen in Container** を実行します。
`vscode` ユーザーで起動し、`.devcontainer/post-create.sh` が PHP の版と Composer ファイルの整合性を確認してから、ロック済みの開発依存を導入します。
同じ初期化スクリプトを CI でも実行します。
起動時の alias 追記や常駐サーバーは不要です。Dockerfile を更新した場合は **Rebuild Container** を実行してください。

## 開発コマンド

コンテナ内のリポジトリルートで実行します。

```bash
composer check                 # 全テスト・静的解析・PSR-12 チェック
composer test                  # 全テスト
composer analyse               # PHPStan level 6（src と tests、baseline なし）
composer lint                  # PHP CS Fixer の変更内容を確認
composer format                # PSR-12 で整形
composer audit --locked        # 開発依存を含めて脆弱性を確認
composer check-platform-reqs
```

```bash
composer test -- tests/Reference/Basic
composer test -- tests/Reference/Examples/FizzBuzzTest.php
composer test -- tests/Reference/Patterns
composer test -- tests/Reference/Patterns/Strategy/PaymentStrategyTest.php
```

VS Code の **Tasks: Run Test Task** でも `composer check` を実行できます。
テストは Testing ビューからも探索・実行できます。PHPUnit 設定は `phpunit.xml` に集約しています。

## デバッグ

`src/Sample.php` の `add()` にブレークポイントを置き、Run and Debug で **Debug PHPUnit** を選択して F5 を押します。
PHP Debug と PHP は同じコンテナで動作するため、ホスト側へのポート転送やパスマッピングは不要です。

通常の CLI と CI では Xdebug はオフです。手動でデバッグする場合は **Listen for Xdebug** を開始してから実行します。

```bash
XDEBUG_MODE=debug XDEBUG_TRIGGER=1 php vendor/bin/phpunit --filter SampleTest
```

9003 はコンテナ内ループバック接続用です。アプリケーション用の 8080 ポートは使用していません。

## VS Code 拡張

コンテナには以下のみを自動導入します。CLI ツールのバージョンは `composer.lock` で固定し、エディターと CI で共有します。

| 拡張 ID | 用途・採用理由 |
| --- | --- |
| `bmewburn.vscode-intelephense-client` | PHP 補完・定義ジャンプ。基本機能は無料。組み込み PHP 補完は重複を避けて無効化 |
| `xdebug.php-debug` | Xdebug によるブレークポイント・変数確認 |
| `EditorConfig.EditorConfig` | 改行・インデント・末尾空白の統一 |
| `junstyle.php-cs-fixer` | ロック済み PHP CS Fixer を保存時に実行。整形はこの拡張に統一 |
| `SanderRonde.phpstan-vscode` | ローカル PHPStan によるプロジェクト解析。Pro 機能は使用しない |
| `recca0120.vscode-phpunit` | PHPUnit テスト探索・実行 |

ホスト側には `ms-vscode-remote.remote-containers` を推奨しています。
Intelephense の有料機能を含め、有料ライセンスはこのワークフローに必須ではありません。
PHP_CodeSniffer / Psalm も一般的な選択肢ですが、今回は整形を PHP CS Fixer、型解析を PHPStan に統一しています。

以下は必要な場合のみ個人で追加してください。コンテナの必須設定には含めません。

- `GitHub.vscode-pull-request-github`：PR 操作
- `DavidAnson.vscode-markdownlint`、`streetsidesoftware.code-spell-checker`：文書支援
- `MS-CEINTL.vscode-language-pack-ja`：日本語 UI
- Composer 支援拡張：CLI と VS Code タスクで十分でない場合のみ、公開元・保守状況を確認して導入

テーマ、Live Share、Excel 閲覧、Apache 支援、複数の Git 履歴拡張は既定から外しています。
拡張は Marketplace の公開元と更新状況を確認して更新してください。拡張自体は Composer の監査対象ではありません。

## 再現性と更新

`composer.lock` をコミットし、通常の導入には `composer install` を使います。
PHP と Composer のベースイメージは digest、Xdebug は Dockerfile の `XDEBUG_VERSION` で固定します。
OS パッケージはビルド時にセキュリティ更新を取得するため、再ビルドでパッチレベルが変わる場合があります。

Dependabot が Composer・Docker・GitHub Actions の更新 PR を週次で作成します。
Xdebug の固定値と VS Code 拡張の互換性は手動でも確認します。
更新時は以下を実施し、ロックファイルと検証結果を一緒にレビューします。

```bash
composer update
composer check
composer audit --locked
docker build --pull --no-cache -f .devcontainer/Dockerfile -t php-dev:local .
trivy image --scanners vuln --severity HIGH,CRITICAL --exit-code 1 php-dev:local
```

CI は同じ Dockerfile をビルドし、品質チェックと Composer / Trivy の脆弱性チェックを行います。
コンテナに開発依存は含めないため、Composer 依存は別途 `composer audit --locked` で確認します。
検出結果は無視せず、修正または期限付きの例外判断を行ってください。

TLS 検査プロキシがある環境では、信頼済みの CA バンドルを BuildKit secret `proxy_ca` として渡せます。
証明書の検証は有効のままです。実行時の Composer にも環境に応じた CA を読み取り専用で渡してください。

```bash
docker build --secret id=proxy_ca,src=/path/to/trusted-ca-bundle.pem \
  -f .devcontainer/Dockerfile -t php-dev:local .
```

## サンプル

- `src/Reference/Basic`：変数・配列、制御構文、オブジェクト指向、関数型プログラミング
- `src/Reference/Examples`：FizzBuzz
- `src/Reference/Patterns`：Strategy、Decorator、Factory、Observer、Template Method
- `tests`：対応する PHPUnit テスト

学習用の `OOPConcepts.php` は複数の型を一つにまとめています。このファイルは Composer の classmap に明示して直接の型参照も解決します。

### 未修正の脆弱性が見つかった場合

HIGH / CRITICAL は修正版の有無にかかわらず CI を失敗させます。まずベースイメージ・OS パッケージ・依存を更新して再検査します。
修正が提供されていない場合も、無関係な PR ごとに検査を無効化せず、対応用の PR で次を記録してレビューします。

1. CVE、影響を受けるパッケージと版、修正版の有無、実際に到達可能な攻撃経路を調査する。
2. 継続利用が必要な理由、緩和策、対応担当者、追跡 Issue、再確認日を明記する。
3. 承認された例外のみ `.trivyignore.yaml` の `vulnerabilities` に追加し、`id`、`statement`（理由と Issue）、`expired_at`（期限、原則 14 日以内）を必須とする。CVE 全体の例外になるため対象パッケージと影響範囲も理由に書く。
4. 修正版が出たら更新と同時に例外を削除する。期限切れの例外は Trivy が適用しないため、CI は再び失敗する。

CI とローカルで同じ設定を読み込むには、以下で実行します。現在の例外リストは空です。

```bash
trivy --config .trivy.yaml image --scanners vuln --severity HIGH,CRITICAL --exit-code 1 php-dev:local
```

### 非 root での追加パッケージ

コンテナには sudo を導入していません。継続して必要なパッケージは Dockerfile の最終ステージの `apk add` に追加して再ビルドし、変更を共有・再監査してください。
ワークスペースはクローン先のフォルダ名にかかわらず `/workspaces/devcontainer-php` にマウントします。
コンテナ固有の PHP 実行パスは DevContainer の VS Code 設定に限定し、ホスト側のワークスペース設定には指定していません。


## 初期化に失敗した場合

`composer.json` と `composer.lock`、コンテナイメージは同じブランチの構成に揃えてください。
`^9.0` の要求に対してロックが `11.5.55` というエラーは、異なる構成の Composer ファイルが混在していることを示します。
`root` のシェル、`Cannot load Xdebug - it was already loaded`、`host.docker.internal:9003` への自動接続警告は旧コンテナ設定を使用している手掛かりです。
現在の構成は PHP 8.5 / PHPUnit 13 / `vscode` ユーザーで、通常時は Xdebug 無効です。

1. ホスト側で `git branch --show-current` と `git status --short --untracked-files=all` を確認します。未マージの変更は `main` には含まれません。
2. ローカルの変更を保存します。旧ブランチで生成された未追跡・無視対象の `composer.lock` がある場合は、リポジトリ外へバックアップしてから、利用するブランチへ切り替えます。
3. 追跡対象の Composer ファイルをローカルで変更している場合は差分を確認し、必要な変更を保存したうえで、同じコミットの `composer.json` と `composer.lock` に揃えます。初期化のためだけに `composer update` を実行してロックを変更しないでください。
4. **Dev Containers: Rebuild Container** を実行します。既存コンテナの再接続だけでは Dockerfile の変更は反映されません。
5. 初期化ログを確認します。失敗した場合は原因を解消してから、コンテナ内で以下を再実行できます。

```bash
sh .devcontainer/post-create.sh
composer test -- tests/Reference/Basic
```

`phpunit` のグローバルコマンドや alias は不要です。`composer test` または `./vendor/bin/phpunit` を使います。
テスト対象は実装の `src/Reference/Basic` ではなく、`tests/Reference/Basic` です。

ツールのキャッシュは `.cache/` に集約しています。旧構成や拡張が生成する `.php-cs-fixer.cache`、`.phpunit.cache`、`.phpstan.cache` も Git と Docker の対象から除外します。
ignore 設定は未追跡ファイルに適用されます。すでに追跡されているファイルは別途確認が必要で、この変更で既存ファイルを削除することはありません。
