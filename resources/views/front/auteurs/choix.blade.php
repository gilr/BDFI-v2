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

            <div class='text-2xl text-red-800 bold self-center px-4'>
                Extrait de nom recherché : " {{ $text }} "
            </div>
            <div class='text-xl bold self-center p-4'>
                Plusieurs résultats trouvés peuvent correspondrent à votre recherche :
            </div>
            <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 pl-4 text-lg self-center w-full font-sans'>
                @foreach($results as $result)
                    <div class="my-1 place-self-start">:: <a href="/auteurs/{{ $result->id }}">{{ $result->name }} {{ $result->first_name }}</a></div>
                @endforeach
            </div>
            <div class='flex text-2xl m-2 self-center'>
                {{ $results->links() }}
            </div>
        </div>
    </div>
</body>
</html>
