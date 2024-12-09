import c from 'ansi-colors'
import log from 'fancy-log'
import fs from 'fs'
import path from 'path'
import globule from 'globule'
import sharp from 'sharp'

class ImageFormatConverter {
    #defaults = {
        srcDir: 'src/assets/images',
        distDir: 'src/assets/images',
        src: ['src/assets/images/**/*.{jpg,jpeg,png}'],
        includeExtensionName: true,
        formats: [
            { type: 'webp', quality: 80 },
            { type: 'avif', quality: 50 }
        ]
    }

    #options

    constructor(options = {}) {
        this.#options = { ...this.#defaults, ...options }
        this.#ensureDirectoriesExist()
        this.#init()
    }

    #ensureDirectoriesExist() {
        const directories = [this.#options.srcDir, this.#options.distDir]
        directories.forEach(dir => {
            if (!fs.existsSync(dir)) {
                fs.mkdirSync(dir, { recursive: true })
                log(`Directory created: ${dir}`)
            } else {
                log(`Directory already exists: ${dir}`)
            }
        })
    }

    async #init() {
        const imagePathList = this.#findImagePaths()
        if (imagePathList.length === 0) {
            log('No images found to convert')
            return
        }
        await this.#convertImages(imagePathList)
    }

    #findImagePaths() {
        return globule.find(this.#options.src)
    }

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

    async #createDistDir(imagePath) {
        const distDir = path.dirname(this.#getDistPath(imagePath, this.#options.formats[0]))
        if (!fs.existsSync(distDir)) {
            fs.mkdirSync(distDir, { recursive: true })
            log(`Directory created: ${distDir}`)
        }
    }

    #getDistPath(imagePath, format) {
        const { distDir, includeExtensionName } = this.#options
        const relativePath = path.relative(this.#options.srcDir, imagePath)
        const ext = includeExtensionName ? `.${format.type}` : ''
        const distPath = path.join(distDir, relativePath)
        return distPath.replace(path.extname(distPath), ext)
    }

    async #convertImageFormat(imagePath, format) {
        try {
            const distPath = this.#getDistPath(imagePath, format)
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
}

new ImageFormatConverter()
