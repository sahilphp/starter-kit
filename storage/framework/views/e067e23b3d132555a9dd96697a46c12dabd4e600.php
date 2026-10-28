<?php /* sahilphp-compiled:3:b3aa3bd64aecd8b4f97b0531265cd34e5c90bdff template:partials.select source:/home/jinx/Devs/sahilphp/views/partials/select.sahil.php */
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

    <select
        class="';
echo \Sahil\View\Escaper::html(($__ctx->get('select_class') ?? 'select'));
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
        ';
if (($__ctx->get('required') ?? false)):
echo ' required ';
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
if (($__ctx->get('placeholder') ?? null)):
echo '
            <option value="">';
echo \Sahil\View\Escaper::html($__ctx->get('placeholder'));
echo '</option>
        ';
endif;
echo '

        ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('options')) as $__loopKey1 => $__loopValue1):
$__ctx->pushLocal('label', $__loopValue1);
$__ctx->pushLocal('value', $__loopKey1);
echo '
            <option value="';
echo \Sahil\View\Escaper::html($__ctx->get('value'));
echo '" ';
if (($__ctx->get('value') == (($__ctx->get('selected') ?? '')))):
echo ' selected ';
endif;
echo '>';
echo \Sahil\View\Escaper::html($__ctx->get('label'));
echo '</option>
        ';
$__ctx->popLocals(2);
endforeach;
echo '
    </select>

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
