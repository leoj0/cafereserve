<x-layout>
  <x-card>
    <h2 class="form-title">Register</h2>
    <form method="POST" action="{{ route('register.store') }}">
      @csrf

      <div class="form-grid">
        <div>
          <select name="role" id="role" class="form-select">
            <option value="" disabled selected>Select Role</option>
            <option value="Owner" {{ old('role')=='Owner' ? 'selected' : '' }}>Owner</option>
            <option value="Customer" {{ old('role')=='Customer' ? 'selected' : '' }}>Customer</option>
          </select>
          @error('role')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}" class="form-input">
          @error('name')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-input">
      @error('email')
      <div class="form-error">{{ $message }}</div>
      @enderror

      <div class="form-grid">
        <div>
          <input type="password" id="password" name="password" placeholder="Password" class="form-input">
          @error('password')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
            class="form-input">
          @error('password_confirmation')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <input type="text" id="user_tags" name="user_tags" placeholder="Tags (comma-separated)"
        value="{{ old('user_tags') }}" class="form-input">
      @error('user_tags')
      <div class="form-error">{{ $message }}</div>
      @enderror

      <button type="submit" class="form-button mt-4">
        Sign Up
      </button>
    </form>
    <div class="mt-12 text-center">
      <p class="text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="form-link">
          Login here
        </a>
      </p>
    </div>
  </x-card>
</x-layout>