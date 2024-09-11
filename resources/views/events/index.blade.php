<x-layout>
  <x-horizontal-card>
      <div class="container mx-auto mt-8">
          <h1 class="text-3xl font-bold mb-6">Your Events</h1>

          <a href="{{ route('events.create') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded mb-4">Create New Event</a>

          @foreach($events as $event)
              <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                  <h3 class="text-xl font-semibold">{{ $event->title }}</h3>
                  <p>{{ $event->description }}</p>
                  <p class="text-gray-600">Date: {{ $event->event_date->format('M d, Y') }}</p>
                  <div class="mt-4">
                      <a href="{{ route('events.edit', $event) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                      <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                      </form>
                      <a href="{{ route('events.show', $event) }}" class="bg-blue-500 text-white px-4 py-2 rounded">View</a>
                  </div>
              </div>
          @endforeach
      </div>
  </x-horizontal-card>
</x-layout>
