<x-layout>
  <x-card>
    <h2 class="form-title">Edit User Information</h2>
    <form method="POST" action="/users/{{ $user->user_id }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="role" class="form-label">User Role</label>
        <select name="role" id="role" class="form-select">
          <option value="Owner" {{ $user->role == 'Owner' ? 'selected' : '' }}>Owner</option>
          <option value="Customer" {{ $user->role == 'Customer' ? 'selected' : '' }}>Customer</option>
        </select>
      </div>

      <div class="form-group">
        <label for="name" class="form-label">Username</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-input">
        @error('name')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input">
        @error('email')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="user_tags" class="form-label">Tags</label>
        <input type="text" id="user_tags" name="user_tags" value="{{ old('user_tags', $user->user_tags) }}" class="form-input">
        @error('user_tags')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="form-button">Update</button>
    </form>
  </x-card>
</x-layout>