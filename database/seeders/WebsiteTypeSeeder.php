<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('types_site')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('website_types')->insert([
                'id'             => $record->id,

                'name'           => $record->nom,
                'description'    => $record->description,
                'displayed_text' => $record->affiche,
                'is_obsolete'    => $record->obsolete,

                'created_at'     => $record->created_at,
                'updated_at'     => $record->updated_at,
                'deleted_at'     => NULL,

                // 99=>1 - 1=>2 - 2=>3 - 3=>4
                'created_by'      => 1,
                'updated_by'      => 1,
                'deleted_by'      => NULL
            ]);
        }
    }
}
