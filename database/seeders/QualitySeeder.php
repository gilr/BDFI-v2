<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('etats_avancement')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('qualities')->insert([
                'id'           => $record->id,
                'level'        => $record->valeur,
                'name'         => $record->nom,
                'description'  => $record->nom_long,
//                'created_by'  => $record->user_id,
//                'updated_by'  => $record->user_id,
                'created_at'   => $record->created_at,
                'updated_at'   => $record->updated_at,
                'deleted_at'   => NULL
            ]);
        }
    }
}
