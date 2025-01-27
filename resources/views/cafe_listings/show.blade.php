<x-layout>
    <x-horizontal-card class="bg-white">
        <div class="flex flex-col md:flex-row items-start gap-8">
            <!-- Cafe Logo with subtle border and hover effect -->
            <div class="w-full md:w-64 h-64 flex-shrink-0 group">
                <img class="w-full h-full object-cover rounded-lg shadow-lg border border-gray-300 transition-transform duration-300 group-hover:scale-[1.02]"
                    src="{{ $cafe->logo ? asset('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg') }}"
                    alt="{{ $cafe->cafe_name }}">
            </div>

            <!-- Cafe Details with darker text -->
            <div class="flex-grow">
                <div class="flex justify-between items-start">
                    <h1 class="text-4xl md:text-5xl mb-4 text-gray-900 font-light tracking-tight">
                        {{ $cafe->cafe_name }}
                    </h1>
                </div>

                <div class="mb-6">
                    <x-owner-cafe-tags :tagsCsv="$cafe->cafe_tags"></x-owner-cafe-tags>
                </div>

                <p class="text-gray-700 mb-8 text-justify leading-relaxed">
                    {{ $cafe->description }}
                </p>

                <!-- Contact Information with darker accents -->
                <div class="space-y-4 text-gray-700">
                    <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                        <i class="fa fa-phone w-5 text-gray-600"></i>
                        <span class="ml-3 font-medium">{{ $cafe->phone_number }}</span>
                    </div>

                    <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                        <i class="fa fa-envelope w-5 text-gray-600"></i>
                        <span class="ml-3 font-medium">{{ $cafe->email }}</span>
                    </div>

                    <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                        <i class="fas fa-location-dot w-5 text-gray-600"></i>
                        <span class="ml-3 font-medium">{{ $cafe->location }}</span>
                    </div>

                    <div class="flex items-center p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition-all duration-300 border border-gray-200">
                        <i class="fa fa-clock w-5 text-gray-600"></i>
                        <span class="ml-3 font-medium">Open: {{ $cafe->opening_time }} - {{ $cafe->closing_time }}</span>
                    </div>
                </div>

                <!-- Action Buttons with dark-themed styling -->
                <div class="mt-8 flex flex-wrap gap-4">
                    <form action="{{ route('reservations.selectTablesPage', ['cafe' => $cafe->cafe_id]) }}" method="GET"
                        class="flex-grow sm:flex-grow-0">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-4 w-full bg-blue-600 text-white py-2 px-4 rounded-lg inline-flex items-center justify-center hover:bg-blue-700 transition-all duration-300 ease-in-out hover:translate-y-[-2px]">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Make a Reservation
                        </button>
                    </form>

                    <form action="{{ route('feedback.create', ['cafe' => $cafe->cafe_id]) }}" method="GET"
                        class="flex-grow sm:flex-grow-0">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-4 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-500 transition-all duration-300 ease-in-out flex items-center justify-center hover:translate-y-[-2px]">
                            <i class="fas fa-comment mr-2"></i>
                            Give Feedback
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Divider -->
        <div class="border-t border-gray-300 my-12"></div>

        <!-- Content Sections with lighter hover effects -->
        <div class="space-y-8">
            <div class="bg-white rounded-lg p-8 hover:bg-gray-50 transition-all duration-300 border border-gray-300 shadow-sm">
                <h2 class="text-2xl font-light text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-utensils mr-3 text-gray-700"></i>Menu
                </h2>
                @include('partials._menus', ['cafe' => $cafe])
            </div>

            <div class="bg-white rounded-lg p-8 hover:bg-gray-50 transition-all duration-300 border border-gray-300 shadow-sm">
                <h2 class="text-2xl font-light text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-chair mr-3 text-gray-700"></i>Available Tables
                </h2>
                @include('partials._tables', ['cafe' => $cafe])
            </div>

            <div class="bg-white rounded-lg p-8 hover:bg-gray-50 transition-all duration-300 border border-gray-300 shadow-sm">
                <h2 class="text-2xl font-light text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-gift mr-3 text-gray-700"></i>Rewards Program
                </h2>
                @include('partials._rewards', ['rewards' => $cafe->rewards])
            </div>

            <div class="bg-white rounded-lg p-8 hover:bg-gray-50 transition-all duration-300 border border-gray-300 shadow-sm">
                <h2 class="text-2xl font-light text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-comments mr-3 text-gray-700"></i>Customer Feedback
                </h2>
                @include('partials._feedbacks', ['feedbacks' => $cafe->feedbacks])
            </div>
        </div>
    </x-horizontal-card>
</x-layout>
