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
            <x-flashs/>

            @yield('content')

            <div class='text-lg self-center bg-red-200 text-red-800 font-bold items-end my-8'>
                ...
            </div>
        </div>
    </div>
</body>
</html>
