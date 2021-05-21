<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class AwardWinner extends Resource
{
    public static $model = \App\Models\AwardWinner::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    public function subtitle()
    {
        return "$this->title ($this->vo_title)";
    }
    /* The columns that could be searched. */
    public static $search = [
      'id', 'year', 'name', 'title', 'vo_title', 'note'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Prix';

    /* Model Labels (plural & singular) */
    public static function label () { return "Lauréats"; }
    public static function singularLabel () { return "Lauréat"; }

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

    /*  * Indicates whether Nova should prevent the user from leaving an unsaved form, losing their data. */
    public static $preventFormAbandonment = false;

    /* The number of results to display when searching for relatable resources without Scout. */
    public static $relatableSearchResults = 50;

    public static $with = ['award_category'];

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

            Number::make('Année', 'year')
                ->rules('required', 'gt:1900')
                ->sortable(),

            BelongsTo::make('Catégorie', 'award_category', 'App\Nova\AwardCategory')
                ->withoutTrashed()
                ->nullable()
                ->sortable()
                ->searchable(),

            Text::make('Attribué à', 'name', function() {
                    return Str::limit($this->name, 30, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
                })
                ->sortable()
                ->asHtml()
                ->onlyOnIndex(),
            Textarea::make('Attribué à', 'name')
                ->rules('nullable', 'string', 'max:256')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            BelongsTo::make('Auteur 1', 'author', 'App\Nova\Author')
                ->withoutTrashed()
                ->nullable()
                ->sortable()
                ->searchable(),
            BelongsTo::make('Auteur 2', 'author2', 'App\Nova\Author')
                ->withoutTrashed()
                ->nullable()
                ->sortable()
                ->searchable(),
            BelongsTo::make('Auteur 3', 'author3', 'App\Nova\Author')
                ->withoutTrashed()
                ->nullable()
                ->searchable()
                ->hideFromIndex(),

            Number::make('Position', 'position')
                ->rules('required', 'gte:1', 'lt:100')
                ->help('1 si gagnant, 50 si mention spéciale, 99 si non attribué cette année-là.')
                ->sortable(),

            Text::make('Titre', 'title', function() {
                    return Str::limit($this->title, 30, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
                })
                ->sortable()
                ->asHtml()
                ->onlyOnIndex(),
            Textarea::make('Titre', 'title')
                ->rules('nullable', 'string', 'max:256')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),
            Text::make('Titre vo', 'vo_title', function() {
                    return Str::limit($this->vo_title, 30, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
                })
                ->sortable()
                ->asHtml()
                ->onlyOnIndex(),
            Textarea::make('Titre vo', 'vo_title')
                ->rules('nullable', 'string', 'max:256')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            Textarea::make('Note', 'note')
                ->rules('nullable', 'string', 'min:3')
                ->rows(2)
                ->alwaysShow()
                ->hideFromIndex(),

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
