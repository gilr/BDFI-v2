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
            'name'     => 'bdfi',
            'role'     => 'sysadmin',
            'email'    => 'gilles@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'gilles',
            'role'     => 'sysadmin',
            'email'    => 'gilles.richardot@free.fr',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'christian',
            'role'     => 'admin',
            'email'    => 'christian@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'dom',
            'role'     => 'editor',
            'email'    => 'dom.maria@free.fr',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'sysadmin',
            'role'     => 'sysadmin',
            'email'    => 'sysadmin@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'admin',
            'role'     => 'admin',
            'email'    => 'admin@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'editor',
            'role'     => 'editor',
            'email'    => 'editor@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);
        DB::table('users')->insert([
            'name'     => 'guest',
            'role'     => 'guest',
            'email'    => 'guest@bdfi.net',
            'password' => Hash::make('testpassword'),
        ]);

    $this->call([
        CountrySeeder::class,
        QualitySeeder::class,
        WebsiteTypeSeeder::class,
        RelationshipTypeSeeder::class,
        AnnouncementSeeder::class,
        AuthorSeeder::class,
        WebsiteSeeder::class,
        SignatureSeeder::class,
        RelationshipSeeder::class,
        EventSeeder::class,
    ]);

    }
}
