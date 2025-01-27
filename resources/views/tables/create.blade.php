<x-owner-layout>
    <x-card>
        <h2 class="form-title">Add Table</h2>

        <form action="{{ route('tables.store', ['cafe' => $cafe->cafe_id]) }}" method="POST">
            @csrf

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

            <!-- Table Number -->
            <div>
                <label for="table_number" class="block text-lg font-medium text-gray-700">Table Number</label>
                <input type="text" name="table_number" id="table_number" required
                    class="box-inputbar"
                    value="{{ old('table_number') }}" placeholder="Enter table number">
                @error('table_number')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Seating Capacity -->
            <div class="mt-6">
                <label for="seating_capacity" class="block text-lg font-medium text-gray-700">Seating Capacity</label>
                <input type="number" name="seating_capacity" id="seating_capacity" required min="1"
                    class="box-inputbar"
                    value="{{ old('seating_capacity') }}" placeholder="Enter seating capacity">
                @error('seating_capacity')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Position -->
            <div class="mt-6">
                <label for="position" class="block text-lg font-medium text-gray-700">Position</label>
                <input type="text" name="position" id="position"
                    class="box-inputbar"
                    value="{{ old('position') }}" placeholder="e.g., Near window">
                @error('position')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="form-button">
                    Add Table
                </button>
            </div>
        </form>
    </x-card>
</x-owner-layout>
