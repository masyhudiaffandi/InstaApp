<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between">
            {{ __('Dashboard') }}
            <a href="{{ route('posts.create') }}">Create Post</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col justify-center items-center">
                        <div class="post-container">
                        @foreach ($posts as $post)
                            <div class="header flex justify-between items-center">
                                <p>{{ $post->user->name }}</p>
                                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </div>
                            <img src="{{ asset('storage/'.$post->photo) }}" class="w-96" alt="photo">
                            {{-- like --}}
                            @if(auth()->check())
                                @if(!$post->likedBy(auth()->user()))
                                    <form action="{{ route('posts.like', $post->id) }}" method="post">
                                        @csrf
                                        <button type="submit">Like</button>
                                    </form>
                                @else
                                     <form action="{{ route('posts.unlike', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Unlike</button>
                                    </form>
                                @endif
                            @endif
                            <p>{{ $post->user->name }} {{$post->description}}</p>

                            {{-- comment --}}
                            <p class="comments">Comment :</p>
                            @foreach ($post->comments as $comment)
                                <p>{{ $comment->content }}</p>
                                <small>Posted by: {{ $comment->user->name }}</small>
                            @endforeach
                            <p></p>
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <textarea name="content" rows="3" placeholder="Tambahkan komentar..." required></textarea>
                                <button type="submit">Kirim</button>
                            </form>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
