<x-owner-layout>
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row items-start gap-8">
      <div class="w-full md:w-64 h-64 flex-shrink-0">
        <img class="w-full h-full object-cover rounded-lg shadow-md"
          src="{{ $cafe->logo ? asset('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg') }}"
          alt="{{ $cafe->cafe_name }}">
      </div>

      <div class="flex-grow">
        <div class="flex justify-between items-start">
          <h1 class="text-4xl md:text-5xl font-light text-gray-800 mb-4">
            {{ $cafe->cafe_name }}
          </h1>

          <div class="relative">
            <button id="dropdownButton" class="text-gray-500 hover:text-gray-700 focus:outline-none p-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
              </svg>
            </button>

            <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
              <ul class="py-1">
                <li>
                  <a href="{{ route('cafes.edit', $cafe->cafe_id) }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition duration-150 ease-in-out">
                    <i class="fas fa-pencil-alt mr-2"></i>Edit Cafe
                  </a>
                </li>
                <li>
                  <form action="{{ route('cafes.destroy', $cafe->cafe_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this cafe?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150 ease-in-out">
                      <i class="fas fa-trash-alt mr-2"></i>Delete Cafe
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <x-owner-cafe-tags :tagsCsv="$cafe->cafe_tags"></x-owner-cafe-tags>
        </div>

        <p class="text-gray-600 mb-6 text-justify">
          {{ $cafe->description }}
        </p>

        <div class="space-y-2 text-gray-600">

          <div class="flex items-center">
            <i class="fa fa-phone w-5 text-gray-400"></i>
            <span>{{ $cafe->phone_number }}</span>
          </div>
        
          <div class="flex items-center">
            <i class="fa fa-envelope w-5 text-gray-400"></i>
            <span>{{ $cafe->email }}</span>
          </div>
        
          <div class="flex items-center">
            <i class="fas fa-location-dot w-5 text-gray-400"></i>
            <span>{{ $cafe->location }}</span>
          </div>
        
          <div class="flex items-center">
            <i class="fa fa-clock w-5 text-gray-400"></i>
            <span>Open: {{ $cafe->opening_time }} - {{ $cafe->closing_time }}</span>
          </div>
        
        </div>
      </div>
    </div>

    <div class="mt-12">
      @if($cafe->menus->isEmpty())
        <div class="text-center">
          <a href="{{ route('menus.create', $cafe->cafe_id) }}" class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">
            Create Your First Menu Item
          </a>
        </div>
      @else
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-3xl font-light text-gray-800">Menu</h2>
          <a href="{{ route('menus.manage', $cafe->cafe_id) }}" class="text-blue-500 hover:text-blue-600 transition duration-150 ease-in-out">
            Manage Menu
          </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
          @foreach($cafe->menus as $menu)
            <a href="{{ route('menus.manage_single', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}" 
              class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 ease-in-out hover:no-underline">
              <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                <img class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300 ease-in-out" 
                  src="{{ $menu->item_image ? asset('storage/' . $menu->item_image) : asset('storage/images/default_image.jpg') }}" 
                  alt="{{ $menu->item_name }}">
              </div>
              <div class="p-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $menu->item_name }}</h3>
                <p class="text-lg font-medium text-blue-600">RM {{ number_format($menu->price, 2) }}</p>
              </div>
            </a>
          @endforeach
        </div>
      @endif
    </div>
  </div>
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