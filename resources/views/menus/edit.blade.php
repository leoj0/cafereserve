<x-owner-layout>
    <x-card>
        <h2 class="form-title">Edit Menu Item</h2>

        <form action="{{ route('menus.update', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

            <!-- Menu Item Name -->
            <div>
                <label for="item_name" class="block text-lg font-medium text-gray-700">Item Name</label>
                <input type="text" name="item_name" id="item_name" required
                    class="box-inputbar"
                    value="{{ old('item_name', $menu->item_name) }}">
                @error('item_name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Menu Item Description -->
            <div class="mt-6">
                <label for="item_description" class="block text-lg font-medium text-gray-700">Item Description</label>
                <textarea name="item_description" id="item_description" rows="6"
                    class="box-inputbar"
                    placeholder="Describe the menu item">{{ old('item_description', $menu->item_description) }}</textarea>
                @error('item_description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div class="mt-6">
                <label for="price" class="block text-lg font-medium text-gray-700">Price</label>
                <div class="price-input-wrapper">
                    <input type="text" name="price" id="price" required
                        class="box-inputbar pl-16"
                        value="{{ old('price', $menu->price) }}">
                    <span class="currency-symbol">
                        RM
                    </span>
                </div>
                @error('price')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Item Image -->
            <div class="mt-6">
                <label for="item_image" class="block text-lg font-medium text-gray-700">Item Image</label>
                <input type="file" name="item_image" id="item_image"
                    class="box-inputbar">
                @error('item_image')
                    <div class="form-error">{{ $message }}</div>
                @enderror

                <!-- Display existing image if available -->
                @if ($menu->item_image)
                    <img src="{{ asset('storage/' . $menu->item_image) }}" alt="Current Image" class="mt-2">
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="form-button">
                    Update Menu Item
                </button>
            </div>
        </form>
    </x-card>
</x-owner-layout>
