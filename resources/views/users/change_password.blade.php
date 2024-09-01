<x-layout>
  <x-card>
    <h2 class="title-form">Change Password</h2>
    <form method="POST" action="{{ route('password.update', ['user' => auth()->user()->user_id]) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
        @error('current_password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm New Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary btn-block">Update Password</button>
    </form>
  </x-card>
</x-layout>
