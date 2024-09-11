<x-layout>
  <x-horizontal-card>
    <div class="container mx-auto mt-8">
      <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $reward->reward_name }}</h1>

        <p class="text-gray-700 text-lg mb-4">{{ $reward->reward_description }}</p>

        <div class="mb-4">
          <strong class="text-gray-800">Points Required:</strong> {{ $reward->points_required }}
        </div>

        <div class="mb-4">
          <strong class="text-gray-800">Available at:</strong> {{ $reward->cafe->cafe_name }}
        </div>

        @if(in_array($reward->reward_id, $claimedRewardIds))
        <button class="inline-block bg-gray-400 text-white text-sm font-medium px-4 py-2 rounded cursor-not-allowed"
          disabled>
          Claimed
        </button>
        @else
        @if(auth()->user()->points >= $reward->points_required)
        <form action="{{ route('rewards.claim', $reward->reward_id) }}" method="POST">
          @csrf
          <button type="submit"
            class="inline-block bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-indigo-700">
            Claim Reward
          </button>
        </form>
        @else
        <button class="inline-block bg-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded cursor-not-allowed"
          disabled>
          Not Enough Points
        </button>
        @endif
        @endif
      </div>
    </div>
  </x-horizontal-card>
</x-layout>