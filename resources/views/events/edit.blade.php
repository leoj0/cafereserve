<x-owner-layout>
    <x-card>
      <h2 class="form-title">Edit Event for {{ $event->cafe->cafe_name }}</h2>
  
      <form action="{{ route('events.update', $event->event_id) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="mb-4">
          <label for="event_name" class="block text-lg font-medium">Event Name</label>
          <input type="text" name="event_name" id="event_name" placeholder="Event Name" value="{{ old('event_name', $event->event_name) }}" class="form-input" required>
          @error('event_name')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
  
        <div class="mb-4">
          <label for="event_description" class="block text-lg font-medium">Event Description</label>
          <textarea name="event_description" id="event_description" rows="4" placeholder="Event Description" class="form-input" required>{{ old('event_description', $event->event_description) }}</textarea>
          @error('event_description')
          <div class="form-error">{{ $message }}</div>
          @enderror
        </div>
  
          <div>
            <label for="event_date" class="block text-lg font-medium">Event Date</label>
            <input type="date" name="event_date" id="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" class="form-input" required>
            @error('event_date')
            <div class="form-error">{{ $message }}</div>
            @enderror
          </div>
  
        <button type="submit" class="form-button bg-indigo-600 text-white hover:bg-indigo-700">Update Event</button>
      </form>
    </x-card>
  </x-owner-layout>
  