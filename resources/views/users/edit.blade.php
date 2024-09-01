<x-layout>
  <x-card>
    <h2 class="title-form">Edit User Information</h2>
    <form method="POST" action="/users/{{$user->user_id}}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="role">User Role</label>
        <select name="role" id="role" class="form-control">
          <option value="Owner" {{ $user->role == 'Owner' ? 'selected' : '' }}>Owner</option>
          <option value="Customer" {{ $user->role == 'Customer' ? 'selected' : '' }}>Customer</option>
        </select>
      </div>

      <div class="form-group">
        <label for="name">Username</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$user->name) }}">
        @error('name')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email',$user->email) }}">
        @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group mb-4">
        <label for="user_tags">Tags</label>
        <input type="text" class="form-control" id="user_tags" name="user_tags" value="{{ old('user_tags',  $user->user_tags) }}">
        @error('user_tags')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
  </x-card>
</x-layout>