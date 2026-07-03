<?php

use App\Http\Controllers\Api\AboutApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\CareerApiController;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\OtherPageApiController;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\SiteSettingApiController;
use App\Http\Controllers\Api\SocialMediaApiController;
use App\Http\Controllers\Api\TestimonialApiController;
use App\Http\Controllers\Api\VerticalApiController;
use Illuminate\Support\Facades\Route;

Route::get('/banners', [HomeApiController::class, 'banners']);
Route::get('/valued-partnerships', [HomeApiController::class, 'valuedPartnerships']);
Route::get('/projects-across-india', [HomeApiController::class, 'projectsAcrossIndia']);
Route::get('/home-video', [HomeApiController::class, 'homeVideo']);
Route::get('/content-gallery', [HomeApiController::class, 'contentGallery']);

Route::prefix('vertical')->controller(VerticalApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});

Route::prefix('projects')->controller(ProjectApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});
 

Route::prefix('gallery')->controller(GalleryApiController::class)->group(function () {
    Route::get('/', 'index');
});

Route::prefix('news')->controller(NewsApiController::class)->group(function () {
    Route::get('/', 'index');
});

Route::prefix('events')->controller(EventApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});

Route::prefix('about')->controller(AboutApiController::class)->group(function () {
    Route::get('/', 'index');
});

Route::get('/chairman-md-message', [AboutApiController::class, 'chairmanMessage']);
Route::get('/team', [AboutApiController::class, 'team']);
Route::prefix('site-setting')->controller(SiteSettingApiController::class)->group(function () {
    Route::get('/', 'index');
});

Route::prefix('blogs')->controller(BlogApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});

Route::prefix('pages')->controller(OtherPageApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{slug}', 'show');
});
Route::prefix('social-media')->controller(SocialMediaApiController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

Route::post('/contact-enquiry', [ContactApiController::class, 'store']);
Route::prefix('testimonials')->controller(TestimonialApiController::class)->group(function () {
    Route::get('/', 'index');
});
Route::post('/career', [CareerApiController::class, 'store']);


