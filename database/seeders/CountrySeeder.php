<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('pays')->get();
        foreach ($backup as $record) {
            DB::connection('mysql')->table('countries')->insert([
                'id'             => $record->id,
                'name'           => $record->nom,
                'nationality'    => $record->nationalite,
                'code'           => $record->code,
                'internal_order' => $record->ordre_interne,
//                'created_by'  => $record->user_id,
//                'updated_by'  => $record->user_id,
                'created_at'     => $record->created_at,
                'updated_at'     => $record->updated_at,
                'deleted_at'     => NULL
            ]);
        }        
    }
}
