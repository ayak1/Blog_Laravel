<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show(Post $post){
        return view('posts.show', ['post' => $post]);
    }
    public function showUserPosts(){
        if(Auth::guest()){
            return redirect('/login');
        }else{
            $posts = Auth::user()->posts()->with('user')->latest()->simplePaginate(6);
        }
        return view('posts.userPosts',['posts'=>$posts]);

    }
    public function store(){
        request()->validate([
            'title' => ['required'],
            'text' => 'required'
        ]);

        Post::create([
            'title' => request('title'),
            'text' => request('text'),
            'user_id' => Auth::user()->id,
            // 'user_id' => Auth::id(),
        ]);
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
            'text' => 'required'
        ]);
        //update
        // $post = Post::findOrFail($id);
        // if id not exist we should fail
        // choice one
        $post->update([
            'title' => request('title'),
            'text' => request('text'),
        ]);
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
