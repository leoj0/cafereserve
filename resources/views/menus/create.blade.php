<x-owner-layout>
    <x-card>
        <h2 class="form-title">Add Item</h2>

        <form action="{{ route('menus.store', ['cafe' => $cafe->cafe_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hidden input for cafe_id -->
            <input type="hidden" name="cafe_id" value="{{ $cafe->cafe_id }}">

            <!-- Menu Item Name -->
            <div>
                <input type="text" name="item_name" id="item_name" placeholder="Item Name" value="{{ old('item_name') }}" class="form-input" required>
                @error('item_name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Menu Item Description -->
            <div class="mt-6">
                <textarea name="item_description" id="item_description" rows="4" placeholder="Item Description" class="form-input" required>{{ old('item_description') }}</textarea>
                @error('item_description')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div class="mt-6">
                <div class="relative">
                    <span class="absolute left-3 top-1/4 transform -translate-y-1/2 font-semibold text-gray-600 text-lg">RM</span>
                    <input type="text" name="price" id="price" placeholder="Price" value="{{ old('price') }}" class="form-input pl-12" required>
                </div>
                @error('price')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Item Image -->
            <div class="mt-6">
                <input type="file" name="item_image" id="item_image" class="form-input">
                @error('item_image')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="form-button">
                    Add Menu Item
                </button>
            </div>
        </form>
    </x-card>
</x-owner-layout>
