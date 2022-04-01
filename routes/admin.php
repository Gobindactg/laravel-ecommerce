<?php

Route::get('admin/login', 'Admin\LoginController@adminLogin')->name('admin/login');
Route::post('admin/login', 'Admin\LoginController@admin_login')->name('admin.login');
 
// reset password send email
Route::get('admin/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/reset/post', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

// reset password 
Route::get('admin/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.reset.post');




Route::middleware(['auth:admin'])->group(function(){
Route::get('admin/register', 'Admin\LoginController@adminRegister')->name('admin.register');
Route::post('admin/register', 'Admin\LoginController@adminRegisterstore')->name('admin.register.store');
Route::post('admin/logout', 'Admin\LoginController@admin_logout')->name('admin.logout');
Route::get('admin/manage/user', 'Admin\LoginController@admin_manage')->name('admin/manage/user');
Route::get('admin/manage/user/edit/{id}', 'Admin\LoginController@admin_edit')->name('admin/manage/user/edit');
Route::post('admin/manage/user/delete/{id}', 'Admin\LoginController@admin_delete')->name('admin/manage/user/delete');
Route::post('admin/manage/user/active/{id}', 'Admin\LoginController@admin_status')->name('admin/manage/user/status');



Route::get('admin/home', 'Backend\AdminController@admin')->name('admin/home');

     
//Admin product Controller
Route::get('/admin', 'Backend\AdminController@welcome')->name('admin');
Route::get('/admin/create', 'Backend\AdminProductController@create')->name('admin/create');
Route::post('/admin/create', 'Backend\AdminProductController@product_store')->name('admin.product.store');
Route::get('/admin/manage', 'Backend\AdminProductController@manage')->name('admin/manage');
Route::get('/admin/manage/edit/{id}', 'Backend\AdminProductController@edit')->name('admin.manage.edit');
Route::post('/admin/manage/update/{id}', 'Backend\AdminProductController@product_update')->name('admin.manage.update');
Route::post('/delete/{id}', 'Backend\AdminProductController@delete')->name('admin.manage.delete');

// Admin Category Section
Route::get('/admin/category/create', 'Backend\CategoryController@category_create')->name('admin/category/create');
Route::post('/admin/category/create', 'Backend\CategoryController@category_store')->name('admin/category/store');
Route::get('/admin/category/manage', 'Backend\CategoryController@category_manage')->name('admin/category/manage');
Route::get('/admin/category/manage/edit/{id}', 'Backend\CategoryController@category_edit')->name('admin/category/edit');
Route::post('/admin/category/manage/update/{id}', 'Backend\CategoryController@category_update')->name('admin/category/update');
Route::post('/category/delete/{id}', 'Backend\CategoryController@delete')->name('admin/category/delete');
Route::get('/category/{slug}', 'Backend\CategoryController@category_show')->name('category.show');


// Admin order Section
Route::get('/admin/order', 'Backend\OrdersController@index')->name('admin/order');
Route::get('/admin/order/view{id}', 'Backend\OrdersController@show')->name('admin/order/show');
Route::post('/order/delete/{id}', 'Backend\OrdersController@delete')->name('admin/order/delete');
Route::post('/order/completed/{id}', 'Backend\OrdersController@completed')->name('admin.order.completed');
Route::post('/order/paid/{id}', 'Backend\OrdersController@paid')->name('admin.order.paid');
Route::post('/charge-update/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.charge');
Route::get('/invoice/{id}', 'Backend\OrdersController@invoice')->name('admin.order.invoice');

// Admin brand Section
Route::get('/admin/brand/manage', 'Backend\BrandController@brand_manage')->name('admin/brand/manage');
Route::get('/admin/brand/create', 'Backend\BrandController@brand_create')->name('admin/brand/create');
Route::post('/admin/brand/create', 'Backend\BrandController@brand_store')->name('admin/brand/store');
Route::get('/admin/brand/manage/edit/{id}', 'Backend\BrandController@brand_edit')->name('admin/brand/edit');

Route::post('/admin/brand/manage/update/{id}', 'Backend\BrandController@brand_update')->name('admin/brand/update');
Route::post('/brand/delete/{id}', 'Backend\BrandController@delete')->name('admin/brand/delete');

// Admin division Section
Route::get('/admin/division/manage', 'Backend\DivisionController@division_manage')->name('admin/division/manage');
Route::get('/admin/division/create', 'Backend\DivisionController@division_create')->name('admin/division/create');
Route::post('/admin/division/create', 'Backend\DivisionController@division_store')->name('admin/division/store');
Route::get('/admin/division/manage/edit/{id}', 'Backend\DivisionController@division_edit')->name('admin/division/edit');

Route::post('/admin/division/manage/update/{id}', 'Backend\DivisionController@division_update')->name('admin/division/update');
Route::post('/division/delete/{id}', 'Backend\DivisionController@delete')->name('admin/division/delete');


// Admin districe Section
Route::get('/admin/district/manage', 'Backend\DistrictController@district_manage')->name('admin/district/manage');
Route::get('/admin/district/create', 'Backend\DistrictController@district_create')->name('admin/district/create');
Route::post('/admin/district/create', 'Backend\DistrictController@district_store')->name('admin/district/store');
Route::get('/admin/district/manage/edit/{id}', 'Backend\DistrictController@district_edit')->name('admin/district/edit');

Route::post('/admin/district/manage/update/{id}', 'Backend\DistrictController@district_update')->name('admin/district/update');
Route::post('/district/delete/{id}', 'Backend\DistrictController@delete')->name('admin/district/delete');


// offer route section
Route::get('/admin/offer', 'Backend\OfferImageController@offer')->name('admin/offer');
Route::post('/admin/offer/create', 'Backend\OfferImageController@offer_store')->name('admin/offer/create');
Route::get('/admin/home', 'Backend\AdminController@admin')->name('admin/home');

});

// Blog route
Route::middleware(['auth:web'])->group(function(){
    Route::get('/blog/create', 'Fontend\ClientBlogController@blog_create')->name('blog.create');
    Route::post('/blog', 'Fontend\ClientBlogController@blog_store')->name('blog.store');
    Route::post('/blog', 'Fontend\ClientBlogController@blog_store')->name('blog.store');
    Route::get('/blog/edit{id}', 'Fontend\ClientBlogController@blog_edit')->name('blog.edit');
    Route::post('/blog/update{id}', 'Fontend\ClientBlogController@blog_update')->name('blog.update');
    Route::post('/blog/delete{id}', 'Fontend\ClientBlogController@blog_delete')->name('blog.delete');
});
