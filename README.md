### 便利系
#### ローカルのネットワークサービスを外部に公開
Line Bot の webhook をローカル開発環境で実行できる。
[Line Bot の設定はこちら](https://manager.line.biz/account/@929dpzlv/setting/messaging-api)

ngrok を install
```
$ brew install nginx
```
php artisan serve を行った後に
```
$ ngrok http {ポート番号}
```
