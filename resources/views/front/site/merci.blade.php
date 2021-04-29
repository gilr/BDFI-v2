@extends('front.layout')
@section('content')
    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Site BDFI &rarr; Remerciements</span>
    </div>

    <x-menu-site tab='merci' />

    <div class='text-2xl font-bold pt-2 mt-2 self-center'>
        Merci !
    </div>
    <div class='text-base p-2 m-2 md:mx-40 self-center border-l-8 border-red-500 bg-gray-100'>
Comme d'habitude, n'hésitez jamais à nous ré-écrire si vous n'avez pas eu de réponses ou si vos informations n'ont pas été prises en compte. Certains messages passent entre les mailles du filet, d'une part à cause des anti-spams, d'autre part parce que nous sommes parfois (souvent ?) débordés ! 
    </div>
    <div class='text-2xl m-2 self-center h-12'>
        {{ $results->links() }}
    </div>
    @foreach($results as $result)
        <div class='px-2 sm:px-20 py-0.5 text-base self-center w-full'>
            <span class="font-bold text-purple-900">{{ $result->name }} :</span>
            <span class="">{{ $result->description }}</span>
            <span class="text-sm"> Reçu le {{ $result->date->format('j / n / Y') }}.</span>
        </div>
    @endforeach
    <div class='text-2xl m-2 self-center'>
        {{ $results->links() }}
    </div>

@endsection