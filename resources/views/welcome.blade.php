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

            <div class='flex text-base pt-1 mx-2 self-center'>
                Et non pas une possible ébauche d'un look futur.
            </div>
            <div class='flex text-xl pt-1 self-center'>
                La première icone (auteurs) du menu vertical gauche donne accès aux index et biographies.
                On peut évidemment s'y promener sans être connecté.
            </div>
            <div class='flex text-xs pt-1 self-center italic'>
                Les autres icones ayant été laissées en friche, l'accès pourrait s'avérer... dangereux.
            </div>

            <div class='text-lg p-4 mx-2 md:mx-20 my-2 bg-gray-300 border border-gray-400 self-center rounded-lg'>
                Le mot de passe pour tous les comptes de test déjà créés est : <span class="font-bold text-blue-800">password</span><br />
                Les comptes utilisables avec accès administration sont :<br />
                <ul class="list-disc pl-12">
                    <li><span class="font-bold text-blue-800">visitor@bdfi.net</span> : ne permet aucune modification</li>
                    <li><span class="font-bold text-blue-800">editor@bdfi.net</span>, <span class="font-bold text-blue-800">editor2@bdfi.net</span> et <span class="font-bold text-blue-800">editor3@bdfi.net</span> : gestion des tables biblios</li>
                    <li><span class="font-bold text-blue-800">admin@bdfi.net</span>, <span class="font-bold text-blue-800">admin2@bdfi.net</span> et <span class="font-bold text-blue-800">admin3@bdfi.net</span> : quelques droits supplémentaires</li>
                    <li><span class="font-bold text-blue-800">sysadmin@bdfi.net</span> : pas de limitations (sauf si pas de sens)</li>
                </ul>
                L'accès administration se fait avec ces comptes, par les liens en haut à droite :<br />
                <span class="font-bold text-yellow-800">Connexion</span> si vous n'êtes pas déjà authentifié, ou <span class="font-bold text-yellow-800">Administration</span> ou <span class="font-bold text-yellow-800">Gestion des tables</span> si vous l'êtes.<br />
                N'ont pas accès à la zone admin par défaut, les comptes suivants :<br />
                <ul class="list-disc pl-12">
                    <li><span class="font-bold text-blue-800">user@bdfi.net</span></li>
                    <li>ainsi que ceux créés via le <span class="font-bold text-yellow-800">Inscription</span>.</li>
                </ul>
            </div>
            <div class='flex text-lg self-end bg-red-200 text-red-800 items-end mt-1'>
                Nota : Vous pouvez cliquer sur la petite croix (extrémité droite) de la barre de débug en bas de page pour la réduire.
            </div>
            <div class='text-xl ml-1 md:ml-40'>
                En image, visualisation des "zones" et de la navigation :
            </div>
            <div class='text-lg self-center bg-red-200 text-red-800 font-bold items-end mt-4'>
                <img src="/img/bdfi_navigation.jpg" />
            </div>
            <div class='text-lg self-center bg-red-200 text-red-800 font-bold items-end my-8'>
                ...
            </div>
        </div>
    </div>

</body>
</html>
