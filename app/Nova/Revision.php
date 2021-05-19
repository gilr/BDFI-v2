<?php

namespace App\Nova;

use Illuminate\Support\Str;
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
    public static $group = '9. Gestion';

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
                return class_basename($this->revisionable_type);
            }),

            Text::make('ID item', function() {
                $href = "/nova/resources/". Str::plural(Str::kebab(class_basename($this->revisionable_type))) . "/" . $this->revisionable_id;
                $title = class_exists($class = $this->revisionable_type) ? $class::withTrashed()->find($this->revisionable_id)->name : "...";
                return '<a href="'. $href . '" class="no-underline dim text-primary font-bold" title="' . $title . '">' . $this->revisionable_id . '</a>';
            })->asHtml(),

            Text::make('Nom item', function() {
                if (class_exists($class = $this->revisionable_type)) {
                        return $class::withTrashed()->find($this->revisionable_id)->name;
                }
            })
                ->onlyOnDetail(),

            Text::make('Champ', function() {
                return $this->fieldName();
            }),

            Text::make('Ancienne valeur', function() {
                return "<span style='color:red'>" . $this->oldValue() . "</span>";
            })
                ->hideFromIndex()
                ->asHtml(),
            Text::make('Ancienne valeur', function() {
                return Str::limit($this->old_value, 40, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->onlyOnIndex()
                ->asHtml(),

            Text::make('Nouvelle valeur', function() {
                return "<span style='color:blue'>" . $this->new_value . "</span>";
            })
                ->hideFromIndex()
                ->asHtml(),
            Text::make('Nouvelle valeur', function(){
                return Str::limit($this->new_value, 40, "<span style='bold;background-color:lightgreen;'>&mldr;</span>");
            })
                ->onlyOnIndex()
                ->asHtml(),

            DateTime::make('Réalisée le', 'created_at')
                ->format('DD/MM/YYYY HH:mm'),

            Text::make('Par', function() {
                return '<a href="/nova/resources/users/'. $this->user_id .'" class="no-underline dim text-primary font-bold">' . $this->userResponsible()->name . '</a>';
            })->asHtml(),

            Number::make('... de user Id', 'user_id')
                ->onlyOnDetail(),
/*            DateTime::make('Modifié le', 'updated_at')
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),*/

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
