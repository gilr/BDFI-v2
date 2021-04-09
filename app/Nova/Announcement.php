<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Announcement extends Resource
{
    public static $model = \App\Models\Announcement::class;

    /* Displayed field uses as title on detail pages */
    public static $title = 'subject';

    /* The columns that could be searched. */
    public static $search = [
        'id', 'name', 'description', 'date', 'type'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Tables site';

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
            Text::make('Date', 'date')
                ->rules('required', 'string', 'size:10')
                ->placeholder('aaaa/mm/jj')
                ->help('Format obligatoire année, mois puis jour, exemple "2020/05/20". Si Type=[Remerciement] => date de réception de l\'aide - Sinon, saisir la date de l\'annonce ou de l\'info.')
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

            Text::make('Sujet', 'name')
                ->rules('required', 'string', 'min:3', 'max:64')
                ->help('Le "titre/sujet" dépend du type d\'info. Si Type=[Remerciement] ou [Consécration] => prénom + nom ou pseudo - Si Type=[Point historique] ou [Autre] => Période (mois, trimestre, ex "Avril 2014") - Si Type=[Changement site] => Sujet')         
                ->sortable(),

            Textarea::make('Description', 'description')
                ->rules('required', 'string', 'min:10')
                ->rows(3)
                ->alwaysShow()
                ->sortable(),

            Text::make('URL', 'url')
                ->nullable()
                ->help('Laisser vide, ou URL forum si l\'annonce détaillée existe, ou si auteur, URL de sa page biblio bdfi.')
                ->sortable(),

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
        ];
    }
            /*$table->increments('id');
            $table->enum('type', ['annonce_contenu','annonce_site','point_histo','point_aides','point_stats','remerciement','consecration','autre']);
            $table->string('url')->nullable();
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
