<x-layout>
    <x-horizontal-card>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Feedback for {{ $cafe->cafe_name }}</h2>

        @if ($feedbacks->isEmpty())
            <p class="text-gray-500">No feedbacks available for this cafe.</p>
        @else
            <ul class="space-y-6">
                @foreach ($feedbacks as $feedback)
                    <li class="bg-white border border-gray-200 rounded-lg p-6 shadow-md">
                        <div class="flex items-start space-x-4">
                            <!-- Rating Section -->
                            <div class="flex-shrink-0">
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="h-6 w-6 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                                            <path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-6.18-.54L12 2 8.18 8.7 2 9.24l5.46 4.73L5.82 21z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <!-- Feedback Details -->
                            <div class="flex-grow">
                                <p class="text-lg text-gray-600 mb-2 text-justify">{{ $feedback->comments }}</p>
                                <p class="text-sm text-gray-600">By
                                    @if ($feedback->user)
                                        <span class="font-medium text-gray-700">{{ $feedback->user->name }}</span>
                                    @else
                                        <span class="font-medium text-gray-700">Anonymous</span>
                                    @endif
                                    on {{ $feedback->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-horizontal-card>
</x-layout>
