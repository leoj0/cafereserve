<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($cafes as $cafe)
    <div class="cafe-card bg-gray-800 border border-gray-700 rounded shadow-md h-[360px]">
        <!-- Fixed height container for entire card -->
        
        <!-- Cafe Image - Fixed Height -->
        <div class="h-48">
            <img class="w-full h-full object-cover rounded-t"
                src="{{ $cafe->logo ? asset('storage/' . $cafe->logo) : asset('storage/images/default_image.jpg') }}" 
                alt="Cafe Photo">
        </div>

        <!-- Content Section - Fixed Position Layout -->
        <div class="relative h-[192px] p-4"> <!-- 360px - 48px(image) = 192px for content -->
            <!-- Cafe Name Area - Fixed Position -->
            <div class="h-14">
                <h3 class="line-clamp-2">
                    <a href="/cafe_listings/{{ $cafe->cafe_id }}" 
                       class="text-lg font-semibold text-white hover:text-blue-400">
                       {{ $cafe->cafe_name }}
                    </a>
                </h3>
            </div>

            <!-- Tags - Absolute Position -->
            <div class="absolute top-24 left-4 right-4">
                <div class="h-10 overflow-hidden">
                    <x-cafe-tags :tagsCsv="$cafe->cafe_tags" />
                </div>
            </div>

            <!-- Location - Absolute Position -->
            <div class="absolute bottom-4 left-4 right-4">
                <div class="flex items-center text-gray-400">
                    <i class="fa-solid fa-location-dot mr-2"></i>
                    <p class="truncate">{{ $cafe->location }}</p>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>