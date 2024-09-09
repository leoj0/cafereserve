<x-owner-layout>
    <x-horizontal-card>
        <h1 class="text-2xl font-bold mb-6">Rewards List</h1>

        @if ($rewards->isEmpty())
            <p class="text-gray-600">No rewards available for this cafe.</p>
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
                            <div class="text-sm text-gray-500">
                                <a href="{{ route('rewards.edit', $reward->reward_id) }}"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('rewards.destroy', $reward->reward_id) }}" method="POST"
                                    class="inline ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('rewards.create') }}"
                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-lg font-semibold rounded-md shadow hover:bg-indigo-700">
                Add Reward
            </a>
        </div>
    </x-horizontal-card>
</x-owner-layout>
