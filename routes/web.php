<?php
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TinyMCEController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\PageController as FrontPageController;
use App\Http\Controllers\Front\RSSFeedController as FrontRSSFeedController;
use App\Http\Controllers\Front\TagController as FrontTagController;
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

// Authentication
Route::name('auth.')->prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'loginAction'])->name('login.action');
});

// Admin
Route::name('admin.')->prefix('admin')->group(function () {
    Route::middleware(['auth', 'check.level:1,2'])->group(function () {

        // Root redirect to home
        Route::get('/', function () {
            return redirect()->route('admin.home.index');
        });

        // Home
        Route::get('/home', [HomeController::class, 'index'])->name('home.index');

        // Article
        Route::resource('article', ArticleController::class)->except(['show']);

        // TinyMCE
        Route::post('tinymce/upload', [TinyMCEController::class, 'upload'])->name('tinymce.upload');

        // Tag for Article
        Route::resource('tag', TagController::class)->except(['show', 'create']);

        // Page
        Route::resource('page', PageController::class)->except(['show']);

        // Super Access
        Route::middleware(['check.level:1'])->name('super.')->group(function () {

            // User
            Route::resource('user', UserController::class)->except(['create', 'show']);

            // Menu
            Route::resource('menu', MenuController::class)->only(['index']);
            Route::name('menu.')->prefix('menu')->group(function () {
                Route::post('create', [MenuController::class, 'create'])->name('create');
                Route::post('delete', [MenuController::class, 'destroy'])->name('delete');
                Route::post('update', [MenuController::class, 'update'])->name('update');
                Route::post('actualizar', [MenuController::class, 'actualizar'])->name('actualizar');
            });
        });
    });
});

// Front
Route::name('front.')->middleware(['visitors'])->group(function () {
    Route::get('/', [FrontHomeController::class, 'index'])->name('home.index');
    Route::get('/feed', [FrontRSSFeedController::class, 'index'])->name('feed.index');
    Route::get('article/{slug}', [FrontArticleController::class, 'show'])->name('article.show');
    Route::get('tag/{slug}', [FrontTagController::class, 'show'])->name('tag.show');
    Route::get('page/{slug}', [FrontPageController::class, 'show'])->name('page.show');
});
