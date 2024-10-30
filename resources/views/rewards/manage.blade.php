<x-owner-layout>
    <x-horizontal-card>
        <h2 class="page_title">Rewards List</h2>

        <div>
            <a href="{{ route('rewards.create', ['cafe' => $cafe->cafe_id]) }}" class="link-button">
                Add Reward
            </a>
        </div>

        <div class="mt-8">
            @if(isset($rewards) && $rewards->isEmpty())
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($rewards as $reward)
                <div class="bg-gray-700 rounded-xl shadow-sm p-4 flex flex-col justify-between">
                    <!-- Reward Name -->
                    <h3 class="text-xl font-semibold text-white mb-2">{{ $reward->reward_name }}</h3>

                    <!-- Reward Points -->
                    <p class="text-lg text-gray-300 mb-1">
                        <i class="fas fa-coins text-yellow-400 mr-2"></i>{{ $reward->points_required }} points
                    </p>

                    <!-- Reward Description -->
                    <p class="text-sm text-gray-400 mb-4">{{ Str::limit($reward->description, 80) }}</p>

                    <!-- Actions: Edit and Delete -->
                    <div class="mt-4 flex items-center space-x-4">
                        <!-- Edit Button -->
                        <a href="{{ route('rewards.edit', $reward->reward_id) }}"
                            class="text-blue-500 hover:text-blue-700 transition duration-200">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('rewards.destroy', $reward->reward_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </x-horizontal-card>
</x-owner-layout>