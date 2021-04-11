<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class Country extends Resource
{
    public static $model = \App\Models\Country::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    /* The columns that could be searched. */
    public static $search = [
        'name', 'nationality', 'internal_order'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '3. Internes';

    /* Model Labels (plural & singular) */
    public static function label () { return "Pays"; }
    public static function singularLabel () { return "Pays"; }

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

    /* Whether to show borders for each column on the X-axis. */
    public static $showColumnBorders = false;

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
            Number::make('Ordre interne', 'internal_order')
                ->rules('required', 'integer', 'gt:0')
                ->sortable(),
            Text::make('Nom', 'name')
                ->rules('required', 'string', 'min:3')
                ->creationRules('unique:countries,name')
                ->updateRules('unique:countries,name,{{resourceId}}')
                ->sortable(),
            Text::make('Gentilé', 'nationality')
                ->rules('required', 'string', 'min:3')
                ->creationRules('unique:countries,nationality')
                ->updateRules('unique:countries,nationality,{{resourceId}}')
                ->sortable(),
            Text::make('Code', 'code')
                ->rules('required', 'string', 'size:2')
                ->creationRules('unique:countries,code')
                ->updateRules('unique:countries,code,{{resourceId}}')
                ->hideFromIndex(),
            DateTime::make('Créé le', 'created_at')
                ->sortable()
                ->format('DD/MM/YYYY HH:mm')
                ->exceptOnForms(),
            DateTime::make('Modifié le', 'updated_at')
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),
            DateTime::make('Détruit le', 'deleted_at')
                ->sortable()
                ->format('DD/MM/YYYY HH:mm')
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
