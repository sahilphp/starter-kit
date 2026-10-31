<?php

declare(strict_types=1);

use Sahil\Database\Schema\Schema;
use Sahil\Database\Schema\Table;
use Sahil\Migrations\Migration;

/**
 * Password reset tokens.
 *
 * Only a SHA-256 digest of each token is stored, so a database leak does not
 * expose usable reset links. `created_at` is a Unix timestamp because
 * `PasswordResetManager` compares it against a clock in seconds.
 */
return new class () extends Migration {
    public function up(Schema $schema): void
    {
        $schema->create('password_reset_tokens', static function (Table $table): void {
            $table->id();
            $table->foreignId('user_id');
            $table->string('token', 64)->unique();
            $table->bigInteger('created_at');
            $table->index('user_id');
        });
    }

    public function down(Schema $schema): void
    {
        $schema->dropIfExists('password_reset_tokens');
    }
};
