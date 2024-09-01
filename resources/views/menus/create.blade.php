<x-owner-layout>
    <x-card>
        <h2 class="title-form">Add Item</h2>

        <form action="{{ route('menus.store', ['cafe' => $cafe->cafe_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

            <!-- Menu Item Name -->
            <div class="mb-6">
                <label for="item_name" class="block text-lg font-medium text-gray-700">Item Name</label>
                <input type="text" name="item_name" id="item_name" required
                    class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                    value="{{ old('item_name') }}">
            </div>

            <!-- Menu Item Description -->
            <div class="mb-6">
                <label for="item_description" class="block text-lg font-medium text-gray-700">Item Description</label>
                <textarea name="item_description" id="item_description" rows="6"
                    class="mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                    placeholder="Describe the menu item">{{ old('item_description') }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <label for="price" class="block text-lg font-medium text-gray-700">Price</label>
                <div class="relative mt-2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 text-lg">
                        RM
                    </span>
                    <input type="text" name="price" id="price" required
                        class="block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg pl-12 pr-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg"
                        value="{{ old('price') }}">
                </div>
            </div>

            <!-- Item Image -->
            <div class="mb-6">
                <label for "item_image" class="block text-lg font-medium text-gray-700">Item Image</label>
                <input type="file" name="item_image" id="item_image"
                    class="mt-2 block w-full text-lg text-gray-500 file:mr-4 file:py-3 file:px-4 file:text-lg file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-3 bg-indigo-600 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-lg">
                    Add Menu Item
                </button>
            </div>
        </form>

    </x-card>
</x-owner-layout>