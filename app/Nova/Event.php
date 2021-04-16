<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class Event extends Resource
{
    public static $model = \App\Models\Event::class;
    /* Displayed field uses as title on detail pages */
    public static $title = 'name';

    /* The columns that could be searched. */
    public static $search = [
        'id', 'name', 'description', 'start_date', 'end_date', 'type', 'place'
    ];

    /* Logical group in the sidebar menu - Optional */
    public static $group = '2. Site';

    /* Model Labels (plural & singular) */
    public static function label () { return "Evènements"; }
    public static function singularLabel () { return "Evènement"; }

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

            Text::make('Type')
                ->exceptOnForms()
                ->sortable(),

            Select::make('Type')->options([
                    'convention' => 'Convention',
                    'festival' => 'Festival',
                    'exposition' => 'Exposition',
                    'salon' => 'Salon',
                    'film-festival' => 'Festival cinéma',
                    'autre' => 'Autre',
                    ])
                ->rules('required', 'string')
                ->onlyOnForms(),

            Text::make('Sujet', 'truncated_name')
                ->asHtml()
                ->onlyOnIndex(),
            Text::make('Sujet', 'name')
                ->rules('required', 'string', 'min:3', 'max:128')
                ->hideFromIndex(),

            Date::make('Date de début', 'start_date')
                ->pickerDisplayFormat('Y-m-d')
                ->default(today())
                ->help('Date du début de l\évènement. Par défaut, la date de ce jour est pré-remplie.')
                ->rules('required')
                ->sortable(),
            Date::make('Date de fin', 'end_date')
                ->pickerDisplayFormat('Y-m-d')
                ->rules('required', 'after_or_equal:start_date')
                ->hideFromIndex()
                ->sortable(),

            Boolean::make('Confirmé', 'is_confirmed')
                ->help('A laisser coché si la programmation a été annoncée et confirmée. A décocher sinon.')
                ->rules('boolean')
                ->default(1),
            Boolean::make('Littérature ET Imaginaire', 'is_full_scope')
                ->help('A laisser décoché s\'il s\'agit d\'un évènement hors littérature, ou hors imaginaire.')
                ->rules('boolean')
                ->default(0),

            Text::make('Lieu', 'place')
                ->rules('required', 'string', 'min:3', 'max:64')
                ->hideFromIndex(),

            Textarea::make('Description', 'description')
                ->rules('required', 'string', 'min:10')
                ->rows(3)
                ->alwaysShow(),

            Text::make('URL', 'url')
                ->nullable()
                ->rules('nullable', 'url', 'max:256')
                ->help('Laisser vide, ou URL forum si une discussion existe, ou URL de l\'évènement lui-même.')
                ->hideFromIndex(),

            DateTime::make('Publié sur BDFI à partir de', 'publication_date')
                ->help('A n\'utiliser que si vous souhaiter que l\'annonce ne soit publiée - automatiquement - que plus tard.')
                ->format('DD/MM/YYYY HH:mm')
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
