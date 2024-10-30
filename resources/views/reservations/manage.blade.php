<x-owner-layout>
    <x-horizontal-card>
        <h2 class="page_title">Manage Reservations for {{ $cafe->cafe_name }}</h2>

        <!-- Filter Options - Light Theme -->
        <form method="GET" action="{{ route('reservations.manage', $cafe->cafe_id) }}" class="mb-6 flex items-center space-x-4">
            <label for="status" class="text-lg font-semibold text-gray-700">Filter by Status:</label>
            <select id="status" name="status" onchange="this.form.submit()" class="form-select rounded-lg border-2 border-blue-500 bg-white text-gray-800 font-medium px-3 py-1.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-blue-500">
                <option value="">All</option>
                <option value="pending" {{ $statusFilter == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $statusFilter == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="canceled" {{ $statusFilter == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </form>

        @if($reservations->isEmpty())
            <p class="text-lg text-gray-600">No reservations yet.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-700">
                <table class="w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Time</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Guest Name</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Table</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach($reservations as $reservation)
                            <tr class="hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->reservation_date->format('F d, Y') }}</td>
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->user->name }}</td>
                                <td class="px-6 py-4 text-gray-200 font-medium">{{ $reservation->table->table_number }}</td>
                                <td class="px-6 py-4">
                                    <select 
                                        id="status-{{ $reservation->reservation_id }}" 
                                        name="status" 
                                        form="update-form-{{ $reservation->reservation_id }}"
                                        class="w-full rounded-full border-2 border-blue-500 bg-gray-700 text-gray-200 font-medium px-3 py-1.5 text-sm focus:outline-none focus:ring-4 focus:ring-blue-700 focus:border-blue-500"
                                    >
                                        @foreach(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'canceled' => 'Canceled'] as $status => $label)
                                            <option value="{{ $status }}" {{ $reservation->status == $status ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4">
                                    <form 
                                        id="update-form-{{ $reservation->reservation_id }}"
                                        action="{{ route('reservations.updateStatus', $reservation->reservation_id) }}" 
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-blue-600 text-gray-100 px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-150 whitespace-nowrap">
                                            Update
                                        </button>
                                    </form>
                                </td>
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