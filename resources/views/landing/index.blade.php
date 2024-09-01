@auth
    @if(auth()->user()->role === 'Owner')
        <x-owner-layout>
        </x-owner-layout>
    @else
        <x-layout>
        </x-layout>
    @endif
@else
    <x-layout>
    </x-layout>
@endauth