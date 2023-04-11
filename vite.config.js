import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    server: {
        host: '127.0.0.1',
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/app.js',
                'resources/css/app.scss',
                'resources/css/bootstrap-extended.css',
                'resources/css/components.css',
                'resources/css/login-register.css',
                'resources/css/material.css',
                'resources/css/material-colors.css',
                'resources/css/material-extended.css',
                'resources/css/material-vendors.min.css',
                'resources/css/material-vertical-menu-modern.css',
                'resources/css/photoswipe.css',
                'resources/css/photoswipe-skin.css',],
            refresh: true,

        }),
    ],

});
