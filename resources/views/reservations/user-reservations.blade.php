<x-layout>
  <x-horizontal-card class="bg-gray-950 p-6">
          <h2 class="page_title">
              <i class="fas fa-history mr-3 text-blue-400"></i>
              Past Reservations
          </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($reservations as $reservation)
              <div class="group bg-gray-800 border border-gray-800 rounded-lg overflow-hidden hover:border-blue-500/50 hover:bg-gray-900 transition-all duration-300">
                  <div class="p-6">
                      <!-- Header with Cafe Name -->
                      <div class="flex items-center justify-between mb-6">
                          <h3 class="text-2xl font-semibold text-gray-100 group-hover:text-blue-400 transition-colors duration-300">
                              {{ $reservation->cafe ? $reservation->cafe->cafe_name : 'Cafe Not Found' }}
                          </h3>
                      </div>

                      <!-- Reservation Details -->
                      <div class="space-y-4">
                          <div class="flex items-center text-gray-300">
                              <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-800/80">
                                  <i class="fas fa-chair text-blue-400"></i>
                              </div>
                              <div>
                                  <p class="text-sm text-gray-400">Table Number</p>
                                  <p class="font-medium text-gray-200">
                                      {{ $reservation->table ? $reservation->table->table_number : 'Table Not Found' }}
                                  </p>
                              </div>
                          </div>

                          <div class="flex items-center text-gray-300">
                              <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-800/80">
                                  <i class="fas fa-calendar text-blue-400"></i>
                              </div>
                              <div>
                                  <p class="text-sm text-gray-400">Date</p>
                                  <p class="font-medium text-gray-200">{{ $reservation->reservation_date }}</p>
                              </div>
                          </div>

                          <div class="flex items-center text-gray-300">
                              <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gray-800/80">
                                  <i class="fas fa-clock text-blue-400"></i>
                              </div>
                              <div>
                                  <p class="text-sm text-gray-400">Time</p>
                                  <p class="font-medium text-gray-200">{{ $reservation->start_time }} - {{ $reservation->end_time }}</p>
                              </div>
                          </div>
                      </div>

                      <!-- Action Button -->
                      <div class="mt-6 pt-6 border-t border-gray-800">
                          <button class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg transition-colors duration-300 flex items-center justify-center gap-2 group-hover:bg-blue-500">
                              <i class="fas fa-redo-alt"></i>
                              Book Again
                          </button>
                      </div>
                  </div>
              </div>
          @empty
              <div class="col-span-full flex flex-col items-center justify-center p-12 bg-gray-900 backdrop-blur-sm rounded-lg border border-gray-800">
                  <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                      <i class="fas fa-calendar-times text-2xl text-gray-400"></i>
                  </div>
                  <p class="text-gray-200 text-lg mb-2">No Past Reservations</p>
                  <p class="text-gray-400 text-center">Your reservation history will appear here once you make your first booking.</p>
                  <a href="{{ route('cafes.index') }}" class="mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-colors duration-300 flex items-center gap-2">
                      <i class="fas fa-search"></i>
                      Browse Cafes
                  </a>
              </div>
          @endforelse
      </div>
  </x-horizontal-card>
</x-layout>