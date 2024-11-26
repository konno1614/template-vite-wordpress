module.exports = {
    content: [ //監視するファイルの設定
        './src/**/*.{html,js,ts,jsx,tsx,php}',
        './root/cms/wp-content/themes/template-vite-wordpress/**/*.{html,js,ts,jsx,tsx,php}'
    ],
    theme: {
        extend: {},
    },
    corePlugins: {
    },
    plugins: [
        require('preline/plugin'),
    ],
}
