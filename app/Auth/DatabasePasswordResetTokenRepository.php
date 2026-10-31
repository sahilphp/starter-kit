<?php

declare(strict_types=1);

namespace App\Auth;

use Sahil\Contracts\Auth\PasswordResetTokenRepositoryContract;
use Sahil\Database\Connection;

/**
 * Password reset tokens stored in `password_reset_tokens`.
 *
 * Tokens are kept as SHA-256 digests and stamped with a Unix `created_at`;
 * expiry is decided when a record is read, using the configured window.
 * Issuing a new token deletes the user's outstanding ones, so a reset link
 * works at most once and an older link stops working immediately.
 */
final class DatabasePasswordResetTokenRepository implements PasswordResetTokenRepositoryContract
{
    public function __construct(
        private readonly Connection $connection,
        private readonly int $expirationMinutes = 60,
    ) {
    }

    public function create(int|string $userId, string $token, int $expirationMinutes): void
    {
        $this->deleteUserTokens($userId);

        $this->connection->table('password_reset_tokens')->insert([
            'user_id' => $userId,
            'token' => self::digest($token),
            'created_at' => time(),
        ]);
    }

    public function find(int|string $userId, string $token): ?array
    {
        $row = $this->connection->table('password_reset_tokens')
            ->where('user_id', '=', $userId)
            ->where('token', '=', self::digest($token))
            ->first();

        if ($row === null) {
            return null;
        }

        return ['created_at' => (int) $row['created_at']];
    }

    public function isExpired(array $record): bool
    {
        $expiresAt = (int) ($record['created_at'] ?? 0) + ($this->expirationMinutes * 60);

        return time() >= $expiresAt;
    }

    public function delete(int|string $userId, string $token): void
    {
        $this->connection->table('password_reset_tokens')
            ->where('user_id', '=', $userId)
            ->where('token', '=', self::digest($token))
            ->delete();
    }

    public function deleteUserTokens(int|string $userId): void
    {
        $this->connection->table('password_reset_tokens')
            ->where('user_id', '=', $userId)
            ->delete();
    }

    public function deleteExpired(): void
    {
        $this->connection->table('password_reset_tokens')
            ->where('created_at', '<', time() - ($this->expirationMinutes * 60))
            ->delete();
    }

    private static function digest(string $token): string
    {
        return hash('sha256', $token);
    }
}
