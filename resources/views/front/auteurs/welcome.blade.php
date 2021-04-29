@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Auteurs</span>
    </div>

    <div class='flex text-lg sm:text-2xl font-mono font-bold bg-gray-300 border border-gray-400 p-0.5 self-center'>
    <?php
        for ($i = 'A'; $i != 'AA'; $i++) {
            echo "<div class='hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/index/" . strtolower($i) . "'>$i</a></div>";
        }
    ?>
    </div>
    <div class='text-2xl my-16 bold self-center'>
        Zone d'essais, avec index des auteurs et bio d'auteur - Normalement responsive (s'adapte aux différentes tailles d'écran)
    </div>
    <div class='text-xl my-2 bold self-center'>
        La barre d'initiales ci-dessus donne accès aux index paginés des auteurs.
    </div>

    <div class='text-xl my-2 mx-2 md:mx-20 lg:mx-60 bold self-center'>
        En cliquant sur un auteur, on accède à ce que sera une future page auteur BDFI, en très simplifié, avec des données minimales (nom, pays, biographie).
        Et bonus, si vous êtes identifié avec des droits suffisants (i.e. non simple "user"), un accès direct à la fiche auteur est fourni, permettant d'aller modifier très rapidement.
    </div>
    <div class='text-xl my-2 bold self-center'>
        En modifiant un texte depuis la zone d'administration, la page auteur de cette zone sera également modifiée (il faut rafraichir la page).
    </div>
    <div class='text-xl my-2 bold self-center bg-red-200 p-2 shadow-lg'>
        Rappel : aucune inquiétude ici, il  s'agit bien d'une copie de test de la base de donnée BDFI !
    </div>
    <div class='text-xl my-2 bold self-center'>
        La liste ci-dessous donne également accès aux index par pays.
    </div>
    <div class='flex flex-wrap text-lg bg-gray-300 border border-gray-400 mx-2 md:mx-40 self-center'>
        @foreach($countries as $country)
            <div class='hover:bg-yellow-100' title='{{ $country->name }}'><a class='sm:p-0.5 md:px-0.5' href='/auteurs/pays/{{ $country->name }}'>{{ $country->code }}</a></div>
        @endforeach
    </div>
    <div class='text-xl my-2 bold self-center'>
        Oui, c'est pas beau, mais c'est juste pour tester la récupération de la liste et vérifier que les requêtes fonctionnent.
    </div>

@endsection