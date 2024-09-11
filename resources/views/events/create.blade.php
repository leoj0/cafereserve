<x-layout>
  <x-horizontal-card>
      <div class="container mx-auto mt-8">
          <h1 class="text-3xl font-bold mb-6">Create Event</h1>

          <form action="{{ route('events.store') }}" method="POST">
              @csrf

              <div class="mb-4">
                  <label for="title" class="block text-lg font-medium">Event Title</label>
                  <input type="text" name="title" id="title" class="mt-2 block w-full border rounded p-2" required>
              </div>

              <div class="mb-4">
                  <label for="description" class="block text-lg font-medium">Event Description</label>
                  <textarea name="description" id="description" rows="4" class="mt-2 block w-full border rounded p-2" required></textarea>
              </div>

              <div class="mb-4">
                  <label for="event_date" class="block text-lg font-medium">Event Date</label>
                  <input type="date" name="event_date" id="event_date" class="mt-2 block w-full border rounded p-2" required>
              </div>

              <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Create Event</button>
          </form>
      </div>
  </x-horizontal-card>
</x-layout>
