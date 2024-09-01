<x-owner-layout>
  <div class="container mx-auto p-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
      <!-- Menu Image -->
      <img class="mx-auto block object-contain max-w-md"
           src="{{ $menu->item_image ? asset('storage/' . $menu->item_image) : asset('storage/images/default_image.jpg') }}" 
           alt="{{ $menu->item_name }}">

      <!-- Menu Details -->
      <div class="p-6">
        <div class="flex items-center justify-between">
          <!-- Item Name -->
          <h2 class="text-3xl font-bold">{{ $menu->item_name }}</h2>

          <!-- Dropdown Button -->
          <div class="relative">
            <button id="dropdownButton" class="text-gray-500 hover:text-gray-700 focus:outline-none">
              <i class="fas fa-ellipsis-v"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
              <a href="{{ route('menus.edit', $menu->menu_id) }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 hover:no-underline">
                <i class="fas fa-pencil-alt mr-2"></i>Edit
              </a>
              <form action="{{ route('menus.destroy', $menu->menu_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="block">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-100 hover:text-red-700">
                  <i class="fas fa-trash-alt mr-2"></i>Delete
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- Item Description and Price -->
        <p class="mt-2 text-gray-600 opacity-0 translate-y-4 transition-all duration-700 ease-out" id="description">{{ $menu->item_description }}</p>
        <p class="mt-4 text-xl font-semibold text-gray-900">RM {{ number_format($menu->price, 2) }}</p>

        <!-- Additional Details -->
        <div class="mt-6 flex items-center text-sm text-gray-500">
          <i class="fas fa-clock mr-2"></i>
          <span>Added on {{ $menu->created_at->format('M d, Y') }}</span>
        </div>
      </div>
    </div>
  </div>
</x-owner-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdown = document.getElementById('dropdown');
    const description = document.getElementById('description');

    // Dropdown functionality
    dropdownButton.addEventListener('click', function(event) {
      event.stopPropagation();
      dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
      if (!dropdown.contains(event.target) && event.target !== dropdownButton) {
        dropdown.classList.add('hidden');
      }
    });

    // Fade-in effect for description
    setTimeout(() => {
      description.classList.remove('opacity-0', 'translate-y-4');
      description.classList.add('opacity-100', 'translate-y-0');
    }, 100);
  });
</script>