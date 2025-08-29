import { defineConfig } from 'vite'

import laravel from 'laravel-vite-plugin'
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';

export default defineConfig({
  // base: '/app/themes/sage/public/build/',
  plugins: [
    laravel({
      input: [
        'resources/css/app.scss',
        'resources/js/app.js',
        'resources/css/editor.scss',
        'resources/js/editor.js',
      ],
      refresh: true,
    }),

    wordpressPlugin(),

    // Generate the theme.json file in the public/build/assets directory
    // based on the Tailwind config and the theme.json file from base theme folder
    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
    }),
  ],
server: {
  host: 'localhost',
  port: 5173,
  strictPort: true,
  https: false,
  hmr: { host: 'localhost' },
  proxy: {
    // only proxy PHP requests, not Vite assets
    '^/(?!@vite|resources|@react-refresh)': {
      target: 'http://localhost:8888', // your WP site
      changeOrigin: true,
      secure: false,
    },
  },
},
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
})
