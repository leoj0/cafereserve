<x-owner-layout>
  <x-horizontal-card>
      <h2 class="page_title">Reservation Details</h2>

      <div class="bg-white shadow-md rounded-lg p-6 mb-6 space-y-4">
          <p class="text-lg font-semibold text-gray-800">
              <strong>Guest Name:</strong> 
              <span class="font-normal text-gray-700">{{ $reservation->user->name }}</span>
          </p>
          <p class="text-lg font-semibold text-gray-800">
              <strong>Table:</strong> 
              <span class="font-normal text-gray-700">{{ $reservation->table->table_number }}</span>
          </p>
          <p class="text-lg font-semibold text-gray-800">
              <strong>Date:</strong> 
              <span class="font-normal text-gray-700">{{ $reservation->reservation_date->format('F d, Y') }}</span>
          </p>
          <p class="text-lg font-semibold text-gray-800">
              <strong>Time:</strong> 
              <span class="font-normal text-gray-700">{{ $reservation->start_time }} - {{ $reservation->end_time }}</span>
          </p>
          <p class="text-lg font-semibold text-gray-800">
              <strong>Guests:</strong> 
              <span class="font-normal text-gray-700">{{ $reservation->guest_number }}</span>
          </p>
          <p class="text-lg font-semibold text-gray-800">
              <strong>Special Request:</strong> 
              <span class="font-normal text-gray-700 text-justify">{{ $reservation->special_request ?? 'None' }}</span>
          </p>
          <p class="text-lg font-semibold text-gray-800">
              <strong>Status:</strong> 
              <span class="font-normal text-gray-700">{{ ucfirst($reservation->status) }}</span>
          </p>
      </div>

      <div class="mt-4">
          <a href="{{ route('reservations.manage', $reservation->cafe_id) }}" 
             class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition duration-200">
              Back to Reservations
          </a>
      </div>
  </x-horizontal-card>
</x-owner-layout>
