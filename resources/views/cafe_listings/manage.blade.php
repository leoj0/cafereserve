<x-owner-layout>
  <x-horizontal-card class="bg-white">
      <div class="flex flex-col md:flex-row items-start gap-8">
          <!-- Cafe Logo with subtle border and hover effect -->
          <div class="w-full md:w-64 h-64 flex-shrink-0 group">
              <img class="w-full h-full object-cover rounded-lg shadow-lg border border-gray-300 transition-transform duration-300 group-hover:scale-[1.02]"
                  src="{{ $cafe->logo ? asset('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg') }}"
                  alt="{{ $cafe->cafe_name }}">
          </div>

          <!-- Cafe Details with darker text -->
          <div class="flex-grow">
              <div class="flex justify-between items-start">
                  <h1 class="text-4xl md:text-5xl mb-4 text-gray-900 font-light tracking-tight">
                      {{ $cafe->cafe_name }}
                  </h1>

                  <div class="relative">
                      <button id="dropdownButton" class="text-gray-500 hover:text-gray-700 focus:outline-none p-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                          </svg>
                      </button>

                      <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-20">
                          <ul class="py-1">
                              <li>
                                  <a href="{{ route('cafes.edit', $cafe->cafe_id) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                      <i class="fas fa-pencil-alt mr-2"></i>Edit Cafe
                                  </a>
                              </li>
                              <li>
                                  <form action="{{ route('cafes.destroy', $cafe->cafe_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this cafe?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                          <i class="fas fa-trash-alt mr-2"></i>Delete Cafe
                                      </button>
                                  </form>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>

              <div class="mb-6">
                  <x-owner-cafe-tags :tagsCsv="$cafe->cafe_tags"></x-owner-cafe-tags>
              </div>

              <p class="text-gray-700 mb-8 text-justify leading-relaxed">
                  {{ $cafe->description }}
              </p>

              <!-- Contact Information with darker accents -->
              <div class="space-y-4 text-gray-700">
                  <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                      <i class="fa fa-phone w-5 text-gray-600"></i>
                      <span class="ml-3 font-medium">{{ $cafe->phone_number }}</span>
                  </div>

                  <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                      <i class="fa fa-envelope w-5 text-gray-600"></i>
                      <span class="ml-3 font-medium">{{ $cafe->email }}</span>
                  </div>

                  <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                      <i class="fas fa-location-dot w-5 text-gray-600"></i>
                      <span class="ml-3 font-medium">{{ $cafe->location }}</span>
                  </div>

                  <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                      <i class="fa fa-clock w-5 text-gray-600"></i>
                      <span class="ml-3 font-medium">Open: {{ $cafe->opening_time }} - {{ $cafe->closing_time }}</span>
                  </div>
              </div>
          </div>
      </div>
  </x-horizontal-card>
</x-owner-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const dropdownButton = document.getElementById('dropdownButton');
      const dropdown = document.getElementById('dropdown');

      dropdownButton.addEventListener('click', function(event) {
          event.stopPropagation();
          dropdown.classList.toggle('hidden');
      });

      document.addEventListener('click', function(event) {
          if (!dropdown.contains(event.target) && event.target !== dropdownButton) {
              dropdown.classList.add('hidden');
          }
      });
  });
</script>
