# template-vite-wordpress
利用OSはMacを想定しています。

## フロント開発
![VS Code](https://img.shields.io/badge/Visual%20Studio%20Code-007ACC?style=flat&logo=visualstudiocode&logoColor=ffffff)
![Git](https://img.shields.io/badge/Git-F05032?style=flat&logo=Git&logoColor=ffffff)
![Github](https://img.shields.io/badge/GitHub-181717?style=flat&logo=GitHub&logoColor=ffffff)
![vite](https://img.shields.io/badge/vite-F7C526?style=flat&logo=vite&logoColor=8971EA)
![node.js](https://img.shields.io/badge/Node.js-5FA04E?style=flat&logo=node.js&logoColor=ffffff)
![npm](https://img.shields.io/badge/npm-CB3837?style=flat&logo=npm&logoColor=ffffff)


### ファイル構成
```txt
└── Project/
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
    └── wp-content
        ├── plugins
        ├── themes
        │   └── template-vite-wordpress
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

### 開発開始

```
npm run dev
```

### /distへのビルド

```
npm run build
```

### /wp-contentへのビルド

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

### npmパッケージアップデート

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


## GitHub Pages

[publicディレクトリ](https://konno1614.github.io/template-vite/public/)
