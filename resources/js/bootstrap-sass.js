/**
 * Bootstrap 5 Sass customization profile.
 *
 * Compiles Bootstrap from source Sass so theme variables can be
 * overridden before Bootstrap is imported (its variables use !default,
 * so earlier definitions win). Requires the `sass` devDependency.
 *
 * The JavaScript half is identical to the starter profile: one ESM
 * import, Popper via Bootstrap's own dependency, data-bs-* attributes
 * drive every plugin.
 *
 * Build: npm run build:bootstrap
 * Output: public/build/assets/bootstrap-sass.{css,js}
 */

import '../sass/bootstrap.scss';

import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;
