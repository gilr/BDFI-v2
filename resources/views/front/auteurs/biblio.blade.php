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

            <div class="flex text-4xl p-2 m-2 border border-gray-400 self-center rounded-lg shadow-2xl">
                Ceci n'est qu'un site de test...  
            </div>

            <div class='flex text-xl font-bold bg-gray-300 border border-gray-400 px-1 self-center'>
            <?php
                for ($i = 'A'; $i != 'AA'; $i++) {
                    if (strtolower($i) != strtolower(substr($results->name, 0, 1))) {
                        echo "<div class='hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/_" . strtolower($i) . "'>$i</a></div>";
                    }
                    else {
                        echo "<div class='text-yellow-800 bg-yellow-300 hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/_" . strtolower($i) . "'>$i</a></div>";
                    }
                }
            ?>
            </div>
            <div class='text-2xl font-bold pt-2 mt-2 self-center'>
                {{ $results->first_name }} {{ $results->name }}
            </div>
            <div class='text-xl self-center'>
                {{ $results->country->name }}
            </div>
            <div class='text-xl self-center'>
                {{ $datesPattern }}
            </div>
            <div class='text-2xl bg-gray-200 py-8 m-2 self-center border-b-2 border-blue-300'>
                {!! $results->biography !!}
            </div>
            <div class='text-lg p-2 mt-6 mx-2 lg:mx-40 self-center bg-yellow-100'>
                @auth
                    @if (auth()->user()->hasVisitorRole())
                        Vous êtes authentifié avec au moins des droits de visite, vous avez donc un accès direct à la fiche auteur => <a class="text-red-700" href="/nova/resources/authors/{{ $results->id }}" target="_blank">accès fiche <span class="font-bold">{{ $results->first_name }} {{ $results->name }}</span></a> (s'ouvre dans un nouvel onglet).<br />Si vous n'êtes que simple visiteur, vous ne pourrez pas faire de modifications.
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
