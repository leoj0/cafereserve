<x-owner-layout>
  <div class="container mx-auto px-4 py-8">
    @if($cafe->menus->isEmpty())
      <div class="text-center">
        <a href="{{ route('menus.create', $cafe) }}" class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300 ease-in-out">
          Create Your First Menu Item
        </a>
      </div>
    @else
      <h2 class="text-3xl font-light text-gray-800 mb-8 text-center">Menu</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($cafe->menus as $menu)
          <a href="{{ route('menus.manage_single', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}"
            class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 ease-in-out hover:no-underline">
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

        <a href="{{ route('menus.create', $cafe) }}"
          class="flex items-center justify-center bg-gray-100 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 ease-in-out group">
          <div class="text-gray-400 group-hover:text-gray-600 transition duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </div>
        </a>
      </div>
    @endif
  </div>
</x-owner-layout>