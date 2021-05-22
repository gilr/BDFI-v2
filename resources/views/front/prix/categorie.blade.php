@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-400' href="/prix">Prix</a> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-400' href="/prix/{{ $prix }}">{{ $prix }}</a> &rarr; 
            <span class="border-b-2 border-yellow-300">{{ $categorie }}</span>
    </div>

    <div class='text-xl my-2 bold self-center'>
        Liste des lauréats de la catégorie {{ $categorie }}, {{ $prix }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40 self-center'>
        @foreach($laureats as $laureat)
            @if ($laureat->position == 99)
                <div class='bg-gray-300'><a class='hover:bg-yellow-100 border-b hover:border-purple-400 sm:px-0.5 md:px-1' href='/prix/annee/{{ $laureat->year }}'>{{ $laureat->year }}</a> : <i>Non attribué</i>  </div>
            @else
                <div><a class='hover:bg-yellow-100 border-b hover:border-purple-400 sm:px-0.5 md:px-1' href='/prix/annee/{{ $laureat->year }}'>{{ $laureat->year }}</a> : {{ $laureat->name }} - {{ $laureat->title }} {{ $laureat->title == "" ? $laureat->vo_title : ($laureat->vo_title == "" ? "" : "(" . $laureat->vo_title . ")") }}  </div>
            @endif
        @endforeach
    </div>

@endsection