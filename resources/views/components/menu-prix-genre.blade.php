<div class='flex flex-wrap grid-6 text-base bg-gray-100 m-1 self-center'>
    Catégories de prix par genre :
    @foreach($genres as $genre)
        <div class='border-b-4 {{ ($tab == "$genre" ? "border-yellow-500" : "border-gray-300 hover:bg-yellow-100 hover:border-purple-400") }}'>
            <a class='px-2 md:px-4' href='/prix/genre/{{ $genre }}'>{{ $genre }}</a>
        </div>
    @endforeach
</div>
