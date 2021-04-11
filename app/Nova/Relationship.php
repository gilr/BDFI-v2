<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class Relationship extends Resource
{
    public static $model = \App\Models\Relationship::class;

     /* Displayed field uses as title on detail pages */
    //public static $title = '';

    /* The columns that could be searched. */
    public static $search = [
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '1. Biblio';

    /* Model Labels (plural & singular) */
    public static function label () { return "Relations"; }
    public static function singularLabel () { return "Relation"; }

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

    /*  * Indicates whether Nova should prevent the user from leaving an unsaved form, losing their data. */
    public static $preventFormAbandonment = true;


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('N°', 'id')
                ->sortable(),

            BelongsTo::make('Auteur 1', 'author1', 'App\Nova\Author')
                ->sortable()
                ->searchable(),

            BelongsTo::make('Auteur 2', 'author2', 'App\Nova\Author')
                ->sortable()
                ->searchable(),

            BelongsTo::make('Relation entre 1 et 2', 'relationship_type', 'App\Nova\RelationshipType')
                ->sortable(),

            new Panel('Historique fiche', $this->Metadata()),
        ];
    }

    protected function Metadata()
    {
        return [
            DateTime::make('Créé le', 'created_at')
                ->sortable()
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),
            BelongsTo::make('Par', 'creator', 'App\Nova\User')
                ->sortable()
                ->onlyOnDetail(),

            DateTime::make('Modifié le', 'updated_at')
                ->sortable()
                ->format('DD/MM/YYYY HH:mm')
                ->exceptOnForms(),
            BelongsTo::make('Par', 'editor', 'App\Nova\User')
                ->sortable()
                ->exceptOnForms(),

            DateTime::make('Détruit le', 'deleted_at')
                ->sortable()
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),
            BelongsTo::make('Par', 'destroyer', 'App\Nova\User')
                ->sortable()
                ->onlyOnDetail(),

            Trix::make('Historique', function() {
                //return $this->revisionHistory()->getResults();
                $history = $this->revisionHistory()->getResults()->reverse();
                $display = "";
                foreach ($history as $revision) {
                    if($revision->key == 'created_at' && !$revision->old_value) {
                        $display .= $revision->created_at . " (" . $revision->userResponsible()->name . ") Création </br>";
                    }
                    else {
                        $display .= $revision->created_at . " (" . $revision->userResponsible()->name . ") Champ <b>" . $revision->fieldName() . "</b> modifié de \"<span style='color:red'>" . $revision->oldValue() . "</span>\" à \"<span style='color:blue'>" . $revision->newValue() ."</span>\"</br>";
                    }
                }
                return $display;

            }) ->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
