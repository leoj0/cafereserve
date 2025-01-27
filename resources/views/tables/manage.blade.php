<x-owner-layout>
    <x-horizontal-card class="p-6">
        <h2 class="page_title">Manage Tables</h2>

        @if($tables->isEmpty())
            <div>
                <div class="mt-8">
                    <a href="{{ route('tables.create', $cafe->cafe_id) }}" class="link-button">
                        Add Table
                    </a>
                </div>
            </div>
        @else
            <div class="mt-8">
                <a href="{{ route('tables.create', $cafe->cafe_id) }}" class="link-button">
                    Add Table
                </a>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-700 mt-8">
                <table class="w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">
                                Table Number
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">
                                Seating Capacity
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-lg font-semibold text-gray-100">
                                Position
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-lg font-semibold text-gray-100">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach($tables as $table)
                            <tr class="hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-6 py-4 text-gray-200 font-medium">
                                    {{ $table->table_number }}
                                </td>
                                <td class="px-6 py-4 text-gray-200 font-medium">
                                    {{ $table->seating_capacity }}
                                </td>
                                <td class="px-6 py-4 text-gray-200 font-medium">
                                    {{ $table->position ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center space-x-6">
                                        <!-- Edit Button -->
                                        <a href="{{ route('tables.edit', [$cafe->cafe_id, $table->table_id]) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white w-10 h-10 flex items-center justify-center rounded-full transition-colors duration-200">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('tables.destroy', [$cafe->cafe_id, $table->table_id]) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this table?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white w-10 h-10 flex items-center justify-center rounded-full transition-colors duration-200">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </x-horizontal-card>
</x-owner-layout>
