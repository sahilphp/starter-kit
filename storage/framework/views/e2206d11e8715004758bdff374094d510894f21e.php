<?php /* sahilphp-compiled:3:23afdb8df85f1aef3d86b30e92891f67f36a3192 template:layouts.bootstrap source:/home/jinx/Devs/sahilphp/views/layouts/bootstrap.sahil.php */
echo '
';
$__ctx->extend('layouts.app');
echo '

';
$__ctx->startSection('body_class', false);
echo 'bg-light';
$__ctx->endSection();
echo '

';
$__ctx->startSection('nav', false);
echo '
    ';
echo $__ctx->include('partials.nav', ['brand' => 'SahilPHP', 'header_class' => 'bg-white border-bottom', 'nav_class' => 'navbar navbar-expand-lg navbar-light bg-white container', 'brand_class' => 'navbar-brand fw-bold', 'list_class' => 'navbar-nav ms-auto mb-2 mb-lg-0', 'link_class' => 'nav-link', 'links' => [['label' => 'Home', 'href' => '/'], ['label' => 'UI kit', 'href' => '/ui-kit'], ['label' => 'Health', 'href' => '/health']]]);
echo '
';
$__ctx->endSection();
echo '

';
$__ctx->startSection('main_class', false);
echo 'container py-5';
$__ctx->endSection();
echo '

';
$__ctx->startSection('footer', false);
echo '
    <footer class="border-top bg-white py-3 mt-5">
        <div class="container text-muted small">
            Bootstrap 5 layout · Built with SahilPHP.
        </div>
    </footer>
';
$__ctx->endSection();
echo '
';
