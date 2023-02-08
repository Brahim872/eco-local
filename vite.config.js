import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// import toaster from './public/plugins/js/toastr';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/product.js',
            ],
            refresh: true,
        }),
    ],
});
