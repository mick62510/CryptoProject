import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    server: {
        host: '127.0.0.1',
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/app.js', 'resources/css/vite.css'],
            refresh: true,

        }),
    ],

});
