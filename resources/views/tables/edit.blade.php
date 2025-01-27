<x-owner-layout>
    <x-card>
        <h2 class="form-title">Edit Table</h2>

        <form action="{{ route('tables.update', ['cafe' => $cafe->cafe_id, 'table' => $table->table_id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

            <!-- Table Number -->
            <div>
                <label for="table_number" class="block text-lg font-medium text-gray-700">Table Number</label>
                <input type="text" name="table_number" id="table_number" required
                    class="box-inputbar"
                    value="{{ old('table_number', $table->table_number) }}">
                @error('table_number')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Seating Capacity -->
            <div class="mt-6">
                <label for="seating_capacity" class="block text-lg font-medium text-gray-700">Seating Capacity</label>
                <input type="number" name="seating_capacity" id="seating_capacity" required min="1"
                    class="box-inputbar"
                    value="{{ old('seating_capacity', $table->seating_capacity) }}">
                @error('seating_capacity')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Position -->
            <div class="mt-6">
                <label for="position" class="block text-lg font-medium text-gray-700">Position</label>
                <input type="text" name="position" id="position"
                    class="box-inputbar"
                    value="{{ old('position', $table->position) }}" placeholder="e.g., Near window">
                @error('position')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="form-button">
                    Update Table
                </button>
            </div>
        </form>

    </x-card>
</x-owner-layout>
