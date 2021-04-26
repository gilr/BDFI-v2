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
            <div class='flex text-2xl font-bold pt-2 mt-2 self-center'>
                {{ $results->first_name }} {{ $results->name }}
            </div>
            <div class='flex text-xl self-center'>
                {{ $results->country->name }}
            </div>
            <div class='flex text-2xl p-2 m-2 self-center shadow-xl'>
                {!! $results->biography !!}
            </div>
            <div class='text-lg mt-8 mx-2 lg:mx-40 self-center bg-yellow-100'>
                @auth
                    @if (auth()->user()->hasVisitorRole())
                        Vous êtes authentifié avec au moins des droits de visite, vous avez donc un accès direct à la fiche auteur : <a class="text-red-700 font-bold" href="/nova/resources/authors/{{ $results->id }}" target="_blank">Accès fiche {{ $results->first_name }} {{ $results->name }} </a> (s'ouvre dans un nouvel onglet). Si vous n'êtes que simple visiteur, vous ne pourrez pas modifier.
                    @else
                        Vous être authentifié, mais sans aucun droits de visite (utilisateur BDFI simple). Vous n'avez pas accès à la fiche auteur.
                    @endif
                @endauth
                @guest
                    Vous n'êtes pas authentifié, vous n'avez pas d'accès à la fiche auteur. 
                @endguest
            </div>
        </div>
    </div>
</body>
</html>
