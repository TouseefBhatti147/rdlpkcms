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
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\newsController;
use App\Http\Controllers\FlashNewsController;
use App\Http\Controllers\eventsController;
use App\Http\Controllers\videosController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\officesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NewslettersController;
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

    Route::match(['get', 'put'], '/update/{id}', [FilesController::class, 'update'])->name('files.update');
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
/* Admin New Routes for Files are defined here */
Route::prefix('admin/projects')->group(function () {
    Route::get('/', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/v1/ajax', [ProjectsController::class, 'getAllWidgets'])->name('api.projects.index');
    Route::post('/get-pages', [ProjectsController::class, 'getRecords'])->name('get-projects');
    Route::match(['get', 'post'], 'create', [ProjectsController::class, 'create'])->name('projects.create');
    Route::post('/', [ProjectsController::class, 'store'])->name('projects.store');
    Route::get('/edit/{id}', [ProjectsController::class, 'edit'])->name('projects.edit');
    Route::get('/show/{id}', [ProjectsController::class, 'show'])->name('projects.show');

    Route::match(['get', 'put'], '/update/{id}', [ProjectsController::class, 'update'])->name('projects.update');
    Route::delete('delete/{id}', [ProjectsController::class, 'delete'])->name('projects.delete');
});

/* Admin Routes for News are defined here */
Route::prefix('admin/news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.index');
    Route::get('/v1/ajax', [NewsController::class, 'getAllWidgets'])->name('api.news.index');
    Route::post('/get-pages', [NewsController::class, 'getRecords'])->name('get-news');
    Route::match(['get', 'post'], 'create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/', [NewsController::class, 'store'])->name('news.store');
    Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::get('/show/{id}', [NewsController::class, 'show'])->name('news.show');

    Route::match(['get', 'put'], '/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
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
Route::prefix('admin/events')->group(function () {
    Route::get('/', [EventsController::class, 'index'])->name('events.index');
    Route::match(['get', 'post'], 'create', [EventsController::class, 'create'])->name('events.create');
    Route::post('/', [EventsController::class, 'store'])->name('events.store');
    Route::get('/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
    Route::get('/show/{id}', [EventsController::class, 'show'])->name('events.show');

    Route::match(['get', 'put'], '/update/{id}', [EventsController::class, 'update'])->name('events.update');
    Route::delete('delete/{id}', [EventsController::class, 'delete'])->name('events.delete');
});


/* Admin Routes for Videos are defined here */
Route::prefix('admin/videos')->group(function () {
    Route::get('/', [VideosController::class, 'index'])->name('videos.index');
    Route::match(['get', 'post'], 'create', [VideosController::class, 'create'])->name('videos.create');
    Route::post('/', [VideosController::class, 'store'])->name('videos.store');
    Route::get('/edit/{id}', [VideosController::class, 'edit'])->name('videos.edit');
    Route::get('/show/{id}', [VideosController::class, 'show'])->name('videos.show');

    Route::match(['get', 'put'], '/update/{id}', [VideosController::class, 'update'])->name('videos.update');
    Route::delete('delete/{id}', [VideosController::class, 'delete'])->name('videos.delete');
});

/* Admin Routes for Settings are defined here */

Route::prefix('admin/settings')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
    Route::match(['get', 'post'], 'create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('/', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('/edit/{id}', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::get('/show/{id}', [SettingsController::class, 'show'])->name('settings.show');

    Route::match(['get', 'put'], '/update/{id}', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('delete/{id}', [SettingsController::class, 'delete'])->name('settings.delete');
});


/* Admin Routes for Offices are defined here */
Route::prefix('admin/offices')->group(function () {
    Route::get('/', [OfficesController::class, 'index'])->name('offices.index');
    Route::match(['get', 'post'], 'create', [OfficesController::class, 'create'])->name('offices.create');
    Route::post('/', [OfficesController::class, 'store'])->name('offices.store');
    Route::get('/edit/{id}', [OfficesController::class, 'edit'])->name('offices.edit');
    Route::get('/show/{id}', [OfficesController::class, 'show'])->name('offices.show');

    Route::match(['get', 'put'], '/update/{id}', [OfficesController::class, 'update'])->name('offices.update');
    Route::delete('delete/{id}', [OfficesController::class, 'delete'])->name('offices.delete');
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
Route::prefix('admin/newsletters')->group(function () {
    Route::get('/', [NewslettersController::class, 'index'])->name('newsletters.index');
    Route::match(['get', 'post'], 'create', [NewslettersController::class, 'create'])->name('newsletters.create');
    Route::post('/', [NewslettersController::class, 'store'])->name('newsletters.store');
    Route::get('/edit/{id}', [NewslettersController::class, 'edit'])->name('newsletters.edit');
    Route::match(['get', 'put'], 'update/{id}', [NewslettersController::class, 'update'])->name('newsletters.update');
    Route::delete('delete/{id}', [NewslettersController::class, 'delete'])->name('newsletters.delete');
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