<x-layout>
  <div class="container mx-auto p-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <!-- Menu Image -->
      <img class="mx-auto block object-contain max-w-md"
           src="{{ $menu->item_image ? asset('storage/' . $menu->item_image) : asset('storage/images/menu_default.jpg') }}" 
           alt="{{ $menu->item_name }}">

      <!-- Menu Details -->
      <div class="p-6">
        <div class="flex items-center justify-between">
          <!-- Item Name -->
          <h2 class="text-3xl font-bold">{{ $menu->item_name }}</h2>
        </div>
      </div>

        <!-- Item Description and Price -->
        <p id="description">{{ $menu->item_description }}</p>
        <p class="mt-4 text-xl font-semibold text-gray-900">RM {{ number_format($menu->price, 2) }}</p>

        <!-- Additional Details -->
        <div class="mt-6 flex items-center text-sm text-gray-500">
          <i class="fas fa-clock mr-2"></i>
          <span>Added on {{ $menu->created_at->format('M d, Y') }}</span>
        </div>
      </div>
    </div>
  </div>
</x-layout>

