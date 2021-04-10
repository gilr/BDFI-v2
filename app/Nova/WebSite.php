<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class WebSite extends Resource
{
    public static $model = \App\Models\WebSite::class;
    /* Displayed field uses as title on detail pages */
    public static $title = 'url';

    /* The columns that could be searched. */
    public static $search = [
      'id', 'url'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '1. Tables biblio';

    /* Model Labels (plural & singular) */
    public static function label () { return "Sites web"; }
    public static function singularLabel () { return "Site web"; }

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

            BelongsTo::make('Auteur', 'author', 'App\Nova\Author')
                ->sortable()
                ->searchable(),

            Text::make('URL site', 'url')
                ->sortable(),

            BelongsTo::make('Type de site web', 'website_type', 'App\Nova\WebsiteType')
                ->sortable(),

            BelongsTo::make('Pays', 'country', 'App\Nova\Country')
                ->sortable()
                ->searchable(),
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
