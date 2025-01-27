<div class="bg-white rounded-lg shadow-md p-12 text-center">
  <svg class="h-12 w-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
  </svg>
  <h3 class="text-xl font-semibold mb-2">
      @if(request('search') || request('location'))
          No Cafes Match Your Search
      @else
          No Cafes Available Yet
      @endif
  </h3>
  <p class="text-gray-500">
      @if(request('search') || request('location'))
          Try adjusting your search criteria or explore different locations
      @else
          Check back soon for exciting cafe options
      @endif
  </p>
</div>