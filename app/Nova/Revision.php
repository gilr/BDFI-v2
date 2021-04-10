<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;

class Revision extends Resource
{
    public static $model = \Venturecraft\Revisionable\Revision::class;

    /* Logical group in the sidebar menu - Optional */
    public static $group = '4. Administration';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /* The columns that should be searched. */
    public static $search = [
        'key', 'old_value', 'new_value',
    ];

    /* The visual style used for the table. Available options are 'tight' and 'default' */
    public static $tableStyle = 'tight';

    public static function label () { return "Modifications"; }
    public static function singularLabel () { return "modification"; }

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
            Text::make('Table', function() {
                switch (substr($this->revisionable_type, 11)) {
                    case "Country":
                        return "Pays";
                        break;
                    case "RelationshipType":
                        return "Types relation";
                        break;
                    case "WebsiteType":
                        return "Types site";
                        break;
                    case "Announcement":
                        return "Annonces";
                        break;
                    case "Author":
                        return "Auteurs";
                        break;
                    default:
                        return substr($this->revisionable_type, 11);
                        break;
                }
            }),
            Number::make('Elément', 'revisionable_id'),
            Text::make('Elem', function() {
                return '<a href="" class="no-underline dim text-primary font-bold">' . $this->revisionable_id . '</a>';
            })->asHtml(),

            Text::make('Nom de l\'élément', function() {
                if (class_exists($class = $this->revisionable_type)) {
                        return $class::find($this->revisionable_id)->name;
                }
            })
                ->onlyOnDetail(),
            // Text::make('Champ', 'key'),
            Text::make('Champ', function() {
                return $this->fieldName();
            }),

            //TBD pour les deux suivants
            //    prévoir une décooupe avec un nombre max de caractères si sur index
            Text::make('Ancienne valeur', 'old_value'),
            Text::make('Nouvelle valeur', 'new_value'),
            DateTime::make('Réalisé le', 'created_at')
                ->format('DD/MM/YYYY HH:mm'),

            Text::make('Par', function() {
                return '<a href="/nova/resources/users/'. $this->user_id .'" class="no-underline dim text-primary font-bold">' . $this->userResponsible()->name . '</a>';
            })->asHtml(),

            Number::make('... de user Id', 'user_id')
                ->onlyOnDetail(),
            DateTime::make('Modifié le', 'updated_at')
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),

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
