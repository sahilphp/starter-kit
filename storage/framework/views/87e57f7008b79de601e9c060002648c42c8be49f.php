<?php /* sahilphp-compiled:3:9fe5aaeb03021513c5d1d99dcfbdbb292b4a9157 template:partials.alert source:/home/jinx/Devs/sahilphp/views/partials/alert.sahil.php */
echo '
<div class="';
echo \Sahil\View\Escaper::html(($__ctx->get('class') ?? 'alert'));
echo '" role="alert">
    ';
if (($__ctx->get('title') ?? null)):
echo '
        <p class="';
echo \Sahil\View\Escaper::html(($__ctx->get('title_class') ?? ''));
echo '"><strong>';
echo \Sahil\View\Escaper::html($__ctx->get('title'));
echo '</strong></p>
    ';
endif;
echo '

    <p class="';
echo \Sahil\View\Escaper::html(($__ctx->get('message_class') ?? ''));
echo '">';
echo \Sahil\View\Escaper::html($__ctx->get('message'));
echo '</p>
</div>
';
