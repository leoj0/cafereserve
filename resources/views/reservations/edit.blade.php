<x-layout>
    <x-card>
        <h2 class="form-title">Edit Your Reservation</h2>

        <form action="{{ route('reservations.update', ['id' => $reservation->reservation_id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Cafe Name -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Cafe Name</label>
                <input type="text" value="{{ $cafe->cafe_name }}" readonly
                       class="form-input bg-gray-100 text-gray-600 cursor-not-allowed">
            </div>

            <!-- Reservation Date -->
            <div class="mb-6">
                <label for="reservation_date" class="block text-lg font-medium text-gray-700">Reservation Date</label>
                <input type="date" name="reservation_date" id="reservation_date"
                       class="form-input @error('reservation_date') border-red-500 @enderror"
                       value="{{ old('reservation_date', $reservation->reservation_date->format('Y-m-d')) }}" required disabled>
                @error('reservation_date')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Time -->
            <div class="mb-6">
                <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time"
                       class="form-input @error('start_time') border-red-500 @enderror"
                       value="{{ old('start_time', $reservation->start_time) }}" required>
                @error('start_time')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Time -->
            <div class="mb-6">
                <label for="end_time" class="block text-lg font-medium text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time"
                       class="form-input @error('end_time') border-red-500 @enderror"
                       value="{{ old('end_time', $reservation->end_time) }}" required>
                @error('end_time')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Guest Number -->
            <div class="mb-6">
                <label for="guest_number" class="block text-lg font-medium text-gray-700">Number of Guests</label>
                <input type="number" name="guest_number" id="guest_number"
                       class="form-input @error('guest_number') border-red-500 @enderror"
                       value="{{ old('guest_number', $reservation->guest_number) }}"
                       min="1" max="{{ $table->seating_capacity }}" required>
                @error('guest_number')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Special Request -->
            <div class="mb-6">
                <label for="special_request" class="block text-lg font-medium text-gray-700">Special Request</label>
                <textarea name="special_request" id="special_request"
                          class="form-input @error('special_request') border-red-500 @enderror"
                          rows="4">{{ old('special_request', $reservation->special_request) }}</textarea>
                @error('special_request')
                    <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="form-button">Update Reservation</button>
            </div>
        </form>
    </x-card>
</x-layout>
