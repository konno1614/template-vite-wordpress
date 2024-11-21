import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

// __dirname の代わりに import.meta.url を使用してディレクトリ名を取得
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

function removeEmptyDirs(directory) {
    const files = fs.readdirSync(directory);

    if (files.length === 0) {
        fs.rmdirSync(directory);
        return;
    }

    files.forEach(file => {
        const fullPath = path.join(directory, file);
        if (fs.statSync(fullPath).isDirectory()) {
            removeEmptyDirs(fullPath);
        }
    });

    // 再度チェックして、ディレクトリが空であれば削除
    if (fs.readdirSync(directory).length === 0) {
        fs.rmdirSync(directory);
    }
}

// ビルドディレクトリを指定
const buildDir = path.resolve(__dirname, 'root/cms/wp-content/themes/template-vite-wordpress');
removeEmptyDirs(buildDir);
