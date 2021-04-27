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
            $results = Author::where('is_visible', 1)->where('name', 'like', $initiale.'%')->orderBy('name', 'asc')->simplePaginate(120);
            return view('front.auteurs.index', compact('initiale', 'results'));
        }
        else if (($results=Author::find($text)) && ($results->is_visible == 1))
        {
            // Un ID est passé
            // TBD : Il faudra supprimer l'accès par Id au profit d'un slug => unicité
            $datesPattern = formatAuthorDates ($results->gender, $results->birth_date, $results->date_death, $results->birthplace);
            return view ('front.auteurs.biblio', compact('results', 'datesPattern'));
        }
        else {
            // Trouver tous les auteurs avec le pattern fourni
            $results = Author::where('is_visible', 1)->where(function($query) use($text) {
                $query->where ('name', 'like', '%' . $text .'%')
                        ->orWhere('first_name', 'like', '%' . $text .'%');
            })->orderBy('name', 'asc')->paginate(60);
            if ($results->total() == 0) {
                // Rien trouvé, redirection vers l'accueil auteurs
                $request->session()->flash('warning', 'Le nom ou l\'extrait de nom demandé ("' . $text . '") n\'est pas trouvé. Vous avez été redirigé sur l\'accueil de la zone auteurs.');
                return redirect('auteurs');
            }
            else if($results->total() == 1)
            {
                // Un seul trouvé, on redirige vers lui
                $request->session()->flash('warning', 'Ce nom complet demandé ("' . $text . '") n\'existe pas. Mais comme chez BDFI on est cool, on a fouillé un peu et on vous a trouvé un résultat possible. Essayez quand même d\'indiquer un nom complet la prochaine fois, ou passez par le moteur de recherche.');
                $results = $results[0];
                $datesPattern = formatAuthorDates ($results->gender, $results->birth_date, $results->date_death, $results->birthplace);
                return view ('front.auteurs.biblio', compact('results', 'datesPattern'));
            }
            else
            {
                // 
                $request->session()->flash('warning', 'Le nom ou l\'extrait de nom demandé ("' . $text . '") n\'existe pas de façon unique. Nous vous redirigeons vers une page de choix en espérant que vous y trouviez votre bonheur. Utilisez de préférence notre moteur de recherche.');
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
