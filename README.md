## 概要
[Restraurant Chain Mockup](https://github.com/bory777/RestaurantChainMockup) を拡張して、ユーザーがフォームに入力できるようにしたものです。レストランチェーンに対して、ユーザーがさまざまなオプションを選択ができます。
フォームから送信されたPOSTリクエストの処理を学習する目的で作成しています。

- チェーンが持つ従業員の数を選択
- 従業員の給与範囲を選択
- 場所の数を入力
- 場所の郵便番号の範囲を設定
- 生成したいファイルのタイプを選択: HTML、JSON、TXT、または MarkDown。

## セットアップ手順

### 1. 必要な依存関係のインストール

プロジェクトをクローンした後、以下のコマンドで必要な依存関係をインストールします。

```bash
composer install
```

### 2. ローカルサーバーの起動

PHPの組み込みサーバーを使用して、プロジェクトをローカルでホストします。

```bash
php -S localhost:8000
```

ブラウザで `http://localhost:8000` にアクセスすると、システムが動作していることを確認できます。
