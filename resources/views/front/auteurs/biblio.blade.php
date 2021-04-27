@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Auteurs &rarr; Index {{ strtoupper(substr($results->name, 0, 1)) }} &rarr; {{ $results->first_name }} {{ $results->name }}</span>
    </div>

    <div class='flex text-lg sm:text-2xl font-mono font-bold bg-gray-300 border border-gray-400 p-0.5 self-center'>
    <?php
        for ($i = 'A'; $i != 'AA'; $i++) {
            if (strtolower($i) != strtolower(substr($results->name, 0, 1))) {
                echo "<div class='hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/_" . strtolower($i) . "'>$i</a></div>";
            }
            else {
                echo "<div class='text-yellow-800 bg-yellow-300 hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/_" . strtolower($i) . "'>$i</a></div>";
            }
        }
    ?>
    </div>
    <div class='text-2xl font-bold pt-2 mt-2 self-center'>
        {{ $results->first_name }} {{ $results->name }}
    </div>
    <div class='text-xl self-center'>
        {{ $results->country->name }}
    </div>
    <div class='text-base self-center'>
        {{ $datesPattern }}
    </div>
    <div class='text-xl bg-gray-200 py-8 m-2 md:mx-16 self-center border-b-2 border-blue-300'>
        {!! $results->biography !!}
    </div>
    <div class='text-lg p-2 mt-6 mx-2 lg:mx-40 self-center bg-yellow-100'>
        @auth
            @if (auth()->user()->hasVisitorRole())
                Vous êtes authentifié avec au moins des droits de visite, vous avez donc un accès direct à la fiche auteur => <a class="text-red-700" href="/nova/resources/authors/{{ $results->id }}" target="_blank">accès fiche <span class="font-bold">{{ $results->first_name }} {{ $results->name }}</span></a> (s'ouvre dans un nouvel onglet).<br />Si vous n'êtes que simple visiteur, vous ne pourrez pas faire de modifications.
            @else
                Vous être authentifié, mais sans aucun droits de visite (utilisateur BDFI simple). Vous n'avez pas accès à la fiche auteur.
            @endif
        @endauth
        @guest
            Vous n'êtes pas authentifié, vous n'avez pas d'accès à la fiche auteur. 
        @endguest
    </div>

@endsection