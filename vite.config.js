import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import collectModuleAssetsPaths from './vite-module-loader.js';

const paths = ["resources/js/app.js", "resources/css/luvi-ui.css"];
const allPaths = await collectModuleAssetsPaths(paths, 'Modules');
export default defineConfig({
    plugins: [
        laravel({
            input: allPaths,
            refresh: true,
        }),
        tailwindcss(),
    ],
});
