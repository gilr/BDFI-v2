<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class Author extends Resource
{
    public static $model = \App\Models\Author::class;

    /* Displayed field uses as title on detail pages */
    //public static $title = 'subject';

    /* The columns that could be searched. */
    public static $search = [
      'id', 'name', 'first_name', 'birth_date', 'date_death'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '1. Tables biblio';

    /* Model Labels (plural & singular) */
    public static function label () { return "Auteurs"; }
    public static function singularLabel () { return "Auteur"; }

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

            Text::make('Page BDFI', 'nom_bdfi')
                ->sortable(),

            Text::make('Né le', 'birth_date')
                ->sortable(),
            Text::make('Décès', 'date_death')
                ->sortable(),

            Text::make('Nom', 'name')
                ->hideFromIndex(),
            Text::make('Prénom', 'first_name')
                ->hideFromIndex(),
            Text::make('Nom légal', 'legal_name')
                ->nullable()
                ->hideFromIndex(),
            Text::make('Autres formes', 'forms')
                ->hideFromIndex(),

            BelongsTo::make('Pays', 'country', 'App\Nova\Country')
                ->hideFromIndex(),
            BelongsTo::make('Pays 2', 'country2', 'App\Nova\Country')
                ->hideFromIndex(),


            Boolean::make('Pseu', 'pseudonym')
                ->trueValue('0')
                ->falseValue('1')
                ->rules('required', 'boolean')
                ->sortable(),

            BelongsTo::make('Quality', 'quality', 'App\Nova\Quality')
                ->hideFromIndex(),

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
