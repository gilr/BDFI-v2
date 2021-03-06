<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\AwardWinner;
use App\Models\AwardCategory;
use Illuminate\Http\Request;


class AwardController extends Controller
{

    protected $types = ['auteur', 'roman', 'novella', 'nouvelle', 'anthologie', 'recueil', 'texte', 'special'];

    protected $genres = ['sf', 'fantastique', 'fantasy', 'horreur', 'imaginaire', 'mainstream'];

    protected function annees ()
    {
        return array_merge (range (1927, 1933), range (1951, date("Y")));
    }
    protected function listepays ()
    {
        $listeprix = Award::join('countries', 'countries.id', '=', 'awards.country_id')->select('country_id', 'countries.name')->orderBy('country_id', 'asc')->get()->unique('country_id')->all();
        //ddd($listeprix);
        return $listeprix;
    }

    public function welcome()
    {
        $genres = $this->genres;
        $types = $this->types;
        $annees = $this->annees();
        $pays = $this->listepays();
        $prix = Award::orderBy('country_id', 'asc')->orderBy('name', 'asc')->get();

        return view('front.prix.welcome', compact('annees', 'types', 'genres', 'pays', 'prix'));
    }

    public function annee(Request $request, $annee)
    {
        $annees = $this->annees();
        $laureats = AwardWinner::where('year', $annee)->where('position', 1)->join('award_categories', 'award_categories.id', '=', 'award_category_id')->orderBy('award_categories.type', 'asc')->select('award_winners.*', 'award_categories.type')->get()->groupBy('type');

        return view('front.prix.annee', compact('annees', 'annee', 'laureats'));
    }

    public function genre(Request $request, $genre)
    {
        $genres = $this->genres;
        $categories = AwardCategory::where('genre', $genre)->join('awards', 'awards.id', '=', 'award_id')->orderBy('awards.name', 'ASC')->orderBy('type')->select('award_categories.*')->get();

        return view('front.prix.genre', compact('genres', 'genre', 'categories'));
    }

    public function type(Request $request, $type)
    {
        $types = $this->types;
        $categories = AwardCategory::where('type', $type)->join('awards', 'awards.id', '=', 'award_id')->orderBy('awards.name', 'ASC')->orderBy('internal_order')->select('award_categories.*')->get();

        return view('front.prix.type', compact('types', 'type', 'categories'));
    }

    public function pays(Request $request, $pays)
    {
        $listepays = $this->listepays();
        //$categories = AwardCategory::join('awards', 'awards.id', '=', 'award_id')->join('countries', 'countries.id', '=', 'awards.country_id')->where('countries.name', $pays)->orderBy('awards.name', 'ASC')->orderBy('internal_order')->select('award_categories.*')->get();
        $prix = Award::join('countries', 'countries.id', '=', 'awards.country_id')->where('countries.name', $pays)->orderBy('awards.name', 'ASC')->select('awards.*')->get();

        return view('front.prix.pays', compact('listepays', 'pays', 'prix'));
    }

    public function categorie(Request $request, $category_id)
    {
        $result = AwardCategory::find($category_id);
        $prix = $result->award->name;
        $categorie = $result->name;

        $laureats = AwardWinner::where('award_category_id', $category_id)->orderBy('year', 'asc')->get();

        return view('front.prix.categorie', compact('prix', 'categorie', 'laureats'));
    }

    public function prix(Request $request, $award)
    {
        $prix = Award::where('name', $award)->first();

        $categories = AwardCategory::where('award_id', $prix->id)->orderBy('internal_order', 'asc')->get();
        $laureats = NULL;
        if ($categories->count() == 1) {
            $laureats = AwardWinner::where('award_category_id', $categories->first()->id)->orderBy('year', 'asc')->get();
        }

        return view('front.prix.prix', compact('prix', 'categories', 'laureats'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        //
    }
}
