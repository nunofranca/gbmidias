import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/whats.css',
                'resources/js/app.js',
                'resources/js/whats'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
