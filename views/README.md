# Views

Templates live here, are compiled to `storage/framework/views/`, and are
never executed directly. The language and its directives are documented in
[`docs/TEMPLATE_LANGUAGE.md`](../docs/TEMPLATE_LANGUAGE.md).

## Example set

- `layouts/app.sahil.php` — shared base layout with asset and page slots;
- `layouts/tailwind.sahil.php`, `layouts/bootstrap.sahil.php`,
  `layouts/plain.sahil.php` — sample shells for each UI profile;
- `partials/nav.sahil.php` — shared navigation that accepts framework class
  names as data;
- `partials/field.sahil.php`, `partials/select.sahil.php`,
  `partials/alert.sahil.php`, `partials/table.sahil.php` — reusable
  components with escaped values;
- `partials/post-meta.sahil.php` — the original small partial;
- `pages/home.sahil.php` — the home page, using inheritance, sections,
  loops, conditionals and partials;
- `examples/tailwind.sahil.php`, `examples/bootstrap.sahil.php`,
  `examples/plain.sahil.php` — forms, validation errors, alerts, tables,
  navigation and responsive layouts for each profile.

`GET /ui-kit` renders the example page that matches the active UI profile.

## Assets

Use the runtime helpers rather than hard-coded URLs:

```php
@asset_client
@asset_css('main')
@asset_js('main')
```

Page-specific files go in the layout's `head` and `scripts` sections:

```php
@extends('layouts.tailwind')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/ui-kit.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/ui-kit.js') }}" defer></script>
@endsection
```

See [`docs/VIEW_ASSETS.md`](../docs/VIEW_ASSETS.md) for profile selection,
configuration, escaping and the full helper reference.

The optional theme layer (`php bin/sahil ui:theme`) changes the neutral
`--sahil-*` variables used by the plain layout and by generated framework
mappings. Application overrides belong in `resources/css/theme.overrides.css`;
see [`docs/THEMING.md`](../docs/THEMING.md).

Add template directories by adding them to `view.paths` in
`config/view.php`; the first directory that contains a template wins, so an
application can override a package's template by ordering its own directory
first.
