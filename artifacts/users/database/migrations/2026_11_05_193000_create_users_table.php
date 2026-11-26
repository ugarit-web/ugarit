<?php

declare(strict_types=1);

use Heritage\Database\Migrations\Migration;
use Heritage\Database\Schema\Blueprint;
use Heritage\Support\Facades\Schema;

/**
 * Migration: create_users_table
 *
 * Owned by the Users artifact. Stores individual human accounts associated
 * with an underlying entity record, using username as the primary unique identifier.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary and foreign identifier referencing the unified entity
            $table->foreignId('entity_id')->primary()->constrained('entities')->cascadeOnDelete();

            // Unique username used as primary account identifier
            $table->string('username')->unique();

            // Remember me token for persistent authenticated sessions
            $table->rememberToken();

            // Two-factor authentication credentials
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();

            // Record creation and update timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
