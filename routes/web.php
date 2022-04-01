<?php

// use Illuminate\Support\Facades\Route;

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
// Route::get('/', 'MasterController@index');
// // Route::get('/', 'PagesController@index1')->name('index');




// Route::get('/', 'Fontend\PagesController@index')->name('index')->name('index');
Route::get('/', 'Fontend\PagesController@home')->name('home');;
Route::get('/products', 'Fontend\PagesController@product')->name('products');
Route::get('/products/{slug}', 'Fontend\ProductController@show')->name('products.show');
Route::get('/search', 'Fontend\PagesController@search')->name('search');
Route::get('/contact', 'Fontend\PagesController@contact')->name('contact');


// blog section route
Route::get('/blog', 'Fontend\PagesController@blog')->name('blog');

Route::get('/blog/search', 'Fontend\ClientBlogController@blog_search')->name('blog.search');


// admin route start

// route verify

Route::get('/token/{token}', 'Fontend\VerificationController@verify')->name('user.verification');

// user image update

Route::get('/profile/{id}', 'Fontend\profileController@user_edit')->name('profile');
Route::post('/profile/update{id}', 'Fontend\profileController@profile_update')->name('profile/update');
Route::get('/profile/dashboard/{id}', 'Fontend\profileController@dashboard')->name('profile/dashboard');
Route::post('/profile/dashboard/update/{id}', 'Fontend\profileController@info_update')->name('profile/dashboard/update');


// user dashboard route
    Route::get('/users/dashboard', 'Fontend\UsersController@dashboard')->name('users/dashboard');
    Route::get('/users/dashboard/profile', 'Fontend\UsersController@dashboard_profile')->name('users/dashboard/profile');
    Route::get('/users/dashboard/image', 'Fontend\UsersController@dashboard_image')->name('users/dashboard/image');


// Carts  route
// this route use for API
Route::get('carts', 'Fontend\CartsController@index')->name('carts');
Route::post('carts/store', 'API\CartsController@store')->name('carts.store');
Route::post('carts/update/{id}', 'Fontend\CartsController@update')->name('carts.update');
Route::post('carts/delete/{id}', 'Fontend\CartsController@delete')->name('carts.delete');

// Carts  route
Route::group(['prefix' =>'checkout'], function (){
    Route::get('/', 'Fontend\CheckoutController@index')->name('checkouts');
    Route::post('/store', 'Fontend\CheckoutController@store')->name('checkouts.store');
});






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// API Route
Route::get('get-districts/{id}', function($id){
    return json_encode(App\Models\District::where('division_id', $id)->get());
});
Route::get('get-upazilas/{id}', function($id){
    return json_encode(App\Models\Upazila::where('district_id', $id)->get());
});