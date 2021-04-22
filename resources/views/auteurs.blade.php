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

            <div class='flex text-2xl p-2 m-2 border border-gray-400 self-center rounded-lg'>
            <?php
                for ($i = 'A'; $i != 'AA'; $i++) {
                    echo "<a href='/auteur/_" . strtolower($i) . "'>$i</a> &nbsp; ";
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>
