<x-owner-layout>
    <x-horizontal-card>
        <h2 class="page_title">Manage Reservations for {{ $cafe->cafe_name }}</h2>

        <!-- Filter Options by Date -->
        <form method="GET" action="{{ route('reservations.manage', $cafe->cafe_id) }}" class="mb-6 flex items-center space-x-4">
            <label for="reservation_date" class="text-lg font-semibold text-gray-700">Filter by Date:</label>
            <input 
                type="date" 
                id="reservation_date" 
                name="reservation_date" 
                value="{{ request('reservation_date') }}" 
                class="form-input rounded-lg border-2 border-blue-500 bg-white text-gray-800 font-medium px-3 py-1.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500"
                onchange="this.form.submit()"
            />
        </form>

        @if($reservations->isEmpty())
            <p class="text-lg text-gray-600">No reservations found for the selected date.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-700">
                <table class="w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Time</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Guest Name</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Table</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach($reservations as $reservation)
                            <tr class="hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->reservation_date->format('F d, Y') }}</td>
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->user->name }}</td>
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->table->table_number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-horizontal-card>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reservations->links() }}
    </div>
</x-owner-layout>
