<x-layout>
    <x-horizontal-card>
        <div class="flex items-center justify-between mb-8">
            <h2 class="page_title">
                <i class="fas fa-gift mr-3 text-blue-400"></i>
                Available Rewards
            </h2>
        </div>

        <div class="space-y-4">
            @foreach ($rewards as $reward)
            <a href="{{ route('rewards.show', $reward->reward_id) }}"
                class="block bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl border border-gray-700/50 hover:shadow-2xl transition-all duration-300 group">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div class="space-y-3">
                            <h3
                                class="text-xl font-medium text-white group-hover:text-blue-400 transition-colors duration-300">
                                {{ $reward->reward_name }}
                            </h3>

                            <div class="space-y-2">
                                <div class="flex items-center text-gray-300">
                                    <div
                                        class="w-8 h-8 bg-gray-900/50 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-star text-blue-400"></i>
                                    </div>
                                    <span>{{ $reward->points_required }} points required</span>
                                </div>

                                <div class="flex items-center text-gray-400">
                                    <div
                                        class="w-8 h-8 bg-gray-900/50 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-store text-blue-400"></i>
                                    </div>
                                    <span>Available at {{ $reward->cafe->cafe_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            @if(in_array($reward->reward_id, $claimedRewardIds))
                            <div class="flex items-center px-4 py-2 bg-gray-900/50 rounded-lg border border-gray-700">
                                <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                <span class="text-gray-300 text-sm font-medium">Claimed</span>
                            </div>
                            @else
                            @if(auth()->user()->points >= $reward->points_required)
                            <form action="{{ route('rewards.claim', $reward->reward_id) }}" method="POST"
                                class="flex-shrink-0" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-lg transition-colors duration-300">
                                    <i class="fas fa-gift mr-2"></i>
                                    Claim Reward
                                </button>
                            </form>
                            @else
                            <div class="flex items-center px-4 py-2 bg-gray-900/50 rounded-lg border border-gray-700">
                                <i class="fas fa-lock text-gray-500 mr-2"></i>
                                <span class="text-gray-400 text-sm font-medium">Not Enough Points</span>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </x-horizontal-card>
</x-layout>