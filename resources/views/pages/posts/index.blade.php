<x-app-layout>
    <x-slot name="header">
        <div class="header-wraaper">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
            <a href="{{ route('post.create') }}" class="create-btn">Create Post</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($posts as $post)
                <a href="{{ route('post.show', ['post' => $post->id]) }}">
                    <div class="card post-card">
                        @if ($post->user_id == auth()->id())
                            <a class="edit-btn" href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
                        @endif
                        <h3>{{ $post->name }}</h3>
                        <p>{{ $post->description }}</p>
                    </div>
                </a>
            @endforeach
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
