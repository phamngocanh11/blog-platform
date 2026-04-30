<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Posts tagged with "{{ $tag }}"</h1>
        <div class="mt-6">
            @forelse ($posts as $post)
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">{{ $post->post_name }}</h2>
                    <p>{{ $post->post_content }}</p>
                </div>
            @empty
                <p>No posts found with this tag.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
