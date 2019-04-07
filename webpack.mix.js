let mix = require('laravel-mix');
let build = require('./tasks/build.js');
require('laravel-mix-purgecss');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build/');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch([
            'config.php',
            'source/**/*.md',
            'source/**/*.php',
            'source/**/*.scss',
        ]),
    ],
});

/*
mix.js('source/_assets/js/main.js', 'js')
    .sourceMaps()
    .sass('source/_assets/sass/main.scss', 'css/main.css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.js')],
    })
    .purgeCss({
        extensions: ['html', 'md', 'js', 'php', 'vue'],
        folders: ['source'],
        whitelistPatterns: [/language/, /hljs/, /algolia/],
    })
    .version();
*/

mix
    .sass('source/_assets/sass/app.scss', 'css/app.css', {
        implementation: require('node-sass')
    })
    .copy('./node_modules/orchid-icons/dist/fonts/', 'source/assets/build/fonts')
    .js(['source/_assets/js/app.js'], 'js/app.js')
    .sourceMaps()
    .version();
