<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string(column: 'name');
            $table->string(column: 'email')->unique();
            $table->string(column: 'password');
            $table->string(column: 'twoFactorCode')->nullable();

            $table->foreignId(column: 'role_id')
            ->index()
            ->constrained();

            $table->dateTime(column: 'twoFactorExpiresAt')->nullable();
            $table->timestamps();
        });
    }
};
