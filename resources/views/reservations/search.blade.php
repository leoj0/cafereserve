<x-layout>
    
    <!-- Instruction Text -->
    <div class="p-4">
        <p class="text-xl font-semibold text-gray-700">Please select the cafe you would like to reserve.</p>
    </div>

    <!-- Search Form -->
    @include('partials._search-reserve')

    <!-- Display Results -->
    <div class="mt-5 ml-4 mr-4">
        @if($cafes->isEmpty())
            <div class="flex justify-center items-center h-64">
                @if(request('search') || request('tag'))
                    <!-- Message for when no cafes match the search criteria -->
                    <p class="text-2xl font-bold">No cafes match your search criteria</p>
                @else
                    <!-- Message for when there are no cafes at all -->
                    <p class="text-2xl font-bold">No Cafes yet</p>
                @endif
            </div>
        @else
            <div>
                @foreach($cafes as $cafe)
                    @include('partials._cafe-card', ['cafe' => $cafe])
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $cafes->links() }}
            </div>
        @endif
    </div>
</x-layout>
