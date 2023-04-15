import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
const path = require('path')

export default defineConfig({
    server: {
        host: '127.0.0.1',
    },
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.scss',
                'resources/js/vendor/app.js',
                'resources/js/vendor/app-menu.js',
                'resources/js/vendor/material-app.js',
                'resources/js/vendor/unison.js',
                'resources/js/bootstrap.js',
                'resources/js/form-file.js',
                'resources/js/grid.js',
                'resources/js/image.js',
                'resources/js/new-grid.js',

            ],
            refresh: true,

        }),

    ],

});
