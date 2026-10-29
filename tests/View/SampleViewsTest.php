<?php

declare(strict_types=1);

namespace Tests\View;

use PHPUnit\Framework\TestCase;
use Sahil\Assets\AssetManager;
use Sahil\View\TemplateCompiler;
use Sahil\View\TemplateResolver;
use Sahil\View\ViewEngine;
use Tests\Support\TempViews;

/**
 * Renders the real sample layouts and pages against each profile.
 */
final class SampleViewsTest extends TestCase
{
    use TempViews;

    public function test_tailwind_sample_references_only_existing_tailwind_assets(): void
    {
        $html = $this->renderSample('tailwind', 'examples.tailwind');

        self::assertStringContainsString('href="/build/assets/tailwind.css"', $html);
        self::assertStringContainsString('href="/css/ui-kit.css"', $html);
        self::assertStringContainsString('src="/js/ui-kit.js"', $html);
        self::assertStringContainsString('Form and validation', $html);
        self::assertStringContainsString('Name is required.', $html);
        self::assertStringContainsString('Saved', $html);
        self::assertStringContainsString('Responsive table', $html);
        self::assertStringContainsString('Ada Lovelace', $html);
        self::assertStringContainsString('Main navigation', $html);
        self::assertStringNotContainsString('bootstrap.css', $html);
        self::assertStringNotContainsString('bootstrap.js', $html);
        self::assertStringNotContainsString('@vite/client', $html);
    }

    public function test_bootstrap_sample_references_only_existing_bootstrap_assets(): void
    {
        $html = $this->renderSample('bootstrap', 'examples.bootstrap');

        self::assertStringContainsString('href="/build/assets/bootstrap.css"', $html);
        self::assertStringContainsString('src="/build/assets/bootstrap.js"', $html);
        self::assertStringContainsString('href="/css/ui-kit.css"', $html);
        self::assertStringContainsString('src="/js/ui-kit.js"', $html);
        self::assertStringContainsString('form-control', $html);
        self::assertStringContainsString('alert alert-success', $html);
        self::assertStringContainsString('table-responsive', $html);
        self::assertStringNotContainsString('tailwind.css', $html);
        self::assertStringNotContainsString('@vite/client', $html);
    }

    public function test_plain_sample_references_only_the_generated_app_css(): void
    {
        $html = $this->renderSample('none', 'examples.plain');

        self::assertStringContainsString('href="/build/assets/app.css"', $html);
        self::assertStringContainsString('href="/css/ui-kit.css"', $html);
        self::assertStringContainsString('src="/js/ui-kit.js"', $html);
        self::assertStringContainsString('class="input', $html);
        self::assertStringContainsString('class="alert alert--success"', $html);
        self::assertStringContainsString('class="table"', $html);
        self::assertStringNotContainsString('bootstrap.css', $html);
        self::assertStringNotContainsString('tailwind.css', $html);
    }

    public function test_root_views_directory_is_not_referenced(): void
    {
        $root = dirname(__DIR__, 2);

        // The root-level `views/` directory must not exist; only
        // `resources/views/` is the configured view directory.
        self::assertDirectoryDoesNotExist($root.'/views', 'A root-level views/ directory must not ship in the starter kit.');

        // No non-vendor source file may reference a root-level `views/` path.
        $forbidden = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $path = $item->getPathname();
            $relative = str_replace($root.DIRECTORY_SEPARATOR, '', $path);

            if ($item->isDir()) {
                continue;
            }

            if (str_contains($relative, '/vendor/')
                || str_contains($relative, '/node_modules/')
                || str_contains($relative, '/.git/')
                || str_ends_with($relative, '.lock')
                || str_ends_with($relative, '.cache')
                || str_ends_with($relative, '.log')
            ) {
                continue;
            }

            if (!$item->isFile() || !is_readable($path)) {
                continue;
            }

            $content = file_get_contents($path);

            if ($content === false) {
                continue;
            }

            // Matches path-style references to a root-level views/ directory
            // (e.g. 'views', "views", views/, base_path('views')) while
            // allowing the canonical resources/views and storage/framework/views.
            if (preg_match("/(?:^|[^A-Za-z0-9_\/])views\/(?!resources\/)/", $content)
                || preg_match("/['\"]views['\"]/", $content)
            ) {
                $forbidden[] = $relative;
            }
        }

        self::assertEmpty($forbidden, sprintf(
            'Root-level views/ directory referenced in: %s',
            implode(', ', $forbidden)
        ));
    }

    public function test_both_sample_emits_both_selected_frameworks_once(): void
    {
        $html = $this->renderSample('both', 'examples.tailwind');

        self::assertSame(1, substr_count($html, 'href="/build/assets/tailwind.css"'));
        self::assertSame(1, substr_count($html, 'href="/build/assets/bootstrap.css"'));
        self::assertSame(1, substr_count($html, 'src="/build/assets/bootstrap.js"'));
        self::assertStringNotContainsString('@vite/client', $html);
    }

    private function renderSample(string $profile, string $view): string
    {
        $workspace = $this->workspace();
        $workspace->write('placeholder', 'unused');

        $root = dirname(__DIR__, 2);
        $outputs = match ($profile) {
            'tailwind' => ['public/build/assets/tailwind.css'],
            'bootstrap' => ['public/build/assets/bootstrap.css', 'public/build/assets/bootstrap.js'],
            'both' => [
                'public/build/assets/tailwind.css',
                'public/build/assets/bootstrap.css',
                'public/build/assets/bootstrap.js',
            ],
            default => ['public/build/assets/app.css'],
        };

        foreach ($outputs as $output) {
            $path = $workspace->base().'/'.$output;

            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0o777, true);
            }

            file_put_contents($path, $profile);

            self::assertFileExists($path);
        }

        $assets = new AssetManager($workspace->base(), $profile, 'production');
        $engine = new ViewEngine(
            new TemplateResolver([$root.'/resources/views']),
            new TemplateCompiler($workspace->cache()),
            $assets,
        );

        return $engine->render($view, $this->sampleData());
    }

    /**
     * @return array<string, mixed>
     */
    private function sampleData(): array
    {
        return [
            'heading' => 'A functional UI page',
            'intro' => 'Shared layouts, navigation and components.',
            'profile_label' => 'Sample profile',
            'form' => [
                'name' => 'Ada',
                'email' => 'ada@example.com',
                'role' => 'editor',
                'notes' => 'Sample note',
            ],
            'errors' => [
                'name' => 'Name is required.',
                'email' => 'Enter a valid email address.',
            ],
            'roles' => [
                'admin' => 'Administrator',
                'editor' => 'Editor',
            ],
            'alerts' => [
                ['type' => 'success', 'title' => 'Saved', 'message' => 'Everything worked.'],
                ['type' => 'warning', 'title' => 'Review', 'message' => 'Check the form.'],
                ['type' => 'danger', 'title' => 'Failed', 'message' => 'Try again.'],
            ],
            'users' => [
                ['Ada Lovelace', 'ada@example.com', 'Editor', 'Active'],
            ],
        ];
    }
}
