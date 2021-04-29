@extends('front.layout')

@section('content')

    <div class="text-sm p-1 m-1 place-self-start">
        Vous êtes ici : <span class=" border-b-2 border-yellow-400"> BDFI <span class="text-xs">Maquette de test</span> &rarr; Auteurs &rarr; Index {{strtoupper($initial)}}</span>
    </div>

    <div class='flex text-lg sm:text-2xl font-mono font-bold bg-gray-300 border border-gray-400 p-0.5 self-center'>
    <?php
        for ($i = 'A'; $i != 'AA'; $i++) {
            if (strtolower($i) != $initial) {
                echo "<div class='hover:bg-yellow-100'><a class='px-0.5 sm:pl-1 md:px-1' href='/auteurs/index/" . strtolower($i) . "'>$i</a></div>";
            }
            else {
                echo "<div class='px-0.5 sm:pl-1 md:px-1 text-yellow-800 bg-yellow-300'>$i</div>";
            }
        }
    ?>
    </div>
    <div class='text-2xl m-2 self-center h-12'>
        {{ $results->links() }}
    </div>
    <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pl-2 sm:pl-20 text-base self-center w-full'>
        @foreach($results as $result)
            <div class="font-bold my-1 sm:ml-2 text-yellow-700 place-self-start"><span class="text-red-800">►</span><a class='border-b border-dotted border-purple-700 hover:text-purple-700 focus:text-purple-900' href="/auteurs/{{ $result->id }}"> {{ mb_strtoupper($result->name) }} {{ $result->first_name }}</a></div>
        @endforeach
    </div>
    <div class='text-2xl m-2 self-center'>
        {{ $results->links() }}
    </div>
@endsection