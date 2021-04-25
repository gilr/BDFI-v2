<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('auteurs');
    }

    public function page($text)
    {
        if ((substr($text, 0, 1) == "_") && (strlen($text) == 2)) {
            // Trouver tous les auteurs commençant par l'initiale
            $initiale = substr($text, 1, 1);
            $query = Author::query();
            $query->where('name', 'like', $initiale.'%');
            // paginer les résultats
            $results = $query->orderBy('name', 'asc')->simplePaginate(72);
            return view('index', compact('initiale', 'results'));
        }
        else if ($results=Author::find($text))
        {
            // Un ID est passé
            $input='id';
            return view ('page', compact('input', 'results'));
        }
        else {
            // Trouver tous les auteurs avec le nom fourni
            // Trouver tous les auteurs avec le nom fourni
            // Si plusieurs => index intermédiaire
            // Si pas trouvé, page de rechercher
            $input='name';
            $query = Author::query();
            $query->where('name', 'like', $text);
            $results = $query->orderBy('name', 'asc')->simplePaginate(10);
            if ($results == null) {
                $request->session()->flash('danger', 'Consultation impossible : enregistrement demandé (id interne # ' . $id . ') non trouvé.');
                return redirect('auteurs');
            }
            else
            {
                return view ('page', compact('name', 'results'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
