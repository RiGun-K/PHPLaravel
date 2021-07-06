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

Route::get('/posts/team', function () {
    return view('posts.team');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
    // dashboard 에서 로그인되지 않으면 middleward를 거친다

require __DIR__.'/auth.php';


Route::get('/posts/create',[PostsController::class,'create'])/* ->middleware(['auth']) */ ;
    // 게시글 작성 , 'auth'는 middleware를 거쳐서 오도록 설정 = dashboard 누르면 로그인 페이지 먼저 나오도록 

Route::post('/posts/store',[PostsController::class,'store'])->name('posts.store')/* ->middleware(['auth']) */ ;
    // input 받아오기 

Route::get('/posts/index',[PostsController::class,'index'])->name('posts.index');
    // redict를 사용하기 위해 생성 해준다. (다시 받아서 와야하기 때문에)
    // name()에는 route이름을 주었다

Route::get('/posts/show/{id}',[PostsController::class,'show'])->name('post.show');