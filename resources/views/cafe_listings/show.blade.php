<x-layout>
    <x-horizontal-card>
        <div class="flex flex-col md:flex-row items-start gap-8">
            <!-- Cafe Logo -->
            <div class="w-full md:w-64 h-64 flex-shrink-0">
                <img class="w-full h-full object-cover rounded-lg shadow-md"
                    src="{{ $cafe->logo ? asset('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg') }}"
                    alt="{{ $cafe->cafe_name }}">
            </div>

            <!-- Cafe Details -->
            <div class="flex-grow">
                <div class="flex justify-between items-start">
                    <h1 class="text-4xl md:text-5xl font-light text-gray-800 mb-4">
                        {{ $cafe->cafe_name }}
                    </h1>
                </div>

                <div class="mb-4">
                    <x-owner-cafe-tags :tagsCsv="$cafe->cafe_tags"></x-owner-cafe-tags>
                </div>

                <p class="text-gray-600 mb-6 text-justify">
                    {{ $cafe->description }}
                </p>

                <div class="space-y-2 text-gray-600">
                    <div class="flex items-center">
                        <i class="fa fa-phone w-5 text-gray-400"></i>
                        <span>{{ $cafe->phone_number }}</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fa fa-envelope w-5 text-gray-400"></i>
                        <span>{{ $cafe->email }}</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-location-dot w-5 text-gray-400"></i>
                        <span>{{ $cafe->location }}</span>
                    </div>

                    <div class="flex items-center">
                        <i class="fa fa-clock w-5 text-gray-400"></i>
                        <span>Open: {{ $cafe->opening_time }} - {{ $cafe->closing_time }}</span>
                    </div>
                </div>

                <!-- Make a Reservation Button -->
                <div class="mt-6 flex gap-4">
                    <form action="{{ route('reservations.selectTablesPage', ['cafe' => $cafe->cafe_id]) }}" method="GET"
                        class="inline-block">
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 ease-in-out">
                            Make a Reservation
                        </button>
                    </form>

                    <!-- Feedback Button -->
                    <form action="{{ route('feedback.create', ['cafe' => $cafe->cafe_id]) }}" method="GET"
                        class="inline-block">
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300 ease-in-out">
                            Give Feedback
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menus Section -->
        <div class="mt-12 bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-300 pb-2">Menus</h2>
            @if($cafe->menus->isEmpty())
            <div class="text-center">
                <p class="text-gray-600">No menu items available.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($cafe->menus as $menu)
                <a href="{{ route('menus.show', ['cafe' => $cafe->cafe_id, 'menu' => $menu->menu_id]) }}"
                    class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 ease-in-out hover:no-underline">
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                        <img class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300 ease-in-out"
                            src="{{ $menu->item_image ? asset('storage/' . $menu->item_image) : asset('storage/images/default_image.jpg') }}"
                            alt="{{ $menu->item_name }}">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $menu->item_name }}</h3>
                        <p class="text-lg font-medium text-blue-600">RM {{ number_format($menu->price, 2) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Tables Section -->
        <div class="mt-12 bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-300 pb-2">Tables</h2>
            @if($cafe->tables->isEmpty())
            <div class="text-center">
                <p class="text-gray-600">No tables available.</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($cafe->tables as $table)
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Table {{ $table->table_number }}</h3>
                    <p class="text-lg text-gray-600">Seating Capacity: {{ $table->seating_capacity }}</p>
                    <p class="text-sm text-gray-500">Position: {{ $table->position }}</p>
                    </p>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        @include('partials._feedbacks', ['feedbacks' => $cafe->feedbacks])
    </x-horizontal-card>
</x-layout>