<x-layout>
    <x-card>
        <h2 class="form-title">Review Your Reservation</h2>

        <form action="{{ route('reservations.store', ['cafe' => $cafe->cafe_id]) }}" method="POST">
            @csrf

            <!-- Hidden inputs to store the data -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
            <input type="hidden" name="guest_number" value="{{ $guest_number }}">
            <input type="hidden" name="reservation_date" value="{{ $reservation_date }}">
            <input type="hidden" name="start_time" value="{{ $start_time }}">
            <input type="hidden" name="end_time" value="{{ $end_time }}">
            <input type="hidden" name="special_request" value="{{ $special_request }}">
            <input type="hidden" name="table_id" value="{{ $table->table_id }}">

            <!-- Cafe Name -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Cafe Name</label>
                <input type="text" value="{{ $cafe->cafe_name }}" readonly
                    class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
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

            <!-- Table Selection -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Selected Table</label>
                <input type="text" value="Table {{ $table->table_number }} ({{ $table->seating_capacity }} seats)" readonly
                    class="mt-2 block w-full rounded-md border-2 border-gray-300 bg-gray-100 text-gray-600 text-lg p-3 cursor-not-allowed focus:ring-0 sm:text-lg">
            </div>

            <!-- Number of Guests -->
            <div class="mb-6">
                <label for="guest_number" class="block text-lg font-medium text-gray-700">
                    Number of Guests
                </label>
                <input type="number" name="guest_number" id="guest_number"
                       class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 @error('guest_number') border-red-500 @enderror"
                       value="{{ old('guest_number', $guest_number ?? '') }}"
                       min="1" required> <!-- Add min attribute -->
            
                @error('guest_number')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Special Requests -->
            <div class="mb-6">
                <label for="special_request" class="block text-lg font-medium text-gray-700">
                    Special Request
                </label>
                <textarea name="special_request" id="special_request"
                          class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 @error('special_request') border-red-500 @enderror"
                          rows="4">{{ old('special_request', $special_request ?? '') }}</textarea>
                @error('special_request')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="form-button">
                    Confirm Reservation
                </button>
            </div>
        </form>
    </x-card>
</x-layout>
