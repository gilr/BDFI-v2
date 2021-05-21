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

class AwardCategory extends Resource
{
    public static $model = \App\Models\AwardCategory::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    public function title()
    {
        return $this->name . " ({$this->award->name})";
    }
    public function subtitle()
    {
        return "Award: {$this->award->name}";
    }
    /* The columns that could be searched. */
    public static $search = [
      'id', 'name', 'type', 'genre', 'subgenre', 'description'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Prix';
    
    /* Model Labels (plural & singular) */
    public static function label () { return "Catégories"; }
    public static function singularLabel () { return "Catégorie de prix"; }

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

    /*  * Indicates whether Nova should prevent the user from leaving an unsaved form, losing their data. */
    public static $preventFormAbandonment = false;

    /* The number of results to display when searching for relatable resources without Scout. */
    public static $relatableSearchResults = 50;

    public static $with = ['award'];

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

            Text::make('Nom', 'name')
                ->rules('required', 'string', 'max:128')
                ->sortable(),

            BelongsTo::make('Prix', 'award', 'App\Nova\Award')
                ->withoutTrashed()
                ->nullable()
                ->sortable()
                ->default(1)
                ->searchable(),

            Number::make('Ordre affichage dans le prix', 'internal_order')
                ->rules('required', 'integer', 'gt:0', 'lt:1000')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Type')
                ->exceptOnForms(),

            Select::make('Type')->options([
                'roman'      => 'Roman',
                'novella'    => 'Novella',
                'nouvelle'   => 'Nouvelle',
                'anthologie' => 'Anthologie',
                'recueil'    => 'Recueil',
                'auteur'     => 'Auteur',
                'special'    => 'Prix spécial',
                'autre'      => 'Autre',
                ])
                ->onlyOnForms(),

            Text::make('Genre')
                ->exceptOnForms(),

            Select::make('Genre')->options([
                'imaginaire'    => 'Imaginaire',
                'sf'            => 'Science-fiction',
                'fantastique'   => 'Fantastique',
                'fantasy'       => 'Fantasy',
                'horreur'       => 'Horreur',
                'mainstream'    => 'Mainstream',
                'autre'         => 'Autre',
                ])
                ->onlyOnForms(),

            Text::make('Sous-genre / précision', 'subgenre')
                ->rules('nullable', 'string', 'max:256')
                ->hideFromIndex()
                ->sortable(),

            Textarea::make('Description', 'description')
                ->rules('nullable', 'string', 'min:5')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            HasMany::make('Lauréats', 'awardwinners', '\App\Nova\AwardWinner'),

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
