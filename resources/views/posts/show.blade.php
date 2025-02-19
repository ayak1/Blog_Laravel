<x-layout>
    <div class="relative isolate overflow-hidden bg-white px-6 py-24 sm:py-32 lg:overflow-visible lg:px-0">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <svg class="absolute top-0 left-[max(50%,25rem)] h-[64rem] w-[128rem] -translate-x-1/2 stroke-gray-200 [mask-image:radial-gradient(64rem_64rem_at_top,white,transparent)]" aria-hidden="true">
            <defs>
                <pattern id="e813992c-7d03-4cc4-a2bd-151760b470a0" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
                <path d="M100 200V.5M.5 .5H200" fill="none" />
                </pattern>
            </defs>
            <svg x="60%" y="-1" class="overflow-visible fill-blue-50">
                <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
            </svg>
            <svg x="40%" y="-1" class="overflow-visible fill-blue-50">
                <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
            </svg>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#e813992c-7d03-4cc4-a2bd-151760b470a0)" />
            </svg>
        </div>
        <div class="w-full mx-auto lg:mx-0 ">
            <div class=" lg:mx-auto lg:gap-x-8 lg:px-8">
            <div class="lg:pr-4">
                <div class="w-full">
                    <!-- tags here -->
                    <div class="flex items-center justify-center gap-[1px]">
                        @foreach($post->tags as $tag)
                        <p class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 ">{{$tag->name}}</p>
                        @endforeach
                    </div>                    <!-- //// -->
                    <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{$post->title}}</h1>
                    <p class="mt-6 text-xl/8 text-gray-700">{{$post->text}}</p>
                    <div class="flex justify-between items-center pt-5 text-blue-500 font-medium">
                        <p class="">by: {{$post->user->name}}</p>
                        <time class="">{{$post->created_at->format('M  d/Y')}}</time>
                    </div>
                </div>
            </div>
            </div>
        </div>

        
        @if(!Auth::guest() && Auth::user()->id==$post->user_id )
            <a href="/posts/{{$post->id}}/edit">edit</a>
        @endif

        <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach ($post->user->posts as $post_extra)
                
                @if ($post_extra->id !== $post['id'])
                    <x-post-card :post="$post_extra" />  
                @endif
            @endforeach
        </div>
    </div>
</x-layout>