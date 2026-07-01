<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ContactEnquiryController;
use App\Http\Controllers\Backend\OtherPageController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
 
use Illuminate\Support\Facades\Route;

   Route::middleware("guest")->group(function(){
        Route::controller(AdminController::class)->group(function(){
            Route::post("/admin/login", "login")->name("admin.login");
            Route::get("/admin/login", "adminLogin")->name("admin.login_view");
            Route::get("/admin", "adminLoginRedirect")->name("admin.admin_login_redirect");
        });
    });

    Route::middleware(["auth"])->group(function(){
        Route::prefix("/admin")->group(function(){
            Route::controller(AdminController::class)->group(function(){
                Route::get("/dashboard", "dashboard")->name('backend.dashboard');
                Route::get("/profile", "adminProfile")->name("admin.admin_profile");
                Route::post("/profile", "updateAdminProfile")->name("admin.admin_profile_update");
            });
        });
        Route::prefix("/admin")->group(function(){
            Route::controller(BlogController::class)->group(function(){
                Route::get("/blog", "index")->name('backend.blog');
                Route::get("/blog/create", "create")->name("backend.blog.create");
                Route::post("/blog/store", "store")->name("backend.blog.store");
                Route::get("/blog/edit/{id}", "edit")->name("backend.blog.edit");
                Route::post("/blog/update/{id}", "update")->name("backend.blog.update");
                Route::delete("/blog/destroy", "destroy")->name("backend.blog.destroy");
            });

            Route::controller(OtherPageController::class)->group(function(){
                Route::get("/other-page", "index")->name('backend.other_page');
                Route::get("/other-page/create", "create")->name("backend.other_page.create");
                Route::post("/other-page/store", "store")->name("backend.other_page.store");
                Route::get("/other-page/edit/{id}", "edit")->name("backend.other_page.edit");
                Route::post("/other-page/update/{id}", "update")->name("backend.other_page.update");
                Route::delete("/other-page/destroy", "destroy")->name("backend.other_page.destroy");
            });
            
            Route::controller(SocialMediaController::class)->group(function(){
                Route::get("/social-media", "index")->name('backend.social_media');
                Route::get("/social-media/create", "create")->name("backend.social_media.create");
                Route::post("/social-media/store", "store")->name("backend.social_media.store");
                Route::get("/social-media/edit/{id}", "edit")->name("backend.social_media.edit");
                Route::post("/social-media/update/{id}", "update")->name("backend.social_media.update");
                Route::delete("/social-media/destroy", "destroy")->name("backend.social_media.destroy");
            });

            Route::controller(BannerController::class)->group(function(){
                Route::get("/banner", "index")->name('backend.banner');
                Route::get("/banner/create", "create")->name("backend.banner.create");
                Route::post("/banner/store", "store")->name("backend.banner.store");
                Route::get("/banner/edit/{id}", "edit")->name("backend.banner.edit");
                Route::post("/banner/update/{id}", "update")->name("backend.banner.update");
                Route::delete("/banner/destroy", "destroy")->name("backend.banner.destroy");
            });
            Route::controller(TestimonialController::class)->group(function(){
                Route::get("/testimonial", "index")->name('backend.testimonial');
                Route::get("/testimonial/create", "create")->name("backend.testimonial.create");
                Route::post("/testimonial/store", "store")->name("backend.testimonial.store");
                Route::get("/testimonial/edit/{id}", "edit")->name("backend.testimonial.edit");
                Route::post("/testimonial/update/{id}", "update")->name("backend.testimonial.update");
                Route::delete("/testimonial/destroy", "destroy")->name("backend.testimonial.destroy");
            });
            
            Route::controller(SiteSettingController::class)->group(function(){ 
                Route::get("/site-setting/edit", "edit")->name("backend.site_setting.edit");
                Route::post("/site-setting/update", "update")->name("backend.site_setting.update"); 
            });
            Route::controller(ContactEnquiryController::class)->group(function(){ 
                Route::get("/contact-enquiry", "index")->name("backend.contact_enquiry");
                Route::delete("/contact-enquiry/destroy", "destroy")->name("backend.contact_enquiry.destroy"); 
            });
        });
    });

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // Artisan::call('route:clear');
        // Artisan::call('view:clear');
    return redirect()->back()->with("cache_cleared", "Cache Cleared"); })->name("clear_cache");