<?php

declare(strict_types=1);

namespace Tests\Console;

use PHPUnit\Framework\TestCase;

/**
 * `start` validates its bind address and reports a busy port with a usable
 * alternative, instead of failing with Composer's raw script error.
 */
final class StartCommandTest extends TestCase
{
    /**
     * @return array{0: int, 1: string, 2: string}
     */
    private function runStart(string ...$arguments): array
    {
        $root = dirname(__DIR__, 2);
        $pipes = [];
        $process = proc_open(
            [PHP_BINARY, $root . '/bin/sahil', 'start', ...$arguments],
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

    public function test_busy_port_is_reported_with_a_free_alternative(): void
    {
        $listener = stream_socket_server('tcp://127.0.0.1:0', $errorCode, $errorMessage);

        self::assertIsResource($listener, (string) $errorMessage);

        $name = (string) stream_socket_get_name($listener, false);
        $port = (int) substr($name, strrpos($name, ':') + 1);

        self::assertGreaterThan(0, $port);

        [$code, , $stderr] = $this->runStart('--port=' . $port);

        fclose($listener);

        self::assertSame(1, $code);
        self::assertStringContainsString(sprintf('127.0.0.1:%d is already in use or unavailable', $port), $stderr);
        self::assertStringContainsString('--port=', $stderr);
        self::assertStringContainsString('usage: php sahil start', $stderr);
    }

    public function test_invalid_ports_are_rejected_before_binding(): void
    {
        foreach (['0', '65536', 'eighty', '-1', '80.5'] as $port) {
            [$code, , $stderr] = $this->runStart('--port=' . $port);

            self::assertSame(1, $code, sprintf('port [%s] must be rejected', $port));
            self::assertStringContainsString('invalid port', $stderr, $port);
            self::assertStringContainsString('between 1 and 65535', $stderr, $port);
        }
    }

    public function test_invalid_host_is_rejected(): void
    {
        [$code, , $stderr] = $this->runStart('--host=not a host');

        self::assertSame(1, $code);
        self::assertStringContainsString('invalid host', $stderr);
    }

    public function test_unknown_option_is_rejected(): void
    {
        [$code, , $stderr] = $this->runStart('--turbo');

        self::assertSame(1, $code);
        self::assertStringContainsString('unknown option [--turbo]', $stderr);
    }

    public function test_space_separated_host_and_port_are_accepted(): void
    {
        $listener = stream_socket_server('tcp://127.0.0.1:0', $errorCode, $errorMessage);
        self::assertIsResource($listener, (string) $errorMessage);

        $name = (string) stream_socket_get_name($listener, false);
        $port = (int) substr($name, strrpos($name, ':') + 1);

        [$code, , $stderr] = $this->runStart('--host', '127.0.0.1', '--port', (string) $port);

        fclose($listener);

        self::assertSame(1, $code);
        self::assertStringContainsString('is already in use or unavailable', $stderr);
    }

    public function test_start_help_prints_the_command_reference(): void
    {
        [$code, $stdout] = $this->runStart('--help');

        self::assertSame(0, $code);
        self::assertStringContainsString('start', $stdout);
        self::assertStringContainsString('--port=PORT', $stdout);
        self::assertStringContainsString('--host=HOST', $stdout);
    }

    public function test_root_entry_point_runs_the_same_cli(): void
    {
        $root = dirname(__DIR__, 2);
        $pipes = [];
        $process = proc_open(
            [PHP_BINARY, $root . '/sahil', '--version'],
            [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
            $pipes,
            $root,
        );

        self::assertIsResource($process);

        $stdout = stream_get_contents($pipes[1]) ?: '';
        $stderr = stream_get_contents($pipes[2]) ?: '';
        fclose($pipes[1]);
        fclose($pipes[2]);

        self::assertSame(0, proc_close($process), $stdout . $stderr);
        self::assertStringContainsString('SahilPHP', $stdout);
        self::assertStringContainsString(PHP_VERSION, $stdout);
    }
}
