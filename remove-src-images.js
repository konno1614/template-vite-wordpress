import fs from 'fs'
import path from 'path'
import globule from 'globule'
import log from 'fancy-log'
import c from 'ansi-colors'

const srcDir = 'src/assets/images'
const extensions = ['webp', 'avif']

function deleteImages() {
    const patterns = extensions.map(ext => `${srcDir}/**/*.${ext}`)
    const filesToDelete = globule.find(patterns)

    if (filesToDelete.length === 0) {
        log(c.yellow('No .webp or .avif images found to delete'))
        return
    }

    filesToDelete.forEach(file => {
        fs.unlink(file, err => {
            if (err) {
                log(c.red(`Error deleting file: ${file}\n${err}`))
            } else {
                log(c.green(`Deleted file: ${file}`))
            }
        })
    })
}

deleteImages()
