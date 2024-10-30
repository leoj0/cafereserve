{{-- resources/views/partials/feedbacks.blade.php --}}
@if(isset($feedbacks) && $feedbacks->isEmpty())
<div class="text-center">
    <p class="text-gray-400">No feedback available.</p>
</div>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    @foreach($feedbacks as $feedback)
    <div class="bg-gray-700 rounded-xl shadow-sm p-4 flex flex-col justify-between">
        <div>
            <!-- Feedback Header -->
            <div class="flex items-center mb-2">
                @if($feedback->user)
                <span class="font-semibold text-white">{{ $feedback->user->name }}</span>
                @else
                <span class="font-semibold text-white">Anonymous</span>
                @endif
                <span class="ml-2 text-gray-400 text-sm">{{ $feedback->created_at->format('M d, Y') }}</span>
            </div>

            <!-- Star Ratings -->
            <div class="flex items-center mb-2">
                @for($i = 1; $i <= 5; $i++)
                <svg class="w-4 h-4 fill-current {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-500' }}"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.27l-7.19-.61L12 2 9.19 8.66 2 9.27l5.46 4.7L5.82 21z" />
                </svg>
                @endfor
            </div>

            <!-- Feedback Comment -->
            <p class="text-gray-300 text-sm text-justify">{{ Str::limit($feedback->comments, 80) }}</p>
        </div>
    </div>
    @endforeach
</div>

<!-- View All Feedbacks Link -->
<div class="mt-4 text-center">
    <a href="{{ route('feedbacks.index', ['cafe' => $cafe->cafe_id]) }}"
        class="text-indigo-400 hover:text-blue-600 font-medium">
        View All Feedbacks
    </a>
</div>
@endif
