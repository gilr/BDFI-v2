<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\AwardWinner;
use App\Models\AwardCategory;
use Illuminate\Http\Request;

class AwardController extends Controller
{

    public function welcome()
    {

        $annees = array_merge (range (1927, 1933), range (1951, date("Y")));
        $types = ['roman','novella','nouvelle','anthologie','recueil','auteur','special','autre'];
        $genres = ['imaginaire','sf','fantastique','fantasy','horreur','mainstream','autre'];

        $prix = Award::orderBy('country_id', 'asc')->orderBy('name', 'asc')->get();

        return view('front.prix.welcome', compact('annees', 'types', 'genres', 'prix'));
    }

    public function annee(Request $request, $annee)
    {
        $annees = array_merge (range (1927, 1933), range (1951, date("Y")));

        $laureats = AwardWinner::where('year', $annee)->where('position', 1)->orderBy('name', 'asc')->get();
        return view('front.prix.annee', compact('annees', 'annee', 'laureats'));
    }

    public function genre(Request $request, $genre)
    {
        $genres = ['imaginaire','sf','fantastique','fantasy','horreur','mainstream','autre'];
        $categories = AwardCategory::where('genre', $genre)->orderBy('name', 'asc')->get();
        return view('front.prix.genre', compact('genres', 'genre', 'categories'));
    }

    public function type(Request $request, $type)
    {
        $types = ['roman','novella','nouvelle','anthologie','recueil','auteur','special','autre'];
        $categories = AwardCategory::where('type', $type)->orderBy('name', 'asc')->get();
        return view('front.prix.type', compact('types', 'type', 'categories'));
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

        $categories = AwardCategory::where('award_id', $prix->id)->orderBy('name', 'asc')->get();
        return view('front.prix.prix', compact('prix', 'categories'));
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
