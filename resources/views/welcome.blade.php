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

	<aside class="bg-gradient-to-r from-gray-300 to-gray-50 flex flex-col items-center bg-yellow-100 text-gray-700 shadow h-full">
		<!-- Side Nav Bar-->

		<div class="h-16 flex items-center w-full">
			<!-- Logo Section -->
			<a class="h-8 w-8 mx-auto text-orange-500" href="/">
				BDFI
			</a>
		</div>

		<ul>
			<!-- Items Section -->
			<li class="hover:bg-yellow-100">
				<a href="auteurs" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les auteurs">
					<img src="img/auteur.png" style="width: 40px" alt="Auteurs" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="textes" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les textes">
					<img src="img/texte.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="ouvrages" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les ouvrages">
					<img src="img/livre.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="series" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les cycles et séries">
					<img src="img/series.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="editeurs" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les éditeurs">
					<img src="img/editeurs.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="collections" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les collections">
					<img src="img/collection.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="prix" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les prix">
					<img src="img/prix.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="festivals" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Les salons & festivals">
					<img src="img/festival.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="forums" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Nos forums">
					<img src="img/forum.png" style="width: 40px" />
				</a>
			</li>

			<li class="hover:bg-yellow-100">
				<a href="site" class="h-16 px-4 flex flex justify-center items-center w-full
					focus:text-orange-500" title="Le site">
					<img src="img/annonces.png" style="width: 40px" />
				</a>
			</li>

		</ul>

		<div class="mt-auto h-16 flex items-center w-full">
			<!-- Action Section -->
			<button
				class="h-16 w-10 mx-auto flex flex justify-center items-center
				w-full focus:text-orange-500 hover:bg-yellow-100 focus:outline-none">
				<svg
					class="h-5 w-5 text-red-700"
					xmlns="http://www.w3.org/2000/svg"
					width="24"
					height="24"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round">
					<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
					<polyline points="16 17 21 12 16 7"></polyline>
					<line x1="21" y1="12" x2="9" y2="12"></line>
				</svg>

			</button>
		</div>

	</aside>

        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-0 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a> - 
                        <a href="{{ url('/nova') }}" class="text-sm text-gray-700 underline">Administration</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
	</div>

</div>

</body>
</html>
