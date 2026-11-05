# 環境更新・セキュリティ記録

## 2026-11-05 の更新（Issue #4）

| 対象 | 採用版 | 方針 |
| --- | --- | --- |
| PHP | 8.5.12 | 公式サポート中の最新安定系列 8.5。2027 年末まで通常サポート、2029 年末までセキュリティサポート |
| OS | Alpine 3.24.3 | 公式 `php:8.5-cli-alpine` の digest を固定し、`apk upgrade` で公開済み修正を適用 |
| Composer | 2.11.1 | 公式イメージからバイナリを取得し、digest も固定 |
| Xdebug | 3.5.3 | 公式 HTTPS ソースを SHA-256 で固定。二重ロードを解消、通常はオフ |
| PHPUnit | 13.4.6 | PHP 8.5 対応。XML 設定も 13.4 に移行 |
| PHPStan | 2.3.5 | level 6、ソースとテストを対象。baseline やエラー無視設定は使用しない |
| PHP CS Fixer | 3.95.28 | PSR-12。危険なルールは無効 |
| Trivy | 0.76.2 | 公式リリースのチェックサムを照合して検証 |

Composer 依存は `composer.lock` に固定。OS パッケージはビルド時に更新するため、完全に同一のイメージが毎回生成されるという保証ではありません。
Xdebug 更新時は `XDEBUG_VERSION` と SHA-256 を同時に更新し、公式配信元から取得したソースを検証してください。
GitHub Actions は完全なコミット SHA で固定し、Dependabot で追従します。Trivy CLI の固定値も更新時に見直します。

### 実施した検証

- DevContainer の Dockerfile をビルドし、PHP 8.5.12 / Xdebug 3.5.3 を確認。
- `vendor` とキャッシュを除いた別コピーで `composer install` を実行し、ロックのみからの導入に成功。
- `composer validate --strict` / `composer check-platform-reqs` が成功。
- `composer check` が成功：**46 テスト・59 アサーション**、PHPStan エラー 0、整形差分 0（39 PHP ファイル）。
- 変更は PSR-12 整形、型の注釈、テストの `void` 戻り値に限定し、サンプルの振る舞いとアサーションは維持。
- Dev Containers CLI 0.90.0 で設定読込・起動・`postCreateCommand` を検証し、`vscode`（UID 1000）で `composer check` が成功。
- Intelephense の実際の言語サーバーに補完要求を送り、`App\Sample::add` の候補を確認。
- PHP Debug の実際の DAP アダプターとコンテナ内 Xdebug を接続し、`src/Sample.php` のブレークポイント停止と `$a = 2` の取得を確認。リポジトリの `Debug PHPUnit` 設定を使用。
- `actionlint` 1.7.12 と `git diff --check` が成功。

VS Code の GUI 操作や各 OS の Docker Desktop では未検証です。補完・デバッグは上記のプロトコル経由で確認しています。
Alpine は musl libc を使用するため、追加のネイティブ拡張・外部バイナリは Alpine 対応を確認してください。

### 脆弱性の調査結果

2026-11-05 23:40 JST に Trivy で最終イメージ（Alpine 3.24.3、53 OS パッケージ）を検査し、**検出 0 件**。
`composer audit --locked` も開発依存を含めて **既知の脆弱性 0 件**。
検査対象と結果の要約は [security-scan.json](security-scan.json) に記録しています。

比較した Debian 13 ベースでは HIGH/CRITICAL が 44 CVE（86 パッケージ別検出）あり、報告時点で修正版が未提供でした。
Alpine 候補には修正可能な HIGH/CRITICAL が 3 パッケージ分ありましたが、`apk upgrade` 後には検出されなくなりました。
検査の閾値を下げたり `ignore-unfixed` で隠したりせず、ベース変更と修正の適用で対応しています。現時点で脆弱性の例外登録はありません。

スキャン結果は実行時点の DB に基づきます。Trivy は本イメージで OS パッケージを検出しており、ソースから組み込んだ PHP / Xdebug バイナリの全 CVE、エディター拡張や未知の脆弱性まで保証するものではありません。
Composer / Xdebug / PHP は公式の保守中リリースを使用し、継続して更新・再監査してください。
CI は週次と push / PR 時に実行し、HIGH/CRITICAL は未修正分も含めて失敗扱いにします。

### VS Code 拡張の確認

公式 Marketplace から以下の公開版を取得し、公開元と設定を確認しました。拡張のインストールは最新 Marketplace 版を使用し、バージョン固定はしていません。

| 拡張 | 確認版 | ライセンス・費用 |
| --- | --- | --- |
| Intelephense（bmewburn） | 1.18.5 | クライアント MIT、言語サーバーは独自ライセンス。基本補完は無料、有料機能は不使用 |
| PHP Debug（xdebug） | 1.40.2 | MIT |
| EditorConfig（EditorConfig） | 0.18.2 | MIT |
| PHP CS Fixer（junstyle） | 0.3.21 | ISC |
| PHPStan（SanderRonde） | 4.0.19 | MIT、PHPStan Pro 不使用 |
| PHPUnit（recca0120） | 3.9.40 | MIT |

整形ツールや解析ツールを拡張任せに自動取得せず、リポジトリの `vendor/bin` を使う設定にしています。
更新時は Marketplace の保守状況・互換性を再確認してください。

## 参照

- [PHP サポート期間](https://www.php.net/supported-versions.php)
- [PHP 公式 Docker イメージ](https://hub.docker.com/_/php)
- [Composer 公式 Docker イメージ](https://hub.docker.com/_/composer)
- [Xdebug 対応 PHP バージョン](https://xdebug.org/docs/compat)
- [Xdebug 公式配信元](https://xdebug.org/download)
- [PHPUnit](https://phpunit.de/)
- [PHPStan](https://phpstan.org/)
- [PHP CS Fixer](https://cs.symfony.com/)
- [Trivy](https://trivy.dev/)
