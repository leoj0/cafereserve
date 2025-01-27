<form action="/cafe_listings/index" method="GET">
  <div class="relative border-2 border-gray-100 m-4 rounded-lg">
    <div class="absolute top-4 left-3 flex items-center">
      <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
    </div>

    <input 
      type="text" 
      name="search" 
      class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" 
      placeholder="Search Cafe..."
    >

    <div class="absolute top-2 right-2 flex items-center">
      <button 
        type="submit" 
        class="h-10 w-20 rounded-lg text-white bg-purple-500 hover:bg-purple-600"
      >
        Search
      </button>
    </div>
  </div>
</form>
