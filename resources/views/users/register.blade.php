<x-layout>
  <x-card>
    
    <h2 class="title-form">Register</h2>
    <form method="POST" action="{{ route('register.store') }}">
      @csrf

      <div class="form-group">
        <label for="role">User Role</label>
        <select name="role" id="role" class="form-control" value="{{ old('role')}}">
          <option value="Owner" {{ old('role')=='Owner' ? 'selected' : '' }}>Owner</option>
          <option value="Customer" {{ old('role')=='Customer' ? 'selected' : '' }}>Customer</option>
        </select>
      </div>

      <div class="form-group">
        <label for="name">Username</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        @error('name')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        @error('email')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        @error('password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
          value="{{ old('password_confirmation') }}">
        @error('password_confirmation')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form group mb-4">
        <label for="user_tags">Tags</label>
        <input type="text" class="form-control" id="user_tags" name="user_tags" value="{{ old('user_tags')}}">
        @error('user_tags')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
    </form>

  </x-card>
</x-layout>
