@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-600' href="/prix">Prix</a> &rarr; 
            <span class="border-b-2 border-yellow-300">Type {{ $type }}</span>
    </div>

    <x-menu-prix-type tab='{{ $type }}' :types="$types"/>

    <div class='text-xl my-2 bold self-center'>
        Liste des categories de prix concernant uniquement le type {{ $type }} :
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40 self-center'>
        @foreach($categories as $categorie)
            <div class='hover:bg-yellow-100' title='{{ $categorie }}'><a class='sm:p-0.5 md:px-0.5' href='/prix/categorie/{{ $categorie->id }}'> {{ $categorie->award->name }} - {{ $categorie->name }} </a></div>
        @endforeach
    </div>
@endsection