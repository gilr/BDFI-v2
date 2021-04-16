<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class WebsiteType extends Resource
{
    public static $model = \App\Models\WebsiteType::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    /* The columns that could be searched. */
    public static $search = [
        'name', 'description', 'displayed_text'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '3. Internes';

    /* Model Labels (plural & singular) */
    public static function label () { return "Types de site"; }
    public static function singularLabel () { return "Type de site"; }

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

            Text::make('Nom', 'name')
                ->rules('required', 'string', 'min:3', 'max:32')
                ->creationRules('unique:website_types,name')
                ->updateRules('unique:website_types,name,{{resourceId}}')
                ->sortable(),

            Text::make('Description', 'description')
                ->help('Ce champ description est optionnel.')
                ->rules('nullable', 'string', 'min:3', 'max:128')
                ->creationRules('unique:website_types,description')
                ->updateRules('unique:website_types,description,{{resourceId}}')
                ->hideFromIndex(),

            Text::make('Texte a afficher', 'truncated_displayed_text')
                ->asHtml()
                ->onlyOnIndex(),

            Text::make('Texte a afficher', 'displayed_text')
                ->rules('required', 'string', 'min:3', 'max:64')
                ->creationRules('unique:website_types,displayed_text')
                ->updateRules('unique:website_types,displayed_text,{{resourceId}}')
                ->hideFromIndex(),

            Boolean::make('Utilisable', 'obsolete')
                ->trueValue('0')
                ->falseValue('1')
                ->default('1')
                ->rules('required', 'boolean'),

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
