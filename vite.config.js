import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],

    server: {
        host: '0.0.0.0',

        hmr: {
            host: '192.168.1.7',
        },

        origin: 'http://192.168.1.7:5173',

        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});