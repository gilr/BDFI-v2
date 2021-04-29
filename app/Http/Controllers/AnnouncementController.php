<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    public function welcome()
    {
        return view('front.site.welcome');
    }

    public function news()
    {
        setlocale( LC_TIME, "fr-FR" );
        $results = Announcement::where([
            ['type', '<>', 'remerciement'],
            ['type', '<>', 'consecration']
        ])->orderBy('date', 'desc')->simplePaginate(25);
        return view('front.site.news', compact('results'));
    }

    public function stats()
    {
        return view('front.site.base');
    }

    public function thanks()
    {
        $results = Announcement::where('type', '=', 'remerciement')->orderBy('date', 'desc')->simplePaginate(100);
        return view('front.site.merci', compact('results'));
    }

    public function help()
    {
        return view('front.site.aides');
    }

    public function about()
    {
        return view('front.site.about');
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
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
