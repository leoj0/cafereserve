<x-layout>
    @include('partials._search')

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
  <div class="mt-5 ml-4 mr-4">
    @foreach($cafes as $cafe)
    @include('partials._cafe-card', ['cafe' => $cafe])
    @endforeach
  </div>

  <div class="mt-6 p-4">
    {{$cafes->links()}}
  </div>
  @endif
</x-layout>