<x-owner-layout>
    <x-horizontal-card class="p-8">
        <h2 class="page_title">Manage Your Events</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
            <div class="bg-gray-800 shadow-lg rounded-xl p-6 transform transition-all duration-300 hover:scale-105 border border-gray-700">
                <h2 class="text-xl font-semibold text-gray-100 mb-3">{{ $event->event_name }}</h2>
                <p class="text-gray-400 mb-6">{{ $event->event_date->format('F d, Y') }}</p>
                <div class="flex justify-between items-center pt-4 border-t border-gray-700">
                    <a href="{{ route('events.edit', ['cafe' => $event->cafe_id, 'event' => $event->event_id]) }}"
                        class="px-4 py-2 text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors duration-300">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </span>
                    </a>
                    <form
                        action="{{ route('events.destroy', ['cafe' => $event->cafe_id, 'event' => $event->event_id]) }}"
                        method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-red-400 hover:text-red-300 transition-colors duration-300"
                            onclick="return confirm('Are you sure you want to delete this event?');">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('events.create', ['cafe' => $cafe->cafe_id]) }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New Event
            </a>
        </div>
    </x-horizontal-card>
</x-owner-layout>