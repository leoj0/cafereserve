<x-owner-layout>
  <x-card>
    <h2 class="title-form">Cafe Submission Form</h2>

    <form method="POST" action="/cafe_listings" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="cafe_name" class="block text-lg font-medium text-gray-700">Cafe Name</label>
        <input type="text" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="cafe_name" name="cafe_name" value="{{ old('cafe_name') }}">
        @error('cafe_name')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="phone_number" class="block text-lg font-medium text-gray-700">Phone Number</label>
        <input type="text" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
        @error('phone_number')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="cafe_tags" class="block text-lg font-medium text-gray-700">Cafe Tags (Comma Separated)</label>
        <input type="text" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="cafe_tags" name="cafe_tags" value="{{ old('cafe_tags') }}">
        @error('cafe_tags')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="location" class="block text-lg font-medium text-gray-700">Location</label>
        <input type="text" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="location" name="location" value="{{ old('location') }}">
        @error('location')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
        <input type="email" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="email" name="email" value="{{ old('email') }}">
        @error('email')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="website" class="block text-lg font-medium text-gray-700">Website</label>
        <input type="url" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="website" name="website" value="{{ old('website') }}">
        @error('website')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="logo" class="block text-lg font-medium text-gray-700">Cafe Logo</label>
        <input class="p-2 w-full" type="file" id="logo" name="logo">
        @error('logo')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
        <textarea class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        @error('description')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <!-- Operating Hours -->
      <div class="form-group">
        <label for="opening_time" class="block text-lg font-medium text-gray-700">Opening Time</label>
        <input type="text" id="opening_time" name="opening_time" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" value="{{ old('opening_time') }}">
        @error('opening_time')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="closing_time" class="block text-lg font-medium text-gray-700">Closing Time</label>
        <input type="text" id="closing_time" name="closing_time" class="form-control mt-2 block w-full rounded-md border-2 border-gray-400 shadow-sm text-lg p-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" value="{{ old('closing_time') }}">
        @error('closing_time')
        <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>

  </x-card>
</x-owner-layout>
