import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
const path = require('path')

export default defineConfig({
    server: {
        host: '0.0.0.0',
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
                'resources/js/image.js',
                'resources/js/select2.js',
                'resources/js/crypto-entries-form-entries.js',
                'resources/js/grid.js',
                'resources/js/dashboard.js',
                'resources/js/vendor/chartjs/doughnut.js',
                'resources/js/vendor/chartjs/doughnut-simple.js',
                'resources/js/vendor/chartjs/pie.js',
                'resources/js/vendor/chartjs/pie-simple.js',
                'resources/js/btn-confirmation.js',
            ],
            refresh: true,

        }),

    ],

});
