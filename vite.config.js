import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    build: {
        // https://rollupjs.org/guide/en/#big-list-of-options
        rollupOptions: {
            output: {
                chunkFileNames: 'assets/app-[hash].js',
                assetFileNames: 'assets/app-[hash][extname]',
            },
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.ts',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
})
