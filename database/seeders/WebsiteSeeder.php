<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('url_auteur')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('websites')->insert([
                'id'              => $record->id,
                'url'             => $record->url,
                'author_id'       => $record->auteur_id,
                'website_type_id' => $record->type_site_id,
                'country_id'      => $record->langue_id,
                'created_at'      => $record->created_at,
                'updated_at'      => $record->updated_at,
                'created_by'      => $record->user_id,
                'updated_by'      => $record->user_id,
                'deleted_at'      => NULL
            ]);
        }
    }
}
