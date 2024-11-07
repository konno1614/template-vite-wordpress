import c from 'ansi-colors'
import log from 'fancy-log'
import fs from 'fs'
import globule from 'globule'
import sharp from 'sharp'

class ImageFormatConverter {
    #defaults = {
        srcDir: 'src',
        distDir: 'wp-content/themes/template-vite-wordpress',
        src: ['/**/*.{jpg,jpeg,png}'],
        includeExtensionName: true,
        formats: [
            { type: 'webp', quality: 80 },
            // { type: 'avif', quality: 50 }
        ]
    }

    #options

    constructor(options = {}) {
        this.#options = { ...this.#defaults, ...options }
        this.#init()
    }

    async #init() {
        const imagePathList = this.#findImagePaths()
        await this.#convertImages(imagePathList)
    }

    /**
     * globパターンで指定した画像パスを配列化して返す
     * @return { array } 画像パスの配列
     */
    #findImagePaths() {
        const patterns = this.#options.src.map(
        (src) => `${this.#options.srcDir}${src}`
        )
        return globule.find({ src: patterns })
    }

    /**
     * 画像を変換する
     * @param { string } imagePath 画像パス
     * @param { object } format 画像形式と圧縮品質
     */
    async #convertImageFormat(imagePath, format) {
        const reg = /\/(.*)\.(jpe?g|png)$/i
        const [, imageName, imageExtension] = imagePath.match(reg)
        const imageFileName = this.#options.includeExtensionName
        ? `${imageName}.${imageExtension}`
        : imageName
        const distPath = `${this.#options.distDir}/${imageFileName}.${format.type}`
        try {
        await sharp(imagePath)
            .toFormat(format.type, { quality: format.quality })
            .toFile(distPath)
        log(
            `Converted ${c.blue(imagePath)} to ${c.yellow(
            format.type.toUpperCase()
            )} ${c.green(distPath)}`
        )
        } catch (error) {
        log(
            c.red(
            `Error converting image to ${c.yellow(
                format.type.toUpperCase()
            )}\n${error}`
            )
        )
        }
    }

    /**
     * 配列内の画像パスのファイルを変換する
     * @param { array } imagePathList 画像パスの配列
     */
    async #convertImages(imagePathList) {
        if (imagePathList.length === 0) {
        log(c.red('No images found to convert'))
        return
        }
        for (const imagePath of imagePathList) {
        await this.#createDistDir(imagePath)
        const conversionPromises = this.#options.formats.map((format) =>
            this.#convertImageFormat(imagePath, format)
        )
        await Promise.all(conversionPromises)
        }
    }

    /**
     * 画像を格納するディレクトリが無い場合は作成する
     * @param { string } imagePath 画像を格納するディレクトリパス
     */
    async #createDistDir(imagePath) {
        const reg = new RegExp(`^${this.#options.srcDir}/(.*/)?`)
        const path = imagePath.match(reg)[1] || ''
        const distDir = `${this.#options.distDir}/${path}`
        if (!fs.existsSync(distDir)) {
        try {
            fs.mkdirSync(distDir, { recursive: true })
            log(`Created directory ${c.green(distDir)}`)
        } catch (error) {
            log(c.red(`Failed to create directory ${c.yellow(distDir)}\n${error}`))
            throw error
        }
        }
    }
}
const imageFormatConverter = new ImageFormatConverter()
