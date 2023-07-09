<x-app-layout>
    <x-slot name="header">
        <div class="header-wraaper">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $post->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
           <div class="card">
                <div class="post-wrapper">
                    <p>{!! $post->text !!}</p>
                </div>
                    <div class="action-buttons">
                        <a href="{{ route('post.like-toggle', ['post' => $post]) }}" class="create-btn">
                            {{ $post->postLikes->contains(auth()->id()) ? "Unlike" : 'Like' }}
                        </a>
                        @if ($post->postLikes->count())
                            <span class="post-count">
                                {{ $post->postLikes->count() }}
                            </span>
                        @endif
                    </div>
           </div>
           <div class="card">
                <div class="comments">

                    @if (auth()->id())
                        <form action="{{ route('comment.store', ['post' => $post]) }}" method="POST">
                            @csrf
                            <div class="input-wrapper">
                                <label for="text">Comment</label>
                                <textarea name="text" id="text"></textarea>
                            </div>

                            <button class="create-btn" type="submit">Comment</button>
                        </form>
                    @endif

                    @foreach ($comments as $comment)
                        <div class="comment-wrapper">
                            @if ($comment->user_id == auth()->id())
                                <div class="comment-actions">
                                    <form action="{{ route('comment.destroy', ['comment' => $comment]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            @endif
                            <p>{!! $comment->text !!}</p>
                            <div class="comment-fingerprint">
                                {{ $comment->user->name }} - {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:m') }}
                            </div>
                        </div>
                    @endforeach

                    {{ $comments->links() }}

                </div>
           </div>
        </div>
    </div>
</x-app-layout>
