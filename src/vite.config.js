import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Faz o Vite aceitar conexões externas (não só localhost)
        port: 5173, // Porta padrão do Vite
        strictPort: true, // Se a porta estiver ocupada, não troca
        hmr: {
            host: "localhost", // Se acessa localmente, mantenha localhost; se via IP, coloque o IP da sua máquina
        },
    },
});
