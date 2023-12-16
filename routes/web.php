<?php



use App\Models\Catagory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminCatagoryController;
use App\Http\Controllers\DashboardPostController;

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

Route::get('/', function ($name = "Admin", $email = "admin@email.com") {
    return view('home', [
        "name" => $name,
        "email" => $email,
        "title" => "Home"
    ]);
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', [HomeController::class, 'index']);

Route::get('/post', [PostController::class, 'index']);

Route::get('/post/{post:slug}', [PostController::class, 'detail']);

Route::get('/catagory', function(){
    return view('catagorys', [
        'title' => 'Post Catagorys',
        'catagorys' => collect(Catagory::all())
    ]);
});

Route::any('/catagory/{catagory:slug}', function(Catagory $catagory){
    return view('post', [
        'title' => 'Catagory Post',
        'posts' => collect($catagory->post->load(['catagory', 'user']))
    ]); 
});

Route::any('/user/{user:username}', function(User $user){
    return view('post', [
        'title' => 'User Post',
        'posts' => collect($user->post->load(['catagory', 'user']))
    ]);
});

Route::Get('/login', [LoginController::Class, 'index'])->name('login')->middleware('guest');

Route::Get('/dashboard', function(){
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth');

Route::Post('/login', [LoginController::Class, 'authenticate']);

Route::Post('/logout', [LoginController::Class, 'logout']);

Route::Get('/register', [RegisterController::Class, 'index'])->middleware('guest');

Route::Post('/register', [RegisterController::Class, 'store']);

Route::Get('/dashboard/post/Cslug', [DashboardPostController::class, 'Cslug'])->middleware('auth');
Route::resource('/dashboard/post', DashboardPostController::class)->middleware('auth');

Route::Get('/dashboard/catagories/Cslug', [AdminCatagoryController::class, 'Cslug'])->middleware('auth');
Route::resource('/dashboard/catagories', AdminCatagoryController::class)->except('show')->middleware('admin');
// Route::any('/catagory/{catagory:slug(unik identifer setiap web)}', [CatagoryController::class, 'index(method dari class)']);

// Route::get('/', function(){
//     return view('home');
// });
