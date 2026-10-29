<?php

declare(strict_types=1);

namespace App\Support;

use RuntimeException;

/**
 * Reads and writes single values in a flat `KEY=value` environment file.
 *
 * Only the requested key is ever touched: comments, ordering and unrelated
 * variables are preserved byte for byte, and the file is written atomically
 * through a temporary file so an interrupted write cannot truncate it.
 */
final class EnvironmentFile
{
    /**
     * @param string $path absolute path to the environment file
     */
    public function __construct(private readonly string $path)
    {
    }

    /**
     * Absolute path this instance manages.
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * Whether the file exists.
     */
    public function exists(): bool
    {
        return is_file($this->path);
    }

    /**
     * Current value of a key, or null when the file or key is absent.
     */
    public function get(string $key): ?string
    {
        if (!$this->exists()) {
            return null;
        }

        $contents = file_get_contents($this->path);

        if ($contents === false) {
            throw new RuntimeException(sprintf('Unable to read [%s].', $this->path));
        }

        foreach (preg_split('/\R/', $contents) ?: [] as $line) {
            $trimmed = ltrim($line);

            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }

            [$name, $value] = array_pad(explode('=', $trimmed, 2), 2, '');

            if (trim($name) === $key) {
                return $this->unquote(trim($value));
            }
        }

        return null;
    }

    /**
     * Set a key, replacing its line in place or appending it, and return the
     * path that was written.
     *
     * @param string $key   variable name (`APP_KEY`)
     * @param string $value value written verbatim (no quoting added)
     */
    public function set(string $key, string $value): string
    {
        $contents = $this->exists() ? file_get_contents($this->path) : '';
        $contents = rtrim($contents === false ? '' : $contents, "\r\n");
        $line = $key . '=' . $value;

        $lines = $contents === '' ? [] : (preg_split('/\R/', $contents) ?: []);
        $replaced = false;

        foreach ($lines as $index => $existing) {
            $trimmed = ltrim($existing);

            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }

            [$name] = array_pad(explode('=', $trimmed, 2), 2, '');

            if (trim($name) === $key) {
                $lines[$index] = $line;
                $replaced = true;
            }
        }

        if (!$replaced) {
            $lines[] = $line;
        }

        $body = implode(PHP_EOL, $lines) . PHP_EOL;
        $temporary = $this->path . '.tmp';

        if (file_put_contents($temporary, $body) === false) {
            throw new RuntimeException(sprintf('Unable to write [%s].', $temporary));
        }

        if (!@rename($temporary, $this->path)) {
            @unlink($temporary);

            throw new RuntimeException(sprintf('Unable to replace [%s].', $this->path));
        }

        return $this->path;
    }

    private function unquote(string $value): string
    {
        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];

            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                return substr($value, 1, -1);
            }
        }

        return $value;
    }
}
