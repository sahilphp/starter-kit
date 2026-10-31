<?php

declare(strict_types=1);

namespace App\Auth;

use Sahil\Auth\Password;
use Sahil\Auth\SimpleUser;
use Sahil\Contracts\Auth\AuthenticatableContract;
use Sahil\Database\Connection;

/**
 * Creates and looks up application accounts.
 *
 * Passwords are hashed here, before the row is written; the plaintext value
 * only ever lives in the request and in this method's argument.
 */
final class UserRepository
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function exists(string $email): bool
    {
        return $this->connection->table('users')->where('email', '=', $email)->first() !== null;
    }

    /**
     * Insert an account and return it in the shape the auth layer expects.
     */
    public function create(string $name, string $email, string $password): AuthenticatableContract
    {
        $now = gmdate('Y-m-d H:i:s');

        $this->connection->table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => Password::hash($password),
            'remember_token' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Read the row back instead of trusting a driver-specific insert id.
        $row = $this->connection->table('users')->where('email', '=', $email)->first();

        if ($row === null) {
            throw new \RuntimeException('The account was written but could not be read back.');
        }

        return new SimpleUser($row);
    }

    /**
     * Replace the account's password with a fresh hash of the plaintext value.
     */
    public function updatePassword(AuthenticatableContract $user, string $password): void
    {
        $this->connection->table('users')
            ->where('id', '=', $user->getAuthIdentifier())
            ->update([
                'password' => Password::hash($password),
                'updated_at' => gmdate('Y-m-d H:i:s'),
            ]);
    }
}
