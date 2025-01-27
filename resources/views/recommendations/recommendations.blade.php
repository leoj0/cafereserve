<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-4 text-white">Recommended for You</h2>
        <p class="text-gray-400 text-center mb-12">Discover our handpicked selection of fantastic cafes</p>

        @if ($recommendations->isEmpty())
            <p class="text-center text-gray-400">No recommendations available at the moment. Check back later!</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($recommendations as $recommendation)
                    <div
                        class="group relative overflow-hidden rounded-2xl bg-gray-800 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/10">
                        <div class="aspect-w-1 aspect-h-1">
                            <img src="{{ $recommendation['logo'] ? asset('storage/'.$recommendation['logo']) : asset('storage/images/default_image.jpg') }}"
                                alt="{{ $recommendation['cafe_name'] }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent">
                            <div class="absolute bottom-0 p-6 text-white">
                                <h3 class="text-2xl font-bold mb-2">{{ $recommendation['cafe_name'] }}</h3>
                                @if (!empty($recommendation['predicted_rating']))
                                    <p class="text-sm text-gray-400">Predicted Rating: {{ $recommendation['predicted_rating'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
