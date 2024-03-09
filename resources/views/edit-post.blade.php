<x-app-layout>
    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data" class="flex flex-col">
        @csrf
        @method('PUT')
        <img src="{{ asset('storage/'.$post->phoyo) }}" alt="">
        <textarea type="textarea" cols="10" row="30" name="description" placeholder="本文" value="{{ $post->description }}"></textarea>
        <input type="submit" value="投稿">
    </form>
</x-app-layout>