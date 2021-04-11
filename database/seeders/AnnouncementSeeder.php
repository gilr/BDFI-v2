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
                'id'          => $record->id,

                'date'        => $record->date,
                'type'        => $record->type,
                'name'        => $record->sujet,
                'description' => $record->description,
                'url'         => $record->url,

                'created_at'  => $record->created_at,
                'updated_at'  => $record->updated_at,
                'deleted_at'  => NULL,

                // 99=>1 - 1=>2 - 2=>3 - 3=>4
                'created_by'  => 1,
                'updated_by'  => ($record->user_id == 99 ? 1 : $record->user_id + 1),
                'deleted_by'  => NULL
            ]);
        }
    }
}
