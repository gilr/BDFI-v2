<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         DB::table('users')->insert([
            'name' => 'bdfi',
            'email' => 'gilles@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);
         DB::table('users')->insert([
            'name' => 'gilles',
            'email' => 'gilles.richardot@free.fr',
            'password' => Hash::make('testpassword'),
        ]);
         DB::table('users')->insert([
            'name' => 'christian',
            'email' => 'christian@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);

    $this->call([
        CountrySeeder::class,
    ]);

    }
}
