# Template-Vite-WoredPress
利用OSはMacを想定しています。

## フロント開発
![VS Code](https://img.shields.io/badge/Visual%20Studio%20Code-007ACC?style=flat&logo=visualstudiocode&logoColor=ffffff)
![Git](https://img.shields.io/badge/Git-F05032?style=flat&logo=Git&logoColor=ffffff)
![Github](https://img.shields.io/badge/GitHub-181717?style=flat&logo=GitHub&logoColor=ffffff)
![vite](https://img.shields.io/badge/vite-F7C526?style=flat&logo=vite&logoColor=8971EA)
![node.js](https://img.shields.io/badge/Node.js-5FA04E?style=flat&logo=node.js&logoColor=ffffff)
![npm](https://img.shields.io/badge/npm-CB3837?style=flat&logo=npm&logoColor=ffffff)
![docker](https://img.shields.io/badge/docker-4682b4?style=flat&logo=docker&logoColor=ffffff)

## 開発フロー
- 開発開始：`npm run start`
- 開発終了：`npm run build`

※作業者の環境により`compose.yaml`の30行目の`name`は変更になるので、<br />
`npm run wp-start`でwp-envでwordpressを立ち上げ、`npm run check-hash-value`でdockerコンテナの`ハッシュ値を取得`する<br />
30行目を<br />
name: `取得したハッシュ値`_default<br />
と変更し、開発を開始する

### 共同開発フロー
- メイン作業者：`npm run start`>`npm run wp-export`してバックアップファイルをエクスポート
- サブ作業者：`npm run wp-start`>`npm run check-hash-value`>`compose.yamlの30行目のハッシュ値を更新`>`npm run start`>`npm run wp-import`してバックアップファイルをインポート

### 納品方法
- ファイルを更新した際、`SFTP`を使ってファイルをアップロード
- 管理画面から更新・操作などした際、`npm run wp-export`して`/wp-content/uploads/backup.sql`にバックアップファイルを生成
- backup.sqlをphpMyAdmin画面から生成したバックアップファイルをインポート
- phpMyAdmin画面の`wp_options`から、`siteurl`と`home`を適切なものに更新
- `root/.htaccess`,`root/index.php`,`root/sitemap.xml`,`root/robots.txt`,`root/cms/wp-config.php`の内容を適切なものに更新

## 利用ツール
- [wp-env](https://ja.wordpress.org/team/handbook/block-editor/reference-guides/packages/packages-env/)
- [Docker Desktop](https://www.docker.com/ja-jp/products/docker-desktop/)

## 開発環境

### WordPress
| 項目 | 値 |
| - | - |
| 静的サイトURL | http://localhost:1024/ |
| 動的サイトURL | http://localhost:8888/ |
| 管理画面URL | http://localhost:8888/wp-admin/ |
| ユーザー | admin |
| パスワード | password |

### Adminer
| 項目 | 値 |
| - | - |
| URL | http://localhost:8080/ |
| サーバ | mysql |
| ユーザ名 | root |
| パスワード | password |
| データベース | wordpress |

### MailHog
| 項目 | 値 |
| - | - |
| URL | http://localhost:8025/ |
| 送信テスト用メールアドレス | wordpress@example.com |

## テスト・本番環境

### サーバー構成
テスト環境と本番環境は同じサーバーに同居させる<br />
テスト環境のディレクトリを`/dev`<br />
本番環境のディレクトリを`/public`<br />
とし、それぞれにデータベースを作成する
```txt
└── root
    ├── dev
    │   └── cms
    │       ├── wp-admin
    │       ├── wp-content
    │       └── wp-include
    └── public
        └── cms
            ├── wp-admin
            ├── wp-content
            └── wp-include
```

### テスト環境
ルートディレクトリを`/dev`に設定<br />
（さくらのコントロールパネル>ドメイン/SSL>ドメイン/SSL>設定>基本設定>Web公開フォルダを`/dev`に設定）

#### WordPress
| 項目 | 値 |
| - | - |
| URL | https://example.com/ |
| 管理画面URL | https://example.com/cms/wp-admin/ |
| ユーザー | { FIXME! } |
| パスワード | { FIXME! } |

#### データベース
| 項目 | 値 |
| - | - |
| DBサーバー | { FIXME! } |
| DB名 | { FIXME! } |
| DBユーザー名 | { FIXME! } |
| DBパスワード | { FIXME! } |

#### phpMyAdmin
| 項目 | 値 |
| - | - |
| ユーザ名 | { FIXME! } |
| パスワード | { FIXME! } |
| wp_options>siteurl | https://example.com/cms |
| wp_options>home | https://example.com |

### 本番環境
ルートディレクトリを`/public`に設定<br />
（さくらのコントロールパネル>ドメイン/SSL>ドメイン/SSL>設定>基本設定>Web公開フォルダを`/public`に設定）

#### WordPress
| 項目 | 値 |
| - | - |
| URL | https://example.com/ |
| 管理画面URL | https://example.com/cms/wp-admin/ |
| ユーザー | { FIXME! } |
| パスワード | { FIXME! } |

#### データベース
| 項目 | 値 |
| - | - |
| DBサーバー | { FIXME! } |
| DB名 | { FIXME! } |
| DBユーザー名 | { FIXME! } |
| DBパスワード | { FIXME! } |

#### phpMyAdmin
| 項目 | 値 |
| - | - |
| ユーザ名 | { FIXME! } |
| パスワード | { FIXME! } |
| wp_options>siteurl | https://example.com/cms |
| wp_options>home | https://example.com |

### 開発環境ファイル構成
```txt
└── project
    ├── src
    │   ├── assets
    │   │   ├── images
    │   │   ├── js
    │   │   │   ├── common
    │   │   │   └── script.ts
    │   │   └── style
    │   │       ├── foundation
    │   │       ├── layout
    │   │       ├── object
    │   │       └── style.scss
    │   ├── index.html
    │   ├── hoge
    │   │   └── index.html
    │   └── public
    │       ├── images
    │       ├── css
    │       │   └── uncompressed.css
    │       ├── font
    │       │   └── *.ttf etc...
    │       ├── js
    │       │   └── uncompressed.js
    │       └── json
    │           └── manifest.webmanifest
    └── dist
    │   ├── index.html
    │   ├── hoge
    │   │   └── index.html
    │   ├── assets
    │   │   ├── images
    │   │   ├── css
    │   │   └── js
    │   ├── css
    │   │   └── uncompressed.css
    │   ├── font
    │   │   └── *.ttf etc...
    │   ├── js
    │   │   └── uncompressed.js
    │   └── json
    │       └── manifest.webmanifest
    │
    └── root/cms/wp-content
        ├── plugins
        ├── themes
        │   └── konnotes
        │       ├── index.php  // Other files used by wordpress.
        │       ├── assets
        │       │   ├── images
        │       │   ├── css
        │       │   └── js
        │       ├── css
        │       │   └── uncompressed.css
        │       ├── font
        │       │   └── *.ttf etc...
        │       ├── js
        │       │   └── uncompressed.js
        │       └── json
        │           └── manifest.webmanifest
        └── uploads
            ├── 20xx
            └── backup.sql
```

### 推奨 node バーション
```
node.js(version: v22.9.0)
```

### 依存ファイルインストール
```
npm install
```

### docker起動
```
npm run wp-start
```

### docker停止
```
npm run wp-stop
```

### 開発開始
```
npm run dev
```

### 開発終了
```
npm run build
```

### SQLファイルのエクスポート
```
npm run wp-export
```

### SQLファイルのインポート
```
npm run wp-import
```

## npmパッケージアップデート
```
npm i -g npm-check-updates
```
▲グローバルに`npm-check-updates`のインストール

```
ncu
```
▲アップデートできるライブラリとアップデートされるバージョンの一覧を確認

```
ncu -u
```
▲コマンドを実行 (`package.json`のバージョンが更新される)

```
rm -rf node_modules
```
▲node_modulesを削除

```
npm install
or
npm install --legacy-peer-deps
```
▲更新された`package.json`に合わせた新しいバージョンがインストールされる

##　開発環境作成の参考URL
- [@wordpress/env](https://ja.wordpress.org/team/handbook/block-editor/reference-guides/packages/packages-env/)
- [wp-envとViteで作る爆速WordPress開発環境](https://zenn.dev/crayfisher_zari/articles/f2d38f536eaf02)
- [【Node.js】sharp でサクッと「AVIF」「WebP」生成](https://qiita.com/taqumo/items/60de0af9699415150035)
- [wp-envにAdminerとMailHogを組み合わせる開発環境](https://www.braveryk7.com/wp-env-with-adminer-mailhog/)
