@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-600' href="/auteurs">Auteurs</a> &rarr; 
            <span class="border-b-2 border-yellow-300">Pays</span>
    </div>

    <div class='text-xl my-2 bold self-center'>
        A remplacer par les drapeaux et noms des pays !
    </div>

    <div class='flex flex-wrap text-lg bg-gray-300 border border-gray-400 mx-2 md:mx-40 self-center'>
        @foreach($countries as $country)
            <div class='hover:bg-yellow-100' title='{{ $country->name }}'><a class='sm:p-0.5 md:px-0.5' href='/auteurs/pays/{{ $country->name }}'>{{ $country->code }}</a></div>
        @endforeach
    </div>

    @endsection