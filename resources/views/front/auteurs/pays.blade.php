@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Auteurs &rarr; Index {{ $pays }}</span>
    </div>

    <div class='flex text-lg sm:text-2xl font-mono font-bold bg-gray-300 border border-gray-400 p-0.5 self-center'>
        @foreach($countries as $country)
            echo "<div class='hover:ring-2 ring-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/pays/" . $country->name . "'>$pays</a></div>";
        @endforeach
    ?>
    </div>
    <div class='text-2xl m-2 self-center h-12'>
        {{ $results->links() }}
    </div>
    <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pl-1 md:pl-4 text-base self-center w-full'>
        @foreach($results as $result)
            <div class="font-bold my-1 sm:ml-2 text-yellow-700 place-self-start"><span class="text-red-800">►</span><a class='border-b border-dotted border-purple-700 hover:text-purple-700 focus:text-purple-900' href="/auteurs/{{ $result->id }}"> {{ $result->name }} {{ $result->first_name }}</a></div>
        @endforeach
    </div>
    <div class='text-2xl m-2 self-center'>
        {{ $results->links() }}
    </div>
@endsection