<x-layout>
    <x-horizontal-card>
        <!-- Page Title -->
        <h2 class="page_title">Select a Table at {{ $cafe->cafe_name }}</h2>

        <!-- Filter Form -->
        <form action="{{ route('reservations.selectTablesPage', $cafe->cafe_id) }}" method="GET" class="mb-12">
            <div class="bg-white p-6 rounded-lg shadow-lg border-2 border-gray-400">
                <div class="flex flex-col md:flex-row md:items-end md:space-x-4">
                    <!-- Reservation Date -->
                    <div class="flex-1 mb-4">
                        <label for="reservation_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                        <input type="date" id="reservation_date" name="reservation_date"
                            class="w-full mt-1 px-4 py-2 border-2 border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-black"
                            placeholder="Select Date..." value="{{ request('reservation_date') }}">
                        @error('reservation_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Time -->
                    <div class="flex-1 mb-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="w-full mt-1 px-4 py-2 border-2 border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-black"
                            value="{{ request('start_time') }}">
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="flex-1 mb-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" id="end_time" name="end_time"
                            class="w-full mt-1 px-4 py-2 border-2 border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-black"
                            value="{{ request('end_time') }}">
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Filter Button -->
                    <div class="flex-shrink-0 mb-4 md:mb-0">
                        <button type="submit"
                            class="w-full md:w-auto px-6 py-2 bg-black text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-black transition ease-in-out duration-300">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Available Tables -->
        @if(request()->has('reservation_date') || request()->has('start_time') || request()->has('end_time'))
            <div class="bg-white p-6 rounded-lg shadow-lg border-2 border-gray-400">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Available Tables</h3>

                @if($tables->isEmpty())
                    <p class="text-gray-600">No tables available for the selected time.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tables as $table)
                            <div class="bg-white p-6 rounded-lg shadow border-2 border-gray-400 hover:border-black transition duration-300 ease-in-out">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Table {{ $table->table_number }}</h4>
                                <p class="text-gray-600 mb-2">Seats: {{ $table->seating_capacity }}</p>
                                <p class="text-gray-600 mb-4">Location: {{ $table->position }}</p>

                                <form action="{{ route('reservations.create', ['cafe' => $cafe->cafe_id, 'table' => $table->table_id]) }}">
                                    @csrf
                                    <input type="hidden" name="table_id" value="{{ $table->table_id }}">
                                    <input type="hidden" name="reservation_date" value="{{ request('reservation_date') }}">
                                    <input type="hidden" name="start_time" value="{{ request('start_time') }}">
                                    <input type="hidden" name="end_time" value="{{ request('end_time') }}">
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-black text-white font-semibold rounded-md shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-black transition ease-in-out duration-300">
                                        Reserve This Table
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </x-horizontal-card>
</x-layout>
