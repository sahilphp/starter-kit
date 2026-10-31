<?php

declare(strict_types=1);

use Sahil\Database\Schema\Schema;
use Sahil\Database\Schema\Table;
use Sahil\Migrations\Migration;

/**
 * Accounts for the generated authentication pages.
 *
 * Email is unique: `AuthManager` looks users up by email, and registration
 * relies on the database to reject a duplicate address even under a race.
 */
return new class () extends Migration {
    public function up(Schema $schema): void
    {
        $schema->create('users', static function (Table $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190)->unique();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(Schema $schema): void
    {
        $schema->dropIfExists('users');
    }
};
