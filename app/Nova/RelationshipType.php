<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class RelationshipType extends Resource
{
    public static $model = \App\Models\RelationshipType::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    /* The columns that could be searched. */
    public static $search = [
        'name', 'relationship', 'reverse_relationship'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '8. Internes';

    /* Model Labels (plural & singular) */
    public static function label () { return "Types de relation"; }
    public static function singularLabel () { return "Type de relation"; }

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

            Text::make('Sujet', function() {
                return Str::limit($this->name, 25, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->asHtml()
                ->onlyOnIndex(),
            Text::make('Nom', 'name')
                ->rules('required', 'string', 'min:3', 'max:64')
                ->creationRules('unique:relationship_types,name')
                ->updateRules('unique:relationship_types,name,{{resourceId}}')
                ->hideFromIndex(),

            Text::make('Relation', 'relationship')
                ->rules('required', 'string', 'min:3', 'max:32')
                ->sortable(),

            Text::make('Relation inverse', 'reverse_relationship')
                ->rules('required', 'string', 'min:3', 'max:32')
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
