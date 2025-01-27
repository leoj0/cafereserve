<x-layout>
  <x-horizontal-card>
    <div class="container mx-auto mt-8">
      <div class="bg-gray-800 shadow-md rounded-lg p-6 mb-4">
        <!-- Reward Title -->
        <h1 class="text-3xl font-bold text-white mb-4">{{ $reward->reward_name }}</h1>

        <!-- Reward Description -->
        <p class="text-gray-300 text-lg mb-4">{{ $reward->reward_description }}</p>

        <!-- Points Required -->
        <div class="mb-4">
          <strong class="text-gray-200">Points Required:</strong> 
          <span class="text-gray-300">{{ $reward->points_required }}</span>
        </div>

        <!-- Available At -->
        <div class="mb-4">
          <strong class="text-gray-200">Available at:</strong> 
          <span class="text-gray-300">{{ $reward->cafe->cafe_name }}</span>
        </div>

        <!-- Reward Status -->
        @if(in_array($reward->reward_id, $claimedRewardIds))
        <button class="inline-block bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded cursor-not-allowed" 
          disabled>
          Claimed
        </button>
        @else
          @if(auth()->user()->points >= $reward->points_required)
          <form action="{{ route('rewards.claim', $reward->reward_id) }}" method="POST">
            @csrf
            <button type="submit" 
              class="inline-block bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-600">
              Claim Reward
            </button>
          </form>
          @else
          <button class="inline-block bg-gray-500 text-white text-sm font-medium px-4 py-2 rounded cursor-not-allowed" 
            disabled>
            Not Enough Points
          </button>
          @endif
        @endif
      </div>
    </div>
  </x-horizontal-card>
</x-layout>
