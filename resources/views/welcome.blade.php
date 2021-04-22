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

            <div class='flex text-2xl p-2 m-2 self-center'>
                Mais surtout pas une ébauche d'un look futur !
            </div>

            <div class='flex text-2xl p-2 m-2 border border-gray-400 self-center rounded-lg'>
<pre class='m-4'>L'accès aux tables se trouve en haut à droite : 
    -> "Connexion" ou "Inscription" si vous n'êtes pas encore connecté,
    -> "Dashboard" ou "Administration" si vous l'êtes.

Les utilisateurs possibles pour accéder à l'admin de test :
  - "visitor@bdfi.net" : pour se promener, pas de modifications possibles
  - "editor@bdfi.net" : gestion des tables biblios
  - "admin@bdfi.net" : gestion de quelques tables supplémentaires
  - "sysadmin@bdfi.net" : tous les droits
Le login suivant n'a pas d'accès à la zone admin :
  - "user@bdfi.net"

Le mot de passe est identique pour tous les login : "password"

On peut utiliser "Inscription", on se retrouve (normalement !) simple "user".
</pre>
            </div>
        </div>
    </div>

</body>
</html>
