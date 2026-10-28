<?php /* sahilphp-compiled:3:c23b9849d6c88b3d171094aa6f928b2311db227c template:examples.bootstrap source:/home/jinx/Devs/sahilphp/views/examples/bootstrap.sahil.php */
echo '
';
$__ctx->extend('layouts.bootstrap');
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
    <div class="mb-4">
        <span class="badge text-bg-primary mb-2">';
echo \Sahil\View\Escaper::html($__ctx->get('profile_label'));
echo '</span>
        <h1 class="display-6 fw-bold">';
echo \Sahil\View\Escaper::html($__ctx->get('heading'));
echo '</h1>
        <p class="lead text-secondary mb-0">';
echo \Sahil\View\Escaper::html($__ctx->get('intro'));
echo '</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <section class="card shadow-sm h-100">
                <div class="card-body">
                    <h2 class="h4">Form and validation</h2>
                    <p class="text-secondary small">
                        The field and select components are shared partials; only the class names change per profile.
                    </p>

                    <form class="row g-3 mt-1" method="get" action="/ui-kit">
                        ';
echo $__ctx->include('partials.field', ['id' => 'name', 'name' => 'name', 'label' => 'Name', 'value' => $__ctx->get('form.name'), 'error' => $__ctx->get('errors.name'), 'required' => true, 'autocomplete' => 'name', 'wrapper_class' => 'col-md-6', 'label_class' => 'form-label', 'input_class' => 'form-control', 'error_class' => 'invalid-feedback d-block']);
echo '

                        ';
echo $__ctx->include('partials.field', ['id' => 'email', 'name' => 'email', 'type' => 'email', 'label' => 'Email', 'value' => $__ctx->get('form.email'), 'error' => $__ctx->get('errors.email'), 'required' => true, 'autocomplete' => 'email', 'wrapper_class' => 'col-md-6', 'label_class' => 'form-label', 'input_class' => 'form-control', 'error_class' => 'invalid-feedback d-block']);
echo '

                        ';
echo $__ctx->include('partials.select', ['id' => 'role', 'name' => 'role', 'label' => 'Role', 'selected' => $__ctx->get('form.role'), 'options' => $__ctx->get('roles'), 'wrapper_class' => 'col-md-6', 'label_class' => 'form-label', 'select_class' => 'form-select', 'error_class' => 'invalid-feedback d-block']);
echo '

                        <div class="col-12">
                            <label class="form-label" for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">';
echo \Sahil\View\Escaper::html($__ctx->get('form.notes'));
echo '</textarea>
                        </div>

                        <div class="col-12 d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a class="btn btn-link px-0" href="/ui-kit">Reset</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-lg-4">
            <div class="d-grid gap-3">
                <h2 class="h4 mb-0">Alerts</h2>

                ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('alerts')) as $__loopValue1):
$__ctx->pushLocal('alert', $__loopValue1);
echo '
                    ';
echo $__ctx->include('partials.alert', ['class' => (($__ctx->get('alert.type') == 'success') ? 'alert alert-success' : ((($__ctx->get('alert.type') == 'danger') ? 'alert alert-danger' : 'alert alert-warning'))), 'title' => $__ctx->get('alert.title'), 'message' => $__ctx->get('alert.message'), 'title_class' => 'alert-heading h6', 'message_class' => 'mb-0 small']);
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
            </div>
        </div>
    </div>

    <section class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                <h2 class="h4 mb-0">Responsive table</h2>
                <span class="text-secondary small" data-ui-kit-js>Page-specific JavaScript is loading…</span>
            </div>

            ';
echo $__ctx->include('partials.table', ['headers' => ['Name', 'Email', 'Role', 'Status'], 'rows' => $__ctx->get('users'), 'wrapper_class' => 'table-responsive mt-3', 'table_class' => 'table table-striped table-hover align-middle mb-0', 'empty_message' => 'No users yet.']);
echo '
        </div>
    </section>

    <section class="mt-5">
        <h2 class="h4">Responsive layout</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mt-1">
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="h6 card-title">Mobile first</h3>
                        <p class="card-text text-secondary small">One column by default, then two and three columns as space allows.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="h6 card-title">Fluid content</h3>
                        <p class="card-text text-secondary small">The page container caps the line length on large screens.</p>
                    </div>
                </article>
            </div>
            <div class="col">
                <article class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="h6 card-title">Accessible labels</h3>
                        <p class="card-text text-secondary small">Inputs are associated with labels and error descriptions.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
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
