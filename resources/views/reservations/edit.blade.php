<x-layout>
  <x-card>
      <h2 class="title-form">Edit Your Reservation</h2>

      <form action="{{ route('reservations.update', ['cafe' => $cafe->cafe_id, 'reservation' => $reservation->reservation_id]) }}" method="POST">
          @csrf
          @method('PUT')

          <!-- Cafe Name -->
          <div class="mb-6">
              <label class="block text-lg font-medium text-gray-700">Cafe Name</label>
              <input type="text" value="{{ $cafe->cafe_name }}" readonly
                  class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
          </div>

          <!-- Number of Guests -->
          <div class="mb-6">
              <label for="guest_number" class="block text-lg font-medium text-gray-700">Number of Guests</label>
              <input type="number" name="guest_number" id="guest_number"
                     class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3"
                     value="{{ old('guest_number', $guest_number) }}">
          </div>

          <!-- Reservation Date -->
          <div class="mb-6">
              <label class="block text-lg font-medium text-gray-700">Reservation Date</label>
              <input type="text" value="{{ $reservation_date }}" readonly
                  class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
          </div>

          <!-- Reservation Start Time -->
          <div class="mb-6">
              <label class="block text-lg font-medium text-gray-700">Reservation Start Time</label>
              <input type="text" value="{{ $start_time }}" readonly
                  class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
          </div>

          <!-- Reservation End Time -->
          <div class="mb-6">
              <label class="block text-lg font-medium text-gray-700">Reservation End Time</label>
              <input type="text" value="{{ $end_time }}" readonly
                  class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
          </div>

          <!-- Special Requests -->
          <div class="mb-6">
              <label for="special_request" class="block text-lg font-medium text-gray-700">Special Request</label>
              <textarea name="special_request" id="special_request"
                        class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3"
                        rows="4">{{ old('special_request', $special_request) }}</textarea>
          </div>

          <!-- Table Selection -->
          <div class="mb-6">
              <label class="block text-lg font-medium text-gray-700">Selected Table</label>
              <input type="text" value="Table {{ $table->table_number }} ({{ $table->seating_capacity }} seats)" readonly
                  class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
          </div>

          <!-- Submit Button -->
          <div class="mt-8">
              <button type="submit"
                  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-indigo-600 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-lg">
                  Update Reservation
              </button>
          </div>
      </form>
  </x-card>
</x-layout>
