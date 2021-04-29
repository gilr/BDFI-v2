@extends('front.layout')
@section('content')
    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Site BDFI &rarr; Base </span>
    </div>

    <x-menu-site tab='base' />

    <div class='text-2xl font-bold pt-2 mt-2 self-center'>
        Historique & stats des référencements BDFI
    </div>

@endsection