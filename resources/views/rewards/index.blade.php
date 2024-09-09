<x-layout>
  <x-horizontal-card>
      <h1 class="text-2xl font-bold mb-6">Rewards List</h1>

      @if ($rewards->isEmpty())
          <p class="text-gray-600">No rewards available</p>
      @else
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
              @foreach ($rewards as $reward)
                  <div class="p-4 bg-white rounded-lg shadow">
                      <div class="flex justify-between items-center">
                          <h2 class="text-xl font-semibold text-gray-800">{{ $reward->reward_name }}</h2>
                          <span class="text-sm font-medium text-gray-600">Points: {{ $reward->points_required }}</span>
                      </div>
                      <p class="text-gray-600 mt-2">{{ $reward->reward_description }}</p>

                      <div class="mt-4 flex justify-between items-center">
                          <!-- Add Claim Reward Button -->
                          <form action="{{ route('rewards.claim', $reward->reward_id) }}" method="POST"
                              class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-lg font-semibold rounded-md shadow hover:bg-green-700">
                              @csrf
                              <button type="submit">Claim Reward</button>
                          </form>
                      </div>
                  </div>
              @endforeach
          </div>
      @endif
  </x-horizontal-card>
</x-layout>
