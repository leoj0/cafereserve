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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-8">
            <!-- Today's Reservations -->
            <div class="bg-gray-800 rounded-lg p-8">
                <div class="flex items-center justify-between">
                    <div class="text-emerald-500">
                        <i class="fas fa-calendar-day text-3xl"></i>
                    </div>
                    <span class="bg-emerald-500/10 text-emerald-500 text-sm py-1 px-3 rounded-full">Today</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-100 mt-4">{{$reservationsToday}}</h3>
                <p class="text-gray-400">Today's Reservations</p>
            </div>
        
            <!-- Claimed Rewards -->
            <div class="bg-gray-800 rounded-lg p-8">
                <div class="flex items-center justify-between">
                    <div class="text-yellow-500">
                        <i class="fas fa-gift text-3xl"></i>
                    </div>
                    <span class="bg-yellow-500/10 text-yellow-500 text-sm py-1 px-3 rounded-full">Claimed</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-100 mt-4">{{ $claimedRewardCount }}</h3>
                <p class="text-gray-400">Total Rewards Claimed</p>
            </div>
        
            <!-- New Reviews -->
            <div class="bg-gray-800 rounded-lg p-8">
                <div class="flex items-center justify-between">
                    <div class="text-purple-500">
                        <i class="fas fa-star text-3xl"></i>
                    </div>
                    <span class="bg-purple-500/10 text-purple-500 text-sm py-1 px-3 rounded-full">New</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-100 mt-4">{{ $newReviews }}</h3>
                <p class="text-gray-400">New Reviews</p>
            </div>
        
            <!-- Active Members -->
            <div class="bg-gray-800 rounded-lg p-8">
                <div class="flex items-center justify-between">
                    <div class="text-orange-500">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <span class="bg-orange-500/10 text-orange-500 text-sm py-1 px-3 rounded-full">Active</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-100 mt-4">{{ $activeMembers }}</h3>
                <p class="text-gray-400">Reward Members</p>
            </div>
        </div>

        {{-- <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Manage Reservations -->
            <a href="{{ route('reservations.manage' , $cafe->cafe_id) }}"
                class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer">
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
            </a>

            <!-- Menu Items -->
            <a href="{{ route('menus.manage' , $cafe->cafe_id) }}"
                class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer">
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
            </a>

            <!-- Table Layout -->
            <a href="{{ route('tables.manage'  , $cafe->cafe_id) }}"
                class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition duration-300 cursor-pointer">
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
            </a>
        </div> --}}

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
                    <p class="text-gray-400">Handle bookings efficiently with our smart reservation system.
                        Track,
                        modify,
                        and manage all your reservations in real-time.</p>
                </div>

                <!-- Menu Management -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-utensils text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500  font-semibold mb-2">Menu Management</h3>
                    <p class="text-gray-400">Update your menu items, prices, and categories easily. Showcase
                        your
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
                    <p class="text-gray-400">Create and manage loyalty programs. Keep your customers coming back
                        with
                        exciting rewards.</p>
                </div>

                <!-- Customer Feedback -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-comments text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Customer Feedback</h3>
                    <p class="text-gray-400">Collect and respond to customer reviews. Improve your service based
                        on
                        real
                        feedback.</p>
                </div>

                <!-- Event Management -->
                <div class="bg-gray-800 p-6 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="text-emerald-500 mb-4">
                        <i class="fas fa-calendar-day text-2xl"></i>
                    </div>
                    <h3 class="text-xl text-emerald-500 font-semibold mb-2">Event Management</h3>
                    <p class="text-gray-400">Plan and promote special events. Manage bookings for private
                        parties
                        and
                        special occasions.</p>
                </div>
            </div>
        </div>
        </x-horizontal>
</x-owner-layout>