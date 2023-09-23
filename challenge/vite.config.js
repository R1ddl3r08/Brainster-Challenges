import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/main.css', 'resources/js/app.js', 'resources/js/hamburgerMenu.js', 'resources/js/modal.js'],
            refresh: true,
        }),
    ],
});
