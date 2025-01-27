<x-owner-layout>
  <x-card>
    <h2 class="form-title">Cafe Submission Form</h2>

    <form method="POST" action="/cafe_listings" enctype="multipart/form-data">
      @csrf

      <div class="form-grid">
        <div>
          <input type="text" id="cafe_name" name="cafe_name" placeholder="Cafe Name" value="{{ old('cafe_name') }}" class="form-input">
          @error('cafe_name')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" class="form-input">
          @error('phone_number')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <input type="text" id="cafe_tags" name="cafe_tags" placeholder="Cafe Tags (Comma Separated)" value="{{ old('cafe_tags') }}" class="form-input">
      @error('cafe_tags')
      <div class="form-error">{{ $message }}</div>
      @enderror

      <input type="text" id="location" name="location" placeholder="Location" value="{{ old('location') }}" class="form-input">
      @error('location')
      <div class="form-error">{{ $message }}</div>
      @enderror

      <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-input">
      @error('email')
      <div class="form-error">{{ $message }}</div>
      @enderror

      <div>
        <label for="logo" class="block text-lg font-medium text-gray-700 mb-2">Cafe Logo</label>
        <input type="file" id="logo" name="logo" class="form-input">
        @error('logo')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <textarea id="description" name="description" rows="3" placeholder="Description" class="form-input">{{ old('description') }}</textarea>
      @error('description')
      <div class="form-error">{{ $message }}</div>
      @enderror

      <div class="form-grid">
        <div>
          <input type="time" id="opening_time" name="opening_time" placeholder="Opening Time" step="3600" value="{{ old('opening_time') }}" class="form-input">
          @error('opening_time')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <input type="time" id="closing_time" name="closing_time" placeholder="Closing Time" step="3600" value="{{ old('closing_time') }}" class="form-input">
          @error('closing_time')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <button type="submit" class="form-button">Submit</button>
    </form>
  </x-card>
</x-owner-layout>