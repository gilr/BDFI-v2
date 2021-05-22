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
    <div class='text-lg px-2 mx-2 md:mx-24'>
        {{ $prix->country->name }} ({{ $prix->year_start }} - {{ $prix->year_end != "" ? $prix->year_end : "..." }})
    </div>
    <div class='text-lg px-2 mx-2 md:mx-24'>
        Autres formes du nom : {{ $prix->short_name }} {{ $prix->alt_names }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-24'>
        Attribué par : {{ $prix->given_by }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-24'>
        Attribué pour : {{ $prix->given_for }}
    </div>
    <div class='text-lg px-2 mx-2 md:mx-24'>
        URL : {{ $prix->url }}
    </div>
    <div class='text-xl bg-gray-200 py-8 m-2 md:mx-16 self-center border-b-2 border-blue-300'>
        {!! $prix->description !!}
    </div>

    <div class='text-xl my-2 mt-4 bold self-center'>
        @if ($laureats == NULL)
            Liste des catégories
        @else
            Catégorie
        @endif
    </div>
    <div class='text-lg px-2 mx-2 md:mx-40 self-center'>
        @foreach($categories as $categorie)
            <div class='hover:bg-yellow-100 border-b hover:border-purple-400'><a class='sm:p-0.5 md:px-0.5' href='/prix/categorie/{{ $categorie->id }}'> {{ $categorie->award->name }} - {{ $categorie->name }} (Genre : {{ $categorie->genre }}, Type : {{ $categorie->type }})</a></div>
        @endforeach
    </div>
    @if ($laureats != NULL)
        <div class='text-xl my-2 sm:px-40 mt-4 bold self-center border-t-2 border-blue-300'>
            Liste des lauréats
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
    @endif

@endsection