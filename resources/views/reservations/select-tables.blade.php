<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Select a Table at {{ $cafe->cafe_name }}</h2>

        <!-- Filter Form -->
        <form action="{{ route('reservations.selectTablesPage', $cafe->cafe_id) }}" method="GET" class="mb-12">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex flex-col md:flex-row md:items-start md:space-x-4">
                    <!-- Input Container -->
                    <div class="flex-1 mb-4">
                        <label for="reservation_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
                        <input type="date" id="reservation_date" name="reservation_date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Select Date..." value="{{ request('reservation_date') }}">
                        @error('reservation_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex-1 mb-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Start Time..." value="{{ request('start_time') }}">
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex-1 mb-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="time" id="end_time" name="end_time"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="End Time..." value="{{ request('end_time') }}">
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="mt-4 md:mt-0 md:w-auto px-4 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                        Filter
                    </button>
                </div>
            </div>
        </form>

        <!-- Available Tables -->
        @if(request()->has('reservation_date') || request()->has('start_time') || request()->has('end_time'))
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Available Tables</h3>

                @if($tables->isEmpty())
                    <p class="text-gray-600">No tables available for the selected time.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tables as $table)
                            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300 ease-in-out">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Table {{ $table->table_number }}</h4>
                                <p class="text-gray-600">Seats: {{ $table->seating_capacity }}</p>
                                <p class="text-gray-600">Location: {{ $table->location }}</p>

                                <form action="{{ route('reservations.create', ['cafe' => $cafe->cafe_id, 'table' => $table->table_id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="table_id" value="{{ $table->table_id }}">
                                    <input type="hidden" name="reservation_date" value="{{ request('reservation_date') }}">
                                    <input type="hidden" name="start_time" value="{{ request('start_time') }}">
                                    <input type="hidden" name="end_time" value="{{ request('end_time') }}">
                                    <button type="submit" class="mt-2 w-full px-4 py-2 bg-green-600 text-white rounded-md font-semibold hover:bg-green-700 transition duration-300 ease-in-out">
                                        Reserve This Table
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-layout>
