<x-layout>
  <x-horizontal-card>
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Feedback</h2>

      @if ($feedbacks->isEmpty())
          <p class="text-gray-500">You have not provided any feedback yet.</p>
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
                              <p class="text-sm text-gray-600">Submitted on {{ $feedback->created_at->format('M d, Y') }}</p>
                          </div>
                          <!-- Action Buttons -->
                          <div class="flex items-center space-x-2">
                              <!-- Edit Button -->
                              <a href="{{ route('feedback.edit', ['feedback' => $feedback->feedback_id]) }}"
                                  class="text-blue-500 hover:text-blue-700">
                                  <i class="fas fa-pencil-alt"></i> Edit
                              </a>
                              <!-- Delete Button -->
                              <form action="{{ route('feedback.destroy', ['feedback' => $feedback->feedback_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-red-500 hover:text-red-700">
                                      <i class="fas fa-trash-alt"></i> Delete
                                  </button>
                              </form>
                          </div>
                      </div>
                  </li>
              @endforeach
          </ul>
      @endif
  </x-horizontal-card>
</x-layout>