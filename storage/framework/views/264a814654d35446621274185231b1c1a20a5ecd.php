<?php /* sahilphp-compiled:3:5773c9efc242d383846d21a7901105e6d69c4352 template:partials.nav source:/home/jinx/Devs/sahilphp/views/partials/nav.sahil.php */
echo '
<header class="';
echo \Sahil\View\Escaper::html(($__ctx->get('header_class') ?? 'site-header'));
echo '">
    <nav class="';
echo \Sahil\View\Escaper::html(($__ctx->get('nav_class') ?? 'site-nav'));
echo '" aria-label="Main navigation">
        <a class="';
echo \Sahil\View\Escaper::html(($__ctx->get('brand_class') ?? 'site-brand'));
echo '" href="';
echo \Sahil\View\Escaper::html(($__ctx->get('home_url') ?? '/'));
echo '">';
echo \Sahil\View\Escaper::html(($__ctx->get('brand') ?? 'SahilPHP'));
echo '</a>

        <ul class="';
echo \Sahil\View\Escaper::html(($__ctx->get('list_class') ?? 'site-nav__list'));
echo '">
            ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('links')) as $__loopValue1):
$__ctx->pushLocal('link', $__loopValue1);
echo '
                <li>
                    <a class="';
echo \Sahil\View\Escaper::html(($__ctx->get('link_class') ?? 'site-nav__link'));
echo '" href="';
echo \Sahil\View\Escaper::html($__ctx->get('link.href'));
echo '"
                        ';
if (($__ctx->get('link.current') ?? false)):
echo ' aria-current="page" ';
endif;
echo '>';
echo \Sahil\View\Escaper::html($__ctx->get('link.label'));
echo '</a>
                </li>
            ';
$__ctx->popLocals(1);
endforeach;
echo '
        </ul>
    </nav>
</header>
';
