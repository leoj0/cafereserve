<x-owner-layout>
  <div class="ml-5 mt-5 mb-5 mr-5">
      <!-- Add Table Button -->
      <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-semibold mb-4">Manage Tables</h2>
          <a href="{{ route('tables.create', $cafe->cafe_id) }}" class="btn btn-primary bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
              + Add Table
          </a>
      </div>

      @if($tables->isEmpty())
          <p>No tables available. <a href="{{ route('tables.create', $cafe->cafe_id) }}" class="text-blue-500">Add a new table</a>.</p>
      @else
          <table class="min-w-full bg-white border border-gray-200">
              <thead>
                  <tr>
                      <th class="py-3 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Table Number</th>
                      <th class="py-3 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Seating Capacity</th>
                      <th class="py-3 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Position</th>
                      <th class="py-3 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                      <th class="py-3 px-6 bg-gray-200 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($tables as $table)
                      <tr class="border-b">
                          <td class="py-4 px-6">{{ $table->table_number }}</td>
                          <td class="py-4 px-6">{{ $table->seating_capacity }}</td>
                          <td class="py-4 px-6">{{ $table->position ?? 'N/A' }}</td>
                          <td class="py-4 px-6">
                              <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-{{ $table->availability_status === 'Available' ? 'green' : 'red' }}-100 text-{{ $table->availability_status === 'Available' ? 'green' : 'red' }}-800">
                                  {{ ucfirst($table->availability_status) }}
                              </span>
                          </td>
                          <td class="py-4 px-6 flex space-x-2">
                              <a href="{{ route('tables.edit', [$cafe->cafe_id, $table->table_id]) }}" class="text-blue-500 hover:text-blue-700">
                                  <i class="fas fa-pencil-alt"></i>
                              </a>
                              <form action="{{ route('tables.destroy', [$cafe->cafe_id, $table->table_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this table?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="text-red-500 hover:text-red-700">
                                      <i class="fas fa-trash-alt"></i>
                                  </button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      @endif
  </div>
</x-owner-layout>
