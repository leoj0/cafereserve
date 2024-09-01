@props(['tagsCsv'])

@php
    $cafe_tags = explode(',', $tagsCsv);
@endphp

<ul class="flex flex-wrap gap-2 mt-4">
  @foreach ($cafe_tags as $cafe_tag)
    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
      <a href="/cafe_listings/index/?tag={{$cafe_tag}}">{{$cafe_tag}}</a>
    </li>
  @endforeach

</ul>