# 模擬案件_書籍レビューアプリ BookShelf

## 概要
### プロジェクトの目的
模擬案件を通して、実務を想定したWebアプリケーション開発と、曖昧な要件から自ら仕様を設計しPMと詳細を詰めるプロセスを経験すること。
### 機能概要
書籍レビューアプリケーション「BookShelf」です。
ユーザーは書籍データを登録・閲覧することができ、レビューの投稿やお気に入り登録ができます。
ジャンルによる分類やレビューへのいいね機能、平均評価に基づくランキング機能を備えています。
外部アプリケーション向けの公開API（JSON）も提供します。

## ER図

## 環境構築手順
1. **リポジトリをクローン**
    ```https://github.com/matsuokanatsuki/bookshelf-app.git```

2. **Laravel Sailをインストール**
    プロジェクトディレクトリに移動
    ```cd bookshelf-app```

    Laravel Sailをインストール<br>
    ```docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html -e COMPOSER_CACHE_DIR=/tmp/composer_cache laravelsail/php82-composer:latest composer require laravel/sail --dev```

    Sailの設定ファイルをパブリッシュ（MySQLを選択）<br>
    ```docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html -e COMPOSER_CACHE_DIR=/tmp/composer_cache laravelsail/php82-composer:latest php artisan sail:install --with=mysql```

3. **.env ファイル内の以下のDB接続情報を確認・設定**
    以下のように設定します。
    ```
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=sail
    DB_PASSWORD=password
    ```

4. **Sailの起動とエイリアス設定**
    Sailをバックグラウンドで起動
    ```./vendor/bin/sail up -d```

    エイリアスを設定して 'sail' だけでコマンドを実行できるようにする<br>
    ```echo "alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'" >> ~/.zshrc```

    シェルを再起動するか、新しいターミナルを開いてエイリアスを有効にする<br>
    ```exec $SHELL```

5. **フロントエンドのセットアップ (Vite & Tailwind CSS)**
    ```
    sail npm install
    sail npm install alpinejs
    sail npm install -D tailwindcss@^3.4.0 @tailwindcss/forms postcss autoprefixer
    sail npm run dev
    ```

6. **アプリケーションキーの生成**
    ルートで以下のコマンドを実行します。
    ``sail artisan key:generate``

7. **データベースのマイグレーションと初期データ投入**
    以下のコマンドでテーブルを作成し、初期データを投入します。
    ```sail artisan migrate --seed```
    ※既存のデータベースをリセットしたい場合は以下を実行してください。
    ```sail artisan migrate:fresh --seed```

8. **アプリケーションへのアクセス**
    ブラウザで``http://localhost``にアクセスします。

### テスト実行
```sail artisan test```

## 使用技術
### バックエンド
- PHP8.5
- Laravel 10
- Laravel Fortify(認証)
- MySQL

### フロントエンド
- Blade
- Vite
- Tailwind CSS ^3.4.0
- @tailwindcss/forms

### 開発ツール
- Docker
- Laravel Sail
- phpMyAdmin

## 作成者
松岡奈津紀

## APIエンドポイント一覧（メソッド・パス・概要）
認証不要の公開APIです。全エンドポイントは `/api/v1` プレフィックス配下に定義されています。

| HTTPメソッド | URI | 概要 |
|---|---|---|
| GET | /api/v1/books | 書籍一覧（検索・ページネーション付き） |
| GET | /api/v1/books/{book} | 書籍データ詳細 |
| POST | /api/v1/books | 書籍データ新規作成 |
| PUT | /api/v1/books/{book} | 書籍データ更新 |
| DELETE | /api/v1/books/{book} | 書籍データ削除 |

## 開発環境URL
http://localhost


