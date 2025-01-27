<x-layout>
    <x-horizontal-card>
        <h2 class="page_title">Your Feedback</h2>

        @if ($feedbacks->isEmpty())
            <div class="p-4 rounded-lg bg-gray-800 text-gray-300">
                You have not provided any feedback yet.
            </div>
        @else
            <div class="space-y-4">
                @foreach ($feedbacks as $feedback)
                    <div class="p-6 rounded-lg bg-gray-800 border border-gray-700 shadow-lg">
                        <h3 class="text-lg font-semibold text-gray-200">
                            {{ $feedback->cafe->cafe_name ?? 'Unknown Cafe' }}
                        </h3>
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-600' }}" 
                                         fill="currentColor" 
                                         viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-300 comment-text justify-text" data-full-text="{{ $feedback->comments }}" data-truncated-text="{{ Str::limit($feedback->comments, 100) }}">
                                {{ Str::limit($feedback->comments, 100) }}
                            </p>
                            @if (Str::length($feedback->comments) > 100)
                                <button class="text-blue-400 hover:text-blue-300 transition toggle-btn">
                                    See More...
                                </button>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">
                                Submitted on {{ $feedback->created_at->format('M d, Y') }}
                            </span>
                            <!-- Edit and Delete Buttons -->
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-horizontal-card>
</x-layout>
