<x-layout>
<form method="POST" action="/posts/{{$post->id}}">
  @csrf
  @method('PATCH')
  <div class="flex flex-col border-b border-gray-900/10 pb-12">
  
      <div>
        <label for="username" class="block text-sm/6 font-medium text-gray-900">Title</label>
        <div class="mt-2">
          <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-blue-600">
            <input type="text" name="title" id="username" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="click here..." value="{{$post->title}}">
          </div>
          
        </div>
      </div>
      <div>
        <label for="about" class="block text-sm/6 font-medium text-gray-900">Post body</label>
        <div class="mt-2">
          <input name="text" id="about" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6" placeholder="click here..." value="{{$post->text}}" ></input>
        </div>
      </div>
      <div>
        <label for="tags" class="block text-sm font-medium text-gray-900">Tags (comma-separated)</label>
        <div class="mt-2">
            <input type="text" name="tags" id="tags"
                value="{{ implode(',', $post->tags->pluck('name')->toArray()) }}"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm"
                placeholder="Enter tags, separated by commas">
        </div>
      </div>
      <!-- @error('title')
        {{$message}}
      @enderror
      @error('text')
        {{$message}}
      @enderror
       -->
          @if($errors->any())
                <ul>
                  @foreach ( $errors->all() as $error )
                  <li>
                    {{$error}}
                  </li>
                    
                  @endforeach
                </ul>
          @endif
          <div class="flex gap-2">
            <button  type="submit" class="bg-black text-white w-20 text-center p-2 rounded hover:bg-blue-600">update</button>
            <a href="/posts/{{$post->id}}" class="bg-black text-white w-20 text-center p-2 rounded hover:bg-blue-600">cancel</a>
            <button form="delete_form" class="bg-black text-white w-20 text-center p-2 rounded hover:bg-blue-600">delete</button>
          </div>
      </div>

</form>
<form method="POST" action="/posts/{{ $post->id }}" class="hidden" id="delete_form">
    @csrf
    @method('DELETE')
</form>
</x-layout>