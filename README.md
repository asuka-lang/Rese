## Rese

#### 飲食店予約サービス
<img width="1437" alt="shop_all" src="https://github.com/asuka-lang/Rese/assets/143139948/b2bbdc56-0960-406c-98da-82d293a91993">

# 作成した目的
#### 外部サービス手数料の負担をなくすため自社の予約サービスを作成

# アプリケーションURL
#### http://localhost
#### URLからは飲食店一覧ページへ行けるが、予約やお気に入りの登録はユーザーログインが必要である。
#### ユーザーログインができない人は会員登録（Registartion)してからログインを行う形になる。
#### 一覧ページの左上にある四角いアイコンをクリックしたら、メニューページへ飛ぶ。
#### メニューページはログイン前とログイン後で異なる。
#### （ログイン前→ログイン・会員登録・ホーム、ログイン後→ホーム・ログアウト・マイページ）

# 機能一覧
#### ・会員登録
#### ・ログイン
#### ・ログアウト
#### ・ユーザー情報（お気に入り店舗・予約店舗）取得
#### ・飲食店情報取得
#### ・検索機能（エリア・ジャンル・店舗名）
#### ・お気に入り機能（ログインユーザーのみ）
#### ・予約機能（ログインユーザーのみ）

# 使用技術

#### 開発環境はDockerで以下のコンテナを作成
#### (webサーバー）　　nginx:1.21.1
#### (開発言語)      php
#### (データベース）　 mysql:8.0.26
#### (データベース管理ツール）　　phpmyadmin

#### Dockerで開発環境構築後にフレームワークLaravelをインストール
#### (フレームワーク）　　Laravel 8.x

# テーブル設計
<img width="666" alt="スクリーンショット 2024-06-02 22 58 52" src="https://github.com/asuka-lang/Rese/assets/143139948/a6e8ed92-e2b9-4d6e-ba53-0670bb0c70bd">
<img width="674" alt="スクリーンショット 2024-06-02 22 59 28" src="https://github.com/asuka-lang/Rese/assets/143139948/27778e86-09d9-4d25-be9f-ccd97c4e7257">

# ER図
<img width="704" alt="スクリーンショット 2024-06-02 23 01 10" src="https://github.com/asuka-lang/Rese/assets/143139948/178a9f0c-daad-4806-8c52-e5f821cdb827">

# 環境構築

#### 開発環境を以下のGithubURLからクローンする
###  git clone git@github.com:asuka-lang/Rese.git

#### クローンしたディレクトリ名を変更（ディレクトリ名は自由。ここではRese2と変更）
###  mv Rese Rese2
###  cd Rese2 

#### Dockerで開発環境構築
###  docker-compose up -d --build

#### Laravelパッケージのインストール (開発環境が共有のため）
###  docker-compose exec php bash
###  composer install

#### .envファイル作成（データベース接続専用ファイル）
###  cp .env.example .env (.env.exampleファイルをコピーして、ファイル名を.envへ変更）
#### .envファイルの内容を書き換える
<img width="303" alt="スクリーンショット 2024-06-02 8 19 29" src="https://github.com/asuka-lang/Rese/assets/143139948/964ed38a-6678-441e-9b56-c0ee36d48866">
#### アプリケーションキーを生成する
###  php artisan key:generate

#### ストレージ保存した画像を反映させるために、シンボリックリンク作成
###  php artisan storage:link






