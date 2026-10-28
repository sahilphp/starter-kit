/** @type {import('tailwindcss').Config} */
module.exports = {
  // Source detection for SahilPHP application templates, components, and frontend source files
  content: [
    // SahilPHP core template files
    './resources/views/**/*.sahil.php',
    './resources/views/**/*.php',

    // Application templates (app/ directory)
    './app/**/*.php',

    // Frontend component files (if using sahil components)
    './resources/components/**/*.sahil.php',

    // Static source files for custom CSS/JS
    './resources/css/**/*.css',

    // Any other source files that may contain Tailwind class names
    './src/**/*.php',
  ],

  // Theme configuration for CSS theme variables and reusable design tokens
  theme: {
    // Extend the default theme with design tokens
    extend: {
      // CSS custom properties (theme variables) can be accessed via var() in CSS
      // e.g., background-color: var(--color-primary);
      // These are defined via the :root in your main template
    },
  },

  // Custom CSS/plugins configuration
  plugins: [],
}
