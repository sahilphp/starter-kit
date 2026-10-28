<?php /* sahilphp-compiled:3:cab2b9d491572513dd95d21ba7cff57b13b02e0c template:partials.table source:/home/jinx/Devs/sahilphp/views/partials/table.sahil.php */
echo '
<div class="';
echo \Sahil\View\Escaper::html(($__ctx->get('wrapper_class') ?? 'table-wrap'));
echo '">
    <table class="';
echo \Sahil\View\Escaper::html(($__ctx->get('table_class') ?? 'table'));
echo '">
        <thead>
            <tr>
                ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('headers')) as $__loopValue1):
$__ctx->pushLocal('header', $__loopValue1);
echo '
                    <th scope="col">';
echo \Sahil\View\Escaper::html($__ctx->get('header'));
echo '</th>
                ';
$__ctx->popLocals(1);
endforeach;
echo '
            </tr>
        </thead>
        <tbody>
            ';
if (\Sahil\View\ViewHelpers::isEmpty($__ctx->get('rows'))):
echo '
                <tr>
                    <td colspan="';
echo \Sahil\View\Escaper::html(\Sahil\View\ViewHelpers::count($__ctx->get('headers')));
echo '">';
echo \Sahil\View\Escaper::html(($__ctx->get('empty_message') ?? 'No records.'));
echo '</td>
                </tr>
            ';
else:
echo '
                ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('rows')) as $__loopValue2):
$__ctx->pushLocal('row', $__loopValue2);
echo '
                    <tr>
                        ';
foreach (\Sahil\View\ViewHelpers::iterate($__ctx->get('row')) as $__loopValue3):
$__ctx->pushLocal('cell', $__loopValue3);
echo '
                            <td>';
echo \Sahil\View\Escaper::html($__ctx->get('cell'));
echo '</td>
                        ';
$__ctx->popLocals(1);
endforeach;
echo '
                    </tr>
                ';
$__ctx->popLocals(1);
endforeach;
echo '
            ';
endif;
echo '
        </tbody>
    </table>
</div>
';
