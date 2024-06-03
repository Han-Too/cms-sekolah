<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'user_token' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => "superadmin",
            'username' => "superadmin",
            'email' => "superadmin@admin.com",
            'telepon' => fake()->phoneNumber(),
            'alamat' => fake()->address(),
            'role' => "Administrator",
            'email_verified_at' => now(),
            'password' => bcrypt("pass.123"), // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\Role::factory()->create(
            [
            'title' => 'Administrator',
            'description' => "Master Four Elements",
            ]);
            \App\Models\Role::factory()->create([
            'title' => 'User',
            'description' => "Just Read Data",
            ]);
            \App\Models\Role::factory()->create([
            'title' => 'Guru',
            'description' => "Just Update Create Delete Only",
            ]);
            \App\Models\Role::factory()->create([
            'title' => 'Siswa',
            'description' => "Just Read Only",
            ]);
    }
}
