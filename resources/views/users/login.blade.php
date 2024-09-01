<x-layout>
  <x-card>
    <h2 class="title-form">Login</h2>
    <form method="POST" action="/users/authenticate">
      @csrf
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
      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </form>
  </x-card>
</x-layout>