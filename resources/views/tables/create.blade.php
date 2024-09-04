<x-owner-layout>
    <x-card>
        <h2 class="title-form">Add Table</h2>

        <form action="{{ route('tables.store', ['cafe' => $cafe->cafe_id]) }}" method="POST">
            @csrf

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

            <!-- Table Number -->
            <div>
                <label for="table_number" class="block text-lg font-medium text-gray-700">Table Number</label>
                <input type="text" name="table_number" id="table_number" required
                    class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                    value="{{ old('table_number') }}">
            </div>
            @error('table_number')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror

            <!-- Seating Capacity -->
            <div class="mt-6">
                <label for="seating_capacity" class="block text-lg font-medium text-gray-700">Seating Capacity</label>
                <input type="number" name="seating_capacity" id="seating_capacity" required min="1"
                    class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                    value="{{ old('seating_capacity') }}">
            </div>

            @error('seating_capacity')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror

            <!-- Position -->
            <div class="mt-6">
                <label for="position" class="block text-lg font-medium text-gray-700">Position</label>
                <input type="text" name="position" id="position"
                    class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                    value="{{ old('position') }}" placeholder="e.g., Near window">
            </div>
            @error('position')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror

            <!-- Availability Status -->
            <div class="mt-6">
                <label for="availability_status" class="block text-lg font-medium text-gray-700">Status</label>
                <select name="availability_status" id="availability_status" required
                    class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                    <option value="Available">Available</option>
                    <option value="Reserved">Reserved</option>
                </select>
            </div>
            @error('availability_status')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-indigo-600 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-lg">
                    Add Table
                </button>
            </div>
        </form>

    </x-card>
</x-owner-layout>
