<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/posts/create',[PostsController::class,'create']);
    // 게시글 작성 

Route::post('/posts/store',[PostsController::class,'store']);
    // input 받아오기 

Route::get('/posts/index',[PostsController::class,'index'])->name('posts.index');
    // redict를 사용하기 위해 생성 해준다. (다시 받아서 와야하기 때문에)
    // name()에는 route이름을 주었다