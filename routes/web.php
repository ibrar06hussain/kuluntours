<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\HomepageSectionController as AdminHomepageSectionController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSettingController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\SocialLinkController as AdminSocialLinkController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InquiryController;
use App\Http\Controllers\Front\PackageController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Kunlun Treks and Tours
|--------------------------------------------------------------------------
*/

// =====================================================
// PUBLIC FRONTEND ROUTES
// =====================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Packages & Categories
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/category/{category:slug}', [PackageController::class, 'category'])->name('packages.category');
Route::get('/packages/{package:slug}', [PackageController::class, 'show'])->name('packages.show');

// CMS Pages
Route::get('/page/{page:slug}', [PageController::class, 'show'])->name('pages.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// FAQs
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');

// Contact & Inquiries
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

// =====================================================
// ADMIN ROUTES
// =====================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated admin routes
    Route::middleware('admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Content & Structure
        Route::resource('sliders', AdminSliderController::class)->except(['show']);
        Route::resource('homepage-sections', AdminHomepageSectionController::class)->only(['index', 'edit', 'update']);
        Route::resource('pages', AdminPageController::class)->except(['show']);

        // Packages & Categories
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::delete('packages/gallery/{image}', [AdminPackageController::class, 'deleteGalleryImage'])->name('packages.gallery.delete');
        Route::resource('packages', AdminPackageController::class);

        // Engagement
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('team-members', AdminTeamController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);

        // Inquiries
        Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
        Route::put('inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Blog
        Route::resource('blog-posts', AdminBlogController::class)->except(['show']);

        // Settings & Users
        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');
        Route::resource('social-links', AdminSocialLinkController::class)->except(['show', 'create', 'edit']);
        Route::resource('users', AdminUserController::class)->except(['show']);

        // Media Library
        Route::get('media', [AdminMediaController::class, 'index'])->name('media.index');
        Route::post('media', [AdminMediaController::class, 'store'])->name('media.store');
        Route::post('media/upload-editor', [AdminMediaController::class, 'uploadEditorImage'])->name('media.editor.upload');
        Route::delete('media/{media}', [AdminMediaController::class, 'destroy'])->name('media.destroy');
    });
});
