<?php

declare(strict_types=1);

namespace App\Http;

use Sahil\Contracts\View\ViewContract;
use Sahil\Http\Response;

/**
 * Renders the example home page (`views/pages/home.sahil.php`).
 *
 * This is the whole view API in one method: hand the engine a template name
 * and the data the template may read, and send the markup back. The template
 * cannot reach anything that is not in `$data`, and every value it
 * interpolates is escaped unless the template explicitly opts out.
 *
 * Post titles and authors here are the kind of strings a real application
 * gets from users — the second one proves the point: it is stored with markup
 * in it and still renders inert.
 */
final class HomeController
{
    public function __construct(
        private readonly ViewContract $views,
        private readonly ApplicationContract $application,
    ) {
    }

    public function response(): Response
    {
        return Response::html($this->views->render('pages.home', [
            'app_name' => (string) $this->application->config()->get('app.name', 'SahilPHP'),
            'title' => 'Welcome',
            'heading' => 'SahilPHP templates',
            'posts' => [
                [
                    'slug' => 'hello-views',
                    'title' => 'Layouts, sections and partials',
                    'author' => 'Sahil',
                    'published' => true,
                ],
                [
                    'slug' => 'escaped-by-default',
                    'title' => 'Tips <script>alert(1)</script> & tricks',
                    'author' => null,
                    'published' => false,
                ],
            ],
            'attribution' => '<p>Markup passed in by the controller; emitted with {!! !!}.</p>',
            'rendered_at' => gmdate('c'),
        ]));
    }
}
