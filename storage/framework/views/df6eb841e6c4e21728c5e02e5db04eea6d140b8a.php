<?php /* sahilphp-compiled:3:a15c101d6977833d044e76ae90ccfb3b670b321e template:partials.field source:/home/jinx/Devs/sahilphp/views/partials/field.sahil.php */
echo '
<div class="';
echo \Sahil\View\Escaper::html(($__ctx->get('wrapper_class') ?? 'form-field'));
echo '">
    <label class="';
echo \Sahil\View\Escaper::html(($__ctx->get('label_class') ?? 'form-label'));
echo '" for="';
echo \Sahil\View\Escaper::html($__ctx->get('id'));
echo '">';
echo \Sahil\View\Escaper::html($__ctx->get('label'));
echo '</label>

    <input
        class="';
echo \Sahil\View\Escaper::html(($__ctx->get('input_class') ?? 'input'));
echo ' ';
if (($__ctx->get('error') ?? null)):
echo ' is-invalid ';
endif;
echo '"
        id="';
echo \Sahil\View\Escaper::html($__ctx->get('id'));
echo '"
        name="';
echo \Sahil\View\Escaper::html($__ctx->get('name'));
echo '"
        type="';
echo \Sahil\View\Escaper::html(($__ctx->get('type') ?? 'text'));
echo '"
        value="';
echo \Sahil\View\Escaper::html(($__ctx->get('value') ?? ''));
echo '"
        ';
if (($__ctx->get('required') ?? false)):
echo ' required ';
endif;
echo '
        ';
if (($__ctx->get('placeholder') ?? null)):
echo ' placeholder="';
echo \Sahil\View\Escaper::html($__ctx->get('placeholder'));
echo '" ';
endif;
echo '
        ';
if (($__ctx->get('autocomplete') ?? null)):
echo ' autocomplete="';
echo \Sahil\View\Escaper::html($__ctx->get('autocomplete'));
echo '" ';
endif;
echo '
        ';
if (($__ctx->get('error') ?? null)):
echo ' aria-invalid="true" aria-describedby="';
echo \Sahil\View\Escaper::html($__ctx->get('id'));
echo '-error" ';
endif;
echo '
    >

    ';
if (($__ctx->get('error') ?? null)):
echo '
        <p class="';
echo \Sahil\View\Escaper::html(($__ctx->get('error_class') ?? 'error'));
echo '" id="';
echo \Sahil\View\Escaper::html($__ctx->get('id'));
echo '-error">';
echo \Sahil\View\Escaper::html($__ctx->get('error'));
echo '</p>
    ';
endif;
echo '
</div>
';
