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
use App\Http\Controllers\FilesController;
use App\Http\Controllers\WidgetsController;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\newsController;
use App\Http\Controllers\FlashNewsController;
use App\Http\Controllers\eventsController;
use App\Http\Controllers\videosController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\officesController;
use App\Http\Controllers\UsersController;
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

/* Admin New Routes for Files are defined here */
Route::prefix('admin/files')->group(function () {
    Route::get('/', [FilesController::class, 'index'])->name('files.index');
    Route::get('/v1/ajax', [FilesController::class, 'getAllWidgets'])->name('api.files.index');
    Route::post('/get-pages', [FilesController::class, 'getRecords'])->name('get-files');
    Route::match(['get', 'post'], 'create', [FilesController::class, 'create'])->name('files.create');
    Route::post('/', [FilesController::class, 'store'])->name('files.store');
    Route::get('/edit/{id}', [FilesController::class, 'edit'])->name('files.edit');
    Route::get('/show/{id}', [FilesController::class, 'show'])->name('files.show');

    Route::match(['get', 'put'], '/update/{id}', [FilesController::class, 'update'])->name('admin.files.update');
    Route::delete('delete/{id}', [FilesController::class, 'delete'])->name('files.delete');
});

/* Admin Routes for Widgets are defined here */
Route::prefix('admin/widgets')->group(function () {
    Route::get('/', [WidgetsController::class, 'index'])->name('widgets.index');
    Route::get('/v1/ajax', [WidgetsController::class, 'getAllWidgets'])->name('api.widgets.index');
    Route::post('/get-widgets', [WidgetsController::class, 'getRecords'])->name('get-widgets');
    Route::match(['get', 'post'], 'create', [WidgetsController::class, 'create'])->name('widgets.create');
    Route::post('/', [WidgetsController::class, 'store'])->name('widgets.store');
    Route::get('/edit/{id}', [WidgetsController::class, 'edit'])->name('widgets.edit');

    Route::match(['get', 'put'], 'update/{id}', [WidgetsController::class, 'update'])->name('widgets.update');
    Route::delete('delete/{id}', [WidgetsController::class, 'delete'])->name('widgets.delete');
});

// User-specific widget creation (assuming UserController exists)
Route::post('/user/widgets/create', [UserController::class, 'stWidget'])->name('user.widgets.create');

/* Admin Routes for Pages are defined here */
Route::prefix('admin/pages')->group(function () {
    Route::get('/', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/v1/ajax', [PagesController::class, 'getAllWidgets'])->name('api.pages.index');
    Route::post('/get-pages', [PagesController::class, 'getRecords'])->name('get-pages');
    Route::match(['get', 'post'], 'create', [PagesController::class, 'create'])->name('pages.create');
    Route::post('/', [PagesController::class, 'store'])->name('pages.store');
    Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('pages.edit');

    Route::match(['get', 'put'], 'update/{id}', [PagesController::class, 'update'])->name('pages.update');
    Route::delete('delete/{id}', [PagesController::class, 'delete'])->name('pages.delete');
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
    Route::post('post', [projectsController::class, 'store'])->name('projects.store');

    Route::delete('delete/{id}', [projectsController::class, 'delete']);
});

/* Admin Routes for News are defined here */
Route::group(['prefix' => 'admin/news'], function () {
    Route::get('/', [newsController::class, 'index']);
    /* Route::get('/search','newsController@search')->name('news.search'); */
    Route::match(['get', 'post'], 'create', [newsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [newsController::class, 'update']);
    Route::get('/v1/news', [newsController::class, 'getAllNews'])->name('api.news.index');
    Route::post('post', [newsController::class, 'store'])->name('news.store');

    Route::delete('delete/{id}', [newsController::class, 'delete']);
});

Route::prefix('admin/flashnews')->group(function () {
    Route::get('/', [FlashNewsController::class, 'index'])->name('flashnews.index');
    Route::get('/v1/ajax', [FlashNewsController::class, 'getAllWidgets'])->name('api.flashnews.index');
    Route::post('/get-flashnews', [FlashNewsController::class, 'getRecords'])->name('get-flashnews');
    Route::match(['get', 'post'], 'create', [FlashNewsController::class, 'create'])->name('flashnews.create');
    Route::post('/', [FlashNewsController::class, 'store'])->name('flashnews.store');
    Route::get('/edit/{id}', [FlashNewsController::class, 'edit'])->name('flashnews.edit');

    Route::match(['get', 'put'], 'update/{id}', [FlashNewsController::class, 'update'])->name('flashnews.update');
    Route::delete('delete/{id}', [FlashNewsController::class, 'delete'])->name('flashnews.delete');
});
/*** New Routes for User */
Route::prefix('admin/users')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/', [UsersController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

});
/* Admin Routes for Events are defined here */
Route::group(['prefix' => 'admin/events'], function () {
    Route::get('/', [eventsController::class, 'index']);
    /* Route::get('/search','eventsController@search')->name('events.search'); */
    Route::match(['get', 'post'], 'create', [eventsController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [eventsController::class, 'update']);
    Route::delete('delete/{id}', [eventsController::class, 'delete']);
    Route::post('post', [eventsController::class, 'store'])->name('events.store');

    Route::get('/v1/events', [eventsController::class, 'getAllEvents'])->name('api.events.index');
});

/* Admin Routes for Videos are defined here */
Route::group(['prefix' => 'admin/videos'], function () {
    Route::get('/', [videosController::class, 'index']);
    /* Route::get('/search','videosController@search')->name('videos.search'); */
    Route::match(['get', 'post'], 'create', [videosController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [videosController::class, 'update']);
    Route::post('post', [videosController::class, 'store'])->name('videos.store');

    Route::get('/v1/videos', [videosController::class, 'getAllVideos'])->name('api.videos.index');
    Route::delete('delete/{id}', [videosController::class, 'delete']);
});

/* Admin Routes for Settings are defined here */

Route::group(['prefix' => 'admin/settings'], function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('/', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('/{id}/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/{id}', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');

    // Additional custom routes if needed
    Route::get('/v1/settings', [SettingsController::class, 'getAllSettings'])->name('api.settings.index');
});

/* Admin Routes for Offices are defined here */
Route::group(['prefix' => 'admin/offices'], function () {
    Route::get('/', [officesController::class, 'index'])->name('offices.index');
    Route::get('/create', [officesController::class, 'create'])->name('offices.create');
    Route::post('/', [officesController::class, 'store'])->name('offices.store');
    Route::get('/{id}/edit', [officesController::class, 'edit'])->name('offices.edit');
    Route::put('/{id}', [officesController::class, 'update'])->name('offices.update');
    Route::get('/v1/offices', [officesController::class, 'getAllOffices'])->name('api.offices.index');

    Route::delete('/{id}', [officesController::class, 'destroy'])->name('offices.destroy');
});

/* Admin Routes for Users are defined here */
Route::group(['prefix' => 'admin/users'], function () {
    Route::get('/', [usersController::class, 'index']);
    /* Route::get('/search','usersController@search')->name('users.search'); */
    Route::get('/v1/users', [usersController::class, 'getAllUsers'])->name('api.users.index');
    Route::match(['get', 'post'], 'create', [usersController::class, 'create']);
    Route::match(['get', 'put'], 'update/{id}', [usersController::class, 'update']);
    Route::post('post', [UsersController::class, 'store'])->name('users.store'); // Route for creating a new user
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