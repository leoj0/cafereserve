<div class="relative flex items-center justify-center min-h-screen">
    <!-- Background Image -->
    <img 
      src="{{ asset('storage/images/search_photo.png') }}" 
      alt="Cafe Background" 
      class="absolute inset-0 w-full h-full object-cover blur-sm"
    >
    <!-- Dark overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
  
    <!-- Overlay Content -->
    <div class="relative w-full max-w-4xl p-6 bg-white/80 rounded-xl shadow-lg">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">
          Find Your Perfect Cafe
        </h1>
        <form action="{{ route('reservations.search') }}" method="GET" class="space-y-4">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Cafe Name Input -->
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 transition duration-300 ease-in-out"
                        placeholder="Cafe Name"
                    >
                    <i class="fas fa-coffee text-gray-400 absolute top-1/2 left-4 transform -translate-y-1/2 text-xl"></i>
                </div>
  
                <!-- Location Input -->
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="location" 
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 transition duration-300 ease-in-out"
                        placeholder="Location"
                    >
                    <i class="fas fa-map-marker-alt text-gray-400 absolute top-1/2 left-4 transform -translate-y-1/2 text-xl"></i>
                </div>
            </div>
  
            <!-- Search Button -->
            <div class="flex flex-col items-center gap-4">
                <button type="submit" class="form-button">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <a href="{{ route('cafes.index') }}" class="text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out">
                    >>> Explore Cafes
                </a>
            </div>
        </form>
    </div>
</div>