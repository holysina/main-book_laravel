@props(['post'])

<a href="{{ route('post.show', ['user' => $post->author, 'post' => $post]) }}" class="flex-1 rounded-3xl drop-shadow-md hover:drop-shadow-2xl overflow-hidden">
    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-64 w-full object-cover">

    <div class="p-6 bg-white">
        <div class="px-3 py-1 rounded-md inline-flex bg-orange-100 text-orange-400 font-semibold">
            {{ $post->author->title }}
        </div>

        <div class="mt-2 text-xl font-semibold">
            {{ $post->title }}
        </div>

        <div class="mt-2 text-sm text-gray-400 font-semibold">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
</a>
