<?php /* sahilphp-compiled:3:396a91cc07ad3dd56202028603a910a197dcd5d2 template:layouts.tailwind source:/home/jinx/Devs/sahilphp/views/layouts/tailwind.sahil.php */
echo '
';
$__ctx->extend('layouts.app');
echo '

';
$__ctx->startSection('body_class', false);
echo 'bg-slate-50 text-slate-900 antialiased';
$__ctx->endSection();
echo '

';
$__ctx->startSection('nav', false);
echo '
    ';
echo $__ctx->include('partials.nav', ['brand' => 'SahilPHP', 'header_class' => 'border-b border-slate-200 bg-white', 'nav_class' => 'mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4', 'brand_class' => 'text-lg font-semibold tracking-tight text-slate-900', 'list_class' => 'flex flex-wrap items-center gap-5', 'link_class' => 'text-sm font-medium text-slate-600 hover:text-slate-950', 'links' => [['label' => 'Home', 'href' => '/'], ['label' => 'UI kit', 'href' => '/ui-kit'], ['label' => 'Health', 'href' => '/health']]]);
echo '
';
$__ctx->endSection();
echo '

';
$__ctx->startSection('main_class', false);
echo 'mx-auto w-full max-w-6xl px-4 py-10';
$__ctx->endSection();
echo '

';
$__ctx->startSection('footer', false);
echo '
    <footer class="mx-auto max-w-6xl border-t border-slate-200 px-4 py-6 text-sm text-slate-500">
        <p>Tailwind CSS v4 layout · Built with SahilPHP.</p>
    </footer>
';
$__ctx->endSection();
echo '
';
