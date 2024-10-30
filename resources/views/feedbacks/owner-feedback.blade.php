<x-owner-layout>
    <x-horizontal-card>
        <h2 class="page_title">Manage Feedbacks</h2>
  
        @if ($cafe->feedbacks->isEmpty())
            <p class="text-gray-400">No feedback has been submitted for this cafe yet.</p>
        @else
            <ul class="space-y-6">
                @foreach ($cafe->feedbacks as $feedback)
                    <li class="bg-gray-800 border border-gray-700 rounded-lg p-6 shadow-md">
                        <div class="flex items-start justify-between space-x-4">
                            <!-- Rating Section -->
                            <div class="flex-shrink-0">
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="h-6 w-6 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-600' }}" 
                                             xmlns="http://www.w3.org/2000/svg" 
                                             fill="currentColor" 
                                             viewBox="0 0 24 24" 
                                             stroke="none">
                                            <path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-6.18-.54L12 2 8.18 8.7 2 9.24l5.46 4.73L5.82 21z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <!-- Feedback Details -->
                            <div class="flex-grow">
                                <p class="text-lg text-gray-300 mb-2 text-justify">{{ $feedback->comments }}</p>
                                <p class="text-sm text-gray-400">Submitted by {{ $feedback->user->name }} on {{ $feedback->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-horizontal-card>
</x-owner-layout>