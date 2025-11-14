import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
 
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        })
    ],
    build: {
        // Optimize chunk splitting for better caching
        rollupOptions: {
            output: {
                manualChunks: {
                    // Split vendor code for better caching
                    'vendor': [
                        'alpinejs',
                        'axios'
                    ],
                },
            },
        },
        // Increase chunk size warning limit
        chunkSizeWarningLimit: 600,
        // Enable CSS code splitting
        cssCodeSplit: true,
        // Minification
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.logs in production
                drop_debugger: true,
            },
        },
    },
    // Optimize dependencies
    optimizeDeps: {
        include: ['alpinejs', 'axios'],
    },
});