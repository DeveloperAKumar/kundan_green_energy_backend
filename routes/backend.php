<?php

use App\Http\Controllers\Backend\AboutPageController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ChairmanMessageController;
use App\Http\Controllers\Backend\ContactEnquiryController;
use App\Http\Controllers\Backend\ContentGalleryController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\EventImageController;
use App\Http\Controllers\Backend\HomeVideoController;
use App\Http\Controllers\Backend\MainGalleryController;
use App\Http\Controllers\Backend\MinGalleryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\OtherPageController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ProjectsAcrossIndiaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\ValuedPartnershipController;
use App\Http\Controllers\Backend\VerticalAdvantageController;
use App\Http\Controllers\Backend\VerticalController;
use App\Http\Controllers\Backend\VerticalSectionController;
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

            Route::controller(ValuedPartnershipController::class)->group(function(){
                Route::get("/valued-partnership", "index")->name("backend.valued_partnership");
                Route::get("/valued-partnership/create", "create")->name("backend.valued_partnership.create");
                Route::post("/valued-partnership/store", "store")->name("backend.valued_partnership.store");
                Route::get("/valued-partnership/edit/{id}", "edit")->name("backend.valued_partnership.edit");
                Route::post("/valued-partnership/update/{id}", "update")->name("backend.valued_partnership.update");
                Route::delete("/valued-partnership/destroy", "destroy")->name("backend.valued_partnership.destroy");
            });

            Route::controller(ProjectsAcrossIndiaController::class)->group(function () {
                Route::get("/projects-across-india", "index")->name("backend.projects_across_india");
                Route::get("/projects-across-india/create", "create")->name("backend.projects_across_india.create");
                Route::post("/projects-across-india/store", "store")->name("backend.projects_across_india.store");
                Route::get("/projects-across-india/edit/{id}", "edit")->name("backend.projects_across_india.edit");
                Route::post("/projects-across-india/update/{id}", "update")->name("backend.projects_across_india.update");
                Route::delete("/projects-across-india/destroy", "destroy")->name("backend.projects_across_india.destroy");
            });

            Route::controller(HomeVideoController::class)->group(function () {
                Route::get("/home-video/edit", "edit")->name("backend.home_video.edit");
                Route::post("/home-video/update", "update")->name("backend.home_video.update");
            });

            Route::controller(NewsController::class)->group(function(){
                Route::get("/news", "index")->name("backend.news");
                Route::get("/news/create", "create")->name("backend.news.create");
                Route::post("/news/store", "store")->name("backend.news.store");
                Route::get("/news/edit/{id}", "edit")->name("backend.news.edit");
                Route::post("/news/update/{id}", "update")->name("backend.news.update");
                Route::delete("/news/destroy", "destroy")->name("backend.news.destroy");
            });

           

            Route::controller(ContentGalleryController::class)->group(function () {
                Route::get("/content-gallery", "index")->name("backend.content_gallery");
                Route::get("/content-gallery/create", "create")->name("backend.content_gallery.create");
                Route::post("/content-gallery/store", "store")->name("backend.content_gallery.store");
                Route::get("/content-gallery/edit/{id}", "edit")->name("backend.content_gallery.edit");
                Route::post("/content-gallery/update/{id}", "update")->name("backend.content_gallery.update");
                Route::delete("/content-gallery/destroy", "destroy")->name("backend.content_gallery.destroy");
            });

            Route::controller(MainGalleryController::class)->group(function () {
                Route::get('/main-gallery', 'index')->name('backend.main_gallery');
                Route::get('/main-gallery/create', 'create')->name('backend.main_gallery.create');
                Route::post('/main-gallery/store', 'store')->name('backend.main_gallery.store');
                Route::get('/main-gallery/edit/{id}', 'edit')->name('backend.main_gallery.edit');
                Route::post('/main-gallery/update/{id}', 'update')->name('backend.main_gallery.update');
                Route::delete('/main-gallery/destroy', 'destroy')->name('backend.main_gallery.destroy');
            });

            Route::controller(ProjectController::class)->group(function(){
                Route::get("/project","index")->name("backend.project");
                Route::get("/project/create","create")->name("backend.project.create");
                Route::post("/project/store","store")->name("backend.project.store");
                Route::get("/project/edit/{id}","edit")->name("backend.project.edit");
                Route::post("/project/update/{id}","update")->name("backend.project.update");
                Route::delete("/project/destroy","destroy")->name("backend.project.destroy");
                Route::delete("/project/image/destroy","destroyImage")->name("backend.project.image.destroy"); 
            });
            Route::controller(VerticalController::class)->group(function () {
                Route::get("/vertical", "index")->name("backend.vertical");
                Route::get("/vertical/create", "create")->name("backend.vertical.create");
                Route::post("/vertical/store", "store")->name("backend.vertical.store");
                Route::get("/vertical/edit/{id}", "edit")->name("backend.vertical.edit");
                Route::post("/vertical/update/{id}", "update")->name("backend.vertical.update");
                Route::delete("/vertical/destroy", "destroy")->name("backend.vertical.destroy");
            });

            Route::controller(VerticalSectionController::class)->group(function () {
                Route::get("/vertical-section", "index")->name("backend.vertical_section");
                Route::get("/vertical-section/create", "create")->name("backend.vertical_section.create");
                Route::post("/vertical-section/store", "store")->name("backend.vertical_section.store");
                Route::get("/vertical-section/edit/{id}", "edit")->name("backend.vertical_section.edit");
                Route::post("/vertical-section/update/{id}", "update")->name("backend.vertical_section.update");
                Route::delete("/vertical-section/destroy", "destroy")->name("backend.vertical_section.destroy");
            });

            Route::controller(VerticalAdvantageController::class)->group(function(){
                Route::get("/vertical-advantage","index")->name("backend.vertical_advantage");
                Route::get("/vertical-advantage/create","create")->name("backend.vertical_advantage.create");
                Route::post("/vertical-advantage/store","store")->name("backend.vertical_advantage.store");
                Route::get("/vertical-advantage/edit/{id}","edit")->name("backend.vertical_advantage.edit");
                Route::post("/vertical-advantage/update/{id}","update")->name("backend.vertical_advantage.update");
                Route::delete("/vertical-advantage/destroy","destroy")->name("backend.vertical_advantage.destroy");
            });

            Route::controller(AboutPageController::class)->group(function(){
                Route::get("/about-page/edit", "edit")->name("backend.about_page.edit");
                Route::post("/about-page/update", "update")->name("backend.about_page.update");
            });

            Route::controller(ChairmanMessageController::class)->group(function(){
                Route::get("/chairman-message/edit", "edit")->name("backend.chairman_message.edit");
                Route::post("/chairman-message/update", "update")->name("backend.chairman_message.update");
            });

            Route::controller(TeamController::class)->group(function(){
                Route::get('/team','index')->name('backend.team');
                Route::get('/team/create','create')->name('backend.team.create');
                Route::post('/team/store','store')->name('backend.team.store');
                Route::get('/team/edit/{id}','edit')->name('backend.team.edit');
                Route::post('/team/update/{id}','update')->name('backend.team.update');
                Route::delete('/team/destroy','destroy')->name('backend.team.destroy');
            });

            Route::controller(EventController::class)->group(function(){
                Route::get('/event','index')->name('backend.event');
                Route::get('/event/create','create')->name('backend.event.create');
                Route::post('/event/store','store')->name('backend.event.store');
                Route::get('/event/edit/{id}','edit')->name('backend.event.edit');
                Route::post('/event/update/{id}','update')->name('backend.event.update');
                Route::delete('/event/destroy','destroy')->name('backend.event.destroy');
            });

            Route::controller(EventImageController::class)->group(function(){
                Route::get('/event-gallery/{event}', 'index')->name('backend.event_image');
                Route::post('/event-gallery/store', 'store')->name('backend.event_image.store');
                Route::get('/event-gallery/edit/{id}', 'edit')->name('backend.event_image.edit');
                Route::post('/event-gallery/update/{id}', 'update')->name('backend.event_image.update');
                Route::delete('/event-gallery/destroy', 'destroy')->name('backend.event_image.destroy');
            });

        });
    });

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // Artisan::call('route:clear');
        // Artisan::call('view:clear');
    return redirect()->back()->with("cache_cleared", "Cache Cleared"); })->name("clear_cache");