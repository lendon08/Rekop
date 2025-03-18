import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "localhost", // or '0.0.0.0' if needed
        port: 5175, // Ensure it matches the one in the error
        strictPort: true,
        cors: true, // Enable CORS
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
