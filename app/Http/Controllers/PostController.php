<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with(['tags','user'])->latest()->simplePaginate(6);
        return view('posts.index',['posts' => $posts]);
    }
    public function create(){
        if(Auth::user()->can('create-post'))
        return view('posts.create');
        else redirect('/login');
    }
    public function show($id){
        $post = Post::with('user', 'tags','user.posts','user.posts.user' ,'user.posts.tags')->findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }
    public function showUserPosts(){
        if(Auth::guest()){
            return redirect('/login');
        }else{
            $posts = Auth::user()->posts()->with('user','tags')->latest()->simplePaginate(6);
        }
        return view('posts.userPosts',['posts'=>$posts]);

    }
    public function store(Request $request){
        $request->validate([
            'title' => ['required'],
            'text' => 'required',
            'tags' => 'nullable|string' 
        ]);
    
        $post = Post::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'user_id' => Auth::id(),
        ]);
    
        if ($request->filled('tags')) {
            $tagNames = explode(',', $request->input('tags')); 
            $tagIds = [];
    
            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['name' => Str::lower($tagName)]);
                    $tagIds[] = $tag->id;
                }
            }
    
            // Attach tags to the post
            $post->tags()->sync($tagIds);
        }
    
        return redirect('/posts');
    }
    public function edit(Post $post){
        if($post->user->isNot(Auth::user()))
        {
            return redirect('/posts');
        }else{
            return view('posts.edit', ['post' => $post]);
        }
    }
    public function update(Post $post){
        // authorize
        if($post->user->isNot(Auth::user()))
            return redirect('/posts');
        //validate
        request()->validate([
            'title' => ['required'],
            'text' => 'required',
            'tags' => 'nullable|string' 
        ]);
        //update
        // $post = Post::findOrFail($id);
        // if id not exist we should fail
        // choice one
        $post->update([
            'title' => request('title'),
            'text' => request('text'),
        ]);
        if (request()->has('tags')) {
            $tagNames = explode(',', request('tags')); // Convert string to array
            $tagIds = [];
    
            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName);
                if (!$tagName) continue;
    
                // Find or create tag
                $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
    
            // Sync tags with the post
            $post->tags()->sync($tagIds);
        }
        // choice tow
        // $post->title = request('title');
        // $post->text =request('text');
        // $post->save();
        //and persist
        //redirect
        return redirect('/posts/'.$post->id);
    }
    public function destroy(Post $post){
        if($post->user->isNot(Auth::user()))
            return redirect('/posts');
        $post->delete();
        return redirect('/posts');
    }
}
