<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Award extends Resource
{
    public static $model = \App\Models\Award::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    /* The columns that could be searched. */
    public static $search = [
      'id', 'year_start', 'name', 'alt_names', 'given_by', 'given_for', 'description'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Prix';

    /* Model Labels (plural & singular) */
    public static function label () { return "Prix"; }
    public static function singularLabel () { return "Prix"; }

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

    /*  * Indicates whether Nova should prevent the user from leaving an unsaved form, losing their data. */
    public static $preventFormAbandonment = false;

    /* The number of results to display when searching for relatable resources without Scout. */
    public static $relatableSearchResults = 50;

    public static $with = ['country'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Nom', 'name', function() {
                return Str::limit($this->name, 30, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->asHtml()
                ->sortable()
                ->onlyOnIndex(),
            Text::make('Nom', 'name')
                ->rules('required', 'string', 'max:128')
                ->hideFromIndex(),
            BelongsTo::make('Pays', 'country', 'App\Nova\Country')
                ->withoutTrashed()
                ->nullable()
                ->sortable()
                ->default(1)
                ->searchable(),
            Text::make('Autres formes', 'alt_names')
                ->rules('nullable', 'string', 'max:128')
                ->hideFromIndex(),

            Number::make('Création', 'year_start')
                ->rules('required', 'gt:1900')
                ->help('Année de la première récompense')
                ->sortable(),
            Number::make('Fin', 'year_end')
                ->rules('nullable', 'gte:year_start')
                ->help('Année de la dernière récompense, non renseigné si encore actif.')
                ->sortable(),

            Text::make('Décerné par', 'given_by')
                ->rules('string', 'max:256')
                ->hideFromIndex(),
            Text::make('Décerné pour', 'given_for')
                ->rules('string', 'max:256')
                ->hideFromIndex(),

            Text::make('URL officielle', function() {
                return "<a href='$this->url'>$this->url</a>";
            })
                ->asHtml()
                ->onlyOnDetail(),
            Text::make('URL', 'url')
                ->rules('nullable', 'url', 'max:256')
                ->help('Laisser vide, ou URL forum si une discussion existe, ou URL de l\'évènement lui-même.')
                ->onlyOnForms(),

            Text::make('Description', 'description', function() {
                return Str::limit($this->description, 45, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->sortable()
                ->asHtml()
                ->onlyOnIndex(),
            Textarea::make('Description', 'description')
                ->rules('required', 'string', 'min:10')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            HasMany::make('Catégories', 'awardcategories', '\App\Nova\AwardCategory'),

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
