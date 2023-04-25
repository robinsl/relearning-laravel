<?php

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

Route::get('/', function () {
    return view('posts');
});

Route::get('/posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";
    
    if (! file_exists($path)) {
        //ddd('File does not exist');
        return redirect('/');
    }

    $post = cache()->remember("posts.{$slug}", now()->addMinutes(2), fn() => file_get_contents($path));

    return view('post', [
        'post' => $post
    ]);
//})->where('post', '[A-z0-9]+');
})->whereAlpha('post');
