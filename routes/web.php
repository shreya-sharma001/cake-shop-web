<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassCakesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Middleware\AdminMiddlware;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CustomerMiddlware;


// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [UserController::class, 'show'])->name('home');
Route::get('/myprofile', [UserController::class, 'showProfile'])->name('myprofile');

Route::get('/signup_Form', function () {
    return view('signup_Form');
});

Route::POST('/addEmail', [EmailController::class, 'store'])->name('addEmail');

Route::POST('/addUser', [UserController::class, 'addUser'])->name('addUser');

Route::GET('/login_Form', [UserController::class, 'loginPage'])->name('login_Form');


Route::POST('/loginUser', [UserController::class, 'login'])->name('loginUser');
Route::POST('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/about', function () {
    return view('about');
});

Route::get('/shop', [ProductsController::class, 'getProduct'])->name('shop');
Route::get('/shop-details/{id}', [ProductsController::class, 'getShopDetails'])->name('shop-details');
Route::get('/addcart/{id}', [ProductsController::class, 'addToCart'])->name('addToCart');
Route::get('/shoping-cart', [ProductsController::class, 'getCart'])->name('shoping-cart');
Route::POST('/update-quantity', [ProductsController::class, 'UpdateQuantity'])->name('update-quantity');
Route::POST('/remove_from_cart', [ProductsController::class, 'remove_from_cart'])->name('remove_from_cart');


Route::get('/checkout', [ProductsController::class, 'checkout'])->name('checkout')->middleware(CustomerMiddlware::class);
Route::POST('/shipping', [ProductsController::class, 'shipping'])->name('place_order');

Route::get('/wisslist', function () {
    return view('wisslist');
})->middleware(CustomerMiddlware::class);

Route::get('/Class', function () {
    return view('Class');
})->middleware(CustomerMiddlware::class);

Route::get('/contact', function () {
    return view('contact');
})->middleware(CustomerMiddlware::class);

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/blog-details', function () {
    return view('blog-details');
});

Route::get('/usersCake', [ClassCakesController::class, 'shows'])->name('usersCake');

Route::post('/addUsers', [ClassCakesController::class, 'addUsers'])->name('classcakes');

Route::get('/editUsers/{id}', [ClassCakesController::class, 'editUsers'])->name('editCakeUsers');

Route::post('/updateUsers/{id}', [ClassCakesController::class, 'updateUsers'])->name('updateUsers');

Route::get('/deleteUsers/{id}', [ClassCakesController::class, 'deleteUsers'])->name('deleteUsers');


// Admin Route
Route::get('/admin/login', [UserController::class, 'adminLogin'])->name('adminLogin');

Route::middleware(AdminMiddlware::class)->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'showDashboard'])->name('dashboard');
    Route::get('/admin/orders', [OrdersController::class, 'order'])->name('adminOrders');

    Route::get('/admin/masters/category/category', [CategoryController::class, 'Category'])->name('category');

    Route::get('/admin/masters/category/addcategory', function () {
        return view('admin.masters.category.add_category_form');
    })->name('category.addform');

    Route::post('/admin/masters/category/addcategory', [CategoryController::class, 'addCategory'])->name('addcategory');
    Route::get('/admin/masters/category/editcategory/{id}', [CategoryController::class, 'editCategory'])->name('editcategory');
    Route::post('/admin/masters/category/updatecategory/{id}', [CategoryController::class, 'updateCategory'])->name('updatecategory');
    Route::get('/admin/masters/category/deletecategory/{id}', [CategoryController::class, 'deleteCategory'])->name('deletecategory');


    // Route::get('/admin/masters/product/product', [ProductsController::class, 'product'])->name('product')->middleware(AdminMiddlware::class);
    Route::get('/admin/masters/product/product', [ProductsController::class, 'product'])->name('product');
    // Route::get('/admin/masters/product/addproduct', function () {
    // return view('admin.masters.product.add_product_form');
    // })->name('product.addform');

    Route::get('/admin/masters/product/addproduct', [ProductsController::class, 'showproductForm'])->name('product.addform');
    Route::post('/admin/masters/product/save', [ProductsController::class, 'addProduct'])->name('addproduct');
    Route::get('/admin/masters/product/editproduct/{id}', [ProductsController::class, 'editProduct'])->name('editproduct');
    Route::post('/admin/masters/product/updateproduct/{id}', [ProductsController::class, 'updateProduct'])->name('updateproduct');
    Route::get('/admin/masters/product/deleteproduct/{id}', [ProductsController::class, 'deleteproduct'])->name('deleteproduct');

    Route::get('/admin/masters/tags/tags', [TagsController::class, 'Tag'])->name('tags');

    Route::get('/admin/masters/tags/addtag', function () {
        return view('admin.masters.tags.add_tags_form');
    })->name('tag.addform');

    Route::post('/admin/masters/tags/addtag', [TagsController::class, 'addTag'])->name('addtag');
    Route::get('/admin/masters/tags/edittag/{id}', [TagsController::class, 'editTag'])->name('edittag');
    Route::post('/admin/masters/tags/updatetag/{id}', [TagsController::class, 'updateTag'])->name('updatetag');
    Route::get('/admin/masters/tags/deletetag/{id}', [TagsController::class, 'deleteTag'])->name('deletetag');

});

Route::get('logout', [UserController::class, 'adminLogout'])->name('admin.logout');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');


Route::get('/settings', function () {
    return view('admin.settings');
});

Route::get('/setup', function () {
    return view('admin.setup.setup');
});

// Route::get('/profile', function () {
//     return view('admin.profile');
// });

// Route::get('/orders', function () {
//     return view('admin.orders');
// });
