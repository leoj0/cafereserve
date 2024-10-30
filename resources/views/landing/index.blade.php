@auth
@if(auth()->user()->role === 'Owner')
<x-owner-layout>
    <!-- Welcome Section -->
    <div class="bg-gray-800 p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-100">Welcome back!</h1>
            </div>
            <div class="flex space-x-4">
                <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> New Reservation
                </button>
                <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-cog mr-2"></i> Settings
                </button>
            </div>
        </div>
    </div>

    <x-horizontal-card>
        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Today's Reservations -->
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-emerald-500">
                        <i class="fas fa-calendar-day text-2xl"></i>
                    </div>
                    <span class="bg-emerald-500/10 text-emerald-500 text-sm py-1 px-3 rounded-full">Today</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-100 mt-4">24</h3>
                <p class="text-gray-400">Today's Reservations</p>
            </div>

            <!-- Available Tables -->
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-blue-500">
                        <i class="fas fa-chair text-2xl"></i>
                    </div>
                    <span class="bg-blue-500/10 text-blue-500 text-sm py-1 px-3 rounded-full">Available</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-100 mt-4">8/15</h3>
                <p class="text-gray-400">Available Tables</p>
            </div>

            <!-- New Reviews -->
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-purple-500">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <span class="bg-purple-500/10 text-purple-500 text-sm py-1 px-3 rounded-full">New</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-100 mt-4">12</h3>
                <p class="text-gray-400">New Reviews</p>
            </div>

            <!-- Active Members -->
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-orange-500">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <span class="bg-orange-500/10 text-orange-500 text-sm py-1 px-3 rounded-full">Active</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-100 mt-4">847</h3>
                <p class="text-gray-400">Reward Members</p>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Manage Reservations -->
            <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="bg-emerald-500/10 p-3 rounded-lg">
                        <i class="fas fa-calendar-alt text-emerald-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-100">Manage Reservations</h3>
                        <p class="text-sm text-gray-400">View and update bookings</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-emerald-500">
                    <span class="text-sm">View all</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-500/10 p-3 rounded-lg">
                        <i class="fas fa-utensils text-blue-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-100">Menu Items</h3>
                        <p class="text-sm text-gray-400">Update menu and prices</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-blue-500">
                    <span class="text-sm">Manage menu</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>

            <!-- Table Layout -->
            <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="bg-purple-500/10 p-3 rounded-lg">
                        <i class="fas fa-border-all text-purple-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-100">Table Layout</h3>
                        <p class="text-sm text-gray-400">Manage seating arrangement</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-purple-500">
                    <span class="text-sm">Edit layout</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Upcoming Events -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-100">Recent Activity</h3>
                    <button class="text-gray-400 hover:text-gray-300">View all</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="bg-emerald-500/10 p-2 rounded-full">
                            <i class="fas fa-check text-emerald-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-100">New reservation confirmed</p>
                            <p class="text-sm text-gray-400">Table 7 • Today, 7:00 PM</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-500/10 p-2 rounded-full">
                            <i class="fas fa-star text-blue-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-100">New review received</p>
                            <p class="text-sm text-gray-400">4.5 stars • 15 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-500/10 p-2 rounded-full">
                            <i class="fas fa-utensils text-purple-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-100">Menu item updated</p>
                            <p class="text-sm text-gray-400">Price changed • 1 hour ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-gray-800 rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-100">Upcoming Events</h3>
                    <button class="text-gray-400 hover:text-gray-300">View all</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="bg-orange-500/10 p-2 rounded-full">
                            <i class="fas fa-calendar text-orange-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-100">Live Jazz Night</p>
                            <p class="text-sm text-gray-400">Tomorrow, 8:00 PM</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-pink-500/10 p-2 rounded-full">
                            <i class="fas fa-glass-cheers text-pink-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-100">Wine Tasting Event</p>
                            <p class="text-sm text-gray-400">Saturday, 6:00 PM</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-500/10 p-2 rounded-full">
                            <i class="fas fa-birthday-cake text-yellow-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-100">Private Birthday Party</p>
                            <p class="text-sm text-gray-400">Sunday, 3:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features Grid -->
        <div id="features" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold text-center mb-12">Everything You Need to Manage Your Cafe</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Reservations -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Reservation Management</h3>
                    <p class="text-gray-400">Handle bookings efficiently with our smart reservation system. Track,
                        modify,
                        and manage all your reservations in real-time.</p>
                </div>

                <!-- Menu Management -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-utensils text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500  font-semibold mb-2">Menu Management</h3>
                    <p class="text-gray-400">Update your menu items, prices, and categories easily. Showcase your
                        specials
                        and seasonal offerings.</p>
                </div>

                <!-- Table Management -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-chair text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Table Management</h3>
                    <p class="text-gray-400">Optimize your seating arrangements. Monitor table status and manage
                        capacity in
                        real-time.</p>
                </div>

                <!-- Rewards Program -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-gift text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Rewards Program</h3>
                    <p class="text-gray-400">Create and manage loyalty programs. Keep your customers coming back with
                        exciting rewards.</p>
                </div>

                <!-- Customer Feedback -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-comments text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Customer Feedback</h3>
                    <p class="text-gray-400">Collect and respond to customer reviews. Improve your service based on real
                        feedback.</p>
                </div>

                <!-- Event Management -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-calendar-day text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Event Management</h3>
                    <p class="text-gray-400">Plan and promote special events. Manage bookings for private parties and
                        special occasions.</p>
                </div>
            </div>
        </div>
    </x-horizontal>
</x-owner-layout>
@else
<x-layout>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-gray-900 to-gray-800">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('storage/images/cafe-bg.jpg') }}" alt="Cafe Background"
                class="w-full h-full object-cover opacity-30 brightness-50">
        </div>
        <div class="relative container mx-auto text-center text-white z-10">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">Reserve Your <br>Perfect Moment</h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300">Find and book the best cafes in your area</p>
            <a href="{{ route('reservations.search') }}"
                class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-emerald-700 transition duration-300 ease-in-out transform hover:scale-105">
                Make a Reservation
            </a>
        </div>
    </section>

    <!-- Featured Cafes Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-white">Recommended for You</h2>
            <p class="text-gray-400 text-center mb-12">Discover our handpicked selection of fantastic cafes</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($cafes as $cafe)
                <div
                    class="group relative overflow-hidden rounded-2xl bg-gray-800 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/10">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ $cafe->logo ? asset('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg') }}"
                            alt="{{ $cafe->cafe_name }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent">
                        <div class="absolute bottom-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $cafe->cafe_name }}</h3>
                            <p class="text-emerald-400 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $cafe->location }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-white">How It Works</h2>
            <p class="text-gray-400 text-center mb-12">Three simple steps to your perfect cafe experience</p>

            <div class="flex flex-col md:flex-row justify-center items-center md:items-stretch gap-8">
                <div class="flex-1 text-center p-8 bg-gray-900 rounded-xl shadow-lg max-w-sm border border-gray-700">
                    <div
                        class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        1</div>
                    <h3 class="text-xl font-bold mb-4 text-white">Browse Cafes</h3>
                    <p class="text-gray-400">Explore our curated selection of the finest cafes in your area</p>
                </div>
                <div class="flex-1 text-center p-8 bg-gray-900 rounded-xl shadow-lg max-w-sm border border-gray-700">
                    <div
                        class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        2</div>
                    <h3 class="text-xl font-bold mb-4 text-white">Choose Your Spot</h3>
                    <p class="text-gray-400">Select your preferred time and table for the perfect setting</p>
                </div>
                <div class="flex-1 text-center p-8 bg-gray-900 rounded-xl shadow-lg max-w-sm border border-gray-700">
                    <div
                        class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        3</div>
                    <h3 class="text-xl font-bold mb-4 text-white">Enjoy Your Visit</h3>
                    <p class="text-gray-400">Show up and experience the ambiance you've been looking forward to</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-white">What Our Customers Say</h2>
            <p class="text-gray-400 text-center mb-12">Real experiences from coffee lovers like you</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($feedbacks as $feedback)
                <div class="bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-700">
                    <div class="flex items-center mb-6">
                        <div class="h-14 w-14 rounded-full overflow-hidden mr-4">
                            <img src="{{ $feedback->user->avatar ?? '/default-avatar.png' }}"
                                alt="{{ $feedback->user->name }}'s avatar" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white">{{ $feedback->user->name }}</h4>
                            <p class="text-emerald-400">{{ $feedback->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-lg italic">"{{ $feedback->comments }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Find Your Perfect Cafe?</h2>
            <p class="text-xl mb-8 text-gray-300">Join thousands of coffee lovers who've found their ideal spot</p>
            <a href="{{ route('reservations.search') }}"
                class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-emerald-700 transition duration-300 ease-in-out transform hover:scale-105">
                Start Exploring Now
            </a>
        </div>
    </section>
</x-layout>
@endif
@else
<x-layout>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-gray-900 to-gray-800">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('storage/images/cafe-bg.jpg') }}" alt="Cafe Background"
                class="w-full h-full object-cover opacity-30 brightness-50">
        </div>
        <div class="relative container mx-auto text-center text-white z-10">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">Reserve Your <br>Perfect Moment</h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300">Find and book the best cafes in your area</p>
            <a href="{{ route('reservations.search') }}"
                class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-emerald-700 transition duration-300 ease-in-out transform hover:scale-105">
                Make a Reservation
            </a>
        </div>
    </section>

    <!-- Featured Cafes Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-white">Recommended for You</h2>
            <p class="text-gray-400 text-center mb-12">Discover our handpicked selection of fantastic cafes</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($cafes as $cafe)
                <div
                    class="group relative overflow-hidden rounded-2xl bg-gray-800 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/10">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ $cafe->logo ? asset('storage/'.$cafe->logo) : asset('storage/images/default_image.jpg') }}"
                            alt="{{ $cafe->cafe_name }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent">
                        <div class="absolute bottom-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $cafe->cafe_name }}</h3>
                            <p class="text-emerald-400 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $cafe->location }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-white">How It Works</h2>
            <p class="text-gray-400 text-center mb-12">Three simple steps to your perfect cafe experience</p>

            <div class="flex flex-col md:flex-row justify-center items-center md:items-stretch gap-8">
                <div class="flex-1 text-center p-8 bg-gray-900 rounded-xl shadow-lg max-w-sm border border-gray-700">
                    <div
                        class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        1</div>
                    <h3 class="text-xl font-bold mb-4 text-white">Browse Cafes</h3>
                    <p class="text-gray-400">Explore our curated selection of the finest cafes in your area</p>
                </div>
                <div class="flex-1 text-center p-8 bg-gray-900 rounded-xl shadow-lg max-w-sm border border-gray-700">
                    <div
                        class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        2</div>
                    <h3 class="text-xl font-bold mb-4 text-white">Choose Your Spot</h3>
                    <p class="text-gray-400">Select your preferred time and table for the perfect setting</p>
                </div>
                <div class="flex-1 text-center p-8 bg-gray-900 rounded-xl shadow-lg max-w-sm border border-gray-700">
                    <div
                        class="w-16 h-16 bg-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        3</div>
                    <h3 class="text-xl font-bold mb-4 text-white">Enjoy Your Visit</h3>
                    <p class="text-gray-400">Show up and experience the ambiance you've been looking forward to</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-white">What Our Customers Say</h2>
            <p class="text-gray-400 text-center mb-12">Real experiences from coffee lovers like you</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($feedbacks as $feedback)
                <div class="bg-gray-800 rounded-xl p-8 shadow-lg border border-gray-700">
                    <div class="flex items-center mb-6">
                        <div class="h-14 w-14 rounded-full overflow-hidden mr-4">
                            <img src="{{ $feedback->user->avatar ?? '/default-avatar.png' }}"
                                alt="{{ $feedback->user->name }}'s avatar" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-white">{{ $feedback->user->name }}</h4>
                            <p class="text-emerald-400">{{ $feedback->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-lg italic">"{{ $feedback->comments }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Find Your Perfect Cafe?</h2>
            <p class="text-xl mb-8 text-gray-300">Join thousands of coffee lovers who've found their ideal spot</p>
            <a href="{{ route('reservations.search') }}"
                class="inline-block bg-emerald-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-emerald-700 transition duration-300 ease-in-out transform hover:scale-105">
                Start Exploring Now
            </a>
        </div>
    </section>
</x-layout>

@endauth