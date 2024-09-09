<x-owner-layout>
  <x-card>
      <h2 class="title-form text-3xl font-bold text-gray-900 mb-6">Edit Reward</h2>

      <form action="{{ route('rewards.update', $reward->reward_id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Hidden input for cafe_id -->
          <input type="hidden" name="cafe_id" value="{{ Auth::user()->cafe->cafe_id }}">

          <!-- Cafe Name -->
          <div>
              <label for="cafe_name" class="block text-lg font-medium text-gray-700">Cafe Name</label>
              <input type="text" id="cafe_name" class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 bg-gray-100" value="{{ Auth::user()->cafe->cafe_name ?? 'No Cafe Assigned' }}" readonly>
          </div>

          <!-- Reward Name -->
          <div class="mt-6">
              <label for="reward_name" class="block text-lg font-medium text-gray-700">Reward Name</label>
              <input type="text" name="reward_name" id="reward_name" required
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500"
                  value="{{ old('reward_name', $reward->reward_name) }}">
          </div>
          @error('reward_name')
              <div class="text-red-500 mt-1">{{ $message }}</div>
          @enderror

          <!-- Reward Description -->
          <div class="mt-6">
              <label for="reward_description" class="block text-lg font-medium text-gray-700">Reward Description</label>
              <textarea name="reward_description" id="reward_description" rows="6"
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500"
                  placeholder="Describe the reward">{{ old('reward_description', $reward->reward_description) }}</textarea>
          </div>
          @error('reward_description')
              <div class="text-red-500 mt-1">{{ $message }}</div>
          @enderror

          <!-- Points Required -->
          <div class="mt-6">
              <label for="points_required" class="block text-lg font-medium text-gray-700">Points Required</label>
              <input type="number" name="points_required" id="points_required" required
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500"
                  value="{{ old('points_required', $reward->points_required) }}">
          </div>
          @error('points_required')
              <div class="text-red-500 mt-1">{{ $message }}</div>
          @enderror

          <!-- Submit Button -->
          <div class="mt-8">
              <button type="submit"
                  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-indigo-600 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Update Reward
              </button>
          </div>
      </form>
  </x-card>
</x-owner-layout>
