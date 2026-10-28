/** @type {import('vite').ViteUserConfig} */
module.exports = {
  plugins: [
    require('@tailwindcss/vite'),
  ],
  // Root directory is project root; Vite will process resources/css/app.css as the CSS entry
  root: '.',
  publicDir: 'resources/css',
  // For CSS-only builds, disable JS entry point resolution
  build: {
    // Generate CSS-only output, no JS bundle needed
    rollupOptions: {
      input: 'resources/css/app.css',
      output: {
        // Output CSS to the proper location
        assetFileNames: 'assets/[name][extname]',
        chunkFileNames: 'assets/[name][extname]',
        entryFileNames: 'assets/[name][extname]',
      },
    },
    // Don't try to load index.html as entry point
    emptyOutDir: true,
  },
  // Tell Vite that this is a CSS project, not an app
  server: {
    port: 5173,
    strictPort: false,
  },
}