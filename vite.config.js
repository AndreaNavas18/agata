import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'assets/css/bootstrap.min.css',
                'assets/css/icons.min.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'node_modules/pure-css-loader/dist/css-loader.css',
            ],
            refresh: true,
        }),
    ],
});
