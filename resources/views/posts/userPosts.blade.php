<x-layout>
<div class="bg-white ">

    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16  sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @if(count($posts)==0)
            <div class="">
                <p class="mb-4">you do not have any posts</p>
                <a href="/posts/create" class="bg-black text-white  p-2 rounded rounded-lg">add post </a>
            </div>
        
        @else
            @foreach ($posts as $post )
                <x-post-card :post="$post" />  
            @endforeach
        
        @endif
    </div>
    <div class="pt-4">
      {{$posts->links()}}
    </div>

</div>

   
</x-layout>