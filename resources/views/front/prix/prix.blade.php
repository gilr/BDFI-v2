@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-400' href="/prix">Prix</a> &rarr; 
            <span class="border-b-2 border-yellow-300">{{ $prix -> name }}</span>
    </div>

    <div class='text-xl my-2 bold self-center'>
        {{ $prix->name }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        Pays : {{ $prix->country->name }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        Période : {{ $prix->year_start }} - {{ $prix->year_end }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        Nom court : {{ $prix->short_name }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        Autres noms : {{ $prix->alt_names }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        Attribués par : {{ $prix->given_by }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        Attribués pour : {{ $prix->given_for }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        URL : {{ $prix->url }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40'>
        {!! $prix->description !!}
    </div>

    <div class='text-xl my-2 mt-4 bold self-center'>
        Liste de ses catégories de prix
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40 self-center'>
        @foreach($categories as $categorie)
            <div class='hover:bg-yellow-100 border-b hover:border-purple-400'><a class='sm:p-0.5 md:px-0.5' href='/prix/categorie/{{ $categorie->id }}'> {{ $categorie->award->name }} - {{ $categorie->name }} </a></div>
        @endforeach
    </div>

@endsection