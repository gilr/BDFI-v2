<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('annonces')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('announcements')->insert([
                'date'        => $record->date,
                'type'        => $record->type,
                'name'        => $record->sujet,
                'description' => $record->description,
                'url'         => $record->url,
//                'created_by'  => $record->user_id,
//                'updated_by'  => $record->user_id,
                'created_at'  => $record->created_at,
                'updated_at'  => $record->updated_at,
                'deleted_at'  => NULL
            ]);
        }
    }
}
