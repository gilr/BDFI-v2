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
                Cette partie "site BDFI" n'est qu'un site de test...
            </div>

            <div class='flex text-base pt-1 self-center'>
                Et non pas une possible ébauche d'un look futur.
            </div>
            <div class='flex text-xl pt-1 self-center'>
                La première icone (auteurs) du menu vertical gauche donne accès aux index et biographies.
            </div>
            <div class='flex text-xl pt-1 self-center'>
                On peut évidemment s'y promener sans être connecté.
            </div>
            <div class='flex text-xs pt-1 self-center italic'>
                Les autres icones ayant été laissées en friche, l'accès pourrait s'avérer... dangereux.
            </div>

            <div class='flex text-xl p-2 m-2 bg-gray-300 border border-gray-400 self-center rounded-lg'>
<pre class='m-4'>Pour l'accès à la zone admin :
Le mot de passe pour tous les logins de test déjà créés est : "password"

Les noms utilisables pour se connecter sont :
  - "visitor@bdfi.net" : pour se promener, pas de modifications possibles
  - "editor@bdfi.net" : gestion des tables biblios
  - "admin@bdfi.net" : gestion de quelques tables supplémentaires
  - "sysadmin@bdfi.net" : tous les droits

N'ont pas accès à la zone admin :
  - "user@bdfi.net"
  - les inscriptions supplémentaires (via le "Inscription").

L'accès aux tables se trouve en haut à droite : 
    -> "Connexion" si vous n'êtes pas déjà authentifié,
    -> "Dashboard" ou "Administration" si vous l'êtes.
</pre>
            </div>
            <div class='flex text-lg self-end text-red-800 font-bold items-end mt-4'>
                Vous pouvez cliquer sur la petite croix (extrémité droite) de la barre de débug en bas de page pour la réduire.
            </div>
        </div>
    </div>

</body>
</html>
