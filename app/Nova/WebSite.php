<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class WebSite extends Resource
{
    public static $model = \App\Models\WebSite::class;
    /* Displayed field uses as title on detail pages */
    public static $title = 'id';

    /* The columns that could be searched. */
    public static $search = [
      'id', 'url'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '1. Biblio';

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
                ->withoutTrashed()
                ->sortable()
                ->searchable(),

            Text::make('URL Site', function() {
                return Str::limit($this->url, 50, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->asHtml()
                ->onlyOnIndex(),
            Text::make('URL site', function() {
                return "<a href='$this->url'>$this->url</a>";
            })
                ->asHtml()
                ->onlyOnDetail(),
            Text::make('URL', 'url')
                ->rules('required', 'url', 'min:10', 'max:256')
                ->help('Format complet, commençant par "http://" ou "https://"')
                ->onlyOnForms(),


            BelongsTo::make('Type de site web', 'website_type', 'App\Nova\WebsiteType')
                ->withoutTrashed()
                ->sortable(),

            BelongsTo::make('Pays (langue)', 'country', 'App\Nova\Country')
                ->withoutTrashed()
                ->sortable()
                ->searchable(),

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
