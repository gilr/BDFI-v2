@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : BDFI 
            <span class="text-xs border-b-2 border-yellow-300">Maquette de test</span> &rarr; 
            <a class='border-b-2 border-yellow-300 hover:border-purple-400' href="/prix">Prix</a> &rarr; 
            <span class="border-b-2 border-yellow-300">Année {{ $annee }}</span>
    </div>

    <div class='flex flex-wrap text-md px-1 mx-1 md:mx-8 self-center'>
        <span class='m-0.5'>Prix par année </span>
        @foreach($annees as $an)
            @if ($an != $annee)
                <span class='hover:bg-yellow-100 bg-gray-300 border border-gray-400 m-0.5' title='{{ $an }}'><a class='md:px-0.5' href='/prix/annee/{{ $an }}'>{{ $an }}</a></span>
            @else
                <span class='text-yellow-900 bg-yellow-300 border border-gray-400 m-0.5' title='{{ $an }}'><a class='md:px-0.5' href='/prix/annee/{{ $an }}'>{{ $an }}</a></span>
            @endif
        @endforeach
    </div>

    <div class='text-xl text-purple-800 my-2 bold self-center py-2'>
        Récompenses décernés l'année {{ $annee }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40 self-center'>
        @foreach($laureats as $type)
            <div class='font-bold'>Type de prix <a class='hover:bg-yellow-100 border-b hover:border-purple-400 sm:px-0.5 md:px-1' href='/prix/type/{{ $type[0]->type }}'>"{{ ucfirst($type[0]->type) }}"</a></div>
            @foreach($type as $laureat)
                <div class='pl-2'>{{ $laureat->name }} - {{ $laureat->title }} {{ $laureat->title == "" ? $laureat->vo_title : ($laureat->vo_title == "" ? "" : "(" . $laureat->vo_title . ")") }} : <a class='hover:bg-yellow-100 border-b hover:border-purple-400 sm:px-0.5 md:px-1' href='/prix/{{ $laureat->award_category->award->name }}'>{{ $laureat->award_category->award->name }}</a>, catégorie <a class='hover:bg-yellow-100 border-b hover:border-purple-400 sm:px-0.5 md:px-1' href='/prix/categorie/{{ $laureat->award_category_id }}'>{{ $laureat->award_category->name }}</a></div>
            @endforeach
        @endforeach
    </div>

@endsection