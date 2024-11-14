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
- 開発開始時は.wp-env.jsonの`WP_DEBUGをtrue`にして`npm run wp-start`後に`npm run dev`
- 開発終了時は.wp-env.jsonの`WP_DEBUGをfalse`にして再度`npm run wp-start`後に表示確認し、`npm run build-wp`

### 納品方法
- ファイルを更新した際、`SFTP`を使ってファイルをアップロード
- 管理画面から更新・操作などした際、`npm run wp-export`して`/wp-content/uploads/backup.sql`にバックアップファイルを生成
- backup.sqlをphpMyAdmin画面からインポート
- phpMyAdmin画面の`wp_options`から、`siteurl`と`home`を適切なものに更新

## 利用ツール
- [wp-env](https://ja.wordpress.org/team/handbook/block-editor/reference-guides/packages/packages-env/)
- [Docker Desktop](https://www.docker.com/ja-jp/products/docker-desktop/)

## ローカルWordPress情報
| 項目 | URL |
| - | - |
| 静的サイトURL | http://localhost:5173/ |
| 動的サイトURL | http://localhost:8888/ |
| 管理画面URL | http://localhost:8888/wp-admin/ |
| ユーザー | admin |
| パスワード | password |

## サーバー構成
```txt
└── Project
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

## phpMyAdmin
| 項目 | URL |
| - | - |
| siteurl | https://example.com/cms |
| home | https://example.com |

### ファイル構成
```txt
└── Project
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

### /distへのビルド
```
npm run build
```

### root/cms/wp-contentへのビルド
```
npm run build-wp
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
