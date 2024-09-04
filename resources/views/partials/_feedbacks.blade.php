{{-- resources/views/partials/feedbacks.blade.php --}}
<div class="mt-12 bg-gray-50 p-6 rounded-lg shadow-md">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-300 pb-2">Feedback</h2>

  @if(isset($feedbacks) && $feedbacks->isEmpty())
      <div class="text-center">
          <p class="text-gray-600">No feedback available.</p>
      </div>
  @else
      <div class="space-y-4">
          @foreach($feedbacks as $feedback)
              <div class="p-4 bg-white rounded-lg shadow-sm">
                  <div class="flex items-center mb-2">
                      @if($feedback->user)
                          <span class="font-semibold text-gray-800">{{ $feedback->user->name }}</span>
                      @else
                          <span class="font-semibold text-gray-800">Anonymous</span>
                      @endif
                      <span class="ml-2 text-gray-600 text-sm">{{ $feedback->created_at->format('M d, Y') }}</span>
                  </div>
                  <div class="flex items-center mb-2">
                      @for($i = 1; $i <= 5; $i++)
                          <svg class="w-5 h-5 fill-current {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.27l-7.19-.61L12 2 9.19 8.66 2 9.27l5.46 4.7L5.82 21z"/>
                          </svg>
                      @endfor
                  </div>
                  <p class="text-gray-600 text-justify">{{ $feedback->comments }}</p>
              </div>
          @endforeach
      </div>

      <!-- View All Feedbacks Link -->
      <div class="mt-4 text-center">
          <a href="{{ route('feedbacks.index', ['cafe' => $cafe->cafe_id]) }}"
             class="text-indigo-600 hover:text-indigo-800 font-medium">
              View All Feedbacks
          </a>
      </div>
  @endif
</div>
