<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
//use Laravel\Nova\Http\Requests\NovaRequest;

class Announcement extends Resource
{
    public static $model = \App\Models\Announcement::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    /* The columns that could be searched. */
    public static $search = [
        'id', 'name', 'description', 'date', 'type'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Site';

    /* Model Labels (plural & singular) */
    public static function label () { return "Annonces"; }
    public static function singularLabel () { return "Annonce"; }

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

            Date::make('Date', 'date')
                ->pickerDisplayFormat('Y-m-d')
                ->default(today()->format('Y-m-d'))
                ->rules('required', 'date_format:Y-m-d')
                ->help('Format obligatoire AAAA-MM-JJ. Si le Type est [Remerciement], entrez la date de réception de l\'aide - Sinon, saisir la date de l\'annonce ou de l\'information. Par défaut, la date de ce jour est pré-remplie.')
                ->sortable(),

            Text::make('Type')
                ->exceptOnForms(),

            Select::make('Type')->options([
                'remerciement' => 'Remerciement',
                'annonce_contenu'    => 'Référencement données',
                'annonce_site'   => 'Evolution site',
                'point_histo'    => 'Point historique',
                'point_aides' => 'Point sur les aides',
                'point_stats' => 'Point statistique',
                'consecration' => 'Consecration',
                'autre' => 'Autre',
                ])
                ->rules('required', 'string')
                ->onlyOnForms(),

            Text::make('Titre / Sujet', function() {
                return Str::limit($this->name, 30, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->asHtml()
                ->onlyOnIndex(),

            Text::make('Titre / Sujet', 'name')
                ->rules('required', 'string', 'min:3', 'max:64')
                ->help('Le "titre/sujet" dépend du type d\'info. Si Type=[Remerciement] ou [Consécration] => prénom + nom ou pseudo - Si Type=[Point historique] ou [Autre] => Période (mois, trimestre, ex "Avril 2014") - Si Type=[Changement site] => Sujet')
                ->hideFromIndex(),

            Text::make('Description', function() {
                return Str::limit($this->truncated_description, 45, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->asHtml()
                ->onlyOnIndex(),
            Textarea::make('Description', 'description')
                ->rules('required', 'string', 'min:10')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            Text::make('URL', 'url')
                ->rules('nullable', 'url', 'max:256')
                ->help('Laisser vide, ou URL forum si l\'annonce détaillée existe, ou si auteur, URL de sa page biblio bdfi.')
                ->onlyOnForms(),

            Text::make('URL site', function() {
                return !isSet($this->url) ? $this->url : "<a href='$this->url'>$this->url</a>";
            })
                ->asHtml()
                ->onlyOnDetail(),


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
