<?php

declare(strict_types=1);

namespace Tests\Console;

use PHPUnit\Framework\TestCase;

/**
 * `make:auth` writes the authentication pages for the installed UI profile.
 *
 * Every test runs the real CLI against a temporary project directory, so the
 * assertions cover the files a user receives, not an in-memory plan.
 */
final class MakeAuthCommandTest extends TestCase
{
    private string $project;

    protected function setUp(): void
    {
        $this->project = sys_get_temp_dir() . '/sahil-auth-' . bin2hex(random_bytes(6));

        if (!mkdir($this->project, 0o777, true) && !is_dir($this->project)) {
            self::fail('Unable to create a temporary project directory.');
        }
    }

    protected function tearDown(): void
    {
        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->project, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        foreach ($items as $item) {
            if (!$item instanceof \SplFileInfo) {
                continue;
            }

            $item->isDir() ? @rmdir($item->getPathname()) : @unlink($item->getPathname());
        }

        @rmdir($this->project);
    }

    /**
     * @return array{0: int, 1: string, 2: string} exit code, stdout, stderr
     */
    private function runCommand(string ...$options): array
    {
        $root = dirname(__DIR__, 2);
        $pipes = [];
        $process = proc_open(
            [PHP_BINARY, $root . '/bin/sahil', 'make:auth', '--path=' . $this->project, ...$options],
            [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
            $pipes,
            $root,
        );

        self::assertIsResource($process);

        $stdout = stream_get_contents($pipes[1]) ?: '';
        $stderr = stream_get_contents($pipes[2]) ?: '';
        fclose($pipes[1]);
        fclose($pipes[2]);

        return [proc_close($process), $stdout, $stderr];
    }

    /**
     * @return list<string>
     */
    private function generatedFiles(): array
    {
        return [
            'app/Http/AuthController.php',
            'routes/auth.php',
            'resources/views/layouts/auth.sahil.php',
            'resources/views/layouts/dashboard.sahil.php',
            'resources/views/auth/login.sahil.php',
            'resources/views/auth/register.sahil.php',
            'resources/views/auth/forgot-password.sahil.php',
            'resources/views/auth/reset-password.sahil.php',
            'resources/views/pages/dashboard.sahil.php',
        ];
    }

    public function test_tailwind_profile_writes_shadcn_style_pages(): void
    {
        [$code, $stdout, $stderr] = $this->runCommand('--ui=tailwind');

        self::assertSame(0, $code, $stdout . $stderr);

        foreach ($this->generatedFiles() as $relative) {
            self::assertFileExists($this->project . '/' . $relative, $relative . ' was not generated');
        }

        $login = (string) file_get_contents($this->project . '/resources/views/auth/login.sahil.php');
        self::assertStringContainsString('name="_token"', $login);
        self::assertStringContainsString('bg-primary', $login);
        self::assertStringContainsString('href="/forgot-password"', $login);
        self::assertStringContainsString('href="/register"', $login);

        $dashboard = (string) file_get_contents($this->project . '/resources/views/pages/dashboard.sahil.php');
        self::assertStringContainsString('@foreach (stats as stat)', $dashboard);

        $routes = (string) file_get_contents($this->project . '/routes/auth.php');
        self::assertStringContainsString("Route::get('/login'", $routes);
        self::assertStringContainsString("Route::get('/dashboard'", $routes);
        self::assertStringContainsString("'/reset-password/{token}'", $routes);
    }

    public function test_bootstrap_profile_writes_bootstrap_pages(): void
    {
        [$code, $stdout, $stderr] = $this->runCommand('--ui=bootstrap');

        self::assertSame(0, $code, $stdout . $stderr);

        $login = (string) file_get_contents($this->project . '/resources/views/auth/login.sahil.php');
        self::assertStringContainsString('class="form-control"', $login);
        self::assertStringContainsString('btn btn-primary', $login);

        $dashboard = (string) file_get_contents($this->project . '/resources/views/pages/dashboard.sahil.php');
        self::assertStringContainsString('class="table table-hover', $dashboard);
    }

    public function test_profile_is_detected_from_the_ui_manifest(): void
    {
        file_put_contents($this->project . '/.sahil-ui.json', "{\"profile\":\"bootstrap\"}\n");

        [$code, $stdout, $stderr] = $this->runCommand();

        self::assertSame(0, $code, $stdout . $stderr);
        self::assertStringContainsString('(bootstrap profile)', $stdout);

        $login = (string) file_get_contents($this->project . '/resources/views/auth/login.sahil.php');
        self::assertStringContainsString('btn btn-primary', $login);
    }

    public function test_missing_profile_fails_with_install_guidance(): void
    {
        [$code, , $stderr] = $this->runCommand();

        self::assertSame(1, $code);
        self::assertStringContainsString('no CSS framework profile detected', $stderr);
        self::assertStringContainsString('ui:install tailwind', $stderr);
        self::assertFileDoesNotExist($this->project . '/routes/auth.php');
    }

    public function test_unknown_profile_is_rejected(): void
    {
        [$code, , $stderr] = $this->runCommand('--ui=bulma');

        self::assertSame(1, $code);
        self::assertStringContainsString('unknown UI profile [bulma]', $stderr);
    }

    public function test_existing_pages_are_kept_without_force(): void
    {
        $this->runCommand('--ui=tailwind');

        $loginPath = $this->project . '/resources/views/auth/login.sahil.php';
        file_put_contents($loginPath, "{{-- edited by the application --}}\n");

        [$code, $stdout] = $this->runCommand('--ui=tailwind');

        self::assertSame(0, $code);
        self::assertStringContainsString('kept', $stdout);
        self::assertSame("{{-- edited by the application --}}\n", (string) file_get_contents($loginPath));
    }

    public function test_force_replaces_pages_and_keeps_a_backup(): void
    {
        $this->runCommand('--ui=tailwind');

        $loginPath = $this->project . '/resources/views/auth/login.sahil.php';
        file_put_contents($loginPath, "{{-- edited by the application --}}\n");

        [$code, $stdout] = $this->runCommand('--ui=tailwind', '--force');

        self::assertSame(0, $code);
        self::assertStringContainsString('updated', $stdout);
        self::assertStringContainsString('backup', $stdout);
        self::assertStringNotContainsString('edited by the application', (string) file_get_contents($loginPath));

        $backups = glob($this->project . '/storage/framework/auth-backups/*/resources/views/auth/login.sahil.php') ?: [];
        self::assertCount(1, $backups);
        self::assertStringContainsString('edited by the application', (string) file_get_contents($backups[0]));
    }

    public function test_dry_run_reports_the_plan_without_writing(): void
    {
        [$code, $stdout] = $this->runCommand('--ui=tailwind', '--dry-run');

        self::assertSame(0, $code);
        self::assertStringContainsString('Would generate', $stdout);
        self::assertFileDoesNotExist($this->project . '/routes/auth.php');
        self::assertFileDoesNotExist($this->project . '/app/Http/AuthController.php');
    }
}
