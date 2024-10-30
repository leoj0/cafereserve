    @if($cafe->tables->isEmpty())
    <div class="text-center">
        <p class="text-gray-300">No tables available.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($cafe->tables as $table)
        <div class="bg-gray-700 rounded-xl shadow-sm p-4">
            <h3 class="text-xl font-semibold text-white mb-2">Table {{ $table->table_number }}</h3>
            <p class="text-lg text-gray-300">Seating Capacity: {{ $table->seating_capacity }}</p>
            <p class="text-sm text-gray-400">Position: {{ $table->position }}</p>
        </div>
        @endforeach
    </div>
    @endif
  