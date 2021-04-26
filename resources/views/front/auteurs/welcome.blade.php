<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Site de test</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="bg-gradient-to-r from-gray-300 to-yellow-900 text-white py-3 px-4 text-center fixed left-0 bottom-0 right-0 z-40">
        Pied de page - <a class="underline text-gray-200" href="/">Contact</a> - Blablabla
    </div>
    <div class="h-full w-full flex bg-gray-200">
	<!-- container -->

        <x-menu/>
        <x-authent/>
        <div class='flex flex-col w-full'>
            @if (session('warning'))
                <div class="ml-8 w-8/12 shadow">
                    <div class="flex">
                      <div class="bg-yellow-500 w-2/12 text-center p-2">
                        <div class="flex justify-center h-full items-center">
                          <i class="material-icons text-white">Attention !</i>
                        </div>
                      </div>
                      <div class="bg-white w-5/12 px-4 py-2">
                        <div>
                          <p class="text-gray-600 font-bold">Erreur</p>
                          <p class="text-gray-600 text-sm">{{ session('warning') }}</p>
                        </div>
                      </div>
                      <div class="bg-white border-r-4 border-yellow-400 w-1/12 text-center p-2">
                        <div class="flex justify-center h-full items-center" onclick="this.parentElement.parentElement.style.display='none';">
                             <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </div>
                      </div>
                    </div>
                </div>
            @endif

            <div class="flex text-4xl p-2 m-2 border border-gray-400 self-center rounded-lg shadow-2xl">
                Ceci n'est qu'un site de test...
            </div>

            <div class='flex text-xl font-bold bg-gray-300 border border-gray-400 px-1 self-center'>
            <?php
                for ($i = 'A'; $i != 'AA'; $i++) {
                    echo "<div class='hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/_" . strtolower($i) . "'>$i</a></div>";
                }
            ?>
            </div>
            <div class='flex text-2xl my-16 bold self-center'>
                Zone d'essais, avec index des auteurs et bio d'auteur - Normalement responsive (s'adapte aux différentes tailles d'écran)
            </div>
            <div class='flex text-xl my-2 bold self-center'>
                La barre d'initiales ci-dessus donne accès aux index paginés des auteurs.
            </div>
            <div class='flex text-xl my-2 mx-20 lg:mx-60 bold self-center'>
                En cliquant sur un auteur, on accède à ce que sera une future page auteur BDFI, en très simplifié, avec des données minimales (nom, pays, biographie).
                Et bonus, si vous êtes identifié avec des droits suffisants (i.e. non simple "user"), un accès direct à la fiche auteur est fourni, permettant d'aller modifier très rapidement.
            </div>
            <div class='flex text-xl my-2 bold self-center'>
                En modifiant un texte depuis la zone d'administration, la page auteur de cette zone sera également modifiée (il faut rafraichir la page).
            </div>
            <div class='flex text-xl my-2 bold self-center bg-red-200 p-2 shadow-lg'>
                Rappel : aucune inquiétude ici, il  s'agit bien d'une copie de test de la base de donnée BDFI !
            </div>
        </div>
    </div>
</body>
</html>
