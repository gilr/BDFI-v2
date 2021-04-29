@php
    function types($value) {
        $types = array (
            'annonce_contenu' => 'Référencements',
            'annonce_site' => 'Travaux site web',
            'point_histo' => 'Point périodique',
            'point_aides' => 'Point sur les aides',
            'point_stats' => 'Point statistique',
//            'remerciement' => 'Remerciement',
//            'consecration' => 'Remerciement particulier',
            'autre' => 'Autres sujets',
        );
        return $types[$value];
    }
@endphp
@extends('front.layout')

@section('content')
    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Site BDFI &rarr; Evolutions</span>
    </div>

    <x-menu-site tab='news' />

    <div class='text-2xl font-bold pt-2 mt-2 self-center'>
        Evolutions et nouveautés du site
    </div>
    <div class='text-base p-2 m-2 md:mx-60 self-center border-l-8 border-green-500 bg-gray-100'>
        Liste des évolutions majeures, remerciements groupés, points périodiques, en commençant par les plus récents. Les remerciements individuels sont indiqués en page "remerciements".
    </div>
    <div class='text-2xl m-2 self-center h-12'>
        {{ $results->links() }}
    </div>
    @foreach($results as $result)
        <div class='px-2 sm:px-20 py-1 sm:py-4 text-base self-center w-full'>
            <div class="font-bold text-purple-900">{{ $result->date->format('Y') }} - {{ $result->name }}</div>
            <div class="pl-2 sm:pl-20">{{ $result->description }}</div>
            <div class="text-sm pl-1 sm:pl-10">Publié dans <span class='italic'>{{ types($result->type) }}</span> , le {{ $result->date->format('j / n / Y') }}.</div>
        </div>
    @endforeach
    <div class='text-2xl m-2 self-center'>
        {{ $results->links() }}
    </div>

@endsection