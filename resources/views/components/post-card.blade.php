@props(['post'])
<article class="flex max-w-xl flex-col items-start justify-between">
        <div class="w-full flex justify-between items-center gap-x-4 text-xs cursor-default">
            <p class="text-gray-600 font-medium">by: {{$post->user['name']}}</p>
            <div class="flex items-center gap-x-4">
                <time class="text-gray-500">{{$post['created_at']->format('M  d/Y')}}</time>
                <!-- tags -->
                <div class="flex items-center justify-center gap-[1px]">
                @foreach($post->tags as $tag)
                <p class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 ">{{$tag->name}}</p>
                @endforeach
                </div>
                <!-- /// -->
            </div>
        </div>
        <div class="group relative">
            <!-- title -->
          <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 ">
              <span class="absolute inset-0"></span>
              {{$post['title']}}
          </h3>
          <!-- //// -->
          <!-- text -->
          <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">{{$post['text']}}</p>
          <!-- /// -->
        </div>
        <a class=" text-sm font-bold text-blue-700" href="/posts/{{$post['id']}}">view post</a>

</article>
