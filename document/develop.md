# 開発環境構築

## 初回セットアップ

```sh
sh script/local.sh
```

## 開発環境起動

```sh
cd docker
docker-compose exec workspace bash
npm run watch-poll
```

ブラウザで[http://localhost](http://localhost)にアクセス

#### ログイン情報

email: admin@example.com
pass: admin
