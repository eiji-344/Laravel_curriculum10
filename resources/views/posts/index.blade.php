<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-8 px-4">
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-blue-600 mb-4">Blog Name</h1>
            <p class="text-lg">ログインユーザー：<span class="font-medium">{{ Auth::user()->name }}</span></p>
        </header>

        <section class="mb-8">
            <div class="twitter mb-8">
                <h2 class="text-2xl font-semibold mb-4">Twitter認証</h2>
                <a href="{{ route('twitter.redirect') }}" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500 inline-block mb-4">Twitter認証</a>

                <h2 class="text-2xl font-semibold mb-4">Twitter投稿</h2>
                <form action="{{ route('twitter.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="text" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="ツイート内容を入力"></textarea>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">投稿</button>
                </form>
            </div>
        </section>

        <section class="posts mb-8">
            @foreach ($posts as $post)
                <div class="post p-4 bg-white shadow-md rounded mb-4">
                    <h2 class="text-xl font-bold text-gray-700 mb-2">
                        <a href="/posts/{{ $post->id }}" class="text-blue-500 hover:underline">{{ $post->title }}</a>
                    </h2>
                    <a href="/categories/{{ $post->category->id }}" class="inline-block bg-gray-200 text-gray-700 py-1 px-2 rounded mb-2">{{ $post->category->name }}</a>
                    <p class="text-gray-600">{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">delete</button>
                    </form>
                </div>
            @endforeach
        </section>

        <div class="paginate mb-8">
            {{ $posts->links() }}
        </div>

        <a href='/posts/create' class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 inline-block">create</a>

        <section class="teratail mt-8">
            <h2 class="text-2xl font-semibold mb-4">teratail質問ページ</h2>
            @foreach($questions as $question)
                <div class="mb-2">
                    <a href="https://teratail.com/questions/{{ $question['id'] }}" class="text-blue-500 hover:underline">
                        {{ $question['title'] }}
                    </a>
                </div>
            @endforeach
        </section>
    </div>

    <script>
        function deletePost(id) {
            'use strict';

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</body>
</html>