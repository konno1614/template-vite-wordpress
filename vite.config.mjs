import { defineConfig } from "vite";
import { resolve, relative, extname } from "path";
import { globSync } from "glob";
import { fileURLToPath } from "node:url";
import fs from "fs-extra";

const root = resolve(__dirname, "src");

const getInputs = (pattern, baseDir) => {
    return Object.fromEntries(
        globSync(pattern).map((file) => [
            relative(baseDir, file.slice(0, file.length - extname(file).length)),
            fileURLToPath(new URL(file, import.meta.url))
        ])
    );
};

const inputsForWordPress = {
    style: resolve(root, "assets/style/style.scss"),
    ...getInputs("src/assets/js/*.ts", "src/assets/js")
};

const inputsForStatic = {
    style: resolve(root, "assets/style/style.scss"),
    ...getInputs("src/**/*.html", "src")
};

const copyImages = (destDir) => {
    const srcDir = resolve(__dirname, "src/assets/images");
    fs.copySync(srcDir, destDir);
};

const getRollupOptions = (mode) => ({
    input: mode === "wp" ? inputsForWordPress : inputsForStatic,
    output: {
        entryFileNames: "assets/js/[name].js",
        chunkFileNames: "assets/js/[name].js",
        assetFileNames: (assetsInfo) => {
            if (/\.(gif|jpeg|jpg|png|svg|webp)$/.test(assetsInfo.name)) {
                return 'assets/images/[name].[ext]';
            } else if (assetsInfo.name === "style.css") {
                return "assets/style/[name].[ext]";
            } else {
                return "assets/[name].[ext]";
            }
        }
    },
    plugins: []
});

export default defineConfig(({ mode }) => {
    const config = {
        root,
        base: "./",
        server: {
            port: 5173,
            origin: mode === "wp" ? undefined : "http://localhost:5173",
        },
        css: {
            preprocessorOptions: {
                scss: {
                    api: "modern-compiler",
                },
            },
        },
        build: {
            outDir: mode === "wp"
                ? resolve(__dirname, "root/cms/wp-content/themes/template-vite-wordpress/")
                : resolve(__dirname, "dist"),
            rollupOptions: getRollupOptions(mode)
        },
        plugins: []
    };

    const imageCopyPlugin = {
        name: 'copy-images',
        writeBundle() {
            const destDir = mode === "wp"
                ? resolve(__dirname, "root/cms/wp-content/themes/template-vite-wordpress/assets/images")
                : resolve(__dirname, "dist/assets/images");
            copyImages(destDir);
        }
    };

    config.build.rollupOptions.plugins.push(imageCopyPlugin);

    return config;
});
