# WordPress テーマ作成の開始セット

## scss のコンパイルとバンドル

- npm でコンパイル環境を作ることもできるが、VSCode なら拡張「LiveSassCompiler」が便利。
- エントリーポイントが一つなら、出力ファイルも一つになる。ウェブ制作では大抵はそうだろうから、バンドルを考える必要もない。

### .vscode/settings.json

- liveSassCompiler の設定を次の様に書く。

```json
{
  // 略
  "liveSassCompile.settings.formats": [
    {
      "format": "compressed",
      "extensionName": ".min.css",
      "savePath": "/assets/dist"
    }
  ],
  "liveSassCompile.settings.autoprefix": false,
  "liveSassCompile.settings.excludeList": [
    "/**/node_modules/**",
    "/.vscode/**",
    "/.git/**"
  ],
  "liveSassCompile.settings.includeItems": ["/assets/scss/index.scss"],
  "liveSassCompile.settings.generateMap": true
}
```

- 重要なのは次の 2 つの設定
  - savePath = 出力先のディレクトリ
  - inclideItems = ソースファイルの配列

---

## TS のコンパイルとバンドル

- typescript コンパイラだけだとバンドルをしてくれないので、esbuild を用いる。

### インストール ts

- volta 等でグローバルにインストールするか、`npm i -D typescript`でローカルにインストールするか、選ぶ。
- 次のように tsconfig.json を自動生成。

```bash
# グローバルなら
tsc --init
# ローカルなら
npx tsc --init
```

### tsconfig.json

- 重要な設定は、noEmit = true。tsc コマンドでファイルを出力しなくなる。ファイル出力は esbuild が行うのでこれでよい。
- また、esbuild は、ts コードの型チェック等を行わないらしいので、tsc コマンドでチェックだけを行った方が良い。

```json
{
  "noEmit": true,
  "baseUrl": "./assets/ts/"
}
```

### インストール esbuild

```bash
npm i -D esbuild
```

### npm script を設定

- package.json 設定オブジェクト内の script オブジェクト内に次のように書く。

```json
{
  // (略)
  "scripts": {
    // (略)
    "build": "esbuild ./assets/ts/index.ts --outfile=./assets/dist/index.min.js --bundle --minify --sourcemap --watch --target=chrome58,edge16,firefox57,safari11"
  }
}
```

- コマンドのすぐ次に書くのは、ソースファイルのパス。
- `--outfile` の値は出力先のパス。
- `--bundle` : bundle=true として実行させる引数
- `--minify` : minify=true として実行させる引数
- `--sourcemap` : sourcemap=true として実行させる引数
- `--watch ` : 監視モードに移行。
- `--target` : 対象ブラウザや node バージョン等をカンマ区切りで並べる。

- スクリプトを定義したなら、下記のおなじみの方法で実行。それにより始まる監視モードは Ctrl + C で停止できる。

```bash
npm run build
```

---
