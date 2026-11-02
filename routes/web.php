<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AdController, CategoryController, StoreController,
    DashboardController, MessageController, FavoriteController,
    NotificationController, SearchController, ProfileController,
    StoreSetupController, VendorDashboardController, CartController,
    OrderController, CheckoutController, GeminiController
};
use App\Livewire\{Home, AdListing};
use App\Livewire\Auth\SellerLogin;
use App\Livewire\Auth\SellerRegister;
use App\Livewire\Admin\Orders\OrderIndex;
use App\Livewire\Admin\Orders\OrderShow;

/*
|--------------------------------------------------------------------------
| 1. المسارات العامة الثابتة (Public Static Routes)
|--------------------------------------------------------------------------
*/
Route::get('/', Home::class)->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::post('/ai/chat', [GeminiController::class, 'chat'])->name('ai.chat');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{slug}', [StoreController::class, 'show'])->name('stores.show');

Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/category/{slug}', AdListing::class)->name('ads.by-category');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/buy/{id}', [CartController::class, 'buyNow'])->name('cart.buy-now');
Route::post('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('guest')->group(function () {
    Route::get('/seller/login', SellerLogin::class)->name('seller.login');
    Route::get('/seller/register', SellerRegister::class)->name('seller.register');
});


/*
|--------------------------------------------------------------------------
| 2. Authenticated portals
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:web', 'active'])->get('/dashboard', function () {
    $destination = Auth::user()->portalDashboardRoute();

    abort_if($destination === null, 403, 'This account has no portal access.');

    return redirect()->route($destination);
})->name('dashboard');

Route::middleware(['auth:web', 'active', 'role:buyer,web', 'portal:buyer'])
    ->prefix('customer')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');

        Route::prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('index');
            Route::post('/store', [CheckoutController::class, 'store'])->name('store');
            Route::get('/success', [CheckoutController::class, 'success'])->name('success');
        });

        Route::get('/orders', [CheckoutController::class, 'myOrders'])->name('orders.index');
    });

Route::middleware(['auth:web', 'active', 'role:seller,web', 'portal:seller'])
    ->prefix('seller')
    ->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
        Route::get('/analytics', [VendorDashboardController::class, 'analytics'])->name('vendor.analytics');
        Route::get('/store/settings', [VendorDashboardController::class, 'storeSettings'])->name('vendor.store.settings');
        Route::get('/orders', [CheckoutController::class, 'vendorOrders'])->name('vendor.orders.index');
        Route::patch('/orders/{order}', [CheckoutController::class, 'updateStatus'])->name('vendor.orders.update');

        Route::get('/my-ads', [AdController::class, 'myAds'])->name('my-ads');
        Route::resource('ads', AdController::class)->except(['index', 'show']);

        Route::prefix('store-setup')->group(function () {
            Route::get('/', [StoreSetupController::class, 'index'])->name('store.setup');
            Route::post('/basic', [StoreSetupController::class, 'storeBasic'])->name('store.setup.basic');
            Route::post('/branding', [StoreSetupController::class, 'storeBranding'])->name('store.setup.branding');
            Route::post('/contact', [StoreSetupController::class, 'storeContact'])->name('store.setup.contact');
        });
    });

Route::middleware(['auth:web', 'active', 'role:buyer|seller,web', 'portal:buyer|seller'])->group(function () {
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/conversation', [MessageController::class, 'show'])->name('show');
        Route::post('/', [MessageController::class, 'store'])->name('store');
    });

    Route::resource('favorites', FavoriteController::class)->only(['index', 'store', 'destroy']);

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/read-all', [NotificationController::class, 'markAllRead'])->name('read-all');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/view', [ProfileController::class, 'show'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::middleware(['auth:web', 'active', 'role:admin,web', 'portal:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', OrderIndex::class)->name('index');
            Route::get('/{order}', OrderShow::class)->name('show');
        });
    });

/*
|--------------------------------------------------------------------------
| 3. صفحات المعلومات (Static Pages)
|--------------------------------------------------------------------------
*/
Route::view('/help', 'pages.help')->name('help');
Route::view('/safety', 'pages.safety')->name('safety');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');

/*
|--------------------------------------------------------------------------
| 4. المسارات الديناميكية العامة (توضع في نهاية الملف منعاً للـ Hijacking)
|--------------------------------------------------------------------------
*/
Route::get('/ads/{slug}/preview', [AdController::class, 'preview'])->name('ads.preview');
Route::get('/ads/{slug}', [AdController::class, 'show'])->name('ads.show');

require __DIR__.'/auth.php';