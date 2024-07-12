<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->p_generateUserWithAdministratorRights();
    }

    private function p_generateUserWithAdministratorRights(): void
    {
        User::factory()->create([
            'name' => 'System Administrator',
            'email' => 'test@example.com',
        ]);
    }
}
