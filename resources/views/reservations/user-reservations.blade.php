<x-layout>
  <div class="container mx-auto px-4 py-8">
      <h2 class="text-3xl font-bold text-gray-800 mb-8">My Reservations</h2>

      @forelse($reservations as $reservation)
          <div class="bg-white p-6 rounded-lg shadow-md mb-4">
              <h3 class="text-xl font-semibold text-gray-800 mb-2">
                  {{ $reservation->cafe ? $reservation->cafe->cafe_name : 'Cafe Not Found' }}
              </h3>
              <p class="text-gray-600">Table: {{ $reservation->table ? $reservation->table->table_number : 'Table Not Found' }}</p>
              <p class="text-gray-600">Date: {{ $reservation->reservation_date }}</p>
              <p class="text-gray-600">Time: {{ $reservation->start_time }} - {{ $reservation->end_time }}</p>

              <div class="flex space-x-4 mt-4">
                  <a href="{{ route('reservations.edit', ['cafe' => $reservation->cafe_id, 'reservation' => $reservation->reservation_id]) }}" class="text-yellow-600 hover:underline">Edit</a>
                  <form action="{{ route('reservations.destroy', ['cafe' => $reservation->cafe_id, 'reservation' => $reservation->reservation_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:underline">Delete</button>
                  </form>
              </div>
          </div>
      @empty
          <p class="text-gray-600">You have no reservations.</p>
      @endforelse
  </div>
</x-layout>