<x-layout>
  <x-horizontal-card>
      <!-- Points Section -->
      <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 mb-10 border border-gray-700/50">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div>
            <h2 class="text-3xl font-light text-white mb-2 flex items-center">
              <i class="fas fa-star mr-3 text-yellow-400"></i>
              Your Points Balance
            </h2>
            <p class="text-gray-400">Track your loyalty rewards progress</p>
          </div>
          <div class="mt-4 md:mt-0">
            <div class="bg-gray-900/50 rounded-xl px-6 py-4 backdrop-blur-sm border border-gray-700/50">
              <p class="text-sm text-gray-400 mb-1">Current Balance</p>
              <p class="text-3xl font-bold text-white">
                <span class="text-blue-400">{{ $points }}</span>
                <span class="text-sm text-gray-500 ml-1">points</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Claimed Rewards Section -->
      <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-light flex items-center">
            <i class="fas fa-gift mr-3 text-blue-400"></i>
            Claimed Rewards
          </h2>
          <a href="{{ route('rewards.index') }}" class="text-blue-400 hover:text-blue-300 transition-colors duration-300 text-sm flex items-center">
            Browse Available Rewards
            <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>

        @if($claimedRewards->isEmpty())
          <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 text-center border border-gray-700/50">
            <div class="w-16 h-16 bg-gray-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-gift text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-300 mb-2">No Rewards Claimed Yet</h3>
            <p class="text-gray-400 mb-6">Start claiming rewards with your points to see them here.</p>
            <a href="{{ route('rewards.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg transition-colors duration-300">
              <i class="fas fa-shopping-bag mr-2"></i>
              Browse Rewards
            </a>
          </div>
        @else
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($claimedRewards as $claimedReward)
              <a href="{{ route('rewards.show', $claimedReward->reward_id) }}" 
                 class="group bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-6 flex flex-col h-full hover:shadow-2xl border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300 ease-in-out">
                <div class="flex flex-col h-full">
                  <div class="flex items-start justify-between mb-4">
                    <h5 class="text-lg font-medium text-white group-hover:text-blue-400 transition-colors duration-300">
                      {{ $claimedReward->reward->reward_name }}
                    </h5>
                    <div class="w-8 h-8 bg-gray-900/50 rounded-lg flex items-center justify-center">
                      <i class="fas fa-gift text-blue-400"></i>
                    </div>
                  </div>
                  
                  <div class="space-y-3 mb-4">
                    <div class="flex items-center text-gray-400">
                      <i class="fas fa-calendar-alt w-5 text-gray-500 mr-2"></i>
                      <span>Claimed on {{ $claimedReward->claimed_at->format('M d, Y') }}</span>
                    </div>
                    
                    @if($claimedReward->used_at)
                      <div class="flex items-center text-gray-500">
                        <i class="fas fa-check-circle w-5 mr-2"></i>
                        <span>Used on {{ $claimedReward->used_at->format('M d, Y') }}</span>
                      </div>
                    @else
                      <div class="flex items-center text-emerald-400">
                        <i class="fas fa-clock w-5 mr-2"></i>
                        <span>Available for use</span>
                      </div>
                    @endif
                  </div>
                  
                  <div class="mt-auto pt-4 border-t border-gray-700/50">
                    <span class="text-sm text-blue-400 group-hover:text-blue-300 flex items-center">
                      View Details
                      <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                    </span>
                  </div>
                </div>
              </a>
            @endforeach
          </div>
        @endif
      </div>
  </x-horizontal-card>
</x-layout>