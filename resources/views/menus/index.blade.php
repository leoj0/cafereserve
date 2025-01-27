<x-owner-layout>
  <div class="ml-5 mt-5 mb-5 mr-5">
    @if($cafe->menus->isEmpty())
    <a href="{{ route('menus.create', $cafe) }}" class="btn btn-primary">Create Menu</a>
    @else
    <!-- Display the menu items -->
    <h3 class="text-2xl font-semibold mb-4">Menu Items</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
      @foreach($cafe->menus as $menu)
      <a href="{{ route('menus.manage_single', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}"
        class="bg-white shadow rounded-lg overflow-hidden transition-transform transform hover:scale-105 hover:bg-gray-100 hover:no-underline">
        <img class=" w-full h-48 object-cover"
          src="{{ $menu->item_image ? asset('storage/' . $menu->item_image) : asset('storage/images/menu_default.jpg') }}"
          alt="{{ $menu->item_name }}">
        <div class="p-4">
          <h4 class="text-xl font-bold">{{ $menu->item_name }}</h4>
          <p class="text-lg font-semibold text-gray-900 mt-2">RM {{ number_format($menu->price, 2) }}</p>
        </div>
      </a>
      @endforeach
    </div>
    @endif
  </div>
</x-owner-layout>