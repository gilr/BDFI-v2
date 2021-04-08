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
                'name'           => $record->nom,
                'description'    => $record->description,
                'displayed_text' => $record->affiche,
                'obsolete'       => $record->obsolete,
//                'created_by'  => $record->user_id,
//                'updated_by'  => $record->user_id,
                'created_at'     => $record->created_at,
                'updated_at'     => $record->updated_at,
                'deleted_at'     => NULL
            ]);
        }
    }
}
