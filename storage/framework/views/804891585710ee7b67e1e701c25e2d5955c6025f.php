<?php /* sahilphp-compiled:3:cf361724d355cff699de4b886faf630bbf2ddefa template:examples.tailwind source:/home/jinx/Devs/sahilphp/views/examples/tailwind.sahil.php */
echo '
';
$__ctx->extend('layouts.tailwind');
echo '

';
$__ctx->startSection('title', false);
echo 'UI components · SahilPHP';
$__ctx->endSection();
echo '

';
$__ctx->startSection('head', false);
echo '
    <link rel="stylesheet" href="';
echo \Sahil\View\Escaper::html($__ctx->asset('css/ui-kit.css'));
echo '">
';
$__ctx->endSection();
echo '

';
$__ctx->startSection('content', false);
echo '
    <div class="space-y-8">
        <header class="space-y-2">
            <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">';
echo \Sahil\View\Escaper::html($__ctx->get('profile_label'));
echo '</p>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">';
echo \Sahil\View\Escaper::html($__ctx->get('heading'));
echo '</h1>
            <p class="max-w-3xl text-slate-600">';
echo \Sahil\View\Escaper::html($__ctx->get('intro'));
echo '</p>
        </header>

        <div class="grid gap-6 lg:grid-cols-3">
            <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
                <h2 class="text-xl font-semibold text-slate-900">Form and validation</h2>
                <p class="mt-1 text-sm text-slate-500">
                    The field and select components are shared partials; only the class names change per profile.
                </p>

                <form class="mt-6 grid gap-5 sm:grid-cols-2" method="get" action="/ui-kit">
                    ';
echo $__ctx->include('partials.field', ['id' => 'name', 'name' => 'name', 'label' => 'Name', 'value' => $__ctx->get('form.name'), 'error' => $__ctx->get('errors.name'), 'required' => true, 'autocomplete' => 'name', 'input_class' => ($__ctx->get('errors.name') ? 'w-full rounded-lg border border-red-400 bg-white px-3 py-2 text-slate-900 focus:border-red-500 focus:outline-none' : 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none'), 'label_class' => 'text-sm font-semibold text-slate-800', 'error_class' => 'text-sm text-red-700']);
echo '

                    ';
echo $__ctx->include('partials.field', ['id' => 'email', 'name' => 'email', 'type' => 'email', 'label' => 'Email', 'value' => $__ctx->get('form.email'), 'error' => $__ctx->get('errors.email'), 'required' => true, 'autocomplete' => 'email', 'input_class' => ($__ctx->get('errors.email') ? 'w-full rounded-lg border border-red-400 bg-white px-3 py-2 text-slate-900 focus:border-red-500 focus:outline-none' : 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none'), 'label_class' => 'text-sm font-semibold text-slate-800', 'error_class' => 'text-sm text-red-700']);
echo '

                    ';
echo $__ctx->include('partials.select', ['id' => 'role', 'name' => 'role', 'label' => 'Role', 'selected' => $__ctx->get('form.role'), 'options' => $__ctx->get('roles'), 'select_class' => 'w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none', 'label_class' => 'text-sm font-semibold text-slate-800']);
echo '

                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="text-sm font-semibold text-slate-800" for="notes">Notes</label>
                        <textarea class="min-h-24 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 focus:border-indigo-500 focus:outline-none" id="notes" name="notes">';
echo \Sahil\View\Escaper::html($__ctx->get('form.notes'));
echo '</textarea>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 sm:col-span-2">
                        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700" type="submit">Save changes</button>
                        <a class="text-sm font-semibold text-slate-600 hover:text-slate-950" href="/ui-kit">Reset</a>
                    </div>
                </form>
            </section>

            <aside class="space-y-4">
                <h2 class="text-xl font-semibold text-slate-900">Alerts</h2>

                ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('alerts')) as $__loopValue1):
$__ctx->pushLocal('alert', $__loopValue1);
echo '
                    ';
echo $__ctx->include('partials.alert', ['class' => (($__ctx->get('alert.type') == 'success') ? 'rounded-lg border border-green-200 bg-green-50 p-4 text-green-950' : ((($__ctx->get('alert.type') == 'danger') ? 'rounded-lg border border-red-200 bg-red-50 p-4 text-red-950' : 'rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-950'))), 'title' => $__ctx->get('alert.title'), 'message' => $__ctx->get('alert.message'), 'title_class' => 'text-sm font-semibold', 'message_class' => 'mt-1 text-sm']);
echo '
                ';
$__ctx->popLocals(1);
endforeach;
echo '

                <div class="demo-note">
                    <strong>Page-specific asset:</strong> this note is styled by
                    <code>public/css/ui-kit.css</code>, included through the page\'s
                    <code>head</code> section.
                </div>
            </aside>
        </div>

        <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-slate-900">Responsive table</h2>
                <span class="text-xs text-slate-500" data-ui-kit-js>Page-specific JavaScript is loading…</span>
            </div>

            ';
echo $__ctx->include('partials.table', ['headers' => ['Name', 'Email', 'Role', 'Status'], 'rows' => $__ctx->get('users'), 'wrapper_class' => 'mt-4 overflow-x-auto', 'table_class' => 'min-w-full divide-y divide-slate-200 text-left text-sm', 'empty_message' => 'No users yet.']);
echo '
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
';
$__ctx->endSection();
echo '

';
$__ctx->startSection('scripts', false);
echo '
    <script src="';
echo \Sahil\View\Escaper::html($__ctx->asset('js/ui-kit.js'));
echo '" defer></script>
';
$__ctx->endSection();
echo '
';
