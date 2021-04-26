<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-0 sm:block">
            @auth
                @if (Auth::user()->role != 'user')
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline"> {{ __('Administration') }} </a> - 
                    <a href="{{ url('/nova') }}" class="text-sm text-gray-700 underline"> {{ __('Gestion des tables') }} </a> -
                @endif
                <form method="POST" style="display:inline" action="{{ route('logout') }}">
                    @csrf
                    <button class="display:inline text-sm text-gray-700 underline"> {{ __('Log out') }} </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline"> {{ __('Log in') }} </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline"> {{ __('Register') }} </a>
                @endif
            @endauth
            </div>
    @endif
</div>
