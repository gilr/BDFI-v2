<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class Stat extends Resource
{
    public static $model = \App\Models\Stat::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'date';

    /* The columns that could be searched. */
    public static $search = [
        'authors', 'series', 'references', 'novels', 'short_stories', 'collections', 'magazines', 'essays'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Site';

    /* Model Labels (plural & singular) */
    public static function label () { return "Statistiques"; }
    public static function singularLabel () { return "Statistique"; }

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

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

            Date::make('Date décompte', 'date')
                ->pickerDisplayFormat('Y-m-d')
                ->default(today())
                ->help('Date du décompte en base. Par défaut, la date de ce jour est pré-remplie.')
                ->rules('required')
                ->sortable(),

            Number::make('Nb auteurs', 'authors')
                ->sortable(),
            Number::make('Nb cycles & séries', 'series')
                ->sortable(),
            Number::make('Nb références', 'references')
                ->sortable(),
            Number::make('Nb romans', 'novels')
                ->sortable(),
            Number::make('Nb nouvelles', 'short_stories')
                ->sortable(),
            Number::make('Nb recueils', 'collections')
                ->sortable(),
            Number::make('Nb revues', 'magazines')
                ->sortable(),
            Number::make('Nb essais', 'essays')
                ->sortable(),

            new Panel('Historique fiche', $this->commonMetadata()),
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
