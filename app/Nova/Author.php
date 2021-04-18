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
    public static $title = 'full_name';

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

    /* The number of results to display when searching for relatable resources without Scout. */
    public static $relatableSearchResults = 50;

    public static $with = ['editor', 'references', 'signatures', 'websites', 'country'];

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

            //new Heading('Avertissement avant une forme'),

            new Panel('Identification', $this->identification()),
            new Panel('Dates et biographie', $this->datesAndBio()),
            new Panel('Historique fiche', $this->commonMetadata()),

            HasMany::make('Websites'),
            BelongsToMany::make('Signatures', 'signatures', '\App\Nova\Author')
                ->searchable(),
            BelongsToMany::make('Références', 'references', '\App\Nova\Author')
                ->searchable(),
        ];
    }

    protected function identification()
    {

        return [
            Text::make('Nom', 'name')
                ->rules('required', 'string', 'max:32')
                ->help('Forme classique "Nom", exemple "Poe", "Levilain-Clément", "La Motte-Fouqué", "Balzac" (sans le "de")...')
                ->sortable(),
            Text::make('Prénom', 'first_name')
                ->rules('nullable', 'string', 'max:32')
                ->sortable(),
            Text::make('Nom BDFI', 'nom_bdfi')
                ->help('Temporaire - Pour lien avec la page BDFI, si elle existe. Forme "NOM Prénom", exemple "POE Edgar Allan".')
                ->rules('nullable', 'string', 'max:64')
                ->hideFromIndex(),

            Text::make('Nom complet', 'full_name')
                ->onlyOnDetail(),
            Text::make('Nom légal', 'legal_name')
                ->rules('nullable', 'string', 'max:128')
                ->help('ATTENTION ! Inutile si constitué des seuls prénom et nom renseignés plus haut. Forme "Prénom(s) Nom" clasique. Sert à indiquer un nom légal plus complet, avec plus de prénoms par exemple.')
                ->nullable()
                ->hideFromIndex(),
            Text::make('Autres formes', 'forms')
                ->rules('nullable', 'string', 'max:512')
                ->help("Variantes d'écriture, écriture dans la langue d'origine, slave par exemple. Les formes multiples sont séparées par des virgules ', '.")
                ->hideFromIndex(),

            Boolean::make('Pseu', 'pseudonym')
                ->rules('required', 'boolean')
                ->sortable(),

            Text::make('H/F', 'gender')
                ->exceptOnForms()
                ->sortable(),

            Select::make('H/F', 'gender')->options([
                'H' => 'Homme',
                'F'    => 'Femme',
                '?'    => 'Inconnu',
                'IEL'   => 'Non-binaire',
                ])
                ->default('?')
                ->rules('required', 'string')
                ->onlyOnForms(),
        ];
    }

    protected function datesAndBio()
    {
        return [
            BelongsTo::make('Pays', 'country', 'App\Nova\Country')
                ->withoutTrashed()
                ->default(1)
                ->sortable(),
            BelongsTo::make('Pays 2', 'country2', 'App\Nova\Country')
                ->withoutTrashed()
                ->nullable()
                ->hideFromIndex(),

            Text::make('Né le', 'birth_date')
                ->rules('nullable', 'string', 'size:10', 'regex:/[\-012][\-0-9]{3}-(circa|[0-9]{2}-[0-9]{2})/')
                ->help("Format 'AAAA-MM-JJ' (exemple : 1983-05-19). 'AAAA-00-00' si l'année seule est connue, et vide ou '0000-00-00' si la date est inconnue. Les formats '1410-circa' ou '-500-circa' sont également acceptés.")
                ->sortable(),
            Text::make('Né à', 'birthplace')
                ->rules('nullable', 'string', 'max:64')
                ->help('Laisser vide si lieu inconnu. Format général "Ville, Département", ou "Ville, Pays" si hors France.')
                ->hideFromIndex(),
            Text::make('Décèdé le', 'date_death')
                ->rules('nullable', 'string', 'size:10', 'regex:/[\-012][\-0-9]{3}-(circa|[0-9]{2}-[0-9]{2})/')
                ->help("Format 'AAAA-MM-JJ' (exemple : 1983-05-19). 'AAAA-00-00' si l'année seule est connue, et vide ou '0000-00-00' si la date est inconnue. Les formats '1410-circa' ou '-500-circa' sont également acceptés.")
                ->hideFromIndex(),
            Text::make('Lieu de décès', 'place_death')
                ->rules('nullable', 'string', 'max:64')
                ->hideFromIndex(),

            Number::make('Lg bio', function() {
                return strlen($this->biography);
            })
                ->onlyOnIndex(),

            Number::make('Sites', 'websites_count')
                ->onlyOnIndex(),

            Text::make('Refs & Sign', function() {
                $nbrefs = $this->references_count;
                $nbsigs = $this->signatures_count;
                if ($nbrefs != 0) {
                    if ($nbsigs != 0) {
                        return $nbrefs . " ref. & " . $nbsigs . " signat.";
                    }
                    else {
                        return $nbrefs . " ref.";
                    }
                }
                else {
                    if ($nbsigs != 0) {
                        return $nbsigs . " signat.";
                    }
                    else {
                        return "--";
                    }
                }
            })
                ->onlyOnIndex(),

            Textarea::make('Biographie', 'biography')
                ->help("Biographie succincte. Pas de copier-coller de textes trouvés sur Internet (mais on peut s'inspirer pour résumer bien sur !).")
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            Textarea::make('Infos de travail et privées', 'private')
                ->help("Informations privées (que l'auteur ne souhaite pas voir diffusées) ou de travail : doutes, choses à vérifier, ce qu'il faudrait revoir...")
                ->nullable()
                ->rows(3)
                ->alwaysShow()
                ->hideFromIndex(),

            BelongsTo::make('Etat d\'avancement fiche', 'quality', 'App\Nova\Quality')
                ->withoutTrashed()
                ->hideFromIndex(),

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
