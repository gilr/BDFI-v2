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
        return view('front.auteurs.welcome');
    }

    public function page(Request $request, $text)
    {
        if ((substr($text, 0, 1) == "_") && (strlen($text) == 2)) {
            // Trouver tous les auteurs commençant par l'initiale
            $initiale = substr($text, 1, 1);
            $query = Author::query();
            $query->where('name', 'like', $initiale.'%');
            // paginer les résultats
            $results = $query->orderBy('name', 'asc')->simplePaginate(72);
            return view('front.auteurs.index', compact('initiale', 'results'));
        }
        else if ($results=Author::find($text))
        {
            // Un ID est passé
            $datesPattern = formatAuthorDates ($results->gender, $results->birth_date, $results->date_death, $results->birthplace);
            return view ('front.auteurs.biblio', compact('results', 'datesPattern'));
        }
        else {
            // Trouver tous les auteurs avec le nom fourni
            // Si plusieurs => index intermédiaire
            // Si pas trouvé, page de recherche (page auteurs pour l'instant)
            $query = Author::query();
            $query->where('name', 'like', '%' . $text .'%');
            $query->orWhere('first_name', 'like', '%' . $text .'%');
            $results = $query->paginate(48);
            if ($results->total() == 0) {
                $request->session()->flash('warning', 'Le nom demandé (' . $text . ') n\'est pas trouvé.');
                return redirect('auteurs');
            }
            else if($results->total() == 1)
            {
                $results = $results[0];
                $datesPattern = formatAuthorDates ($results->gender, $results->birth_date, $results->date_death, $results->birthplace);
                return view ('front.auteurs.biblio', compact('results', 'datesPattern'));
            }
            else
            {
                // Page de choix sur base du pattern fourni
                return view ('front.auteurs.choix', compact('text', 'results'));
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
