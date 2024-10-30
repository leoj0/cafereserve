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

                    <div class="flex space-x-4">
                        <a href="{{ route('feedback.edit', $feedback) }}" 
                            class="text-blue-400 hover:text-blue-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                width="18" 
                                height="18" 
                                viewBox="0 0 24 24" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="2" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                class="hover:scale-110 transition-transform">
                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                <path d="m15 5 4 4"/>
                            </svg>
                        </a>

                        <form action="{{ route('feedback.destroy', $feedback) }}" 
                            method="POST" 
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="text-red-400 hover:text-red-300 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    width="18" 
                                    height="18" 
                                    viewBox="0 0 24 24" 
                                    fill="none" 
                                    stroke="currentColor" 
                                    stroke-width="2" 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    class="hover:scale-110 transition-transform">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <line x1="10" y1="11" x2="10" y2="17"/>
                                    <line x1="14" y1="11" x2="14" y2="17"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </x-horizontal-card>
</x-layout>

<script>
    document.querySelectorAll('.toggle-btn').forEach(button => {
        button.addEventListener('click', function () {
            const commentText = this.previousElementSibling;
            const isExpanded = commentText.textContent === commentText.getAttribute('data-full-text');

            if (isExpanded) {
                commentText.textContent = commentText.getAttribute('data-truncated-text');
                this.textContent = 'See More...';
            } else {
                commentText.textContent = commentText.getAttribute('data-full-text');
                this.textContent = 'See Less';
            }
        });
    });
</script>

<style>
    .justify-text {
        text-align: justify;
    }
</style>
