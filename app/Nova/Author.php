<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\TextArea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;

class Author extends Resource
{
    public static $model = \App\Models\Author::class;

    /* Displayed field uses as title on detail pages */
    //public static $title = 'subject';
    public function title () {
        return $this->first_name . " " . $this->name;
    }

    /* The columns that could be searched. */
    public static $search = [
      'id', 'name', 'first_name', 'birth_date', 'date_death'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '1. Biblio';

    /* Model Labels (plural & singular) */
    public static function label () { return "Auteurs"; }
    public static function singularLabel () { return "Auteur"; }

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

            new Panel('Identification', $this->identification()),
            new Panel('Dates et lieux', $this->datesAndPlaces()),
            new Panel('Bio et méta-données', $this->bioAndMetadata()),

            HasMany::make('Websites'),
            BelongsToMany::make('Signatures', 'signatures', '\App\Nova\Author'),
            BelongsToMany::make('References', 'references', '\App\Nova\Author'),
        ];
    }

    protected function identification()
    {

        return [
            Text::make('Nom', 'name')
                ->hideFromIndex(),
            Text::make('Prénom', 'first_name')
                ->hideFromIndex(),
            Text::make('Page BDFI', 'nom_bdfi')
                ->sortable(),

            Text::make('Nom légal', 'legal_name')
                ->nullable()
                ->hideFromIndex(),
            Text::make('Autres formes', 'forms')
                ->hideFromIndex(),

            Boolean::make('Pseu', 'pseudonym')
                ->trueValue('0')
                ->falseValue('1')
                ->rules('required', 'boolean')
                ->sortable(),

            Text::make('H/F', 'gender')
                ->exceptOnForms(),

            Select::make('H/F', 'gender')->options([
                'H' => 'Homme',
                'F'    => 'Femme',
                '?'    => 'Inconnu',
                'IEL'   => 'Non-binaire',
                ])
                ->rules('required', 'string')
                ->onlyOnForms(),
        ];
    }

    protected function datesAndPlaces()
    {
        return [
            BelongsTo::make('Pays', 'country', 'App\Nova\Country')
                ->nullable()
                ->sortable(),
            BelongsTo::make('Pays 2', 'country2', 'App\Nova\Country')
                ->nullable()
                ->hideFromIndex(),

            Text::make('Né le', 'birth_date')
                ->nullable()
                ->sortable(),
            Text::make('Né à', 'birthplace')
                ->nullable()
                ->hideFromIndex(),
            Text::make('Décèdé le', 'date_death')
                ->nullable()
                ->sortable(),
            Text::make('Lieu de décès', 'place_death')
                ->nullable()
                ->hideFromIndex(),

        ];
    }

    protected function bioAndMetadata()
    {
        return [
            Number::make('Lg bio', function() {
                return strlen($this->biography);
            })
                ->onlyOnIndex(),

            Textarea::make('Biographie', 'biography')
                ->rules('required', 'string', 'min:10')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            Textarea::make('Infos de travail et privées', 'private')
                ->rules('required', 'string', 'min:10')
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            BelongsTo::make('Quality', 'quality', 'App\Nova\Quality')
                ->hideFromIndex(),

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
