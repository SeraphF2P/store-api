import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/ts/react/App.css',
        'resources/ts/react/main.tsx'],
      refresh: true,
    }),
  ],
});
