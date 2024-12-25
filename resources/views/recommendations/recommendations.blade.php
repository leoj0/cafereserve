<x-layout>
  <section class="py-20 bg-gray-900">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-4 text-white">Recommended for You</h2>
        <p class="text-gray-400 text-center mb-12">Discover our handpicked selection of fantastic cafes</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($recommendations as $recommendation)
                <div class="group relative overflow-hidden rounded-2xl bg-gray-800 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/10">
                    <div class="aspect-w-1 aspect-h-1">
                        <img src="{{ $recommendation['cafe']->logo ? asset('storage/'.$recommendation['cafe']->logo) : asset('storage/images/default_image.jpg') }}"
                             alt="{{ $recommendation['cafe']->cafe_name }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent">
                        <div class="absolute bottom-0 p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $recommendation['cafe']->cafe_name }}</h3>
                            <p class="text-emerald-400 flex items-center mb-1">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $recommendation['cafe']->location }}
                            </p>
                            <p class="text-gray-400 mb-1">Tags: {{ $recommendation['cafe']->cafe_tags }}</p>
                            <p class="text-gray-400 mb-1">
                                Average Rating: {{ round($recommendation['cafe']->feedbacks()->avg('rating'), 1) }}/5
                            </p>
                            <p class="text-gray-400">Similarity Score: {{ $recommendation['score'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

</x-layout>
