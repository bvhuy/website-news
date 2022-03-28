<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\FileController;
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

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'signin'])->name('login.signin');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('email')->group(function () {
    Route::get('/', [MailController::class, 'index'])->name('verification.index');
    Route::post('resend', [MailController::class, 'resend'])->name('verification.resend');
    Route::get('verify/{id}', [MailController::class, 'verify'])->name('verification.verify');
});

Route::get('/error.html', [HomeController::class, 'error'])->name('error');

Route::group(['middleware' => 'verified', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('can:admin.index');

    Route::prefix('file')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('admin.file.image.index')->middleware('can:admin.file.image.index');
        Route::get('/manager', [FileController::class, 'manager'])->name('admin.file.manager.index')->middleware('can:admin.file.image.index');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'general'])->name('admin.setting.general')->middleware('can:admin.setting.general');
        Route::put('/', [SettingController::class, 'generalUpdate'])->name('admin.setting.general.update')->middleware('can:admin.setting.general');
    });

    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index')->middleware('can:admin.menu.index');

        Route::get('/create', [MenuController::class, 'create'])->name('admin.menu.create')->middleware('can:admin.menu.create');
        Route::post('/', [MenuController::class, 'store'])->name('admin.menu.store')->middleware('can:admin.menu.create');

        Route::get('{menu}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit')->middleware('can:admin.menu.edit');
        Route::put('{menu}', [MenuController::class, 'update'])->name('admin.menu.update')->middleware('can:admin.menu.edit');

        Route::put('{menu}/disable', [MenuController::class, 'disable'])->name('admin.menu.disable')->middleware('can:admin.menu.disable');
        Route::put('{menu}/enable', [MenuController::class, 'enable'])->name('admin.menu.enable')->middleware('can:admin.menu.enable');

        Route::get('{menu}/up', [MenuController::class, 'up'])->name('admin.menu.up')->middleware('can:admin.menu.sort');
        Route::get('{menu}/down', [MenuController::class, 'down'])->name('admin.menu.down')->middleware('can:admin.menu.sort');

        Route::delete('{menu}', [MenuController::class, 'destroy'])->name('admin.menu.destroy')->middleware('can:admin.menu.destroy');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index')->middleware('can:admin.category.index');

        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create')->middleware('can:admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store')->middleware('can:admin.category.create');

        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit')->middleware('can:admin.category.edit');
        Route::put('{category}', [CategoryController::class, 'update'])->name('admin.category.update')->middleware('can:admin.category.edit');

        Route::put('{category}/disable', [CategoryController::class, 'disable'])->name('admin.category.disable')->middleware('can:admin.category.disable');
        Route::put('{category}/enable', [CategoryController::class, 'enable'])->name('admin.category.enable')->middleware('can:admin.category.enable');
        Route::delete('{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy')->middleware('can:admin.category.destroy');

        Route::get('{category}/up', [CategoryController::class, 'up'])->name('admin.category.up')->middleware('can:admin.category.sort');
        Route::get('{category}/down', [CategoryController::class, 'down'])->name('admin.category.down')->middleware('can:admin.category.sort');
    });

    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('admin.news.index')->middleware('can:admin.news.index');

        Route::get('/create', [NewsController::class, 'create'])->name('admin.news.create')->middleware('can:admin.news.create');
        Route::post('/', [NewsController::class, 'store'])->name('admin.news.store')->middleware('can:admin.news.create');

        Route::get('{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit')->middleware('can:admin.news.edit');
        Route::put('{news}', [NewsController::class, 'update'])->name('admin.news.update')->middleware('can:admin.news.edit');

        Route::put('{news}/disable', [NewsController::class, 'disable'])->name('admin.news.disable')->middleware('can:admin.news.disable');
        Route::put('{news}/enable', [NewsController::class, 'enable'])->name('admin.news.enable')->middleware('can:admin.news.enable');
        Route::delete('{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy')->middleware('can:admin.news.destroy');

        Route::post('/upload', [NewsController::class, 'upload'])->name('admin.news.upload')->middleware('can:admin.news.upload');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index')->middleware('can:admin.user.manage');

        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create')->middleware('can:admin.user.manage');
        Route::post('/', [UserController::class, 'store'])->name('admin.user.store')->middleware('can:admin.user.manage');

        Route::get('{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit')->middleware('can:admin.user.manage');
        Route::put('{user}', [UserController::class, 'update'])->name('admin.user.update')->middleware('can:admin.user.manage');

        Route::put('{user}/disable', [UserController::class, 'disable'])->name('admin.user.disable')->middleware('can:admin.user.manage');
        Route::put('{user}/enable', [UserController::class, 'enable'])->name('admin.user.enable')->middleware('can:admin.user.manage');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('admin.user.destroy')->middleware('can:admin.user.manage');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index')->middleware('can:admin.role.manage');

        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create')->middleware('can:admin.role.manage');
        Route::post('/', [RoleController::class, 'store'])->name('admin.role.store')->middleware('can:admin.role.manage');

        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('admin.role.edit')->middleware('can:admin.role.manage');
        Route::put('{role}', [RoleController::class, 'update'])->name('admin.role.update')->middleware('can:admin.role.manage');

        Route::delete('{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy')->middleware('can:admin.role.manage');
    });

    Route::prefix('category-video')->group(function () {
        Route::get('/', [CategoryVideoController::class, 'index'])->name('admin.category.video.index')->middleware('can:admin.category.video.index');

        Route::get('/create', [CategoryVideoController::class, 'create'])->name('admin.category.video.create')->middleware('can:admin.category.video.create');
        Route::post('/', [CategoryVideoController::class, 'store'])->name('admin.category.video.store')->middleware('can:admin.category.video.create');

        Route::get('{category}/edit', [CategoryVideoController::class, 'edit'])->name('admin.category.video.edit')->middleware('can:admin.category.video.edit');
        Route::put('{category}', [CategoryVideoController::class, 'update'])->name('admin.category.video.update')->middleware('can:admin.category.video.edit');

        Route::put('{category}/disable', [CategoryVideoController::class, 'disable'])->name('admin.category.video.disable')->middleware('can:admin.category.video.disable');
        Route::put('{category}/enable', [CategoryVideoController::class, 'enable'])->name('admin.category.video.enable')->middleware('can:admin.category.video.enable');
        Route::delete('{category}', [CategoryVideoController::class, 'destroy'])->name('admin.category.video.destroy')->middleware('can:admin.category.video.destroy');

        Route::get('{category}/up', [CategoryVideoController::class, 'up'])->name('admin.category.video.up')->middleware('can:admin.category.video.sort');
        Route::get('{category}/down', [CategoryVideoController::class, 'down'])->name('admin.category.video.down')->middleware('can:admin.category.video.sort');
    });

    Route::prefix('video')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('admin.video.index')->middleware('can:admin.video.index');

        Route::get('/create', [VideoController::class, 'create'])->name('admin.video.create')->middleware('can:admin.video.create');
        Route::post('/', [VideoController::class, 'store'])->name('admin.video.store')->middleware('can:admin.video.create');

        Route::get('{video}/edit', [VideoController::class, 'edit'])->name('admin.video.edit')->middleware('can:admin.video.edit');
        Route::put('{video}', [VideoController::class, 'update'])->name('admin.video.update')->middleware('can:admin.video.edit');

        Route::put('{video}/disable', [VideoController::class, 'disable'])->name('admin.video.disable')->middleware('can:admin.video.disable');
        Route::put('{video}/enable', [VideoController::class, 'enable'])->name('admin.video.enable')->middleware('can:admin.video.enable');
        Route::delete('{video}', [VideoController::class, 'destroy'])->name('admin.video.destroy')->middleware('can:admin.video.destroy');

        Route::post('/upload', [VideoController::class, 'upload'])->name('admin.video.upload')->middleware('can:admin.video.upload');
    });
    Route::prefix('statistic')->group(function () {
        Route::post('/visitors-views', [StatisticController::class, 'visitorsViews'])->name('admin.statistic.visitors.views');
        Route::post('/most-visited-pages', [StatisticController::class, 'mostVisitedPages'])->name('admin.statistic.most.visited.pages');
    });
});


Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');


Route::prefix('/')->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('index');
    Route::get('{slug}-{id}.html', [HomeController::class, 'news'])
        ->where('slug', '[a-zA-Z0-9-_]+')
        ->where('id', '[0-9]+')->name('news');

    Route::get('{slug}', [HomeController::class, 'category'])
        ->where('slug', '(.*)?')
        ->name('category');
});
