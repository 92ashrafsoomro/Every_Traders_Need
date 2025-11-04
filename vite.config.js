import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import vuetify from 'vite-plugin-vuetify'

export default defineConfig({

    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': path.resolve(__dirname, 'resources/js'),
            '@store': path.resolve(__dirname, 'resources/js/stores'),
            '@services': path.resolve(__dirname, 'resources/js/core/services'),
            '@utils': path.resolve(__dirname, 'resources/js/core/utils'),
            '@plugins': path.resolve(__dirname, 'resources/js/core/plugins'),
            '@components': path.resolve(__dirname, 'resources/js/core/plugins'),
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),
        vuetify({ autoImport: true }),
    ],
});
