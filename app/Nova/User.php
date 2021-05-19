<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;

class User extends Resource
{

    /* Logical group in the sidebar menu - Optional */
    public static $group = '9. Gestion';

    public static function label () { return "Utilisateurs"; }
    public static function singularLabel () { return "utilisateur"; }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

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

            Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'string', 'min:3', 'max:12'),
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:64')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8', 'max:64')
                ->updateRules('nullable', 'string', 'min:8', 'max:64'),

            Text::make('Role')
                ->exceptOnForms(),

            Select::make('Role')->options([
                'user'     => 'Simple utilisateur BDFI',
                'visitor'  => 'Visiteur zone Admin',
                'editor'   => 'editeur zone Admin',
                'admin'    => 'Administrateur',
                'sysadmin' => 'Administrateur Système',
            ])
                ->default('user')
                ->rules('required')
                ->showOnCreating(function ($request) {
                    return $request->user()->isSysAdmin();
                })
                ->showOnUpdating(function ($request) {
                    return $request->user()->isSysAdmin();
                }),

            Select::make('Role')->options([
                'user'     => 'Simple utilisateur BDFI',
                'visitor'  => 'Visiteur zone Admin',
                'editor'   => 'editeur zone Admin',
            ])
                ->default('user')
                ->rules('required')
                ->hideWhenUpdating()
                ->showOnCreating(function ($request) {
                    return $request->user()->isAdmin();
                }),

            Select::make('Role')->options([
                'user'     => 'Simple utilisateur BDFI',
                'visitor'  => 'Visiteur zone Admin',
                'editor'   => 'editeur zone Admin',
                'admin'    => 'Administrateur',
                'sysadmin' => 'Administrateur Système',
            ])
                ->readonly()
                ->default('user')
                ->rules('required')
                ->showOnCreating(function ($request) {
                    return !$request->user()->hasAdminRole();
                })
                ->showOnUpdating(function ($request) {
                    return !$request->user()->isSysAdmin();
                }),
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
