/**
 * Vite build for the SahilPHP Bootstrap 5 asset profiles.
 *
 * Separate from vite.config.js (the Tailwind build) on purpose: the
 * Bootstrap profiles require no Tailwind plugin, and neither config
 * touches the other's inputs or output.
 *
 * Profiles and outputs (deterministic, unhashed names — the PHP Asset
 * Manager resolves them through config/assets.php):
 *
 *   bootstrap-starter → public/build/assets/bootstrap-starter.{css,js}
 *   bootstrap-sass    → public/build/assets/bootstrap-sass.{css,js}
 *
 * Build: npm run build:bootstrap
 */

module.exports = {
  // Project root; sources live in resources/.
  root: '.',
  // Never copy public/ into public/build/ (we build INTO public/).
  publicDir: false,
  build: {
    outDir: 'public/build',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        'bootstrap-starter': 'resources/js/bootstrap-starter.js',
        'bootstrap-sass': 'resources/js/bootstrap-sass.js',
      },
      output: {
        // CSS assets keep [extname]; JS entries/chunks are always .js.
        assetFileNames: 'assets/[name][extname]',
        chunkFileNames: 'assets/[name].js',
        entryFileNames: 'assets/[name].js',
      },
    },
  },
  css: {
    preprocessorOptions: {
      scss: {
        // Official Bootstrap 5.3 guidance: silence Dart Sass deprecation
        // notices from Bootstrap's own source (they never fail the build).
        // Adjusted for Dart Sass 1.106.x: `mixed-decls` is obsolete there
        // (silencing it warns), and `if-function` is a new notice emitted by
        // Bootstrap's source; `import`/`color-functions`/`global-builtin`
        // come from the official guidance.
        silenceDeprecations: [
          'import',
          'color-functions',
          'global-builtin',
          'if-function',
        ],
      },
    },
  },
};
