@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-600' href="/prix">Prix</a> &rarr; 
            <span class="border-b-2 border-yellow-300"> {{ $pays }}</span>
    </div>

    <x-menu-prix-pays tab='{{ $pays }}' :pays="$listepays"/>

    <div class='text-xl text-purple-800 my-2 bold self-center py-2'>
        Liste des prix d'un pays - {{ $pays }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40 self-center'>
        @foreach($prix as $monprix)
            <div class='hover:bg-yellow-100'><a class='sm:p-0.5 md:px-0.5' href='/prix/{{ $monprix->name }}'> {{ $monprix->name }} </a></div>
        @endforeach
    </div>
@endsection