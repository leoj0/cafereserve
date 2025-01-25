<x-layout>
  <x-card>
      <h2 class="form-title">Edit Feedback</h2>

      <form action="{{ route('feedback.update', $feedback->feedback_id) }}" method="POST">
          @csrf
          @method('PUT')

          <!-- Cafe Selection (Read-only) -->
          <div class="mt-6">
              <label for="cafe_id" class="block text-lg font-medium text-gray-700">Cafe</label>
              <input type="text" name="cafe_id" id="cafe_id" value="{{ $feedback->cafe->cafe_name }}" readonly
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
          </div>

          <!-- Star Rating -->
          <div class="mt-6">
              <label class="block text-lg font-medium text-gray-700">Rating</label>
              <div class="flex items-center mt-2 space-x-2">
                  @for ($i = 1; $i <= 5; $i++)
                      <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden" {{ $feedback->rating == $i ? 'checked' : '' }} />
                      <label for="star{{ $i }}" class="cursor-pointer star" data-value="{{ $i }}">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                              class="w-10 h-10 star-icon"
                              style="color: {{ $feedback->rating >= $i ? '#facc15' : '#ccc' }}; transition: color 0.2s ease-in-out;">
                              <path
                                  d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                          </svg>
                      </label>
                  @endfor
              </div>
          </div>
          @error('rating')
              <div class="text-red-500 mt-1">{{ $message }}</div>
          @enderror

          <!-- Comments -->
          <div class="mt-6">
              <label for="comments" class="block text-lg font-medium text-gray-700">Comments</label>
              <textarea name="comments" id="comments" rows="6" required
                  class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                  placeholder="Update your experience">{{ old('comments', $feedback->comments) }}</textarea>
          </div>
          @error('comments')
              <div class="text-red-500 mt-1">{{ $message }}</div>
          @enderror

          <!-- Submit Button -->
          <div class="mt-8">
              <button type="submit"
                  class="form-button">
                  Update Feedback
              </button>
          </div>
      </form>
  </x-card>
</x-layout>

<!-- Add JavaScript for interactive stars -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
      const stars = document.querySelectorAll('.star');
      const ratingInput = document.querySelector('input[name="rating"]');

      stars.forEach(star => {
          star.addEventListener('mouseover', () => {
              const value = star.getAttribute('data-value');
              updateStars(value);
          });

          star.addEventListener('mouseout', () => {
              const selectedValue = ratingInput ? ratingInput.value : 0;
              updateStars(selectedValue);
          });

          star.addEventListener('click', () => {
              const value = star.getAttribute('data-value');
              ratingInput.value = value;
              updateStars(value);
          });
      });

      function updateStars(value) {
          stars.forEach(star => {
              const starValue = star.getAttribute('data-value');
              const starIcon = star.querySelector('.star-icon');

              if (starValue <= value) {
                  starIcon.style.color = '#facc15'; // Yellow color
              } else {
                  starIcon.style.color = '#ccc'; // Gray color
              }
          });
      }
  });
</script>
