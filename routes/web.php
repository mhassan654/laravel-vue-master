<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\BlogController;
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

Route::prefix('app')->middleware(['AdminCheck'])->group(function () {
    Route::post('/create_tag', [AdminController::class, 'addTag']);
    Route::get('/get_tags', [AdminController::class, 'getTags']);
    Route::post('/edit_tag', [AdminController::class, 'edit_tag']);
    Route::post('/delete_tag', [AdminController::class, 'delete_tag']);
    Route::post('/upload', [AdminController::class, 'upload']);
    Route::post('/delete_image', [AdminController::class, 'deleteImage']);

    // category routes
    Route::post('/create_category', [AdminController::class, 'addCategory']);
    Route::get('/get_categories', [AdminController::class, 'getCategories']);

    Route::post('/edit_category', [AdminController::class, 'editCategory']);
    Route::post('/delete_category', [AdminController::class, 'delete_category']);


    // admin routes
    Route::post('/create_user', [AdminController::class, 'createUser']);
    Route::get('/get_users', [AdminController::class, 'getUsers']);

    Route::post('/edit_admin', [AdminController::class, 'editAdmin']);
    Route::post('/delete_admin', [AdminController::class, 'delete_admin']);
    Route::post('/edit_user', [AdminController::class, 'edit_user']);
    Route::post('/admin_login', [AdminController::class, 'adminLogin']);

    // roles
    Route::post('/create_role', [AdminController::class, 'addRole']);
    Route::get('/get_roles', [AdminController::class, 'get_roles']);
    Route::post('/edit_role', [AdminController::class, 'editRole']);
    Route::post('/delete_role', [AdminController::class, 'delete_role']);
    Route::post('/assign_roles', [AdminController::class, 'assignRole']);

    //blog
    Route::post('/create-blog', [AdminController::class, 'addBlog']);
    //blog
Route::get('/blogdata', [AdminController::class, 'blogdata']);
Route::post('/blog/delete', [AdminController::class, 'deleteBlog']);

});

Route::post('blog', [AdminController::class, 'uploadEditorImage']);
Route::get('slug', [AdminController::class, 'slug']);




Route::get('/admin', [AdminController::class, 'index']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::get('{slug}', [AdminController::class, 'index'])->where('slug', '([A-z\d-\/_.]+)?');

// Route::any('{slug}', function(){
//     return view('welcome');
// });
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [BlogController::class, 'blogSingle'])->name('blog.single');
Route::get('/category/{categoryName}/{id}', [BlogController::class, 'categoryIndex'])->name('catIndex');
