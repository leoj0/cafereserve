<x-owner-layout>
    <x-horizontal-card>
            <h2 class="page_title">Manage Your Events</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $event->event_name }}</h2>
                    <p class="text-gray-600 mb-4">Date: {{ $event->event_date->format('F d, Y') }}</p>
                    <div class="flex justify-between">
                        <a href="{{ route('events.edit', ['cafe' => $event->cafe_id, 'event' => $event->event_id]) }}"
                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form
                            action="{{ route('events.destroy', ['cafe' => $event->cafe_id, 'event' => $event->event_id]) }}"
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
                <a href="{{ route('events.create', ['cafe' => $cafe->cafe_id]) }}" class="link-button">
                    Add Event
                </a>
    </x-horizontal-card>
</x-owner-layout>