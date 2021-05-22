@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <span class="border-b-2 border-yellow-300">Prix</span>
    </div>

    <div class='flex flex-wrap text-md px-1 mx-1 md:mx-8 self-center'>
        <span class='m-0.5'>Prix par année </span>
        @foreach($annees as $annee)
            <span class='hover:bg-yellow-100 bg-gray-300 border border-gray-400 m-0.5' title='{{ $annee }}'><a class='md:px-0.5' href='/prix/annee/{{ $annee }}'>{{ $annee }}</a></span>
        @endforeach
    </div>

    <x-menu-prix-genre tab='welcome' :genres="$genres"/>

    <x-menu-prix-type tab='welcome' :types="$types"/>

    <div class='text-xl my-2 bold self-center'>
        Accès aux prix :
    </div>
    <div class='grid grid-cols-1 sm:grid-cols-2 text-base px-2 mx-2 md:mx-40 self-center w-full sm:w-8/12'>
        @foreach($prix as $myprix)
            <div class='hover:bg-yellow-100 border-b hover:border-purple-600'><a class='sm:p-0.5 md:px-0.5' href='/prix/{{ $myprix->name }}'>{{ $myprix->name }} ({{ $myprix->country->name }})</a></div>
        @endforeach
    </div>

@endsection