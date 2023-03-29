<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder {
    public function run(): void {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $userRole = Role::query()->where('slug', 'user')->first();
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make(value: 'user'),
            'role_id' => $userRole->id,
        ]);
    }
}
