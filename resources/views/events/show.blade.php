<x-layout>
  <x-horizontal-card>
      <div class="container mx-auto mt-8">
          <h1 class="text-3xl font-bold mb-6">{{ $event->title }}</h1>

          <div class="bg-white shadow-md rounded-lg p-6 mb-4">
              <p class="text-lg mb-4">{{ $event->description }}</p>
              <p class="text-gray-600">Date: {{ $event->event_date->format('F d, Y') }}</p>

              @if(auth()->check())
                  <!-- Add a button to go back to the event list or a link to other related actions -->
                  <div class="mt-4">
                      <a href="{{ route('events.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                          Back to Events
                      </a>
                  </div>
              @endif
          </div>
      </div>
  </x-horizontal-card>
</x-layout>
