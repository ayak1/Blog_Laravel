<x-layout>
<div class="bg-white sm:py-32">
  <div class="px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:mx-0">
      <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">From the blog</h2>
      <p class="mt-2 text-lg/8 text-gray-600">Learn how to grow your business with our expert advice.</p>
    </div>
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach ($posts as $post )
            <x-post-card :post="$post" />  
        @endforeach
    </div>
    <div class="pt-4">
      {{$posts->links()}}
    </div>
    
  </div>
</div>

   
</x-layout>