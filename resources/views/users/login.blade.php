<x-layout>
  <x-card>
    <h2 class="form-title">Login</h2>
    <form method="POST" action="/users/authenticate">
      @csrf
      <div>
        <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-input">
        @error('email')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="Password" class="form-input">
        @error('password')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>
      <div>
        <button type="submit" class="form-button">
          Sign In
        </button>
      </div>
    </form>
    <div class="mt-12 text-center">
      <p class="text-sm">
        Don't have an account?
        <a href="{{ route('register.form') }}" class="form-link">
          Register now
        </a>
      </p>
    </div>
  </x-card>
</x-layout>