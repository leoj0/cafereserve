<x-layout>
  <x-horizontal-card>
    <div class="container mx-auto px-4 py-8">
      <!-- Points Section -->
      <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Points</h2>
        <p class="text-lg text-gray-700">You currently have <strong class="text-indigo-600">{{ $points }}</strong> loyalty points.</p>
      </div>

      <!-- Claimed Rewards Section -->
      <h2 class="text-2xl font-bold text-gray-900 mb-4">Claimed Rewards</h2>

      @if($claimedRewards->isEmpty())
        <p class="text-gray-700">You haven't claimed any rewards yet.</p>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          @foreach($claimedRewards as $claimedReward)
            <a href="{{ route('rewards.show', $claimedReward->reward_id) }}" class="bg-white shadow-md rounded-lg p-4 flex flex-col h-full hover:bg-gray-100 transition duration-300 ease-in-out">
              <div class="flex flex-col h-full">
                <h5 class="text-lg font-semibold text-gray-800 mb-2">{{ $claimedReward->reward->reward_name }}</h5>
                <p class="text-gray-600 mb-2">Claimed on: {{ $claimedReward->claimed_at->format('M d, Y') }}</p>
                @if($claimedReward->used_at)
                  <p class="text-gray-500">Used on: {{ $claimedReward->used_at->format('M d, Y') }}</p>
                @else
                  <p class="text-green-600">Available for use</p>
                @endif
              </div>
            </a>
          @endforeach
        </div>
      @endif
    </div>
  </x-horizontal-card>
</x-layout>
