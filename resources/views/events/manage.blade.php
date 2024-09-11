<x-layout>
  <x-horizontal-card>
      <div class="container mx-auto mt-8">
          <h1 class="text-3xl font-bold mb-6">Manage Your Events</h1>

          @if($events->isEmpty())
              <p class="text-lg text-gray-600">You haven't created any events yet.</p>
          @else
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                  @foreach($events as $event)
                      <div class="bg-white shadow-md rounded-lg p-6">
                          <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $event->title }}</h2>
                          <p class="text-gray-600 mb-4">Date: {{ $event->event_date->format('F d, Y') }}</p>
                          <div class="flex justify-between">
                              <a href="{{ route('events.edit', $event->event_id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                              <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                              </form>
                          </div>
                      </div>
                  @endforeach
              </div>
          @endif

          <div class="mt-8">
              <a href="{{ route('events.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                  Create New Event
              </a>
          </div>
      </div>
  </x-horizontal-card>
</x-layout>
