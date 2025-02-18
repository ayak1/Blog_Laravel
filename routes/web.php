<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });


Route::view('/','home');
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/create',[PostController::class,'create'])->middleware('auth','can:create-post');
Route::post('/posts',[PostController::class,'store']);
Route::get('/posts/{post}',[PostController::class,'show']);
Route::get('/posts/{post}/edit',[PostController::class,'edit'])->middleware('auth');
Route::patch('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destroy']);
Route::get('/my_posts',[PostController::class,'showUserPosts']);

Route::get('/register',[RegisterUserController::class,'create']);
Route::post('/register',[RegisterUserController::class,'store']);

Route::get('/login',[SessionController::class,'create'])->name('login');
Route::post('/login',[SessionController::class,'store']);
Route::post('/logout',[SessionController::class,'destroy']);














// posts
// 1
// Route::get('/posts',[PostController::class,'index']);
// Route::get('/posts/create',[PostController::class,'create']);
// Route::get('/posts/{post}',[PostController::class,'show']);
// Route::post('/posts',[PostController::class,'store']);
// Route::get('/posts/{post}/edit',[PostController::class,'edit']);
// Route::patch('/posts/{post}',[PostController::class,'update']);
// Route::delete('/posts/{post}',[PostController::class,'delete']);
// _____
// 2
// ______
// Route::controller(PostController::class)->group(function(){
//     Route::get('/posts','index');
//     Route::get('/posts/create','create');
//     Route::get('/posts/{post}','show');
//     Route::post('/posts','store');
//     Route::get('/posts/{post}/edit','edit');
//     Route::patch('/posts/{post}','update');
//     Route::delete('/posts/{post}','delete');
// });
// _______
// 3
// ______
// Route::resource('posts',Postcontroller::class);
// _____
// 4
// ___
// Route::resource('posts',Postcontroller::class,[
//     'only'=>[]
//     // 'except' => []
// ]);

// Route::get('/posts', function(){
//     $posts = Post::with(['tags','user'])->latest()->simplePaginate(5);
//     return view('posts.index',['posts' => $posts]);
// });

// Route::get('/posts/create',function(){
//     return view('posts.create');
// });
// Route::get('/posts/{post}', function (Post $post) {
    //     // _______
    //     // uri = /posts/{id}
    //     // $post = Post::find($id);
    //     // return view('posts.show', ['post' => $post]);
    //     // _______
    //     return view('posts.show', ['post' => $post]);

    // });
// Route::post('/posts', function(){
//     request()->validate([
//         'title' => ['required'],
//         'text' => 'required'
//     ]);
//     Post::create([
//         'title' => request('title'),
//         'text' => request('text'),
//         'user_id' => 1
//     ]);
//     return redirect('/posts');
// });
// Route::get('/posts/{post}/edit', function (Post $post) {
    //     // $post = Post::find($id);
    //     return view('posts.edit', ['post' => $post]);
    // });

// Route::patch('/posts/{post}', function(Post $post){
//     //authorize
//     //validate
//     request()->validate([
//         'title' => ['required'],
//         'text' => 'required'
//     ]);
//     //update
//     // $post = Post::findOrFail($id);
//     // if id not exist we should fail
//     // choice one
//     $post->update([
//         'title' => request('title'),
//         'text' => request('text'),
//     ]);
//     // choice tow
//     // $post->title = request('title');
//     // $post->text =request('text');
//     // $post->save();
//     //and persist
//     //redirect
//     return redirect('/posts/'.$post->id);
// });
// Route::delete('/posts/{post}', function (Post $post) {
//     //authorize
//     // delete
//     // choice1
//     // $post = Post::findOrFail($id);
//     $post->delete();
//     // choice2
//     //  Post::findOrFail($id)->delte();
//     // redirect
//     return redirect('/posts');
// });
