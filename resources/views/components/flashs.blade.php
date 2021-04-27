@if (session('info'))
   <x-alert type='info'>
    {{ session()->pull('info') }}
  </x-alert>
@endif
@if (session('warning'))
   <x-alert type='warning'>
    {{ session()->pull('warning') }}
  </x-alert>
@endif
@if (session('danger'))
   <x-alert type='danger'>
    {{ session()->pull('danger') }}
  </x-alert>
@endif
