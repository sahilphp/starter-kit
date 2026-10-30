<?php

declare(strict_types=1);

namespace App\Support;

use FilesystemIterator;
use RuntimeException;
use Sahil\Ui\Profile;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * Writes the authentication pages produced by `php sahil make:auth`.
 *
 * The sources live in `auth-stubs` (kept out of `stubs/`, which project
 * creation and `ui:install` delete): `shared/` holds the controller and route
 * table, and one directory per UI profile holds the templates. Every source
 * file is read before the first page is written, so a failed run cannot leave
 * a half-generated page set behind, and existing pages are kept unless the
 * caller passes `--force` (which backs them up first).
 */
final class AuthScaffolder
{
    public function __construct(private readonly string $stubRoot)
    {
    }

    /**
     * Normalise a profile to the directory that holds its templates.
     *
     * `both` uses the Tailwind pages: the two frameworks share one component
     * vocabulary in this starter-kit, and the Tailwind set is the richer one.
     */
    public static function profileDirectory(Profile $profile): string
    {
        return $profile === Profile::Bootstrap ? 'bootstrap' : 'tailwind';
    }

    /**
     * @return array{profile: string, created: list<string>, updated: list<string>, skipped: list<string>, backups: list<string>}
     */
    public function scaffold(string $basePath, Profile $profile, bool $force = false, bool $dryRun = false): array
    {
        $basePath = $this->projectDirectory($basePath);
        $profileDirectory = self::profileDirectory($profile);
        $files = $this->stubFiles($profileDirectory);

        $report = [
            'profile' => $profileDirectory,
            'created' => [],
            'updated' => [],
            'skipped' => [],
            'backups' => [],
        ];

        foreach ($files as $relative => $content) {
            $path = $basePath.'/'.$relative;
            $exists = is_file($path);

            if ($exists && !$force) {
                $report['skipped'][] = $relative;

                continue;
            }

            if (!$dryRun) {
                if ($exists) {
                    $report['backups'][] = $this->backup($basePath, $relative);
                }

                $this->writeFile($path, $content);
            }

            $report[$exists ? 'updated' : 'created'][] = $relative;
        }

        return $report;
    }

    /**
     * @return array<string, string> relative path => file contents
     */
    private function stubFiles(string $profileDirectory): array
    {
        $files = [];

        foreach (['shared', $profileDirectory] as $tree) {
            $root = $this->stubRoot.'/'.$tree;

            if (!is_dir($root)) {
                throw new RuntimeException(sprintf('missing stub directory [%s].', $root));
            }

            foreach ($this->relativeFiles($root) as $relative) {
                $content = @file_get_contents($root.'/'.$relative);

                if ($content === false) {
                    throw new RuntimeException(sprintf('unable to read stub [%s].', $relative));
                }

                $files[$relative] = $content;
            }
        }

        ksort($files);

        return $files;
    }

    /**
     * @return list<string>
     */
    private function relativeFiles(string $root): array
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
        );

        $files = [];

        foreach ($iterator as $file) {
            if (!$file instanceof SplFileInfo || !$file->isFile()) {
                continue;
            }

            $files[] = str_replace('\\', '/', substr($file->getPathname(), strlen($root) + 1));
        }

        sort($files);

        return $files;
    }

    private function projectDirectory(string $path): string
    {
        if (!is_dir($path)) {
            throw new RuntimeException(sprintf('project directory [%s] does not exist.', $path));
        }

        $resolved = realpath($path);

        if ($resolved === false) {
            throw new RuntimeException(sprintf('unable to resolve project directory [%s].', $path));
        }

        if (!is_writable($resolved)) {
            throw new RuntimeException(sprintf('project directory [%s] is not writable.', $resolved));
        }

        return $resolved;
    }

    private function writeFile(string $path, string $content): void
    {
        $directory = dirname($path);

        if (!is_dir($directory) && !mkdir($directory, 0o775, true) && !is_dir($directory)) {
            throw new RuntimeException(sprintf('unable to create directory [%s].', $directory));
        }

        $temporary = $path.'.tmp-'.bin2hex(random_bytes(4));

        if (file_put_contents($temporary, $content) === false) {
            @unlink($temporary);

            throw new RuntimeException(sprintf('unable to write [%s].', $path));
        }

        if (!rename($temporary, $path)) {
            @unlink($temporary);

            throw new RuntimeException(sprintf('unable to replace [%s].', $path));
        }
    }

    private function backup(string $basePath, string $relative): string
    {
        $backupRoot = sprintf(
            'storage/framework/auth-backups/%s-%s',
            gmdate('Ymd-His'),
            bin2hex(random_bytes(3)),
        );
        $destination = $basePath.'/'.$backupRoot.'/'.$relative;

        if (!is_dir(dirname($destination)) && !mkdir(dirname($destination), 0o775, true) && !is_dir(dirname($destination))) {
            throw new RuntimeException(sprintf('unable to create backup directory [%s].', dirname($destination)));
        }

        if (!copy($basePath.'/'.$relative, $destination)) {
            throw new RuntimeException(sprintf('unable to back up [%s].', $relative));
        }

        return $backupRoot.'/'.$relative;
    }
}
