@props(['tagsCsv'])

@php
    $cafe_tags = explode(',', $tagsCsv);
@endphp

<ul class="flex flex-wrap gap-2"> <!-- Keep the gap for spacing -->
    @foreach ($cafe_tags as $cafe_tag)
        <li class="flex items-center justify-center bg-black text-white rounded-full py-1 px-2 text-xs transition-transform duration-300 transform hover:scale-105 hover:shadow-lg"> <!-- Gradient background and hover effect -->
            <a href="/cafe_listings/index/?tag={{ $cafe_tag }}" class="text-xs font-semibold">
                {{ $cafe_tag }}
            </a>
        </li>
    @endforeach
</ul>