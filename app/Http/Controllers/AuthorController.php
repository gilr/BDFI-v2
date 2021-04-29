<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Country;

class AuthorController extends Controller
{
    /**
     * Accueil de la zone auteur : /auteurs
     */
    public function welcome()
    {
        $countries = Country::select('name', 'code')->orderBy('name', 'asc')->get();
        return view('front.auteurs.welcome', compact('countries'));
    }

    /**
     * Index par initiale des auteurs : /auteurs/index/{i}
     */
    public function index(Request $request, $initial)
    {
        if ((strlen($initial) == 1) && ctype_alpha($initial))
        {
            $results = Author::where('is_visible', 1)->where('name', 'like', $initial.'%')->orderBy('name', 'asc')->simplePaginate(120);
            return view('front.auteurs.index', compact('initial', 'results'));
        }
        else
        {
            $request->session()->flash('warning', 'Vous semblez vous être perdu dans un lieu dédié aux initiales, mais avec une initiale non constituée d\'une lettre unique ("'.$initial.'" ?!). Vous avez pris des risques. Pour le coup, vous êtes renvoyé directement vers l\'accueil de la zone auteurs...');
            return redirect('auteurs');
        }
    }

    /**
     * Index des auteurs par pays : /auteurs/pays/{pays}
     */
    public function pays(Request $request, $text)
    {
        if ($searched_country = Country::where('name', $text)->get())
        {
            $pays = $searched_country[0]->name;
            $countries = Country::select('name', 'code')->orderBy('name', 'asc')->get();
            $results = Author::where('is_visible', 1)->where('country_id', $searched_country[0]->id)->orderBy('name', 'asc')->simplePaginate(120);
            return view('front.auteurs.pays', compact('pays', 'countries', 'results'));
        }
    }

    /**
     * Page auteur... ou renvoi vers une initiale... ou page de choix : /auteurs/{pattern}
     */
    public function page(Request $request, $text)
    {
        if (($results=Author::find($text)) && ($results->is_visible == 1))
        {
            // /auteurs/{id}
            // Un ID est passé - Pour l'instant c'est la façon propre d'afficher une page auteur
            // TBD : Il faudra supprimer l'accès par Id au profit d'un slug => unicité
            $datesPattern = formatAuthorDates ($results->gender, $results->birth_date, $results->date_death, $results->birthplace);
            return view ('front.auteurs.biblio', compact('results', 'datesPattern'));
        }
        else if ((strlen($text) == 1) && ctype_alpha($text))
        {
            // /auteurs/{i}
            // Une caractère seul est passé  => on renvoit sur l'initiale
            $request->session()->flash('warning', 'L\'URL utilisée ("/auteurs/'.$text.'")ne correspond pas à l\'URL des index ("/auteurs/index/'.$text.'"), mais comme on est sympa, on a travaillé pour vous rediriger sur l\'index adéquat. Hop.');
            return redirect("auteurs/index/$text");
        }
        else
        {
            // /auteurs/{pattern}
            // Recherche de tous les auteurs avec le pattern fourni
            $results = Author::where('is_visible', 1)->where(function($query) use($text) {
                $query->where ('name', 'like', '%' . $text .'%')
                        ->orWhere('first_name', 'like', '%' . $text .'%');
            })->orderBy('name', 'asc')->paginate(60);

            if ($results->total() == 0) {
                // Aucun résultat, redirection vers l'accueil auteurs
                $request->session()->flash('warning', 'Le nom ou l\'extrait de nom demandé ("' . $text . '") n\'est pas trouvé. Vous avez été redirigé sur l\'accueil de la zone auteurs.');
                return redirect('auteurs');
            }
            else if($results->total() == 1)
            {
                // Un résultat unique, on redirige gentiment vers lui
                $request->session()->flash('warning', 'Ce nom complet demandé ("' . $text . '") n\'existe pas. Mais comme chez BDFI on est cool, on a fouillé un peu et on vous a trouvé un résultat possible. Essayez quand même d\'indiquer un nom complet la prochaine fois, ou passez par le moteur de recherche.');
                $results = $results[0];
                $datesPattern = formatAuthorDates ($results->gender, $results->birth_date, $results->date_death, $results->birthplace);
                return view ('front.auteurs.biblio', compact('results', 'datesPattern'));
            }
            else
            {
                // Résultats multiples, on propose une page de choix
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
