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
    <div class="h-screen w-screen flex bg-gray-200">
	<!-- container -->

        <x-menu/>
        <x-authent/>

        <div class='flex flex-col w-11/12'>

            <div class="flex text-4xl p-2 m-2 border border-gray-400 self-center rounded-lg shadow-2xl">
                Ceci n'est qu'un site de test...
            </div>

            <div class='flex text-xl font-mono font-bold bg-gray-300 border border-yellow-200 pr-1 self-center'>
            <?php
                for ($i = 'A'; $i != 'AA'; $i++) {
                    echo "<div class='pl-1 hover:bg-yellow-100'><a href='/auteurs/_" . strtolower($i) . "'>$i</a></div>";
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
