<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('liens_auteur')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('relationships')->insert([
                'id'                   => $record->id,
                'author1_id'           => $record->auteur_id,
                'author2_id'           => $record->lien_a_id,
                'relationship_type_id' => $record->type_lien_id,

                'created_at'           => $record->created_at,
                'updated_at'           => $record->updated_at,
                'deleted_at'           => NULL,

                // 99=>1 - 1=>2 - 2=>3 - 3=>4
                'created_by'           => 1,
                'updated_by'           => 1,
                'deleted_by'           => NULL
            ]);
        }
    }
}