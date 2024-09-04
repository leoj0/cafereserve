<x-layout>
    <div class="container mx-auto px-4 py-8">
      <h2 class="text-4xl text-gray-900 mb-10">Past Reservations</h2>
  
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($reservations as $reservation)
          <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300">
            <div class="p-6">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-semibold text-gray-800">
                  {{ $reservation->cafe ? $reservation->cafe->cafe_name : 'Cafe Not Found' }}
                </h3>
                <div class="flex space-x-4">
                  <a href="{{ route('reservations.edit', ['cafe' => $reservation->cafe_id, 'reservation' => $reservation->reservation_id]) }}" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <form action="{{ route('reservations.destroy', ['cafe' => $reservation->cafe_id, 'reservation' => $reservation->reservation_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </div>
              <p class="text-gray-600 mb-2"><span class="font-semibold">Table:</span> {{ $reservation->table ? $reservation->table->table_number : 'Table Not Found' }}</p>
              <p class="text-gray-600 mb-2"><span class="font-semibold">Date:</span> {{ $reservation->reservation_date }}</p>
              <p class="text-gray-600"><span class="font-semibold">Time:</span> {{ $reservation->start_time }} - {{ $reservation->end_time }}</p>
            </div>
          </div>
        @empty
          <p class="text-gray-500 text-lg col-span-full text-center">You have no reservations.</p>
        @endforelse
      </div>
    </div>
  </x-layout>
  