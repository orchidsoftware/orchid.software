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

mix
    .sass('source/_assets/sass/app.scss', 'css/app.css', {
        implementation: require('node-sass')
    })
    .js(['source/_assets/js/app.js'], 'js/app.js')
    .sourceMaps()
    .version();

if (!mix.inProduction()) {
    mix.purgeCss({
        extensions: ['html', 'md', 'js', 'php', 'vue'],
        folders: ['source'],
        whitelistPatterns: [/language/, /hljs/, /algolia/, /icon/],
    })
}
