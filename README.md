# PBL_Name_List

## 導入手順
1. git cloneする
2. 0000-default.confとdocker-compose.yml、Dockerfileを設定
3. docker-compose build（ディレクトリ移動忘れに注意）
4. docker-compose up -d
5. http://localhost:80 にアクセス

## コンテナ操作
- docker-compose build コンテナ作成（初回のみ）
- docker-compose up -d コンテナ起動
- docker-compose stop コンテナ停止
- docker-compose down コンテナ削除

## 必要な環境
- Docker
- Docker Compose
- Git

## 使用技術
- **言語**: PHP
- **Webサーバー**: Apache
- **データベース**: MySQL
- **コンテナ管理**: Docker, Docker Compose
- **フロントエンド**: HTML, CSS, JavaScript
