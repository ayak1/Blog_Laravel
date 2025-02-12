<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

</head>
<body>
    <nav class="w-full bg-black fixed z-100">
        <ul class="mx-auto max-w-7xl p-6 flex items-center gap-4 container">
            <li><a class="text-white" href="/">home</a></li>
            <li><a class="text-white" href="/posts">posts</a></li>
            <li><a href="/posts/create" class="bg-white text-black p-2 rounded rounded-lg">add post</a></li>
            @guest
            <li><a href="/register" class="bg-white text-black p-2 rounded rounded-lg">register</a></li>
            <li><a href="/login" class="bg-white text-black p-2 rounded rounded-lg">login</a></li>
            @endguest
            @auth
                <form action="/logout" method="POST">
                   @csrf
                   <button type="submit"  class="bg-white text-black p-2 rounded rounded-lg">logout</button>
                </form>
            @endauth
        </ul>
    </nav>
    <div class="mx-auto max-w-7xl py-24">
        {{$slot}}
    </div>
</body>
</html>