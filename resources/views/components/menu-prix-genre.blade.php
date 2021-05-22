<div class='flex flex-wrap grid-6 text-base m-1 self-center'>
    <div class='mx-2'> Catégories de prix par genre</div>
    @foreach($genres as $genre)
        <div class='border-b-4 bg-gray-100 {{ ($tab == "$genre" ? "border-yellow-500" : "border-gray-300 hover:bg-yellow-100 hover:border-purple-400") }}'>
            <a class='px-2 md:px-4' href='/prix/genre/{{ $genre }}'>{{ $genre }}</a>
        </div>
    @endforeach
</div>
