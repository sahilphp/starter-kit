<?php /* sahilphp-compiled:57215ca2d22074b8e2da8bb6514f525ea4c14c35 template:partials.post-meta source:/home/jinx/Devs/sahilphp/views/partials/post-meta.sahil.php */
echo '
<p class="meta">
    ';
if ($__ctx->get('post.author')):
echo '
        by ';
echo \Sahil\View\Escaper::html($__ctx->get('post.author'));
echo '
    ';
else:
echo '
        by unknown
    ';
endif;
echo '

    ';
if ($__ctx->get('post.published')):
echo '
        · published
    ';
else:
echo '
        · draft
    ';
endif;
echo '
</p>
';
