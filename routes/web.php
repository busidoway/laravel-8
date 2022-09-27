<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\ReestrController;
use App\Http\Controllers\ReestrOrgController;
use App\Http\Controllers\ViewpointsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\MenuController;

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

Auth::routes(['register'=>true]);

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/news', function () {
    return view('pages.news');
})->name('news');

Route::get('/news/{id}', [NewsController::class, 'show'])->name('news_inner');

Route::get('/events', function () {
    return view('pages.events');
})->name('events');

Route::get('/events/{id}', [EventsController::class, 'show'])->name('event_inner');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contacts', function () {
    return view('pages.contacts');
})->name('contacts');

Route::get('/auth', [App\Http\Controllers\HomeController::class, 'index'])->name('auth');

Route::get('/admin', function () {
    return redirect('/admin/news');
})->middleware(['auth', 'isadmin']);

Route::resource('/admin/video', VideoController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/users', UsersController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/events', EventsController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/news', NewsController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/slider', SliderController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/news_category', NewsCategoryController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/persons', PersonsController::class)->middleware(['auth', 'isadmin']);

Route::resource('/reestr', ReestrController::class)->middleware(['auth', 'isadmin']);

Route::resource('/reestr_org', ReestrOrgController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/viewpoints', ViewpointsController::class)->middleware(['auth', 'isadmin']);

Route::resource('/admin/menu', MenuController::class)->middleware(['auth', 'isadmin']);

Route::get('/video/{video}', [VideoController::class, 'show'])->middleware('auth');

Route::get('/reestr', [ReestrController::class, 'all'])->name('reestr');

Route::get('/person.php', [ReestrController::class, 'redir']);

Route::get('/person/{id}', [ReestrController::class, 'person'])->name('person');

Route::get('/reestr_org', [ReestrOrgController::class, 'all'])->name('reestr_org');

Route::get('/org/{id}', [ReestrOrgController::class, 'org'])->name('org');

Route::get('/viewpoint', [ViewpointsController::class, 'all'])->name('viewpoint');

Route::get('/viewpoint/{id}', [ViewpointsController::class, 'show'])->name('viewpoint_inner');

Route::group(['middleware' => ['auth', 'isadmin'], 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function()
{
    Route::get('/slider', [SliderController::class, 'index'])->name('slider');
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/video', [VideoController::class, 'index'])->name('video');
    Route::get('/video_load', [VideoController::class, 'indexUpload'])->name('video_load');
    Route::post('/video_upload', [VideoController::class, 'uploadVideo'])->name('video_upload');
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news_category', [NewsCategoryController::class, 'index'])->name('news_category');
    Route::get('/events', [EventsController::class, 'index'])->name('events');
    Route::get('/persons', [PersonsController::class, 'index'])->name('persons');
    Route::get('/reestr', [ReestrController::class, 'index'])->name('reestr');
    Route::get('/reestr_load', [ReestrController::class, 'indexUpload'])->name('reestr_load');
    Route::post('/reestr_upload', [ReestrController::class, 'uploadReestr'])->name('reestr_upload');
    Route::get('/reestr_org', [ReestrOrgController::class, 'index'])->name('reestr_org');
    Route::get('/reestr_org_load', [ReestrOrgController::class, 'indexUpload'])->name('reestr_org_load');
    Route::post('/reestr_org_upload', [ReestrOrgController::class, 'uploadReestr'])->name('reestr_org_upload');
    Route::get('/viewpoints', [ViewpointsController::class, 'index'])->name('viewpoints');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
});
