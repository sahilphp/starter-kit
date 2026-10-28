/**
 * Bootstrap 5 starter profile — compiled distribution.
 *
 * Uses Bootstrap's precompiled assets from node_modules (no Sass
 * compilation), following the official Bootstrap 5.3 JavaScript guidance:
 * a single ESM import registers every plugin's data-api (dropdowns,
 * tooltips, toasts, ... via data-bs-* attributes). Popper is pulled in
 * automatically through Bootstrap's own dependency on @popperjs/core —
 * no extra JavaScript dependency is declared here.
 *
 * Import order matters: Bootstrap's CSS first, then application
 * overrides, so override rules win the cascade at equal specificity.
 *
 * Build: npm run build:bootstrap
 * Output: public/build/assets/bootstrap-starter.{css,js}
 */

import 'bootstrap/dist/css/bootstrap.min.css';
import '../css/bootstrap-overrides.css';

import * as bootstrap from 'bootstrap';

// Expose the plugin namespace for dynamic use (e.g. `new bootstrap.Tooltip(el)`
// from an inline script) and to pin the namespace import against tree-shaking.
window.bootstrap = bootstrap;
