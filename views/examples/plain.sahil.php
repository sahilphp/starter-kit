{{-- Plain CSS example: forms, validation, alerts, table, navigation and responsive grids. --}}
@extends('layouts.plain')

@section('title')UI components · SahilPHP@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/ui-kit.css') }}">
@endsection

@section('content')
    <header class="page-header">
        <p class="muted"><strong>{{ profile_label }}</strong></p>
        <h1>{{ heading }}</h1>
        <p class="muted">{{ intro }}</p>
    </header>

    <div class="grid">
        <section class="card">
            <h2>Form and validation</h2>
            <p class="muted">
                The field and select components are shared partials; only the class names change per profile.
            </p>

            <form class="form-grid" method="get" action="/ui-kit">
                @include('partials.field', [
                    'id' => 'name',
                    'name' => 'name',
                    'label' => 'Name',
                    'value' => form.name,
                    'error' => errors.name,
                    'required' => true,
                    'autocomplete' => 'name',
                    'wrapper_class' => 'form-field',
                    'label_class' => 'form-label',
                    'input_class' => 'input',
                    'error_class' => 'error',
                ])

                @include('partials.field', [
                    'id' => 'email',
                    'name' => 'email',
                    'type' => 'email',
                    'label' => 'Email',
                    'value' => form.email,
                    'error' => errors.email,
                    'required' => true,
                    'autocomplete' => 'email',
                    'wrapper_class' => 'form-field',
                    'label_class' => 'form-label',
                    'input_class' => 'input',
                    'error_class' => 'error',
                ])

                @include('partials.select', [
                    'id' => 'role',
                    'name' => 'role',
                    'label' => 'Role',
                    'selected' => form.role,
                    'options' => roles,
                    'wrapper_class' => 'form-field',
                    'label_class' => 'form-label',
                    'select_class' => 'select',
                    'error_class' => 'error',
                ])

                <div class="form-field">
                    <label class="form-label" for="notes">Notes</label>
                    <textarea class="input" id="notes" name="notes" rows="3">{{ form.notes }}</textarea>
                </div>

                <div class="form-field" style="grid-column: 1 / -1">
                    <div class="stack">
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center">
                            <button class="btn btn--primary" type="submit">Save changes</button>
                            <a class="btn btn--secondary" href="/ui-kit">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <aside class="stack">
            <h2>Alerts</h2>

            @foreach (alerts as alert)
                @include('partials.alert', [
                    'class' => alert.type == 'success' ? 'alert alert--success' : (alert.type == 'danger' ? 'alert alert--danger' : 'alert alert--warning'),
                    'title' => alert.title,
                    'message' => alert.message,
                    'title_class' => 'alert__title',
                    'message_class' => 'alert__message',
                ])
            @endforeach

            <div class="demo-note">
                <strong>Page-specific asset:</strong> this note is styled by
                <code>public/css/ui-kit.css</code>, included through the page's
                <code>head</code> section.
            </div>
        </aside>
    </div>

    <section class="card" style="margin-top: 1.5rem">
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem">
            <h2 style="margin: 0">Responsive table</h2>
            <span class="muted" data-ui-kit-js>Page-specific JavaScript is loading…</span>
        </div>

        @include('partials.table', [
            'headers' => ['Name', 'Email', 'Role', 'Status'],
            'rows' => users,
            'wrapper_class' => 'table-wrap',
            'table_class' => 'table',
            'empty_message' => 'No users yet.',
        ])
    </section>

    <section style="margin-top: 1.5rem">
        <h2>Responsive layout</h2>
        <div class="grid">
            <article class="card">
                <h3>Mobile first</h3>
                <p class="muted">One column by default, expanding automatically as space allows.</p>
            </article>
            <article class="card">
                <h3>Fluid content</h3>
                <p class="muted">The page container caps the line length on large screens.</p>
            </article>
            <article class="card">
                <h3>Accessible labels</h3>
                <p class="muted">Inputs are associated with labels and error descriptions.</p>
            </article>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/ui-kit.js') }}" defer></script>
@endsection
