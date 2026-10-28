{{-- Tailwind CSS v4 example: forms, validation, alerts, table, navigation and responsive grids. --}}
@extends('layouts.tailwind')

@section('title')UI components · SahilPHP@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/ui-kit.css') }}">
@endsection

@section('content')
    <div class="space-y-8">
        <header class="space-y-2">
            <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">{{ profile_label }}</p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">{{ heading }}</h1>
            <p class="max-w-3xl text-slate-600">{{ intro }}</p>
        </header>

        <div class="grid gap-6 lg:grid-cols-3">
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
                <h2 class="text-xl font-semibold text-slate-900">Form and validation</h2>
                <p class="mt-1 text-sm text-slate-500">
                    The field and select components are shared partials; only the class names change per profile.
                </p>

                <form class="mt-6 grid gap-5 sm:grid-cols-2" method="get" action="/ui-kit">
                    @include('partials.field', [
                        'id' => 'name',
                        'name' => 'name',
                        'label' => 'Name',
                        'value' => form.name,
                        'error' => errors.name,
                        'required' => true,
                        'autocomplete' => 'name',
                        'input_class' => errors.name ? 'w-full rounded-lg border border-red-400 bg-white px-3 py-2 text-slate-900 focus:border-red-500 focus:outline-none' : 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none',
                        'label_class' => 'text-sm font-semibold text-slate-800',
                        'error_class' => 'text-sm text-red-700',
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
                        'input_class' => errors.email ? 'w-full rounded-lg border border-red-400 bg-white px-3 py-2 text-slate-900 focus:border-red-500 focus:outline-none' : 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none',
                        'label_class' => 'text-sm font-semibold text-slate-800',
                        'error_class' => 'text-sm text-red-700',
                    ])

                    @include('partials.select', [
                        'id' => 'role',
                        'name' => 'role',
                        'label' => 'Role',
                        'selected' => form.role,
                        'options' => roles,
                        'select_class' => 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none',
                        'label_class' => 'text-sm font-semibold text-slate-800',
                    ])

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-sm font-semibold text-slate-800" for="notes">Notes</label>
                        <textarea class="min-h-24 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none" id="notes" name="notes">{{ form.notes }}</textarea>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 sm:col-span-2">
                        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700" type="submit">Save changes</button>
                        <a class="text-sm font-semibold text-slate-600 hover:text-slate-950" href="/ui-kit">Reset</a>
                    </div>
                </form>
            </section>

            <aside class="space-y-4">
                <h2 class="text-xl font-semibold text-slate-900">Alerts</h2>

                @foreach (alerts as alert)
                    @include('partials.alert', [
                        'class' => alert.type == 'success' ? 'rounded-lg border border-green-200 bg-green-50 p-4 text-green-950' : (alert.type == 'danger' ? 'rounded-lg border border-red-200 bg-red-50 p-4 text-red-950' : 'rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-950'),
                        'title' => alert.title,
                        'message' => alert.message,
                        'title_class' => 'text-sm font-semibold',
                        'message_class' => 'mt-1 text-sm',
                    ])
                @endforeach

                <div class="demo-note">
                    <strong>Page-specific asset:</strong> this note is styled by
                    <code>public/css/ui-kit.css</code>, included through the page's
                    <code>head</code> section.
                </div>
            </aside>
        </div>

        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-slate-900">Responsive table</h2>
                <span class="text-xs text-slate-500" data-ui-kit-js>Page-specific JavaScript is loading…</span>
            </div>

            @include('partials.table', [
                'headers' => ['Name', 'Email', 'Role', 'Status'],
                'rows' => users,
                'wrapper_class' => 'mt-4 overflow-x-auto',
                'table_class' => 'min-w-full divide-y divide-slate-200 text-left text-sm',
                'empty_message' => 'No users yet.',
            ])
        </section>

        <section class="space-y-4">
            <h2 class="text-xl font-semibold text-slate-900">Responsive layout</h2>
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-semibold text-slate-900">Mobile first</h3>
                    <p class="mt-2 text-sm text-slate-600">One column by default, then two and three columns as space allows.</p>
                </article>
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-semibold text-slate-900">Fluid content</h3>
                    <p class="mt-2 text-sm text-slate-600">The page container caps the line length on large screens.</p>
                </article>
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="font-semibold text-slate-900">Accessible labels</h3>
                    <p class="mt-2 text-sm text-slate-600">Inputs are associated with labels and error descriptions.</p>
                </article>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ui-kit.js') }}" defer></script>
@endsection
