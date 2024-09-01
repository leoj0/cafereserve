<div class="cafe-card bg-light border p-4 rounded mb-3 flex items-center">
    <div class="w-48 h-48 flex-shrink-0">
        <img class="w-full h-full object-cover rounded"
            src="{{ $cafe->logo ? asset('storage/' . $cafe->logo) : asset('storage/images/default_image.jpg') }}"
            alt="Cafe Photo">
    </div>

    <div class="ml-6 flex flex-col">
        <h3>
            <a href="/cafe_listings/{{ $cafe->cafe_id }}" class="h4 mt-3">{{ $cafe->cafe_name }}</a>
        </h3>
        <div class="flex">
            <x-cafe-tags :tagsCsv="$cafe->cafe_tags"></x-cafe-tags>
        </div>
        <div class="flex items-center mt-4">
            <i class="fa-solid fa-location-dot mr-3"></i>
            <p class="card-text">{{ $cafe->location }}</p>
        </div>
    </div>

    <div class="absolute bottom-4 right-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
        <a href="{{ route('reservations.create', $cafe->cafe_id) }}"
            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Reserve</a>
    </div>
</div>

