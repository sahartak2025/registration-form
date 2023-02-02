import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { createVuePlugin } from 'vite-plugin-vue2'
import { VuetifyResolver } from 'unplugin-vue-components/resolvers';
import Components from 'unplugin-vue-components/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        createVuePlugin(),
        Components({
            resolvers: [
                VuetifyResolver(),
            ],
        }),
        vue()
    ],
});
