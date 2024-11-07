import { defineConfig } from "vite";
import { resolve, relative, extname } from "path";
import { globSync } from "glob";
import { fileURLToPath } from "node:url";
import fs from "fs-extra";

const root = resolve(__dirname, "src");

const inputsForWordPress = {
    style: resolve(root, "assets/style/style.scss"),
    ...Object.fromEntries(
        globSync("src/assets/js/*.ts").map((file) => [
            relative(
                "src/assets/js",
                file.slice(0, file.length - extname(file).length),
            ),
            fileURLToPath(new URL(file, import.meta.url))
        ]),
    ),
};

const inputsForStatic = {
    style: resolve(root, "assets/style/style.scss"),
    ...Object.fromEntries(
        globSync("src/**/*.html").map((file) => [
            relative("src", file.slice(0, file.length - extname(file).length)),
            fileURLToPath(new URL(file, import.meta.url)),
        ]),
    ),
};

// 画像ファイルをコピーする関数
const copyImages = () => {
    const srcDir = resolve(__dirname, "src/assets/images");
    const destDir = resolve(__dirname, "dist/assets/images");
    fs.copySync(srcDir, destDir);
};

export default defineConfig(({ mode }) => {
    const config = {
        root,
        base: "./",
        server: {
            port: 5173,
            origin: mode == "wp" ? undefined : "http://localhost:5173",
        },
        build: {
            outDir:
            mode === "wp"
                ? resolve(__dirname, "wp-content/themes/template-vite-wordpress/")
                : resolve(__dirname, "dist"),
            rollupOptions: {
                input: mode === "wp" ? inputsForWordPress : inputsForStatic,
                output: {
                    entryFileNames: "assets/js/[name].js",
                    chunkFileNames: "assets/js/[name].js",
                    assetFileNames: (assetsInfo) => {
                        if (/\.(gif|jpeg|jpg|png|svg|webp)$/.test(assetsInfo.name)) {
                            return 'assets/_ignored-all-images/[name].[ext]';
                        } else if (assetsInfo.name === "style.css") {
                            return "assets/style/[name].[ext]";
                        } else {
                            return "assets/[name].[ext]";
                        }
                    }
                }
            }
        }
    };

    // ビルド後に画像ファイルをコピー
    if (mode !== "wp") {
        config.build.rollupOptions.plugins = [
            {
                name: 'copy-images',
                writeBundle() {
                    copyImages();
                }
            }
        ];
    }

    return config;
});
