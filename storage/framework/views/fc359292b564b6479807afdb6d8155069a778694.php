<?php /* sahilphp-compiled:3:ee856a88b704a9fc10f1f9ce6c19fc4c98111a49 template:layouts.app source:/home/jinx/Devs/sahilphp/views/layouts/app.sahil.php */
echo '
<!doctype html>
<html lang="';
echo \Sahil\View\Escaper::html(($__ctx->get('lang') ?? 'en'));
echo '">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>';
echo $__ctx->yieldSection('title', 'SahilPHP');
echo '</title>

    ';
echo '
    ';
echo $__ctx->assetClient();
echo '
    ';
echo $__ctx->assetCss('main', []);
echo '

    ';
echo '
    ';
echo $__ctx->yieldSection('head');
echo '
</head>
<body class="';
echo $__ctx->yieldSection('body_class');
echo '">
    ';
$__ctx->startSection('nav', false);
echo '
        ';
echo $__ctx->include('partials.nav', ['brand' => 'SahilPHP', 'header_class' => 'site-header', 'nav_class' => 'site-nav', 'brand_class' => 'site-brand', 'list_class' => 'site-nav__list', 'link_class' => 'site-nav__link', 'links' => [['label' => 'Home', 'href' => '/'], ['label' => 'UI kit', 'href' => '/ui-kit'], ['label' => 'Health', 'href' => '/health']]]);
echo '
    ';
$__ctx->endSection();
echo '

    ';
echo $__ctx->yieldSection('nav');
echo '

    <main class="';
echo $__ctx->yieldSection('main_class');
echo '">
        ';
echo $__ctx->yieldSection('content');
echo '
    </main>

    ';
$__ctx->startSection('footer', false);
echo '
        <footer class="muted">
            <p>Built with SahilPHP.</p>
        </footer>
    ';
$__ctx->endSection();
echo '

    ';
echo $__ctx->yieldSection('footer');
echo '

    ';
echo '
    ';
echo $__ctx->assetJs('main', []);
echo '
    ';
echo $__ctx->yieldSection('scripts');
echo '
</body>
</html>
';
