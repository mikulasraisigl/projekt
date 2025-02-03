import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(), // Vue plugin for handling Vue single-file components
    ],
    resolve: {
        alias: {
            '@': '/resources/js', // Alias for cleaner imports
        },
    },
});
