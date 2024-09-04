<x-owner-layout>
  <x-card>
      <h2 class="title-form">Edit Table</h2>

      <form action="{{ route('tables.update', ['cafe' => $cafe->cafe_id, 'table' => $table->table_id]) }}" method="POST">
          @csrf
          @method('PUT')

          <!-- Hidden input for cafe_id -->
          <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

          <!-- Table Number -->
          <div class="mb-6">
              <label for="table_number" class="block text-lg font-medium text-gray-700">Table Number</label>
              <input type="text" name="table_number" id="table_number" required
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                  value="{{ old('table_number', $table->table_number) }}">
          </div>

          <!-- Seating Capacity -->
          <div class="mb-6">
              <label for="seating_capacity" class="block text-lg font-medium text-gray-700">Seating Capacity</label>
              <input type="number" name="seating_capacity" id="seating_capacity" required min="1"
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                  value="{{ old('seating_capacity', $table->seating_capacity) }}">
          </div>

          <!-- Position -->
          <div class="mb-6">
              <label for="position" class="block text-lg font-medium text-gray-700">Position</label>
              <input type="text" name="position" id="position"
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                  value="{{ old('position', $table->position) }}" placeholder="e.g., Near window">
          </div>

          <!-- Availability Status -->
          <div class="mb-6">
              <label for="availability_status" class="block text-lg font-medium text-gray-700">Status</label>
              <select name="availability_status" id="availability_status" required
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                  <option value="Available" {{ old('availability_status', $table->availability_status) === 'Available' ? 'selected' : '' }}>Available</option>
                  <option value="Reserved" {{ old('availability_status', $table->availability_status) === 'Reserved' ? 'selected' : '' }}>Reserved</option>
              </select>
          </div>

          <!-- Submit Button -->
          <div class="mt-8">
              <button type="submit"
                  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm 
                  px-6 py-3 bg-indigo-600 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none 
                  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-lg">
                  Update Table
              </button>
          </div>
      </form>

  </x-card>
</x-owner-layout>
