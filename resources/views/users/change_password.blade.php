<x-layout>
  <x-card>
    <h2 class="form-title">Change Password</h2>
    <form method="POST" action="{{ route('password.update', ['user' => auth()->user()->user_id]) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="current_password" class="form-label">Current Password</label>
        <input 
          type="password" 
          class="form-input" 
          id="current_password" 
          name="current_password" 
          required
        >
        @error('current_password')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password" class="form-label">New Password</label>
        <input 
          type="password" 
          class="form-input" 
          id="password" 
          name="password" 
          required
        >
        @error('password')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input 
          type="password" 
          class="form-input" 
          id="password_confirmation" 
          name="password_confirmation" 
          required
        >
        @error('password_confirmation')
        <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <button 
        type="submit" 
        class="form-button"
      >
        Update Password
      </button>
    </form>
  </x-card>
</x-layout>
