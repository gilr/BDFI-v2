@extends('front.layout')
@section('content')
    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Site BDFI</span>
    </div>

    <x-menu-site tab='welcome' />

    <div class='text-2xl font-bold pt-2 mt-2 self-center'>
        Tableau de bord BDFI
    </div>

    <div class='text-base p-2 m-5 mx:4 md:mx-20 bg-yellow-200 border-l-4 border-red-600'>
        Cette page présentera les derniers référencements ainsi que les dernières modifications, ce qui bouge sur BDFI.
    </div>

    <div class='text-xl font-bold text-purple-900 pt-2 mt-5 mx:2 md:mx-20'>Dernières modifications</div>
    <div class='text-base p-2 m-5 mx:4 md:mx-40 bg-yellow-200 border-l-4 border-red-600'>
        Ici les dernières modifications effectuées sur la base.
    </div>

@endsection