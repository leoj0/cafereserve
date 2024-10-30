<!-- resources/views/partials/_menus.blade.php -->
    @if($cafe->menus->isEmpty())
    <div class="text-center">
        <p class="text-gray-300">No menu items available.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($cafe->menus as $menu)
        <a href="{{ route('menus.show', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}"
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
    </div>
    @endif
