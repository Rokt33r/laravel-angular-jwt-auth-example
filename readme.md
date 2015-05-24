# install
Package設置
```sh
composer update
```

`.env`追加
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=SECRET

DB_HOST=localhost
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Migration適用
```
php artisan migrate
```

サーバ起動
```
php artisan serve
```

ここまでが終わったら準備完了です
しかし、このProjectには会員登録機能を追加していないので、次のようにTinkerからUserを追加してから使うことをお勧めします。
```
php artisan tinker
> App\User::create(['name'=>'Test Cat','email'=>'testcat@example.com','password'=>bcrypt('secret')]);
```

Frontendは`frontend/index.html`一枚です。
自分はNodeの`http-server`packageを利用することをお勧めします。
```
npm install -g http-server
http-server frontend
```

[localhost:8080](http://localhost:8080)から確認できます。

> IDと暗証番号は`testcat@example.com`, `secret`です。
