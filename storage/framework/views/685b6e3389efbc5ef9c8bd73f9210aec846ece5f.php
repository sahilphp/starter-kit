<?php /* sahilphp-compiled:3:1a0c940fee24726583c0d6b399659a10610c434c template:pages.home source:/home/jinx/Devs/sahilphp/views/pages/home.sahil.php */
$__ctx->extend('layouts.app');
echo '

';
$__ctx->startSection('title', false);
echo '
    ';
echo \Sahil\View\Escaper::html(($__ctx->get('title') ?? 'SahilPHP'));
echo '
';
$__ctx->endSection();
echo '

';
$__ctx->startSection('content', false);
echo '
    <h1>';
echo \Sahil\View\Escaper::html($__ctx->get('heading'));
echo '</h1>

    ';
if (\Sahil\View\ViewHelpers::isEmpty($__ctx->get('posts'))):
echo '
        <p>No posts yet.</p>
    ';
else:
echo '
        <ul>
            ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('posts')) as $__loopKey1 => $__loopValue1):
$__ctx->pushLocal('post', $__loopValue1);
$__ctx->pushLocal('index', $__loopKey1);
echo '
                <li>
                    <a href="/posts/';
echo \Sahil\View\Escaper::html($__ctx->get('post.slug'));
echo '">';
echo \Sahil\View\Escaper::html($__ctx->get('post.title'));
echo '</a>
                    ';
echo $__ctx->include('partials.post-meta', ['post' => $__ctx->get('post')]);
echo '
                    <small>#';
echo \Sahil\View\Escaper::html($__ctx->get('index'));
echo '</small>
                </li>
            ';
$__ctx->popLocals(2);
endforeach;
echo '
        </ul>

        <p>';
echo \Sahil\View\Escaper::html(\Sahil\View\ViewHelpers::count($__ctx->get('posts')));
echo ' post(s).</p>
    ';
endif;
echo '

    ';
echo '
    ';
echo \Sahil\View\Escaper::raw($__ctx->get('attribution'));
echo '
';
$__ctx->endSection();
echo '

';
$__ctx->startSection('footer', false);
echo '
    ';
$__ctx->requireParent();
echo '
    <p>Rendered ';
echo \Sahil\View\Escaper::html($__ctx->get('rendered_at'));
echo '.</p>
';
$__ctx->endSection();
echo '
';
