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

                'created_at'   => $record->created_at,
                'updated_at'   => $record->updated_at,
                'deleted_at'   => NULL,

                // 99=>1 - 1=>2 - 2=>3 - 3=>4
                'created_by'   => 1,
                'updated_by'   => 1,
                'deleted_by'   => NULL
            ]);
        }
    }
}
