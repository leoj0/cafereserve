{{-- resources/views/partials/_rewards.blade.php --}}
@if(isset($rewards) && $rewards->isEmpty())
<div class="text-center">
    <p class="text-gray-300">No rewards available.</p>
</div>
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

        <!-- Claim Button -->
        <form action="{{ route('rewards.claim', ['reward' => $reward->reward_id]) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-300">
                Claim Reward
            </button>
        </form>
    </div>
    @endforeach
</div>
@endif
