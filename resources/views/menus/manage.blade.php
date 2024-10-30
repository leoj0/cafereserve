<x-owner-layout>
  <x-horizontal-card>
    <h2 class="page_title">Menu</h2>
    @if($cafe->menus->isEmpty())
      <div>
        <div class="mt-8">
          <a href="{{ route('menus.create', $cafe) }}" class="link-button">
            ADD ITEM
          </a>
        </div>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($cafe->menus as $menu)
          <a href="{{ route('menus.manage_single', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}"
            class="group bg-gray-700 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 ease-in-out hover:no-underline">
            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
              <img class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300 ease-in-out"
                src="{{ $menu->item_image ? asset('storage/' . $menu->item_image) : asset('storage/images/default_image.jpg') }}"
                alt="{{ $menu->item_name }}">
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold text-white mb-1">{{ $menu->item_name }}</h3>
              <p class="text-lg font-medium text-gray-400">RM {{ number_format($menu->price, 2) }}</p>
            </div>
          </a>
        @endforeach

        <!-- Add Item Plus Card -->
        <a href="{{ route('menus.create', $cafe) }}"
          class="flex items-center justify-center bg-gray-700 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 ease-in-out group">
          <div class="text-gray-400 group-hover:text-gray-200 transition duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </div>
        </a>
      </div>
    @endif
  </x-horizontal-card>
</x-owner-layout>
