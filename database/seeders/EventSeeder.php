<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backup = DB::connection('mysql2')->table('evenements')->get();
        foreach ($backup as $record) {

            $date_debut = $record->date_debut;
            if ($date_debut == "2016-06-99") { $date_debut = "2016-06-01"; }
            if ($date_debut == "2018-04-99") { $date_debut = "2018-04-01"; }
            if ($date_debut == "2019-06-00") { $date_debut = "2019-06-01"; }

            $date_fin = $record->date_fin;
            if ($date_fin == "2016-06-99") { $date_fin = "2016-06-01"; }
            if ($date_fin == "2017-11-99") { $date_fin = "2017-11-01"; }
            if ($date_fin == "2018-04-99") { $date_fin = "2018-04-01"; }
            if ($date_fin == "2019-06-00") { $date_fin = "2019-06-01"; }

            DB::connection('mysql')->table('events')->insert([
                'id'          => $record->id,

                'name'        => $record->sujet,
                'start_date'  => $date_debut,
                'end_date'    => $date_fin,
                'place'       => $record->lieu,
                'description' => $record->description,
                'url'         => $record->url,
                'type'         => $record->type,

                'is_confirmed'     => $record->est_valide,
                'is_full_scope'    => !$record->en_marge,
                'publication_date' => $record->publie_a !== "0000-00-00 00:00:00" ? $record->publie_a : NULL,

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
