<x-owner-layout>
  <x-card>
      <h2 class="form-title">Create Event for {{ $cafe->cafe_name }}</h2>

      <form action="{{ route('events.store', $cafe->cafe_id) }}" method="POST">
          @csrf

              <div>
                  <input type="text" name="event_name" id="event_name" placeholder="Event Name" value="{{ old('event_name') }}" class="form-input" required>
                  @error('event_name')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
              </div>

              <div>
                  <textarea name="event_description" id="event_description" rows="4" placeholder="Event Description" class="form-input" required>{{ old('event_description') }}</textarea>
                  @error('event_description')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
              </div>

              <div>
                  <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}" class="form-input" required>
                  @error('event_date')
                  <div class="form-error">{{ $message }}</div>
                  @enderror
              </div>

          <button type="submit" class="form-button">Create Event</button>
      </form>
  </x-card>
</x-owner-layout>
