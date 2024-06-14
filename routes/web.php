<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rdlpkIndexController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Website\rdlpkNewsController;
use App\Http\Controllers\Website\rdlpkEventsController;
use App\Http\Controllers\Website\rdlpkProjectsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Website\rdlpkPagesController;
use App\Http\Controllers\Website\rdlpknewslettersController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangeController;
use App\Http\Controllers\filesController;
use App\Http\Controllers\widgetsController;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\newsController;
use App\Http\Controllers\FlashNewsController;
use App\Http\Controllers\eventsController;
use App\Http\Controllers\videosController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\officesController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\newslettersController;
use App\Http\Controllers\User\userWidgetsController;
use App\Http\Controllers\User\userPagesController;

// Controllers Within The "App\Http\Controllers\Website" Namespace
Route::get('/', [rdlpkIndexController::class, 'index']);
Route::group(['prefix' => '/index'], function () {
    Route::get('/', [rdlpkIndexController::class, 'index']);
});
// Route::get('pagenotfound',['as' => 'notfound']);
Route::get('/about-us', [rdlpkIndexController::class, 'aboutus']);
Route::get('/newsletters', [rdlpkIndexController::class, 'newsletters']);
// New routes start here
Route::get('/iso-certificates/{alias}', [rdlpkIndexController::class, 'isocertificates']);
Route::get('/iso-certificates', [rdlpkIndexController::class, 'isocertificates']);

Route::get('/our-group', [rdlpkIndexController::class, 'ourgroup']);
// New routes end here
Route::get('/news', [rdlpkIndexController::class, 'newsdetail']);
Route::get('/news/{alias}', [fdhNewsController::class, 'showNews']);
Route::get('/events', [rdlpkIndexController::class, 'latestevents']);
Route::get('/events/{alias}', [fdhEventsController::class, 'showEvents']);
Route::get('/videos', [rdlpkIndexController::class, 'latestvideos']);
Route::get('/current-projects', [rdlpkIndexController::class, 'currentprojects']);
Route::get('/current-projects/{alias}', [fdhProjectsController::class, 'showCurrentProjects']);
Route::get('/upcoming-projects/{alias}', [fdhProjectsController::class, 'showUpcomingProjects']);
Route::get('/upcoming-projects', [rdlpkIndexController::class, 'upcomingprojects']);
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactUsController::class, 'send'])->name('contact.send');
Route::get('/sitemap.xml', [rdlpkPagesController::class, 'showsitemap']);
Route::get('/pages/{alias}', [rdlpkPagesController::class, 'showPages']);
Route::get('/newsletters/{alias}', [rdlpknewslettersController::class, 'showNewsletters']);
Route::get('/brochure', [rdlpkIndexController::class, 'showBrochure']);
/* Routers for main website end here */

// Auth::routes(['register' => false]);
Auth::routes();


Route::prefix('admin')->group(function() {
    Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/home', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::match(['get', 'post'], 'change-password', [ChangeController::class, 'changepassword']);
    // Admin registration routes
    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'register'])->name('admin.register.submit');
});

Route::group(['prefix' => 'admin/files'], function () {
    Route::get('/', [filesController::class, 'index']);
    /* Route::get('/search','filesController@search')->name('files.search'); */
    Route::get('/v1/files', [filesController::class, 'getAllFiles'])->name('api.files.index');
    Route::match(['get', 'post'], 'create', [filesController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [filesController::class, 'update']);
    Route::delete('delete/{id}', [filesController::class, 'delete']);
});

/* Admin Routes for Widgets are defined here */
Route::group(['prefix' => 'admin/widgets'], function () {
    Route::post('/user/widgets/create', [UserController::class, 'stWidget'])->name('widgets.create');

    Route::get('/', [widgetsController::class, 'index']);
    Route::get('/v1/ajax', [widgetsController::class, 'getAllWidgets'])->name('api.widgets.index');
    Route::post('/get-widgets', [widgetsController::class, 'getRecords'])->name('get-widgets');
    Route::match(['get', 'post'], 'create', [widgetsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [widgetsController::class, 'update']);
    Route::delete('delete/{id}', [widgetsController::class, 'delete']);
});

/* Admin Routes for Pages are defined here */
Route::group(['prefix' => 'admin/pages'], function () {
    Route::get('/', [pagesController::class, 'index']);
    /* Route::get('/search','pagesController@search')->name('pages.search'); */
    Route::get('/v1/pages', [pagesController::class, 'getAllPages'])->name('api.pages.index');
    Route::match(['get', 'post'], 'create', [pagesController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [pagesController::class, 'update']);
    Route::delete('delete/{id}', [pagesController::class, 'delete']);
});
/* Admin Files Routes are Defined here */
/* Alias part implementation still pending */

/* Admin Routes for Projects are defined here */
Route::group(['prefix' => 'admin/projects'], function () {
    Route::get('/', [projectsController::class, 'index']);
    /* Route::get('/search','projectsController@search')->name('projects.search'); */
    Route::get('/v1/projects', [projectsController::class, 'getAllProjects'])->name('api.projects.index');
    Route::match(['get', 'post'], 'create', [projectsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [projectsController::class, 'update']);
    Route::delete('delete/{id}', [projectsController::class, 'delete']);
});

/* Admin Routes for News are defined here */
Route::group(['prefix' => 'admin/news'], function () {
    Route::get('/', [newsController::class, 'index']);
    /* Route::get('/search','newsController@search')->name('news.search'); */
    Route::match(['get', 'post'], 'create', [newsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [newsController::class, 'update']);
    Route::get('/v1/news', [newsController::class, 'getAllNews'])->name('api.news.index');
    Route::delete('delete/{id}', [newsController::class, 'delete']);
});

Route::group(['prefix' => 'admin/flashnews'], function () {
    Route::get('/', [FlashNewsController::class, 'index'])->name('view.flashnews');
    Route::match(['get', 'post'], 'create', [FlashNewsController::class, 'create'])->name('create.flashnews');
    Route::match(['get', 'put'], 'update/{id}', [FlashNewsController::class, 'update'])->name('update.flashnews');
    Route::delete('delete/{id}', [FlashNewsController::class, 'delete'])->name('delete.flashnews'); // Ajax call
    Route::get('/v1/flashnews', [FlashNewsController::class, 'getFlashNews'])->name('api.flashnews.index');
});

/* Admin Routes for Events are defined here */
Route::group(['prefix' => 'admin/events'], function () {
    Route::get('/', [eventsController::class, 'index']);
    /* Route::get('/search','eventsController@search')->name('events.search'); */
    Route::match(['get', 'post'], 'create', [eventsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [eventsController::class, 'update']);
    Route::delete('delete/{id}', [eventsController::class, 'delete']);
    Route::get('/v1/events', [eventsController::class, 'getAllEvents'])->name('api.events.index');
});

/* Admin Routes for Videos are defined here */
Route::group(['prefix' => 'admin/videos'], function () {
    Route::get('/', [videosController::class, 'index']);
    /* Route::get('/search','videosController@search')->name('videos.search'); */
    Route::match(['get', 'post'], 'create', [videosController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [videosController::class, 'update']);
    Route::get('/v1/videos', [videosController::class, 'getAllVideos'])->name('api.videos.index');
    Route::delete('delete/{id}', [videosController::class, 'delete']);
});

/* Admin Routes for Settings are defined here */
Route::group(['prefix' => 'admin/settings'], function () {
    Route::get('/', [settingsController::class, 'index']);
    /* Route::get('/search','settingsController@search')->name('settings.search'); */
    Route::get('/v1/settings', [settingsController::class, 'getAllSettings'])->name('api.settings.index');
    Route::match(['get', 'post'], 'create', [settingsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [settingsController::class, 'update']);
    Route::delete('delete/{id}', [settingsController::class, 'delete']);
});

/* Admin Routes for Offices are defined here */
Route::group(['prefix' => 'admin/offices'], function () {
    Route::get('/', [officesController::class, 'index']);
    /* Route::get('/search','officesController@search')->name('offices.search'); */
    Route::get('/v1/offices', [officesController::class, 'getAllOffices'])->name('api.offices.index');
    Route::match(['get', 'post'], 'create', [officesController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [officesController::class, 'update']);
    Route::delete('delete/{id}', [officesController::class, 'delete']);
});

/* Admin Routes for Users are defined here */
Route::group(['prefix' => 'admin/users'], function () {
    Route::get('/', [usersController::class, 'index']);
    /* Route::get('/search','usersController@search')->name('users.search'); */
    Route::get('/v1/users', [usersController::class, 'getAllUsers'])->name('api.users.index');
    Route::match(['get', 'post'], 'create', [usersController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [usersController::class, 'update']);
    Route::delete('delete/{id}', [usersController::class, 'delete']);
});

/* Admin Routes for Newsletters are defined here */
Route::group(['prefix' => 'admin/newsletters'], function () {
    Route::get('/', [newslettersController::class, 'index']);
    Route::get('/v1/newsletters', [newslettersController::class, 'getAllNewsletters'])->name('api.newsletters.index');
    /* Route::get('/search','newslettersController@search')->name('newsletters.search'); */
    Route::match(['get', 'post'], 'create', [newslettersController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [newslettersController::class, 'update']);
    Route::delete('delete/{id}', [newslettersController::class, 'delete']);
});

/* User Routes */
Route::prefix('user')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
    Route::group(['prefix' => 'widgets'], function () {
        Route::get('/', [userWidgetsController::class, 'index']);
        Route::get('/search', [userWidgetsController::class, 'search'])->name('userwidgets.search');
        Route::match(['get', 'put'], 'update/{id}', [userWidgetsController::class, 'update']);
    });
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [userPagesController::class, 'index']);
        Route::get('/search', [userPagesController::class, 'search'])->name('userpages.search');
        Route::match(['get', 'put'], 'update/{id}', [userPagesController::class, 'update']);
    });
});

/* Default Auth Routes */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');