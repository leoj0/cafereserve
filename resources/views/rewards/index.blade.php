<x-layout>
    <x-horizontal-card>
      <div class="container mx-auto mt-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-6">Available Rewards</h1>
  
          @foreach ($rewards as $reward)
              <!-- Wrapping the entire card in an anchor tag -->
              <a href="{{ route('rewards.show', $reward->reward_id) }}" class="block bg-white shadow-md rounded-lg p-6 mb-4 hover:bg-gray-100 transition duration-300">
                  <div class="flex justify-between items-center">
                      <div>
                          <h3 class="text-xl font-semibold text-gray-800">{{ $reward->reward_name }}</h3>
                          <p class="text-gray-600">Required Points: {{ $reward->points_required }}</p>
                          <p class="text-gray-500">Available at: {{ $reward->cafe->cafe_name }}</p> 
                      </div>
                      
                      <div class="flex space-x-2">
                          <!-- Checking if the reward is claimed -->
                          @if(in_array($reward->reward_id, $claimedRewardIds))
                              <span class="bg-gray-500 text-white text-sm font-semibold px-4 py-2 rounded">Claimed</span>
                          @else
                              <!-- If not enough points, show disabled button -->
                              @if(auth()->user()->points >= $reward->points_required)
                                  <!-- Prevent form from triggering link navigation -->
                                  <form action="{{ route('rewards.claim', $reward->reward_id) }}" method="POST">
                                      @csrf
                                      <button type="submit" 
                                          class="inline-block bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-indigo-700">
                                          Claim Reward
                                      </button>
                                  </form>
                              @else
                                  <button class="inline-block bg-gray-300 text-gray-700 text-sm font-medium px-4 py-2 rounded cursor-not-allowed" disabled>
                                      Not Enough Points
                                  </button>
                              @endif
                          @endif
                      </div>
                  </div>
              </a>
          @endforeach
      </div>
    </x-horizontal-card>
  </x-layout>
  