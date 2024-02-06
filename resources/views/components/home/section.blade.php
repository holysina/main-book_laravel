@props(['title'])

<div class="container mx-auto">
    <h3 class="mt-10 ml-2 text-4xl text-gray-500 font-semibold">{{ $title }}</h3>
    <hr class="mt-5 ml-2 w-64 border-2 rounded border-orange-400">

    {{ $slot }}
</div>