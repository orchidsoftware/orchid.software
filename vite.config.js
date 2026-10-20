import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    publicDir: 'public',
    build: {
        copyPublicDir: false,
    },
    experimental: {
        renderBuiltUrl(filename, { type }) {
            if (type === 'public') {
                return `/${filename}`;
            }
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: ['resources/views/**', 'docs/**'],
        }),
    ],
});
