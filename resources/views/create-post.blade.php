<x-app-layout>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="flex flex-col">
        @csrf
        <input type="text" name="user_id" value="{{ Auth::id() }}" hidden>
        <input type="text" name="title" placeholder="タイトル">
        <input type="text" name="description" placeholder="本文">
        <input type="file" name="photo">
        <input type="submit" value="投稿">
    </form>
</x-app-layout>