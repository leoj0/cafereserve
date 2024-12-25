<x-layout>
  <x-horizontal-card>
    <div class="container">
      <h1 class="text-xl font-bold mb-4">Pending Cafes</h1>
      <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
          <tr>
            <th class="border border-gray-300 px-4 py-2">Cafe Name</th>
            <th class="border border-gray-300 px-4 py-2">Location</th>
            <th class="border border-gray-300 px-4 py-2">Tags</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cafes as $cafe)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $cafe->cafe_name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $cafe->location }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $cafe->cafe_tags }}</td>
            <td class="border border-gray-300 px-4 py-2">
              <form action="{{ route('admin.updateStatus', $cafe->cafe_id) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <button type="submit" name="status" value="Approved"
                  class="px-4 py-2 bg-green-500 text-white rounded">Approve</button>
                <button type="submit" name="status" value="Denied"
                  class="px-4 py-2 bg-red-500 text-white rounded">Deny</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </x-horizontal-card>
</x-layout>