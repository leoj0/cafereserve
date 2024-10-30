<x-layout>
  <!-- Hero Section -->
  <div class="bg-gradient-to-b from-gray-800 to-gray-900 py-8">
    <div class="max-w-screen-xl mx-auto px-4">
      <h1 class="text-4xl font-bold text-center text-white mb-4">Discover Your Next Favorite Cafe</h1>
      <p class="text-gray-300 text-center max-w-2xl mx-auto">Explore our curated selection of unique cafes, each offering their own special atmosphere and experience</p>
      
      <!-- Search Bar -->
      <div class="mt-8">
        <form action="{{ route('reservations.search') }}" method="GET" class="max-w-4xl mx-auto">
          <div class="flex flex-col md:flex-row gap-4">
            <!-- Cafe Name Input -->
            <div class="relative flex-1">
              <input 
                type="text" 
                name="cafe_name" 
                placeholder="Search cafe name..."
                class="w-full pl-12 pr-4 py-3 bg-gray-700 text-white placeholder-gray-400 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
              <i class="fas fa-coffee absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <!-- Location Input -->
            <div class="relative flex-1">
              <input 
                type="text" 
                name="location" 
                placeholder="Enter location..."
                class="w-full pl-12 pr-4 py-3 bg-gray-700 text-white placeholder-gray-400 rounded-lg border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
              <i class="fas fa-location-dot absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>

            <!-- Search Button -->
            <button 
              type="submit"
              class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out flex items-center justify-center"
            >
              <i class="fas fa-search mr-2"></i>
              Search
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Results Section -->
  <div class="max-w-screen-xl mx-auto px-4 py-8">
    @if($cafes->isEmpty())
      <div class="flex flex-col items-center justify-center h-64 bg-gray-800 rounded-lg">
        <i class="fas fa-coffee text-4xl text-gray-400 mb-4"></i>
        <p class="text-2xl font-bold text-gray-300">No cafes found</p>
        <p class="text-gray-400 mt-2">Try adjusting your filters or search criteria</p>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($cafes as $cafe)
          <div class="group bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col h-full">
            <!-- Image Container -->
            <div class="relative overflow-hidden aspect-w-16 aspect-h-9">
              <img 
                class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-300"
                src="{{ $cafe->logo ? asset('storage/' . $cafe->logo) : asset('storage/images/default_image.jpg') }}" 
                alt="{{ $cafe->cafe_name }}">
              <!-- Quick View Button -->
              <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="bg-white text-gray-900 px-4 py-2 rounded-full font-medium hover:bg-blue-500 hover:text-white transition-colors duration-300">
                  Quick View
                </button>
              </div>
            </div>

            <!-- Content -->
            <div class="p-4 flex flex-col flex-grow">
              <!-- Header -->
              <div class="flex justify-between items-start mb-3">
                <h3>
                  <a href="/cafe_listings/{{ $cafe->cafe_id }}" 
                     class="text-lg font-semibold text-white hover:text-blue-400 transition-colors duration-300">
                     {{ $cafe->cafe_name }}
                  </a>
                </h3>
                <!-- Rating -->
                <div class="flex items-center bg-gray-700 px-2 py-1 rounded">
                  <i class="fas fa-star text-yellow-400 mr-1"></i>
                  <span class="text-white">4.5</span>
                </div>
              </div>

              <!-- Tags -->
              <div class="flex flex-wrap gap-2 mb-3">
                <x-cafe-tags :tagsCsv="$cafe->cafe_tags"></x-cafe-tags>
              </div>

              <!-- Location & Operating Hours -->
              <div class="text-gray-400 space-y-2 mt-auto">
                <div class="flex items-center">
                  <i class="fa-solid fa-location-dot mr-2"></i>
                  <p>{{ $cafe->location }}</p>
                </div>
                <div class="flex items-center">
                  <i class="fa-solid fa-clock mr-2"></i>
                  <p>Opens {{ $cafe->opening_time }} - {{ $cafe->closing_time }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-8 flex justify-center">
        {{ $cafes->links('pagination::tailwind') }}
      </div>
    @endif
  </div>
</x-layout>