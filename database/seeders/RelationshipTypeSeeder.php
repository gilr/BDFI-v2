<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('types_lien')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('relationship_types')->insert([
                'id'                   => $record->id,
                'name'                 => $record->nom . "-" . $record->inverse,
                'relationship'         => $record->nom,
                'reverse_relationship' => $record->inverse,
//                'created_by'  => $record->user_id,
//                'updated_by'  => $record->user_id,
                'created_at'           => $record->created_at,
                'updated_at'           => $record->updated_at,
                'deleted_at'           => NULL
            ]);
        }
    }
}
